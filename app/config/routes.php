<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller']                  = 'auth/login';
$route['404_override']                        = 'notfound';
$route['translate_uri_dashes']                = FALSE;
$route['SetorPajak']                          = 'SetorPajak';
$route['laporan_kas_bank']                    = 'Laporan/kasBank';
$route['laporan_buku_pembantu_kas_kecil']     = 'Laporan/bukuPembantuKasKecil';
$route['laporan_utang']						            = 'Laporan/laporan_utang';
$route['laporan_piutang']					            = 'Laporan/laporan_piutang';
$route['export_laporan_utang']				        = 'Laporan/export_laporan_utang';
$route['export_laporan_piutang']			        = 'Laporan/export_laporan_piutang';
$route['outstanding_invoice']                 = 'Laporan/outstandingInvoice';
$route['outstanding_payable']                 = 'Laporan/outstandingPayable';
$route['project_list']                        = 'Laporan/projectList';

$route['saldo_awal_hutang']                   = 'SaldoAwalHutang';

$route['saldo_awal_piutang']                  = 'SaldoAwalPiutang';

$route['saldo_awal_inventaris']               = 'SaldoAwalInventaris';
$route['saldo_awal_inventaris/create']        = 'SaldoAwalInventaris/create';

$route['saldo_awal_persediaan']               = 'SaldoAwalPersediaan';
$route['saldo_awal_persediaan/create']        = 'SaldoAwalPersediaan/create';

$route['pemeliharaan_aset']                   = 'Inventaris/pemeliharaanAset';
$route['pemeliharaan_aset/tambah']            = 'Inventaris/tambahPemeliharaanAset';
$route['pemeliharaan_aset/simpan']            = 'Inventaris/simpanPemeliharaanAset';
$route['pemeliharaan_aset/data']              = 'Inventaris/dataPemeliharaanAset';
$route['pemeliharaan_aset/edit/(:any)']       = 'Inventaris/editPemeliharaanAset/$1';
$route['pemeliharaan_aset/hapus/(:any)']      = 'Inventaris/hapusPemeliharaanAset/$1';

$route['mutasi_aset']						              = 'Inventaris/mutasiAset';
$route['mutasi_aset/tambah']						      = 'Inventaris/tambahMutasiAset';
$route['mutasi_aset/simpan']						      = 'Inventaris/simpanMutasiAset';
$route['mutasi_aset/data']						        = 'Inventaris/dataMutasiAset';
$route['mutasi_aset/edit/(:any)']             = 'Inventaris/editMutasiAset/$1';
$route['mutasi_aset/hapus/(:any)']            = 'Inventaris/hapusMutasiAset/$1';

$route['penghapusan_aset']						        = 'Inventaris/penghapusanAset';
$route['penghapusan_aset/data']						    = 'Inventaris/dataPenghapusanAset';
$route['penghapusan_aset/tambah']						  = 'Inventaris/tambahPenghapusanAset';
$route['penghapusan_aset/simpan']						  = 'Inventaris/simpanPenghapusanAset';
$route['penghapusan_aset/edit/(:any)']        = 'Inventaris/editPenghapusanAset/$1';

$route['tahun_anggaran']                      = 'Tahunanggaran';
$route['tahun_anggaran/create']               = 'Tahunanggaran/create';
$route['tahun_anggaran/edit/(:any)']          = 'Tahunanggaran/edit/$1';


$route['laporan_neraca']						          = 'Laporan/laporan_neraca';
$route['laporan_neraca_standar']						  = 'Laporan/laporan_neraca_standar';
$route['export_laporan_neraca_standar']			  = 'Laporan/export_laporan_neraca_standar';

$route['export_laporan_neraca']			          = 'Laporan/export_laporan_neraca';

$route['laporan_neraca_multi_period']				  = 'Laporan/neracaMultiPeriod';

$route['sistem_penomoran']				            = 'SistemPenomoran';
$route['sistem_penomoran/tambah']				      = 'SistemPenomoran/tambah';
$route['sistem_penomoran/edit/(:any)']			  = 'SistemPenomoran/edit/$1';

$route['konfigurasi_penyusutan']			        = 'Inventaris/konfigurasiPenyusutan';
$route['konfigurasi_penyusutan/tambah']			  = 'Inventaris/tambahKonfigurasiPenyusutan';
$route['konfigurasi_penyusutan/simpan']			  = 'Inventaris/simpanKonfigurasiPenyusutan';
$route['konfigurasi_penyusutan/data']			    = 'Inventaris/dataKonfigurasiPenyusutan';
$route['konfigurasi_penyusutan/edit/(:any)']  = 'Inventaris/editKonfigurasiPenyusutan/$1';

$route['laporan_labarugi/standar']            = 'Laporan/labarugiStandar';
$route['laporan_labarugi/multi_period']       = 'Laporan/labarugiMultiPeriod';
$route['laporan_labarugi/compare_period']     = 'Laporan/labarugiComparePeriod';

$route['sales_receipts_detail']               = 'Laporan/salesReceiptsDetail';

$route['purchase_payment_detail']             = 'Laporan/purchasePaymentDetail';

$route['nomor_akun']                          = 'noakun';
$route['nomor_akun/tambah']                   = 'noakun/tambah';
$route['nomor_akun/edit/(:any)']              = 'noakun/edit/$1';