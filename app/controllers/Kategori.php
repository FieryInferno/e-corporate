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


class Kategori extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kategori_model','model');
	}

	public function index() {
		$data['title'] = lang('category');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Kategori/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mkategori.*');
		$this->datatables->where('mkategori.stdel', '0');
		$this->datatables->from('mkategori');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('category');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Kategori/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mkategori');
			if($data) {
				$data['title'] = lang('category');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Kategori/edit';
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

