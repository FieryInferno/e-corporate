<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekanan_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_pegawai('id'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('mrekanan');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('cby',get_pegawai('id'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('mrekanan');
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
		$this->db->set('del','1');
		$this->db->where('id', $id);
		$update = $this->db->update('mrekanan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2($perusahaan, $id)
	{
		$this->db->select('mkontak.id, mkontak.nama as text');
		if ($id) {
			$this->db->where('mkontak.id', $id);
		}
		$data	= $this->db->get_where('mkontak', [
			'perusahaan'	=> $perusahaan
		]);
		if ($id) {
			return $data->row_array();
		} else {
			return $data->result_array();
		}
	}
}