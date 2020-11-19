<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']    = 'auth/login';
$route['404_override']          = 'notfound';
$route['translate_uri_dashes']  = FALSE;
$route['SetorPajak']            = 'SetorPajak';
$route['laporan_kas_bank']      = 'Laporan/kasBank';
$route['saldo_awal_hutang']     = 'SaldoAwalHutang';
$route['saldo_awal_piutang']    = 'SaldoAwalPiutang';