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
		$data['title'] = lang('item');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Metaakun/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
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
}

