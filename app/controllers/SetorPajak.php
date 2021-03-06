<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajak extends User_Controller {

	private $idPajakPemesananPenjualan;
	private $title	= 'Setor Pajak';
	private $perusahaan;
	private $tanggal;
	private $npwp;
	private $ntpn;

	public function __construct()
	{
		parent::__construct();
		$this->idPajakPemesananPenjualan	= $this->input->post('idPajakPemesananPenjualan');
		$this->jenis						= $this->input->post('jenis');
		$this->npwp							= $this->input->post('npwp');
		$this->ntpn							= $this->input->post('ntpn');
		$this->perusahaan					= $this->input->post('perusahaan');
		$this->tanggal						= $this->input->post('tanggal');
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
		$this->SetorPajakModel->set('perusahaan', $this->perusahaan);
		$data				= $this->SetorPajakModel->get();
		$data['title']      = $this->title;
		$data['content']    = 'SetorPajak/detail';
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function get()
	{
		$this->SetorPajakModel->set('idPajakPemesananPenjualan', $this->idPajakPemesananPenjualan);
		$this->SetorPajakModel->set('jenis', $this->jenis);
		$this->SetorPajakModel->set('perusahaan', $this->perusahaan);
		$this->SetorPajakModel->set('tanggal', $this->tanggal);
		$data	= $this->SetorPajakModel->get();
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update()
	{
		$this->SetorPajakModel->set('idPajakPemesananPenjualan', $this->idPajakPemesananPenjualan);
		$this->SetorPajakModel->set('npwp', $this->npwp);
		$this->SetorPajakModel->set('ntpn', $this->ntpn);
		$this->SetorPajakModel->update();
	}
}