<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Forbidden extends User_Controller {

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$data['title'] = lang('dashboard');
		$data['content'] = 'Forbidden/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

}