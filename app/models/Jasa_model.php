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

class Jasa_model extends CI_Model
{

    public function save()
    {
        $id = $this->uri->segment(3);
        if ($id) {
            $checkKode = getRowArray('mjasa', array('id' => $id));
            if ($checkKode['kode'] != $this->input->post('kode')) {
                if (isDuplicate('mjasa', 'kode', $this->input->post('kode'))) {
                    return jsonOutputError('Kode sudah ada sebelumnya.');
                }
            }

            $checkNama = getRowArray('mjasa', array('id' => $id));
            if ($checkNama['nama'] != $this->input->post('nama')) {
                if (isDuplicate('mjasa', 'nama', $this->input->post('nama'))) {
                    return jsonOutputError('Nama sudah ada sebelumnya.');
                }
            }

            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('uby', get_user('username'));
            $this->db->set('udate', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $update = $this->db->update('mjasa');
            if ($update) {
                return jsonOutputSuccess();
            } else {
                return jsonOutputError();
            }
        } else {
            if (isDuplicate('mjasa', 'kode', $this->input->post('kode'))) {
                return jsonOutputError('Kode sudah ada sebelumnya.');
            }

            if (isDuplicate('mjasa', 'nama', $this->input->post('nama'))) {
                return jsonOutputError('Nama sudah ada sebelumnya.');
            }

            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('cby', get_user('username'));
            $this->db->set('cdate', date('Y-m-d H:i:s'));
            $insert = $this->db->insert('mjasa');
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
        $update = $this->db->update('mjasa');
        if ($update) {
            return jsonOutputDeleteSuccess();
        } else {
            return jsonOutputDeleteError();
        }
    }
}
