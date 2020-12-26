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


class Memo extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Memo_model','model');
	}

	public function index() {
		$data['title'] = lang('memos');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Memo/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('viewmemo.*');
		$this->datatables->where('viewmemo.saldo >', 0);
		$this->datatables->from('viewmemo');
		return print_r($this->datatables->generate());
	}

	public function pengembalian() {
		$kontakid = $this->uri->segment(3);
		if(!$kontakid) {
			show_404();
		}
		
		$data = get_by_id('id',$kontakid,'viewmemo');
		if($data['saldo'] < '0') {
			show_404();
		}
		
		$data['title'] = lang('memos');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Memo/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getpembayaran($id);
			$data['fakturdetail'] = $this->model->getfakturdetail($data['id']);
			$data['title'] = lang('memos');
			$data['subtitle'] = lang('detail');
			$data['content'] = 'Memo/detail';
			$data = array_merge($data,path_info());
			$this->parser->parse('default',$data);
		}
	}

	public function save_pengembalian() {
		$this->model->save_pengembalian();
	}

	// additional
	public function select2_noakunbayar($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$this->db->where('noakunheader', '111');
			$this->db->where('stbayar', '1');
			$data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$this->db->where('noakunheader', '111');
			$this->db->where('stbayar', '1');
			$this->db->where('mnoakun.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('namaakun', $term);
			$data = $this->db->get('mnoakun')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}