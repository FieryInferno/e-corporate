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


class Laporan_retur_pembelian_model extends CI_Model {

	public function get_retur_pembelian() {
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
				tretur.id,
				tretur.tanggal,
				tretur.notrans as noretur,
				tfaktur.notrans as nofaktur,
				case when tpengiriman.statusauto = '1' then '-' else tpengiriman.notrans end as nopengiriman,
				case when tpengiriman.statusauto = '1' then '-' else tpemesanan.notrans end as nopemesanan,
				'1' as countdetail,
				mkontak.nama as kontak,
				mgudang.nama as gudang,
			");
			$this->db->where('tretur.tanggal >=', $tanggalawal);
			$this->db->where('tretur.tanggal <=', $tanggalakhir);
			if($itemid) $this->db->where('treturdetail.itemid', $itemid);
			if($kontakid) $this->db->where('tretur.kontakid', $kontakid);
			if($gudangid) $this->db->where('tretur.gudangid', $gudangid);
			$this->db->where('tretur.tipe', $status);
			$this->db->join('tretur', 'treturdetail.idretur = tretur.id');
			$this->db->join('tfaktur', 'tretur.fakturid = tfaktur.id', 'left');
			$this->db->join('tpengiriman', 'tfaktur.pengirimanid = tpengiriman.id', 'left');
			$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
			$this->db->join('mkontak', 'tretur.kontakid = mkontak.id', 'left');
			$this->db->join('mgudang', 'tretur.gudangid = mgudang.id', 'left');
			$this->db->order_by('tretur.id', 'desc');
			$get = $this->db->get('treturdetail');
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
				tretur.id,
				tretur.tanggal,
				tretur.notrans as noretur,
				tfaktur.notrans as nofaktur,
				case when tpengiriman.statusauto = '1' then '-' else tpengiriman.notrans end as nopengiriman,
				case when tpengiriman.statusauto = '1' then '-' else tpemesanan.notrans end as nopemesanan,
				(select count(*) from treturdetail where idretur = tretur.id) as countdetail,
				mkontak.nama as kontak,
				mgudang.nama as gudang,
			");
			$this->db->where('tretur.tanggal >=', $tanggalawal);
			$this->db->where('tretur.tanggal <=', $tanggalakhir);
			if($kontakid) $this->db->where('tretur.kontakid', $kontakid);
			if($gudangid) $this->db->where('tretur.gudangid', $gudangid);
			$this->db->where('tretur.tipe', $status);
			$this->db->join('tfaktur', 'tretur.fakturid = tfaktur.id', 'left');
			$this->db->join('tpengiriman', 'tfaktur.pengirimanid = tpengiriman.id', 'left');
			$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
			$this->db->join('mkontak', 'tretur.kontakid = mkontak.id', 'left');
			$this->db->join('mgudang', 'tretur.gudangid = mgudang.id', 'left');
			$this->db->order_by('tretur.id', 'desc');
			$get = $this->db->get('tretur');
			return $get->result_array();
		}
	}

	public function get_retur_pembelian_detail($idretur) {
		$this->db->select('treturdetail.*, mitem.nama as item, msatuan.nama as satuan');
		$this->db->where('idretur', $idretur);
		$this->db->join('mitem', 'treturdetail.itemid = mitem.id', 'left');
		$this->db->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$get = $this->db->get('treturdetail');
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

