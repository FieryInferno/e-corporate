<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends User_Controller {

	public function index()
	{
		$data['title']      = 'Inventaris';
		$data['content']    = 'Inventaris/index';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
    }
}