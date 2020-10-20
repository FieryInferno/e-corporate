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
		if($statusauto == '0') {
			$this->db->set('notrans',$this->input->post('notrans', TRUE));
			$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('tanggaltempo',$this->input->post('tanggalJT', TRUE));
			$this->db->set('rekening',$this->input->post('rekening', TRUE));
			$this->db->set('pengirimanid',$this->input->post('pengirimanid', TRUE));
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('carabayar',$this->input->post('carabayar', TRUE));
			$this->db->set('tipe','2');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tfakturpenjualan');
			if($insertHead) {
				$this->db->set('validasi','2');
				$this->db->where('id',$this->input->post('pengirimanid',TRUE));
				$this->db->update('tpengirimanpenjualan');
				$data['status'] = 'success';
				$data['message'] = "Data berhasil disimpan.";
			}else{
				$data['status'] = 'error';
				$data['message'] = "Data gagal disimpan.";
			}	
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function update() {
		$id = $this->input->post('fakturid');
		$faktur = get_by_id('id',$id,'tfakturpenjualan');
 		
 		$this->db->set('validasi','1');
		$this->db->where('id',$faktur['pengirimanid']);
		$this->db->update('tpengirimanpenjualan');

 		$this->db->where('idfaktur', $id);
		$this->db->delete('tfakturpenjualandetail');

		$this->db->where('id', $id);
		$delete = $this->db->delete('tfakturpenjualan');

		$statusauto = $this->input->post('statusauto', TRUE);
		if($statusauto == '0') {
			$this->db->set('notrans',$this->input->post('notrans', TRUE));
			$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('tanggaltempo',$this->input->post('tanggalJT', TRUE));
			$this->db->set('rekening',$this->input->post('rekening', TRUE));
			$this->db->set('pengirimanid',$this->input->post('pengirimanid', TRUE));
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('carabayar',$this->input->post('carabayar', TRUE));
			$this->db->set('tipe','2');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tfakturpenjualan');
			if($insertHead) {
				$this->db->set('validasi','2');
				$this->db->where('id',$this->input->post('pengirimanid',TRUE));
				$this->db->update('tpengirimanpenjualan');
				$data['status'] = 'success';
				$data['message'] = "Data berhasil diupdate.";
			}else{
				$data['status'] = 'error';
				$data['message'] = "Data gagal diupdate.";
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
        $this->db->select('tpengirimanpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as jasa,  CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as inventeris');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpengirimanpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $pengirimanid);
		$query = $this->db->get('tpengirimanpenjualandetail');
		return $query;
    }

    function get_detail_budgetevent($pemesananid){
        $this->db->select('tbudgetevent.*, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as budgetevent');
		$this->db->join('mnoakun', 'tbudgetevent.idbudgetevent = mnoakun.idakun', 'left');
		$this->db->where('tbudgetevent.idpemesanan', $pemesananid);
		$query = $this->db->get('tbudgetevent');
		return $query;
    }

    public function delete() {
		$id = $this->uri->segment(3);
		$faktur = get_by_id('id',$id,'tfakturpenjualan');

		$this->db->where('id', $id);
		$delete = $this->db->delete('tfakturpenjualan');
		if($delete) {
			$this->db->where('idfaktur', $id);
			$this->db->delete('tfakturpenjualandetail');

			$this->db->set('validasi','1');
			$this->db->where('id', $faktur['pengirimanid']);
			$this->db->update('tpengirimanpenjualan');

			$data['status'] = 'success';
			$data['message'] = 'Berhasil menghapus data';
		} else {
			$data['status'] = 'error';
			$data['message'] = 'Gagal menghapus data';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

