<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_model extends CI_Model {

    public function save($id)
    {
        $id = $this->uri->segment(3);
        foreach ($this->input->post() as $key => $val) {
            $this->db->set($key, strip_tags($val));
        }

        
        $this->db->where('id_inventaris', $id);
        $update = $this->db->update('tinventaris');
        if ($update) {
            $data['status'] = 'success';
            $data['message'] = lang('update_success_message');
        } else {
            $data['status'] = 'error';
            $data['message'] = lang('update_error_message');
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function delete()
    {
        $id = $this->uri->segment(3);
        $this->db->where('id_inventaris', $id);
        $update = $this->db->delete('tinventaris');
        if ($update) {
            $data['status'] = 'success';
            $data['message'] = lang('delete_success_message');
        } else {
            $data['status'] = 'error';
            $data['message'] = lang('delete_error_message');
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get()
    {
        $this->db->select('saldoAwalInventaris.*, mperusahaan.nama_perusahaan, mnoakun.namaakun');
        $this->db->join('mperusahaan', 'saldoAwalInventaris.perusahaan = mperusahaan.idperusahaan');
        $this->db->join('mnoakun', 'saldoAwalInventaris.noAkun = mnoakun.idakun');
        $saldoAwalInventaris    = $this->db->get('saldoAwalInventaris')->result_array();
        $no                     = count($saldoAwalInventaris);
        $this->db->select('tinventaris.*, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'tinventaris.idperusahaan = mperusahaan.idperusahaan');
        $inventaris             = $this->db->get('tinventaris')->result_array();
        for ($i=0; $i < count($inventaris); $i++) { 
            $key                                            = $inventaris[$i]; 
            $saldoAwalInventaris[$no]['kodeInventaris']     = $key['kode_barang'];
            $saldoAwalInventaris[$no]['namaInventaris']     = $key['nama_barang'];
            $saldoAwalInventaris[$no]['noRegister']         = $key['no_register'];
            $saldoAwalInventaris[$no]['harga']              = $key['nominal_asset'];
            $saldoAwalInventaris[$no]['tanggalPembelian']   = $key['tahun_perolehan'];
            $saldoAwalInventaris[$no]['namaakun']           = $key['jenis_akun'];
            $saldoAwalInventaris[$no]['nama_perusahaan']    = $key['nama_perusahaan'];
            $no++;
        }
        return $saldoAwalInventaris;
    }
}

