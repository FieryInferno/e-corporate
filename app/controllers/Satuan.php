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


class Satuan extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Satuan_model','model');
	}

	public function index() {
		$data['title'] = lang('unit');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Satuan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('msatuan.*');
		$this->datatables->where('msatuan.stdel', '0');
		$this->datatables->from('msatuan');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('unit');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Satuan/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'msatuan');
			if($data) {
				$data['title'] = lang('unit');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Satuan/edit';
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
	public function select2_msatuan($id = null) {
		$term = $this->input->get('q');
		$this->db->select('msatuan.id, msatuan.nama as text');
		$this->db->where('msatuan.del', '0');
		$this->db->limit(10);
		if($term) $this->db->like('msatuan', $term);
		if($id) $data = $this->db->where('id', $id)->get('msatuan')->row_array();
		else $data = $this->db->get('msatuan')->result_array();
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
