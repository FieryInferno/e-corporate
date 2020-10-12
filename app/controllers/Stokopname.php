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


class Stokopname extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Stokopname_model','model');
	}

	public function index() {
		$data['title'] = lang('Stock_Opname');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Stokopname/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tstokopname.*, mitem.nama as item, mgudang.nama as gudang, mitem.kode as kodeitem');
		$this->datatables->join('mitem', 'tstokopname.itemid = mitem.id','left');
		$this->datatables->join('mgudang', 'tstokopname.gudangid = mgudang.id','left');
		$this->datatables->from('tstokopname');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['tanggal'] = date('Y-m-d');
		$data['title'] = lang('Stock_Opname');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Stokopname/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tstokopname');
			if($data) {
				$data['title'] = lang('Stock_Opname');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Stokopname/edit';
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
	public function select2_item($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('mitem.stdel', '0');
			$data = $this->db->where('id', $id)->get('mitem')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('mitem.stdel', '0');
			$this->db->limit(100);
			if($term) $this->db->like('mitem.nama', $term);
			$data = $this->db->get('mitem')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_gudang($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mgudang.id, mgudang.nama as text');
			$this->db->where('mgudang.stdel', '0');
			$data = $this->db->where('id', $id)->get('mgudang')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mgudang.id, mgudang.nama as text');
			$this->db->where('mgudang.stdel', '0');
			$this->db->limit(100);
			if($term) $this->db->like('mgudang.nama', $term);
			$data = $this->db->get('mgudang')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function noakunpenyesuaian($id = null) {
		$itemid = $this->input->post('itemid');
		if($itemid) {
			$noakun = '';
			if($id == '1') $noakun = $this->db->get_where('mnoakunpengaturan', array('id' => 19) )->row()->noakun;
			if($id == '2') $noakun = $this->db->get_where('mnoakunpengaturan', array('id' => 18) )->row()->noakun;
			if($id == '3') $noakun = $this->db->get_where('mitem', array('id' => $itemid) )->row()->noakunpersediaan;

			$this->db->select('mnoakun.*');
			$this->db->where('mnoakun.noakun', $noakun);
			$this->db->limit(1);
			$res = $this->db->get('mnoakun')->row_array();
			$data['status'] = 'success';
			$data['res'] = $res;
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$data['status'] = 'error';
			$data['message'] = 'Silahkan pilih terlebih dahulu item';
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function getstoksistem() {
		$itemid = $this->input->post('itemid');
		$gudangid = $this->input->post('gudangid');
		if($itemid && $gudangid) {
			$this->db->select_sum('sisa','stok');
			$this->db->where('itemid', $itemid);
			$this->db->where('gudangid', $gudangid);
			$get = $this->db->get('tstokmasuk');
			$data = $get->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}

