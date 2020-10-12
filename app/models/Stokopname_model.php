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


class Stokopname_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tstokopname');
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
			$insert = $this->db->insert('tstokopname');
			if($insert) {
				// $lastid = $this->db->insert_id();
				// $selisih = $this->input->post('selisih');
				// if($selisih < 0) {
				// 	$this->db->set('gudangid',$this->input->post('gudangid'));
				// 	$this->db->set('tanggalkeluar',$this->input->post('tanggal'));
				// 	$this->db->set('itemid',$this->input->post('itemid'));
				// 	$this->db->set('jumlah',abs($this->input->post('selisih')));
				// 	$this->db->set('totalharga',0);
				// 	$this->db->set('refid',$lastid);
				// 	$this->db->set('tipe','3');
				// 	$insertstok = $this->db->insert('tstokkeluar');
				// 	if($insertstok) {
				// 		$data['status'] = 'success';
				// 		$data['message'] = lang('save_success_message');
				// 	}
				// }

				// if($selisih > 0) {
				// 	$this->db->set('gudangid',$this->input->post('gudangid'));
				// 	$this->db->set('tanggalmasuk',$this->input->post('tanggal'));
				// 	$this->db->set('itemid',$this->input->post('itemid'));
				// 	$this->db->set('jumlah',abs($this->input->post('selisih')));
				// 	$this->db->set('totalharga',0);
				// 	$this->db->set('refid',$lastid);
				// 	$this->db->set('tipe','3');
				// 	$insertstok = $this->db->insert('tstokkeluar');
				// 	if($insertstok) {
				// 		$data['status'] = 'success';
				// 		$data['message'] = lang('save_success_message');
				// 	}
				// }
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
		$update = $this->db->update('tstokopname');
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

