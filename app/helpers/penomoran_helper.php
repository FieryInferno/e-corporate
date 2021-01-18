<?php

function penomoran($formulir, $perusahaan)
{
  $ci     =& get_instance();
  $format = $ci->db->get_where('sistemPenomoran', [
    'formulir'  => $formulir
  ])->row_array();
  $arrayFormat  = explode('/', $format['formatPenomoran']);
  $noTrans  = '';
  for ($i=0; $i < count($arrayFormat); $i++) { 
    $key  = $arrayFormat[$i];
    if (strrpos($key, 'nomor')) {
      $key  = substr($key, 6);
      $ci->db->order_by('notrans', 'DESC');
      $data       = $ci->db->get('tpemesanan')->row_array();
      if ($data) {
        $arrayData  = explode('/', $data['notrans']);
        $nomor      = (integer) $arrayData[$i] + 1;
      } else {
        $nomor  = 1;
      }
      switch (strlen($nomor)) {
        case 1:
          $nomor  = '0000' . $nomor; 
          break;
        case 2:
          $nomor  = '000' . $nomor; 
          break;
        case 3:
          $nomor  = '00' . $nomor; 
          break;
        case 4:
          $nomor  = '0' . $nomor; 
          break;
        case 5:
          $nomor  = $nomor; 
          break;
        
        default:
          # code...
          break;
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
  return $noTrans;
}