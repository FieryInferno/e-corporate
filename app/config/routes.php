<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']                = 'auth/login';
$route['404_override']                      = 'notfound';
$route['translate_uri_dashes']              = FALSE;
$route['SetorPajak']                        = 'SetorPajak';
$route['laporan_kas_bank']                  = 'Laporan/kasBank';
$route['laporan_buku_pembantu_kas_kecil']   = 'Laporan/bukuPembantuKasKecil';
$route['laporan_utang']						= 'Laporan/laporan_utang';
$route['laporan_piutang']					= 'Laporan/laporan_piutang';
$route['export_laporan_utang']				= 'Laporan/export_laporan_utang';
$route['export_laporan_piutang']			= 'Laporan/export_laporan_piutang';
$route['saldo_awal_hutang']                 = 'SaldoAwalHutang';
$route['saldo_awal_piutang']                = 'SaldoAwalPiutang';
$route['saldo_awal_inventaris']             = 'SaldoAwalInventaris';
$route['saldo_awal_inventaris/create']      = 'SaldoAwalInventaris/create';
$route['saldo_awal_persediaan']             = 'SaldoAwalPersediaan';
$route['saldo_awal_persediaan/create']      = 'SaldoAwalPersediaan/create';