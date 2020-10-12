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


class Units extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Units_model','model');
	}

	public function index() {
		$data['title'] = 'Units';
		$data['subtitle'] = lang('list');
		$data['content'] = 'Units/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('munits.*');
		$this->datatables->where('munits.del', '0');
		$this->datatables->join('mpegawai', 'munits.cby = mpegawai.id','left');
		$this->datatables->from('munits');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = 'Units';
		$data['subtitle'] = lang('list');
		$data['content'] = 'Units/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'munits');
			$data['title'] = 'Units';
			$data['subtitle'] = lang('list');
			$data['content'] = 'Units/edit';
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
