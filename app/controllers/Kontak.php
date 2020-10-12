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


class Kontak extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Kontak_model','model');
	}

	public function index() {
		$data['title'] = lang('contact');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Kontak/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mkontak.*');
		$this->datatables->where('mkontak.stdel', '0');
		$this->datatables->from('mkontak');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('contact');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Kontak/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mkontak');
			if($data) {
				$data['title'] = lang('contact');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Kontak/edit';
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
	public function select2_mnoakun_piutang($id = null) {
		$term = $this->input->get('q');
		
		if($id) {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$this->db->where('mnoakun.stdel', '0');
			$this->db->where_in('mnoakun.noakunheader', '1211');
			$this->db->or_where('mnoakun.noakun', '1211');
			$this->db->limit(10);
			if($term) $this->db->like('mnoakun', $term);
			$data = $this->db->get('mnoakun')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mnoakun_utang($id = null) {
		$term = $this->input->get('q');
		
		if($id) {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$this->db->where('mnoakun.stdel', '0');
			$this->db->like('mnoakun.noakun', '211','after');
			$this->db->limit(10);
			if($term) $this->db->like('namaakun', $term);
			$data = $this->db->get('mnoakun')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}

