<?php

function penomoran($formulir, $perusahaan = null, $departemen = null)
{
  $ci     =& get_instance();
  $format = $ci->db->get_where('sistemPenomoran', [
    'formulir'  => $formulir
  ])->row_array();
  $arrayFormat  = explode('/', $format['formatPenomoran']);
  $noTrans      = '';
  $ci->db->order_by('nomor', 'DESC');
  if ($departemen !== null) $ci->db->where('departemen', $departemen);
  switch ($formulir) {
    case 'permintaanPembelian':
      $table  = 'tpemesanan';
      break;
    case 'fakturPembelian':
      $table  = 'tfaktur';
      break;
    case 'pesananPenjualan':
      $table  = 'tpemesananpenjualan';
      break;
    case 'pengirimanBarang':
      $table  = 'tpengirimanpenjualan';
      break;
    case 'fakturPenjualan':
      $table  = 'tfakturpenjualan';
      break;
    case 'kasBank':
      $table  = 'tkasbank';
      break;
    
    default:
      # code...
      break;
  }
  $data       = $ci->db->get($table)->row_array();
  $penomoran  = [];
  for ($i=0; $i < count($arrayFormat); $i++) { 
    $key  = $arrayFormat[$i];
    if (strrpos($key, 'nomor')) {
      $key  = (integer) substr($key, 7, 1);
      if ($data) {
        $nomor  = $data['nomor'] + 1;
      } else {
        $nomor  = 1;
      }
      $penomoran['nomor'] = $nomor;
      $panjang            = $key - strlen($nomor);
      for ($j=0; $j < $panjang; $j++) { 
        $nomor  = '0' . $nomor;
      }
      $noTrans    .= $nomor;
    } elseif (strrpos($key, 'kode_perusahaan')) {
      $data = $ci->db->get_where('mperusahaan', [
        'idperusahaan'  => $perusahaan
      ])->row_array();
      $kodePerusahaan = $data['kode'];
      $noTrans        .= $kodePerusahaan;
    } elseif (strrpos($key, 'tahun_anggaran')) {
      $tahunAnggaran  = '2021';
      $noTrans        .= $tahunAnggaran;
    } else {
      $form     = $key;
      $noTrans  .= $form;
    }
    if ($i !== (count($arrayFormat) - 1)) $noTrans .= '/';
  }
  $penomoran['notrans'] = $noTrans;
  return $penomoran;
}