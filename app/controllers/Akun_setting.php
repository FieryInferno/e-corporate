<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_setting extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Akun_setting_model','model');
	}

	public function index() {
		$id = get_pegawai('id');
		$data = get_by_id('id',$id,'z_user');
		$data['title'] = 'User';
		$data['subtitle'] = 'Edit User';
		$data['content'] = 'Akun_setting/edit';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function save() {
		$this->model->save();
	}
	public function change_password() {
		$this->model->change_password();
	}

	public function select2_permissionid($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('z_userpermission.id, z_userpermission.name as text');
			$data = $this->db->where('id', $id)->get('z_userpermission')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('z_userpermission.id, z_userpermission.name as text');
			$this->db->where('z_userpermission.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('z_userpermission', $term);
			$data = $this->db->get('z_userpermission')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

}