<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends User_Controller {

    private $idProject;

	public function __construct() {
		parent::__construct();
        $this->load->model('ProjectModel','model');
        $this->idProject    = $this->input->post('idProject');
    }
    
    public function index() {
        $data['title']      = 'Project';
		$data['subtitle']   = lang('list');
		$data['content']    = 'Project/index';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function create() {
        $noEvent            = $this->db->query("SELECT MAX(RIGHT(noEvent, 3)) AS noEvent FROM project")->row_array();
        if ($noEvent) {
            $noEvent    = (int) $noEvent['noEvent'] + 1;
            switch (strlen($noEvent)) {
                case 1:
                    $noEvent    = '00' . $noEvent;
                    break;
                case 2:
                    $noEvent    = '0' . $noEvent;
                    break;
            
                default:
                    
                    break;
            } 
        } else {
            $noEvent    = '001';
        }
        $data['noEvent']    = $noEvent;
        $data['title']      = 'Project';
		$data['subtitle']   = 'Tambah';
		$data['content']    = 'Project/create';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function save()
    {
        $this->model->set('idProject', $this->idProject);
        $data   = $this->model->save();
        if ($data) {
            $hasil['status'] = 'success';
        } else {
            $hasil['status'] = 'failed';
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($hasil));
    }

    public function indexDatatables()
    {
        $perusahaan = $this->session->idperusahaan;
        $data   = $this->model->indexDatatables($perusahaan);
        return $data;
    }

    public function select2($perusahaan)
    {
        $data   = $this->model->select2($perusahaan);
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function edit($idProject)
    {
        $this->model->set('idProject', $idProject);
        $data               = $this->model->get();
        $data['title']      = 'Project';
		$data['subtitle']   = 'Edit';
		$data['content']    = 'Project/edit';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }

    public function delete($idProject)
    {
        $this->model->set('idProject', $idProject);
        $data   = $this->model->delete();
        if ($data) {
            $hasil['status'] = 'success';
        } else {
            $hasil['status'] = 'failed';
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($hasil));
    }
}