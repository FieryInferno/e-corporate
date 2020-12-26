<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modul_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);

		if($id) {
			$cekposisi = $this->db->get_where('mmodul', array('id' => $id) )->row_array();
			if($cekposisi['posisi'] != $this->input->post('posisi')) {
				$this->_updateposisimodul($cekposisi['posisi'],$this->input->post('posisi'));
			}

			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->where('id', $id);
			$update = $this->db->update('mmodul');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			$cekurl = $this->db->where('url', $this->input->post('url'))->get('mmodul');
			if($cekurl->num_rows() > 0) {
				$data['status'] = 'error';
				$data['message'] = lang('data_already_exists');
				return $this->output->set_content_type('application/json')->set_output(json_encode($data));
			}
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$insert = $this->db->insert('mmodul');
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

	private function _updateposisimodul($old,$new) {
		$call = "CALL pupdateposisimodul('".$old."','".$new."')";
		return $this->db->query($call);
	}

	public function delete() {
		$id = $this->uri->segment(3);

		$this->db->set('stdelete','1');
		$this->db->where('id', $id);
		$update = $this->db->update('mmodul');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function activate() {
		$id = $this->uri->segment(3);

		$this->db->set('staktif','1');
		$this->db->where('id', $id);
		$update = $this->db->update('mmodul');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('save_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function deactivate() {
		$id = $this->uri->segment(3);

		$this->db->set('staktif','0');
		$this->db->where('id', $id);
		$update = $this->db->update('mmodul');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('save_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}