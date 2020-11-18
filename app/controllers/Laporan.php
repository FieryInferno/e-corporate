<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends User_Controller {

	public function __construct() {
		parent::__construct();
		
	}

	public function kasBank() {
		$data['title']		= 'Laporan Kas Bank';
		$data['subtitle']	= lang('list');
		$data['content']	= 'laporan/kasBank/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
}