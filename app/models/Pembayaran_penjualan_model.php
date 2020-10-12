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


class Pembayaran_penjualan_model extends CI_Model {


	public function save_memo() {
		$fakturid = $this->input->post('fakturid', TRUE);
		$faktur = get_by_id('id',$fakturid,'tfaktur');
		$kontak = get_by_id('id',$faktur['kontakid'],'mkontak');
		if($kontak['tipe'] == '1') {
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('fakturid',$this->input->post('fakturid', TRUE));
			$this->db->set('totaldibayar',remove_comma($this->input->post('totaldibayar', TRUE)));
			$this->db->set('carabayarid',1);
			$this->db->set('noakunbayar',$kontak['noakunpiutang']);
			$this->db->set('tipe','1');
			$this->db->set('tipebayar','2');
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tpembayaran');
			if($insertHead) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			}
		} else {
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('fakturid',$this->input->post('fakturid', TRUE));
			$this->db->set('totaldibayar',remove_comma($this->input->post('totaldibayar', TRUE)));
			$this->db->set('carabayarid',1);
			$this->db->set('noakunbayar',$kontak['noakunutang']);
			$this->db->set('tipe','2');
			$this->db->set('tipebayar','2');
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tpembayaran');
			if($insertHead) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			}
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function save() {
		$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
		$this->db->set('fakturid',$this->input->post('fakturid', TRUE));
		$this->db->set('totaldibayar',remove_comma($this->input->post('totaldibayar', TRUE)));
		$this->db->set('carabayarid',1);
		$this->db->set('noakunbayar',$this->input->post('noakunbayar', TRUE));
		$this->db->set('tipe','2');
		$this->db->set('catatan',$this->input->post('catatan', TRUE));
		$this->db->set('cby',get_user('username'));
		$this->db->set('cdate',date('Y-m-d H:i:s'));
		$insertHead = $this->db->insert('tpembayaran');
		if($insertHead) {
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getpembayaran($idpembayaran) {
		$this->db->select('tpembayaran.notrans as nopay, tfaktur.*, mkontak.nama as kontak, mgudang.nama as gudang, tpembayaran.id as idpembayaran');
		$this->db->join('tfaktur', 'tpembayaran.fakturid = tfaktur.id', 'left');
		$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id', 'left');
		$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
		$this->db->where('tpembayaran.id', $idpembayaran);
		$get = $this->db->get('tpembayaran');
		return $get->row_array();
	}

	public function getfaktur_($id) {
		$this->db->select('mkontak.nama as kontak, tfaktur.*, mgudang.nama as gudang, tpembayaran.id as idpembayaran');
		$this->db->join('mkontak', 'tpembayaran.kontakid = mkontak.id', 'left');
		$this->db->join('tfaktur', 'tpembayaran.fakturid = tfaktur.id', 'left');
		$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
		$this->db->where('tpembayaran.id', $id);
		$get = $this->db->get('tpembayaran');
		return $get->row_array();
	}

	public function getfaktur($idfaktur) {
		$this->db->select('tfaktur.*, mkontak.nama as kontak, mgudang.nama as gudang');
		$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id', 'left');
		$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
		$this->db->where('tfaktur.id', $idfaktur);
		$get = $this->db->get('tfaktur');
		return $get->row_array();
	}

	public function getfakturdetail($idfaktur) {
		$this->db->select('tfakturdetail.*, mitem.nama as item');
		$this->db->join('mitem', 'tfakturdetail.itemid = mitem.id', 'left');
		$this->db->where('tfakturdetail.idfaktur', $idfaktur);
		$get = $this->db->get('tfakturdetail');
		return $get->result_array();
	}

	public function gettotalkreditmemo($kontakid) {
		$this->db->select('SUM(debet-kredit) as nominal');
		$this->db->where('kontakid', $kontakid);
		$get = $this->db->get('tmemo');
		return $get->row()->nominal;
	}
}

