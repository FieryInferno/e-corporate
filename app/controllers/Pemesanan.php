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


class Pemesanan extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pemesanan_model','model');
	}

	public function index() {
		$data['subtitle'] = lang('list');
		$data = array_merge($data,path_info());
		$this->parser->parse('Pemesanan/index',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpemesanan.*, mgudang.nama as gudang, mpegawai.nama as pegawai');
		$this->datatables->join('mpegawai', 'tpemesanan.cby = mpegawai.id','left');
		$this->datatables->join('mgudang', 'tpemesanan.gudangid = mgudang.id','left');
		$this->datatables->from('tpemesanan');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['subtitle'] = lang('add_new');
		$data = array_merge($data,path_info());
		$this->parser->parse('Pemesanan/create',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tpemesanan');
			$data['subtitle'] = lang('edit');
			$data = array_merge($data,path_info());
			$this->parser->parse('Pemesanan/edit',$data);
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
	public function select2_mgudang($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mgudang.id, mgudang.nama as text');
		$this->db->where('mgudang.del', '0');
		$this->db->limit(10);
		if($term) $this->db->like('mgudang', $term);
		if($id) $data = $this->db->where('id', $id)->get('mgudang')->row_array();
		else $data = $this->db->get('mgudang')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_mitem($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mitem.id, mitem.nama as text');
		$this->db->where('mitem.del', '0');
		$this->db->limit(10);
		if($term) $this->db->like('mitem', $term);
		if($id) $data = $this->db->where('id', $id)->get('mitem')->row_array();
		else $data = $this->db->get('mitem')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function detail_item() {
		$this->model->detail_item();
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
