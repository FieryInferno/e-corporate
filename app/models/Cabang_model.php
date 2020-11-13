<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang_model extends CI_Model
{

    public function save()
    {
        $id = $this->uri->segment(3);
        if ($id) {
            $checkKode = getRowArray('mcabang', array('id' => $id));
            if ($checkKode['kode'] != $this->input->post('kode')) {
                if (isDuplicate('mcabang', 'kode', $this->input->post('kode'))) {
                    return jsonOutputError('Kode sudah ada sebelumnya.');
                }
            }

            $checkNama = getRowArray('mcabang', array('id' => $id));
            if ($checkNama['nama'] != $this->input->post('nama')) {
                if (isDuplicate('mcabang', 'nama', $this->input->post('nama'))) {
                    return jsonOutputError('Nama sudah ada sebelumnya.');
                }
            }

            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('uby', get_user('username'));
            $this->db->set('udate', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $update = $this->db->update('mcabang');
            if ($update) {
                return jsonOutputSuccess();
            } else {
                return jsonOutputError();
            }
        } else {
            if (isDuplicate('mcabang', 'kode', $this->input->post('kode'))) {
                return jsonOutputError('Kode sudah ada sebelumnya.');
            }

            if (isDuplicate('mcabang', 'nama', $this->input->post('nama'))) {
                return jsonOutputError('Nama sudah ada sebelumnya.');
            }

            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('cby', get_user('username'));
            $this->db->set('cdate', date('Y-m-d H:i:s'));
            $insert = $this->db->insert('mcabang');
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
        $update = $this->db->update('mcabang');
        if ($update) {
            return jsonOutputDeleteSuccess();
        } else {
            return jsonOutputDeleteError();
        }
    }

    public function select2($id, $term)
	{
        $this->db->select('id, concat(mcabang.kode, " - ", mcabang.nama) as text');
        if ($id) {
            $this->db->where('id', $id);
            return $this->db->get('mcabang')->row_array();
        } else {
            if ($term) {
                $this->db->like('kode', $term);
                $this->db->or_like('nama', $term);
            }
            return $this->db->get('mcabang')->result_array();
        }
    }

    public function select2_perusahaan($idPerusahaan, $term)
	{
        $this->db->select('id, concat(mcabang.kode, " - ", mcabang.nama) as text');
        $this->db->join('mperusahaan', 'mcabang.perusahaan = mperusahaan.idperusahaan');
        $this->db->where('idperusahaan', $idPerusahaan);
        if ($term) {
            $this->db->like('kode', $term);
            $this->db->or_like('nama', $term);
        }
        return $this->db->get('mcabang')->result_array();
    }
}
