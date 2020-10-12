<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pajak extends User_Controller {

	public function index() {
		$data['title']      = 'Pajak';
		$data['content']    = 'Pajak/index';
		$data = array_merge($data, path_info());
		$this->parser->parse('default',$data);
    }
    
    public function index_datatable() {
		$this->load->library('Datatables');
        $this->datatables->select('*');
        $this->datatables->from('mpajak');
        $this->datatables->join('mnoakun', 'mpajak.akun=mnoakun.idakun');
		return print_r($this->datatables->generate());
    }
    
    public function create() {
		$data['title']      = 'Tambah Pajak';
		$data['content']    = 'Pajak/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
    }
    
    public function save($id_pajak = null) {
		$this->Pajak_model->save($id_pajak);
    }
    
    public function select2_noakun($idakun = null) {
        // $this->db->select('mnoakun.idakun as id, concat("(",mnoakun.akunno,") - ",mnoakun.namaakun) as text');
		// $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($this->Noakun_model->select2_noakun($idakun)));
	}

	public function edit($id_pajak)
	{
		$data['title']      = 'Edit Pajak';
		$data['content']    = 'Pajak/edit';
		$data['pajak']		= $this->Pajak_model->get($id_pajak);
		$data['akun']		= $this->Noakun_model->get();
		$data = array_merge($data, path_info());
		$this->parser->parse('default',$data);
	}

	public function delete($id_pajak)
	{
		$this->Pajak_model->delete($id_pajak);
	}

	public function select2_pajak($id_pajak = null)
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->Pajak_model->select2_pajak($id_pajak)));
	}

	public function get()
	{
		$this->output->set_content_type('application/json')->set_output(json_encode($this->Pajak_model->get()));
	}
}

