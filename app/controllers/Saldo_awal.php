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


class Saldo_awal extends User_Controller {

	public function __construct() {
		parent::__construct();
		if(get_user('permissionid') == '2') redirect('Forbidden','refresh');
		$this->load->model('Saldo_awal_model','model');
	}

	public function index() {
		$data = $this->db->get('tsaldoawal')->row_array();
		if(!$data) $data['tanggal'] = date('Y-m-01');
		$data['title'] = lang('beginning_balance');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Saldo_awal/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}
	
	public function manage() {
		$data = $this->db->get('tsaldoawal')->row_array();
		if($data) {
			$data['title'] = lang('beginning_balance');
			$data['saldoawaldetail'] = $this->model->get_saldoawaldetail();
			$data['subtitle'] = lang('add_new');
			$data['content'] = 'Saldo_awal/manage';
			$data = array_merge($data,path_info());
			$this->parser->parse('default',$data);
		} else {
			redirect('saldo_awal/index','refresh');
		}
	}

	public function save() {
		$this->model->save();
	}

	public function savehead() {
		$this->model->savehead();
	}

	public function delete() {
		$this->model->delete();
	}

	// additional
	public function select2_mpegawaihakakses($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$data = $this->db->where('id', $id)->get('mpegawaihakakses')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$this->db->where('mpegawaihakakses.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mpegawaihakakses', $term);
			$data = $this->db->get('mpegawaihakakses')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}

