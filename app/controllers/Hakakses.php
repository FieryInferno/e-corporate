<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hakakses extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Hakakses_model','model');
	}

	public function index() {
		$data['subtitle'] = lang('list');
		$data = array_merge($data,path_info());
		$this->parser->parse('Hakakses/index',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('*');
		$this->datatables->where('mpegawaihakakses.stdelete', '0');
		$this->datatables->from('mpegawaihakakses');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['modul'] = $this->model->get_all_modul();
		$data['subtitle'] = lang('create');
		$data = array_merge($data,path_info());
		$this->parser->parse('Hakakses/create',$data);
	}

	public function edit($id) {
		if($id) {
			$data = get_by_id('id',$id,'mpegawaihakakses');
			$data['modul'] = $this->model->get_all_modul_edit($id);
			$data['subtitle'] = lang('edit');
			$data = array_merge($data,path_info());
			$this->parser->parse('Hakakses/edit',$data);
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
}