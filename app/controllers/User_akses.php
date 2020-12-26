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

class User_akses extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_akses_model', 'model');
    }

    public function index()
    {
        $data['title'] = 'User Akses';
        $data['subtitle'] = 'List';
        $data['content'] = 'User_akses/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('z_userpermission.*');
        $this->datatables->where('z_userpermission.stdel', '0');
        $this->datatables->from('z_userpermission');
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $data['title'] = 'User Akses';
        $data['subtitle'] = 'Tambah';
        $data['content'] = 'User_akses/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function edit($id = null)
    {
        if ($id) {
            $data = getRowArray('z_userpermission', array('id' => $id));
            if ($data) {
                $data['title'] = 'User Akses';
                $data['subtitle'] = 'Edit';
                $data['content'] = 'User_akses/edit';
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
