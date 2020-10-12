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

class Jasa extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jasa_model', 'model');
    }

    public function index()
    {
        $data['title'] = 'Jasa';
        $data['subtitle'] = 'List';
        $data['content'] = 'Jasa/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('mjasa.*');
        $this->datatables->where('mjasa.stdel', '0');
        $this->datatables->from('mjasa');
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $data['title'] = 'Jasa';
        $data['subtitle'] = 'Tambah';
        $data['content'] = 'Jasa/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function edit($id = null)
    {
        if ($id) {
            $data = getRowArray('mjasa', array('id' => $id));
            if ($data) {
                $data['title'] = 'Jasa';
                $data['subtitle'] = 'Edit';
                $data['content'] = 'Jasa/edit';
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
