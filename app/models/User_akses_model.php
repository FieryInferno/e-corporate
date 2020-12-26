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

class User_akses_model extends CI_Model
{

    public function save()
    {
        $id = $this->uri->segment(3);
        if ($id) {

            $checkNama = getRowArray('z_userpermission', array('id' => $id));
            if ($checkNama['name'] != $this->input->post('name')) {
                if (isDuplicate('z_userpermission', 'name', $this->input->post('name'))) {
                    return jsonOutputError('Nama sudah ada sebelumnya.');
                }
            }

            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('uby', get_user('username'));
            $this->db->set('udate', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $update = $this->db->update('z_userpermission');
            if ($update) {
                return jsonOutputSuccess();
            } else {
                return jsonOutputError();
            }
        } else {

            if (isDuplicate('z_userpermission', 'name', $this->input->post('name'))) {
                return jsonOutputError('Nama sudah ada sebelumnya.');
            }

            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('cby', get_user('username'));
            $this->db->set('cdate', date('Y-m-d H:i:s'));
            $insert = $this->db->insert('z_userpermission');
            if ($insert) {
                return jsonOutputSuccess();
            } else {
                return jsonOutputError();
            }
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->db->set('stdel', '1');
        $this->db->set('dby', get_user('username'));
        $this->db->set('ddate', date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $update = $this->db->update('z_userpermission');
        if ($update) {
            return jsonOutputDeleteSuccess();
        } else {
            return jsonOutputDeleteError();
        }
    }
}
