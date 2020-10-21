<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekening extends User_Controller{

    public function __construct() {
		parent::__construct();
		$this->load->model('Rekening_model','model');
    }	
    
    public function index() {
		$data['title'] = lang('rekening');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Rekening/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mrekening.*,mperusahaan.*');
		$this->datatables->join('mperusahaan','mrekening.perusahaan=mperusahaan.idperusahaan');
		$this->datatables->where('mrekening.stdel', '0');
		$this->datatables->from('mrekening');
		return print_r($this->datatables->generate());
	}

    public function create() {
		$data['title'] = lang('rekening');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Rekening/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mrekening');
			if($data) {
				$data['title'] = lang('rekening');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Rekening/edit';
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
	public function select2_akunno($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.idakun as id, concat(mnoakun.akunno, " - ", mnoakun.namaakun) as text');
		$this->db->like('mnoakun.akunno', '1', 'after');
		$this->db->where('mnoakun.stdel', '0');
		if ($term) {
			$this->db->like('akunno', $term);
			$this->db->or_like('namaakun', $term);
		}
		if($id) $data = $this->db->where('akunno', $id)->get('mrekening')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	
	
	public function select2()
	{
		$this->db->select('mrekening.id, mrekening.nama as text');
		$this->db->where('stdel', 0);
		$data = $this->db->get('mrekening')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
