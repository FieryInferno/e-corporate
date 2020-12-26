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


class Laporan_stok_model extends CI_Model {

	public function laporan_stok_detail() {
		$itemid = $this->input->get('itemid');
		if($itemid) {
			$tanggalawal = $this->input->get('tanggalawal');
			$tanggalakhir = $this->input->get('tanggalakhir');
			$kontakid = $this->input->get('kontakid');
			$gudangid = $this->input->get('gudangid');
			$status = $this->input->get('status');

			if(!$tanggalawal && !$tanggalakhir) {
				$tanggalawal = date('Y-m-01');
				$tanggalakhir = date('Y-m-t');
			}

			$this->db->select("
				tfaktur.id,
				tfaktur.tanggal,
				tfaktur.notrans as nofaktur,
				case when tpengiriman.statusauto = '1' then '-' else tpengiriman.notrans end as nopengiriman,
				case when tpengiriman.statusauto = '1' then '-' else tpemesanan.notrans end as nopemesanan,
				'1' as countdetail,
				mkontak.nama as kontak,
				mgudang.nama as gudang,
			");
			$this->db->where('tfaktur.tanggal >=', $tanggalawal);
			$this->db->where('tfaktur.tanggal <=', $tanggalakhir);
			if($itemid) $this->db->where('tfakturdetail.itemid', $itemid);
			if($kontakid) $this->db->where('tfaktur.kontakid', $kontakid);
			if($gudangid) $this->db->where('tfaktur.gudangid', $gudangid);
			if($status) $this->db->where('tfaktur.status', $status);
			$this->db->where('tfaktur.tipe', '1');
			$this->db->join('tfaktur', 'tfakturdetail.idfaktur = tfaktur.id');
			$this->db->join('tpengiriman', 'tfaktur.pengirimanid = tpengiriman.id', 'left');
			$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
			$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id', 'left');
			$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
			$this->db->order_by('tfaktur.id', 'desc');
			$get = $this->db->get('tfakturdetail');
			return $get->result_array();
		} else {
			$tanggalawal = $this->input->get('tanggalawal');
			$tanggalakhir = $this->input->get('tanggalakhir');
			$kontakid = $this->input->get('kontakid');
			$gudangid = $this->input->get('gudangid');
			$status = $this->input->get('status');

			if(!$tanggalawal && !$tanggalakhir) {
				$tanggalawal = date('Y-m-01');
				$tanggalakhir = date('Y-m-t');
			}

			$this->db->select("
				tfaktur.id,
				tfaktur.tanggal,
				tfaktur.notrans as nofaktur,
				case when tpengiriman.statusauto = '1' then '-' else tpengiriman.notrans end as nopengiriman,
				case when tpengiriman.statusauto = '1' then '-' else tpemesanan.notrans end as nopemesanan,
				(select count(*) from tfakturdetail where idfaktur = tfaktur.id) as countdetail,
				mkontak.nama as kontak,
				mgudang.nama as gudang,
			");
			$this->db->where('tfaktur.tanggal >=', $tanggalawal);
			$this->db->where('tfaktur.tanggal <=', $tanggalakhir);
			if($kontakid) $this->db->where('tfaktur.kontakid', $kontakid);
			if($gudangid) $this->db->where('tfaktur.gudangid', $gudangid);
			if($status) $this->db->where('tfaktur.status', $status);
			$this->db->where('tfaktur.tipe', '1');
			$this->db->join('tpengiriman', 'tfaktur.pengirimanid = tpengiriman.id', 'left');
			$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
			$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id', 'left');
			$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
			$this->db->order_by('tfaktur.id', 'desc');
			$get = $this->db->get('tfaktur');
			return $get->result_array();
		}
	}

	public function get_faktur_pembelian_detail($idfaktur) {
		$this->db->select('tfakturdetail.*, mitem.nama as item, msatuan.nama as satuan');
		$this->db->where('idfaktur', $idfaktur);
		$this->db->join('mitem', 'tfakturdetail.itemid = mitem.id', 'left');
		$this->db->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$get = $this->db->get('tfakturdetail');
		return $get->result_array();
	}

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tpemesanan');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tpemesanan');
			if($insert) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('save_error_message');
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$id = $this->uri->segment(3);
		$this->db->set('stdel','1');
		$this->db->where('id', $id);
		$update = $this->db->update('tpemesanan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}