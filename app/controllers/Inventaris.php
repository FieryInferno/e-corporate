<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Inventaris_model','model');
	}

	public function index() {
		$data['title']		= 'Daftar Inventaris';
		$data['subtitle']	= lang('list');
		$data['content']	= 'Inventaris/index';
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tinventaris.*, mperusahaan.nama_perusahaan as nama_perusahaan');
		$this->datatables->join('mperusahaan', 'mperusahaan.idperusahaan=tinventaris.idperusahaan');
		$this->datatables->from('tinventaris');
		return print_r($this->datatables->generate());
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id_inventaris',$id,'tinventaris');
			if($data) {
				$data['title'] = 'Daftar Inventaris';
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Inventaris/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save($id) {
		$this->model->save($id);
	}

	public function delete() {
		$this->model->delete();
	}


}