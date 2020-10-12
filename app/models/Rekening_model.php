<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
            foreach($this->input->post() as $key => $val) 
            $this->db->set($key,strip_tags($val));
			// // $this->db->set('kode','kode');
			// $this->db->set('uby',get_user('username'));
			// $this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('mrekening');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
            foreach($this->input->post() as $key => $val) 
            $this->db->set($key,strip_tags($val));
			$this->db->set('stdel','0');
			$insert = $this->db->insert('mrekening');
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
		// $this->db->set('dby',get_user('username'));
		// $this->db->set('ddate',date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$update = $this->db->update('mrekening');
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

