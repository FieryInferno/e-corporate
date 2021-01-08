<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunanggaran extends User_Controller{

    public function __construct() {
		parent::__construct();
		$this->load->model('Tahunanggaran_model','model');
    }	
    
    public function index() {
		$data['title']		= 'Tahun Anggaran';
		$data['subtitle']	= 'Daftar';
		$data['content']	= 'Tahunanggaran/index';
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mtahun.*');
		$this->datatables->where('mtahun.status', '0');
		$this->datatables->from('mtahun');
		return print_r($this->datatables->generate());
	}

    public function create() {
		$data['title']		= 'Tahun Anggaran';
		$data['subtitle']	= 'Tambah Baru';
		$data['content']	= 'Tahunanggaran/create';
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data	= get_by_id('id',$id,'mtahun');
			if($data) {
				$data['title']		= lang('Tahun Anggaran');
				$data['subtitle']	= lang('edit');
				$data['content']	= 'Tahunanggaran/edit';
				$data				= array_merge($data,path_info());
				$this->parser->parse('template',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save() {
		$this->model->save();
	}

	public function delete() {
		$this->model->delete();
    }
    
    public function select2_mpegawaihakakses($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
		$this->db->where('mpegawaihakakses.stdel', '0');
		$this->db->limit(10);
		if($term) $this->db->like('mpegawaihakakses', $term);
		if($id) $data = $this->db->where('id', $id)->get('mpegawaihakakses')->row_array();
		else $data = $this->db->get('mpegawaihakakses')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
