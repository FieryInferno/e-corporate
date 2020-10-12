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
        $this->parser->parse('default', $data);
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('mcabang.*');
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
}
