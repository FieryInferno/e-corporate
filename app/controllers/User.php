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

class User extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        if (get_user('permissionid') == '2') {
            redirect('Forbidden', 'refresh');
        }

        $this->load->model('User_model', 'model');
    }

    public function index()
    {
        $data['title'] = lang('user');
        $data['subtitle'] = lang('list');
        $data['content'] = 'User/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('z_user.*, z_userpermission.name as permission, mcabang.nama as cabang');
        $this->datatables->where('z_user.stdel', '0');
        $this->datatables->join('z_userpermission', 'z_user.permissionid = z_userpermission.id', 'left');
        $this->datatables->join('mcabang', 'z_user.cabangid = mcabang.id', 'left');
        $this->datatables->from('z_user');
        return print_r($this->datatables->generate());
    }

    public function create()
    {
        $data['title'] = lang('user');
        $data['subtitle'] = lang('add_new');
        $data['content'] = 'User/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('default', $data);
    }

    public function edit($id = null)
    {
        if ($id) {
            $data = get_by_id('id', $id, 'z_user');
            if ($data) {
                $data['title'] = lang('user');
                $data['subtitle'] = lang('edit');
                $data['content'] = 'User/edit';
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

    public function change_password()
    {
        $this->model->change_password();
    }

    public function delete()
    {
        $this->model->delete();
    }

    // additional
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

    public function select2_cabangid($id = null)
    {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mcabang.id, mcabang.nama as text');
            $data = $this->db->where('id', $id)->get('mcabang')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mcabang.id, mcabang.nama as text');
            $this->db->where('mcabang.stdel', '0');
            $this->db->limit(10);
            if ($term) {
                $this->db->like('mcabang.nama', $term);
            }

            $data = $this->db->get('mcabang')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }
}
