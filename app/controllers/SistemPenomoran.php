<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SistemPenomoran extends User_Controller {

	private $title	= 'Sistem Penomoran';
	private $formulir;
	private $formatPenomoran;
	private $idPenomoran;

	public function __construct() {
		parent::__construct();
		if ($this->input->post('formulir')) {
			$this->formulir	= $this->input->post('formulir');
		} else {
			$this->formulir	= $this->input->get('formulir');
		}
		$this->formatPenomoran	= $this->input->post('formatPenomoran');
		$this->idPenomoran		= $this->input->post('idPenomoran');
	}

	public function index()
	{
		$data['title']		= $this->title;
		$data['subtitle']	= 'Daftar';
		$data['content']	= 'SistemPenomoran/index';
		if ($this->formulir) {
			$data['formulir']	= $this->formulir;
		} else {
			$data['formulir']	= null;
		}
		$data				= array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function tambah()
	{
		$data['title']		= $this->title;
		$data['subtitle']	= 'Tambah';
		$data['content']	= 'SistemPenomoran/create';
		$data				      = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function save($idPenomoran)
	{
		if ($idPenomoran) {
			$this->SistemPenomoranModel->set('idPenomoran', $idPenomoran);
		}
		$this->SistemPenomoranModel->set('formulir', $this->formulir);
		$this->SistemPenomoranModel->set('formatPenomoran', $this->formatPenomoran);
		$this->SistemPenomoranModel->save();
		$data['status']		= 'success';
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function indexDatatable()
	{
		if ($this->formulir) {
			$this->SistemPenomoranModel->set('formulir', $this->formulir);
		}
		$data	= $this->SistemPenomoranModel->indexDatatable();
		return print_r($data);
	}

	public function edit($idPenomoran)
	{
		$this->SistemPenomoranModel->set('idPenomoran', $idPenomoran);
		$data				      = $this->SistemPenomoranModel->get();
		$data['title']		= $this->title;
		$data['subtitle']	= 'Edit';
		$data['content']	= 'SistemPenomoran/edit';
		$data				      = array_merge($data, path_info());
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