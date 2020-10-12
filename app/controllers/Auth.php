<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model','model');
		$this->load->library('ian_user');
	}

	public function login() {
		if($this->ian_user->is_user()) redirect('Dashboard');
		$data['title'] = lang('login');
		$data = array_merge($data,path_info());
		$this->parser->parse('Auth/login', $data);
	}

	public function dologin() {
		if($this->ian_user->is_user()) redirect('Dashboard');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('username', lang('username'), 'trim|required');
		$this->form_validation->set_rules('password', lang('password'), 'trim|required');
		if($this->form_validation->run() === true) {
			$login = $this->model->login($this->input->post('username'), $this->input->post('password'));
			if($login) {
				redirect('Dashboard');
			} else {
				$this->session->set_flashdata('error', lang('error_login') );
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('error', lang('error_login') );
			redirect('auth/login');
		}
	}

	public function logout() {
		$this->session->unset_userdata('userid');
		redirect('auth/login');
	}

}