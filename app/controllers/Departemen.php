<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departemen extends User_Controller{

    public function __construct() {
		parent::__construct();
		$this->load->model('Departemen_model','model');
    }	
    
    public function index() {
		$data['title'] = lang('departemen');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Departemen/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mdepartemen.*,mperusahaan.*');
		$this->datatables->join('mperusahaan','mdepartemen.id_perusahaan=mperusahaan.idperusahaan');
		$this->datatables->where('mdepartemen.sdel', '0');
		$this->datatables->from('mdepartemen');
		return print_r($this->datatables->generate());
	}
	public function select2_id_perusahaan($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
		$this->db->where('mperusahaan.stdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('nama_perusahaan', $term);
		if($id) $data = $this->db->where('id', $id)->get('mperusahaan')->row_array();
		else $data = $this->db->get('mperusahaan')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_mperusahaan($id = null)
	{
		if ($id) {
			$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
			$data = $this->db->where('id', $id)->get('mperusahaan')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
			$this->db->where('mperusahaan.stdel', '0');
			$this->db->limit(10);
			$data = $this->db->get('mperusahaan')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
    public function create() {
		$data['title'] = lang('departemen');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Departemen/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mdepartemen');
			if($data) {
				$data['title'] = lang('departemen');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Departemen/edit';
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
}
