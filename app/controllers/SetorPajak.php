<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajak extends User_Controller {

	private $idPajakPemesananPenjualan;
	private $title	= 'Setor Pajak';

	public function __construct()
	{
		parent::__construct();
		$this->idPajakPemesananPenjualan = $this->input->post('idPajakPemesananPenjualan');
	}

	public function index()
	{
		$data['title']      = $this->title;
		$data['content']    = 'SetorPajak/index';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}
	
	public function indexDatatables()
	{
		$data	= $this->SetorPajakModel->indexDatatables();
		return print_r($data);
	}

	public function detail()
	{
		$this->SetorPajakModel->set('idPajakPemesananPenjualan', $this->idPajakPemesananPenjualan);	
		$data				= $this->SetorPajakModel->get();
		$data['title']      = $this->title;
		$data['content']    = 'SetorPajak/detail';
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}
}