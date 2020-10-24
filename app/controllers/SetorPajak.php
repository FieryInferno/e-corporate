<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajak extends User_Controller {

	// public function __construct()
	// {
		
	// }

	public function index()
	{
		$data['title']      = 'Setor Pajak';
		$data['content']    = 'SetorPajak/index';	
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
	
	public function save()
	{
		$setupJurnal	= $this->SetUpJurnal_Model->save();
		if ($setupJurnal) {
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('save_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function index_datatable()
	{
		$data	= $this->SetUpJurnal_Model->index_datatable();
		return print_r($data);
	}

	public function delete($idSetupJurnal)
	{
		$data	= $this->SetUpJurnal_Model->delete($idSetupJurnal);
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function edit()
	{
		$this->SetUpJurnal_Model->setIdSetupJurnal($this->getIdSetupJurnal());
		$data['setupJurnal']	= $this->SetUpJurnal_Model->get();
		$data['title']			= $this->getTitle();
		$data['subtitle']		= $this->getSubtitle();
		$data['content']		= $this->getContent();
		$data					= array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	private function setIdSetupJurnal($idSetupJurnal)
	{
		$this->idSetupJurnal	= $idSetupJurnal;
	}

	private function getIdSetupJurnal()
	{
		return $this->idSetupJurnal;
	}

	private function getTitle()
	{
		return $this->title;
	}

	private function setSubtitle($subtitle)
	{
		$this->subtitle = $subtitle;
	}

	private function getSubtitle()
	{
		return $this->subtitle;
	}

	private function getContent()
	{
		return $this->content;
	}

	public function setContent($content)
	{
		$this->content	= $content;
	}

	public function aksiEdit()
	{
		$this->SetUpJurnal_Model->setIdSetupJurnal($this->getIdSetupJurnal());
		$this->SetUpJurnal_Model->setKodeJurnal($this->getKodeJurnal());
		$this->SetUpJurnal_Model->setFormulir($this->getFormulir());
		$this->SetUpJurnal_Model->setKeterangan($this->getKeterangan());
		$data	= $this->SetUpJurnal_Model->edit();
		if ($data) {
			$this->JurnalAnggaranModel->setIdJurnalAnggaran($this->getIdJurnalAnggaran());
			$this->JurnalAnggaranModel->setElemenJurnalAnggaran($this->getElemenJurnalAnggaran());
			$this->JurnalAnggaranModel->setJenisAnggaran($this->getJenisAnggaran());
			$this->JurnalAnggaranModel->save();
			$this->JurnalFinansialModel->setIdJurnalFinansial($this->getIdJurnalFinansial());
			$this->JurnalFinansialModel->setElemenJurnalFinansial($this->getElemenJurnalFinansial());
			$this->JurnalFinansialModel->setJenisFinansial($this->getJenisFinansial());
			$this->JurnalFinansialModel->save();
			$data0['status'] = 'success';
			$data0['message'] = lang('save_success_message');
		} else {
			$data0['status'] = 'error';
			$data0['message'] = lang('save_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
	}
}