<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SistemPenomoran extends User_Controller {

	private $title	= 'Sistem Penomoran';

	public function __construct() {
		parent::__construct();
		
	}

	public function index()
	{
		$data['title']		= $this->title;
		$data['subtitle']	= 'Daftar';
		$data['content']	= 'SistemPenomoran/index';
		$data				= array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

}