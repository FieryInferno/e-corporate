<?php defined('BASEPATH') OR exit('No direct script access allowed');

class SetUpJurnal extends User_Controller {

	private $idSetupJurnal;
	private $title	= 'Setup Jurnal';
	private $subtitle;
	private $content;
	private $kodeJurnal;
	private $jenisFinansial;
	private $formulir;
	private $keterangan;
	private $elemenJurnalFinansial;
	private $elemenJurnalAnggaran;
	private $jenisAnggaran;
	private $idJurnalAnggaran;
	private $idJurnalFinansial;
	private $jenis;

	public function __construct()
	{
		parent::__construct();
		$this->setIdSetupJurnal($this->input->post('idSetupJurnal'));
		$this->setKodeJurnal($this->input->post('kodeJurnal'));
		$this->setGet('formulir', $this->input->post('formulir'));
		$this->setKeterangan($this->input->post('keterangan'));
		$this->setGet('elemenJurnalAnggaran', $this->input->post('elemenjurnalAnggaran'));
		$this->setElemenJurnalFinansial($this->input->post('elemenjurnalFinansial'));
		$this->setGet('jenisAnggaran', $this->input->post('d/kjurnalAnggaran'));
		$this->setJenisFinansial($this->input->post('d/kjurnalFinansial'));
		$this->setGet('idJurnalAnggaran', $this->input->post('idJurnalAnggaran'));
		$this->setIdJurnalFinansial($this->input->post('idJurnalFinansial'));
		$this->setGet('jenis', $this->input->post('jenis'));
		switch ($this->uri->segment(2)) {
			case 'edit':
				$this->setSubtitle('Edit');
				$this->setContent('SetUpJurnal/edit');
				break;
			
			default:
				# code...
				break;
		}
	}

	private function setKodeJurnal($kodeJurnal)
	{
		$this->kodeJurnal	= $kodeJurnal;
	}

	private function setKeterangan($keterangan)
	{
		$this->keterangan	= $keterangan;
	}

	private function setElemenJurnalFinansial($elemenJurnalFinansial)
	{
		$this->elemenJurnalFinansial	= $elemenJurnalFinansial;
	}

	private function setJenisFinansial($jenisFinansial)
	{
		$this->jenisFinansial	= $jenisFinansial;
	}

	private function setIdJurnalFinansial($idJurnalFinansial)
	{
		$this->idJurnalFinansial	= $idJurnalFinansial;
	}

	private function getKodeJurnal()
	{
		return $this->kodeJurnal;
	}

	private function getKeterangan()
	{
		return $this->keterangan;
	}

	private function getElemenJurnalFinansial()
	{
		return $this->elemenJurnalFinansial;
	}

	private function getJenisFinansial()
	{
		return $this->jenisFinansial;
	}

	private function getIdJurnalFinansial()
	{
		return $this->idJurnalFinansial;
	}
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
		$this->SetUpJurnal_Model->setGet('formulir', $this->setGet('formulir'));
		$this->SetUpJurnal_Model->setKeterangan($this->getKeterangan());
		$data	= $this->SetUpJurnal_Model->edit();
		if ($data) {
			$this->JurnalAnggaranModel->setGet('idJurnalAnggaran', $this->setGet('idJurnalAnggaran'));
			$this->JurnalAnggaranModel->setGet('elemenJurnalAnggaran', $this->setGet('elemenJurnalAnggaran'));
			$this->JurnalAnggaranModel->setGet('jenisAnggaran', $this->setGet('jenisAnggaran'));
			$this->JurnalAnggaranModel->save();
			$this->JurnalFinansialModel->setGet('idJurnalFinansial', $this->setGet('idJurnalFinansial'));
			$this->JurnalFinansialModel->setGet('elemenJurnalFinansial', $this->setGet('elemenJurnalFinansial'));
			$this->JurnalFinansialModel->setGet('jenisFinansial', $this->setGet('jenisFinansial'));
			$this->JurnalFinansialModel->save();
			$data0['status'] = 'success';
			$data0['message'] = lang('save_success_message');
		} else {
			$data0['status'] = 'error';
			$data0['message'] = lang('save_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
	}

	private function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
	}

	public function get()
	{
		$this->SetUpJurnal_Model->setGet('jenis', $this->setGet('jenis'));
		$this->SetUpJurnal_Model->setGet('formulir', $this->setGet('formulir'));
		$data	= $this->SetUpJurnal_Model->getByJenis();
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}