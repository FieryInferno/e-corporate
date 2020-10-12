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


class Suppliers extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Suppliers_model','model');
	}

	public function index() {
		$data['title'] = lang('suppliers');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Suppliers/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('msuppliers.*');
		$this->datatables->where('msuppliers.del', '0');
		$this->datatables->join('mpegawai', 'msuppliers.cby = mpegawai.id','left');
		$this->datatables->from('msuppliers');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('suppliers');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Suppliers/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'msuppliers');
			$data['title'] = lang('suppliers');
			$data['subtitle'] = lang('list');
			$data['content'] = 'Suppliers/edit';
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
