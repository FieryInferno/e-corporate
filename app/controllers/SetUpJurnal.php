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
		$data['metaAkun']	= $this->Metaakun_model->get();
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

}