<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_hak_akses extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_hak_akses_model', 'model');
    }

    public function index()
    {
        $data['title']      = 'Hak Akses';
        $data['subtitle']   = 'Form Hak Akses';
        $data['content']    = 'User_hak_akses/index';
        $data               = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }

    public function menu($id = null)
    {
        if ($id) {
            $data = getRowArray('z_userpermission', array('id' => $id));
            if ($data) {
                $data = array_merge($data, path_info());
                $this->parser->parse('User_hak_akses/menu', $data);
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

    public function select2_permissionid($id = null)
    {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('z_userpermission.id, z_userpermission.name as text');
            $data = $this->db->where('id', $id)->get('z_userpermission')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('z_userpermission.id, z_userpermission.name as text');
            $this->db->where('z_userpermission.stdel', '0');
            $this->db->limit(10);
            if ($term) {
                $this->db->like('z_userpermission.name', $term);
            }

            $data = $this->db->get('z_userpermission')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
