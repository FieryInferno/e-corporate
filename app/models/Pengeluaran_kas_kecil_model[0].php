<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/
 

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

    	$query_pemindahbukuan = $this->db->query("SELECT penerimaan,pengeluaran FROM tpemindahbukuankaskecil WHERE perusahaan='$idper'");
    	$jumlah_penerimaan=0;
    	$jumlah_pengeluaran=0;
        if($query_pemindahbukuan->num_rows()>0){
            foreach($query_pemindahbukuan->result() as $p){
                $jumlah_penerimaan=$jumlah_penerimaan+$p->penerimaan;
    			$jumlah_pengeluaran=$jumlah_pengeluaran+$p->pengeluaran;
            }
        }
        $nominal_pemindahbukuan = $jumlah_penerimaan - $jumlah_pengeluaran;

        $query_pengeluaran = $this->db->query("SELECT subtotal FROM tpengeluarankaskecil WHERE perusahaan='$idper' AND stdel='0'");
    	$jumlah_nominal_pengeluaran =0;
        if($query_pengeluaran->num_rows()>0){
            foreach($query_pengeluaran->result() as $p){
                $jumlah_nominal_pengeluaran=$jumlah_nominal_pengeluaran+$p->subtotal;
            }
        }

        $query_setor = $this->db->query("SELECT nominal FROM tsetorkaskecil WHERE perusahaan='$idper' AND stdel='0' AND status='0'");
    	$jumlah_nominal_setor =0;
        if($query_setor->num_rows()>0){
            foreach($query_setor->result() as $p){
                $jumlah_nominal_setor=$jumlah_nominal_setor+$p->nominal;
            }
        }

        $hasil = $nominal_pemindahbukuan - $jumlah_nominal_pengeluaran - $jumlah_nominal_setor;
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
		$itemid = $this->input->post('itemid', TRUE);
		if($itemid) {
			$this->db->where('id', $itemid);
			// $this->db->where('status', '0');
			$data = $this->db->get('tanggaranbelanjadetail', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function save() {
		$array_detail = $this->input->post('detail_array');
		$array_detail = json_decode($array_detail);
		$idper = $this->input->post('perusahaan');
		$iddep = $this->input->post('departemen');
		$nominal = $this->input->post('nominal');
		$sisa_kas_kecil = $this->input->post('sisa_kas_kecil');

		$query_departemen = $this->db->query("SELECT * FROM mdepartemen WHERE id='$iddep'");
        if ($query_departemen->num_rows() > 0){
        	foreach ($query_departemen->result() as $dep) {
        		$nama_departemen=$dep->nama;
        	}
        }
        $jumlah_item=0;
        $jumlah_data_anggaran=0;
        foreach($array_detail as $row) {
	        $itemid=$row[0];
	        $query_detail = $this->db->query("SELECT tanggaranbelanja.id, tanggaranbelanjadetail.id FROM tanggaranbelanja JOIN tanggaranbelanjadetail ON tanggaranbelanja.id = tanggaranbelanjadetail.idanggaran WHERE tanggaranbelanja.idperusahaan = '$idper' AND tanggaranbelanja.dept='$nama_departemen' AND tanggaranbelanjadetail.id='$itemid'");
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
				$detail_array = $this->input->post('detail_array');
				$detail_array = json_decode($detail_array);
				foreach($detail_array as $row) {
					$this->db->set('idpengeluaran',$idpengeluaran);
					$this->db->set('itemid',$row[0]);
					$this->db->set('harga',remove_comma($row[2]));
					$this->db->set('jumlah',remove_comma($row[3]));
					$this->db->set('diskon',remove_comma($row[5]));
					$this->db->set('ppn',remove_comma($row[6]));
					$this->db->set('akunno',$row[7]);
					$this->db->insert('tpengeluarankaskecildetail');
				}
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
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

}

