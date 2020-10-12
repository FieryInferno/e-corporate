<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Metaakun_model extends CI_Model {

	public function save() {
		foreach($this->input->post() as $key => $val) {
			$this->db->set('noakun',strip_tags($val));
			$this->db->where('katakunci', $key);
			$this->db->update('mnoakunpengaturan');
		}

		$data['status'] = 'success';
		$data['message'] = 'update_success_message';
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}