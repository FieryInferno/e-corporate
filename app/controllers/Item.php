<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends User_Controller {

	private $id;

	public function __construct() {
		parent::__construct();
		$this->load->model('Item_model','model');
		$this->id	= $this->input->post('id');
	}

	public function index() {
		$data['title'] = lang('item');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Item/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mitem.kode, mitem.nama, msatuan.nama as satuan, mkategori.nama as kategori, mitem.hargabeliterakhir, mitem.id');
		$this->datatables->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$this->datatables->join('mkategori', 'mitem.kategoriid = mkategori.id', 'left');
		$this->datatables->from('mitem');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('item');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Item/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mitem');
			if($data) {
				$data['title'] = lang('item');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Item/edit';
				$data = array_merge($data,path_info());
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

	// additional
	public function select2_satuanid($id = null) {
		$term = $this->input->get('q');
		$this->db->select('msatuan.id, msatuan.nama as text');
		$this->db->where('msatuan.stdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('nama', $term);
		if($id) $data = $this->db->where('id', $id)->get('msatuan')->row_array();
		else $data = $this->db->get('msatuan')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_kategoriid($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mkategori.id, mkategori.nama as text');
		$this->db->where('mkategori.stdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('nama', $term);
		if($id) $data = $this->db->where('id', $id)->get('mkategori')->row_array();
		else $data = $this->db->get('mkategori')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function select2_departemen($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mdepartemen.id, mdepartemen.nama as text');
		$this->db->where('mdepartemen.sdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('id', $term);
		if($id) $data = $this->db->where('id', $id)->get('mdepartemen')->row_array();
		else $data = $this->db->get('mdepartemen')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_noakunjual($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->like('mnoakun.noakun', '4111', 'after');
		$this->db->limit(100);
		if($term) $this->db->like('namaakun', $term, 'after');
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_noakunpersediaan($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.akunno as id, concat("(",mnoakun.akunno,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		// $this->db->where('mnoakun.stbayar', '1');
		// $this->db->like('mnoakun.noakuntop', '1', 'after');
		$this->db->like('mnoakun.tipe', '5', 'after');
		$this->db->or_like('mnoakun.tipe', '1', 'after');
		$this->db->limit(100);
		if($term) $this->db->like('namaakun', $term);
		if($id) $data = $this->db->where('akunno', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	

	public function select2($id = null)
	{
		$term	= $this->input->get('q');
		$data	= $this->model->select2($id, $term);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get()
	{
    // print_r($this->id);
    // die();
		$this->model->set('id', $this->id);
		$data	= $this->model->get();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

