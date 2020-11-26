<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();
$autoload['libraries'] = array('session','database','parser', 'upload', 'form_validation');
$autoload['drivers'] = array();
$autoload['helper'] = array('url','basic','query');
$autoload['config'] = array();
$autoload['language'] = array('general');
$autoload['model'] = array('general_model' => 'general', 'Pajak_model', 'Noakun_model', 'Pemesanan_pembelian_model', 'Metaakun_model', 'SetUpJurnal_Model', 'JurnalAnggaranModel', 'JurnalFinansialModel', 'Jurnal_penyesuaian_model', 'Faktur_pembelian_model', 'Pemesanan_pembelian_model', 'Faktur_penjualan_model', 'SaldoAwalHutangModel', 'SaldoAwalPiutangModel', 'SaldoAwalInventarisModel', 'SaldoAwalPersediaanModel', 'PersediaanModel', 'SetorPajakModel', 'SistemPenomoranModel', 'LaporanModel', 'Jurnal_model');
