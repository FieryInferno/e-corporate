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


class Pengiriman_penjualan_model extends CI_Model {

	public function save() {
		$q = $this->db->query("SELECT id AS kd_max FROM tpengirimanpenjualan");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $kd = ((int)$k->kd_max)+1;
            }
        }else{
            $kd = "1";
        } 
        
        $id_pengiriman = $kd;
        $this->db->set('id',$id_pengiriman);
		$this->db->set('tanggal',$this->input->post('tanggalPO', TRUE));
		$this->db->set('tanggalterima',$this->input->post('tanggalterima', TRUE));
		$this->db->set('pemesananid',$this->input->post('pemesananid', TRUE));
		$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
		$this->db->set('tipe','2');
		$this->db->set('statusauto','0');
		$this->db->set('catatan',$this->input->post('catatan', TRUE));
		$this->db->set('cby',get_user('username'));
		$this->db->set('cdate',date('Y-m-d H:i:s'));
		$insertHead = $this->db->insert('tpengirimanpenjualan');

		if($insertHead) {
			for ($i=0; $i < count($this->input->post('no', TRUE)); $i++) {
				if ($this->input->post('jumlah', TRUE)[$i]) {
					$this->db->set('idpengiriman',$id_pengiriman);
					$this->db->set('idpenjualdetail',$this->input->post('idpenjualdetail', TRUE)[$i]);
					$this->db->set('itemid',$this->input->post('itemid', TRUE)[$i]);
					$this->db->set('jumlah',$this->input->post('jumlah', TRUE)[$i]);
					$this->db->set('tipe',$this->input->post('tipe', TRUE)[$i]);
					$this->db->insert('tpengirimanpenjualandetail');
				}
			}
			$data['status'] = 'success';
			$data['message'] = 'Berhasil Menyimpan Data';
		}else{
			$data['status'] = 'error';
			$data['message'] = 'Gagal Menyimpan Data';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$id = $this->uri->segment(3);

		$query_jurnal= $this->db->query("SELECT * FROM tjurnalpenjualan WHERE refid='$id'");
        $cek_jurnal = 0;
        if ($query_jurnal->num_rows() > 0){
        	foreach ($query_jurnal->result() as $row10) {
        		$cek_jurnal = $cek_jurnal + 1;
        	}
        }

        if ($cek_jurnal == '1'){
        	$kirimjual = get_by_id('id',$id,'tpengirimanpenjualan');
			$pemesananid = $kirimjual['pemesananid'];
			$gudangid = $kirimjual['gudangid'];

			$query_pengjualdetail= $this->db->query("SELECT * FROM tpengirimanpenjualandetail WHERE idpengiriman='$id'");
	        if ($query_pengjualdetail->num_rows() > 0){
	        	foreach ($query_pengjualdetail->result() as $row) {
	        		$idpenjualdetail = $row->idpenjualdetail;
	        		$jumlah = $row->jumlah;
					$query_pemjualdetail= $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE id='$idpenjualdetail'");
	        		if ($query_pemjualdetail->num_rows() > 0){
	        			foreach ($query_pemjualdetail->result() as $row1) {
	        				$hasil_baru_jt = $row1->jumlahditerima - $jumlah;
	        				$hasil_baru_js = $row1->jumlahsisa + $jumlah;

	        				$this->db->set('jumlahditerima',$hasil_baru_jt);
	        				$this->db->set('jumlahsisa',$hasil_baru_js);
	        				if ($hasil_baru_js == 0){
        					$this->db->set('status','3');
	        				}else if ($row1->jumlah == $hasil_baru_js){
	        					$this->db->set('status','4');
	        				}else{
	        					$this->db->set('status','2');
	        				}
							$this->db->where('id', $idpenjualdetail);
							$this->db->update('tpemesananpenjualandetail');
	        			}
	        		}

	        		if ($row->tipe == 'barang'){
	        			$itemid = $row->itemid;
	        			$query_stokmasuk= $this->db->query("SELECT * FROM tstokmasuk WHERE itemid='$itemid' AND gudangid='$gudangid'");
		        		if ($query_stokmasuk->num_rows() > 0){
		        			foreach ($query_stokmasuk->result() as $row2) {
		        				$hasil_keluar = $row2->keluar - $jumlah;
		        				$hasil_sisa = $row2->sisa + $jumlah;
		        				$this->db->set('keluar',$hasil_keluar);
		        				$this->db->set('sisa',$hasil_sisa);
								$this->db->where('itemid', $itemid);
								$this->db->where('gudangid', $gudangid);
								$this->db->update('tstokmasuk');
		        			}
		        		}
	        		}        		

	        	}
	        }

	        $query_pesanjual= $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE idpemesanan='$pemesananid'");
	        $total_sisa = 0;
	        $total_jumlah = 0;
	        if ($query_pesanjual->num_rows() > 0){
	        	foreach ($query_pesanjual->result() as $row3) {
	        		$total_jumlah = $total_jumlah + $row3->jumlah;
	        		$total_sisa = $total_sisa + $row3->jumlahsisa;
	        	}
	        	if ($total_sisa == 0){
		        	$this->db->set('status','3');
					$this->db->where('id', $pemesananid);
					$update = $this->db->update('tpemesananpenjualan');
		        }else if ($total_sisa < $total_jumlah){
		        	$this->db->set('status','2');
					$this->db->where('id', $pemesananid);
					$update = $this->db->update('tpemesananpenjualan');
		        }else{
		        	$this->db->set('status','1');
					$this->db->where('id', $pemesananid);
					$update = $this->db->update('tpemesananpenjualan');
		        }

	        }

			$jurnalid = get_by_id('refid',$id,'tjurnalpenjualan');
			$this->db->where('id', $jurnalid['id']);
			$this->db->delete('tjurnalpenjualan');

			$this->db->where('idjurnal', $jurnalid['id']);
			$this->db->delete('tjurnalpenjualandetail');

			$this->db->where('refid', $id);
			$this->db->delete('tstokkeluar');
        }

		$this->db->where('idpengiriman', $id);
		$this->db->delete('tpengirimanpenjualandetail');

		$this->db->where('id', $id);
		$delete = $this->db->delete('tpengirimanpenjualan');

		if($delete) {
			$data['status'] = 'success';
			$data['message'] = 'Berhasil menghapus data';
		} else {
			$data['status'] = 'error';
			$data['message'] = 'Gagal menghapus data';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function cekjumlahinput() {
		$itemid = $this->input->post('itemid', TRUE);
		$idpemesanan = $this->input->post('idpemesanan', TRUE);
		if($itemid && $idpemesanan) {
			$this->db->select('jumlahsisa');
			$this->db->where('idpemesanan', $idpemesanan);
			$this->db->where('itemid', $itemid);
			$row = $this->db->get('tpemesananpenjualandetail', 1)->row_array();
			$data['jumlahsisa'] = $row['jumlahsisa'];
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function getpengiriman($id) {
		$this->db->select('tpengirimanpenjualan.*, tpemesananpenjualan.kontakid, tpemesananpenjualan.gudangid, mkontak.nama as kontak, mkontak.alamat, mkontak.cp');
		$this->db->where('tpengirimanpenjualan.id', $id);
		$this->db->join('tpemesananpenjualan', 'tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id', 'left');
		$this->db->join('mkontak', 'tpengirimanpenjualan.kontakid = mkontak.id', 'left');
		$get = $this->db->get('tpengirimanpenjualan',1);
		return $get->row_array();
	}

	public function pengirimandetail($idpengiriman) {
		$this->db->select('tpengirimanpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, msatuan.nama as satuan, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as lain_lain');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$this->db->join('tpengirimanpenjualan', 'tpengirimanpenjualandetail.idpengiriman = tpengirimanpenjualan.id');
		$this->db->join('mnoakun', 'tpengirimanpenjualandetail.itemid = mnoakun.idakun');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $idpengiriman);
		$get = $this->db->get('tpengirimanpenjualandetail');
		return $get->result_array();
	}

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesananpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as lain_lain,  tstokmasuk.sisa as sisastok');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpemesananpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->join('tstokmasuk', 'tpemesananpenjualandetail.itemid = tstokmasuk.itemid', 'left');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $idpemesanan);
		$this->db->where('tpemesananpenjualandetail.status !=', '3');
		$get = $this->db->get('tpemesananpenjualandetail');
		return $get->result_array();
	}
}

