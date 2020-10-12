<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_model extends CI_Model {

	public function save() {

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']  = '50';
		$config['encrypt_name']  = true;
		
		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		
		if ( $this->upload->do_upload('logo') ){

			$logo = $this->db->get_where('mpengaturan', array('key' => 'logo') )->row()->value;
			if($logo) unlink(FCPATH . '/uploads/'.$logo);

			$dataimg = $this->upload->data();
			$this->db->where('key', 'logo');
			$this->db->set('value',$dataimg['file_name']);
			$this->db->update('mpengaturan');
		}

		if ( $this->upload->do_upload('logo_login') ){

			$logo = $this->db->get_where('mpengaturan', array('key' => 'logo_login') )->row()->value;
			if($logo) unlink(FCPATH . '/uploads/'.$logo);

			$dataimg = $this->upload->data();
			$this->db->where('key', 'logo_login');
			$this->db->set('value',$dataimg['file_name']);
			$this->db->update('mpengaturan');
		}

		$this->db->where('key', 'app_name');
		$this->db->set('value',$this->input->post('app_name'));
		$this->db->update('mpengaturan');

		$this->db->where('key', 'language');
		$this->db->set('value',$this->input->post('language'));
		$this->db->update('mpengaturan');


		$data['status'] = 'success';
		$data['message'] = lang('success_save');

		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	

}