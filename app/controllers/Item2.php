<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/


class Item extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Item_model','model');
	}

	public function index() {
		$data['title'] = lang('item');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Item/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('viewitem.*');
		$this->datatables->where('viewitem.stdel', '0');
		$this->datatables->from('viewitem');
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

	public function select2_noakunbeli($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->like('mnoakun.noakun', '5114', 'after');
		$this->db->limit(100);
		if($term) $this->db->or_like('namaakun', $term);
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
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
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->like('mnoakun.noakun', '1311', 'after');
		$this->db->limit(100);
		if($term) $this->db->like('namaakun', $term);
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}	
}

