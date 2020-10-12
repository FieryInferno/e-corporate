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


class Categories extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Categories_model','model');
	}

	public function index() {
		$data['title'] = 'Categories';
		$data['subtitle'] = lang('list');
		$data['content'] = 'Categories/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('mcategories.*');
		$this->datatables->where('mcategories.del', '0');
		$this->datatables->join('mpegawai', 'mcategories.cby = mpegawai.id','left');
		$this->datatables->from('mcategories');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = 'Categories';
		$data['subtitle'] = lang('list');
		$data['content'] = 'Categories/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'mcategories');
			$data['title'] = 'Categories';
			$data['subtitle'] = lang('list');
			$data['content'] = 'Categories/edit';
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
