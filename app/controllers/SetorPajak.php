<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajak extends User_Controller {

	public function index()
	{
		$data['title']      = 'Setor Pajak';
		$data['content']    = 'SetorPajak/index';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}
	
	public function indexDatatables()
	{
		$data	= $this->SetorPajakModel->indexDatatables();
		return print_r($data);
	}
}