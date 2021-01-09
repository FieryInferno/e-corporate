<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_model extends CI_Model {

    private $perusahaan;

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
        if ($this->perusahaan) $this->db->where('saldoAwalInventaris.perusahaan', $this->perusahaan);
        $saldoAwalInventaris    = $this->db->get('saldoAwalInventaris')->result_array();
        $no                     = count($saldoAwalInventaris);
        $this->db->select('tinventaris.*, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'tinventaris.idperusahaan = mperusahaan.idperusahaan');
        if ($this->perusahaan) $this->db->where('tinventaris.idperusahaan', $this->perusahaan);
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

    public function set($jenis, $isi)
    {
        $this->$jenis   = $isi;
    }

  public function simpanPemeliharaanAset()
  {
    $harga      = $this->input->post('harga');
    $totalHarga = 0;
    foreach ($harga as $key) {
      $totalHarga += $key;
    }
    $idPemeliharaan = uniqid('pemeliharaan');
    $insert = $this->db->insert('pemeliharaanAset', [
      'idPemeliharaan'    => $idPemeliharaan,
      'perusahaan'        => $this->input->post('perusahaan'),
      'jenisAset'         => $this->input->post('jenisAset'),
      'jenisPemeliharaan' => $this->input->post('jenisPemeliharaan'),
      'noDokumen'         => $this->input->post('noDokumen'),
      'keterangan'        => $this->input->post('keterangan'),
      'nominalAsset'      => $totalHarga
    ]);
    if ($insert) {
      $kodeBarang = $this->input->post('kodeBarang');
      foreach ($kodeBarang as $key) {
        $this->db->insert('pemeliharaanAsetDetail', [
          'idPemeliharaan'  => $idPemeliharaan,
          'kodeBarang'      => $key
        ]);
      }
    } 
    return $insert;
  }

  public function dataPemeliharaanAset($perusahaan = null)
  {
    $this->load->library('Datatables');
		$this->datatables->select('pemeliharaanAset.*, mperusahaan.nama_perusahaan, mperusahaan.kode as kodePerusahaan');
		$this->datatables->from('pemeliharaanAset');
    $this->datatables->join('mperusahaan', 'pemeliharaanAset.perusahaan = mperusahaan.idperusahaan');
    if ($perusahaan) $this->datatables->where('perusahaan', $perusahaan);
    return $this->datatables->generate();
  }
}

