<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('Ian_user');
		if(!$this->ian_user->is_user()) redirect('Auth/login');

		if(!permission_access($this->uri->segment(1))) redirect('Forbidden');

		$language = get_setting('language');
		if($language == 'english') $this->lang->load('general', 'english');
		else $this->lang->load('general', 'indonesian');
	}

}

class User_Controller extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->load->library('Ian_user');
		if(!$this->ian_user->is_user()) redirect('Auth/login');

		// if(!permission_access($this->uri->segment(1))) redirect('Forbidden');

		// $language = get_setting('language');
		// if($language == 'english') $this->lang->load('general', 'english');
		// else $this->lang->load('general', 'indonesian');
	}

}