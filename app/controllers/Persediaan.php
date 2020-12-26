<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Persediaan extends User_Controller {

	public function index()
	{
		$data['title']      = 'Persediaan';
		$data['content']    = 'Persediaan/index';	
		$perusahaan			= $this->session->idperusahaan;
		$data['persediaan']	= $this->PersediaanModel->get($perusahaan);
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}
}