/*
 Navicat Premium Data Transfer

 Source Server         : LOCALHOST
 Source Server Type    : MySQL
 Source Server Version : 50727
 Source Host           : localhost:3306
 Source Schema         : db_jurnal_jualan

 Target Server Type    : MySQL
 Target Server Version : 50727
 File Encoding         : 65001

 Date: 08/03/2020 20:51:30
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for manggotakoperasi
-- ----------------------------
DROP TABLE IF EXISTS `manggotakoperasi`;
CREATE TABLE `manggotakoperasi`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NULL DEFAULT NULL,
  `nama` varchar(100) NULL DEFAULT NULL,
  `email` varchar(100) NULL DEFAULT NULL,
  `telepon` varchar(15) NULL DEFAULT NULL,
  `alamat` varchar(255) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(255) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(255) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of manggotakoperasi
-- ----------------------------
INSERT INTO `manggotakoperasi` VALUES (1, 'A001', 'Pak Asep', 'asep@gmail.com', '085840557925', 'Majalengka', '0', 'admin', '2020-02-29 19:15:42', 'admin', '2020-02-29 19:16:47', 'admin', '2020-02-29 19:16:58');

-- ----------------------------
-- Table structure for mbahasa
-- ----------------------------
DROP TABLE IF EXISTS `mbahasa`;
CREATE TABLE `mbahasa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bahasa` varchar(30) NULL DEFAULT NULL,
  `kode` varchar(10) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mbahasa
-- ----------------------------
INSERT INTO `mbahasa` VALUES (1, 'Indonesia', 'ID');
INSERT INTO `mbahasa` VALUES (2, 'English', 'EN');

-- ----------------------------
-- Table structure for mbahasadetail
-- ----------------------------
DROP TABLE IF EXISTS `mbahasadetail`;
CREATE TABLE `mbahasadetail`  (
  `idbahasa` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `deskripsi` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`idbahasa`, `kode`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mbahasadetail
-- ----------------------------
INSERT INTO `mbahasadetail` VALUES (1, 'acceptedby', 'Diterima Oleh');
INSERT INTO `mbahasadetail` VALUES (1, 'account', 'Akun');
INSERT INTO `mbahasadetail` VALUES (1, 'account_header', 'Akun Header');
INSERT INTO `mbahasadetail` VALUES (1, 'account_number', 'Nomor Akun');
INSERT INTO `mbahasadetail` VALUES (1, 'account_setting', 'Pengaturan Akun');
INSERT INTO `mbahasadetail` VALUES (1, 'action', 'Aksi');
INSERT INTO `mbahasadetail` VALUES (1, 'add_new', 'Tambah Baru');
INSERT INTO `mbahasadetail` VALUES (1, 'add_row', 'Tambah Baris');
INSERT INTO `mbahasadetail` VALUES (1, 'adjusted_trial_balance', 'Neraca Saldo Penyesuaian');
INSERT INTO `mbahasadetail` VALUES (1, 'adjusting_entries', 'Jurnal Penyesuaian');
INSERT INTO `mbahasadetail` VALUES (1, 'apply', 'Terapkan');
INSERT INTO `mbahasadetail` VALUES (1, 'available_quantity', 'Jumlah Tersedia');
INSERT INTO `mbahasadetail` VALUES (1, 'back', 'Kembali');
INSERT INTO `mbahasadetail` VALUES (1, 'balance', 'Saldo');
INSERT INTO `mbahasadetail` VALUES (1, 'balance_sheet', 'Neraca');
INSERT INTO `mbahasadetail` VALUES (1, 'beginning_balance', 'Saldo Awal');
INSERT INTO `mbahasadetail` VALUES (1, 'cancel', 'Batal');
INSERT INTO `mbahasadetail` VALUES (1, 'cashflow', 'Arus Kas');
INSERT INTO `mbahasadetail` VALUES (1, 'category', 'Kategori');
INSERT INTO `mbahasadetail` VALUES (1, 'change_password', 'Ganti Kata Sandi');
INSERT INTO `mbahasadetail` VALUES (1, 'code', 'Kode');
INSERT INTO `mbahasadetail` VALUES (1, 'confirm_delete', 'Apakah Anda yakin akan menghapus data ini?');
INSERT INTO `mbahasadetail` VALUES (1, 'contact', 'Kontak');
INSERT INTO `mbahasadetail` VALUES (1, 'conversion', 'Konversi');
INSERT INTO `mbahasadetail` VALUES (1, 'conversion_date', 'Tanggal Konversi');
INSERT INTO `mbahasadetail` VALUES (1, 'create_invoice', 'Buat Faktur');
INSERT INTO `mbahasadetail` VALUES (1, 'dashboard', 'Menu Utama');
INSERT INTO `mbahasadetail` VALUES (1, 'data_not_found', 'Data tidak ditemukan');
INSERT INTO `mbahasadetail` VALUES (1, 'date', 'Tanggal');
INSERT INTO `mbahasadetail` VALUES (1, 'debet', 'Debet');
INSERT INTO `mbahasadetail` VALUES (1, 'default_balance', 'Default Saldo');
INSERT INTO `mbahasadetail` VALUES (1, 'delete', 'Hapus');
INSERT INTO `mbahasadetail` VALUES (1, 'delivery', 'Pengiriman');
INSERT INTO `mbahasadetail` VALUES (1, 'detail', 'Detail');
INSERT INTO `mbahasadetail` VALUES (1, 'discount', 'Diskon');
INSERT INTO `mbahasadetail` VALUES (1, 'done', 'Selesai');
INSERT INTO `mbahasadetail` VALUES (1, 'edit', 'Ubah');
INSERT INTO `mbahasadetail` VALUES (1, 'email', 'Email');
INSERT INTO `mbahasadetail` VALUES (1, 'ending_balance', 'Saldo Akhir');
INSERT INTO `mbahasadetail` VALUES (1, 'end_date', 'Tanggal Akhir');
INSERT INTO `mbahasadetail` VALUES (1, 'error_deleted', 'Data Gagal dihapus');
INSERT INTO `mbahasadetail` VALUES (1, 'error_login', 'Kesalahan Login');
INSERT INTO `mbahasadetail` VALUES (1, 'error_save', 'Data gagal disimpan');
INSERT INTO `mbahasadetail` VALUES (1, 'error_updated', 'Data Gagal diubah');
INSERT INTO `mbahasadetail` VALUES (1, 'export', 'Ekspor');
INSERT INTO `mbahasadetail` VALUES (1, 'from', 'Dari');
INSERT INTO `mbahasadetail` VALUES (1, 'general_journal', 'Jurnal Umum');
INSERT INTO `mbahasadetail` VALUES (1, 'goods_receipt', 'Penerimaan Barang');
INSERT INTO `mbahasadetail` VALUES (1, 'grand_total', 'Total Keseluruhan');
INSERT INTO `mbahasadetail` VALUES (1, 'header_status', 'Status Header');
INSERT INTO `mbahasadetail` VALUES (1, 'income_statement', 'Laba Rugi');
INSERT INTO `mbahasadetail` VALUES (1, 'inventory_account', 'Akun Persediaan');
INSERT INTO `mbahasadetail` VALUES (1, 'invoice', 'Faktur');
INSERT INTO `mbahasadetail` VALUES (1, 'item', 'Item');
INSERT INTO `mbahasadetail` VALUES (1, 'journal', 'Jurnal');
INSERT INTO `mbahasadetail` VALUES (1, 'journal_entry', 'Entri Jurnal');
INSERT INTO `mbahasadetail` VALUES (1, 'kredit', 'Kredit');
INSERT INTO `mbahasadetail` VALUES (1, 'ledger', 'Buku Besar');
INSERT INTO `mbahasadetail` VALUES (1, 'list', 'List');
INSERT INTO `mbahasadetail` VALUES (1, 'lock', 'Kunci');
INSERT INTO `mbahasadetail` VALUES (1, 'login', 'Masuk');
INSERT INTO `mbahasadetail` VALUES (1, 'logout', 'Keluar');
INSERT INTO `mbahasadetail` VALUES (1, 'memos', 'Memo');
INSERT INTO `mbahasadetail` VALUES (1, 'name', 'Nama');
INSERT INTO `mbahasadetail` VALUES (1, 'new_password', 'Kata Sandi Baru');
INSERT INTO `mbahasadetail` VALUES (1, 'noakunpiutang', 'Akun Piutang');
INSERT INTO `mbahasadetail` VALUES (1, 'noakunutang', 'Akun Utang');
INSERT INTO `mbahasadetail` VALUES (1, 'note', 'Catatan');
INSERT INTO `mbahasadetail` VALUES (1, 'notrans', 'No Trans');
INSERT INTO `mbahasadetail` VALUES (1, 'order', 'Pemesanan');
INSERT INTO `mbahasadetail` VALUES (1, 'paidby', 'Dibayar Dengan');
INSERT INTO `mbahasadetail` VALUES (1, 'partial', 'Sebagian');
INSERT INTO `mbahasadetail` VALUES (1, 'password', 'Kata Sandi');
INSERT INTO `mbahasadetail` VALUES (1, 'payment', 'Pembayaran');
INSERT INTO `mbahasadetail` VALUES (1, 'payment_method', 'Metode Pembayaran');
INSERT INTO `mbahasadetail` VALUES (1, 'payment_status', 'Status Pembayaran');
INSERT INTO `mbahasadetail` VALUES (1, 'pending', 'Menunggu');
INSERT INTO `mbahasadetail` VALUES (1, 'permission', 'Hak Akses');
INSERT INTO `mbahasadetail` VALUES (1, 'ppn', 'PPN');
INSERT INTO `mbahasadetail` VALUES (1, 'price', 'Harga');
INSERT INTO `mbahasadetail` VALUES (1, 'print', 'Cetak');
INSERT INTO `mbahasadetail` VALUES (1, 'purchase_account', 'Akun Pembelian');
INSERT INTO `mbahasadetail` VALUES (1, 'purchase_order', 'Pemesanan Pembelian');
INSERT INTO `mbahasadetail` VALUES (1, 'purchase_price', 'Harga Beli');
INSERT INTO `mbahasadetail` VALUES (1, 'purchase_report', 'Laporan Pembelian');
INSERT INTO `mbahasadetail` VALUES (1, 'purchase_return_report', 'Laporan Retur Pembelian');
INSERT INTO `mbahasadetail` VALUES (1, 'purchasing', 'Pembelian');
INSERT INTO `mbahasadetail` VALUES (1, 'purchasing_report', 'Laporan Pembelian');
INSERT INTO `mbahasadetail` VALUES (1, 'qty', 'Jumlah');
INSERT INTO `mbahasadetail` VALUES (1, 'qty_available', 'Jumlah Tersedia');
INSERT INTO `mbahasadetail` VALUES (1, 'qty_ordered', 'Jumlah Dipesan');
INSERT INTO `mbahasadetail` VALUES (1, 'qty_received', 'Jumlah Diterima');
INSERT INTO `mbahasadetail` VALUES (1, 'qty_residual', 'Jumlah Sisa');
INSERT INTO `mbahasadetail` VALUES (1, 'qty_return', 'Jumlah Retur');
INSERT INTO `mbahasadetail` VALUES (1, 'report', 'Laporan');
INSERT INTO `mbahasadetail` VALUES (1, 'residual', 'Sisa');
INSERT INTO `mbahasadetail` VALUES (1, 'residual_value', 'Sisa Tagihan');
INSERT INTO `mbahasadetail` VALUES (1, 'return', 'Retur');
INSERT INTO `mbahasadetail` VALUES (1, 'return_option', 'Opsi Retur');
INSERT INTO `mbahasadetail` VALUES (1, 'return_reason', 'Alasan Retur');
INSERT INTO `mbahasadetail` VALUES (1, 'sales', 'Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'sales_account', 'Akun Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'sales_order', 'Pemesanan Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'sales_price', 'Harga Jual');
INSERT INTO `mbahasadetail` VALUES (1, 'sales_report', 'Laporan Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'sales_return_report', 'Laporan Retur Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'save', 'Simpan');
INSERT INTO `mbahasadetail` VALUES (1, 'search', 'Cari');
INSERT INTO `mbahasadetail` VALUES (1, 'selling', 'Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'selling_report', 'Laporan Penjualan');
INSERT INTO `mbahasadetail` VALUES (1, 'start_date', 'Tanggal Awal');
INSERT INTO `mbahasadetail` VALUES (1, 'statement_of_Owner_Equity', 'Perubahan Modal');
INSERT INTO `mbahasadetail` VALUES (1, 'status', 'Status');
INSERT INTO `mbahasadetail` VALUES (1, 'stock', 'Stok');
INSERT INTO `mbahasadetail` VALUES (1, 'stock_card', 'Kartu Stok');
INSERT INTO `mbahasadetail` VALUES (1, 'stock_report', 'Laporan Stok');
INSERT INTO `mbahasadetail` VALUES (1, 'subtotal', 'Subtotal');
INSERT INTO `mbahasadetail` VALUES (1, 'supplier', 'Rekanan');
INSERT INTO `mbahasadetail` VALUES (1, 'telephone', 'Telepon');
INSERT INTO `mbahasadetail` VALUES (1, 'to', 'Kepada');
INSERT INTO `mbahasadetail` VALUES (1, 'total', 'Total');
INSERT INTO `mbahasadetail` VALUES (1, 'totalpaid', 'Total yang Dibayarkan');
INSERT INTO `mbahasadetail` VALUES (1, 'total_debet', 'Total Debet');
INSERT INTO `mbahasadetail` VALUES (1, 'total_kredit', 'Total Kredit');
INSERT INTO `mbahasadetail` VALUES (1, 'trial_balance', 'Neraca Saldo');
INSERT INTO `mbahasadetail` VALUES (1, 'type', 'Tipe');
INSERT INTO `mbahasadetail` VALUES (1, 'unit', 'Satuan');
INSERT INTO `mbahasadetail` VALUES (1, 'update_error_message', 'Data gagal diupdate');
INSERT INTO `mbahasadetail` VALUES (1, 'update_success_message', 'Data berhasil diubah');
INSERT INTO `mbahasadetail` VALUES (1, 'user', 'User');
INSERT INTO `mbahasadetail` VALUES (1, 'username', 'Nama Pengguna');
INSERT INTO `mbahasadetail` VALUES (1, 'user_management', 'Pengelolaan User');
INSERT INTO `mbahasadetail` VALUES (1, 'view_journal', 'Lihat Jurnal');
INSERT INTO `mbahasadetail` VALUES (1, 'warehouse', 'Gudang');

-- ----------------------------
-- Table structure for mcabang
-- ----------------------------
DROP TABLE IF EXISTS `mcabang`;
CREATE TABLE `mcabang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(10) NULL DEFAULT NULL,
  `nama` varchar(255) NULL DEFAULT NULL,
  `alamat` varchar(255) NULL DEFAULT NULL,
  `keterangan` varchar(255) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(60) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(60) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(60) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mcabang
-- ----------------------------
INSERT INTO `mcabang` VALUES (1, 'JKTTMR', 'Cabang Pusat', 'Jakarta', NULL, '0', 'admin', '2020-02-29 15:03:23', 'admin', '2020-02-29 18:55:28', NULL, NULL);

-- ----------------------------
-- Table structure for mcarabayar
-- ----------------------------
DROP TABLE IF EXISTS `mcarabayar`;
CREATE TABLE `mcarabayar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(30) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(60) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(60) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(60) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mcarabayar
-- ----------------------------
INSERT INTO `mcarabayar` VALUES (1, 'Kas Tunai', '0', NULL, NULL, 'admin', '2019-05-15 13:40:34', NULL, NULL);
INSERT INTO `mcarabayar` VALUES (2, 'Cek & Giro', '1', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mcarabayar` VALUES (3, 'Transfer Bank', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mcarabayar` VALUES (4, 'Kartu Kredit', '1', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mgudang
-- ----------------------------
DROP TABLE IF EXISTS `mgudang`;
CREATE TABLE `mgudang`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NULL DEFAULT NULL,
  `alamat` varchar(255) NULL DEFAULT NULL,
  `keterangan` varchar(255) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(60) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(60) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(60) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mgudang
-- ----------------------------
INSERT INTO `mgudang` VALUES (1, 'Gudang Jayapura', 'Majalengka', '-', '1', NULL, NULL, 'admin', '2019-08-21 07:36:54', 'admin', '2019-08-27 16:30:49');
INSERT INTO `mgudang` VALUES (2, 'Gudang A', NULL, NULL, '1', 'admin', '2019-05-15 13:20:22', NULL, NULL, NULL, NULL);
INSERT INTO `mgudang` VALUES (3, 'GUDANG PUSAT', NULL, NULL, '1', 'userdemo', '2019-07-01 16:12:39', NULL, NULL, 'admin', '2019-08-27 16:30:53');
INSERT INTO `mgudang` VALUES (4, 'Gudang Maumere', NULL, NULL, '1', 'admin', '2019-08-21 07:37:08', NULL, NULL, 'admin', '2019-08-27 16:31:13');
INSERT INTO `mgudang` VALUES (5, 'Gudang A', NULL, NULL, '0', 'admin', '2019-08-27 16:58:01', 'admin', '2020-03-05 03:07:31', NULL, NULL);
INSERT INTO `mgudang` VALUES (6, 'Gudang 1', NULL, NULL, '1', 'admin', '2019-08-27 16:58:02', NULL, NULL, 'admin', '2019-08-27 16:58:13');
INSERT INTO `mgudang` VALUES (7, 'Gudang B', NULL, NULL, '0', 'admin', '2019-08-30 12:48:59', 'admin', '2020-03-05 03:07:25', NULL, NULL);

-- ----------------------------
-- Table structure for mitem
-- ----------------------------
DROP TABLE IF EXISTS `mitem`;
CREATE TABLE `mitem`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(20) NULL DEFAULT NULL,
  `nama` varchar(255) NULL DEFAULT NULL,
  `satuanid` int(11) NULL DEFAULT NULL,
  `kategoriid` int(11) NULL DEFAULT NULL,
  `hargabeli` decimal(10, 0) NULL DEFAULT NULL,
  `hargajual` decimal(10, 0) NULL DEFAULT NULL,
  `hargabeliterakhir` decimal(10, 0) NULL DEFAULT NULL,
  `noakunbeli` varchar(20) NULL DEFAULT NULL,
  `noakunjual` varchar(20) NULL DEFAULT NULL,
  `noakunpersediaan` varchar(20) NULL DEFAULT NULL,
  `noakunpajak` varchar(20) NULL DEFAULT NULL,
  `noakunpajakmasukan` varchar(20) NULL DEFAULT NULL,
  `noakunpajakkeluaran` varchar(20) NULL DEFAULT NULL,
  `gambar` varchar(100) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(100) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(100) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(255) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mitem
-- ----------------------------
INSERT INTO `mitem` VALUES (1, 'MI-5PLUS', 'HP Xiaomi 5 Plus', 2, 2, 1800000, 2000000, 1800000, '51141', '41111', '13111', '1412', '1412', '2212', '159fb0ede2f18ad497045e39a5935c32.jpg', '0', NULL, NULL, 'admin', '2020-02-07 21:57:02', 'admin', '2019-08-27 16:31:22');
INSERT INTO `mitem` VALUES (4, '#PROD0001', 'Samsung Gal S9', 2, 2, 500000, 1000000, 500000, '51142', '41112', '13112', '1412', '1412', '2212', '9d78ec32898c3c17614060506bd7c7f8.jpg', '0', 'admin', '2020-03-05 04:02:39', 'admin', '2020-03-05 04:03:21', NULL, NULL);

-- ----------------------------
-- Table structure for mjasa
-- ----------------------------
DROP TABLE IF EXISTS `mjasa`;
CREATE TABLE `mjasa`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NULL DEFAULT NULL,
  `kode` varchar(20) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(60) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(60) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(60) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of mjasa
-- ----------------------------
INSERT INTO `mjasa` VALUES (1, 'Jasa Pembuatan Website', 'J001', '0', 'admin', '2020-02-29 18:53:44', NULL, NULL, 'admin', '2020-02-29 18:54:03');

-- ----------------------------
-- Table structure for mkategori
-- ----------------------------
DROP TABLE IF EXISTS `mkategori`;
CREATE TABLE `mkategori`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `uby` varchar(100) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `cby` varchar(100) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(100) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mkategori
-- ----------------------------
INSERT INTO `mkategori` VALUES (1, 'ATK', '0', 'admin', '2019-06-20 04:05:17', 'admin', '2019-05-15 15:20:20', NULL, NULL);
INSERT INTO `mkategori` VALUES (2, 'Elektronik', '0', 'admin', '2019-06-21 09:12:21', NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mkontak
-- ----------------------------
DROP TABLE IF EXISTS `mkontak`;
CREATE TABLE `mkontak`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` char(1) NULL DEFAULT NULL,
  `nama` varchar(60) NULL DEFAULT NULL,
  `telepon` varchar(20) NULL DEFAULT NULL,
  `email` varchar(60) NULL DEFAULT NULL,
  `alamat` varchar(255) NULL DEFAULT NULL,
  `cp` varchar(255) NULL DEFAULT NULL,
  `noakunpiutang` varchar(30) NULL DEFAULT NULL,
  `noakunutang` varchar(30) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(60) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(60) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(60) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  `debetmemo` decimal(10, 0) NULL DEFAULT 0,
  `kreditmemo` decimal(10, 0) NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mkontak
-- ----------------------------
INSERT INTO `mkontak` VALUES (1, '2', 'Pelanggan Anonim', '089100000', 'isyanto.id@gmail.com', 'Bandung', 'Contact Person', '12111', '2111', '0', NULL, NULL, 'admin', '2019-06-19 07:33:34', NULL, NULL, 0, 0);
INSERT INTO `mkontak` VALUES (2, '1', 'CV DroidPhone', '089100000', 'droidphone@gmail.com', 'Bandung', 'Tn Iyan Isyanto', '1211', '2113', '0', 'admin', '2019-05-16 08:46:47', 'admin', '2019-10-13 16:18:25', NULL, NULL, 0, 0);

-- ----------------------------
-- Table structure for mnoakun
-- ----------------------------
DROP TABLE IF EXISTS `mnoakun`;
CREATE TABLE `mnoakun`  (
  `noakuntop` varchar(1) NULL DEFAULT NULL,
  `noakunheader` varchar(255) NULL DEFAULT NULL,
  `noakun` varchar(255) NOT NULL,
  `namaakun` varchar(255) NULL DEFAULT NULL,
  `saldo` decimal(10, 0) NULL DEFAULT NULL,
  `stheader` char(1) NULL DEFAULT '1',
  `stdebet` char(1) NULL DEFAULT NULL,
  `stbayar` char(1) NULL DEFAULT NULL,
  `stkunci` char(1) NULL DEFAULT '1',
  `stdefault` char(1) NULL DEFAULT NULL,
  `kategoriakun` varchar(30) NULL DEFAULT NULL,
  `sthapus` char(1) NULL DEFAULT '0',
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(255) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(255) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`noakun`) USING BTREE,
  INDEX `namaakun`(`namaakun`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mnoakun
-- ----------------------------
INSERT INTO `mnoakun` VALUES ('1', '1', '11', 'ASET', NULL, '1', NULL, '0', '1', '1', 'ASET', '0', '0', NULL, NULL, 'admin', '2019-06-18 04:22:33', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '11', '111', 'Kas & Bank', NULL, '1', NULL, '0', '1', '1', 'Kas & Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '111', '1111', 'Kas Kasir', NULL, '0', '1', '1', '1', '0', 'Kas & Bank', '0', '0', NULL, NULL, 'admin', '2019-06-18 04:22:44', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '111', '1112', 'Bank BCA', NULL, '0', '1', '1', '1', '0', 'Kas & Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '12', '121', 'Akun Piutang', NULL, '1', NULL, '0', '1', '1', 'Piutang', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '121', '1211', 'Piutang Usaha', NULL, '1', '1', '1', '1', '1', 'Piutang', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '1211', '12111', 'Piutang Kepada Pelanggan Anonim', NULL, '1', '1', '1', '1', '0', 'Piutang', '0', '0', NULL, NULL, 'admin', '2019-06-19 07:33:56', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '1211', '12112', 'Piutang Kepada Asep', 0, '0', '1', '1', '1', NULL, 'Piutang', '0', '0', 'admin', '2019-06-29 10:33:01', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '121', '1212', 'Piutang Belum Ditagih', NULL, '1', '1', '1', '1', '1', 'Piutang', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '121', '1213', 'Piutang Lain-lain', NULL, '1', '1', '1', '1', NULL, 'Piutang', '0', '0', 'admin', '2019-06-19 11:54:05', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '1213', '12131', 'Piutang Kepada Kawan', NULL, '1', '1', '1', '1', NULL, 'Piutang', '0', '0', 'admin', '2019-06-19 11:56:31', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '13', '131', 'Persediaan', NULL, '1', NULL, '0', '1', '1', 'Persediaan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '131', '1311', 'Persediaan Barang', NULL, '0', '1', '1', '1', '1', 'Persediaan', '0', '0', NULL, NULL, 'admin', '2019-08-27 15:12:17', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '1311', '13111', 'Persediaan Xiami 5 Plus', NULL, '0', '1', '1', '1', '0', 'Persediaan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '1311', '13112', 'Persediaan Samsung Gal S9', NULL, '0', '1', '1', '1', NULL, 'Persediaan', '0', '0', 'admin', '2019-06-19 07:22:40', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '14', '141', 'Aktiva Lancar Lainnya', NULL, '1', NULL, '0', '1', '1', 'Aktiva Lancar Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '141', '1411', 'Biaya Dibayar Dimuka', NULL, '0', '1', '1', '1', '1', 'Aktiva Lancar Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '141', '1412', 'PPN Masukan', NULL, '0', '1', '1', '1', '1', 'Aktiva Lancar Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '15', '151', 'Aktiva Tetap', NULL, '1', NULL, '0', '1', '1', 'Aktiva Tetap', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '151', '1511', 'Peralatan', NULL, '1', '1', '1', '1', '1', 'Aktiva Tetap', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '1511', '15111', 'Komputer', 0, '0', '1', '1', '1', NULL, 'Aktiva Tetap', '0', '0', 'admin', '2019-07-12 14:22:23', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '151', '1512', 'Kendaraan', NULL, '1', '1', '1', '1', '1', 'Aktiva Tetap', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '151', '1513', 'Bangunan', NULL, '1', '1', '1', '1', '1', 'Aktiva Tetap', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '151', '1514', 'Tanah', NULL, '1', '1', '1', '1', '1', 'Aktiva Tetap', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('1', '16', '161', 'Aktiva Lainya', NULL, '1', NULL, '0', '1', '1', 'Aktiva Lainya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '2', '21', 'LIABILITAS', NULL, '1', NULL, '0', '1', '1', 'LIABILITAS', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '21', '211', 'Akun Hutang', NULL, '1', NULL, '0', '1', '1', 'Hutang', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '211', '2111', 'Hutang Usaha', NULL, '0', '0', '1', '1', '1', 'Hutang', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '2111', '21111', 'Hutang Kepada Iva F.', NULL, '0', '0', '1', '1', '0', 'Hutang', '0', '0', 'admin', '2019-06-18 09:21:27', 'admin', '2019-06-27 14:30:43', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '211', '2112', 'Hutang Belum Ditagih', NULL, '0', '0', '0', '1', '1', 'Hutang', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '211', '2113', 'Hutang Kepada Cv. DoidPhone', 0, '0', '0', '1', '1', NULL, 'Hutang', '0', '0', 'admin', '2019-07-01 02:32:35', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '211', '2114', 'Kasbon Bahri', 0, '1', '1', '1', '1', NULL, 'Hutang', '0', '0', 'admin', '2019-08-30 13:15:43', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '22', '221', 'Kewajiban Lancar Lainnya', NULL, '1', '0', '0', '1', '1', 'Kewajiban Lancar Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '221', '2211', 'Pendapatan Diterima di Muka', NULL, '0', '0', '1', '1', '1', 'Kewajiban Lancar Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('2', '221', '2212', 'PPN Keluaran', NULL, '0', '0', '1', '1', '1', 'Kewajiban Lancar Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('3', '3', '31', 'EKUITAS', NULL, '1', NULL, '0', '1', '1', 'EKUITAS', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('3', '31', '311', 'Ekuitas', NULL, '1', NULL, '0', '1', '1', 'Modal', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('3', '311', '3111', 'Ekuitas Saldo Awal', NULL, '0', '0', '1', '1', '1', 'Modal', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('3', '311', '3112', 'Modal Tn. Iyan', NULL, '0', '0', '1', '1', NULL, 'Modal', '0', '0', 'admin', '2019-06-19 07:27:35', 'admin', '2019-06-19 10:17:33', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('3', '31', '312', 'Prive', NULL, '1', '1', '1', '1', '0', 'Prive', '0', '0', 'admin', '2019-06-19 04:50:02', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('3', '312', '3121', 'Pengambilan Prive Iyan', NULL, '0', '1', '1', '1', '1', 'Prive', '0', '0', 'admin', '2019-06-19 10:03:16', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '4', '41', 'PENDAPATAN', NULL, '1', NULL, '0', '1', '1', 'PENDAPATAN', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '41', '411', 'Pendapatan', NULL, '1', NULL, '0', '1', '1', 'Pendapatan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '411', '4111', 'Penjualan', NULL, '1', '0', '1', '1', '1', 'Penjualan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '4111', '41111', 'Penjualan Xiaomi 5 Plus', NULL, '0', '0', '1', '1', '0', 'Penjualan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '4111', '41112', 'Penjualan Samsung Gal S9', NULL, '0', '0', '1', '1', NULL, 'Penjualan', '0', '0', 'admin', '2019-06-19 07:21:57', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '411', '4112', 'Diskon Penjualan', NULL, '0', '1', '1', '1', '1', 'Potongan Penjualan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '411', '4113', 'Retur Penjualan', NULL, '0', '1', '1', '1', '1', 'Retur Penjualan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '411', '4114', 'Pendapatan Belum Ditagih', NULL, '0', '0', '1', '1', '1', 'Pendapatan', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('4', '42', '421', 'Pendapatan Lainnya', NULL, '1', NULL, '0', '1', '1', 'Pendapatan Lainnya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '5', '51', 'BEBAN', NULL, '1', NULL, '0', '1', '1', 'BEBAN', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '51', '511', 'Harga Pokok Penjualan', NULL, '1', NULL, '0', '1', '1', 'HPP', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '511', '5111', 'Diskon Pembelian', NULL, '1', '0', '1', '1', '1', 'Diskon Pembelian', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '511', '5112', 'Harga Pokok Penjualan', NULL, '1', '1', '1', '1', '1', 'HPP', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '5114', '51141', 'HPP Xiaomi 5 Plus', NULL, '0', '1', '1', '1', '0', 'HPP', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '5114', '51142', 'HPP Samsung Gal S9', NULL, '0', '1', '1', '1', NULL, 'HPP', '0', '0', 'admin', '2019-06-19 07:21:01', 'admin', '2019-06-19 07:22:10', NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '52', '521', 'Beban', NULL, '1', '1', '0', '1', '1', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '521', '5211', 'Pengeluaran Barang Rusak', NULL, '0', '1', '1', '1', '1', NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '521', '5212', 'Beban Perlengkapan', NULL, '0', '1', '1', '1', NULL, NULL, '0', '0', 'admin', '2019-06-20 04:23:51', NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '53', '531', 'Beban Lainya', NULL, '1', NULL, '0', '1', '1', 'Beban Lainya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '531', '5311', 'Penyesuaian Persediaan', NULL, '0', '1', '1', '1', '1', 'Beban Lainya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '54', '541', 'Depresiasi', NULL, '1', '1', '1', '1', '1', 'Beban Lainya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '55', '551', 'Biaya Lain-lain', 0, '1', '1', NULL, '1', NULL, 'Biaya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '551', '5511', 'Biaya Promosi', 0, '1', '1', '1', '1', NULL, 'Biaya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` VALUES ('5', '551', '5512', 'Biaya Beli Perlengkapan', 0, '1', '1', '1', '1', NULL, 'Biaya', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for mnoakunpengaturan
-- ----------------------------
DROP TABLE IF EXISTS `mnoakunpengaturan`;
CREATE TABLE `mnoakunpengaturan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipe` char(1) NOT NULL,
  `katakunci` varchar(255) NULL DEFAULT NULL,
  `nama` varchar(255) NULL DEFAULT NULL,
  `noakun` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mnoakunpengaturan
-- ----------------------------
INSERT INTO `mnoakunpengaturan` VALUES (1, '1', 'piutang_belum_ditagih', 'Piutang Belum Ditagih', '1212');
INSERT INTO `mnoakunpengaturan` VALUES (2, '1', 'pembayaran_di_muka', 'Pembayaran di Muka', '2211');
INSERT INTO `mnoakunpengaturan` VALUES (3, '1', 'pajak_penjualan', 'Pajak Penjualan', '2212');
INSERT INTO `mnoakunpengaturan` VALUES (4, '1', 'pendapatan_penjualan', 'Pendapatan Penjualan', '4111');
INSERT INTO `mnoakunpengaturan` VALUES (5, '1', 'diskon_penjualan', 'Diskon Penjualan', '4112');
INSERT INTO `mnoakunpengaturan` VALUES (6, '1', 'retur_penjualan', 'Retur Penjualan', '4113');
INSERT INTO `mnoakunpengaturan` VALUES (7, '1', 'penjualan_belum_ditagih', 'Pendapatan Belum Ditagih', '4114');
INSERT INTO `mnoakunpengaturan` VALUES (8, '1', 'pengiriman_penjualan', 'Pengiriman Penjualan', '421');
INSERT INTO `mnoakunpengaturan` VALUES (9, '2', 'uang_muka_pembelian', 'Uang Muka Pembelian', '1411');
INSERT INTO `mnoakunpengaturan` VALUES (10, '2', 'pajak_pembelian', 'Pajak Pembelian', '1412');
INSERT INTO `mnoakunpengaturan` VALUES (11, '2', 'hutang_belum_ditagih', 'Hutang Belum Ditagih', '2112');
INSERT INTO `mnoakunpengaturan` VALUES (12, '2', 'pengiriman_pembelian', 'Pengiriman Pembelian', '5112');
INSERT INTO `mnoakunpengaturan` VALUES (13, '2', 'pembelian', 'Pembelian', '5114');
INSERT INTO `mnoakunpengaturan` VALUES (14, '3', 'piutang_usaha', 'Piutang Usaha', '1211');
INSERT INTO `mnoakunpengaturan` VALUES (15, '3', 'hutang_usaha', 'Hutang Usaha', '2111');
INSERT INTO `mnoakunpengaturan` VALUES (16, '4', 'persediaan', 'Persediaan', '1311');
INSERT INTO `mnoakunpengaturan` VALUES (17, '4', 'persediaan_produksi', 'Persediaan Produksi', '5113');
INSERT INTO `mnoakunpengaturan` VALUES (18, '4', 'persediaan_rusak', 'Persediaan Rusak', '5211');
INSERT INTO `mnoakunpengaturan` VALUES (19, '4', 'persediaan_umum', 'Persediaan Umum', '5311');
INSERT INTO `mnoakunpengaturan` VALUES (20, '5', 'aset_tetap', 'Aset Tetap', '1511');
INSERT INTO `mnoakunpengaturan` VALUES (21, '5', 'ekuitas_saldo_awal', 'Ekuitas Saldo Awal', '3111');

-- ----------------------------
-- Table structure for mpengaturan
-- ----------------------------
DROP TABLE IF EXISTS `mpengaturan`;
CREATE TABLE `mpengaturan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode` varchar(255) NULL DEFAULT NULL,
  `deskripsi` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of mpengaturan
-- ----------------------------
INSERT INTO `mpengaturan` VALUES (1, 'language', 'ID');
INSERT INTO `mpengaturan` VALUES (2, 'app_name', 'Akuntansi Sederhana');
INSERT INTO `mpengaturan` VALUES (3, 'logo_login', 'logo_login.png');
INSERT INTO `mpengaturan` VALUES (4, 'logo', 'logo.png');
INSERT INTO `mpengaturan` VALUES (5, 'template', 'bg-blue');
INSERT INTO `mpengaturan` VALUES (6, 'instansi', 'CV. BINTANG TEKNOLOGI');
INSERT INTO `mpengaturan` VALUES (7, 'alamat_instansi', 'Jl Genteng No. 5 Banjarang - Majalengka 45468');

-- ----------------------------
-- Table structure for msatuan
-- ----------------------------
DROP TABLE IF EXISTS `msatuan`;
CREATE TABLE `msatuan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `uby` varchar(100) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `cby` varchar(100) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(100) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of msatuan
-- ----------------------------
INSERT INTO `msatuan` VALUES (1, 'Biji', '0', 'admin', '2019-08-27 17:00:50', NULL, NULL, NULL, NULL);
INSERT INTO `msatuan` VALUES (2, 'Unit', '0', NULL, NULL, 'admin', '2019-08-27 13:44:56', NULL, NULL);
INSERT INTO `msatuan` VALUES (3, 'Kg', '0', NULL, NULL, 'admin', '2019-08-30 12:43:23', NULL, NULL);

-- ----------------------------
-- Table structure for tfaktur
-- ----------------------------
DROP TABLE IF EXISTS `tfaktur`;
CREATE TABLE `tfaktur`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `tanggaltempo` date NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `gudangid` int(11) NULL DEFAULT NULL,
  `pengirimanid` int(11) NULL DEFAULT NULL,
  `catatan` varchar(255) NULL DEFAULT NULL,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` decimal(10, 0) NULL DEFAULT 0,
  `ppn` decimal(10, 0) NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `totaldibayar` decimal(10, 0) NULL DEFAULT 0,
  `sisatagihan` decimal(10, 0) NULL DEFAULT 0,
  `totalretur` decimal(10, 0) NULL DEFAULT 0,
  `totaldebetmemo` decimal(10, 0) NULL DEFAULT 0,
  `totalkreditmemo` decimal(10, 0) NULL DEFAULT 0,
  `tipe` char(1) NULL DEFAULT '1',
  `carabayar` char(1) NULL DEFAULT '1',
  `bank` varchar(20) NULL DEFAULT NULL,
  `norek` varchar(20) NULL DEFAULT NULL,
  `atasnama` varchar(100) NULL DEFAULT NULL,
  `status` char(1) NULL DEFAULT '1',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `statusbayar` char(1) NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tfaktur
-- ----------------------------
INSERT INTO `tfaktur` VALUES (1, '#INV200305001', '2020-03-05', NULL, 2, 5, 1, '', 18000000, 0, 0, 18000000, 18000000, 0, 0, 0, 0, '1', '1', NULL, NULL, NULL, '3', 'admin', '2020-03-05 03:09:46', '0');
INSERT INTO `tfaktur` VALUES (2, '#INV200305002', '2020-03-05', NULL, 1, 5, 2, '', 4000000, 0, 0, 4000000, 0, 4000000, 0, 0, 0, '2', '1', NULL, NULL, NULL, '1', 'admin', '2020-03-05 03:10:41', '0');
INSERT INTO `tfaktur` VALUES (3, '#INV200305003', '2020-03-05', NULL, 2, 5, 3, '', 1000000, 0, 0, 1000000, 0, 1000000, 0, 0, 0, '1', '1', NULL, NULL, NULL, '1', 'admin', '2020-03-05 04:07:14', '0');

-- ----------------------------
-- Table structure for tfakturdetail
-- ----------------------------
DROP TABLE IF EXISTS `tfakturdetail`;
CREATE TABLE `tfakturdetail`  (
  `idfaktur` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10, 0) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `jumlahsisa` int(11) NULL DEFAULT 0,
  `jumlahretur` int(11) NULL DEFAULT 0,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` float NULL DEFAULT 0,
  `ppn` float NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `status` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`idfaktur`, `itemid`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tfakturdetail
-- ----------------------------
INSERT INTO `tfakturdetail` VALUES (1, 1, 1800000, 10, 10, 0, 18000000, 0, 0, 18000000, '1');
INSERT INTO `tfakturdetail` VALUES (2, 1, 2000000, 2, 2, 0, 4000000, 0, 0, 4000000, '1');
INSERT INTO `tfakturdetail` VALUES (3, 4, 500000, 2, 2, 0, 1000000, 0, 0, 1000000, '1');

-- ----------------------------
-- Table structure for tjurnal
-- ----------------------------
DROP TABLE IF EXISTS `tjurnal`;
CREATE TABLE `tjurnal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(30) NULL DEFAULT NULL,
  `tanggal` datetime(0) NULL DEFAULT NULL,
  `totaldebet` decimal(10, 0) NULL DEFAULT 0,
  `totalkredit` decimal(10, 0) NULL DEFAULT 0,
  `keterangan` varchar(255) NULL DEFAULT NULL,
  `stauto` char(1) NULL DEFAULT NULL,
  `tipe` char(1) NULL DEFAULT NULL COMMENT '1 penerimaan, \r\n2 faktur, \r\n3 pembayaran, \r\n4 Jurnal umum, \r\n5 jurnal penyesuaian\r\n6 retur\r\n7 memo\r\n8 stok opname\r\n9 pengeluaran kas',
  `refid` int(11) NULL DEFAULT NULL,
  `status` char(1) NULL DEFAULT '1',
  `cdate` datetime(0) NULL DEFAULT NULL,
  `cby` varchar(255) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tjurnal
-- ----------------------------
INSERT INTO `tjurnal` VALUES (1, '#J200305001', '2020-03-05 03:09:35', 18000000, 18000000, 'Penerimaan item dari pesanan #PO200305001', '1', '1', 1, '1', NULL, NULL);
INSERT INTO `tjurnal` VALUES (2, '#J200305002', '2020-03-05 03:09:46', 18000000, 18000000, 'Faktur Pembelian #INV200305001', '1', '2', 1, '1', NULL, NULL);
INSERT INTO `tjurnal` VALUES (3, '#J200305003', '2020-03-05 03:09:58', 18000000, 18000000, 'Kirim Pembayaran Faktur #INV200305001', '1', '3', 1, '1', NULL, NULL);
INSERT INTO `tjurnal` VALUES (4, '#J200305004', '2020-03-05 03:10:31', 7600000, 7600000, 'Pengiriman item dari pesanan #SO200305001', '1', '1', 2, '1', NULL, NULL);
INSERT INTO `tjurnal` VALUES (5, '#J200305005', '2020-03-05 03:10:41', 8000000, 8000000, 'Faktur Penjualan #INV200305002', '1', '2', 2, '1', NULL, NULL);
INSERT INTO `tjurnal` VALUES (6, '#J200305006', '2020-03-05 00:00:00', 10000000, 10000000, 'Mutasi kas', '0', '4', NULL, '1', '2020-03-05 03:12:48', 'admin');
INSERT INTO `tjurnal` VALUES (7, '#J200305007', '2020-03-05 04:07:14', 1000000, 1000000, 'Faktur Pembelian #INV200305003', '1', '2', 3, '1', NULL, NULL);
INSERT INTO `tjurnal` VALUES (8, '#J200305008', '2020-03-05 04:26:03', 15000, 15000, 'Pengeluaran Kas#PK200305001', '1', '9', 1, '1', NULL, NULL);

-- ----------------------------
-- Table structure for tjurnaldetail
-- ----------------------------
DROP TABLE IF EXISTS `tjurnaldetail`;
CREATE TABLE `tjurnaldetail`  (
  `idjurnal` int(11) NOT NULL,
  `noakun` varchar(30) NOT NULL,
  `debet` decimal(10, 0) NULL DEFAULT NULL,
  `kredit` decimal(10, 0) NULL DEFAULT NULL,
  `keterangan` varchar(255) NULL DEFAULT '-',
  PRIMARY KEY (`idjurnal`, `noakun`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tjurnaldetail
-- ----------------------------
INSERT INTO `tjurnaldetail` VALUES (1, '13111', 18000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (1, '2112', 0, 18000000, '-');
INSERT INTO `tjurnaldetail` VALUES (2, '2112', 18000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (2, '2113', 0, 18000000, '-');
INSERT INTO `tjurnaldetail` VALUES (3, '1112', 0, 18000000, '-');
INSERT INTO `tjurnaldetail` VALUES (3, '2113', 18000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (4, '1212', 4000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (4, '13111', 0, 3600000, '-');
INSERT INTO `tjurnaldetail` VALUES (4, '4114', 0, 4000000, '-');
INSERT INTO `tjurnaldetail` VALUES (4, '51141', 3600000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (5, '12111', 4000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (5, '1212', 0, 4000000, '-');
INSERT INTO `tjurnaldetail` VALUES (5, '41111', 0, 4000000, '-');
INSERT INTO `tjurnaldetail` VALUES (5, '4114', 4000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (6, '1111', 10000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (6, '1112', 0, 10000000, '-');
INSERT INTO `tjurnaldetail` VALUES (7, '13112', 1000000, 0, '-');
INSERT INTO `tjurnaldetail` VALUES (7, '2113', 0, 1000000, '-');
INSERT INTO `tjurnaldetail` VALUES (8, '1111', 0, 15000, '-');
INSERT INTO `tjurnaldetail` VALUES (8, '551', 15000, 0, '-');

-- ----------------------------
-- Table structure for tjurnalsaldoawal
-- ----------------------------
DROP TABLE IF EXISTS `tjurnalsaldoawal`;
CREATE TABLE `tjurnalsaldoawal`  (
  `tanggal` date NULL DEFAULT NULL,
  `noakun` varchar(20) NOT NULL,
  `debet` decimal(10, 0) NULL DEFAULT 0,
  `kredit` decimal(10, 0) NULL DEFAULT 0,
  `stdel` char(1) NULL DEFAULT '0',
  PRIMARY KEY (`noakun`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tmemo
-- ----------------------------
DROP TABLE IF EXISTS `tmemo`;
CREATE TABLE `tmemo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `tipe` varchar(255) NULL DEFAULT NULL,
  `refid` int(11) NULL DEFAULT NULL,
  `debet` decimal(10, 0) NULL DEFAULT NULL,
  `kredit` decimal(10, 0) NULL DEFAULT NULL,
  `noakundebet` varchar(255) NULL DEFAULT NULL,
  `noakunkredit` varchar(255) NULL DEFAULT NULL,
  `status` char(1) NULL DEFAULT '1',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tpembayaran
-- ----------------------------
DROP TABLE IF EXISTS `tpembayaran`;
CREATE TABLE `tpembayaran`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `fakturid` int(255) NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `tipe` char(1) NULL DEFAULT NULL,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `totaldibayar` decimal(10, 0) NULL DEFAULT NULL,
  `sisatagihan` decimal(10, 0) NULL DEFAULT NULL,
  `carabayarid` int(1) NULL DEFAULT NULL,
  `noakunbayar` varchar(20) NULL DEFAULT NULL,
  `catatan` varchar(255) NULL DEFAULT NULL,
  `tipebayar` char(1) NULL DEFAULT '1' COMMENT '1 default\r\n2 dari debet memo\r\n',
  `status` char(1) NULL DEFAULT '1',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Compact;

-- ----------------------------
-- Records of tpembayaran
-- ----------------------------
INSERT INTO `tpembayaran` VALUES (1, '#PAY200305001', '2020-03-05', 1, 2, '1', 18000000, 18000000, 0, 1, '1112', NULL, '1', '1', 'admin', '2020-03-05 03:09:58');

-- ----------------------------
-- Table structure for tpembelian
-- ----------------------------
DROP TABLE IF EXISTS `tpembelian`;
CREATE TABLE `tpembelian`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `gudangid` int(11) NULL DEFAULT NULL,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` decimal(10, 0) NULL DEFAULT 0,
  `ppn` decimal(10, 0) NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `tipe` char(1) NULL DEFAULT NULL COMMENT '1 Pemesanan 2 pengiriman 3 faktur',
  `status` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for tpemesanan
-- ----------------------------
DROP TABLE IF EXISTS `tpemesanan`;
CREATE TABLE `tpemesanan`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(30) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `gudangid` int(11) NULL DEFAULT NULL,
  `catatan` varchar(255) NULL DEFAULT NULL,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `ppn` decimal(10, 0) NULL DEFAULT 0,
  `diskon` decimal(10, 0) NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `tipe` char(1) NULL DEFAULT NULL,
  `status` char(1) NULL DEFAULT '1',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tpemesanan
-- ----------------------------
INSERT INTO `tpemesanan` VALUES (1, '#PO200305001', '2020-03-05', 2, 5, '', 18000000, 0, 0, 18000000, '1', '3', 'admin', '2020-03-05 03:09:21');
INSERT INTO `tpemesanan` VALUES (2, '#SO200305001', '2020-03-05', 1, 5, '', 4000000, 0, 0, 4000000, '2', '3', 'admin', '2020-03-05 03:10:20');

-- ----------------------------
-- Table structure for tpemesanandetail
-- ----------------------------
DROP TABLE IF EXISTS `tpemesanandetail`;
CREATE TABLE `tpemesanandetail`  (
  `idpemesanan` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10, 0) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `jumlahditerima` int(11) NULL DEFAULT 0,
  `jumlahsisa` int(11) NULL DEFAULT 0,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` float NULL DEFAULT 0,
  `ppn` float NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `status` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`idpemesanan`, `itemid`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tpemesanandetail
-- ----------------------------
INSERT INTO `tpemesanandetail` VALUES (1, 1, 1800000, 10, 10, 0, 18000000, 0, 0, 18000000, '3');
INSERT INTO `tpemesanandetail` VALUES (2, 1, 2000000, 2, 2, 0, 4000000, 0, 0, 4000000, '3');

-- ----------------------------
-- Table structure for tpengeluarankas
-- ----------------------------
DROP TABLE IF EXISTS `tpengeluarankas`;
CREATE TABLE `tpengeluarankas`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `penerima` varchar(100) NULL DEFAULT NULL,
  `keterangan` varchar(255) NULL DEFAULT NULL,
  `nominal` decimal(10, 0) NULL DEFAULT NULL,
  `noakunkas` varchar(20) NULL DEFAULT NULL,
  `noakunbiaya` varchar(20) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(255) NULL DEFAULT NULL,
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `status` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tpengeluarankas
-- ----------------------------
INSERT INTO `tpengeluarankas` VALUES (1, '#PK200305001', '2020-03-05', 'Siapan aja.', 'Biaya beli bensin', 15000, '1111', '551', NULL, NULL, 'admin', '2020-03-05 04:26:03', '1');

-- ----------------------------
-- Table structure for tpengiriman
-- ----------------------------
DROP TABLE IF EXISTS `tpengiriman`;
CREATE TABLE `tpengiriman`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(30) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `gudangid` int(11) NULL DEFAULT NULL,
  `pemesananid` int(11) NULL DEFAULT NULL,
  `catatan` varchar(255) NULL DEFAULT '-',
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` decimal(10, 0) NULL DEFAULT 0,
  `ppn` decimal(10, 0) NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `tipe` char(1) NULL DEFAULT NULL,
  `statusauto` char(1) NULL DEFAULT '0',
  `status` char(1) NULL DEFAULT '1',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tpengiriman
-- ----------------------------
INSERT INTO `tpengiriman` VALUES (1, '#TRM200305001', '2020-03-05', 2, 5, 1, 'Kirim', 18000000, 0, 0, 18000000, '1', '0', '3', 'admin', '2020-03-05 03:09:35');
INSERT INTO `tpengiriman` VALUES (2, '#KRM200305001', '2020-03-05', 1, 5, 2, '', 4000000, 0, 0, 4000000, '2', '0', '3', 'admin', '2020-03-05 03:10:31');
INSERT INTO `tpengiriman` VALUES (3, '#TRM200305002', '2020-03-05', 2, 5, NULL, '-', 1000000, 0, 0, 1000000, '1', '1', '3', 'admin', '2020-03-05 04:07:14');

-- ----------------------------
-- Table structure for tpengirimandetail
-- ----------------------------
DROP TABLE IF EXISTS `tpengirimandetail`;
CREATE TABLE `tpengirimandetail`  (
  `idpengiriman` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10, 0) NULL DEFAULT 0,
  `jumlah` int(11) NULL DEFAULT NULL,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskonnominal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` float NULL DEFAULT 0,
  `ppn` float NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  PRIMARY KEY (`idpengiriman`, `itemid`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tpengirimandetail
-- ----------------------------
INSERT INTO `tpengirimandetail` VALUES (1, 1, 1800000, 10, 18000000, 0, 0, 0, 18000000);
INSERT INTO `tpengirimandetail` VALUES (2, 1, 2000000, 2, 4000000, 0, 0, 0, 4000000);
INSERT INTO `tpengirimandetail` VALUES (3, 4, 500000, 2, 1000000, 0, 0, 0, 1000000);

-- ----------------------------
-- Table structure for tretur
-- ----------------------------
DROP TABLE IF EXISTS `tretur`;
CREATE TABLE `tretur`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `kontakid` int(11) NULL DEFAULT NULL,
  `gudangid` int(11) NULL DEFAULT NULL,
  `fakturid` int(11) NULL DEFAULT NULL,
  `catatan` varchar(255) NULL DEFAULT NULL,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` decimal(10, 0) NULL DEFAULT 0,
  `ppn` decimal(10, 0) NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `tipe` char(1) NULL DEFAULT '1',
  `status` char(1) NULL DEFAULT '1',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for treturdetail
-- ----------------------------
DROP TABLE IF EXISTS `treturdetail`;
CREATE TABLE `treturdetail`  (
  `idretur` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10, 0) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `jumlahditerima` int(11) NULL DEFAULT NULL,
  `jumlahsisa` int(11) NULL DEFAULT NULL,
  `subtotal` decimal(10, 0) NULL DEFAULT 0,
  `diskon` float NULL DEFAULT 0,
  `ppn` float NULL DEFAULT 0,
  `total` decimal(10, 0) NULL DEFAULT 0,
  `opsiretur` char(1) NULL DEFAULT '1',
  `alasan` varchar(255) NULL DEFAULT NULL,
  `status` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`idretur`, `itemid`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for tsaldoawal
-- ----------------------------
DROP TABLE IF EXISTS `tsaldoawal`;
CREATE TABLE `tsaldoawal`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tanggal` date NOT NULL,
  `status` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tsaldoawal
-- ----------------------------
INSERT INTO `tsaldoawal` VALUES (1, '2019-08-16', '1');

-- ----------------------------
-- Table structure for tsaldoawaldetail
-- ----------------------------
DROP TABLE IF EXISTS `tsaldoawaldetail`;
CREATE TABLE `tsaldoawaldetail`  (
  `idsaldoawal` int(11) NOT NULL,
  `noakun` varchar(30) NOT NULL,
  `debet` decimal(10, 0) NULL DEFAULT NULL,
  `kredit` decimal(10, 0) NULL DEFAULT NULL,
  PRIMARY KEY (`idsaldoawal`, `noakun`) USING BTREE
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tsaldoawaldetail
-- ----------------------------
INSERT INTO `tsaldoawaldetail` VALUES (1, '11', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1112', 100000000, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '121', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1211', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '12111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '12112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1212', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1213', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '12131', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '131', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1311', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '13111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '13112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '141', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1411', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1412', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '151', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1511', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '15111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1512', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '15121', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1513', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1514', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '161', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '171', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '1711', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '21', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '211', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '2111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '21111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '2112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '2113', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '2114', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '212', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '221', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '2211', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '2212', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '31', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '311', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '3111', 0, 100000000);
INSERT INTO `tsaldoawaldetail` VALUES (1, '3112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '312', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '3121', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '41', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '411', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '4111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '41111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '41112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '4112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '4113', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '4114', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '421', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '4211', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '4212', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '51', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '511', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5111', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5112', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5113', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '51131', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '511311', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '51132', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5114', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '51141', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '51142', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '521', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5211', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5212', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '531', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5311', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '541', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '551', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5511', 0, 0);
INSERT INTO `tsaldoawaldetail` VALUES (1, '5512', 0, 0);

-- ----------------------------
-- Table structure for tstokkeluar
-- ----------------------------
DROP TABLE IF EXISTS `tstokkeluar`;
CREATE TABLE `tstokkeluar`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gudangid` int(11) NULL DEFAULT NULL,
  `tanggalkeluar` date NULL DEFAULT NULL,
  `itemid` int(11) NULL DEFAULT NULL,
  `harga` decimal(10, 0) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `totalharga` decimal(10, 0) NULL DEFAULT 0,
  `refid` int(11) NULL DEFAULT NULL,
  `tipe` char(1) NULL DEFAULT '1' COMMENT '1 pengiriman penjualan\r\n2 pengiriman retur\r\n',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tstokkeluar
-- ----------------------------
INSERT INTO `tstokkeluar` VALUES (1, 5, '2020-03-05', 1, NULL, 2, 3600000, 2, '1');

-- ----------------------------
-- Table structure for tstokmasuk
-- ----------------------------
DROP TABLE IF EXISTS `tstokmasuk`;
CREATE TABLE `tstokmasuk`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gudangid` int(11) NOT NULL,
  `tanggalmasuk` date NULL DEFAULT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10, 0) NULL DEFAULT NULL,
  `jumlah` int(11) NULL DEFAULT NULL,
  `keluar` int(11) NULL DEFAULT 0,
  `sisa` int(11) NULL DEFAULT 0,
  `refid` int(11) NULL DEFAULT NULL,
  `tipe` char(1) NULL DEFAULT '1',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tstokmasuk
-- ----------------------------
INSERT INTO `tstokmasuk` VALUES (1, 5, '2020-03-05', 1, 1800000, 10, 2, 8, 1, '1');
INSERT INTO `tstokmasuk` VALUES (2, 5, '2020-03-05', 4, 500000, 2, 0, 2, 3, '1');

-- ----------------------------
-- Table structure for tstokopname
-- ----------------------------
DROP TABLE IF EXISTS `tstokopname`;
CREATE TABLE `tstokopname`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notrans` varchar(20) NULL DEFAULT NULL,
  `tanggal` date NULL DEFAULT NULL,
  `itemid` int(11) NULL DEFAULT NULL,
  `gudangid` int(11) NULL DEFAULT NULL,
  `kategori` char(1) NULL DEFAULT '1',
  `noakunpenyesuaian` varchar(30) NULL DEFAULT NULL,
  `jumlahsistem` int(11) NULL DEFAULT NULL,
  `jumlahsebenarnya` int(11) NULL DEFAULT NULL,
  `selisih` int(255) NULL DEFAULT NULL,
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for z_menu
-- ----------------------------
DROP TABLE IF EXISTS `z_menu`;
CREATE TABLE `z_menu`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NULL DEFAULT NULL,
  `url` varchar(100) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 41 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_menu
-- ----------------------------
INSERT INTO `z_menu` VALUES (1, 'Dashboard', 'dashboard', '0');
INSERT INTO `z_menu` VALUES (2, 'Item', 'item', '0');
INSERT INTO `z_menu` VALUES (3, 'Kategori', 'kategori', '0');
INSERT INTO `z_menu` VALUES (4, 'Satuan', 'satuan', '0');
INSERT INTO `z_menu` VALUES (5, 'Gudang', 'gudang', '0');
INSERT INTO `z_menu` VALUES (6, 'Kontak', 'kontak', '0');
INSERT INTO `z_menu` VALUES (7, 'User', 'user', '0');
INSERT INTO `z_menu` VALUES (8, 'Akses', 'user_akses', '0');
INSERT INTO `z_menu` VALUES (9, 'Hak Akses', 'user_hak_akses', '0');
INSERT INTO `z_menu` VALUES (10, 'Pemesanan Pembelian', 'pemesanan_pembelian', '0');
INSERT INTO `z_menu` VALUES (11, 'Penerimaan Pembelian', 'penerimaan_pembelian', '0');
INSERT INTO `z_menu` VALUES (12, 'Faktur Pembelian', 'faktur_pembelian', '0');
INSERT INTO `z_menu` VALUES (13, 'Pembayaran Pembelian', 'pembayaran_pembelian', '0');
INSERT INTO `z_menu` VALUES (14, 'Retur Pembelian', 'retur_pembelian', '0');
INSERT INTO `z_menu` VALUES (15, 'Pemesanan Penjualan', 'pemesanan_penjualan', '0');
INSERT INTO `z_menu` VALUES (16, 'Penerimaan Penjualan', 'penerimaan_penjualan', '0');
INSERT INTO `z_menu` VALUES (17, 'Faktur Penjualan', 'faktur_penjualan', '0');
INSERT INTO `z_menu` VALUES (18, 'Pembayaran Penjualan', 'pembayaran_penjualan', '0');
INSERT INTO `z_menu` VALUES (19, 'Retur Penjualan', 'retur_penjualan', '0');
INSERT INTO `z_menu` VALUES (20, 'Memo', 'memo', '0');
INSERT INTO `z_menu` VALUES (21, 'Stock Opname', 'stokopname', '0');
INSERT INTO `z_menu` VALUES (22, 'Laporan Pembelian', 'laporan_pembelian', '0');
INSERT INTO `z_menu` VALUES (23, 'Laporan Penjualan', 'laporan_penjualan', '0');
INSERT INTO `z_menu` VALUES (24, 'Laporan Retur', 'laporan_retur_pembelian', '0');
INSERT INTO `z_menu` VALUES (25, 'Laporan Stok', 'laporan_stok', '0');
INSERT INTO `z_menu` VALUES (26, 'Laporan Stok Akhir Barang', 'laporan_stok_akhir_barang', '0');
INSERT INTO `z_menu` VALUES (27, 'Saldo Awal', 'saldo_awal', '0');
INSERT INTO `z_menu` VALUES (28, 'Nomor Akun', 'noakun', '0');
INSERT INTO `z_menu` VALUES (29, 'Pengeluaran Kas', 'pengeluaran_kas', '0');
INSERT INTO `z_menu` VALUES (30, 'Utang Usaha', 'utang', '0');
INSERT INTO `z_menu` VALUES (31, 'Piutang Usaha', 'piutang', '0');
INSERT INTO `z_menu` VALUES (32, 'Jurnal Umum', 'jurnal', '0');
INSERT INTO `z_menu` VALUES (33, 'Buku Besar', 'buku_besar', '0');
INSERT INTO `z_menu` VALUES (34, 'Neraca Saldo', 'neraca_saldo', '0');
INSERT INTO `z_menu` VALUES (35, 'Jurnal Penyesuaian', 'jurnal_penyesuaian', '0');
INSERT INTO `z_menu` VALUES (36, 'Neraca Saldo Penyesuaian', 'neraca_saldo_penyesuaian', '0');
INSERT INTO `z_menu` VALUES (37, 'Laba Rugi', 'laba_rugi', '0');
INSERT INTO `z_menu` VALUES (38, 'Perubahan Modal', 'perubahan_modal', '0');
INSERT INTO `z_menu` VALUES (39, 'Neraca', 'neraca', '0');
INSERT INTO `z_menu` VALUES (40, 'Pemetaan Akun', 'metaakun', '0');

-- ----------------------------
-- Table structure for z_module
-- ----------------------------
DROP TABLE IF EXISTS `z_module`;
CREATE TABLE `z_module`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NULL DEFAULT NULL,
  `url` varchar(100) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_module
-- ----------------------------
INSERT INTO `z_module` VALUES (1, 'Dashboard', 'dashboard', '0');
INSERT INTO `z_module` VALUES (2, 'Item', 'item', '0');
INSERT INTO `z_module` VALUES (3, 'Gudang', 'gudang', '0');
INSERT INTO `z_module` VALUES (4, 'Nomor Akun', 'akun', '0');

-- ----------------------------
-- Table structure for z_user
-- ----------------------------
DROP TABLE IF EXISTS `z_user`;
CREATE TABLE `z_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NULL DEFAULT NULL,
  `email` varchar(100) NULL DEFAULT NULL,
  `username` varchar(32) NULL DEFAULT NULL,
  `password` varchar(32) NULL DEFAULT NULL,
  `permissionid` int(11) NULL DEFAULT NULL,
  `bahasaid` int(11) NULL DEFAULT 1,
  `cabangid` int(11) NULL DEFAULT NULL,
  `stban` char(1) NULL DEFAULT '0',
  `stdel` char(1) NULL DEFAULT '0',
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `uby` varchar(255) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(255) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_user
-- ----------------------------
INSERT INTO `z_user` VALUES (1, 'ADMIN_NAME', 'ADMIN_EMAIL', 'ADMIN_USERNAME', 'ADMIN_PASSWORD', 1, 1, 1, '0', '0', NULL, NULL, 'admin', '2020-02-29 22:01:40', NULL, NULL);

-- ----------------------------
-- Table structure for z_userpermission
-- ----------------------------
DROP TABLE IF EXISTS `z_userpermission`;
CREATE TABLE `z_userpermission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NULL DEFAULT NULL,
  `stdel` char(1) NULL DEFAULT '0',
  `uby` varchar(255) NULL DEFAULT NULL,
  `udate` datetime(0) NULL DEFAULT NULL,
  `cby` varchar(255) NULL DEFAULT NULL,
  `cdate` datetime(0) NULL DEFAULT NULL,
  `dby` varchar(255) NULL DEFAULT NULL,
  `ddate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_userpermission
-- ----------------------------
INSERT INTO `z_userpermission` VALUES (1, 'Super Admin', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_userpermission` VALUES (2, 'Operator', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `z_userpermission` VALUES (3, 'Kasir', '0', 'admin', '2020-02-29 21:56:53', 'admin', '2020-02-29 19:47:27', NULL, NULL);

-- ----------------------------
-- Table structure for z_userpermissiondetail
-- ----------------------------
DROP TABLE IF EXISTS `z_userpermissiondetail`;
CREATE TABLE `z_userpermissiondetail`  (
  `idpermission` int(11) NOT NULL,
  `menuid` int(11) NOT NULL
) ENGINE = InnoDB ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of z_userpermissiondetail
-- ----------------------------
INSERT INTO `z_userpermissiondetail` VALUES (1, 1);
INSERT INTO `z_userpermissiondetail` VALUES (1, 2);
INSERT INTO `z_userpermissiondetail` VALUES (1, 3);
INSERT INTO `z_userpermissiondetail` VALUES (1, 4);
INSERT INTO `z_userpermissiondetail` VALUES (1, 5);
INSERT INTO `z_userpermissiondetail` VALUES (1, 6);
INSERT INTO `z_userpermissiondetail` VALUES (1, 7);
INSERT INTO `z_userpermissiondetail` VALUES (1, 8);
INSERT INTO `z_userpermissiondetail` VALUES (1, 9);
INSERT INTO `z_userpermissiondetail` VALUES (1, 10);
INSERT INTO `z_userpermissiondetail` VALUES (1, 11);
INSERT INTO `z_userpermissiondetail` VALUES (1, 12);
INSERT INTO `z_userpermissiondetail` VALUES (1, 13);
INSERT INTO `z_userpermissiondetail` VALUES (1, 14);
INSERT INTO `z_userpermissiondetail` VALUES (1, 15);
INSERT INTO `z_userpermissiondetail` VALUES (1, 16);
INSERT INTO `z_userpermissiondetail` VALUES (1, 17);
INSERT INTO `z_userpermissiondetail` VALUES (1, 18);
INSERT INTO `z_userpermissiondetail` VALUES (1, 19);
INSERT INTO `z_userpermissiondetail` VALUES (1, 20);
INSERT INTO `z_userpermissiondetail` VALUES (1, 21);
INSERT INTO `z_userpermissiondetail` VALUES (1, 22);
INSERT INTO `z_userpermissiondetail` VALUES (1, 23);
INSERT INTO `z_userpermissiondetail` VALUES (1, 24);
INSERT INTO `z_userpermissiondetail` VALUES (1, 25);
INSERT INTO `z_userpermissiondetail` VALUES (1, 26);
INSERT INTO `z_userpermissiondetail` VALUES (1, 27);
INSERT INTO `z_userpermissiondetail` VALUES (1, 28);
INSERT INTO `z_userpermissiondetail` VALUES (1, 29);
INSERT INTO `z_userpermissiondetail` VALUES (1, 30);
INSERT INTO `z_userpermissiondetail` VALUES (1, 31);
INSERT INTO `z_userpermissiondetail` VALUES (1, 32);
INSERT INTO `z_userpermissiondetail` VALUES (1, 33);
INSERT INTO `z_userpermissiondetail` VALUES (1, 34);
INSERT INTO `z_userpermissiondetail` VALUES (1, 35);
INSERT INTO `z_userpermissiondetail` VALUES (1, 36);
INSERT INTO `z_userpermissiondetail` VALUES (1, 37);
INSERT INTO `z_userpermissiondetail` VALUES (1, 38);
INSERT INTO `z_userpermissiondetail` VALUES (1, 39);
INSERT INTO `z_userpermissiondetail` VALUES (1, 40);
INSERT INTO `z_userpermissiondetail` VALUES (2, 1);
INSERT INTO `z_userpermissiondetail` VALUES (3, 1);
INSERT INTO `z_userpermissiondetail` VALUES (3, 10);
INSERT INTO `z_userpermissiondetail` VALUES (3, 11);
INSERT INTO `z_userpermissiondetail` VALUES (3, 12);

-- ----------------------------
-- View structure for laporanstok
-- ----------------------------
DROP VIEW IF EXISTS `laporanstok`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `laporanstok` AS select `tstokmasuk`.`tanggalmasuk` AS `tanggal`,`tstokmasuk`.`itemid` AS `itemid`,`mitem`.`nama` AS `namaitem`,`tstokmasuk`.`jumlah` AS `jumlah`,'1' AS `jenis`,(case when (`tstokmasuk`.`tipe` = '1') then 'Pembelian' else 'Retur Penjualan' end) AS `keterangan`,`tstokmasuk`.`refid` AS `refid`,`tstokmasuk`.`gudangid` AS `gudangid`,`tstokmasuk`.`tipe` AS `tipe`,`mgudang`.`nama` AS `namagudang` from ((`tstokmasuk` left join `mitem` on((`tstokmasuk`.`itemid` = `mitem`.`id`))) left join `mgudang` on((`tstokmasuk`.`gudangid` = `mgudang`.`id`))) union all select `tstokkeluar`.`tanggalkeluar` AS `tanggalkeluar`,`tstokkeluar`.`itemid` AS `itemid`,`mitem`.`nama` AS `namaitem`,`tstokkeluar`.`jumlah` AS `jumlah`,'2' AS `jenis`,(case when (`tstokkeluar`.`tipe` = '1') then 'Penjualan' else 'Retur Pembelian' end) AS `keterangan`,`tstokkeluar`.`refid` AS `refid`,`tstokkeluar`.`gudangid` AS `gudangid`,`tstokkeluar`.`tipe` AS `tipe`,`mgudang`.`nama` AS `nama` from ((`tstokkeluar` left join `mitem` on((`tstokkeluar`.`itemid` = `mitem`.`id`))) left join `mgudang` on((`tstokkeluar`.`gudangid` = `mgudang`.`id`)));

-- ----------------------------
-- View structure for viewitem
-- ----------------------------
DROP VIEW IF EXISTS `viewitem`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewitem` AS select `mitem`.`id` AS `id`,`mitem`.`kode` AS `kode`,`mitem`.`nama` AS `nama`,`mitem`.`satuanid` AS `satuanid`,`mitem`.`kategoriid` AS `kategoriid`,`mitem`.`hargabeli` AS `hargabeli`,`mitem`.`hargajual` AS `hargajual`,`mitem`.`hargabeliterakhir` AS `hargabeliterakhir`,`mitem`.`noakunbeli` AS `noakunbeli`,`mitem`.`noakunjual` AS `noakunjual`,`mitem`.`noakunpersediaan` AS `noakunpersediaan`,`mitem`.`noakunpajak` AS `noakunpajak`,`mitem`.`noakunpajakmasukan` AS `noakunpajakmasukan`,`mitem`.`noakunpajakkeluaran` AS `noakunpajakkeluaran`,`mitem`.`gambar` AS `gambar`,`mitem`.`stdel` AS `stdel`,`mitem`.`cby` AS `cby`,`mitem`.`cdate` AS `cdate`,`mitem`.`uby` AS `uby`,`mitem`.`udate` AS `udate`,`mitem`.`dby` AS `dby`,`mitem`.`ddate` AS `ddate`,`msatuan`.`nama` AS `satuan`,`mkategori`.`nama` AS `kategori`,(select coalesce(sum(`tstokmasuk`.`sisa`),0) from `tstokmasuk` where (`tstokmasuk`.`itemid` = `mitem`.`id`)) AS `stok`,((select coalesce(sum(`tstokmasuk`.`sisa`),0) from `tstokmasuk` where (`tstokmasuk`.`itemid` = `mitem`.`id`)) * `mitem`.`hargabeliterakhir`) AS `totalpersediaan` from ((`mitem` left join `msatuan` on((`mitem`.`satuanid` = `msatuan`.`id`))) left join `mkategori` on((`mitem`.`kategoriid` = `mkategori`.`id`)));

-- ----------------------------
-- View structure for viewjurnaldetail
-- ----------------------------
DROP VIEW IF EXISTS `viewjurnaldetail`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewjurnaldetail` AS select NULL AS `id`,`tsaldoawal`.`tanggal` AS `tanggalwaktu`,date_format(`tsaldoawal`.`tanggal`,'%Y-%m-%d') AS `tanggal`,'Saldo Awal' AS `keterangan`,`mnoakun`.`noakuntop` AS `noakuntop`,`mnoakun`.`noakunheader` AS `noakunheader`,`tsaldoawaldetail`.`noakun` AS `noakun`,`mnoakun`.`namaakun` AS `namaakun`,`tsaldoawaldetail`.`debet` AS `debet`,`tsaldoawaldetail`.`kredit` AS `kredit`,`mnoakun`.`stdebet` AS `stdebet`,'0' AS `tipe` from ((`tsaldoawaldetail` join `mnoakun` on((`tsaldoawaldetail`.`noakun` = `mnoakun`.`noakun`))) join `tsaldoawal` on((`tsaldoawaldetail`.`idsaldoawal` = `tsaldoawal`.`id`))) where ((`tsaldoawaldetail`.`debet` > 0) or (`tsaldoawaldetail`.`kredit` > 0)) union all select `tjurnal`.`id` AS `id`,`tjurnal`.`tanggal` AS `tanggalwaktu`,date_format(`tjurnal`.`tanggal`,'%Y-%m-%d') AS `tanggal`,`tjurnal`.`keterangan` AS `keterangan`,`mnoakun`.`noakuntop` AS `noakuntop`,`mnoakun`.`noakunheader` AS `noakunheader`,`mnoakun`.`noakun` AS `noakun`,`mnoakun`.`namaakun` AS `namaakun`,`tjurnaldetail`.`debet` AS `debet`,`tjurnaldetail`.`kredit` AS `kredit`,`mnoakun`.`stdebet` AS `stdebet`,`tjurnal`.`tipe` AS `tipe` from ((`tjurnaldetail` join `mnoakun` on((`tjurnaldetail`.`noakun` = `mnoakun`.`noakun`))) join `tjurnal` on((`tjurnaldetail`.`idjurnal` = `tjurnal`.`id`))) where (`tjurnal`.`status` = '1');

-- ----------------------------
-- View structure for viewmemo
-- ----------------------------
DROP VIEW IF EXISTS `viewmemo`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewmemo` AS select `tmemo`.`id` AS `id`,`tmemo`.`notrans` AS `notrans`,`tmemo`.`kontakid` AS `kontakid`,`mkontak`.`nama` AS `nama`,`tmemo`.`tipe` AS `tipememo`,`mkontak`.`tipe` AS `tipekontak`,`tmemo`.`refid` AS `refid`,`tmemo`.`debet` AS `debet`,`tmemo`.`kredit` AS `kredit`,(case when (`tmemo`.`tipe` = '1') then sum((`tmemo`.`debet` - `tmemo`.`kredit`)) else sum((`tmemo`.`kredit` - `tmemo`.`debet`)) end) AS `saldo` from (`tmemo` join `mkontak` on((`mkontak`.`id` = `tmemo`.`kontakid`))) group by `tmemo`.`kontakid`,`tmemo`.`tipe`;

-- ----------------------------
-- View structure for viewnoakunsaldo
-- ----------------------------
DROP VIEW IF EXISTS `viewnoakunsaldo`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewnoakunsaldo` AS select `viewjurnaldetail`.`noakun` AS `noakun`,`viewjurnaldetail`.`namaakun` AS `namaakun`,sum((case when (`viewjurnaldetail`.`stdebet` = '1') then (`viewjurnaldetail`.`debet` - `viewjurnaldetail`.`kredit`) else (`viewjurnaldetail`.`kredit` - `viewjurnaldetail`.`debet`) end)) AS `saldo` from `viewjurnaldetail` group by `viewjurnaldetail`.`noakun`;

-- ----------------------------
-- View structure for viewstok
-- ----------------------------
DROP VIEW IF EXISTS `viewstok`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewstok` AS select `mitem`.`id` AS `id`,`mitem`.`kode` AS `kode`,`mitem`.`nama` AS `nama`,`mitem`.`satuanid` AS `satuanid`,`mitem`.`kategoriid` AS `kategoriid`,`mitem`.`hargabeli` AS `hargabeli`,`mitem`.`hargajual` AS `hargajual`,`mitem`.`hargabeliterakhir` AS `hargabeliterakhir`,`mitem`.`noakunbeli` AS `noakunbeli`,`mitem`.`noakunjual` AS `noakunjual`,`mitem`.`noakunpersediaan` AS `noakunpersediaan`,`mitem`.`noakunpajak` AS `noakunpajak`,`mitem`.`noakunpajakmasukan` AS `noakunpajakmasukan`,`mitem`.`noakunpajakkeluaran` AS `noakunpajakkeluaran`,`mitem`.`stdel` AS `stdel`,`mitem`.`cby` AS `cby`,`mitem`.`cdate` AS `cdate`,`mitem`.`uby` AS `uby`,`mitem`.`udate` AS `udate`,`tstokmasuk`.`gudangid` AS `gudangid`,`mgudang`.`nama` AS `gudang`,sum(`tstokmasuk`.`sisa`) AS `stok` from ((`tstokmasuk` join `mitem` on((`mitem`.`id` = `tstokmasuk`.`itemid`))) join `mgudang` on((`mgudang`.`id` = `tstokmasuk`.`gudangid`))) group by `mitem`.`id`,`tstokmasuk`.`gudangid`;

-- ----------------------------
-- View structure for viewstokakhirbarang
-- ----------------------------
DROP VIEW IF EXISTS `viewstokakhirbarang`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `viewstokakhirbarang` AS select `mitem`.`id` AS `id`,`mitem`.`kode` AS `kode`,`mitem`.`nama` AS `nama`,`msatuan`.`nama` AS `satuan`,`mkategori`.`nama` AS `kategori`,coalesce((select sum(`tstokmasuk`.`sisa`) from `tstokmasuk` where (`tstokmasuk`.`itemid` = `mitem`.`id`)),0) AS `stok` from ((`mitem` join `msatuan` on((`msatuan`.`id` = `mitem`.`satuanid`))) join `mkategori` on((`mkategori`.`id` = `mitem`.`kategoriid`)));

-- ----------------------------
-- View structure for view_laporan_utang_piutang
-- ----------------------------
DROP VIEW IF EXISTS `view_laporan_utang_piutang`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `view_laporan_utang_piutang` AS select `tfaktur`.`tipe` AS `tipe`,`tfaktur`.`id` AS `idfaktur`,`tfaktur`.`notrans` AS `notrans`,`tfaktur`.`tanggal` AS `tanggal`,`mnoakun`.`namaakun` AS `namaakun`,`tfaktur`.`kontakid` AS `kontakid`,`mkontak`.`nama` AS `kontak`,`tfaktur`.`total` AS `total`,`tfaktur`.`totaldibayar` AS `totaldibayar`,`tfaktur`.`sisatagihan` AS `sisatagihan`,`tfaktur`.`status` AS `status` from ((`tfaktur` join `mkontak` on((`mkontak`.`id` = `tfaktur`.`kontakid`))) join `mnoakun` on((`mkontak`.`noakunutang` = `mnoakun`.`noakun`))) where (`tfaktur`.`tipe` = '1') union all select `tfaktur`.`tipe` AS `tipe`,`tfaktur`.`id` AS `idfaktur`,`tfaktur`.`notrans` AS `notrans`,`tfaktur`.`tanggal` AS `tanggal`,`mnoakun`.`namaakun` AS `namaakun`,`tfaktur`.`kontakid` AS `kontakid`,`mkontak`.`nama` AS `kontak`,`tfaktur`.`total` AS `total`,`tfaktur`.`totaldibayar` AS `totaldibayar`,`tfaktur`.`sisatagihan` AS `sisatagihan`,`tfaktur`.`status` AS `status` from ((`tfaktur` join `mkontak` on((`mkontak`.`id` = `tfaktur`.`kontakid`))) join `mnoakun` on((`mkontak`.`noakunpiutang` = `mnoakun`.`noakun`))) where (`tfaktur`.`tipe` = '2');

-- ----------------------------
-- Function structure for generatecodefaktur
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodefaktur`;
CREATE FUNCTION `generatecodefaktur`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#INV',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tfaktur WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodeitem
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodeitem`;
CREATE FUNCTION `generatecodeitem`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#PROD');
  SET @kode = 0;
  SELECT kode FROM mitem WHERE kode LIKE CONCAT( firstkode,'%') 
  ORDER BY kode DESC LIMIT 1 INTO @kode;
  
  SET @nomor = RIGHT(@kode,4);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @kode = CONCAT(firstkode,LPAD(@nomor,4,'0'));

  RETURN @kode;
END;

-- ----------------------------
-- Function structure for generatecodejurnal
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodejurnal`;
CREATE FUNCTION `generatecodejurnal`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#J',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tjurnal WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodejurnalumum
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodejurnalumum`;
CREATE FUNCTION `generatecodejurnalumum`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('J',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tjurnalumum WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodememo
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodememo`;
CREATE FUNCTION `generatecodememo`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET @vartipe = '#MEMO';
  SET firstkode = CONCAT(@vartipe,DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tmemo WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodepembayaran
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodepembayaran`;
CREATE FUNCTION `generatecodepembayaran`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#PAY',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tpembayaran WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodepembelian
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodepembelian`;
CREATE FUNCTION `generatecodepembelian`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#PAY',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tpembelian WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodepemesanan
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodepemesanan`;
CREATE FUNCTION `generatecodepemesanan`(`xtipe` CHAR(1))
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET @vartipe = ( IF(xtipe = 1, '#PO', '#SO') );
  SET firstkode = CONCAT(@vartipe,DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tpemesanan WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodepenerimaan
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodepenerimaan`;
CREATE FUNCTION `generatecodepenerimaan`(`xtipe` CHAR(1))
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET @vartipe = ( IF(xtipe = 1, '#TRM', '#KRM') );
  SET firstkode = CONCAT(@vartipe,DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tpenerimaan WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodepengeluarankas
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodepengeluarankas`;
CREATE FUNCTION `generatecodepengeluarankas`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#PK',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tpengeluarankas WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodepengiriman
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodepengiriman`;
CREATE FUNCTION `generatecodepengiriman`(`xtipe` CHAR(1))
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET @vartipe = ( IF(xtipe = 1, '#TRM', '#KRM') );
  SET firstkode = CONCAT(@vartipe,DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tpengiriman WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecoderetur
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecoderetur`;
CREATE FUNCTION `generatecoderetur`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#RTR',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tretur WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatecodestokopname
-- ----------------------------
DROP FUNCTION IF EXISTS `generatecodestokopname`;
CREATE FUNCTION `generatecodestokopname`()
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET @vartipe = '#STO';
  SET firstkode = CONCAT(@vartipe,DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SELECT notrans FROM tstokopname WHERE notrans LIKE CONCAT( firstkode,'%') 
  ORDER BY notrans DESC LIMIT 1 INTO @notrans;
  
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END;

-- ----------------------------
-- Function structure for generatenoakun
-- ----------------------------
DROP FUNCTION IF EXISTS `generatenoakun`;
CREATE FUNCTION `generatenoakun`(`xnoheader` VARCHAR(20))
 RETURNS varchar(20) CHARSET utf8mb4 COLLATE utf8mb4_unicode_ci
  READS SQL DATA 
BEGIN
  SET @count = (SELECT COUNT(*) FROM mnoakun WHERE noakunheader = xnoheader);
  SET @noakun = CONCAT(xnoheader, @count + 1);

  RETURN @noakun;
END;

-- ----------------------------
-- Triggers structure for table mitem
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertItem`;
CREATE TRIGGER `BeforeInsertItem` BEFORE INSERT ON `mitem` FOR EACH ROW BEGIN

IF(new.kode = '') THEN
  SET new.kode = generatecodeitem();
END IF;

IF(new.noakunbeli IS NULL OR new.noakunbeli = '') THEN
  SET new.noakunbeli = (SELECT noakun FROM mnoakunpengaturan WHERE id = 13);
END IF;

IF(new.noakunjual IS NULL OR new.noakunjual = '') THEN
  SET new.noakunjual = (SELECT noakun FROM mnoakunpengaturan WHERE id = 4);
END IF;

IF(new.noakunpersediaan IS NULL OR new.noakunpersediaan = '') THEN
  SET new.noakunpersediaan = (SELECT noakun FROM mnoakunpengaturan WHERE id = 16);
END IF;

IF(new.noakunpajak IS NULL OR new.noakunpajak = '') THEN
  SET new.noakunpajak = (SELECT noakun FROM mnoakunpengaturan WHERE id = 10);
END IF;

IF(new.noakunpajakmasukan IS NULL OR new.noakunpajakmasukan = '') THEN
  SET new.noakunpajakmasukan = (SELECT noakun FROM mnoakunpengaturan WHERE id = 10);
END IF;

IF(new.noakunpajakkeluaran IS NULL OR new.noakunpajakkeluaran = '') THEN
  SET new.noakunpajakkeluaran = (SELECT noakun FROM mnoakunpengaturan WHERE id = 3);
END IF;

set new.hargabeliterakhir = new.hargabeli;

END;

-- ----------------------------
-- Triggers structure for table mnoakun
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertNoakun`;
CREATE TRIGGER `BeforeInsertNoakun` BEFORE INSERT ON `mnoakun` FOR EACH ROW BEGIN

SET new.noakuntop = SUBSTR(new.noakunheader, 1, 1);
SET new.noakun = generatenoakun(new.noakunheader);

SET @idsaldoawal = (SELECT id FROM tsaldoawal WHERE status = 1);
INSERT INTO tsaldoawaldetail (idsaldoawal, noakun, debet, kredit)
VALUES (@idsaldoawal, new.noakun, 0, 0)
ON DUPLICATE KEY UPDATE noakun = new.noakun;


END;

-- ----------------------------
-- Triggers structure for table tfaktur
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertFaktur`;
CREATE TRIGGER `BeforeInsertFaktur` BEFORE INSERT ON `tfaktur` FOR EACH ROW BEGIN

DECLARE varsubtotal, vardiskon, varppn, vartotal DECIMAL;
DECLARE varpemesananid, varkontakid, vargudangid INT;

IF(new.notrans = '' || new.notrans IS NULL) THEN
  SET new.notrans = generatecodefaktur();
END IF;

SELECT pemesananid, subtotal, diskon, ppn, total, kontakid, gudangid
INTO varpemesananid, varsubtotal, vardiskon, varppn, vartotal, varkontakid, vargudangid
FROM tpengiriman
WHERE id = new.pengirimanid;

SET new.kontakid = varkontakid;
SET new.gudangid = vargudangid;
SET new.subtotal = varsubtotal;
SET new.diskon = vardiskon;
SET new.ppn = varppn;
SET new.total = vartotal;
SET new.sisatagihan = vartotal;

UPDATE tpengiriman SET status = '3' WHERE id = new.pengirimanid;

END;

-- ----------------------------
-- Triggers structure for table tfaktur
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertFaktur`;
CREATE TRIGGER `AfterInsertFaktur` AFTER INSERT ON `tfaktur` FOR EACH ROW BEGIN

--  insert jurnal umum
IF(new.tipe = '1') THEN
  INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Faktur Pembelian ', new.notrans),'1','2',new.id);
ELSE 
  INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Faktur Penjualan ', new.notrans),'1','2',new.id);
END IF;
-- 
INSERT INTO tfakturdetail (idfaktur, itemid, harga, jumlah, jumlahsisa, subtotal, diskon, ppn, total)
SELECT new.id, itemid, harga, jumlah, jumlah, subtotal, diskon, ppn, total
FROM tpengirimandetail WHERE idpengiriman = new.pengirimanid;

END;

-- ----------------------------
-- Triggers structure for table tfaktur
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeUpdateFAktur`;
CREATE TRIGGER `BeforeUpdateFAktur` BEFORE UPDATE ON `tfaktur` FOR EACH ROW BEGIN
  
  SET new.sisatagihan = new.total - new.totaldibayar - new.totalretur;
  SET @noakunutang = (SELECT noakunutang FROM mkontak WHERE id = new.kontakid);
  SET @noakunpiutang = (SELECT noakunpiutang FROM mkontak WHERE id = new.kontakid);
  
  IF(new.tipe = '1') THEN
    IF(new.sisatagihan < 0) THEN
      SET @debetmemo = ABS(new.sisatagihan);
      
      SET new.sisatagihan = 0;
      SET new.totaldebetmemo = @debetmemo;
      
--      INSERT INTO tmemo (kontakid, tipe, refid, debet, kredit, noakundebet, noakunkredit) 
--      VALUES (new.kontakid, '1', new.id, @debetmemo, 0, @noakunpiutang, @noakunutang);
      
    ELSEIF(new.sisatagihan = 0) THEN
      
      SET new.status = '3';
    END IF;
  ELSE
      IF(new.sisatagihan < 0) THEN
      SET @kreditmemo = ABS(new.sisatagihan);
      
      SET new.sisatagihan = 0;
      SET new.totalkreditmemo = @kreditmemo;
      
--      INSERT INTO tmemo (kontakid, tipe, refid, debet, kredit, noakundebet, noakunkredit) 
--      VALUES (new.kontakid, '1', new.id, @kreditmemo, 0, @noakunpiutang, @noakunutang);
      
    ELSEIF(new.sisatagihan = 0) THEN
      SET new.status = '3';
    END IF;
  END IF;
  
END;

-- ----------------------------
-- Triggers structure for table tfakturdetail
-- ----------------------------
DROP TRIGGER IF EXISTS `InsertBeforeFakturdetail`;
CREATE TRIGGER `InsertBeforeFakturdetail` BEFORE INSERT ON `tfakturdetail` FOR EACH ROW BEGIN

END;

-- ----------------------------
-- Triggers structure for table tfakturdetail
-- ----------------------------
DROP TRIGGER IF EXISTS `InsertAfterFakturDetail`;
CREATE TRIGGER `InsertAfterFakturDetail` AFTER INSERT ON `tfakturdetail` FOR EACH ROW BEGIN

DECLARE varpengirimanid, varkontakid, vargudangid INT;
DECLARE varstatusauto, vartipe CHAR(1);

SELECT pengirimanid, kontakid, gudangid 
INTO varpengirimanid, varkontakid, vargudangid
FROM tfaktur WHERE id = new.idfaktur;

SELECT statusauto, tipe
INTO varstatusauto, vartipe
FROM tpengiriman WHERE id = varpengirimanid;

SET @idjurnal = (SELECT id FROM tjurnal WHERE refid = new.idfaktur AND tipe = '2');
SET @noakunutang = (SELECT noakunutang FROM mkontak WHERE id = varkontakid);
SET @noakunpiutang = (SELECT noakunpiutang FROM mkontak WHERE id = varkontakid);
SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
SET @noakunjual = (SELECT noakunjual FROM mitem WHERE id = new.itemid);
SET @noakunbeli = (SELECT noakunbeli FROM mitem WHERE id = new.itemid);
SET @noakunpajak = (SELECT noakunpajak FROM mitem WHERE id = new.itemid);

IF (vartipe = '1') THEN
  UPDATE mitem SET hargabeliterakhir = new.harga WHERE id = new.itemid;
  IF(varstatusauto = '1') THEN
    SET @subtotal = new.subtotal;
    IF(new.diskon > 0) THEN
      SET @nominaldiskon = (new.diskon*@subtotal/100);
      SET @subtotal = @subtotal - @nominaldiskon;
    ELSE
      SET @nominaldiskon = 0;
      SET @subtotal = @subtotal - @nominaldiskon;
    END IF;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpersediaan, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
      
    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpajak, @nominalppn, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @nominalppn;
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunutang, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
  ELSE
    SET @subtotal = new.subtotal;
    IF(new.diskon > 0) THEN
      SET @nominaldiskon = (new.diskon*@subtotal/100);
      SET @subtotal = @subtotal - @nominaldiskon;
    ELSE
      SET @nominaldiskon = 0;
      SET @subtotal = @subtotal - @nominaldiskon;
    END IF;
    SET @hutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 11);
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @hutangbelumditagih, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
      
    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpajak, @nominalppn, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @nominalppn;      
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunutang, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
  END IF;
ELSE
  IF(varstatusauto = '1') THEN
    SET @subtotal = new.subtotal;

    SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE itemid = new.itemid ORDER BY id DESC LIMIT 1);

    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga)
    ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunbeli, @totalharga, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @totalharga;

    IF(new.diskon > 0) THEN
      SET @nominaldiskon = (new.diskon*@subtotal/100);
      SET @subtotal = @subtotal - @nominaldiskon;
    ELSE
      SET @nominaldiskon = 0;
      SET @subtotal = @subtotal - @nominaldiskon;
    END IF;

    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunjual, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;

    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      SET @ppnkeluaran = (SELECT noakun FROM mnoakunpengaturan WHERE id = 3);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @ppnkeluaran, 0, @nominalppn)
      ON DUPLICATE KEY UPDATE kredit = kredit + @nominalppn;
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpiutang, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
  ELSE
    SET @subtotal = new.subtotal;
    IF(new.diskon > 0) THEN
      SET @nominaldiskon = (new.diskon*@subtotal/100);
      SET @subtotal = @subtotal - @nominaldiskon;
    ELSE
      SET @nominaldiskon = 0;
      SET @subtotal = @subtotal - @nominaldiskon;
    END IF;
    
    SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @pendapatanbelumditagih, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
    
    SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @piutangbelumditagih, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunjual, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
      
    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      SET @ppnkeluaran = (SELECT noakun FROM mnoakunpengaturan WHERE id = 3);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @ppnkeluaran, 0, @nominalppn)
      ON DUPLICATE KEY UPDATE kredit = kredit + @nominalppn;
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpiutang, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
  END IF;
END IF;



END;

-- ----------------------------
-- Triggers structure for table tjurnal
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertJurnalumum_copy1`;
CREATE TRIGGER `BeforeInsertJurnalumum_copy1` BEFORE INSERT ON `tjurnal` FOR EACH ROW BEGIN
  SET new.notrans = generatecodejurnal();
END;

-- ----------------------------
-- Triggers structure for table tjurnaldetail
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertJurnaldetail`;
CREATE TRIGGER `BeforeInsertJurnaldetail` BEFORE INSERT ON `tjurnaldetail` FOR EACH ROW BEGIN

UPDATE tjurnal SET 
totaldebet = new.debet + totaldebet,
totalkredit = new.kredit + totalkredit
WHERE id = new.idjurnal;

END;

-- ----------------------------
-- Triggers structure for table tmemo
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertMemo`;
CREATE TRIGGER `BeforeInsertMemo` BEFORE INSERT ON `tmemo` FOR EACH ROW BEGIN
  SET new.notrans = generatecodememo();
END;

-- ----------------------------
-- Triggers structure for table tmemo
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertMemo`;
CREATE TRIGGER `AfterInsertMemo` AFTER INSERT ON `tmemo` FOR EACH ROW BEGIN
    SET @noakunutang = (SELECT noakunutang FROM mkontak WHERE id = new.kontakid);
    SET @noakunpiutang = (SELECT noakunpiutang FROM mkontak WHERE id = new.kontakid);
      
    IF(new.kredit = 0) THEN
      INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
      VALUES (NOW(),CONCAT('Debet Memo ', new.notrans),'1','7',new.id);
      SET @idjurnal = LAST_INSERT_ID();
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, new.noakundebet, new.debet, 0)
      ON DUPLICATE KEY UPDATE debet = debet + new.kredit;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, new.noakunkredit, 0, new.debet)
      ON DUPLICATE KEY UPDATE kredit = kredit + new.debet;
    ELSE
      INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
      VALUES (NOW(),CONCAT('Kredit / Debet Memo Refund ', new.notrans),'1','7',new.id);
      SET @idjurnal = LAST_INSERT_ID();
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, new.noakunkredit, 0, new.kredit)
      ON DUPLICATE KEY UPDATE kredit = kredit + new.kredit;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, new.noakundebet, new.kredit, 0)
      ON DUPLICATE KEY UPDATE debet = debet + new.kredit;
    END IF;
END;

-- ----------------------------
-- Triggers structure for table tpembayaran
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertPembayaran`;
CREATE TRIGGER `BeforeInsertPembayaran` BEFORE INSERT ON `tpembayaran` FOR EACH ROW BEGIN
  DECLARE vartotal DECIMAL;
  DECLARE varkontakid INT;
  
  SET new.notrans = generatecodepembayaran();
  SELECT total, kontakid INTO vartotal, varkontakid FROM tfaktur WHERE id = new.fakturid;
  SET new.total = vartotal;
  SET new.kontakid = varkontakid;
  SET @sumtotaldibayar = (SELECT COALESCE(SUM(totaldibayar),0) FROM tpembayaran 
  WHERE fakturid = new.fakturid);
  SET new.sisatagihan = new.total - (@sumtotaldibayar + new.totaldibayar);
  
  
  
  IF(new.sisatagihan <= 0) THEN
    UPDATE tfaktur SET status = 3,
    totaldibayar = new.total - new.sisatagihan,
    sisatagihan = new.sisatagihan 
    WHERE id = new.fakturid;
  ELSE 
    UPDATE tfaktur SET status = 2,
    totaldibayar = new.total - new.sisatagihan,
    sisatagihan = new.sisatagihan
    WHERE id = new.fakturid;
  END IF;
  
END;

-- ----------------------------
-- Triggers structure for table tpembayaran
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertPembayaran`;
CREATE TRIGGER `AfterInsertPembayaran` AFTER INSERT ON `tpembayaran` FOR EACH ROW BEGIN

DECLARE varnotrans VARCHAR(20);


SELECT notrans
INTO varnotrans
FROM tfaktur WHERE id = new.fakturid;

IF (new.tipe = '1') THEN
  IF(new.tipebayar = '1') THEN
    --  insert jurnal umum
    INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid)
    VALUES (NOW(),CONCAT('Kirim Pembayaran Faktur ',varnotrans),'1','3',new.id);
    SET @lastid = LAST_INSERT_ID();

    SET @noakunutang = (SELECT noakunutang FROM mkontak WHERE id = new.kontakid);
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit, keterangan)
    VALUES (@lastid, @noakunutang, new.totaldibayar, 0, CONCAT('-') );

    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit, keterangan)
    VALUES (@lastid, new.noakunbayar, 0, new.totaldibayar, CONCAT('-') );
  ELSE
    INSERT INTO tmemo (kontakid, tipe, refid, debet, kredit, noakundebet, noakunkredit)
    VALUES(new.kontakid, '1', new.fakturid, 0, new.totaldibayar, @noakunutang, new.noakunbayar);
  END IF;
ELSE
  IF(new.tipebayar = '1') THEN
  --  insert jurnal umum
    INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid)
    VALUES (NOW(),CONCAT('Terima Pembayaran Faktur',varnotrans),'1','3',new.id);
    SET @lastid = LAST_INSERT_ID();

    SET @noakunpiutang = (SELECT noakunpiutang FROM mkontak WHERE id = new.kontakid);
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit, keterangan)
    VALUES (@lastid, @noakunpiutang, 0, new.totaldibayar, CONCAT('-') );

    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit, keterangan)
    VALUES (@lastid, new.noakunbayar, new.totaldibayar, 0, CONCAT('-') );
  ELSE
    INSERT INTO tmemo (kontakid, tipe, refid, debet, kredit, noakundebet, noakunkredit)
    VALUES(new.kontakid, '1', new.fakturid, 0, new.totaldibayar, new.noakunbayar, @noakunpiutang);
  END IF;
END IF;


END;

-- ----------------------------
-- Triggers structure for table tpemesanan
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertPemesanan`;
CREATE TRIGGER `BeforeInsertPemesanan` BEFORE INSERT ON `tpemesanan` FOR EACH ROW BEGIN
  SET new.notrans = generatecodepemesanan(new.tipe);
END;

-- ----------------------------
-- Triggers structure for table tpemesanandetail
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertPemesananDetail`;
CREATE TRIGGER `BeforeInsertPemesananDetail` BEFORE INSERT ON `tpemesanandetail` FOR EACH ROW BEGIN
SET @subtotal = new.harga * new.jumlah;
SET new.jumlahsisa = new.jumlah;
SET new.jumlahditerima = 0;
SET new.subtotal = @subtotal;

IF(new.diskon > 0) THEN
  SET @nominaldiskon = (new.diskon*@subtotal/100);
  SET @subtotal = @subtotal - @nominaldiskon;
ELSE
  SET @nominaldiskon = 0;
  SET @subtotal = @subtotal - @nominaldiskon;
END IF;

IF(new.ppn > 0) THEN
  SET @nominalppn = (new.ppn*@subtotal/100);
  SET @subtotal = @subtotal + @nominalppn;
ELSE
  SET @nominalppn = 0;
  SET @subtotal = @subtotal + @nominalppn;
END IF;

SET new.total = @subtotal;

UPDATE tpemesanan SET
subtotal = new.subtotal + subtotal, 
ppn = @nominalppn + ppn,
diskon = @nominaldiskon + diskon,
total = new.total + total
WHERE id = new.idpemesanan;

END;

-- ----------------------------
-- Triggers structure for table tpemesanandetail
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeUpdatePemesananDetail`;
CREATE TRIGGER `BeforeUpdatePemesananDetail` BEFORE UPDATE ON `tpemesanandetail` FOR EACH ROW BEGIN

SET new.jumlahsisa = new.jumlah - new.jumlahditerima;

END;

-- ----------------------------
-- Triggers structure for table tpengeluarankas
-- ----------------------------
DROP TRIGGER IF EXISTS `BI_pengeluarankas`;
CREATE TRIGGER `BI_pengeluarankas` BEFORE INSERT ON `tpengeluarankas` FOR EACH ROW begin
if(new.notrans = '' OR new.notrans is null) then
  set new.notrans = generatecodepengeluarankas();
end if;
end;

-- ----------------------------
-- Triggers structure for table tpengeluarankas
-- ----------------------------
DROP TRIGGER IF EXISTS `BA_pengeluarankas`;
CREATE TRIGGER `BA_pengeluarankas` AFTER INSERT ON `tpengeluarankas` FOR EACH ROW begin
  INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Pengeluaran Kas', new.notrans),'1','9',new.id);
  set @idjurnal = LAST_INSERT_ID();
  
  insert into tjurnaldetail(idjurnal, noakun,debet, kredit, keterangan)
  values
  (@idjurnal, new.noakunkas, 0, new.nominal, '-'),
  (@idjurnal, new.noakunbiaya, new.nominal, 0, '-');
  
  
  
end;

-- ----------------------------
-- Triggers structure for table tpengiriman
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertPengiriman`;
CREATE TRIGGER `BeforeInsertPengiriman` BEFORE INSERT ON `tpengiriman` FOR EACH ROW begin

SET new.notrans = generatecodepengiriman(new.tipe);
IF(new.pemesananid IS NOT NULL) THEN
  SET new.kontakid = (SELECT kontakid FROM tpemesanan WHERE id = new.pemesananid);
  SET new.gudangid = (SELECT gudangid FROM tpemesanan WHERE id = new.pemesananid);
END IF;

end;

-- ----------------------------
-- Triggers structure for table tpengiriman
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertPengiriman`;
CREATE TRIGGER `AfterInsertPengiriman` AFTER INSERT ON `tpengiriman` FOR EACH ROW BEGIN

SET @nopemesanan = (SELECT notrans FROM tpemesanan WHERE id = new.pemesananid);
IF(new.tipe = '1') THEN
  IF(new.statusauto = 0) THEN
    INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid)
    VALUES (NOW(),CONCAT('Penerimaan item dari pesanan ',@nopemesanan),'1','1',new.id);
  END IF;
ELSE
  IF(new.statusauto = 0) THEN
    INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid)
    VALUES (NOW(),CONCAT('Pengiriman item dari pesanan ',@nopemesanan),'1','1',new.id);
  END IF;
END IF;
END;

-- ----------------------------
-- Triggers structure for table tpengirimandetail
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertPengirimanDetail`;
CREATE TRIGGER `BeforeInsertPengirimanDetail` BEFORE INSERT ON `tpengirimandetail` FOR EACH ROW BEGIN

DECLARE varpemesananid INT;
DECLARE varnopenerimaan VARCHAR(20);
DECLARE varharga DECIMAL;
DECLARE vardiskon, varppn FLOAT;

SET @pemesananid = (SELECT pemesananid FROM tpengiriman WHERE id = new.idpengiriman );

IF(@pemesananid IS NOT NULL) THEN

  SELECT pemesananid, notrans 
  INTO varpemesananid, varnopenerimaan
  FROM tpengiriman
  WHERE id = new.idpengiriman;

  SELECT harga, diskon, ppn
  INTO varharga, vardiskon, varppn
  FROM tpemesanandetail 
  WHERE idpemesanan = varpemesananid 
  AND itemid = new.itemid;

  SET new.harga = varharga;
  SET new.subtotal = varharga * new.jumlah;
  SET new.diskon = vardiskon;
  SET new.ppn = varppn;

  SET @subtotal = new.subtotal;
  IF(vardiskon > 0) THEN
    SET @nominaldiskon = (new.diskon*@subtotal/100);
    SET @subtotal = @subtotal - @nominaldiskon;
  ELSE
    SET @nominaldiskon = 0;
    SET @subtotal = @subtotal - @nominaldiskon;
  END IF;
  -- 
  IF(new.ppn > 0) THEN
    SET @nominalppn = (new.ppn*@subtotal/100);
    SET @subtotal = @subtotal + @nominalppn;
  ELSE
    SET @nominalppn = 0;
    SET @subtotal = @subtotal + @nominalppn;
  END IF;
  -- 
  SET new.total = @subtotal;

  -- update pengiriman 
  UPDATE tpengiriman SET
  subtotal = subtotal + new.subtotal,
  diskon = diskon + @nominaldiskon,
  ppn = ppn + @nominalppn,
  total = total + new.total
  WHERE id = new.idpengiriman;
ELSE
  SET @subtotal = new.harga * new.jumlah;
  SET new.subtotal = @subtotal;
  IF(new.diskon > 0) THEN
    SET @nominaldiskon = (new.diskon*@subtotal/100);
    SET @subtotal = @subtotal - @nominaldiskon;
  ELSE
    SET @nominaldiskon = 0;
    SET @subtotal = @subtotal - @nominaldiskon;
  END IF;
  -- 
  IF(new.ppn > 0) THEN
    SET @nominalppn = (new.ppn*@subtotal/100);
    SET @subtotal = @subtotal + @nominalppn;
  ELSE
    SET @nominalppn = 0;
    SET @subtotal = @subtotal + @nominalppn;
  END IF;
  -- 
  SET new.total = @subtotal;

  -- update pengiriman 
  UPDATE tpengiriman SET
  subtotal = subtotal + new.subtotal,
  diskon = diskon + @nominaldiskon,
  ppn = ppn + @nominalppn,
  total = total + new.total
  WHERE id = new.idpengiriman;
END IF;

END;

-- ----------------------------
-- Triggers structure for table tpengirimandetail
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertPengirimanDetail`;
CREATE TRIGGER `AfterInsertPengirimanDetail` AFTER INSERT ON `tpengirimandetail` FOR EACH ROW BEGIN

DECLARE varpemesananid, vargudangid, varkontakid INT;
DECLARE varnopenerimaan VARCHAR(20);
DECLARE varharga DECIMAL;
DECLARE vardiskon, varppn FLOAT;
DECLARE vartipe, varstatusauto CHAR(1);

SET @pemesananid = (SELECT pemesananid FROM tpengiriman WHERE id = new.idpengiriman );

IF(@pemesananid IS NOT NULL) THEN

  SELECT pemesananid, notrans, tipe, statusauto, gudangid 
  INTO varpemesananid, varnopenerimaan, vartipe, varstatusauto, vargudangid
  FROM tpengiriman
  WHERE id = new.idpengiriman;

  -- update jumlahditerima pemesanan
  UPDATE tpemesanandetail 
  SET jumlahditerima = new.jumlah + jumlahditerima
  WHERE idpemesanan = varpemesananid AND itemid = new.itemid;

  -- update status pemesanan detail
  SET @jumlahsisa = (SELECT jumlahsisa FROM tpemesanandetail 
  WHERE idpemesanan = varpemesananid AND itemid = new.itemid);
  IF(@jumlahsisa = 0) THEN
    UPDATE tpemesanandetail 
    SET status = 3
    WHERE idpemesanan = varpemesananid AND itemid = new.itemid;
  ELSE 
    UPDATE tpemesanandetail 
    SET status = 2
    WHERE idpemesanan = varpemesananid AND itemid = new.itemid;
  END IF;

  -- update status pemesanan
  SET @sumjumlahsisa = (SELECT SUM(jumlahsisa) FROM tpemesanandetail WHERE idpemesanan = varpemesananid );
  IF(@sumjumlahsisa = 0) THEN
    UPDATE tpemesanan SET status = 3 WHERE id = varpemesananid;
  ELSE
    UPDATE tpemesanan SET status = 2 WHERE id = varpemesananid;
  END IF;

  IF(varstatusauto = 0) THEN
    SET @idjurnal = (SELECT id FROM tjurnal WHERE refid = new.idpengiriman AND tipe = 1);
    IF(vartipe = 1) THEN
      SET @gudangid = vargudangid;
      INSERT INTO tstokmasuk (gudangid, tanggalmasuk, itemid, harga, jumlah, keluar, sisa, refid)
      VALUES(@gudangid, CURRENT_DATE(), 
      new.itemid, new.harga-(new.diskon/100*new.harga), new.jumlah, 0, new.jumlah, new.idpengiriman);
      
      SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
      SET @hutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 11);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpersediaan, new.subtotal, 0)
      ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @hutangbelumditagih, 0, new.subtotal)
      ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;
    ELSE
      SET @gudangid = vargudangid;
      INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, jumlah, refid)
      VALUES(@gudangid, CURRENT_DATE(), new.itemid, new.jumlah, new.idpengiriman);
      
      SET @stokkeluarid = LAST_INSERT_ID();
      SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE id = @stokkeluarid);
      
      SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @piutangbelumditagih, new.subtotal, 0)
      ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
      
      SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @pendapatanbelumditagih, 0, new.subtotal)
      ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;
      
      SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga)
      ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
      
      SET @noakunbeli = (SELECT noakunbeli FROM mitem WHERE id = new.itemid);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunbeli, @totalharga, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @totalharga;
    END IF;
  ELSE
    IF(vartipe = 1) THEN
      SET @gudangid = vargudangid;
      INSERT INTO tstokmasuk (gudangid, tanggalmasuk, itemid, harga, jumlah, keluar, sisa, refid)
      VALUES(@gudangid, CURRENT_DATE(), 
      new.itemid, new.harga-(new.diskon/100*new.harga), new.jumlah, 0, new.jumlah, new.idpengiriman);
    ELSE
      SET @gudangid = vargudangid;
      INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, jumlah, refid)
      VALUES(@gudangid, CURRENT_DATE(), new.itemid, new.jumlah, new.idpengiriman);
    END IF;
  END IF;
ELSE

  SELECT pemesananid, notrans, tipe, statusauto, gudangid, kontakid 
  INTO varpemesananid, varnopenerimaan, vartipe, varstatusauto, vargudangid, varkontakid
  FROM tpengiriman
  WHERE id = new.idpengiriman;

  IF(varstatusauto = 0) THEN
    SET @idjurnal = (SELECT id FROM tjurnal WHERE refid = new.idpengiriman AND tipe = 1);
    IF(vartipe = 1) THEN
      SET @gudangid = vargudangid;
      INSERT INTO tstokmasuk (gudangid, tanggalmasuk, itemid, harga, jumlah, keluar, sisa, refid)
      VALUES(@gudangid, CURRENT_DATE(), 
      new.itemid, new.harga-(new.diskon/100*new.harga), new.jumlah, 0, new.jumlah, new.idpengiriman);
      
      SET @noakunutang = (SELECT noakunutang FROM mkontak WHERE id = varkontakid);
      SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpersediaan, new.subtotal, 0)
      ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunutang, 0, new.subtotal)
      ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;
    ELSE
      SET @gudangid = vargudangid;
      INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, jumlah, refid)
      VALUES(@gudangid, CURRENT_DATE(), new.itemid, new.jumlah, new.idpengiriman);
      
      SET @stokkeluarid = LAST_INSERT_ID();
      SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE id = @stokkeluarid);
      
      SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @piutangbelumditagih, new.subtotal, 0)
      ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
      
      SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @pendapatanbelumditagih, 0, new.subtotal)
      ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;
      
      SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga)
      ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
      
      SET @noakunbeli = (SELECT noakunbeli FROM mitem WHERE id = new.itemid);
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunbeli, @totalharga, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @totalharga;
    END IF;
  ELSE
    SET @idjurnal = (SELECT id FROM tjurnal WHERE refid = new.idpengiriman AND tipe = 1);
    IF(vartipe = 1) THEN
      SET @gudangid = vargudangid;
      INSERT INTO tstokmasuk (gudangid, tanggalmasuk, itemid, harga, jumlah, keluar, sisa, refid)
      VALUES(@gudangid, CURRENT_DATE(), 
      new.itemid, new.harga-(new.diskon/100*new.harga), new.jumlah, 0, new.jumlah, new.idpengiriman);
    ELSE
      SET @gudangid = vargudangid;
      INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, jumlah, refid)
      VALUES(@gudangid, CURRENT_DATE(), new.itemid, new.jumlah, new.idpengiriman);
    END IF;
  END IF;
END IF;


END;

-- ----------------------------
-- Triggers structure for table tretur
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertRetur`;
CREATE TRIGGER `BeforeInsertRetur` BEFORE INSERT ON `tretur` FOR EACH ROW BEGIN

DECLARE varsubtotal, vardiskon, varppn, vartotal DECIMAL;
DECLARE varpemesananid, varkontakid, vargudangid INT;

SELECT gudangid, kontakid
INTO vargudangid, varkontakid
FROM tfaktur WHERE id = new.fakturid;

SET new.kontakid = varkontakid;
SET new.gudangid = vargudangid;
SET new.notrans = generatecoderetur();

END;

-- ----------------------------
-- Triggers structure for table tretur
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertRetur`;
CREATE TRIGGER `AfterInsertRetur` AFTER INSERT ON `tretur` FOR EACH ROW BEGIN

--  insert jurnal umum
IF(new.tipe = '1') THEN

  INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Retur Pembelian ', new.notrans),'1','6',new.id);
ELSE 
  INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Retur Penjualan ', new.notrans),'1','6',new.id);
END IF;
-- 

END;

-- ----------------------------
-- Triggers structure for table treturdetail
-- ----------------------------
DROP TRIGGER IF EXISTS `InsertBeforeReturDetail`;
CREATE TRIGGER `InsertBeforeReturDetail` BEFORE INSERT ON `treturdetail` FOR EACH ROW BEGIN

DECLARE varfakturid INT;
DECLARE varnoretur VARCHAR(20);
DECLARE varharga DECIMAL;
DECLARE vardiskon, varppn FLOAT;

SELECT fakturid, notrans
INTO varfakturid, varnoretur
FROM tretur
WHERE id = new.idretur;

-- get detail item 
SELECT harga, diskon, ppn
INTO varharga, vardiskon, varppn
FROM tfakturdetail 
WHERE idfaktur = varfakturid 
AND itemid = new.itemid;

-- set detail item returdetail 
SET new.harga = varharga;
SET new.subtotal = varharga * new.jumlah;
SET new.diskon = vardiskon;
SET new.ppn = varppn;

SET @subtotal = new.subtotal;
IF(vardiskon > 0) THEN
  SET @nominaldiskon = (new.diskon*@subtotal/100);
  SET @subtotal = @subtotal - @nominaldiskon;
ELSE
  SET @nominaldiskon = 0;
  SET @subtotal = @subtotal - @nominaldiskon;
END IF;
-- 
IF(new.ppn > 0) THEN
  SET @nominalppn = (new.ppn*@subtotal/100);
  SET @subtotal = @subtotal + @nominalppn;
ELSE
  SET @nominalppn = 0;
  SET @subtotal = @subtotal + @nominalppn;
END IF;
-- 
SET new.total = @subtotal;

-- update tretur head 
UPDATE tretur SET
subtotal = subtotal + new.subtotal,
diskon = diskon + @nominaldiskon,
ppn = ppn + @nominalppn,
total = total + new.total
WHERE id = new.idretur;

END;

-- ----------------------------
-- Triggers structure for table treturdetail
-- ----------------------------
DROP TRIGGER IF EXISTS `InsertAfterReturDetail`;
CREATE TRIGGER `InsertAfterReturDetail` AFTER INSERT ON `treturdetail` FOR EACH ROW BEGIN

DECLARE varfakturid, varkontakid, vargudangid, vartipe, varpengirimanid INT;

SELECT fakturid, kontakid, gudangid, tipe 
INTO varfakturid, varkontakid, vargudangid, vartipe
FROM tretur WHERE id = new.idretur;

SELECT pengirimanid
INTO varpengirimanid
FROM tfaktur WHERE id = varfakturid;

SET @noakunutang = (SELECT noakunutang FROM mkontak WHERE id = varkontakid);
SET @noakunpiutang = (SELECT noakunpiutang FROM mkontak WHERE id = varkontakid);
SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
SET @noakunbeli = (SELECT noakunbeli FROM mitem WHERE id = new.itemid);
SET @noakunpajakmasukan = (SELECT noakunpajakmasukan FROM mitem WHERE id = new.itemid);
SET @noakunpajakkeluaran = (SELECT noakunpajakkeluaran FROM mitem WHERE id = new.itemid);
SET @noakunreturpenjualan = (SELECT noakun FROM mnoakunpengaturan WHERE id = 6);
-- 
IF (vartipe = '1') THEN
  SET @subtotal = new.subtotal;
  IF(new.diskon > 0) THEN
    SET @nominaldiskon = (new.diskon*@subtotal/100);
    SET @subtotal = @subtotal - @nominaldiskon;
  ELSE
    SET @nominaldiskon = 0;
    SET @subtotal = @subtotal - @nominaldiskon;
  END IF;

  SET @idjurnal = (SELECT id FROM tjurnal WHERE refid = new.idretur AND tipe = '6');

  INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
  VALUES (@idjurnal, @noakunpersediaan, 0, @subtotal)
  ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;

  IF(new.ppn > 0) THEN
    SET @nominalppn = (new.ppn*@subtotal/100);
    SET @subtotal = @subtotal + @nominalppn;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpajakmasukan, 0, @nominalppn)
    ON DUPLICATE KEY UPDATE kredit = kredit + @nominalppn;
  ELSE
    SET @nominalppn = 0;
    SET @subtotal = @subtotal + @nominalppn;
  END IF;
  
  INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
  VALUES (@idjurnal, @noakunutang, @subtotal, 0)
  ON DUPLICATE KEY UPDATE debet = debet + @subtotal;

  SET @harga = (SELECT harga FROM tfakturdetail 
  WHERE itemid = new.itemid AND idfaktur = varfakturid);

  INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, jumlah, refid, tipe, totalharga)
  VALUES(vargudangid,CURRENT_DATE(),new.itemid, new.jumlah,new.idretur,'2', @subtotal);

  SET @sisatagihan = (SELECT total-totaldibayar-@subtotal+totalretur 
  FROM tfaktur WHERE id = varfakturid);
  UPDATE tfakturdetail SET jumlahretur = jumlahretur + new.jumlah, jumlahsisa = jumlah-jumlahretur 
  WHERE idfaktur = varfakturid AND itemid = new.itemid;
  UPDATE tfaktur SET totalretur = @subtotal + totalretur WHERE id = varfakturid;
  
  IF(@sisatagihan < 0 ) THEN
    INSERT INTO tmemo (kontakid, tipe, refid, debet, kredit, noakundebet, noakunkredit) 
    VALUES (varkontakid, '1', new.idretur, @subtotal, 0, @noakunpiutang, @noakunutang);
  END IF;
ELSE
  SET @subtotal = new.subtotal;
  IF(new.diskon > 0) THEN
    SET @nominaldiskon = (new.diskon*@subtotal/100);
    SET @subtotal = @subtotal - @nominaldiskon;
  ELSE
    SET @nominaldiskon = 0;
    SET @subtotal = @subtotal - @nominaldiskon;
  END IF;

  SET @idjurnal = (SELECT id FROM tjurnal WHERE refid = new.idretur AND tipe = '6');

  INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
  VALUES (@idjurnal, @noakunreturpenjualan, @subtotal, 0)
  ON DUPLICATE KEY UPDATE debet = debet + @subtotal;

  IF(new.ppn > 0) THEN
    SET @nominalppn = (new.ppn*@subtotal/100);
    SET @subtotal = @subtotal + @nominalppn;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpajakkeluaran, @nominalppn, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @nominalppn;
  ELSE
    SET @nominalppn = 0;
    SET @subtotal = @subtotal + @nominalppn;
  END IF;
  
  INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
  VALUES (@idjurnal, @noakunpiutang, 0, @subtotal)
  ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;

  SET @totalharga = (SELECT totalharga/jumlah FROM tstokkeluar 
  WHERE itemid = new.itemid AND tipe = '1' AND refid = varpengirimanid);
  SET @totalharga = @totalharga * new.jumlah;
  INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
  VALUES (@idjurnal, @noakunpersediaan, @totalharga, 0)
  ON DUPLICATE KEY UPDATE debet = debet + @totalharga;
  INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
  VALUES (@idjurnal, @noakunbeli, 0, @totalharga)
  ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;

  SET @hargabeliterakhir = (SELECT hargabeliterakhir FROM mitem WHERE id = new.itemid);
  INSERT tstokmasuk (gudangid, tanggalmasuk, itemid, harga, jumlah, keluar, sisa, refid, tipe)
  VALUES(vargudangid, CURRENT_DATE(), new.itemid, @hargabeliterakhir, new.jumlah, 0, new.jumlah, new.idretur, '2');
  
  SET @sisatagihan = (SELECT total-totaldibayar-@subtotal+totalretur 
  FROM tfaktur WHERE id = varfakturid);
  UPDATE tfakturdetail SET jumlahretur = jumlahretur + new.jumlah, jumlahsisa = jumlah-jumlahretur 
  WHERE idfaktur = varfakturid AND itemid = new.itemid;
  UPDATE tfaktur SET totalretur = @subtotal + totalretur WHERE id = varfakturid;
  
  IF(@sisatagihan < 0) THEN
    INSERT INTO tmemo (kontakid, tipe, refid, debet, kredit, noakundebet, noakunkredit) 
    VALUES (varkontakid, '1', new.idretur, @subtotal, 0, @noakunpiutang, @noakunutang);
  END IF;
END IF;

END;

-- ----------------------------
-- Triggers structure for table tsaldoawal
-- ----------------------------
DROP TRIGGER IF EXISTS `insertAfterSaldoAwal`;
CREATE TRIGGER `insertAfterSaldoAwal` AFTER INSERT ON `tsaldoawal` FOR EACH ROW BEGIN
  SET @idsaldoawal = new.id;
  INSERT INTO tsaldoawaldetail (idsaldoawal, noakun, debet, kredit)
  SELECT @idsaldoawal, noakun, 0, 0 FROM mnoakun WHERE stdel = '0';
END;

-- ----------------------------
-- Triggers structure for table tsaldoawaldetail
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertJurnaldetail_copy1`;
CREATE TRIGGER `BeforeInsertJurnaldetail_copy1` BEFORE UPDATE ON `tsaldoawaldetail` FOR EACH ROW BEGIN

-- UPDATE tsaldoawal SET totaldebet = new.debet + totaldebet, totalkredit = new.kredit + totalkredit;

END;

-- ----------------------------
-- Triggers structure for table tstokkeluar
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertStokkeluar`;
CREATE TRIGGER `BeforeInsertStokkeluar` BEFORE INSERT ON `tstokkeluar` FOR EACH ROW BEGIN
DECLARE varkeluar, varharga INT;
DECLARE varitemid CHAR(2);

-- IF(new.tipe = '2') THEN
--  SET @fakturid = (SELECT fakturid FROM tretur WHERE id = new.refid);
--  SET @pengirimanid = (SELECT pengirimanid FROM tfaktur WHERE id = @fakturid);
--  UPDATE tstokmasuk SET keluar = keluar + new.jumlah, sisa = jumlah - keluar
--  WHERE itemid = new.itemid AND refid = @pengirimanid;
-- END IF;

-- IF(new.tipe = '1') THEN
SET varkeluar = new.jumlah;
SET @id = (SELECT id FROM tstokmasuk WHERE itemid = new.itemid AND gudangid = new.gudangid AND sisa > 0 LIMIT 1);
SET @sisa = (SELECT sisa FROM tstokmasuk WHERE id = @id);
SET varitemid = new.itemid;
SET varharga = 0;

REPEAT
  IF(@sisa > varkeluar) THEN
    UPDATE tstokmasuk SET sisa = @sisa-varkeluar, keluar = keluar+varkeluar WHERE id = @id;
    SET @harga = varharga + (SELECT harga FROM tstokmasuk WHERE id = @id) * varkeluar;
    SET varkeluar = 0;
  END IF;

  IF (@sisa < varkeluar) THEN
    UPDATE tstokmasuk SET sisa = 0, keluar = keluar+@sisa WHERE id = @id;
    SET varharga = (SELECT harga FROM tstokmasuk WHERE id = @id) * @sisa;
    SET varkeluar = varkeluar-@sisa;
    
    SET @id = (SELECT id FROM tstokmasuk WHERE itemid = new.itemid AND gudangid = new.gudangid AND sisa > 0 LIMIT 1);
    SET @sisa = (SELECT sisa FROM tstokmasuk WHERE id = @id);
    
  END IF;
  
  IF(@sisa = varkeluar) THEN
    UPDATE tstokmasuk SET sisa = 0, keluar = keluar+varkeluar WHERE id = @id;
    SET @harga = varharga + (SELECT harga FROM tstokmasuk WHERE id = @id) * varkeluar;
    SET varkeluar = 0;
  END IF;
  
  UNTIL varkeluar = 0
END REPEAT;

SET new.totalharga = @harga;
-- END IF;

END;

-- ----------------------------
-- Triggers structure for table tstokopname
-- ----------------------------
DROP TRIGGER IF EXISTS `BeforeInsertStokOpname`;
CREATE TRIGGER `BeforeInsertStokOpname` BEFORE INSERT ON `tstokopname` FOR EACH ROW BEGIN
  SET new.notrans = generatecodestokopname();
END;

-- ----------------------------
-- Triggers structure for table tstokopname
-- ----------------------------
DROP TRIGGER IF EXISTS `AfterInsertStokOpname`;
CREATE TRIGGER `AfterInsertStokOpname` AFTER INSERT ON `tstokopname` FOR EACH ROW BEGIN
  SET @totalharga = 0;
  SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
  
  IF(new.selisih < 0) THEN
    INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, jumlah, totalharga, refid)
    VALUES(new.gudangid, new.tanggal, new.itemid, ABS(new.selisih), 0, new.id);
    SET @stokkeluarid = LAST_INSERT_ID();
    SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE id = @stokkeluarid);
    
    
    INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid)
    VALUES (NOW(),CONCAT('Penyesuaian Persediaan ',new.notrans),'1','8',new.id);
    SET @idjurnal = LAST_INSERT_ID();
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga)
    ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
    
    INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, new.noakunpenyesuaian, @totalharga, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @totalharga;
  END IF;
  
  IF(new.selisih > 0) THEN
    SET @hargabeliterakhir = (SELECT hargabeliterakhir FROM mitem WHERE id = new.itemid);
    INSERT INTO tstokmasuk (gudangid, tanggalmasuk, itemid, harga, jumlah, keluar, sisa, refid, tipe)
    VALUES(new.gudangid, new.tanggal, new.itemid, 
    @hargabeliterakhir, new.selisih, 0, new.selisih, new.id, '3');
    SET @totalharga = @hargabeliterakhir*new.selisih;
    
    IF(new.kategori = '3') THEN
      UPDATE tsaldoawaldetail
      INNER JOIN tsaldoawal ON tsaldoawaldetail.idsaldoawal = tsaldoawal.id
      SET debet = @totalharga + debet
      WHERE tsaldoawal.status = '1' AND tsaldoawaldetail.noakun = new.noakunpenyesuaian;
      
      SET @noakunekuitas = (SELECT noakun FROM mnoakunpengaturan WHERE id = 21);
      UPDATE tsaldoawaldetail
      INNER JOIN tsaldoawal ON tsaldoawaldetail.idsaldoawal = tsaldoawal.id
      SET kredit = @totalharga + kredit
      WHERE tsaldoawal.status = '1' AND tsaldoawaldetail.noakun = @noakunekuitas;
    ELSE
      INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid)
      VALUES (NOW(),CONCAT('Penyesuaian Persediaan ',new.notrans),'1','8',new.id);
      SET @idjurnal = LAST_INSERT_ID();
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpersediaan, @totalharga, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @totalharga;
      
      INSERT INTO tjurnaldetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, new.noakunpenyesuaian, 0, @totalharga)
      ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
    END IF;
    

  END IF;
END;

SET FOREIGN_KEY_CHECKS = 1;
