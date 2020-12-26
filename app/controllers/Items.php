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


class Items extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Items_model','model');
	}

	public function index() {
		$data['title'] = lang('items');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Items/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mitems.*, mcategories.name category, unitsmall.name unitsmall, unitlarge.name unitlarge');
		$this->datatables->where('mitems.del', '0');
		$this->datatables->join('munits unitsmall', 'mitems.unitsmallid = unitsmall.id','left');
		$this->datatables->join('munits unitlarge', 'mitems.unitlargeid = unitlarge.id','left');
		$this->datatables->join('mcategories', 'mitems.categoryid = mcategories.id','left');
		$this->datatables->from('mitems');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('items');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Items/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mitems');
			$data['title'] = lang('items');
			$data['subtitle'] = lang('list');
			$data['content'] = 'Items/edit';
			$data = array_merge($data,path_info());
			$this->parser->parse('default',$data);
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
	public function select2_mcategories($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mcategories.id, mcategories.name as text');
		$this->db->where('mcategories.del', '0');
		$this->db->limit(10);
		if($term) $this->db->like('mcategories.name', $term);
		if($id) $data = $this->db->where('id', $id)->get('mcategories')->row_array();
		else $data = $this->db->get('mcategories')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_munits($id = null) {
		$term = $this->input->get('q');
		$this->db->select('munits.id, munits.name as text');
		$this->db->where('munits.del', '0');
		$this->db->limit(10);
		if($term) $this->db->like('munits.name', $term);
		if($id) $data = $this->db->where('id', $id)->get('munits')->row_array();
		else $data = $this->db->get('munits')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/
