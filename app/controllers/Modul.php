<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Modul extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Modul_model','model');
	}

	public function index() {
		$data['subtitle'] = lang('list');
		$data = array_merge($data,path_info());
		$this->parser->parse('Modul/index',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('*');
		$this->datatables->where('mmodul.stdelete', '0');
		$this->datatables->from('mmodul');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['subtitle'] = lang('add_new');
		$data = array_merge($data,path_info());
		$this->parser->parse('Modul/create',$data);
	}

	public function edit($id=null) {
		if($id) {
			$data = get_by_id('id',$id,'mmodul');
			$data['subtitle'] = lang('edit');
			$data = array_merge($data,path_info());
			$this->parser->parse('Modul/edit',$data);
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

	public function activate() {
		$this->model->activate();
	}

	public function deactivate() {
		$this->model->deactivate();
	}
}