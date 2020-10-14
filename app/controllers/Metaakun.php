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


class Metaakun extends User_Controller {

	public function __construct() {
		parent::__construct();
		if(get_user('permissionid') == '2') redirect('Forbidden','refresh');
		$this->load->model('Metaakun_model','model');
	}

	public function index() {
		$data['title']		= "Pemetaan Akun";
		$data['content']	= 'Metaakun/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function save() {
		$this->model->save();
	}

	// additional

	public function get_pengaturan_akun($id = null) {
		if($id) {
			echo get_pengaturan_akun($id);
		}
	}

	public function select2_noakun($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		$this->db->limit(10);
		if($term) $this->db->like('namaakun', $term);
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->join('mnoakun', 'tPemetaanAkun.kodeAkun = mnoakun.idakun');
		$this->datatables->join('mnoakun as mnoakun1', 'tPemetaanAkun.kodeAkun1 = mnoakun1.idakun');
		$this->datatables->join('mnoakun as mnoakun2', 'tPemetaanAkun.kodeAkun2 = mnoakun2.idakun');
		$this->datatables->join('mnoakun as mnoakun3', 'tPemetaanAkun.kodeAkun3 = mnoakun3.idakun');
		$this->datatables->select('mnoakun.akunno, mnoakun.namaakun, mnoakun1.akunno as akun1, mnoakun2.akunno as akun2, mnoakun3.akunno as akun3, tPemetaanAkun.idPemetaanAkun, kodeAkun, kodeAkun1, kodeAkun2, kodeAkun3');
		$this->datatables->from('tPemetaanAkun');
		return print_r($this->datatables->generate());
	}

	public function delete($idPemetaanAkun)
	{
		$this->model->hapus($idPemetaanAkun);
		$data['status']		= 'success';
		$data['message']	= 'Berhasil Menambah Pemetaan Akun';
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

