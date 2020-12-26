<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan extends User_Controller {

	public function __construct()
	{
		parent::__construct();
		if(get_user('permissionid') == '2') redirect('Forbidden','refresh');
		$this->load->model('Pengaturan_model','model');
	}

	public function index() {
		$data['title'] = lang('settings');
		$data['subtitle'] = lang('form');
		$data['content'] = 'Pengaturan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function save() {
		$this->model->save();
	}

}