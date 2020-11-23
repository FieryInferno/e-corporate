<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends User_Controller {

	public function __construct() {
		parent::__construct();
		// $this->load->model('ProjectModel','model');
    }
    
    public function index() {
        $data['title']      = 'Project';
		$data['subtitle']   = lang('list');
		$data['content']    = 'Project/index';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function create() {
        $noEvent            = $this->db->query("SELECT MAX(LEFT(noEvent, 3)) AS noEvent FROM project")->row_array();
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
}