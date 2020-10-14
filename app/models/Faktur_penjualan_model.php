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


class Faktur_penjualan_model extends CI_Model {

	public function save() {
		$notrans = $this->input->post('notrans', TRUE);
		$ceknotrans = get_by_id('notrans',$notrans,'tfakturpenjualan');
		if($ceknotrans) {
			$data['status'] = 'error';
			$data['message'] = 'Kode sudah ada';
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		$statusauto = $this->input->post('statusauto', TRUE);
		if($statusauto == '1') {
			$pemesananid = $this->input->post('pemesananid', TRUE);
			if($pemesananid) {
				$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
				$this->db->set('pemesananid',$this->input->post('pemesananid', TRUE));
				$this->db->set('tipe','2');
				$this->db->set('statusauto','1');
				$this->db->set('catatan','-');
				$this->db->set('cby',get_user('username'));
				$this->db->set('cdate',date('Y-m-d H:i:s'));
				$insertHead = $this->db->insert('tpengirimanpenjualan');
				if($insertHead) {
					$idpengiriman = $this->db->insert_id();
					for ($i=0; $i < count($this->input->post('no', TRUE)); $i++) {
						$this->db->set('idpengiriman',$idpengiriman);
						$this->db->set('itemid',$this->input->post('itemid', TRUE)[$i]);
						$this->db->set('jumlah',remove_comma($this->input->post('jumlah', TRUE)[$i]));
						$this->db->insert('tpengirimanpenjualandetail');
					}
					$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
					$this->db->set('pengirimanid',$idpengiriman);
					$this->db->set('tipe','2');
					$this->db->set('catatan',$this->input->post('catatan', TRUE));
					$this->db->set('cby',get_user('username'));
					$this->db->set('cdate',date('Y-m-d H:i:s'));
					$insertHead = $this->db->insert('tfakturpenjualan');
					if($insertHead) {
						$data['status'] = 'success';
						$data['message'] = lang('save_success_message');
						return $this->output->set_content_type('application/json')->set_output(json_encode($data));
					}
				}
			} else {
				$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
				$this->db->set('kontakid',$this->input->post('kontakid', TRUE));
				$this->db->set('gudangid',$this->input->post('gudangid', TRUE));
				$this->db->set('tipe','2');
				$this->db->set('statusauto','1');
				$this->db->set('catatan','-');
				$this->db->set('cby',get_user('username'));
				$this->db->set('cdate',date('Y-m-d H:i:s'));
				$insertHead = $this->db->insert('tpengirimanpenjualan');
				if($insertHead) {
					$idpengiriman = $this->db->insert_id();
					$detail_array = $this->input->post('detail_array');
					$detail_array = json_decode($detail_array);
					foreach($detail_array as $row) {
						$this->db->set('idpengiriman',$idpengiriman);
						$this->db->set('itemid',$row[0]);
						$this->db->set('harga',remove_comma($row[2]));
						$this->db->set('jumlah',remove_comma($row[3]));
						$this->db->set('diskon',remove_comma($row[5]));
						$this->db->set('ppn',remove_comma($row[6]));
						$this->db->insert('tpengirimanpenjualandetail');
					}

					$this->db->set('notrans',$this->input->post('notrans', TRUE));
					$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
					$this->db->set('pengirimanid',$idpengiriman);
					$this->db->set('tipe','2');
					$this->db->set('catatan',$this->input->post('catatan', TRUE));
					$this->db->set('cby',get_user('username'));
					$this->db->set('cdate',date('Y-m-d H:i:s'));
					$insertHead = $this->db->insert('tfakturpenjualan');
					if($insertHead) {
						$data['status'] = 'success';
						$data['message'] = lang('save_success_message');
						return $this->output->set_content_type('application/json')->set_output(json_encode($data));
					}
				}
			}
		} else {
			$this->db->set('notrans',$this->input->post('notrans', TRUE));
			$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('tanggaltempo',$this->input->post('tanggalJT', TRUE));
			$this->db->set('pengirimanid',$this->input->post('pengirimanid', TRUE));
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('carabayar',$this->input->post('carabayar', TRUE));
			$this->db->set('tipe','2');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tfakturpenjualan');
			if($insertHead) {
				$data['status'] = 'success';
				$data['message'] = "Data berhasil disimpan.";
			}		
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

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesananpenjualandetail.*, mitem.nama as item');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id', 'left');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $idpemesanan);
		$this->db->where('tpemesananpenjualandetail.status !=', '3');
		$get = $this->db->get('tpemesananpenjualandetail');
		return $get->result_array();
	}

	public function pengirimandetail($idpengiriman) {
		$this->db->select('
			tpengirimanpenjualandetail.*, mitem.nama as item
		');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('tpengirimanpenjualan', 'tpengirimanpenjualandetail.idpengiriman = tpengirimanpenjualan.id');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $idpengiriman);
		$get = $this->db->get('tpengirimanpenjualandetail');
		return $get->result_array();
	}

	public function getpemesanan($idpemesanan) {
		$this->db->select('tpemesananpenjualan.kontakid, tpemesananpenjualan.gudangid');
		$this->db->where('id', $idpemesanan);
		$get = $this->db->get('tpemesananpenjualan');
		return $get->row_array();
	}

	public function getfaktur($id) {
		$this->db->select('tfakturpenjualan.*, mkontak.nama as kontak, mkontak.alamat, mkontak.telepon, tpengirimanpenjualan.notrans as nosj');
		$this->db->where('tfakturpenjualan.id', $id);
		$this->db->join('mkontak', 'tfakturpenjualan.kontakid = mkontak.id','left');
		$this->db->join('tpengirimanpenjualan', 'tfakturpenjualan.pengirimanid = tpengirimanpenjualan.id','left');
		$get = $this->db->get('tfakturpenjualan', 1);
		return $get->row_array();
	}

	public function fakturdetail($idfaktur) {
		$this->db->select('tfakturpenjualandetail.*, mitem.nama as item');
		$this->db->where('tfakturpenjualandetail.idfaktur', $idfaktur);
		$this->db->join('mitem', 'tfakturpenjualandetail.itemid = mitem.id', 'left');
		$get = $this->db->get('tfakturpenjualandetail');
		return $get->result_array();
	}

	public function detailitem() {
		$itemid = $this->input->post('itemid', TRUE);
		if($itemid) {
			$this->db->where('id', $itemid);
			$get = $this->db->get('mitem',1);
			$data = $get->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_detail_item() {
		$itemid = $this->input->post('itemid', TRUE);
		if($itemid) {
			$this->db->where('id', $itemid);
			$this->db->where('stdel', '0');
			$data = $this->db->get('mitem', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_stok_item() {
		$itemid = $this->input->post('itemid', TRUE);
		$gudangid = $this->input->post('gudangid', TRUE);
		if($itemid && $gudangid) {
			$this->db->select_sum('sisa','stok');
			$this->db->where('itemid', $itemid);
			$this->db->where('gudangid', $gudangid);
			$data = $this->db->get('tstokmasuk', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function getjumlahsisa($idfaktur) {
		$this->db->select_sum('jumlahsisa','sisa');
		$this->db->where('idfaktur', $idfaktur);
		$get = $this->db->get('tfakturpenjualandetail');
		return $get->row()->sisa;
	}

	function get_data_pengiriman_model($idpengiriman){
		$this->db->select('tpengirimanpenjualan.*,  tpemesananpenjualan.id as pemesananid, tpemesananpenjualan.tanggal as tgl_pemesanan, tpemesananpenjualan.cara_pembayaran as carabayar');
		$this->db->join('tpemesananpenjualan','tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id', 'LEFT');
		$this->db->where('tpengirimanpenjualan.id', $idpengiriman);
		$query = $this->db->get('tpengirimanpenjualan');
        return $query;
    }

    function get_detail_angsuran($id){
        $query = $this->db->get_where('tpemesananpenjualanangsuran', array('idpemesanan' => $id));
        return $query;
    }

    function get_detail_pengiriman($pengirimanid){
        $this->db->select('tpengirimanpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as jasa,  CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as budgetevent');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpengirimanpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $pengirimanid);
		$query = $this->db->get('tpengirimanpenjualandetail');
		return $query;
    }

    public function delete() {
		$id = $this->uri->segment(3);
		$faktur = get_by_id('id',$id,'tfakturpenjualan');
		$query_jurnal= $this->db->query("SELECT * FROM tjurnalpenjualan WHERE refid='$id'");
        $cek_jurnal = 0;
        if ($query_jurnal->num_rows() > 0){
        	foreach ($query_jurnal->result() as $row10) {
        		$cek_jurnal = $cek_jurnal + 1;
        	}
        }

        if ($cek_jurnal == '1'){
			$jurnalid = get_by_id('refid',$id,'tjurnalpenjualan');
			$this->db->where('id', $jurnalid['id']);
			$this->db->delete('tjurnalpenjualan');

			$this->db->where('idjurnal', $jurnalid['id']);
			$this->db->delete('tjurnalpenjualandetail');
        }

        $this->db->set('status','1');
		$this->db->where('id', $faktur['pengirimanid']);
		$this->db->update('tpengirimanpenjualan');

		$this->db->where('idfaktur', $id);
		$this->db->delete('tfakturpenjualandetail');

		$this->db->where('id', $id);
		$delete = $this->db->delete('tfakturpenjualan');

		if($delete) {
			$data['status'] = 'success';
			$data['message'] = 'Berhasil menghapus data';
		} else {
			$data['status'] = 'error';
			$data['message'] = 'Gagal menghapus data';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

