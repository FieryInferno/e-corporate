<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pegawai_model','model');
	}

	public function index() {
		$data['title'] = lang('employee');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Pegawai/index';
		$data['breadcrumb'] = array(
			'index' => 'List',
			'create' => 'Add New',
		);
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mpegawai.*, mpegawaihakakses.nama as hakakses');
		$this->datatables->where('mpegawai.stdelete', '0');
		$this->datatables->join('mpegawaihakakses', 'mpegawai.idhakakses = mpegawaihakakses.id', 'left');
		$this->datatables->from('mpegawai');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('employee');
		$data['subtitle'] = lang('create');
		$data['content'] = 'Pegawai/create';
		$data['breadcrumb'] = array(
			'index' => 'List',
			'create' => 'Add New',
		);
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit() {
		$id = $this->uri->segment(3);
		if($id) {
			$data = get_by_id('id',$id,'mpegawai');
			$data['title'] = lang('employee');
			$data['subtitle'] = lang('edit');
			$data['content'] = 'Pegawai/edit';
			$data['breadcrumb'] = array(
				'index' => 'List',
				'create' => 'Add New',
			);
			$data = array_merge($data,path_info());
			$this->parser->parse('default',$data);
		} else {
			show_404();
		}
	}

	public function edit_password() {
		$id = $this->uri->segment(3);
		if($id) {
			$data = get_by_id('id',$id,'mpegawai');
			$data['title'] = lang('employee');
			$data['subtitle'] = 'Edit Password';
			$data['content'] = 'Pegawai/edit_password';
			$data = array_merge($data,path_info());
			$this->parser->parse('default',$data);
		} else {
			show_404();
		}
	}

	public function save() {
		$this->model->save();
	}
	public function save_password() {
		$this->model->save_password();
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