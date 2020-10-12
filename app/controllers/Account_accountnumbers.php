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


class Account_accountnumbers extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Account_accountnumbers_model','model');
	}

	public function index() {
		$data['title'] = lang('account_accountnumbers');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Account_accountnumbers/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mnoakun.*');
		$this->datatables->where('mnoakun.del', '0');
		$this->datatables->join('mpegawai', 'mnoakun.cby = mpegawai.id','left');
		$this->datatables->from('mnoakun');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('account_accountnumbers');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Account_accountnumbers/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mnoakun');
			$data['title'] = lang('account_accountnumbers');
			$data['subtitle'] = lang('list');
			$data['content'] = 'Account_accountnumbers/edit';
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
	public function select2_mnoakun($id = null) {
		$term = $this->input->get('q');
		$this->db->select('akun.noakun as id, concat(akun.noakun, " ", akun.nama) as text');
		$this->db->where('akun.del', '0');
		$this->db->limit(10);
		if($term) $this->db->like('akun.nama', $term);
		if($id) $data = $this->db->where('akun.noheader', $id)->get('mnoakun akun')->row_array();
		else $data = $this->db->get('mnoakun akun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_new_noakun() {
		$this->model->get_new_noakun();
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
