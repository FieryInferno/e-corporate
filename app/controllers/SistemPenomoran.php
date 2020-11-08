<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SistemPenomoran extends User_Controller {

	private $title	= 'Sistem Penomoran';
	private $formulir;
	private $formatPenomoran;
	private $idPenomoran;

	public function __construct() {
		parent::__construct();
		$this->formulir			= $this->input->post('formulir');
		$this->formatPenomoran	= $this->input->post('formatPenomoran');
		$this->idPenomoran		= $this->input->post('idPenomoran');
	}

	public function index()
	{
		$data['title']		= $this->title;
		$data['subtitle']	= 'Daftar';
		$data['content']	= 'SistemPenomoran/index';
		$data				= array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function create()
	{
		$data['title']		= $this->title;
		$data['subtitle']	= 'Tambah';
		$data['content']	= 'SistemPenomoran/create';
		$data				= array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function save()
	{
		if ($this->idPenomoran) {
			$this->SistemPenomoranModel->set('idPenomoran', $this->idPenomoran);
		}
		$this->SistemPenomoranModel->set('formulir', $this->formulir);
		$this->SistemPenomoranModel->set('formatPenomoran', $this->formatPenomoran);
		$this->SistemPenomoranModel->save();
		$data['status']		= 'success';
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function indexDatatable()
	{
		$data	= $this->SistemPenomoranModel->indexDatatable();
		return print_r($data);
	}

	public function edit()
	{
		$this->SistemPenomoranModel->set('idPenomoran', $this->idPenomoran);
		$data				= $this->SistemPenomoranModel->get();
		$data['title']		= $this->title;
		$data['subtitle']	= 'Edit';
		$data['content']	= 'SistemPenomoran/edit';
		$data				= array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function delete($idPenomoran)
	{
		$this->SistemPenomoranModel->set('idPenomoran', $idPenomoran);
		$this->SistemPenomoranModel->delete();
		$data['status']		= 'success';
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}