<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengeluaran_kas_kecil_model extends CI_Model {

	public function get_kodeperusahaan($id){
        $query = $this->db->get_where('mperusahaan', array('idperusahaan' => $id));
        return $query;
    } 

	public function delete() {
		$id = $this->uri->segment(3);
		$this->db->set('stdel','1');
		$this->db->set('dby',get_user('username'));
		$this->db->set('ddate',date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$update = $this->db->update('tpengeluarankaskecil');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function cetakdata($tanggalawal,$tanggalakhir) {
		$this->db->select('tpengeluarankaskecil.*,mperusahaan.nama_perusahaan, mdepartemen.nama');
		$this->db->join('mperusahaan','tpengeluarankaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->db->join('mdepartemen','tpengeluarankaskecil.departemen=mdepartemen.id');
		if ((!empty($tanggalawal)) & (!empty($tanggalakhir))) {
			$this->db->where('tpengeluarankaskecil.tanggal >=',$tanggalawal);
			$this->db->where('tpengeluarankaskecil.tanggal <=',$tanggalakhir);
		}
		$this->db->where('tpengeluarankaskecil.stdel', '0');
		$get = $this->db->get('tpengeluarankaskecil');
		return $get->result_array();
	}

    function get_hitungsisakaskecil($idper){

		$query_pemindahbukuan = $this->db->query("SELECT nominal FROM tpemindahbukuankaskecil WHERE perusahaan='$idper' ");
		$nominal_pemindahbukuan=0;
		if($query_pemindahbukuan->num_rows()>0){
			foreach($query_pemindahbukuan->result() as $p){
				$nominal_pemindahbukuan	+=(integer) $p->nominal;
			}
		}

		$this->db->select('total');
		$query_pengeluaran	= $this->db->get_where('tpengeluarankaskecil', [
			'perusahaan'	=> $idper
		]);
		// $query_pengeluaran = $this->db->query("SELECT nominal FROM tpengajuankaskecil WHERE perusahaan='$idper' AND status='1' AND stdel='0'");
		$jumlah_nominal_pengajuan = 0;
		if($query_pengeluaran->num_rows()>0){
			foreach($query_pengeluaran->result() as $p){
				// $jumlah_nominal_pengajuan	+= (integer) $p->nominal;
				$jumlah_nominal_pengajuan	+= (integer) $p->total;
			}
		}

		$query_setor = $this->db->query("SELECT nominal FROM tsetorkaskecil WHERE perusahaan='$idper'AND status='1' AND stdel='0'");
		$jumlah_nominal_setor =0;
		if($query_setor->num_rows()>0){
			foreach($query_setor->result() as $p){
				$jumlah_nominal_setor	+= (integer) $p->nominal;
			}
		}

		$hasil = $nominal_pemindahbukuan - $jumlah_nominal_pengajuan - $jumlah_nominal_setor;
		$data['hasil'] = $hasil;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_pejabat_model($id,$iddep){
		if ($id == $iddep){
			$idpeng=$id;
		}else{
			$idpeng=$iddep;
		}
        $query = $this->db->query("SELECT * FROM mdepartemen WHERE id='$idpeng'");
        if($query->num_rows()>0){
            foreach($query->result() as $p){
                $hasil=$p->pejabat;
            }
        }
    	$data['hasil'] = $hasil;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

 	public function get_detail_item() {
		$itemid = $this->input->post('itemid');
		$data	= [];
		if(is_array($itemid)) {
			for ($i=0; $i < count($itemid); $i++) {
				$this->db->select('tanggaranbelanjadetail.*');
				$this->db->where('tanggaranbelanjadetail.id', $itemid[$i]);
				$data[$i] = $this->db->get('tanggaranbelanjadetail')->row_array();
			}
		} else {
			$this->db->select('tanggaranbelanjadetail.*');
			$this->db->where('tanggaranbelanjadetail.id', $itemid);
			$data[0] = $this->db->get('tanggaranbelanjadetail')->row_array();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function save() {
		
		$idper = $this->input->post('perusahaan');
		$iddep = $this->input->post('departemen');
		$nominal = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));
		$sisa_kas_kecil = preg_replace("/[^0-9]/", "", $this->input->post('sisa_kas_kecil'));

		$query_departemen = $this->db->query("SELECT * FROM mdepartemen WHERE id='$iddep'");
	    if ($query_departemen->num_rows() > 0){
	   		foreach ($query_departemen->result() as $dep) {
	        	$nama_departemen=$dep->nama;
	        }
	    }
	    $detail_array = $this->input->post('detail_array');
		$detail_array = json_decode($detail_array);
	    $jumlah_item=0;
	    $jumlah_data_anggaran=0;
	    foreach($detail_array as $row) {
			$itemid=$row[0];
		    $query_detail = $this->db->query("SELECT tanggaranbelanja.id, tanggaranbelanjadetail.id FROM tanggaranbelanja INNER JOIN tanggaranbelanjadetail ON tanggaranbelanja.id = tanggaranbelanjadetail.idanggaran WHERE tanggaranbelanja.idperusahaan = '$idper' AND tanggaranbelanja.dept='$nama_departemen' AND tanggaranbelanjadetail.id='$itemid'");
		    if($query_detail->num_rows()>0){
				foreach($query_detail->result() as $p){
		           	$jumlah_data_anggaran=$jumlah_data_anggaran+1;
		        }
		    }
	        $jumlah_item = $jumlah_item + 1;
		}

		if ($jumlah_item != $jumlah_data_anggaran){
			$data['status'] = 'error';
			$data['message'] = lang('Maaf, item tidak ada dalam anggaaran belanja.');
		}else if ($nominal > $sisa_kas_kecil){
			$data['status'] = 'error';
			$data['message'] = lang('Maaf, nominal terlalu besar dari sisa kas kecil.');
		}else {
			$this->db->set('nokwitansi',$this->input->post('nokwitansi', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('perusahaan',$this->input->post('perusahaan', TRUE));
			$this->db->set('departemen',$this->input->post('departemen', TRUE));
			$this->db->set('pejabat',$this->input->post('pejabat', TRUE));
			$this->db->set('akunno',$this->input->post('akunno', TRUE));
			$this->db->set('keterangan',$this->input->post('keterangan', TRUE));
			$this->db->set('status','');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tpengeluarankaskecil');
			if($insertHead) {
				$idpengeluaran = $this->db->insert_id();
				
				$no =0;
				foreach($detail_array as $row) {
					$this->db->set('idpengeluaran',$idpengeluaran);
					$this->db->set('itemid',$row[0]);
					$this->db->set('harga',preg_replace("/[^0-9]/", "", $this->input->post('harga')[$no]));
					$this->db->set('jumlah',$this->input->post('jumlah')[$no]);
					$this->db->set('diskon',$this->input->post('diskon')[$no]);
					$this->db->set('pajak',preg_replace("/[^0-9]/", "", $this->input->post('total_pajak')[$no]));
					$this->db->set('biaya_pengiriman',preg_replace("/[^0-9]/", "", $this->input->post('biayapengiriman')[$no]));
					$this->db->set('akunno',$row[8]);
					$this->db->insert('tpengeluarankaskecildetail');
				}
				$data['status'] = 'success';
				$data['message'] = 'Berhasil menyimpan data';
			}else{
				$data['status'] = 'error';
				$data['message'] = 'Gagal menyimpan data';
			}
		}		
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update() {
		$idpengeluaran	= $this->input->post('idpengeluaran');
		//delete pengeluaran kas kecil
		$this->db->where('id',$idpengeluaran);
		$this->db->delete('tpengeluarankaskecil');
		//delete pengeluaran kas kecil detail
		$this->db->where('idpengeluaran',$idpengeluaran);
		$this->db->delete('tpengeluarankaskecildetail');

		
		$idper = $this->input->post('perusahaan');
		$iddep = $this->input->post('departemen');
		$nominal = preg_replace("/[^0-9]/", "", $this->input->post('nominal'));
		$sisa_kas_kecil = preg_replace("/[^0-9]/", "", $this->input->post('sisa_kas_kecil'));

		$query_departemen = $this->db->query("SELECT * FROM mdepartemen WHERE id='$iddep'");
	    if ($query_departemen->num_rows() > 0){
	   		foreach ($query_departemen->result() as $dep) {
	        	$nama_departemen=$dep->nama;
	        }
	    }
	    $detail_array = $this->input->post('detail_array');
		$detail_array = json_decode($detail_array);
	    $jumlah_item=0;
	    $jumlah_data_anggaran=0;
	    foreach($detail_array as $row) {
			$itemid=$row[0];
		    $query_detail = $this->db->query("SELECT tanggaranbelanja.id, tanggaranbelanjadetail.id FROM tanggaranbelanja INNER JOIN tanggaranbelanjadetail ON tanggaranbelanja.id = tanggaranbelanjadetail.idanggaran WHERE tanggaranbelanja.idperusahaan = '$idper' AND tanggaranbelanja.dept='$nama_departemen' AND tanggaranbelanjadetail.id='$itemid'");
		    if($query_detail->num_rows()>0){
				foreach($query_detail->result() as $p){
		           	$jumlah_data_anggaran=$jumlah_data_anggaran+1;
		        }
		    }
	        $jumlah_item = $jumlah_item + 1;
		}

		if ($jumlah_item != $jumlah_data_anggaran){
			$data['status'] = 'error';
			$data['message'] = lang('Maaf, item tidak ada dalam anggaaran belanja.');
		}else if ($nominal > $sisa_kas_kecil){
			$data['status'] = 'error';
			$data['message'] = lang('Maaf, nominal terlalu besar dari sisa kas kecil.');
		}else {
			$this->db->set('nokwitansi',$this->input->post('nokwitansi', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('perusahaan',$this->input->post('perusahaan', TRUE));
			$this->db->set('departemen',$this->input->post('departemen', TRUE));
			$this->db->set('pejabat',$this->input->post('pejabat', TRUE));
			$this->db->set('akunno',$this->input->post('akunno', TRUE));
			$this->db->set('keterangan',$this->input->post('keterangan', TRUE));
			$this->db->set('status','');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tpengeluarankaskecil');
			if($insertHead) {
				$idpengeluaran = $this->db->insert_id();
				
				$no =0;
				foreach($detail_array as $row) {
					$this->db->set('idpengeluaran',$idpengeluaran);
					$this->db->set('itemid',$row[0]);
					$this->db->set('harga',preg_replace("/[^0-9]/", "", $this->input->post('harga')[$no]));
					$this->db->set('jumlah',$this->input->post('jumlah')[$no]);
					$this->db->set('diskon',$this->input->post('diskon')[$no]);
					$this->db->set('pajak',preg_replace("/[^0-9]/", "", $this->input->post('total_pajak')[$no]));
					$this->db->set('biaya_pengiriman',preg_replace("/[^0-9]/", "", $this->input->post('biayapengiriman')[$no]));
					$this->db->set('akunno',$row[8]);
					$this->db->insert('tpengeluarankaskecildetail');
				}

				$this->db->set('uby',get_user('username'));
				$this->db->set('udate',date('Y-m-d H:i:s'));
				$this->db->where('id', $idpengeluaran);
				$this->db->update('tpengeluarankaskecil');

				$data['status'] = 'success';
				$data['message'] = 'Berhasil mengubah data';
			}else{
				$data['status'] = 'error';
				$data['message'] = 'Gagal mengubah data';
			}
		}		
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function pengeluarandetail($idpengeluaran) {
		$this->db->select('tpengeluarankaskecildetail.*, tanggaranbelanjadetail.uraian as nama_item');
		$this->db->join('tanggaranbelanjadetail', 'tpengeluarankaskecildetail.itemid = tanggaranbelanjadetail.id');
		$this->db->where('tpengeluarankaskecildetail.idpengeluaran', $idpengeluaran);
		$get = $this->db->get('tpengeluarankaskecildetail');
		return $get->result_array();
	}

	function get_detail_pengeluarandetail($idpengeluaran){
        $this->db->select('tpengeluarankaskecildetail.*, tanggaranbelanjadetail.uraian as nama_item, tanggaranbelanjadetail.jumlah as jumkas');
		$this->db->join('tanggaranbelanjadetail', 'tpengeluarankaskecildetail.itemid = tanggaranbelanjadetail.id');
		$this->db->where('tpengeluarankaskecildetail.idpengeluaran', $idpengeluaran);
		$query = $this->db->get('tpengeluarankaskecildetail');
		return $query;
    }

}

