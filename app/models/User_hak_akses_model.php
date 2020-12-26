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

class User_hak_akses_model extends CI_Model
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
            $menu = $this->input->post('menu');
            if ($menu) {
                $deleteAll = $this->db->delete('z_userpermissiondetail', array('idpermission' => $this->input->post('permissionid')));
                if ($deleteAll) {
                    for ($i = 0; $i < count($menu); $i++) {
                        $this->db->set('idpermission', $this->input->post('permissionid'));
                        $this->db->set('menuid', $this->input->post('menu')[$i]);
                        $this->db->insert('z_userpermissiondetail');
                    }
                }
                return jsonOutputSuccess();
            } else {
                return jsonOutputError();
            }
        }
    }
}
