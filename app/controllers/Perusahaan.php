<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Perusahaan extends User_Controller{

	private $idPerusahaan;

    public function __construct() {
		parent::__construct();
		$this->load->model('Perusahaan_model','model');
		$this->idPerusahaan	= $this->input->get('idPerusahaan');
    }	
    
    public function index() {
		$data['title'] = lang('perusahaan');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Perusahaan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mperusahaan.*');
		$this->datatables->where('mperusahaan.stdel', '0');
		$this->datatables->from('mperusahaan');
		return print_r($this->datatables->generate());
	}

    public function create() {
		$data['title'] = lang('perusahaan');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Perusahaan/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('idperusahaan',$id,'mperusahaan');
			if($data) {
				$data['title'] = lang('perusahaan');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Perusahaan/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
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

	public function select2($id = null)
	{
		$q	= $this->input->get('q');
		$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
		if ($q) {
			$this->db->like('nama_perusahaan', $q);
		}
		if ($id) {
			$this->db->where('idperusahaan', $id);
			$data = $this->db->get('mperusahaan')->row_array();
		} else {
			$data = $this->db->get('mperusahaan')->result_array();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getPerusahaan()
	{
		$this->model->set('idPerusahaan', $this->idPerusahaan);
		$data	= $this->model->get();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
