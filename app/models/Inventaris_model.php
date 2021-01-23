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
      $key                                              = $inventaris[$i]; 
      $saldoAwalInventaris[$no]['kodeInventaris']       = $key['kode_barang'];
      $saldoAwalInventaris[$no]['namaInventaris']       = $key['nama_barang'];
      $saldoAwalInventaris[$no]['noRegister']           = $key['no_register'];
      $saldoAwalInventaris[$no]['harga']                = $key['nominal_asset'];
      $saldoAwalInventaris[$no]['tanggalPembelian']     = $key['tahun_perolehan'];
      $saldoAwalInventaris[$no]['namaakun']             = $key['jenis_akun'];
      $saldoAwalInventaris[$no]['nama_perusahaan']      = $key['nama_perusahaan'];
      $saldoAwalInventaris[$no]['nominalPemeliharaan']  = $key['nominal_pemeliharaan'];
      $saldoAwalInventaris[$no]['RORKini']              = $key['ror_kini'];
      $no++;
    }
    return $saldoAwalInventaris;
  }

  public function set($jenis, $isi)
  {
    $this->$jenis   = $isi;
  }

  public function simpanPemeliharaanAset($idPemeliharaan)
  {
    $nominalPemeliharaan      = $this->input->post('nominalPemeliharaan');
    $totalNominalPemeliharaan = 0;
    foreach ($nominalPemeliharaan as $key) {
      $totalNominalPemeliharaan += (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
    }

    $harga        = $this->input->post('harga');
    $nominalAsset = 0;
    foreach ($harga as $key) {
      $nominalAsset += (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
    }

    $dataPemeliharaan = [
      'perusahaan'                => $this->input->post('perusahaan'),
      'jenisAset'                 => $this->input->post('jenisAset'),
      'jenisPemeliharaan'         => $this->input->post('jenisPemeliharaan'),
      'noDokumen'                 => $this->input->post('noDokumen'),
      'keterangan'                => $this->input->post('keterangan'),
      'totalNominalPemeliharaan'  => $totalNominalPemeliharaan,
      'nominalAsset'              => $nominalAsset
    ];

    if ($idPemeliharaan) {
      $this->db->where('idPemeliharaan', $idPemeliharaan);
      $insert = $this->db->update('pemeliharaanAset', $dataPemeliharaan);
      if ($insert) {
        $this->db->where('idPemeliharaan', $idPemeliharaan);
        $this->db->delete('pemeliharaanAsetDetail');
      } 
    } else {
      $idPemeliharaan = uniqid('pemeliharaan');
      $dataPemeliharaan['idPemeliharaan'] = $idPemeliharaan;
      $insert = $this->db->insert('pemeliharaanAset', $dataPemeliharaan);
    }

    if ($insert) {
      $kodeBarang = $this->input->post('kodeBarang');
      $noRegister = $this->input->post('noRegister');
      $i          = 0;
      foreach ($kodeBarang as $key) {
        $this->db->insert('pemeliharaanAsetDetail', [
          'idPemeliharaan'      => $idPemeliharaan,
          'kodeBarang'          => $key,
          'nominalPemeliharaan' => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $nominalPemeliharaan[$i])
        ]);

        $this->db->where('kodeInventaris', $key);
        $this->db->where('noRegister', $noRegister[$i]);
        $this->db->update('saldoAwalInventaris', [
          'nominalPemeliharaan' => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $nominalPemeliharaan[$i]),
          'RORKini'             => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $nominalPemeliharaan[$i]) + (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $harga[$i])
        ]);

        $this->db->where('kode_barang', $key);
        $this->db->where('no_register', $noRegister[$i]);
        $this->db->update('tinventaris', [
          'nominal_pemeliharaan' => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $nominalPemeliharaan[$i]),
          'ror_kini'             => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $nominalPemeliharaan[$i]) + (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $harga[$i])
        ]);
        $i++;
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

  public function dataMutasiAset()
  {
    $this->load->library('Datatables');
    $this->datatables->select('mutasiAset.*, perusahaanPenerima.nama_perusahaan as perusahaanPenerima, perusahaanAsal.nama_perusahaan as perusahaanAsal, mnoakun.namaakun as jenisInventaris');
		$this->datatables->from('mutasiAset');
    $this->datatables->join('mperusahaan as perusahaanPenerima', 'mutasiAset.perusahaanPenerima = perusahaanPenerima.idperusahaan');
    $this->datatables->join('mperusahaan as perusahaanAsal', 'mutasiAset.perusahaanAsal = perusahaanAsal.idperusahaan');
    $this->datatables->join('mnoakun', 'mutasiAset.jenisInventaris = mnoakun.idakun');
    return $this->datatables->generate();
  }

  public function simpanMutasiAset($idMutasi = null)
  {
    $harga      = $this->input->post('harga');
    $totalHarga = 0;
    foreach ($harga as $key) {
      $totalHarga += $key;
    }

    $data = [
      'jenisInventaris'       => $this->input->post('jenisInventaris'),
      'noSuratKeputusan'      => $this->input->post('noSuratKeputusan'),
      'tanggalSuratKeputusan' => $this->input->post('tanggalSuratKeputusan'),
      'perusahaanPenerima'    => $this->input->post('perusahaanPenerima'),
      'perusahaanAsal'        => $this->input->post('perusahaanAsal'),
      'keterangan'            => $this->input->post('keterangan'),
      'nominalAsset'          => $totalHarga
    ];

    if ($idMutasi) {
      $this->db->where('idMutasi', $idMutasi);
      $insert = $this->db->update('mutasiAset', $data);
    } else {
      $idMutasi         = uniqid('mutasi');
      $data['idMutasi'] = $idMutasi;
      $insert           = $this->db->insert('mutasiAset', $data);
    }
    
    if ($insert) {
      if ($idMutasi) {
        $this->db->where('idMutasi', $idMutasi);
        $this->db->delete('mutasiAsetDetail');
      }
      $kodeBarang = $this->input->post('kodeBarang');
      foreach ($kodeBarang as $key) {
        $this->db->insert('mutasiAsetDetail', [
          'idMutasi'    => $idMutasi,
          'kodeBarang'  => $key
        ]);
      }
    } 
    return $insert;
  }

  public function dataPenghapusanAset()
  {
    $this->load->library('Datatables');
    $this->datatables->select('penghapusanAset.*, mperusahaan.kode as kodePerusahaan, mperusahaan.nama_perusahaan');
		$this->datatables->from('penghapusanAset');
    $this->datatables->join('mperusahaan', 'penghapusanAset.perusahaan = mperusahaan.idperusahaan');
    return $this->datatables->generate();
  }

  public function simpanPenghapusanAset()
  {
    $harga      = $this->input->post('harga');
    $totalHarga = 0;
    foreach ($harga as $key) {
      $totalHarga += $key;
    }
    $idPenghapusan  = uniqid('penghapusan');
    $insert         = $this->db->insert('penghapusanAset', [
      'idPenghapusan'       => $idPenghapusan,
      'perusahaan'          => $this->input->post('perusahaan'),
      'noSk'                => $this->input->post('noSk'),
      'tanggalSk'           => $this->input->post('tanggalSk'),
      'keterangan'          => $this->input->post('keterangan'),
      'nominalPenghapusan'  => $totalHarga
    ]);
    if ($insert) {
      $kodeBarang = $this->input->post('kodeBarang');
      foreach ($kodeBarang as $key) {
        $this->db->insert('penghapusanAsetDetail', [
          'idPenghapusan' => $idPenghapusan,
          'kodeBarang'    => $key
        ]);
      }
    } 
    return $insert;
  }

  public function getPemeliharaan($idPemeliharaan)
  {
    $this->db->select('pemeliharaanAset.*, mnoakun.namaakun');
    $this->db->join('mnoakun', 'pemeliharaanAset.jenisAset = mnoakun.idakun');
    $data = $this->db->get_where('pemeliharaanAset', [
      'idPemeliharaan'  => $idPemeliharaan
    ])->row_array();

    $data['detail'] = $this->db->get_where('pemeliharaanAsetDetail', [
      'idPemeliharaan'  => $idPemeliharaan
    ])->result_array();
    for ($i=0; $i < count($data['detail']); $i++) { 
      $key  = $data['detail'][$i];
      $inventaris = $this->db->get_where('saldoAwalInventaris', [
        'kodeInventaris'  => $key['kodeBarang'] 
      ])->row_array();
      if (!$inventaris) {
        $inventaris = $this->db->get_where('tinventaris', [
          'kode_barang' => $key['kodeBarang'] 
        ])->row_array();
        $data['detail'][$i]['noRegister']     = $inventaris['no_register'];
        $data['detail'][$i]['namaInventaris'] = $inventaris['nama_barang'];
        $data['detail'][$i]['tahunBeli']      = $inventaris['tanggal_perolehan'];
        $data['detail'][$i]['hargaPerolehan'] = $inventaris['nominal_asset'];
      } else {
        $data['detail'][$i]['noRegister']     = $inventaris['noRegister'];
        $data['detail'][$i]['namaInventaris'] = $inventaris['namaInventaris'];
        $data['detail'][$i]['tahunBeli']      = $inventaris['tanggalPembelian'];
        $data['detail'][$i]['hargaPerolehan'] = $inventaris['harga'];
      }
    }
    return $data;
  }

  public function getMutasi($idMutasi)
  {
    $this->db->select('mutasiAset.*, mnoakun.namaakun, mperusahaanPenerima.nama_perusahaan as namaPerusahaanPenerima, mperusahaanPenerima.kode as kodePerusahaanPenerima, mperusahaanAsal.nama_perusahaan as namaPerusahaanAsal, mperusahaanAsal.kode as kodePerusahaanAsal');
    $this->db->join('mnoakun', 'mutasiAset.jenisInventaris = mnoakun.idakun');
    $this->db->join('mperusahaan as mperusahaanPenerima', 'mutasiAset.perusahaanPenerima = mperusahaanPenerima.idperusahaan');
    $this->db->join('mperusahaan as mperusahaanAsal', 'mutasiAset.perusahaanAsal = mperusahaanAsal.idperusahaan');
    $data = $this->db->get_where('mutasiAset', [
      'idMutasi'  => $idMutasi
    ])->row_array();

    $data['detail'] = $this->db->get_where('mutasiAsetDetail', [
      'idMutasi'  => $idMutasi
    ])->result_array();

    for ($i=0; $i < count($data['detail']); $i++) { 
      $key  = $data['detail'][$i];
      $inventaris = $this->db->get_where('saldoAwalInventaris', [
        'kodeInventaris'  => $key['kodeBarang'] 
      ])->row_array();
      if (!$inventaris) {
        $inventaris = $this->db->get_where('tinventaris', [
          'kode_barang' => $key['kodeBarang'] 
        ])->row_array();
        $data['detail'][$i]['noRegister']     = $inventaris['no_register'];
        $data['detail'][$i]['namaInventaris'] = $inventaris['nama_barang'];
        $data['detail'][$i]['tahunBeli']      = $inventaris['tanggal_perolehan'];
        $data['detail'][$i]['hargaPerolehan'] = $inventaris['nominal_asset'];
      } else {
        $data['detail'][$i]['noRegister']     = $inventaris['noRegister'];
        $data['detail'][$i]['namaInventaris'] = $inventaris['namaInventaris'];
        $data['detail'][$i]['tahunBeli']      = $inventaris['tanggalPembelian'];
        $data['detail'][$i]['hargaPerolehan'] = $inventaris['harga'];
      }
    }
    return $data;
  }

  public function hapusPemeliharaanAset($idPemeliharaan)
  {
    $this->db->where('idPemeliharaan', $idPemeliharaan);
    $this->db->delete('pemeliharaanAset');
    $this->db->where('idPemeliharaan', $idPemeliharaan);
    $this->db->delete('pemeliharaanAsetDetail');
  }

  public function simpanKonfigurasiPenyusutan()
  {
    $insert = $this->db->insert('konfigurasiPenyusutan', [
      'barang'                => $this->input->post('barang'),
      'masaManfaat'           => $this->input->post('masaManfaat'),
      'batasKapitalisasi'     => $this->input->post('batasKapitalisasi'),
      'tambahanMasaManfaat'   => $this->input->post('tambahanMasaManfaat'),
      'prosentasiPenyusutan'  => $this->input->post('prosentasiPenyusutan'),
    ]);
    return $insert;
  }

  public function dataKonfigurasiPenyusutan($perusahaan = null)
  {
    $this->load->library('Datatables');
		$this->datatables->select('konfigurasiPenyusutan.*, mitem.kode as kodeBarang, mitem.nama as namaBarang');
		$this->datatables->from('konfigurasiPenyusutan');
    $this->datatables->join('mitem', 'konfigurasiPenyusutan.barang = mitem.id');
    return $this->datatables->generate();
  }
}