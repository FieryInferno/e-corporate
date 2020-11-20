<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Cabang_model', 'model');
    }

    public function index()
    {
        $data['title'] = 'Cabang';
        $data['subtitle'] = 'List';
        $data['content'] = 'Cabang/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('mcabang.*, mperusahaan.nama_perusahaan');
        $this->datatables->join('mperusahaan', 'mcabang.perusahaan = mperusahaan.idperusahaan');
        $this->datatables->where('mcabang.stdel', '0');
        $this->datatables->from('mcabang');
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $data['title'] = 'Cabang';
        $data['subtitle'] = 'Tambah';
        $data['content'] = 'Cabang/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function edit($id = null)
    {
        if ($id) {
            $data = getRowArray('mcabang', array('id' => $id));
            if ($data) {
                $data['title'] = 'Cabang';
                $data['subtitle'] = 'Edit';
                $data['content'] = 'Cabang/edit';
                $data = array_merge($data, path_info());
                $this->parser->parse('default', $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function save()
    {
        $this->model->save();
    }

    public function delete()
    {
        $this->model->delete();
    }

    public function select2($perusahaan = null, $id = null)
	{
		$term	= $this->input->get('q');
		$data	= $this->model->select2($perusahaan, $id, $term);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    
    public function select2_perusahaan($idPerusahaan = null)
	{
		$term	= $this->input->get('q');
		$data	= $this->model->select2_perusahaan($idPerusahaan, $term);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
