<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * =================================================
 * @package    CGC (CODEIGNITER GENERATE CRUD)
 * @author    isyanto.id@gmail.com
 * @link    https://isyanto.com
 * @since    Version 1.0.0
 * @filesource
 * =================================================
 */

class Anggota_koperasi extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Anggota_koperasi_model', 'model');
    }

    public function index()
    {
        $data['title'] = 'Anggota Koperasi';
        $data['subtitle'] = 'List';
        $data['content'] = 'Anggota_koperasi/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('manggotakoperasi.*');
        $this->datatables->where('manggotakoperasi.stdel', '0');
        $this->datatables->from('manggotakoperasi');
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $data['title'] = 'Anggota Koperasi';
        $data['subtitle'] = 'Tambah';
        $data['content'] = 'Anggota_koperasi/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function edit($id = null)
    {
        if ($id) {
            $data = getRowArray('manggotakoperasi', array('id' => $id));
            if ($data) {
                $data['title'] = 'Anggota Koperasi';
                $data['subtitle'] = 'Edit';
                $data['content'] = 'Anggota_koperasi/edit';
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
}
