<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetUpJurnal extends User_Controller {

	public function index()
	{
		$data['title']      = 'Set Up Jurnal';
		$data['content']    = 'SetUpJurnal/index';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
    }
    
    public function tambah()
    {
        $data['title']      = 'Set Up Jurnal';
        $data['subtitle']   = 'Tambah';
		$data['content']    = 'SetUpJurnal/tambah';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
    }

}