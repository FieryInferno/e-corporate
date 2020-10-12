-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 11 Okt 2020 pada 10.29
-- Versi server: 5.7.31
-- Versi PHP: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fa165esq_ecorporate`
--

DELIMITER $$
--
-- Fungsi
--
CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodefaktur` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
BEGIN
  DECLARE firstkode VARCHAR(20);
  SET firstkode = CONCAT('#INV',DATE_FORMAT(CURRENT_DATE(),'%y%m%d'));
  SET @notrans = 0;
  SET @nomor = RIGHT(@notrans,3);
  SET @nomor = COALESCE(@nomor,0) + 1;
  SET @notrans = CONCAT(firstkode,LPAD(@nomor,3,'0'));

  RETURN @notrans;
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodeitem` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodejurnal` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodejurnalumum` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodememo` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodepembayaran` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodepembelian` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodepemesanan` (`xtipe` CHAR(1)) RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodepenerimaan` (`xtipe` CHAR(1)) RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodepengeluarankas` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodepengiriman` (`xtipe` CHAR(1)) RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecoderetur` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatecodestokopname` () RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
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
END$$

CREATE DEFINER=`fa165esq`@`localhost` FUNCTION `generatenoakun` (`xnoheader` VARCHAR(20)) RETURNS VARCHAR(20) CHARSET latin1 READS SQL DATA
BEGIN
  SET @count = (SELECT COUNT(*) FROM mnoakun WHERE noakunheader = xnoheader);
  SET @noakun = CONCAT(xnoheader, @count + 1);

  RETURN @noakun;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `laporanstok`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `laporanstok` (
`tanggal` date
,`itemid` int(11)
,`namaitem` varchar(255)
,`jumlah` int(11)
,`jenis` varchar(1)
,`keterangan` varchar(15)
,`refid` int(11)
,`gudangid` int(11)
,`tipe` char(1)
,`namagudang` varchar(255)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `manggotakoperasi`
--

CREATE TABLE `manggotakoperasi` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(15) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(255) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(255) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `manggotakoperasi`
--

INSERT INTO `manggotakoperasi` (`id`, `kode`, `nama`, `email`, `telepon`, `alamat`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'A001', 'Pak Asep', 'asep@gmail.com', '085840557925', 'Majalengka', '0', 'admin', '2020-02-29 19:15:42', 'admin', '2020-02-29 19:16:47', 'admin', '2020-02-29 19:16:58');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mbahasa`
--

CREATE TABLE `mbahasa` (
  `id` int(11) NOT NULL,
  `bahasa` varchar(30) DEFAULT NULL,
  `kode` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mbahasa`
--

INSERT INTO `mbahasa` (`id`, `bahasa`, `kode`) VALUES
(1, 'Indonesia', 'ID'),
(2, 'English', 'EN');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mbahasadetail`
--

CREATE TABLE `mbahasadetail` (
  `idbahasa` int(11) NOT NULL,
  `kode` varchar(100) NOT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mbahasadetail`
--

INSERT INTO `mbahasadetail` (`idbahasa`, `kode`, `deskripsi`) VALUES
(1, 'acceptedby', 'Diterima Oleh'),
(1, 'account', 'Akun'),
(1, 'account_header', 'Akun Header'),
(1, 'account_number', 'Nomor Akun'),
(1, 'account_setting', 'Pengaturan Akun'),
(1, 'action', 'Aksi'),
(1, 'add_new', 'Tambah Baru'),
(1, 'add_row', 'Tambah Baris'),
(1, 'adjusted_trial_balance', 'Neraca Saldo Penyesuaian'),
(1, 'adjusting_entries', 'Jurnal Penyesuaian'),
(1, 'apply', 'Terapkan'),
(1, 'automatic_numbering', 'Penomoran Otomatis'),
(1, 'available_quantity', 'Jumlah Tersedia'),
(1, 'back', 'Kembali'),
(1, 'balance', 'Saldo'),
(1, 'balance_sheet', 'Neraca'),
(1, 'bank_cash', 'Kas Bank'),
(1, 'beginning_balance', 'Saldo Awal'),
(1, 'book-entry', 'Pemindahbukuan'),
(1, 'cancel', 'Batal'),
(1, 'cash', 'Kas'),
(1, 'cashflow', 'Arus Kas'),
(1, 'category', 'Kategori'),
(1, 'change_password', 'Ganti Kata Sandi'),
(1, 'code', 'Kode'),
(1, 'company', 'Perusahaan'),
(1, 'company_code', 'Kode Perusahaan'),
(1, 'confirm_delete', 'Apakah Anda yakin akan menghapus data ini?'),
(1, 'contact', 'Kontak'),
(1, 'conversion', 'Konversi'),
(1, 'conversion_date', 'Tanggal Konversi'),
(1, 'create_invoice', 'Buat Faktur'),
(1, 'dashboard', 'Menu Utama'),
(1, 'data_not_found', 'Data tidak ditemukan'),
(1, 'date', 'Tanggal'),
(1, 'debet', 'Debet'),
(1, 'default_balance', 'Default Saldo'),
(1, 'delete', 'Hapus'),
(1, 'delivery', 'Pengiriman'),
(1, 'detail', 'Detail'),
(1, 'discount', 'Diskon'),
(1, 'done', 'Selesai'),
(1, 'edit', 'Ubah'),
(1, 'email', 'Email'),
(1, 'ending_balance', 'Saldo Akhir'),
(1, 'end_date', 'Tanggal Akhir'),
(1, 'error_deleted', 'Data Gagal dihapus'),
(1, 'error_login', 'Kesalahan Login'),
(1, 'error_save', 'Data gagal disimpan'),
(1, 'error_updated', 'Data Gagal diubah'),
(1, 'export', 'Ekspor'),
(1, 'finance', 'Keuangan'),
(1, 'from', 'Dari'),
(1, 'general_journal', 'Jurnal Umum'),
(1, 'goods_receipt', 'Penerimaan Barang'),
(1, 'grand_total', 'Total Keseluruhan'),
(1, 'header_status', 'Status Header'),
(1, 'income_statement', 'Laba Rugi'),
(1, 'information', 'Keterangan'),
(1, 'inventory_account', 'Akun Persediaan'),
(1, 'invoice', 'Faktur'),
(1, 'item', 'Item'),
(1, 'journal', 'Jurnal'),
(1, 'journal_entry', 'Entri Jurnal'),
(1, 'kredit', 'Kredit'),
(1, 'ledger', 'Buku Besar'),
(1, 'list', 'List'),
(1, 'lock', 'Kunci'),
(1, 'login', 'Masuk'),
(1, 'logout', 'Keluar'),
(1, 'memos', 'Memo'),
(1, 'name', 'Nama'),
(1, 'new_password', 'Kata Sandi Baru'),
(1, 'noakunpiutang', 'Akun Piutang'),
(1, 'noakunutang', 'Akun Utang'),
(1, 'nominal', 'Nominal'),
(1, 'note', 'Catatan'),
(1, 'notrans', 'No Trans'),
(1, 'no_receipt', 'No Kwitansi'),
(1, 'number', 'Nomor'),
(1, 'order', 'Pemesanan'),
(1, 'paidby', 'Dibayar Dengan'),
(1, 'partial', 'Sebagian'),
(1, 'password', 'Kata Sandi'),
(1, 'payment', 'Pembayaran'),
(1, 'payment_method', 'Metode Pembayaran'),
(1, 'payment_status', 'Status Pembayaran'),
(1, 'pending', 'Menunggu'),
(1, 'permission', 'Hak Akses'),
(1, 'petty_cash', 'Kas Kecil'),
(1, 'petty_cash_deposit', 'Setor Kas Kecil'),
(1, 'petty_cash_outlay', 'Pengeluaran Kas Kecil'),
(1, 'petty_cash_submission', 'Pengajuan Kas Kecil'),
(1, 'ppn', 'PPN'),
(1, 'price', 'Harga'),
(1, 'print', 'Cetak'),
(1, 'purchase_account', 'Akun Pembelian'),
(1, 'purchase_order', 'Pemesanan Pembelian'),
(1, 'purchase_price', 'Harga Beli'),
(1, 'purchase_report', 'Laporan Pembelian'),
(1, 'purchase_return_report', 'Laporan Retur Pembelian'),
(1, 'purchasing', 'Pembelian'),
(1, 'purchasing_report', 'Laporan Pembelian'),
(1, 'qty', 'Jumlah'),
(1, 'qty_available', 'Jumlah Tersedia'),
(1, 'qty_ordered', 'Jumlah Dipesan'),
(1, 'qty_received', 'Jumlah Diterima'),
(1, 'qty_residual', 'Jumlah Sisa'),
(1, 'qty_return', 'Jumlah Retur'),
(1, 'reception', 'Penerimaan'),
(1, 'recipients_name', 'Nama Penerima'),
(1, 'remaining_petty_cash', 'Sisa Kas Kecil'),
(1, 'report', 'Laporan'),
(1, 'residual', 'Sisa'),
(1, 'residual_value', 'Sisa Tagihan'),
(1, 'return', 'Retur'),
(1, 'return_option', 'Opsi Retur'),
(1, 'return_reason', 'Alasan Retur'),
(1, 'sales', 'Penjualan'),
(1, 'sales_account', 'Akun Penjualan'),
(1, 'sales_order', 'Pemesanan Penjualan'),
(1, 'sales_price', 'Harga Jual'),
(1, 'sales_report', 'Laporan Penjualan'),
(1, 'sales_return_report', 'Laporan Retur Penjualan'),
(1, 'save', 'Simpan'),
(1, 'search', 'Cari'),
(1, 'selling', 'Penjualan'),
(1, 'selling_report', 'Laporan Penjualan'),
(1, 'spending', 'Pengeluaran'),
(1, 'start_date', 'Tanggal Awal'),
(1, 'statement_of_Owner_Equity', 'Perubahan Modal'),
(1, 'status', 'Status'),
(1, 'stock', 'Stok'),
(1, 'stock_card', 'Kartu Stok'),
(1, 'stock_report', 'Laporan Stok'),
(1, 'subtotal', 'Subtotal'),
(1, 'supplier', 'Rekanan'),
(1, 'telephone', 'Telepon'),
(1, 'to', 'Kepada'),
(1, 'total', 'Total'),
(1, 'totalpaid', 'Total yang Dibayarkan'),
(1, 'total_debet', 'Total Debet'),
(1, 'total_kredit', 'Total Kredit'),
(1, 'trial_balance', 'Neraca Saldo'),
(1, 'type', 'Tipe'),
(1, 'unit', 'Satuan'),
(1, 'update_error_message', 'Data gagal diupdate'),
(1, 'update_success_message', 'Data berhasil diubah'),
(1, 'user', 'User'),
(1, 'username', 'Nama Pengguna'),
(1, 'user_management', 'Pengelolaan User'),
(1, 'validation_of_petty_cash_disbursements', 'Validasi Pengeluaran Kas Kecil'),
(1, 'view_journal', 'Lihat Jurnal'),
(1, 'warehouse', 'Gudang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mcabang`
--

CREATE TABLE `mcabang` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(60) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(60) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(60) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `mcabang`
--

INSERT INTO `mcabang` (`id`, `kode`, `nama`, `alamat`, `keterangan`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'JKTTMR', 'Cabang Pusat', 'Jakarta', NULL, '0', 'admin', '2020-02-29 15:03:23', 'admin', '2020-02-29 18:55:28', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mcarabayar`
--

CREATE TABLE `mcarabayar` (
  `id` int(11) NOT NULL,
  `nama` varchar(30) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(60) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(60) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(60) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `mcarabayar`
--

INSERT INTO `mcarabayar` (`id`, `nama`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'Kas Tunai', '0', NULL, NULL, 'admin', '2019-05-15 13:40:34', NULL, NULL),
(2, 'Cek & Giro', '1', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Transfer Bank', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Kartu Kredit', '1', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mdepartemen`
--

CREATE TABLE `mdepartemen` (
  `id` int(11) NOT NULL,
  `id_perusahaan` int(11) NOT NULL,
  `nama` varchar(200) NOT NULL,
  `pejabat` varchar(100) NOT NULL,
  `jabatan` varchar(100) NOT NULL,
  `uby` varchar(100) NOT NULL,
  `udate` datetime NOT NULL,
  `cby` varchar(100) NOT NULL,
  `cdate` datetime NOT NULL,
  `dby` varchar(100) NOT NULL,
  `ddate` datetime NOT NULL,
  `sdel` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mdepartemen`
--

INSERT INTO `mdepartemen` (`id`, `id_perusahaan`, `nama`, `pejabat`, `jabatan`, `uby`, `udate`, `cby`, `cdate`, `dby`, `ddate`, `sdel`) VALUES
(5, 6, 'keuangan', 'adi', 'kepala keuangan', '', '0000-00-00 00:00:00', 'admin123', '2020-08-13 11:33:58', '', '0000-00-00 00:00:00', '0'),
(6, 7, 'Sales_Marketing', 'andri', 'Marketing Manager', '', '0000-00-00 00:00:00', 'admin123', '2020-08-13 11:34:30', '', '0000-00-00 00:00:00', '0'),
(7, 7, 'Operational', 'Sholihin', 'General Manager', '', '0000-00-00 00:00:00', 'admin123', '2020-08-13 13:22:50', '', '0000-00-00 00:00:00', '0'),
(8, 6, 'Sales_Marketing', 'amin', 'direktur utama', '', '0000-00-00 00:00:00', 'admin123', '2020-08-19 14:25:49', '', '0000-00-00 00:00:00', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mgudang`
--

CREATE TABLE `mgudang` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(60) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(60) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(60) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `mgudang`
--

INSERT INTO `mgudang` (`id`, `nama`, `alamat`, `keterangan`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'Gudang Jayapura', 'Majalengka', '-', '1', NULL, NULL, 'admin', '2019-08-21 07:36:54', 'admin', '2019-08-27 16:30:49'),
(2, 'Gudang A', NULL, NULL, '1', 'admin', '2019-05-15 13:20:22', NULL, NULL, NULL, NULL),
(3, 'GUDANG PUSAT', NULL, NULL, '1', 'userdemo', '2019-07-01 16:12:39', NULL, NULL, 'admin', '2019-08-27 16:30:53'),
(4, 'Gudang Maumere', NULL, NULL, '1', 'admin', '2019-08-21 07:37:08', NULL, NULL, 'admin', '2019-08-27 16:31:13'),
(5, 'Gudang A', NULL, NULL, '0', 'admin', '2019-08-27 16:58:01', 'admin', '2020-03-05 03:07:31', NULL, NULL),
(6, 'Gudang 1', NULL, NULL, '1', 'admin', '2019-08-27 16:58:02', NULL, NULL, 'admin', '2019-08-27 16:58:13'),
(7, 'Gudang B', NULL, NULL, '0', 'admin', '2019-08-30 12:48:59', 'admin', '2020-03-05 03:07:25', NULL, NULL),
(8, 'Jasa', NULL, NULL, '0', 'admin', '2020-09-05 15:45:53', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mitem`
--

CREATE TABLE `mitem` (
  `id` int(11) NOT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `satuanid` int(11) DEFAULT NULL,
  `kategoriid` int(11) DEFAULT NULL,
  `hargabeli` decimal(10,0) DEFAULT NULL,
  `hargajual` decimal(10,0) DEFAULT NULL,
  `hargabeliterakhir` decimal(10,0) DEFAULT NULL,
  `noakunbeli` varchar(20) DEFAULT NULL,
  `noakunjual` varchar(20) DEFAULT NULL,
  `noakunpersediaan` varchar(20) DEFAULT NULL,
  `noakunpajak` varchar(20) DEFAULT NULL,
  `noakunpajakmasukan` varchar(20) DEFAULT NULL,
  `noakunpajakkeluaran` varchar(20) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(255) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `mitem`
--

INSERT INTO `mitem` (`id`, `kode`, `nama`, `satuanid`, `kategoriid`, `hargabeli`, `hargajual`, `hargabeliterakhir`, `noakunbeli`, `noakunjual`, `noakunpersediaan`, `noakunpajak`, `noakunpajakmasukan`, `noakunpajakkeluaran`, `gambar`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'MI-5PLUS', 'HP Xiaomi 5 Plus', 2, 2, 1800000, 2000000, 1800000, '51141', '41111', '13111', '1412', '1412', '2212', '159fb0ede2f18ad497045e39a5935c32.jpg', '0', NULL, NULL, 'admin', '2020-02-07 21:57:02', 'admin', '2020-09-08 07:58:01'),
(4, '#PROD0001', 'Samsung Gal S9', 2, 2, 500000, 1000000, 500000, '51142', '41112', '13112', '1412', '1412', '2212', '9d78ec32898c3c17614060506bd7c7f8.jpg', '0', 'admin', '2020-03-05 04:02:39', 'admin', '2020-03-05 04:03:21', 'admin', '2020-09-08 07:57:57'),
(6, '22', 'asdasda', 2, 1, 0, 0, 0, '1112', '4111', '510', '1412', '1412', '11010102		\r\n', '70a788746690a7a264fb85c1f4156d04.jpg', '1', 'admin123', '2020-08-17 09:10:09', NULL, NULL, 'admin', '2020-09-20 17:05:56'),
(7, '2123', 'snek', 1, 1, 0, 0, 0, '14', '13', '510', '012', '012', '11', '271741f8e4a027f7a04dc9c192ab8dd3.jpg', '1', 'admin123', '2020-08-18 08:58:43', NULL, NULL, 'admin', '2020-09-20 17:05:53'),
(8, '#PROD0002', 'Kertas HVS F4', 2, 1, 0, 0, 0, '14', '13', '1170101', '012', '012', '11', '', '0', 'admin123', '2020-08-26 12:15:58', 'admin123', '2020-08-26 12:46:36', 'admin123', '2020-08-26 20:37:25'),
(9, '#PROD0003', 'Pensil', 2, 1, 0, 0, 0, '14', '13', '1170101', '012', '012', '11', '', '0', 'admin123', '2020-08-26 12:16:53', NULL, NULL, 'admin123', '2020-08-26 20:37:39'),
(10, 'A4-80', 'Kertas HVS A4 80 Gsm', 1, 1, 0, 0, 0, '14', '13', '1170101', '012', '012', '11', '', '0', 'admin123', '2020-08-26 20:40:11', NULL, NULL, 'admin', '2020-09-08 07:53:28'),
(11, 'AMP002', 'Amplop Sertifikat', 1, 1, 0, 0, 0, '14', '13', '1170102', '012', '012', '11', '', '0', 'admin123', '2020-08-26 20:40:52', 'admin', '2020-09-08 08:26:41', 'admin', '2020-09-08 08:36:04'),
(12, 'AMP003', 'Amplop Sertifikat ACT', 1, 1, 0, 0, 0, '14', '13', '1170102', '012', '012', '11', '', '0', 'admin123', '2020-08-26 20:41:43', 'admin', '2020-09-08 08:26:59', 'admin', '2020-09-08 08:36:01'),
(13, 'ATK01', 'KERTAS', 2, 1, 0, 0, 0, '14', '13', '1170102', '012', '012', '11', '', '0', 'admin123', '2020-08-27 07:35:19', 'admin', '2020-09-08 08:27:11', 'admin', '2020-09-08 08:35:55'),
(14, 'ATK02', 'BALLPOINT', 1, 1, 0, 0, 0, '14', '13', '1170102', '012', '012', '11', '', '0', 'admin123', '2020-08-27 07:36:02', 'admin', '2020-09-08 08:27:25', 'admin', '2020-09-08 08:35:50'),
(15, '#PROD00045', 'snekin aja', 2, 2, 0, 0, 0, '5114', '4111', '11010105', '1412', '1412', '2212', '', '1', 'admin', '2020-09-03 14:54:08', 'admin', '2020-09-03 16:32:00', 'admin', '2020-09-20 17:05:42'),
(16, '#PROD0046', 'CHIKI', 1, 1, 0, 0, 0, '5114', '4111', '1710101', '1412', '1412', '2212', '', '1', 'admin', '2020-09-04 13:20:52', NULL, NULL, 'admin', '2020-09-20 17:05:37'),
(17, '#PROD0047', 'KERTAS', 4, 1, 0, 0, 0, '5114', '4111', '1710101', '1412', '1412', '2212', '', '1', 'admin', '2020-09-08 08:36:40', NULL, NULL, 'admin', '2020-09-20 17:05:33'),
(18, '#PROD0048', 'Stapler', 2, 1, 0, 0, 0, '5114', '4111', '1170102', '1412', '1412', '2212', '', '1', 'admin', '2020-09-08 08:37:13', 'admin', '2020-09-08 08:58:26', 'admin', '2020-09-20 17:05:30'),
(19, '#PROD0049', 'KERTAS', 4, 1, 0, 0, 0, '5114', '4111', '1170102', '1412', '1412', '2212', '', '1', 'admin', '2020-09-08 08:59:33', NULL, NULL, 'admin', '2020-09-20 17:05:26'),
(22, '#PROD0050', 'KERTAS', 4, 1, 0, 0, 0, '5114', '4111', '1170102', '1412', '1412', '2212', '', '1', 'admin', '2020-09-08 10:54:13', NULL, NULL, 'admin', '2020-09-20 17:05:16'),
(23, '#PROD0051', 'Stapler', 2, 1, 0, 0, 0, '5114', '4111', '1170102', '1412', '1412', '2212', '', '1', 'admin', '2020-09-08 10:55:56', NULL, NULL, 'admin', '2020-09-20 17:05:12');

--
-- Trigger `mitem`
--
DELIMITER $$
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

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `mjasa`
--

CREATE TABLE `mjasa` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(60) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(60) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(60) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `mjasa`
--

INSERT INTO `mjasa` (`id`, `nama`, `kode`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'Jasa Pembuatan Website', 'J001', '0', 'admin', '2020-02-29 18:53:44', NULL, NULL, 'admin', '2020-02-29 18:54:03');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mkategori`
--

CREATE TABLE `mkategori` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `dby` varchar(100) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mkategori`
--

INSERT INTO `mkategori` (`id`, `nama`, `stdel`, `uby`, `udate`, `cby`, `cdate`, `dby`, `ddate`) VALUES
(1, 'ATK', '0', 'admin', '2019-06-20 04:05:17', 'admin', '2019-05-15 15:20:20', NULL, NULL),
(2, 'Elektronik', '0', 'admin', '2019-06-21 09:12:21', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mkontak`
--

CREATE TABLE `mkontak` (
  `id` int(11) NOT NULL,
  `tipe` char(1) DEFAULT NULL,
  `nama` varchar(60) DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `alamat` varchar(255) DEFAULT NULL,
  `cp` varchar(255) DEFAULT NULL,
  `noakunpiutang` varchar(30) DEFAULT NULL,
  `noakunutang` varchar(30) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(60) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(60) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(60) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL,
  `debetmemo` decimal(10,0) DEFAULT '0',
  `kreditmemo` decimal(10,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mkontak`
--

INSERT INTO `mkontak` (`id`, `tipe`, `nama`, `telepon`, `email`, `alamat`, `cp`, `noakunpiutang`, `noakunutang`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`, `debetmemo`, `kreditmemo`) VALUES
(1, '2', 'Pelanggan Anonim', '089100000', 'isyanto.id@gmail.com', 'Bandung', 'Contact Person', '12111', '2111', '0', NULL, NULL, 'admin', '2019-06-19 07:33:34', NULL, NULL, 0, 0),
(2, '1', 'CV DroidPhone', '089100000', 'droidphone@gmail.com', 'Bandung', 'Tn Iyan Isyanto', '1211', '2113', '0', 'admin', '2019-05-16 08:46:47', 'admin', '2019-10-13 16:18:25', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mnoakun`
--

CREATE TABLE `mnoakun` (
  `idakun` int(191) NOT NULL,
  `noakuntop` varchar(11) DEFAULT NULL,
  `tipe` varchar(11) DEFAULT NULL,
  `noakunheader` varchar(255) DEFAULT NULL,
  `jenis` varchar(11) DEFAULT NULL,
  `objek` varchar(11) DEFAULT NULL,
  `rincian` varchar(11) DEFAULT NULL,
  `noakun` varchar(11) DEFAULT NULL,
  `akunno` varchar(11) DEFAULT NULL,
  `namaakun` varchar(255) DEFAULT NULL,
  `saldo` decimal(10,0) DEFAULT NULL,
  `stheader` char(1) DEFAULT '1',
  `stdebet` char(1) DEFAULT NULL,
  `stbayar` char(1) DEFAULT NULL,
  `stkunci` char(1) DEFAULT '1',
  `stdefault` char(1) DEFAULT NULL,
  `kategoriakun` varchar(30) DEFAULT NULL,
  `sthapus` char(1) DEFAULT '0',
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(255) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(255) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mnoakun`
--

INSERT INTO `mnoakun` (`idakun`, `noakuntop`, `tipe`, `noakunheader`, `jenis`, `objek`, `rincian`, `noakun`, `akunno`, `namaakun`, `saldo`, `stheader`, `stdebet`, `stbayar`, `stkunci`, `stdefault`, `kategoriakun`, `sthapus`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, '1', '1', '1', '01', '02', '01', '18', '11010201', 'Kas Kecil', 0, '0', '1', '1', '1', NULL, 'Cash/Bank', '0', '0', 'admin', '2020-09-19 19:13:26', NULL, NULL, NULL, NULL),
(2, '1', '', '1', '01', '', '', '11', '1101', 'Kas', 0, '0', NULL, '0', '1', NULL, 'Cash/Bank\n', '0', '0', 'admin123', '2020-08-16 14:21:56', NULL, NULL, NULL, NULL),
(3, '1', '', '1', '01', '01', '02', '12', '11010102', 'Kas US Dollar', 0, '0', NULL, '0', '1', NULL, 'Cash/Bank\n', '0', '0', 'admin123', '2020-08-16 14:23:12', NULL, NULL, NULL, NULL),
(4, '1', '', '1', '01', '01', '03', '13', '11010103', 'Kas Rm', 0, '0', NULL, '0', '1', NULL, 'Cash/Bank\n', '0', '0', 'admin123', '2020-08-16 14:23:57', NULL, NULL, NULL, NULL),
(5, '1', '', '1', '02', '01', '04', '14', '11020104', 'Kas Kecil PT ABB', 0, '0', NULL, '0', '1', NULL, 'Cash/Bank\n', '0', '0', 'admin123', '2020-08-16 14:24:41', NULL, NULL, NULL, NULL),
(6, '1', '', '1', '01', '01', '05', '15', '11010105', 'Kas Dana Cadangan', 0, '0', NULL, '0', '1', NULL, 'Cash/Bank\n', '0', '0', 'admin123', '2020-08-16 14:25:18', NULL, NULL, NULL, NULL),
(7, '1', '', '1', '01', '04', '', '16', '110104', 'Kas Besar Training', 0, '0', NULL, '0', '1', NULL, 'Cash/Bank\n', '0', '0', 'admin123', '2020-08-16 14:26:46', NULL, NULL, NULL, NULL),
(8, '5', '', '10', '', '', '', '101', '510', 'HPP', 0, '0', NULL, '0', '1', NULL, 'Cost of Goods Sold\n', '0', '0', 'admin123', '2020-08-16 14:28:05', NULL, NULL, NULL, NULL),
(9, '5', '', '10', '10', '', '', '102', '51010', 'HPP Training', 0, '0', NULL, '0', '1', NULL, 'Cost of Goods Sold\n', '0', '0', 'admin123', '2020-08-16 14:28:26', NULL, NULL, NULL, NULL),
(10, '5001', '', '01', '01', '', '', '011', '50010101', 'HPP Sewa Hotel', 0, '0', NULL, '0', '1', NULL, 'Cost of Goods Sold\n', '0', '0', 'admin123', '2020-08-16 14:29:11', NULL, NULL, NULL, NULL),
(11, '5001', '', '01', '02', '', '', '012', '50010102', 'HPP Sewa gedung dan ruangan', 0, '0', NULL, '0', '1', NULL, 'Cost of Goods Sold\n', '0', '0', 'admin123', '2020-08-16 14:30:22', NULL, NULL, NULL, NULL),
(12, '5001', '', '01', '03', '', '', '013', '50010103', 'HPP Catering & Konsumsi', 0, '0', NULL, '0', '1', NULL, 'Cost of Goods Sold\n', '0', '0', 'admin123', '2020-08-16 14:31:05', NULL, NULL, NULL, NULL),
(13, '4', '', '001', '00', '', '', '0011', '400100', 'Pendapatan Usaha', 0, '0', NULL, '0', '1', NULL, 'Revenue\n', '0', '0', 'admin123', '2020-08-16 14:35:58', NULL, NULL, NULL, NULL),
(14, '4', '', '001', '01', '', '', '0012', '400101', 'Pendapatan Public', 0, '0', NULL, '0', '1', NULL, 'Revenue\n', '0', '0', 'admin123', '2020-08-16 14:38:09', NULL, NULL, NULL, NULL),
(15, '4001', '', '01', '01', '', '', '014', '40010101', 'Pend.Public Eks', 0, '0', NULL, '0', '1', NULL, 'Revenue\n', '0', '0', 'admin123', '2020-08-16 14:38:56', NULL, NULL, NULL, NULL),
(16, '4001', '', '01', '02', '', '', '015', '40010102', 'Pend.Public Profesional', 0, '0', NULL, '0', '1', NULL, 'Revenue\n', '0', '0', 'admin123', '2020-08-16 14:39:42', NULL, NULL, NULL, NULL),
(17, '0', '', '01', '03', '', '', '016', '40010103', 'Pend.Public Reguler', 0, '0', NULL, '0', '1', NULL, 'Revenue\n', '0', '0', 'admin123', '2020-08-16 14:47:07', NULL, NULL, NULL, NULL),
(18, '1', '1', '7', '1', '01', '01', '71', '1710101', 'Persediaan Barang Dagangan\r\n', 0, '0', '1', '1', '1', NULL, 'Cash/Bank', '0', '0', 'admin', '2020-09-04 13:12:56', NULL, NULL, NULL, NULL),
(19, '1', '1', '1', '7', '01', '02', '17', '1170102', 'Persediaan Peralatan Kantor', 0, '0', '1', '1', '1', NULL, 'Cash/Bank', '0', '0', 'admin', '2020-09-08 08:26:17', NULL, NULL, NULL, NULL),
(20, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.01.0', 'Kas RM', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(21, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.01.0', 'Kas $ Singapura', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(22, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.01.0', 'Kas Dana Cadangan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.01.9', 'Cash in Transit', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.02', 'Kas Kecil Jakarta', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(25, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.02.0', 'Kas Kecil ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(26, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.02.0', 'Kas Besar Penjualan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(27, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Bandung', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(28, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Surabaya', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(29, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Semarang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(30, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Medan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(31, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Padang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(32, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Palembang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(33, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Bali', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(34, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Riau', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(35, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.0', 'Kas kecil cab Makasar', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(36, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.1', 'Kas kecil cab Balikpapan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(37, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.1', 'Kas Kecil Banjarmasin', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(38, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.1', 'Kas Kecil Aceh', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(39, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.1', 'Kas Kecil Lampung', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(40, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.03.1', 'Kas Kecil Yogya', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(41, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04', 'Kas Besar Training', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(42, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Bandung', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(43, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Surabaya', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(44, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Semarang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(45, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Medan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(46, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Padang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(47, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Palembang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(48, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Bali', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.0', 'KBT Cab Riau', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(50, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.1', 'KBT Cab Makasar', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(51, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.1', 'KBT Cab Balikpapan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.1', 'KBT Cab Banjarmasin', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(53, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.01.04.9', 'KBT Cab Jakarta', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(54, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.01.03.', 'Kas Kecil Batam', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(55, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02', 'Bank', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(56, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01', 'Rek BCA', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(57, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.6595 - rek induk ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(58, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.6765 - rek operasional', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(59, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.8156 ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(60, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.2603 ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(61, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.7699 ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(62, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.5190 - In House', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(63, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.0', 'BCA 679.030.7265 (Induk IE)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(64, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.1', 'BCA 679.030.3561 (ESQ Store)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(65, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.1', 'BCA 679.030.7656 (ESQ Store)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(66, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.1', 'BCA 679.030.9433 (ESQ Store)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(67, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.01.1', 'BCA 9951', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(68, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BCA 679.030.9012 (AoC)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(69, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BCA 679.030.2506', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(70, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BCA 679.030.6561', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(71, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.02.41', 'BCA 679.030.4665', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(72, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.02.42', 'BCA 679.030.2409', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(73, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02', 'Rek. Mandiri', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(74, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Mandiri 1010001155660 (operasional)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(75, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Mandiri Induk 1010006655110', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(76, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Rekening Tabungan Mandiri', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(77, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Mandiri 1010007455163 (QQ Panitia Milad ESQ)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(78, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Mandiri 1010006565475 (ESQ Store)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(79, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Mandiri 1010009841667', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(80, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.1', 'Mandiri - 0805', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(81, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.02.46', 'Mandiri Induk 1260005953269', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(82, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03', 'Rek BSM', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(83, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BSM 004.7777.165 (7000591178)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(84, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BSM 004.0000.165 - USD (7000486706)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(85, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BSM 004.1111.165 (7000540678)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(86, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BSM - ESCROW', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(87, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BSM 7096078457 (QQ Milad ESQ)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(88, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.0', 'BSM 7110964743 - MARGIN DEP BG ARGA BANGUN BANGSA PT (8005)', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(89, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.1', 'BSM 004.1234.165 (7000540689) ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(90, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.03.1', 'BSM 7000650001 ESQ VT', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(91, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.04', 'Rek.BNI', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(92, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.04.0', 'BNI 014.696.7765', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(93, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.04.0', 'BNI Syariah - 7165165997', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(94, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10', 'Rek Lain', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(95, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'BPD Kaltim Syariah', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(96, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'Bank Kaltim - 0151505481', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(97, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'Bank Jabar & Banten - 0063037397001', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(98, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'BTPN 00433000285', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(99, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'BRI 038.201000087305', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(100, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'Bank DKI - 42508000256', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(101, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'Bank Danamon - 0010407477', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(102, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'BRI SYARIAH - 1014595682', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(103, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.0', 'Panin Syariah - 1409000369', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(104, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Bank Jateng - 1036003631', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(105, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'CIMB NIAGA - 860003755800', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(106, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Bank Sul Sel - 1703051286', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(107, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'MAYBANK - 2022510628', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(108, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Bank Tabungan Negara - 0000000101300009657', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(109, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Bank Nagari - 24000103003500', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(110, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Bank Sumselbabel - 2003050240', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(111, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Permata Syariah - 00971203676', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(112, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.10.1', 'Permata Syariah 1815762165 - Jakarta', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(113, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20', 'Rek Induk Cab', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(114, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri induk cab Bandung ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(115, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri induk cab Semarang ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(116, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri Induk Cab Medan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(117, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri induk cab Surabaya ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(118, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri induk cab Bali ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(119, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri induk cab Riau ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(120, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.0', 'Mandiri induk cab Makasar ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(121, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.1', 'Mandiri  induk cab Balikpapan ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(122, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.1', 'Mandiri Induk Cab Banjarmasin - 101.000.6967226', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(123, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.1', 'Mandiri induk cab Padang ', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(124, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.2', 'Permata Syariah 1815727165 - Cabang Bandung', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(125, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.2', 'Permata Syariah 1815733165 - Cabang Semarang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(126, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.20.2', 'Permata Syariah 1815756165 - Cabang Surabaya', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(127, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30', 'Rek Operasional Cab', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(128, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Bandung', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(129, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Surabaya', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(130, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Semarang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(131, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Medan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(132, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Padang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(133, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Palembang', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(134, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Bali', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(135, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Riau', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(136, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.0', 'Mandiri operasional cab Makasar', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(137, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.30.1', 'Mandiri operasional cab Balikpapan', 0, '1', NULL, NULL, '1', NULL, 'Cash/Bank', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(138, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Aset Pajak tangguhan', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(139, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Beban Ditangguhkan', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(140, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(141, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Griya Bangun Persada, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(142, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga Cipta Grande, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(143, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga budi Multimedia, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(144, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Imaji Menara Produksi, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(145, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - LSP Trainer Indonesia, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(146, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Bukit Bangun Cont, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(147, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Fajrul Ikhsan Wisata, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(148, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - ESQ Malaysia', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(149, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Direksi', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(150, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha - Pihak Berelasi', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(151, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(152, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(153, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - YABI', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(154, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - EBS Global Nutrisarana', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(155, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - ESQ Jaya Solusindo, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(156, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga Telematika Solusindo', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(157, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga ESQ Semesta Tour, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(158, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - YAGA', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(159, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga Tilanta, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(160, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga Nusa Persada, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(161, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Menara Cipta Bahagia, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(162, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Arga Pilar, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(163, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.0', 'Piutang Non Usaha Pihak Berelasi - Bayu Pratama Int, PT', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(164, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.02.02.1', 'Pekerjaan Dalam Proses', 0, '1', NULL, NULL, '1', NULL, 'Other Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(165, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10', 'Piutang', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(166, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01', 'Piutang  Usaha', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(167, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Training Public ', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(168, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Training In House', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(169, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang ACT', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(170, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Outbond', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(171, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Presentasi & Seminar', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(172, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Tidak Identifikasi', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(173, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Cadangan Piutang Tak Tertagih', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(174, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Lain-Lain (atas PPh 23)', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(175, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Membership', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(176, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang membership $ RM', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(177, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Membership $ Sin', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(178, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Usaha Lain - Lain', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(179, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10', 'Piutang Non Usaha', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(180, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.01.0', 'Piutang Kartu Alumni', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(181, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Usaha ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(182, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Usaha Virtual Training', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(183, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Usaha ESQ Media', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(184, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Usaha RBT', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(185, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Kepada Pemegang Saham ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(186, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.03', 'Piutang Lain Lain', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(187, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.04', 'Piutang Karyawan ', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(188, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.05', 'Cash Advance', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(189, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.06', 'Piutang tiket & pengiriman training kit', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(190, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.10', 'Piutang Partner', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(191, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.11', 'Cash Advance ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(192, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.12', 'Akun Perantara Piutang Antar Grup Arga', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(193, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.70', 'Piutang Management', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(194, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.70.0', 'Piutang kpd Holding', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(195, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.101.08', 'Cadangan piutang tidak tertagih', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(196, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.101.08', 'Piutang Karyawan Non Management', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(197, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.101.08', 'Piutang karyawan Management', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(198, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.101.08', 'Akun Perantara Piutang', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(199, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20', 'Uang Muka Pembelian', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(200, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Sewa Hotel', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(201, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Sewa Gedung & Ruang', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(202, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Catering & Konsumsi', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(203, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka Lain-Lain', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(204, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Tunjangan Training', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(205, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Perlengkapan Training', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(206, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Peralatan Training', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(207, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Perjalanan Dinas Training', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(208, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.0', 'Uang Muka  Training Kit', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(209, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.1', 'Uang Muka  Biaya Promo (FBADS&DIGIMAN)', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(210, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.1', 'Uang Muka Sewa Kamar HTL', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(211, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.01.1', 'Uang Muka Pembelian (Amazing You)', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(212, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02', 'Biaya Dibayar Di Muka', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(213, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Sewa dibayar di muka', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(214, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Asuransi dibayar dimuka', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(215, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Biaya dibayar dimuka lainnya', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(216, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Pekerjaan dalam proses', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(217, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Deviden dibayar dimuka', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(218, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Biaya Dibayar Dimuka - Fasilitas Mobil Trainer Partner', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(219, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Biaya Dibayar Dimuka - Biaya Langsung', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(220, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.0', 'Biaya Dibayar Dimuka - Biaya Internet', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(221, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.1', 'Biaya Dibayar Dimuka - Gallup (Strength Finder)', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(222, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.1', 'Uang Muka - JASA ANGKASA SEMESTA', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(223, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.1', 'Biaya Dibayar Dimuka - Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(224, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.1', 'Biaya Dibayar Dimuka ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(225, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.02.1', 'Biaya Dibayar Dimuka - Partner', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(226, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.101.08', 'Aset Pajak Tangguhan', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(227, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03', 'Pajak Dibayar Dimuka', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(228, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03.0', 'Pajak Pembelian (PPN Masukan)', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(229, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03.0', 'Angsuran PPh 21', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(230, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03.0', 'Angsuran PPh 23', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(231, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03.0', 'Angsuran PPh 24', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(232, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03.0', 'Angsuran PPh 25', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(233, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.20.03.0', 'Angsuran PPh 26', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(234, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.12.03', 'Angsuran PPh 22', 0, '1', NULL, NULL, '1', NULL, 'Other Current Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(235, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30', 'Persediaan', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(236, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.01', 'Persediaan Training', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(237, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.02', 'Persediaan Data Center', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(238, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.03', 'Persediaan Bahan Baku', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(239, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.04', 'Persediaan Barang Dagang', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(240, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.05', 'Persediaan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(241, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.05.0', 'Persediaan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(242, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.30.06', 'Persediaan Dalam Proses ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(243, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.40.2', 'Perlengkapan Training', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(244, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.40.3', 'Perlengkapan', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(245, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.09.02.', 'Persediaan Barang Jadi', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(246, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.09.02.', 'Persediaan Barang Dalam Proses', 0, '1', NULL, NULL, '1', NULL, 'Inventory', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(247, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.20', 'Aktiva Tetap', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(248, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01', 'Harga Perolehan Aktiva Tetap', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(249, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.01', 'Tanah', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(250, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.02', 'Gedung', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(251, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.03', 'Peralatan Operasional', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(252, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.04', 'Peralatan Kantor & Mebel', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(253, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.05', 'Kendaraan', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(254, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.06', 'Pengadaan Asset PT ABB', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(255, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.08', 'Peralatan ESQ Store & VT', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(256, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.2.01.07', 'Piutang Non Usaha Pihak Berelasi', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(257, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.30', 'Investasi', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(258, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.01', 'Investasi', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(259, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.03', 'Investasi Grha 165', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(260, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.05', 'Investasi ke divisi-divisi', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(261, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.06', 'Investasi Arga Nirwana', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(262, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.08', 'Investasi Lain2', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(263, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.09', 'Investasi Menara Cipta Bahagia', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(264, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.10', 'Investasi Griya Bangun Persada (GBP)', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(265, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.11', 'Investasi Asuransi Jiwa Amanah Githa', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(266, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.12', 'Investasi ACT', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(267, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.13', 'Investasi Yayasan Ary Ginanjar Agustian', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(268, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.14', 'Investasi Pengembangan SDM', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(269, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.15', 'Investasi Lantai 24 Menara 165', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` (`idakun`, `noakuntop`, `tipe`, `noakunheader`, `jenis`, `objek`, `rincian`, `noakun`, `akunno`, `namaakun`, `saldo`, `stheader`, `stdebet`, `stbayar`, `stkunci`, `stdefault`, `kategoriakun`, `sthapus`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(270, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.16', 'Investasi Bayu Pratama International (ESQ English Course)', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(271, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.17', 'Investasi Prasetya Intranusa (ESQ Bimbel)', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(272, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.18', 'Kepentingan Minoritas', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(273, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.3.19', 'Investasi BBC', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(274, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.40', 'Aktiva Tak Berwujud', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(275, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.4.01', 'Hak Paten', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(276, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.4.02', 'Goodwill msg-msg', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(277, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.4.03', 'Lisensi', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(278, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.4.05', 'Biaya Dibayar Dimuka', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(279, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.4.06', 'Investasi VT', 0, '1', NULL, NULL, '1', NULL, 'Fixed Asset', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(280, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02', 'Piutang Antar Group Arga', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(281, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Arga Rumah Produksi', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(282, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Arga ESQ Semesta Tour', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(283, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Arga Pilar', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(284, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang ESQ Sdn Bhd Malaysia', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(285, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Arga Publishing', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(286, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang New Tilanta', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(287, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Agrabudi', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(288, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Yayasan Ary Ginanjar Agustian', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(289, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.0', 'Piutang Menara Cipta Bahagia', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(290, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Griya Bangun Persada', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(291, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Bayu Pramata International', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(292, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Prastya Intranusa (ESQ Bimbel)', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(293, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang ANP', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(294, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.1', 'Piutang Antar Grup ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(295, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.2', 'Piutang Yayasan Arga Bangun Indonesia', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(296, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.1.10.10.2', 'Piutang EBS Global Nutrisarana', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(297, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang Arga Cipta Grande', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(298, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang Imaji Menara Produksi', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(299, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang LSP Trainer Indonesia', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(300, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang Bukit Bangun Continental', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(301, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang Fajrul Ikhsan Wisata', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(302, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang ESQ Jaya Solusindo', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(303, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang Arga Telematika Solusi', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(304, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.02.', 'Piutang Arga Tilanta', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(305, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.08', 'Piutang Arini', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(306, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.07.09', 'Piutang Cahaya Nusa Sejahtera', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(307, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '110.302.00', 'Account Receivable Euro', 0, '1', NULL, NULL, '1', NULL, 'Account Receivable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(308, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1.201.02', 'Akumulasi Penyusutan', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(309, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1101.01.06', 'Beban amortisasi Aktiva Tidak berwujud', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(310, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.02', 'Akumulasi Penyusutan Gedung', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(311, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.03', 'Ak. Peny Peralatan Operasional', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(312, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.04', 'Ak. Peny Peralatan Kantor & Mebel', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(313, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.05', 'Ak. Peny Kendaraan', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(314, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.06', 'Akumulasi Penyusutan ACT', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(315, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.07', 'Ak. Peny Peralatan ESQ Store & VT', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(316, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1201.02.08', 'Akumulasi Penyusutan Peralatan ESQ Store & VT', 0, '1', NULL, NULL, '1', NULL, 'Accumulated Depreciation', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(317, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.01', 'Hutang Usaha ', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(318, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.01.02', 'Hutang Pengadaan Aset', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(319, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.01.29', 'Hutang Usaha', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(320, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.08.01', 'Hutang Lancar Lainnya', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(321, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.08.02', 'Hutang ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(322, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.08.03', 'Hutang Usaha ESQ Media', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(323, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.08.04', 'Hutang Usaha ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(324, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.08.05', 'Hutang Usaha Virtual Training', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(325, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.01', 'Hutang Antar Grup Arga', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(326, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.01', 'Hutang Arga ESQ Semesta Tour', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(327, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.02', 'Hutang Arga Nusa Persada', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(328, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.03', 'Hutang Fajrul Ikhsan Wisata', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(329, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.04', 'Hutang Menara Citra Bahagia', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(330, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.05', 'Hutang Yayasan Ary Ginanjar Agustian', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(331, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.06', 'Hutang EBS Global Nutrisarana', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(332, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.07', 'Hutang Bayu Pratama International', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(333, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.08', 'Hutang Griya Bangun Persada', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(334, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.09', 'Hutang LSP Trainer Indonesia', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(335, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.10', 'Hutang Arga Telematika Solusi', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(336, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.11', 'Hutang Arga Tilanta', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(337, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.12', 'Hutang Imaji Menara Produksi', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(338, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.13', 'Hutang Yayasan Arga Bangun Indonesia', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(339, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.010.14', 'Hutang ESQ Malaysia', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(340, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.02', 'Pendapatan Diterima Di Muka ', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(341, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.01', 'Pend. Diterima Di Muka Public DKI', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(342, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.02', 'Pend. Diterima Di Muka IH DKI', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(343, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.03.', 'Pendapatan Diterima Dimuka (Sponsor Milad)', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(344, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04', 'Pendapatan Diterima dimuka Cabang', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(345, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM BALI', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(346, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM BALIKPAPAN', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(347, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM BANDUNG', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(348, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM SEMARANG', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(349, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM SURABAYA', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(350, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM RIAU', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(351, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM PALEMBANG', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(352, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM MAKASAR', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(353, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM PADANG', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(354, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.04.', 'PDM MEDAN', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(355, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.02.05', 'Pendapatan diTerima dimuka', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(356, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.03', 'Hutang Non Usaha', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(357, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.03.02', 'Hutang lain-lain', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(358, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.03.03', 'Hutang Zakat', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(359, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.03.04', 'Hutang Antar Group ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(360, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.04', 'Hutang Deviden', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(361, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.05', 'Biaya yang Masih Harus Dibayar', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(362, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.05.01', 'Gaji Yang Masih Harus Dibayar ', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(363, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.05.03', 'Hutang Yang Masih Harus Dibayar', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(364, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.05.03.', 'Hutang yang Masih Harus dibayar ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(365, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.07', 'Barang belum tertagih', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(366, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.13', 'Barang Belum Tertagih ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(367, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.06', 'Hutang Pajak', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(368, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.03.01', 'Hutang Antar Group Arga', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(369, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.01', 'PPN Keluaran', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(370, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.02', 'Hutang PPh 21', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(371, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.04', 'Hutang PPh 23', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(372, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.06', 'Hutang PPh 25', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(373, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.07', 'Hutang PPh 29', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(374, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.08', 'Hutang PPh Pasal 4 ayat 2', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(375, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.06.09', 'Hutang Pph 26', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(376, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.08.100', 'Akun Perantara Hutang Antar Grup Arga', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(377, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.09', 'Uang Muka Penjualan Public LC', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(378, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.10.08', 'UM Penjualan Training', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(379, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.09.01', 'UM Penjualan Public Training', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(380, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.10.01', 'UM Penjualan In House', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(381, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.11.01', 'UM Penjualan Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(382, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.10.12', 'Deposit Lain-Lain', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(383, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2101.11.02', 'Uang Muka Penjualan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(384, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.12', 'Akun Perantara Hutang', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(385, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.101.99', 'Hutang Lancar Lainnya', 0, '1', NULL, NULL, '1', NULL, 'Other Current Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(386, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '210.101.00', 'Account Payable US Dollar', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(387, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '210.102.00', 'Account Payable Euro', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(388, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '210.103.00', 'Account Payable Ringgit Malaysia', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(389, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '210.104.00', 'Account Payable Dollar Singapura', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(390, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '210.105.00', 'Account Payable Brunei', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(391, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '210.202.00', 'Advance Sales Brunei', 0, '1', NULL, NULL, '1', NULL, 'Account Payable', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(392, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.201.00', 'Hutang Jangka Panjang', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(393, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.201.01', 'Hutang Bank ', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(394, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.201.02', 'Hutang Leasing ', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(395, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.201.03', 'Hutang Investasi', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(396, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.201.99', 'Hutang Jangka Panjang Lainnya ', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(397, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.01', 'Hutang kpd Pemegang Saham', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(398, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.03', 'Hutang Imbalan Pasca Kerja ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(399, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.04', 'Hutang kpd Pemegang Saham VT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(400, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.05', 'Hutang kpd Pemegang Saham BBC', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(401, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.06', 'Hutang Non Usaha Pihak Berelasi', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(402, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.01', 'Hutang Non Usaha Pihak Berelasi - Arga ESQ Semesta Tour, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(403, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.02', 'Hutang Non Usaha Pihak Berelasi - Arga Nusa Persada, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(404, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.03', 'Hutang Non Usaha Pihak Berelasi - Arga Pilar, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(405, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.04', 'Hutang Non Usaha Pihak Berelasi - Arga Telematika Solusi, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(406, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.05', 'Hutang Non Usaha Pihak Berelasi - Arga Tilanta, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(407, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.06', 'Hutang Non Usaha Pihak Berelasi - EBS Global Nutrisarana, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(408, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.07', 'Hutang Non Usaha Pihak Berelasi - YAGA', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(409, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.08', 'Hutang Non Usaha Pihak Berelasi - Fajrul Ikhsan Wisata, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(410, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.09', 'Hutang Non Usaha Pihak Berelasi - Griya Bangun Persada, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(411, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.10', 'Hutang Non Usaha Pihak Berelasi - Imaji Menara Produksi, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(412, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.11', 'Hutang Non Usaha Pihak Berelasi - LSP Trainer Indonesia, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(413, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.12', 'Hutang Non Usaha Pihak Berelasi - YABI', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(414, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.13', 'Hutang Non Usaha Pihak Berelasi - Arga Budi Multimedia, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(415, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.14', 'Hutang Non Usaha Pihak Berelasi - Arga Cipta Grande, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(416, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.15', 'Hutang Non Usaha Pihak Berelasi - Menara Cipta Bahagia, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(417, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.16', 'Hutang Non Usaha Pihak Berelasi - Bayu Pratama Int, PT', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(418, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.17', 'Hutang Non Usaha Pihak Berelasi ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(419, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2202.06.18', 'Hutang Non Usaha Pihak Berelasi - ESQ Malaysia', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(420, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.02', 'Hutang Imbalan Pasca Kerja', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(421, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2.202.07', 'Uang Muka Penjualan Amazing You 2020', 0, '1', NULL, NULL, '1', NULL, 'Long Term Liability', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(422, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.000.00', 'Ekuitas Perusahaan', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(423, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.001.00', 'Modal Usaha', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(424, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.001.01', 'Modal Disetor ', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(425, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.001.02', 'Modal Disetor ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(426, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.002.00', 'Laba Ditahan', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(427, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.002.01', 'Laba Ditahan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(428, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '3.004.00', 'Prive', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(429, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '310.001.00', 'OPENING BALANCE EQUITY', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(430, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '320.002.00', 'RE - OCI', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(431, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '330.003.00', 'RE - OCI ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Equity', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(432, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.00', 'Pendapatan Usaha', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(433, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.01', 'Pendapatan Public training', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(434, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.01', 'Pend. Public Eks', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(435, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.02', 'Pend. Public Profesional', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(436, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.03', 'Pend. Public Reguler', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(437, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.04', 'Pend. Public Teens', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(438, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.05', 'Pendapatan Mahasiswa', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(439, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.06', 'Pend. Public Kids', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(440, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.09', 'Pend. Public MS-CB', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(441, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.11', 'Pend Public Indonesia Emas', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(442, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.12', 'Pend Public MCB Teens', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(443, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.13', 'Pend Public Spriritual Parenting', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(444, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.14', 'Pend Public MSKN', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(445, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.15', 'Pend. Public MCB 3G', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(446, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.16', 'Pend. Public SCC', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(447, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.17', 'Pend. Public MCB Kids', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(448, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.18', 'Pend. Public SCC 3G', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(449, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.19', 'Pend. Public Service From Heart', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(450, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.20', 'Pend. Public Communication From Heart', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(451, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.21', 'Pend. Public Leadership From Heart', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(452, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.22', 'Pend. Public Total Action', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(453, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.23', 'Pendapatan Public', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(454, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.24', 'Pendapatan MPP Publik', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(455, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.25', 'Pendapatan Training Publik Online - New Chapter', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(456, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.26', 'Pendapatan Training Publik Online -Teens', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(457, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.01.27', 'Pendapatan Training Online Publik', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(458, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.01', 'Pend. Public LCT Workshop', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(459, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.02', 'Pendapatan Inhouse Training', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(460, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.01', 'Pend. IH Eksekutif', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(461, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.03', 'Pend. IH Reguler', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(462, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.04', 'Pend. IH Teens ', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(463, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.05', 'Pend. IH Mahasiswa', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(464, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.06', 'Pend. IH Kids', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(465, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.09', 'Pend. IH MS-CB', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(466, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.11', 'Pend. IH Spiritual Parenting', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(467, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.16', 'PEND IH TOTAL ACTION', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(468, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.02.17', 'Masa Persiapan Pensiun', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(469, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.03', 'PTP Basic (REGULER,PROF)', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(470, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.03.01', 'Pendapatan Digital Training', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(471, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.03.02', 'Pendapatan DgTraining', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(472, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.03.1', 'PTP Basic (REGULER,PROF)', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(473, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.04', 'Pendapatan Outbond', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(474, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.15', 'Integrity Values In House', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(475, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.16', 'Pend Communication From Heart IH', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(476, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.10', 'Product Non PC', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(477, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.05', 'Pendapatan ACT', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(478, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.03', 'Awareness Culture Transformation', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(479, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.04', 'MVVM + LCT Workshop', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(480, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.05', 'Value Based Leadership Workshop', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(481, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.06', 'Assesment Baretts', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(482, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.07', 'Assessment Harisson', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(483, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.08', 'Organisation Culture Health Index', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(484, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.09', 'Visitasi & Konsultasi', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(485, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.1', 'Delta Soft Sklill', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(486, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.10', 'Service From Heart (ACT)', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(487, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.11', 'Values Exploration Session (VES/FGD)', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(488, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.12', 'Leadership From Heart', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(489, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.13', 'Team Dynamic', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(490, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.14', 'Values Internalization', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(491, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.17', 'ACCIVMENT MOTIVATION TRAINING', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(492, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.18', 'Lead Self Lead Other', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(493, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.19', 'AGENT OF CHANGE', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(494, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.20', 'Pendapatan Coaching', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(495, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.22', 'Pendapatan Assessment', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(496, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.24', 'Pendapatan Customized', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(497, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.06.01', 'Pendapatan Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(498, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.06.01.', 'Pendapatan Tiket Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(499, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.06.01.', 'Pendapatan Sponsorship Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(500, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.06.01.', 'Pendapatan Booth Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(501, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.06.01.', 'Pendapatan Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(502, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.07', 'Pend. Manasik', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(503, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.11', 'Pendapatan LSP ESQ', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(504, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.21', 'Pendapatan TOT', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(505, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.05.23', 'Pendapatan Culture Specialist', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(506, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.12', 'Pendapatan Usaha Lainnya', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(507, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.12.01', 'Pendapatan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(508, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.12.02', 'Potongan Penjualan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(509, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.12.03', 'Retur Penjualan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(510, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4001.12.04', 'Pendapatan ESQ World', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(511, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '410.103.00', 'Sales Term Discount ', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(512, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '4.001.13', 'Pendapatan Dgworld', 0, '1', NULL, NULL, '1', NULL, 'Revenue', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(513, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.10', 'HPP', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(514, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.10.10', 'HPP Training', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(515, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.01', 'HPP Sewa Hotel', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(516, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.02', 'HPP Sewa Gedung & Ruang', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(517, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.03', 'HPP Catering & Konsumsi', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(518, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.07', 'HPP Peralatan Training', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(519, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.08', 'HPP Perjalanan Dinas Training', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(520, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.11', 'HPP Training Kit', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(521, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.12', 'HPP Biaya Training Lain', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(522, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.16', 'HPP Sewa Kamar HTL', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(523, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.18', 'HPP Pengiriman Training Kit', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(524, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.19', 'HPP Seminar', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(525, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.20', 'HPP Network', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(526, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.21', 'HPP Fee Trainer Partner', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(527, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.01.22', 'HPP Transportasi Peserta', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(528, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.02', 'HPP Gathering', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(529, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.03', 'HPP Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(530, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.01', 'HPP Hotel Package Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(531, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.03', 'HPP Catering & Konsumsi Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(532, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.04', 'HPP Peralatan Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(533, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.05', 'HPP Biaya Lain Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(534, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.06', 'HPP Training Kit Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(535, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.07', 'HPP Kamar Hotel Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(536, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.03.08', 'HPP Lahan Outbound', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(537, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.04', 'HPP ACT', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);
INSERT INTO `mnoakun` (`idakun`, `noakuntop`, `tipe`, `noakunheader`, `jenis`, `objek`, `rincian`, `noakun`, `akunno`, `namaakun`, `saldo`, `stheader`, `stdebet`, `stbayar`, `stkunci`, `stdefault`, `kategoriakun`, `sthapus`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(538, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.01', 'HPP ACT Sewa Hotel', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(539, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.03', 'HPP ACT Sewa Gedung & Ruang', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(540, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.04', 'HPP ACT Catering & Konsumsi ', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(541, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.05', 'HPP ACT Peralatan', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(542, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.06', 'HPP ACT Perjalanan Dinas', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(543, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.07', 'HPP ACT Training Kit', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(544, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.08', 'HPP ACT Biaya Training Lain', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(545, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.09', 'HPP ACT Sewa Kamar Hotel ', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(546, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.04.10', 'HPP ACT Pengiriman Training Kit', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(547, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.05', 'HPP Kartu Alumni', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(548, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.06', 'HPP Manasik', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(549, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01', 'HPP Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(550, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Sewa Gedung & Ruang Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(551, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Catering & Konsumsi Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(552, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Training Kit Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(553, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Peralatan Training Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(554, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Sewa Kamar Hotel Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(555, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Biaya Training Lain Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(556, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.06.01.', 'HPP Perjalanan Dinas Training Amazing You', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(557, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.09', 'HPP Usaha Lainnya', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(558, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.001.10', 'HPP Dgworld', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(559, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.10.01', 'HPP Dgworld KA', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(560, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.10.02', 'HPP Dgworld Donasi', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(561, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5001.10.03', 'HPP Dgworld Lain-Lain', 0, '1', NULL, NULL, '1', NULL, 'Cost of Goods Sold', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(562, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.20', 'Biaya Operasional', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(563, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.20.20', 'Biaya Administrasi dan Umum', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(564, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.082', 'Meal Allowance', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(565, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.083', 'Meeting Expence', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(566, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.09', 'Kep. Rt Kantor', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(567, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.10', 'Suplai Alat Tulis Kantor', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(568, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.13', 'Biaya Pengiriman Barang', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(569, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.14', 'Biaya Telepon', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(570, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.15', 'Biaya Internet Website', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(571, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.16', 'Biaya Listrik', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(572, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.161', 'Air', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(573, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.17', 'Materai & Perangko', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(574, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.18', 'Pemeliharaan Alat Kantor', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(575, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.19', 'Pemeliharaan Gedung', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(576, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.191', 'Pemeliharaan Taman', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(577, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.20', 'Pemeliharaan Kendaraan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(578, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.22', 'Retribusi Lingkungan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(579, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.23', 'Perizinan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(580, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.24', 'Jasa Konsultan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(581, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.25', 'Biaya Asuransi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(582, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.26', 'Suplai Alat Kerja', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(583, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.27', 'Biaya Administrasi Kantor lain-lain', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(584, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.271', 'Biaya Operasional Pembinaan Alumni', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(585, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.273', 'Pre Sales Incentiv Consulting', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(586, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.274', 'Project Cost Incentiv Consulting', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(587, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.275', 'Biaya Perlengkapan Training', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(588, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.277', 'Biaya R&D', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(589, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.279', 'Freelance', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(590, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.28', 'Biaya Penyusutan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(591, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.28.', 'Biaya Peny Gedung', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(592, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.28.', 'Biaya Peny Peralatan Operasional', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(593, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.28.', 'Biaya Peny  Peralatan Kantor & Mebel', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(594, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.28.', 'Biaya Peny Kendaraan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(595, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.28.', 'Biaya Peny ACT', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(596, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.281', 'Perjalanan Dinas Regional Indonesia Barat', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(597, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.282', 'Perjalanan Dinas Regional Indonesia Timur', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(598, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.283', 'Perjalanan Dinas Regional Jawa', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(599, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.284', 'Beban Pajak', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(600, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.286', 'Biaya Cetakan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(601, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.287', 'Biaya Kegiatan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(602, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.288', 'Biaya Pesangon', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(603, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.289', 'Transportasi Harian Non Marketing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(604, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.29.', 'Biaya Amortisasi Hak Paten', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(605, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.29.', 'Biaya Amortisasi Lisensi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(606, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.290', 'Sewa Gedung', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(607, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.290', 'Sewa Kantor', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(608, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.290', 'Sewa Kendaraan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(609, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.290', 'Sewa Peralatan Kantor', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(610, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.290', 'Sewa Rumah', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(611, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.291', 'Beban Penghapusan Persediaan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(612, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.30', 'Biaya Peny Piutang Tak Tertagih', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(613, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.31', 'Biaya Pengembangan Modul ', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(614, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.35', 'Biaya Rekrutmen Karyawan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(615, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.36', 'Biaya ESQ Digi World', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(616, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.37', 'Biaya Pajak Dgworld', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(617, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.38', 'Biaya ESQ Dgworld', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(618, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.39', 'Biaya Zoom Meeting', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(619, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.40', 'Biaya E-Commerce', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(620, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.41', 'Biaya Auto Blast Email', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(621, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.42', 'Biaya Apresiasi - Dgworld Corporate', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(622, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan perjalanan dinas', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(623, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Kamar hotel perjalanan dinas', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(624, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tiket perjalanan dinas', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(625, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan Perjalanan Dinas (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(626, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan Kamar Hotel (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(627, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tiket Perjalanan Dina (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(628, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6.001.01', 'Biaya Penjualan & Pemasaran', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(629, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01', 'Biaya Iklan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(630, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01.', 'Iklan Surat Kabar', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(631, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01.', 'Iklan Majalah,Tabloid', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(632, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01.', 'Iklan Media TV', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(633, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01.', 'Iklan Media Radio', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(634, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01.', 'Iklan Website Online', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(635, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.01.', 'Media Iklan Lainnya', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(636, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04', 'By Promosi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(637, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Proposal,Company Profile,Map', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(638, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Spanduk,Baliho,Standing Banner', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(639, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Leaflet,Brosur,Poster,Flyer', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(640, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Kartu Nama,Media Promosi Diri', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(641, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'SMS Broadcast', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(642, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Stand Booth', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(643, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Biaya Promo Lainnya', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(644, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Free Gift', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(645, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.04.', 'Biaya Digital Marketing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(646, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.05', 'Biaya Operasional Pemasaran', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(647, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.05.', 'Biaya Kendaraan Marketing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(648, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.05.', 'Transportasi Harian Marketing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(649, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.01.05.', 'Tiket Pesawat Marketing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(650, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.30', 'Biaya Sumber daya Manusia', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(651, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '5.30.1', 'Pegawai Tetap', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(652, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.01', 'Gaji Pokok', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(653, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.01a', 'Share Management', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(654, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02', 'Kompensasi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(655, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Apresiasi Marketing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(656, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Bonus Karyawan (Cash)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(657, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Bonus Karyawan (Non Cash)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(658, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Penghargaaan karyawan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(659, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Fee Training', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(660, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Apresiasi Penjualan Bundling', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(661, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03', 'Benefit', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(662, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.07', 'Biaya Peningkatan SDM', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(663, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.276', 'Jasa Outsorcing', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(664, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.33', 'Biaya Security', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(665, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Apresiasi Training', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(666, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan Keahlian', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(667, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Special Assignment Allowance', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(668, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan kepindahan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(669, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Lembur', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(670, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan Hari Raya', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(671, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan komunikasi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(672, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Santunan Kematian', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(673, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Santunan Kelahiran', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(674, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Santunan Pernikahan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(675, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Santunan Musibah', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(676, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan Non Asuransi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(677, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Klaim kesehatan Gigi - Non Direksi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(678, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Klaim Kacamata - Non Direksi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(679, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Klaim Melahirkan - Non Direksi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(680, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan Kesehatan - Direksi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(681, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Jamsostek', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(682, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tax Allowance (ppH 21)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(683, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Tunjangan Kehadiran', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(684, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Santunan Kesehatan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(685, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.03.', 'Biaya Tes Kesehatan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(686, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6.002.03', 'Personal Allowence', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(687, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6001.02.02', 'Biaya Tunjangan Kesejahteraan', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(688, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6.002.02', 'Pegawai tidak tetap', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(689, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.01', 'Gaji pokok (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(690, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.02', 'Kompensasi (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(691, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.02.', 'Apresiasi Marketing (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(692, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.02.', 'Bonus Karyawan (Cash NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(693, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.02.', 'Bonus Karyawan (Non Cash NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(694, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.02.', 'Apresiasi kinerja terbaik (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(695, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03', 'Benefit (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(696, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.01.02.', 'Santunan Kesehatan (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(697, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan Keahlian (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(698, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Special Assignment Allowance (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(699, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan kepindahan (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(700, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Lembur (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(701, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan Hari Raya (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(702, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan Komunikasi (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(703, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Santunan Kematian (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(704, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Santunan Kelahiran (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(705, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Santunan Pernikahan (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(706, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Santunan Musibah (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(707, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Klaim Kesehatan Non Asuransi', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(708, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Klaim Kesehatan gigi - Non Direksi (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(709, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Klaim kesehatan Kacamata - Non Direksi (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(710, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Klaim Kesehatan Kelahiran - Non Direksi (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(711, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Jamsostek (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(712, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6002.02.03.', 'Tunjangan Kehadiran (NP)', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(713, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '6.002.04', 'Imbalan Pascakerja', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(714, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.00', 'Pendapatan Lain', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(715, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.01', 'Pendapatan Bunga', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(716, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.02', 'Laba/Rugi Penjualan Aktiva Tetap', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(717, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.03', 'Laba/Rugi Revaluasi Aktiva Tetap', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(718, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.04', 'Pendapatan ESQ Media', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(719, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.06', 'Sponsorship', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(720, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.07', 'Pendapatan Lain-Lain', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(721, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.08', 'Pendapatan Comprehensive', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(722, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.09', 'Share Unit Usaha ESQ Grup', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(723, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.10', 'Presentasi & Seminar', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(724, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.11', 'ESQ REMINDER', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(725, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.13', 'Pendapatan sewa LCD,Layar dan Sound System', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(726, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.14', 'Pendapatan Data Center', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(727, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.15', 'Pendapatan ESQ STORE', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(728, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.16', 'Potongan Penjualan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(729, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.17', 'Pendapatan Minoritas', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(730, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.18', 'Manfaat Pajak Tangguhan', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(731, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.19', 'Pendapatan RBT', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(732, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.20', 'Retur Penjualan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(733, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.21', 'Pendapatan Lain-Lain ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(734, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.22', 'Pendapatan Bunga ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(735, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.23', 'Pendapatan Royalty Arga Group', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(736, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.24', 'Pendapatan Atas Koreksi Pembukuan', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(737, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.25', 'Pendapatan RBT', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(738, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.26', 'Sponsorship Milad', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(739, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.27', 'Bagi Hasil Bank Syariah', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(740, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.28', 'Penerimaan Zakat', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(741, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.29', 'Bagi Hasil Bank Syariah ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(742, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7.001.30', 'Pendapatan Komprehensif Lain', 0, '1', NULL, NULL, '1', NULL, 'Other Income', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(743, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.00', 'Biaya Lain', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(744, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.01', 'Biaya Adm Bank', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(745, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001.01.01', 'Biaya Bunga', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(746, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001.01.02', 'Biaya Non Operasional', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(747, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.02', 'Penghapusan Aktiva', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(748, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.03', 'Koreksi Pembukuan', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(749, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.04', 'Tax Corporate', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(750, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001.05.01', 'Selisih Kurs IDR', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(751, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001.05.02', 'Realisasi Laba (Rugi) USD', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(752, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001.05.03', 'Laba (Rugi) Belum Direalisasi IDR', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(753, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8001.05.04', 'Laba (Rugi) Belum Direalisasi USD', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(754, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.06', 'Zakat, infaq & Shodaqah', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(755, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.07', 'Manfaat Pajak tangguhan', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(756, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.08', 'Biaya Sponsorship', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(757, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.10', 'Biaya Manfaat', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(758, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.11', 'Biaya Presentasi & Seminar', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(759, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.12', 'Biaya Kartu Alumni', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(760, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.13', 'Biaya Data Center', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(761, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.14', 'Jasa Event QX', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(762, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.15', 'Kerugian Investasi Unit Usaha', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(763, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.16', 'Jasa Event MPP', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(764, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.18', 'Rugi Komprehensif', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(765, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.19', 'Biaya Lain-Lain', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(766, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.20', 'Biaya Administrasi Pajak', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(767, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.21', 'Beban Lain-Lain ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(768, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.22', 'Biaya Milad', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(769, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.23', 'Biaya Pajak Bunga Bank', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(770, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.24', 'Biaya Rekening Pasif', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(771, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.25', 'Biaya Pajak Bagi Hasil Bank Syariah', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(772, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.26', 'Beban Pajak Penghasilan', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(773, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.004.00', 'Biaya ESQ Media', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(774, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.005.00', 'Biaya Langsung ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(775, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.006.00', 'Biaya Tidak Langsung ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(776, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.007.00', 'Biaya Administrasi Bank ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(777, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.008.00', 'Biaya Pajak Bunga Bank ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(778, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.009.00', 'Biaya Pajak Bagi Hasil Bank Syariah ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(779, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.010.00', 'Biaya Tidak Langsung ESQ Virtual Training', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(780, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.011.00', 'Koreksi Pembukuan ESQ Store', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(781, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '910.001.00', 'Realize Gain or Loss (Exchange)', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(782, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.17', 'Biaya Pengembangan Modul', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(783, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8.001.27', 'Ujroh Pembiayaan', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(784, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '9.003.00', 'Akun Pengadaan Asset', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(785, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '910.002.00', 'Unrealize Gain or Loss (Exchange)', 0, '1', NULL, NULL, '1', NULL, 'Other Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(786, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '910.003.00', 'Realize Gain or Loss Brunei', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(787, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '910.004.00', 'Unrealize Gain or Loss Brunei', 0, '1', NULL, NULL, '1', NULL, 'Expense', '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(788, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(789, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(790, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(791, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(792, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(793, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(794, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(795, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(796, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(797, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(798, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(799, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(800, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(801, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(802, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1', NULL, NULL, '1', NULL, NULL, '0', '0', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mnoakunpengaturan`
--

CREATE TABLE `mnoakunpengaturan` (
  `id` int(11) NOT NULL,
  `tipe` char(1) NOT NULL,
  `katakunci` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `noakun` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mnoakunpengaturan`
--

INSERT INTO `mnoakunpengaturan` (`id`, `tipe`, `katakunci`, `nama`, `noakun`) VALUES
(1, '1', 'piutang_belum_ditagih', 'Piutang Belum Ditagih', '1212'),
(2, '1', 'pembayaran_di_muka', 'Pembayaran di Muka', '2211'),
(3, '1', 'pajak_penjualan', 'Pajak Penjualan', '2212'),
(4, '1', 'pendapatan_penjualan', 'Pendapatan Penjualan', '4111'),
(5, '1', 'diskon_penjualan', 'Diskon Penjualan', '4112'),
(6, '1', 'retur_penjualan', 'Retur Penjualan', '4113'),
(7, '1', 'penjualan_belum_ditagih', 'Pendapatan Belum Ditagih', '4114'),
(8, '1', 'pengiriman_penjualan', 'Pengiriman Penjualan', '421'),
(9, '2', 'uang_muka_pembelian', 'Uang Muka Pembelian', '1411'),
(10, '2', 'pajak_pembelian', 'Pajak Pembelian', '1412'),
(11, '2', 'hutang_belum_ditagih', 'Hutang Belum Ditagih', '2112'),
(12, '2', 'pengiriman_pembelian', 'Pengiriman Pembelian', '5112'),
(13, '2', 'pembelian', 'Pembelian', '5114'),
(14, '3', 'piutang_usaha', 'Piutang Usaha', '1211'),
(15, '3', 'hutang_usaha', 'Hutang Usaha', '2111'),
(16, '4', 'persediaan', 'Persediaan', '1311'),
(17, '4', 'persediaan_produksi', 'Persediaan Produksi', '5113'),
(18, '4', 'persediaan_rusak', 'Persediaan Rusak', '5211'),
(19, '4', 'persediaan_umum', 'Persediaan Umum', '5311'),
(20, '5', 'aset_tetap', 'Aset Tetap', '1511'),
(21, '5', 'ekuitas_saldo_awal', 'Ekuitas Saldo Awal', '3111');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mpajak`
--

CREATE TABLE `mpajak` (
  `id_pajak` varchar(191) NOT NULL,
  `kode_pajak` varchar(191) NOT NULL,
  `nama_pajak` varchar(191) NOT NULL,
  `akun` varchar(191) NOT NULL,
  `persen` varchar(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mpajak`
--

INSERT INTO `mpajak` (`id_pajak`, `kode_pajak`, `nama_pajak`, `akun`, `persen`) VALUES
('PJK5f71310f94513', 'Ppn', 'Ppn 10%', '20', '0'),
('PJK5f713a2830fa0', 'Pph 21', 'PPh 21', '24', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mpengaturan`
--

CREATE TABLE `mpengaturan` (
  `id` int(11) NOT NULL,
  `kode` varchar(255) DEFAULT NULL,
  `deskripsi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `mpengaturan`
--

INSERT INTO `mpengaturan` (`id`, `kode`, `deskripsi`) VALUES
(1, 'language', 'ID'),
(2, 'app_name', 'Akuntansi Sederhana'),
(3, 'logo_login', 'logo_login.png'),
(4, 'logo', 'logo.png'),
(5, 'template', 'bg-blue'),
(6, 'instansi', 'CV. BINTANG TEKNOLOGI'),
(7, 'alamat_instansi', 'Jl Genteng No. 5 Banjarang - Majalengka 45468');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mperusahaan`
--

CREATE TABLE `mperusahaan` (
  `idperusahaan` int(11) NOT NULL,
  `kode` varchar(11) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `direktur` varchar(200) NOT NULL,
  `stdel` char(1) DEFAULT '0',
  `uby` varchar(100) NOT NULL,
  `udate` datetime NOT NULL,
  `cby` varchar(100) NOT NULL,
  `cdate` datetime NOT NULL,
  `dby` varchar(100) NOT NULL,
  `ddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mperusahaan`
--

INSERT INTO `mperusahaan` (`idperusahaan`, `kode`, `nama_perusahaan`, `direktur`, `stdel`, `uby`, `udate`, `cby`, `cdate`, `dby`, `ddate`) VALUES
(6, '01', 'PT Arga Bangun Bangsa', '', '0', '', '0000-00-00 00:00:00', 'admin123', '2020-08-13 11:32:36', '', '0000-00-00 00:00:00'),
(7, '02', 'PT Fazrul Insan Wisata', '', '0', 'admin123', '2020-08-13 13:22:05', 'admin123', '2020-08-13 11:32:53', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `mrekening`
--

CREATE TABLE `mrekening` (
  `id` int(11) NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `nama` varchar(25) NOT NULL,
  `norek` varchar(45) NOT NULL,
  `akunno` varchar(20) NOT NULL,
  `stdel` char(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mrekening`
--

INSERT INTO `mrekening` (`id`, `perusahaan`, `nama`, `norek`, `akunno`, `stdel`) VALUES
(1, 6, 'makan', '09897654', '9877', '1'),
(2, 7, 'bca', '123123', '11010103', '0'),
(3, 7, 'okok', '11.11.11.11.1', '110104', '1'),
(4, 6, 'hkhjk', 'hjkhjk', '110104', '1'),
(5, 6, 'Persediaan Barang Daganga', '1234543', '1710101', '1'),
(6, 6, 'Bank Mandiri', '19191919191', '11010102', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `msatuan`
--

CREATE TABLE `msatuan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `dby` varchar(100) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `msatuan`
--

INSERT INTO `msatuan` (`id`, `nama`, `stdel`, `uby`, `udate`, `cby`, `cdate`, `dby`, `ddate`) VALUES
(1, 'Biji', '0', 'admin', '2019-08-27 17:00:50', NULL, NULL, NULL, NULL),
(2, 'Unit', '0', NULL, NULL, 'admin', '2019-08-27 13:44:56', NULL, NULL),
(3, 'Kg', '0', NULL, NULL, 'admin', '2019-08-30 12:43:23', NULL, NULL),
(4, 'Rim', '0', NULL, NULL, 'admin', '2020-09-08 07:59:21', NULL, NULL),
(5, 'OB', '0', NULL, NULL, 'admin', '2020-09-08 07:59:29', NULL, NULL),
(6, 'OH', '0', NULL, NULL, 'admin', '2020-09-08 07:59:37', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `mtahun`
--

CREATE TABLE `mtahun` (
  `id` int(11) NOT NULL,
  `tahun` year(4) NOT NULL,
  `keterangan` varchar(100) NOT NULL,
  `status` char(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `mtahun`
--

INSERT INTO `mtahun` (`id`, `tahun`, `keterangan`, `status`) VALUES
(3, 2020, 'Tahun Anggaran 2020', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggaranbelanja`
--

CREATE TABLE `tanggaranbelanja` (
  `id` varchar(191) NOT NULL,
  `idperusahaan` int(11) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `pejabat` varchar(255) NOT NULL,
  `thnanggaran` year(4) NOT NULL,
  `tglpengajuan` varchar(255) NOT NULL,
  `nominal` decimal(65,0) DEFAULT NULL,
  `koderekening` varchar(100) DEFAULT NULL,
  `uraian` varchar(200) DEFAULT NULL,
  `volume` decimal(10,0) DEFAULT NULL,
  `satuan` varchar(50) DEFAULT NULL,
  `tarif` decimal(10,0) DEFAULT NULL,
  `jumlah` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(200) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Validate',
  `uby` varchar(255) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(255) NOT NULL,
  `cdate` datetime NOT NULL,
  `stdel` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggaranbelanja`
--

INSERT INTO `tanggaranbelanja` (`id`, `idperusahaan`, `dept`, `pejabat`, `thnanggaran`, `tglpengajuan`, `nominal`, `koderekening`, `uraian`, `volume`, `satuan`, `tarif`, `jumlah`, `keterangan`, `status`, `uby`, `udate`, `cby`, `cdate`, `stdel`) VALUES
('AB5f79e98a9a8ce', 6, 'keuangan', 'adi', 2020, '2020-10-04', 2800000, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Validate', NULL, NULL, 'admin', '2020-10-04 22:26:02', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggaranbelanjadetail`
--

CREATE TABLE `tanggaranbelanjadetail` (
  `id` varchar(191) NOT NULL,
  `idanggaran` varchar(191) NOT NULL,
  `koderekening` varchar(255) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `volume` decimal(11,0) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `tarif` decimal(65,0) NOT NULL,
  `jumlah` decimal(65,0) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` int(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggaranbelanjadetail`
--

INSERT INTO `tanggaranbelanjadetail` (`id`, `idanggaran`, `koderekening`, `uraian`, `volume`, `satuan`, `tarif`, `jumlah`, `keterangan`, `status`) VALUES
('ABD5f79e98aceb69', 'AB5f79e98a9a8ce', '11010201', '1', 2, 'Biji', 0, 2000000, '', 0),
('ABD5f79e98ae173c', 'AB5f79e98a9a8ce', '1101', '9', 100, 'Biji', 0, 300000, '', 0),
('ABD5f79e98aecb18', 'AB5f79e98a9a8ce', '11010102', '8', 1000, 'Biji', 0, 500000, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggaranpendapatan`
--

CREATE TABLE `tanggaranpendapatan` (
  `id` int(11) NOT NULL,
  `idperusahaan` int(11) NOT NULL,
  `dept` varchar(255) NOT NULL,
  `pejabat` varchar(255) NOT NULL,
  `thnanggaran` year(4) NOT NULL,
  `tglpengajuan` varchar(255) NOT NULL,
  `nominal` decimal(65,0) NOT NULL,
  `status` varchar(255) NOT NULL,
  `uby` varchar(255) NOT NULL,
  `udate` datetime NOT NULL,
  `cby` varchar(255) NOT NULL,
  `cdate` datetime NOT NULL,
  `stdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggaranpendapatan`
--

INSERT INTO `tanggaranpendapatan` (`id`, `idperusahaan`, `dept`, `pejabat`, `thnanggaran`, `tglpengajuan`, `nominal`, `status`, `uby`, `udate`, `cby`, `cdate`, `stdel`) VALUES
(10, 6, 'keuangan', 'adi', 2020, '2020-08-13', 6000000, '', 'admin', '2020-09-04 10:19:27', 'admin123', '2020-08-13 22:43:45', 1),
(11, 6, 'keuangan', 'adi', 2020, '2020-08-20', 4000000, '', 'admin123', '2020-08-19 12:01:55', 'admin123', '2020-08-19 11:42:59', 1),
(0, 6, 'ok', 'aja', 2020, '2020-09-05', 0, '', '', '0000-00-00 00:00:00', 'admin', '2020-09-05 12:47:47', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanggaranpendapatandetail`
--

CREATE TABLE `tanggaranpendapatandetail` (
  `id` int(11) NOT NULL,
  `idanggaran` int(11) NOT NULL,
  `koderekening` varchar(255) NOT NULL,
  `uraian` varchar(255) NOT NULL,
  `volume` decimal(11,0) NOT NULL,
  `satuan` varchar(20) NOT NULL,
  `tarif` decimal(65,0) NOT NULL,
  `jumlah` decimal(65,0) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tanggaranpendapatandetail`
--

INSERT INTO `tanggaranpendapatandetail` (`id`, `idanggaran`, `koderekening`, `uraian`, `volume`, `satuan`, `tarif`, `jumlah`, `keterangan`, `status`) VALUES
(32, 11, '40010101', 'koko', 4, 'buah', 43, 172, '', 0),
(0, 10, '400101', 'baju', 3, 'buah', 2000000, 6000000, '', 0),
(0, 11, '400100', 'makan malam', 2, 'buah', 2000000, 4000000, '', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tbudgetevent`
--

CREATE TABLE `tbudgetevent` (
  `id` int(11) NOT NULL,
  `idpemesanan` varchar(100) NOT NULL,
  `nokwitansi` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `departemen` int(11) NOT NULL,
  `pejabat` varchar(100) NOT NULL,
  `keterangan` text NOT NULL,
  `nominal` double(10,0) NOT NULL,
  `rekening` int(11) NOT NULL,
  `status` int(11) DEFAULT '0',
  `cby` varchar(50) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tfaktur`
--

CREATE TABLE `tfaktur` (
  `nomor` int(191) NOT NULL,
  `id` varchar(191) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggaltempo` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `perusahaanid` int(191) NOT NULL,
  `pengirimanid` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `biayapengiriman` int(191) NOT NULL,
  `total` int(191) DEFAULT '0',
  `totaldibayar` decimal(10,0) DEFAULT '0',
  `sisatagihan` decimal(10,0) DEFAULT '0',
  `totalretur` decimal(10,0) DEFAULT '0',
  `totaldebetmemo` decimal(10,0) DEFAULT '0',
  `totalkreditmemo` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT '1',
  `carabayar` char(1) DEFAULT '1',
  `bank` varchar(20) DEFAULT NULL,
  `norek` varchar(20) DEFAULT NULL,
  `atasnama` varchar(100) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `statusbayar` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tfaktur`
--

INSERT INTO `tfaktur` (`nomor`, `id`, `notrans`, `tanggal`, `tanggaltempo`, `kontakid`, `gudangid`, `perusahaanid`, `pengirimanid`, `catatan`, `subtotal`, `diskon`, `ppn`, `biayapengiriman`, `total`, `totaldibayar`, `sisatagihan`, `totalretur`, `totaldebetmemo`, `totalkreditmemo`, `tipe`, `carabayar`, `bank`, `norek`, `atasnama`, `status`, `cby`, `cdate`, `statusbayar`) VALUES
(2, 'FAKTUR5f7fd70b97c02', '#INV09OCT0001', '2020-10-09', NULL, 2, NULL, 6, NULL, NULL, 0, 0, 0, 0, 150000, 0, 0, 0, 0, 0, '1', '1', '2', NULL, NULL, '1', NULL, NULL, '0'),
(3, 'FAKTUR5f800f8806210', '#INV09OCT0001', '2020-10-09', NULL, 2, NULL, 6, NULL, NULL, 0, 0, 0, 0, 250000, 0, 0, 0, 0, 0, '1', '1', '6', NULL, NULL, '1', NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tfakturdetail`
--

CREATE TABLE `tfakturdetail` (
  `id` int(191) NOT NULL,
  `idfaktur` varchar(191) NOT NULL,
  `itemid` varchar(191) NOT NULL,
  `idpengiriman` varchar(191) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlahsisa` int(11) DEFAULT '0',
  `jumlahretur` int(11) DEFAULT '0',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` float DEFAULT '0',
  `ppn` float DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tfakturdetail`
--

INSERT INTO `tfakturdetail` (`id`, `idfaktur`, `itemid`, `idpengiriman`, `harga`, `jumlah`, `jumlahsisa`, `jumlahretur`, `subtotal`, `diskon`, `ppn`, `total`, `status`) VALUES
(32, 'FAKTUR5f7fd0a66ee82', 'PEM-DET5f7ecadc8bca1', '2', NULL, NULL, 0, 0, 0, 0, 0, 0, '1'),
(33, 'FAKTUR5f7fd0a66ee82', 'PEM-DET5f7ecadc8c97f', '2', NULL, NULL, 0, 0, 0, 0, 0, 0, '1'),
(34, 'FAKTUR5f7fd70b97c02', 'PEM-DET5f7ecadc8bca1', '2', NULL, NULL, 0, 0, 0, 0, 0, 0, '1'),
(35, 'FAKTUR5f7fd70b97c02', 'PEM-DET5f7ecadc8c97f', '2', NULL, NULL, 0, 0, 0, 0, 0, 0, '1'),
(36, 'FAKTUR5f800f8806210', 'PEM-DET5f800e9446545', '0', NULL, NULL, 0, 0, 0, 0, 0, 0, '1'),
(37, 'FAKTUR5f800f8806210', 'PEM-DET5f800e9447459', '0', NULL, NULL, 0, 0, 0, 0, 0, 0, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tfakturpenjualan`
--

CREATE TABLE `tfakturpenjualan` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `nomorsuratjalan` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggaltempo` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `departemen` int(11) DEFAULT NULL,
  `pengirimanid` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `totaldibayar` decimal(10,0) DEFAULT '0',
  `sisatagihan` decimal(10,0) DEFAULT '0',
  `totalretur` decimal(10,0) DEFAULT '0',
  `totaldebetmemo` decimal(10,0) DEFAULT '0',
  `totalkreditmemo` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT '1',
  `carabayar` varchar(25) DEFAULT NULL,
  `bank` varchar(20) DEFAULT NULL,
  `norek` varchar(20) DEFAULT NULL,
  `atasnama` varchar(100) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `statusbayar` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Trigger `tfakturpenjualan`
--
DELIMITER $$
CREATE TRIGGER `AfterInsertFakturPenjualan` AFTER INSERT ON `tfakturpenjualan` FOR EACH ROW BEGIN

--  insert jurnal umum
IF(new.tipe = '2') THEN
  INSERT INTO tjurnalpenjualan (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Faktur Penjualan ', new.notrans),'1','2',new.id);
END IF;
-- 
INSERT INTO tfakturpenjualandetail (idfaktur, itemid, harga, jumlah, jumlahsisa, subtotal, diskon, ppn, total)
SELECT new.id, itemid, harga, jumlah, jumlah, subtotal, diskon, ppn, total
FROM tpengirimanpenjualandetail WHERE idpengiriman = new.pengirimanid;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeInsertFakturPenjualan` BEFORE INSERT ON `tfakturpenjualan` FOR EACH ROW BEGIN

DECLARE varsubtotal, vardiskon, varppn, vartotal DECIMAL;
DECLARE varpemesananid VARCHAR (100);
DECLARE varkontakid, vargudangid, vardepartemen INT;

IF(new.notrans = '' || new.notrans IS NULL) THEN
  SET new.notrans = generatecodefaktur();
END IF;

SELECT pemesananid, subtotal, diskon, ppn, total, kontakid, gudangid, departemen
INTO varpemesananid, varsubtotal, vardiskon, varppn, vartotal, varkontakid, vargudangid, vardepartemen
FROM tpengirimanpenjualan
WHERE id = new.pengirimanid;

SET new.kontakid = varkontakid;
SET new.gudangid = vargudangid;
SET new.departemen = vardepartemen;
SET new.subtotal = varsubtotal;
SET new.diskon = vardiskon;
SET new.ppn = varppn;
SET new.total = vartotal;
SET new.sisatagihan = vartotal;

UPDATE tpengirimanpenjualan SET status = '3' WHERE id = new.pengirimanid;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeUpdateFAkturPenjualan` BEFORE UPDATE ON `tfakturpenjualan` FOR EACH ROW BEGIN
  
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
  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tfakturpenjualandetail`
--

CREATE TABLE `tfakturpenjualandetail` (
  `idfaktur` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlahsisa` int(11) DEFAULT '0',
  `jumlahretur` int(11) DEFAULT '0',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` float DEFAULT '0',
  `ppn` float DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Trigger `tfakturpenjualandetail`
--
DELIMITER $$
CREATE TRIGGER `InsertAfterFakturPenjualanDetail` BEFORE INSERT ON `tfakturpenjualandetail` FOR EACH ROW BEGIN

DECLARE varpengirimanid, varkontakid, vargudangid INT;
DECLARE varstatusauto, vartipe CHAR(1);

SELECT pengirimanid, kontakid, gudangid 
INTO varpengirimanid, varkontakid, vargudangid
FROM tfakturpenjualan WHERE id = new.idfaktur;

SELECT statusauto, tipe
INTO varstatusauto, vartipe
FROM tpengirimanpenjualan WHERE id = varpengirimanid;

SET @idjurnal = (SELECT id FROM tjurnalpenjualan WHERE refid = new.idfaktur AND tipe = '2');
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
    
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpersediaan, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
      
    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpajak, @nominalppn, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @nominalppn;
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
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
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @hutangbelumditagih, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
      
    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @noakunpajak, @nominalppn, 0)
      ON DUPLICATE KEY UPDATE debet = debet + @nominalppn;      
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunutang, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
  END IF;
ELSE
  IF(varstatusauto = '1') THEN
    SET @subtotal = new.subtotal;

    SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE itemid = new.itemid ORDER BY id DESC LIMIT 1);

    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga)
    ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunbeli, @totalharga, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @totalharga;

    IF(new.diskon > 0) THEN
      SET @nominaldiskon = (new.diskon*@subtotal/100);
      SET @subtotal = @subtotal - @nominaldiskon;
    ELSE
      SET @nominaldiskon = 0;
      SET @subtotal = @subtotal - @nominaldiskon;
    END IF;

    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunjual, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;

    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      SET @ppnkeluaran = (SELECT noakun FROM mnoakunpengaturan WHERE id = 3);
      INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @ppnkeluaran, 0, @nominalppn)
      ON DUPLICATE KEY UPDATE kredit = kredit + @nominalppn;
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
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
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @pendapatanbelumditagih, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
    
    SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @piutangbelumditagih, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
    
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunjual, 0, @subtotal)
    ON DUPLICATE KEY UPDATE kredit = kredit + @subtotal;
      
    IF(new.ppn > 0) THEN
      SET @nominalppn = (new.ppn*@subtotal/100);
      SET @subtotal = @subtotal + @nominalppn;
      
      SET @ppnkeluaran = (SELECT noakun FROM mnoakunpengaturan WHERE id = 3);
      INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
      VALUES (@idjurnal, @ppnkeluaran, 0, @nominalppn)
      ON DUPLICATE KEY UPDATE kredit = kredit + @nominalppn;
    ELSE
      SET @nominalppn = 0;
      SET @subtotal = @subtotal + @nominalppn;
    END IF;
    
    INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
    VALUES (@idjurnal, @noakunpiutang, @subtotal, 0)
    ON DUPLICATE KEY UPDATE debet = debet + @subtotal;
  END IF;
END IF;



END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tjurnal`
--

CREATE TABLE `tjurnal` (
  `id` int(11) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `totaldebet` decimal(10,0) DEFAULT '0',
  `totalkredit` decimal(10,0) DEFAULT '0',
  `keterangan` varchar(255) DEFAULT NULL,
  `stauto` char(1) DEFAULT NULL,
  `tipe` char(1) DEFAULT NULL COMMENT '1 penerimaan, \r\n2 faktur, \r\n3 pembayaran, \r\n4 Jurnal umum, \r\n5 jurnal penyesuaian\r\n6 retur\r\n7 memo\r\n8 stok opname\r\n9 pengeluaran kas',
  `refid` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `cdate` datetime DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tjurnal`
--

INSERT INTO `tjurnal` (`id`, `notrans`, `tanggal`, `totaldebet`, `totalkredit`, `keterangan`, `stauto`, `tipe`, `refid`, `status`, `cdate`, `cby`) VALUES
(1, '#J200305001', '2020-03-05 03:09:35', 18000000, 18000000, 'Penerimaan item dari pesanan #PO200305001', '1', '1', 1, '1', NULL, NULL),
(2, '#J200305002', '2020-03-05 03:09:46', 18000000, 18000000, 'Faktur Pembelian #INV200305001', '1', '2', 1, '1', NULL, NULL),
(3, '#J200305003', '2020-03-05 03:09:58', 18000000, 18000000, 'Kirim Pembayaran Faktur #INV200305001', '1', '3', 1, '1', NULL, NULL),
(4, '#J200305004', '2020-03-05 03:10:31', 7600000, 7600000, 'Pengiriman item dari pesanan #SO200305001', '1', '1', 2, '1', NULL, NULL),
(5, '#J200305005', '2020-03-05 03:10:41', 8000000, 8000000, 'Faktur Penjualan #INV200305002', '1', '2', 2, '1', NULL, NULL),
(6, '#J200305006', '2020-03-05 00:00:00', 10000000, 10000000, 'Mutasi kas', '0', '4', NULL, '1', '2020-03-05 03:12:48', 'admin'),
(7, '#J200305007', '2020-03-05 04:07:14', 1000000, 1000000, 'Faktur Pembelian #INV200305003', '1', '2', 3, '1', NULL, NULL),
(8, '#J200305008', '2020-03-05 04:26:03', 15000, 15000, 'Pengeluaran Kas#PK200305001', '1', '9', 1, '1', NULL, NULL),
(9, '#J200909001', '2020-09-09 00:24:35', 0, 0, 'Penerimaan item dari pesanan #SO200908003', '1', '1', 4, '1', NULL, NULL),
(0, '#J201006001', '2020-10-06 17:33:20', 0, 0, 'Pengiriman item dari pesanan #SO201006003', '1', '1', 0, '1', NULL, NULL),
(0, '#J201006002', '2020-10-06 17:43:43', 0, 0, 'Pengiriman item dari pesanan #SO201006004', '1', '1', 2, '1', NULL, NULL),
(0, '#J201006003', '2020-10-06 20:52:26', 0, 0, 'Penerimaan item dari pesanan #SO201006003', '1', '1', 3, '1', NULL, NULL),
(0, '#J201006004', '2020-10-06 20:55:58', 0, 0, 'Penerimaan item dari pesanan #SO201006003', '1', '1', 4, '1', NULL, NULL),
(0, '#J201006005', '2020-10-06 20:57:16', 0, 0, 'Penerimaan item dari pesanan #SO201006003', '1', '1', 5, '1', NULL, NULL),
(0, '#J201008001', '2020-10-08 13:08:50', 0, 0, 'Faktur Pembelian #INV201008001', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008002', '2020-10-08 13:16:46', 0, 0, 'Faktur Pembelian #INV201008001', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008003', '2020-10-08 13:17:47', 0, 0, 'Faktur Pembelian #INV201008002', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008004', '2020-10-08 13:18:45', 0, 0, 'Faktur Pembelian #INV201008003', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008005', '2020-10-08 13:20:05', 0, 0, 'Faktur Pembelian #INV201008001', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008006', '2020-10-08 13:27:11', 0, 0, 'Faktur Pembelian #INV201008002', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008007', '2020-10-08 13:53:18', 0, 0, 'Faktur Pembelian #INV201008001', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008008', '2020-10-08 13:56:24', 0, 0, 'Faktur Pembelian #INV201008001', '1', '2', 0, '1', NULL, NULL),
(0, '#J201008009', '2020-10-08 04:16:28', 0, 0, 'Pengiriman item dari pesanan #SO201008001', '1', '1', 2, '1', NULL, NULL),
(0, '#J201009001', '2020-10-09 03:17:40', 0, 0, 'Pengiriman item dari pesanan #SO201009001', '1', '1', 0, '1', NULL, NULL);

--
-- Trigger `tjurnal`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertJurnalumum_copy1` BEFORE INSERT ON `tjurnal` FOR EACH ROW BEGIN
  SET new.notrans = generatecodejurnal();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tjurnaldetail`
--

CREATE TABLE `tjurnaldetail` (
  `idjurnal` int(11) NOT NULL,
  `noakun` varchar(30) NOT NULL,
  `debet` decimal(10,0) DEFAULT NULL,
  `kredit` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT '-'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tjurnaldetail`
--

INSERT INTO `tjurnaldetail` (`idjurnal`, `noakun`, `debet`, `kredit`, `keterangan`) VALUES
(1, '13111', 18000000, 0, '-'),
(1, '2112', 0, 18000000, '-'),
(2, '2112', 18000000, 0, '-'),
(2, '2113', 0, 18000000, '-'),
(3, '1112', 0, 18000000, '-'),
(3, '2113', 18000000, 0, '-'),
(4, '1212', 4000000, 0, '-'),
(4, '13111', 0, 3600000, '-'),
(4, '4114', 0, 4000000, '-'),
(4, '51141', 3600000, 0, '-'),
(5, '12111', 4000000, 0, '-'),
(5, '1212', 0, 4000000, '-'),
(5, '41111', 0, 4000000, '-'),
(5, '4114', 4000000, 0, '-'),
(6, '1111', 10000000, 0, '-'),
(6, '1112', 0, 10000000, '-'),
(7, '13112', 1000000, 0, '-'),
(7, '2113', 0, 1000000, '-'),
(8, '1111', 0, 15000, '-'),
(8, '551', 15000, 0, '-');

--
-- Trigger `tjurnaldetail`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertJurnaldetail` BEFORE INSERT ON `tjurnaldetail` FOR EACH ROW BEGIN

UPDATE tjurnal SET 
totaldebet = new.debet + totaldebet,
totalkredit = new.kredit + totalkredit
WHERE id = new.idjurnal;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tjurnalpenjualan`
--

CREATE TABLE `tjurnalpenjualan` (
  `id` int(11) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `totaldebet` decimal(10,0) DEFAULT '0',
  `totalkredit` decimal(10,0) DEFAULT '0',
  `keterangan` varchar(255) DEFAULT NULL,
  `stauto` char(1) DEFAULT NULL,
  `tipe` char(1) DEFAULT NULL COMMENT '1 penerimaan, \r\n2 faktur, \r\n3 pembayaran, \r\n4 Jurnal umum, \r\n5 jurnal penyesuaian\r\n6 retur\r\n7 memo\r\n8 stok opname\r\n9 pengeluaran kas',
  `refid` int(11) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `cdate` datetime DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `tipe_jurnal` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tjurnalpenjualan`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertJurnalumum_copy2` BEFORE INSERT ON `tjurnalpenjualan` FOR EACH ROW BEGIN
  SET new.notrans = generatecodejurnal();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tjurnalpenjualandetail`
--

CREATE TABLE `tjurnalpenjualandetail` (
  `idjurnal` int(11) NOT NULL,
  `noakun` varchar(30) NOT NULL,
  `debet` decimal(10,0) DEFAULT NULL,
  `kredit` decimal(10,0) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT '-',
  `tipe` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tjurnalpenjualandetail`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertJurnalPenjualandetail` BEFORE INSERT ON `tjurnalpenjualandetail` FOR EACH ROW BEGIN
    UPDATE tjurnalpenjualan SET 
    totaldebet = new.debet + totaldebet,
    totalkredit = new.kredit + totalkredit
    WHERE id = new.idjurnal;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tjurnalsaldoawal`
--

CREATE TABLE `tjurnalsaldoawal` (
  `tanggal` date DEFAULT NULL,
  `noakun` varchar(20) NOT NULL,
  `debet` decimal(10,0) DEFAULT '0',
  `kredit` decimal(10,0) DEFAULT '0',
  `stdel` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tkasbank`
--

CREATE TABLE `tkasbank` (
  `id` int(11) NOT NULL,
  `nomor_kas_bank` varchar(255) NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `pejabat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `penerimaan` decimal(10,0) NOT NULL,
  `pengeluaran` decimal(10,0) NOT NULL,
  `keterangan` text NOT NULL,
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(100) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tkasbank`
--

INSERT INTO `tkasbank` (`id`, `nomor_kas_bank`, `perusahaan`, `pejabat`, `tanggal`, `penerimaan`, `pengeluaran`, `keterangan`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(41, '0001/01/BANK/2020', 6, 5, '2020-09-22', 0, 0, 'TEST', '0', 'admin', '2020-09-22 08:32:27', 'admin', '2020-09-27 12:39:19', NULL, NULL),
(42, '0002/01/BANK/2020', 6, 5, '2020-09-27', 0, 0, 'kas bank', '1', 'admin', '2020-09-27 08:01:47', 'admin', '2020-09-27 08:12:59', NULL, NULL),
(43, '0003/01/BANK/2020', 6, 5, '2020-09-27', 0, 0, 'test', '0', 'admin', '2020-09-27 17:01:20', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tkasbankdetail`
--

CREATE TABLE `tkasbankdetail` (
  `idkasbank` int(11) NOT NULL,
  `tipe` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `nokwitansi` varchar(100) NOT NULL,
  `penerimaan` decimal(10,0) NOT NULL,
  `pengeluaran` decimal(10,0) NOT NULL,
  `noakun` int(11) NOT NULL,
  `kodeunit` varchar(100) NOT NULL,
  `departemen` int(11) NOT NULL,
  `sumberdana` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tkasbankdetail`
--

INSERT INTO `tkasbankdetail` (`idkasbank`, `tipe`, `tanggal`, `nokwitansi`, `penerimaan`, `pengeluaran`, `noakun`, `kodeunit`, `departemen`, `sumberdana`) VALUES
(41, 'Pengajuan Kas Kecil', '2020-09-01', '001/01/KK/2020', 0, 1000000, 4, '6', 5, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tmemo`
--

CREATE TABLE `tmemo` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `tipe` varchar(255) DEFAULT NULL,
  `refid` int(11) DEFAULT NULL,
  `debet` decimal(10,0) DEFAULT NULL,
  `kredit` decimal(10,0) DEFAULT NULL,
  `noakundebet` varchar(255) DEFAULT NULL,
  `noakunkredit` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tmemo`
--
DELIMITER $$
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
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeInsertMemo` BEFORE INSERT ON `tmemo` FOR EACH ROW BEGIN
  SET new.notrans = generatecodememo();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpembayaran`
--

CREATE TABLE `tpembayaran` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `fakturid` int(255) DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `tipe` char(1) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT '0',
  `totaldibayar` decimal(10,0) DEFAULT NULL,
  `sisatagihan` decimal(10,0) DEFAULT NULL,
  `carabayarid` int(1) DEFAULT NULL,
  `noakunbayar` varchar(20) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `tipebayar` char(1) DEFAULT '1' COMMENT '1 default\r\n2 dari debet memo\r\n',
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tpembayaran`
--

INSERT INTO `tpembayaran` (`id`, `notrans`, `tanggal`, `fakturid`, `kontakid`, `tipe`, `total`, `totaldibayar`, `sisatagihan`, `carabayarid`, `noakunbayar`, `catatan`, `tipebayar`, `status`, `cby`, `cdate`) VALUES
(1, '#PAY200305001', '2020-03-05', 1, 2, '1', 18000000, 18000000, 0, 1, '1112', NULL, '1', '1', 'admin', '2020-03-05 03:09:58');

--
-- Trigger `tpembayaran`
--
DELIMITER $$
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


END
$$
DELIMITER ;
DELIMITER $$
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
  
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpembelian`
--

CREATE TABLE `tpembelian` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL COMMENT '1 Pemesanan 2 pengiriman 3 faktur',
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesanan`
--

CREATE TABLE `tpemesanan` (
  `id` varchar(191) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `idperusahaan` int(11) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `pejabat` varchar(20) NOT NULL,
  `jenis_pembelian` varchar(20) NOT NULL,
  `jenis_barang` varchar(20) DEFAULT NULL,
  `cara_pembayaran` varchar(10) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `biayapengiriman` int(191) NOT NULL,
  `ppn` decimal(10,0) DEFAULT '0',
  `akunno` varchar(20) NOT NULL,
  `diskon` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `stdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tpemesanan`
--

INSERT INTO `tpemesanan` (`id`, `notrans`, `tanggal`, `kontakid`, `gudangid`, `idperusahaan`, `departemen`, `pejabat`, `jenis_pembelian`, `jenis_barang`, `cara_pembayaran`, `catatan`, `subtotal`, `biayapengiriman`, `ppn`, `akunno`, `diskon`, `total`, `tipe`, `status`, `uby`, `udate`, `cby`, `cdate`, `stdel`) VALUES
('PEMESANAN5f800e94439ee', '#SO201009001', '2020-10-01', 2, 5, 6, 'keuangan', 'adi', 'barang', 'barang_dagangan', 'cash', 'Tes', 250000, 0, 0, '', 0, 250000, '2', '6', 'admin', '2020-10-09 14:17:48', 'admin', '2020-10-09 14:17:40', 0);

--
-- Trigger `tpemesanan`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertPemesanan` BEFORE INSERT ON `tpemesanan` FOR EACH ROW BEGIN
  SET new.notrans = generatecodepemesanan(new.tipe);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesananangsuran`
--

CREATE TABLE `tpemesananangsuran` (
  `id` varchar(191) NOT NULL,
  `idpemesanan` varchar(191) NOT NULL,
  `uangmuka` varchar(25) DEFAULT '0',
  `jumlahterm` varchar(25) DEFAULT '0',
  `total` varchar(25) DEFAULT '0',
  `a1` varchar(25) DEFAULT '0',
  `a2` varchar(25) DEFAULT '0',
  `a3` varchar(25) DEFAULT '0',
  `a4` varchar(25) DEFAULT '0',
  `a5` varchar(25) DEFAULT '0',
  `a6` varchar(25) DEFAULT '0',
  `a7` varchar(25) DEFAULT '0',
  `a8` varchar(25) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tpemesananangsuran`
--

INSERT INTO `tpemesananangsuran` (`id`, `idpemesanan`, `uangmuka`, `jumlahterm`, `total`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`) VALUES
('PEM-ANG5f7c47f0bf433', 'PEMESANAN5f7c47efeb16a', '2000000', '700000', '2700000', '100000', '100000', '100000', '100000', '100000', '100000', '50000', '50000'),
('PEM-ANG5f7ecadc8d387', 'PEMESANAN5f7ecadc8850b', '0', '150000', '150000', '150000', '0', '0', '0', '0', '0', '0', '0'),
('PEM-ANG5f800d1680735', 'PEMESANAN5f800d167a4f6', '100000', '50000', '150000', '50000', '0', '0', '0', '0', '0', '0', '0'),
('PEM-ANG5f800e9447cfc', 'PEMESANAN5f800e94439ee', '50000', '200000', '250000', '200000', '0', '0', '0', '0', '0', '0', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesanandetail`
--

CREATE TABLE `tpemesanandetail` (
  `id` varchar(191) NOT NULL,
  `idpemesanan` varchar(191) NOT NULL,
  `itemid` varchar(191) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlahditerima` int(11) DEFAULT '0',
  `jumlahsisa` int(11) DEFAULT '0',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `biayapengiriman` int(191) NOT NULL,
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `akunno` varchar(50) NOT NULL,
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tpemesanandetail`
--

INSERT INTO `tpemesanandetail` (`id`, `idpemesanan`, `itemid`, `harga`, `jumlah`, `jumlahditerima`, `jumlahsisa`, `subtotal`, `diskon`, `biayapengiriman`, `ppn`, `total`, `akunno`, `status`) VALUES
('PEM-DET5f7c47f04c706', 'PEMESANAN5f7c47efeb16a', '1', 1000000, 1, 1, 0, 1000000, 0, 0, 0, 1000000, '0', '4'),
('PEM-DET5f7c47f074a4a', 'PEMESANAN5f7c47efeb16a', '1', 1000000, 1, 1, 0, 1000000, 0, 0, 0, 1000000, '11010201', '4'),
('PEM-DET5f7c47f08c0b5', 'PEMESANAN5f7c47efeb16a', '9', 2000, 100, 50, 50, 200000, 0, 0, 0, 200000, '1101', '4'),
('PEM-DET5f7c47f09f6ff', 'PEMESANAN5f7c47efeb16a', '8', 500, 1000, 300, 700, 500000, 0, 0, 0, 500000, '11010102', '4'),
('PEM-DET5f7ecadc8bca1', 'PEMESANAN5f7ecadc8850b', '9', 5000, 20, 20, 0, 100000, 0, 0, 0, 100000, '1101', '4'),
('PEM-DET5f7ecadc8c97f', 'PEMESANAN5f7ecadc8850b', '8', 50000, 1, 1, 0, 50000, 0, 0, 0, 50000, '11010102', '4'),
('PEM-DET5f800d167d11c', 'PEMESANAN5f800d167a4f6', '9', 5000, 10, 0, 10, 50000, 0, 0, 0, 50000, '1101', '4'),
('PEM-DET5f800d167fb41', 'PEMESANAN5f800d167a4f6', '8', 50000, 2, 0, 2, 100000, 0, 0, 0, 100000, '11010102', '4'),
('PEM-DET5f800e9446545', 'PEMESANAN5f800e94439ee', '9', 5000, 10, 10, 0, 50000, 0, 0, 0, 50000, '1101', '4'),
('PEM-DET5f800e9447459', 'PEMESANAN5f800e94439ee', '8', 50000, 4, 4, 0, 200000, 0, 0, 0, 200000, '11010102', '4');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesananpenjualan`
--

CREATE TABLE `tpemesananpenjualan` (
  `id` varchar(191) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `idperusahaan` int(11) NOT NULL,
  `departemen` varchar(50) NOT NULL,
  `pejabat` varchar(20) NOT NULL,
  `jenis_pembelian` varchar(20) NOT NULL,
  `jenis_barang` varchar(20) DEFAULT NULL,
  `cara_pembayaran` varchar(10) NOT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `akunno` varchar(20) NOT NULL,
  `diskon` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `stdel` char(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tpemesananpenjualan`
--

INSERT INTO `tpemesananpenjualan` (`id`, `notrans`, `tanggal`, `kontakid`, `gudangid`, `idperusahaan`, `departemen`, `pejabat`, `jenis_pembelian`, `jenis_barang`, `cara_pembayaran`, `catatan`, `subtotal`, `ppn`, `akunno`, `diskon`, `total`, `tipe`, `status`, `uby`, `udate`, `cby`, `cdate`, `stdel`) VALUES
('PEM-JUAL5f801104f318e', '#SO201009002', '2020-10-01', 1, NULL, 6, 'Sales_Marketing', 'andri', 'jasa', NULL, 'cash', 'TES', 10000000, 0, ' ', 0, 10000000, '2', '5', 'admin', '2020-10-09 14:31:49', 'admin', '2020-10-09 14:28:04', '0'),
('PEM-JUAL5f8011998e98b', '#SO201009002', '2020-10-01', 1, 5, 6, 'Sales_Marketing', 'andri', 'barang', 'barang_dagangan', 'cash', 'SO Barang Dagangan', 1000000, 0, ' ', 0, 1000000, '2', '5', 'admin', '2020-10-09 14:31:54', 'admin', '2020-10-09 14:30:33', '0');

--
-- Trigger `tpemesananpenjualan`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertpemesananpenjualan` BEFORE INSERT ON `tpemesananpenjualan` FOR EACH ROW BEGIN
  SET new.notrans = generatecodepemesanan(new.tipe);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesananpenjualanangsuran`
--

CREATE TABLE `tpemesananpenjualanangsuran` (
  `id` varchar(191) NOT NULL,
  `idpemesanan` varchar(191) NOT NULL,
  `uangmuka` varchar(25) NOT NULL,
  `jumlahterm` varchar(25) NOT NULL,
  `total` varchar(25) NOT NULL,
  `a1` varchar(25) DEFAULT NULL,
  `a2` varchar(25) DEFAULT NULL,
  `a3` varchar(25) DEFAULT NULL,
  `a4` varchar(25) DEFAULT NULL,
  `a5` varchar(25) DEFAULT NULL,
  `a6` varchar(25) DEFAULT NULL,
  `a7` varchar(25) DEFAULT NULL,
  `a8` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tpemesananpenjualanangsuran`
--

INSERT INTO `tpemesananpenjualanangsuran` (`id`, `idpemesanan`, `uangmuka`, `jumlahterm`, `total`, `a1`, `a2`, `a3`, `a4`, `a5`, `a6`, `a7`, `a8`) VALUES
('PEM-JUAL-ANG5f80110501fd1', 'PEM-JUAL5f801104f318e', '5000000', '1', '10000000', '5000000', '', '', '', '', '', '', ''),
('PEM-JUAL-ANG5f80119996663', 'PEM-JUAL5f8011998e98b', '0', '1', '1000000', '1000000', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemesananpenjualandetail`
--

CREATE TABLE `tpemesananpenjualandetail` (
  `id` varchar(191) NOT NULL,
  `idpemesanan` varchar(191) NOT NULL,
  `itemid` varchar(191) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlahditerima` int(11) DEFAULT '0',
  `jumlahsisa` int(11) DEFAULT '0',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `akunno` varchar(50) NOT NULL,
  `status` char(1) DEFAULT '1',
  `tipe` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tpemesananpenjualandetail`
--

INSERT INTO `tpemesananpenjualandetail` (`id`, `idpemesanan`, `itemid`, `harga`, `jumlah`, `jumlahditerima`, `jumlahsisa`, `subtotal`, `diskon`, `ppn`, `total`, `akunno`, `status`, `tipe`) VALUES
('PEM-JUAL-DET5f8011050121d', 'PEM-JUAL5f801104f318e', '9', 10000000, 1, 0, 1, 10000000, 0, 0, 10000000, '9', '4', 'jasa'),
('PEM-JUAL-DET5f80119990e7f', 'PEM-JUAL5f8011998e98b', '1', 500000, 2, 0, 2, 1000000, 0, 0, 1000000, '1', '4', 'barang');

--
-- Trigger `tpemesananpenjualandetail`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertpemesananpenjualanDetail` BEFORE INSERT ON `tpemesananpenjualandetail` FOR EACH ROW BEGIN
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

UPDATE tpemesananpenjualan SET
subtotal = new.subtotal + subtotal, 
ppn = @nominalppn + ppn,
diskon = @nominaldiskon + diskon,
total = new.total + total
WHERE id = new.idpemesanan;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeUpdatetPemesananPenjualanDetail` BEFORE UPDATE ON `tpemesananpenjualandetail` FOR EACH ROW BEGIN

SET new.jumlahsisa = new.jumlah - new.jumlahditerima;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpemindahbukuankaskecil`
--

CREATE TABLE `tpemindahbukuankaskecil` (
  `id` int(11) NOT NULL,
  `nomor_kas_bank` varchar(100) NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `pejabat` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `keterangan` text NOT NULL,
  `penerimaan` decimal(10,0) NOT NULL,
  `pengeluaran` decimal(10,0) NOT NULL,
  `cby` varchar(100) DEFAULT NULL,
  `cdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tpemindahbukuankaskecil`
--

INSERT INTO `tpemindahbukuankaskecil` (`id`, `nomor_kas_bank`, `perusahaan`, `pejabat`, `tanggal`, `keterangan`, `penerimaan`, `pengeluaran`, `cby`, `cdate`) VALUES
(35, '0001/01/BANK/2020', 6, 5, '2020-09-22', 'TES', 1000000, 0, 'admin', '2020-09-22'),
(36, '0002/01/BANK/2020', 6, 5, '2020-09-27', 'kas bank', 0, 0, 'admin', '2020-09-27'),
(37, '', 6, 5, '2020-09-22', 'TEST', 0, 0, 'admin', '2020-09-27'),
(38, '0003/01/BANK/2020', 6, 5, '2020-09-27', 'test', 0, 0, 'admin', '2020-09-27');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengajuankaskecil`
--

CREATE TABLE `tpengajuankaskecil` (
  `id` int(11) NOT NULL,
  `nokwitansi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `pejabat` int(11) NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `kas` int(11) NOT NULL,
  `rekening` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(100) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tpengajuankaskecil`
--

INSERT INTO `tpengajuankaskecil` (`id`, `nokwitansi`, `tanggal`, `perusahaan`, `pejabat`, `nominal`, `kas`, `rekening`, `keterangan`, `status`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(33, '001/01/KK/2020', '2020-09-01', 6, 5, 1000000, 4, 6, 'TES', 1, '0', 'admin', '2020-09-22 08:27:58', 'admin', '2020-09-22 08:32:27', NULL, NULL),
(34, '002/01/KK/2020', '2020-09-27', 6, 5, 0, 4, 6, 'a', 0, '1', 'admin', '2020-09-27 08:59:35', NULL, NULL, 'admin', '2020-09-27 09:03:08'),
(35, '003/01/KK/2020', '2020-09-27', 6, 5, 10000000, 4, 6, 'reda', 0, '1', 'admin', '2020-09-27 09:03:50', 'admin', '2020-09-27 09:14:31', 'admin', '2020-09-27 09:14:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengeluarankas`
--

CREATE TABLE `tpengeluarankas` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `penerima` varchar(100) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `nominal` decimal(10,0) DEFAULT NULL,
  `noakunkas` varchar(20) DEFAULT NULL,
  `noakunbiaya` varchar(20) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `uby` varchar(255) DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tpengeluarankas`
--
DELIMITER $$
CREATE TRIGGER `BA_pengeluarankas` AFTER INSERT ON `tpengeluarankas` FOR EACH ROW begin
  INSERT INTO tjurnal (tanggal,keterangan,stauto,tipe,refid) 
  VALUES (NOW(),CONCAT('Pengeluaran Kas', new.notrans),'1','9',new.id);
  set @idjurnal = LAST_INSERT_ID();
  
  insert into tjurnaldetail(idjurnal, noakun,debet, kredit, keterangan)
  values
  (@idjurnal, new.noakunkas, 0, new.nominal, '-'),
  (@idjurnal, new.noakunbiaya, new.nominal, 0, '-');
  
  
  
end
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BI_pengeluarankas` BEFORE INSERT ON `tpengeluarankas` FOR EACH ROW begin
if(new.notrans = '' OR new.notrans is null) then
  set new.notrans = generatecodepengeluarankas();
end if;
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengeluarankaskecil`
--

CREATE TABLE `tpengeluarankaskecil` (
  `id` int(11) NOT NULL,
  `nokwitansi` varchar(100) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `perusahaan` int(11) NOT NULL,
  `departemen` int(11) NOT NULL,
  `pejabat` varchar(20) NOT NULL,
  `keterangan` text,
  `subtotal` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `akunno` varchar(20) NOT NULL,
  `diskon` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL,
  `status` int(1) DEFAULT '0',
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `dby` varchar(100) NOT NULL,
  `ddate` datetime NOT NULL,
  `stdel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tpengeluarankaskecil`
--

INSERT INTO `tpengeluarankaskecil` (`id`, `nokwitansi`, `tanggal`, `perusahaan`, `departemen`, `pejabat`, `keterangan`, `subtotal`, `ppn`, `akunno`, `diskon`, `total`, `tipe`, `status`, `uby`, `udate`, `cby`, `cdate`, `dby`, `ddate`, `stdel`) VALUES
(33, '002/01/KK/2020', '2020-09-27', 6, 5, 'adi', 'a', 0, 0, '4', 0, 0, NULL, 0, NULL, NULL, 'admin', '2020-09-27 17:12:19', '', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengeluarankaskecildetail`
--

CREATE TABLE `tpengeluarankaskecildetail` (
  `id` int(191) NOT NULL,
  `idpengeluaran` int(11) NOT NULL,
  `itemid` varchar(100) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlahditerima` int(11) DEFAULT '0',
  `jumlahsisa` int(11) DEFAULT '0',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` float DEFAULT '0',
  `ppn` float DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `akunno` varchar(50) NOT NULL,
  `status` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Dumping data untuk tabel `tpengeluarankaskecildetail`
--

INSERT INTO `tpengeluarankaskecildetail` (`id`, `idpengeluaran`, `itemid`, `harga`, `jumlah`, `jumlahditerima`, `jumlahsisa`, `subtotal`, `diskon`, `ppn`, `total`, `akunno`, `status`) VALUES
(1, 32, 'ABD5f6729cdc4781', 13000, 1, 0, 1, 13000, 0, 0, 13000, '1170102', '0'),
(2, 32, 'ABD5f6729cdc4f35', 50000, 1, 0, 1, 50000, 0, 0, 50000, '1170102', '0'),
(3, 33, 'ABD5f6729cdc4f35', 0, 1, 0, 1, 0, 0, 0, 0, '1170102', '0');

--
-- Trigger `tpengeluarankaskecildetail`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertPengeluarankaskecil` BEFORE INSERT ON `tpengeluarankaskecildetail` FOR EACH ROW BEGIN
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

UPDATE tpengeluarankaskecil SET
subtotal = new.subtotal + subtotal, 
ppn = @nominalppn + ppn,
diskon = @nominaldiskon + diskon,
total = new.total + total
WHERE id = new.idpengeluaran;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeUpdatePengeluarankaskecildetail` BEFORE UPDATE ON `tpengeluarankaskecildetail` FOR EACH ROW BEGIN

SET new.jumlahsisa = new.jumlah - new.jumlahditerima;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengiriman`
--

CREATE TABLE `tpengiriman` (
  `id` int(11) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `pemesananid` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT '-',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL,
  `statusauto` char(1) DEFAULT '0',
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tpengiriman`
--

INSERT INTO `tpengiriman` (`id`, `notrans`, `tanggal`, `kontakid`, `gudangid`, `pemesananid`, `catatan`, `subtotal`, `diskon`, `ppn`, `total`, `tipe`, `statusauto`, `status`, `cby`, `cdate`) VALUES
(0, '#KRM201009001', '2020-10-01', NULL, 5, 0, 'OK Gudang', 0, 0, 0, 250000, '1', '0', '3', 'admin', '2020-10-09 14:20:16');

--
-- Trigger `tpengiriman`
--
DELIMITER $$
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
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeInsertPengiriman` BEFORE INSERT ON `tpengiriman` FOR EACH ROW begin

SET new.notrans = generatecodepengiriman(new.tipe);
IF(new.pemesananid IS NOT NULL) THEN
  SET new.kontakid = (SELECT kontakid FROM tpemesanan WHERE id = new.pemesananid);
  SET new.gudangid = (SELECT gudangid FROM tpemesanan WHERE id = new.pemesananid);
END IF;

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengirimandet`
--

CREATE TABLE `tpengirimandet` (
  `id` int(191) NOT NULL,
  `idpengiriman` int(191) NOT NULL,
  `idpemesanandetail` varchar(191) NOT NULL,
  `jumlah` int(191) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tpengirimandet`
--

INSERT INTO `tpengirimandet` (`id`, `idpengiriman`, `idpemesanandetail`, `jumlah`) VALUES
(29, 1, 'PEM-DET5f7c47f04c706', 1),
(30, 1, 'PEM-DET5f7c47f074a4a', 1),
(31, 1, 'PEM-DET5f7c47f08c0b5', 50),
(32, 1, 'PEM-DET5f7c47f09f6ff', 300),
(33, 2, 'PEM-DET5f7ecadc8bca1', 20),
(34, 2, 'PEM-DET5f7ecadc8c97f', 1),
(35, 0, 'PEM-DET5f800e9446545', 10),
(36, 0, 'PEM-DET5f800e9447459', 4);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengirimandetail`
--

CREATE TABLE `tpengirimandetail` (
  `id` int(191) NOT NULL,
  `idpengiriman` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT '0',
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskonnominal` decimal(10,0) DEFAULT '0',
  `diskon` float DEFAULT '0',
  `ppn` float DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tpengirimandetail`
--
DELIMITER $$
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


END
$$
DELIMITER ;
DELIMITER $$
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

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengirimanpenjualan`
--

CREATE TABLE `tpengirimanpenjualan` (
  `id` int(11) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `tanggalterima` date DEFAULT NULL,
  `nomorsuratjalan` varchar(100) DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `departemen` int(11) DEFAULT NULL,
  `pemesananid` varchar(75) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT '-',
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL,
  `statusauto` char(1) DEFAULT '0',
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `validasi` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tpengirimanpenjualan`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertpengirimanpenjualan` BEFORE INSERT ON `tpengirimanpenjualan` FOR EACH ROW begin

SET new.notrans = generatecodepengiriman(new.tipe);
IF(new.pemesananid IS NOT NULL) THEN
  SET new.kontakid = (SELECT kontakid FROM tpemesananpenjualan WHERE id = new.pemesananid);
  SET new.gudangid = (SELECT gudangid FROM tpemesananpenjualan WHERE id = new.pemesananid);
  SET new.departemen = (SELECT departemen FROM tpemesananpenjualan WHERE id = new.pemesananid);
END IF;

end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tpengirimanpenjualandetail`
--

CREATE TABLE `tpengirimanpenjualandetail` (
  `idpengiriman` int(11) NOT NULL,
  `idpenjualdetail` varchar(100) DEFAULT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT '0',
  `jumlah` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskonnominal` decimal(10,0) DEFAULT '0',
  `diskon` float DEFAULT '0',
  `ppn` float DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` varchar(40) DEFAULT NULL,
  `validasi` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tpengirimanpenjualandetail`
--
DELIMITER $$
CREATE TRIGGER `AfterUpdatepengirimanpenjualanDetail` AFTER UPDATE ON `tpengirimanpenjualandetail` FOR EACH ROW BEGIN

DECLARE varpemesananid, vargudangid, varkontakid INT;
DECLARE varnopenerimaan VARCHAR(20);
DECLARE varharga DECIMAL;
DECLARE vardiskon, varppn FLOAT;
DECLARE vartipe, varstatusauto CHAR(1);
DECLARE vartipebarang VARCHAR (100);

SET @idpengiriman = (SELECT idpengiriman FROM tpengirimanpenjualandetail WHERE idpengiriman = new.idpengiriman GROUP BY idpengiriman);

SET @cek_jurnal = (SELECT COUNT(*) FROM tjurnalpenjualan WHERE refid = @idpengiriman);

SET @pemesananid = (SELECT pemesananid FROM tpengirimanpenjualan WHERE id = @idpengiriman);
SET @tipepengiriman = (SELECT tipe FROM tpengirimanpenjualan WHERE id = @idpengiriman);
SET @statusautopengiriman = (SELECT statusauto FROM tpengirimanpenjualan WHERE id = @idpengiriman);

SET @nopemesanan = (SELECT notrans FROM tpemesananpenjualan WHERE id = @pemesananid);
IF (@cek_jurnal = 0) THEN
  IF(@tipepengiriman = '2') THEN
    IF(@statusautopengiriman = 0) THEN
      INSERT INTO tjurnalpenjualan (tanggal,keterangan,stauto,tipe,refid, tipe_jurnal)
      VALUES (NOW(),CONCAT('Pengiriman item dari pesanan ',@nopemesanan),'1','1',@idpengiriman,'penjualan');
    END IF;
  END IF;
END IF;


SET @pemesananid = (SELECT pemesananid FROM tpengirimanpenjualan WHERE id = new.idpengiriman );

IF(@pemesananid IS NOT NULL) THEN

  SELECT pemesananid, notrans, tipe, statusauto, gudangid 
  INTO varpemesananid, varnopenerimaan, vartipe, varstatusauto, vargudangid
  FROM tpengirimanpenjualan
  WHERE id = new.idpengiriman;
  
  -- update jumlahditerima pemesanan
  UPDATE tpemesananpenjualandetail 
  SET jumlahditerima = new.jumlah + jumlahditerima
  WHERE id = new.idpenjualdetail AND itemid = new.itemid;

  -- update status pemesanan detail
  SET @jumlahsisa = (SELECT jumlahsisa FROM tpemesananpenjualandetail 
  WHERE idpemesanan = @pemesananid AND itemid = new.itemid);
  IF(@jumlahsisa = 0) THEN
    UPDATE tpemesananpenjualandetail 
    SET status = 3
    WHERE idpemesanan = @pemesananid AND itemid = new.itemid;
  ELSE 
    UPDATE tpemesananpenjualandetail 
    SET status = 2
    WHERE idpemesanan = @pemesananid AND itemid = new.itemid;
  END IF;

  -- update status pemesanan
  SET @sumjumlahsisa = (SELECT SUM(jumlahsisa) FROM tpemesananpenjualandetail WHERE idpemesanan = @pemesananid );
  IF(@sumjumlahsisa = 0) THEN
    UPDATE tpemesananpenjualan SET status = 3 WHERE id = @pemesananid;
  ELSE
    UPDATE tpemesananpenjualan SET status = 2 WHERE id = @pemesananid;
  END IF;
  
  
  IF(varstatusauto = 0) THEN
    SET @idjurnal = (SELECT id FROM tjurnalpenjualan WHERE refid = new.idpengiriman AND tipe = 1);
    IF(vartipe = 2) THEN
      SET @tipebarang = (SELECT tipe FROM tpemesananpenjualandetail WHERE idpemesanan = @pemesananid AND itemid = new.itemid);

      IF (@tipebarang = 'barang') THEN
        SET @gudangid = vargudangid;
        -- simpan data ke stok keluar
        INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, harga, jumlah, refid)
        VALUES(@gudangid, CURRENT_DATE(), new.itemid, new.harga, new.jumlah, new.idpengiriman);
        
        SET @stokkeluarid = LAST_INSERT_ID();
        SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE id = @stokkeluarid);
        -- piutang
        SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @piutangbelumditagih, new.subtotal, 0)
        ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
        -- pendapatan
        SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @pendapatanbelumditagih, 0, new.subtotal)
        ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;
        -- select noakun persedian untuk barang
        SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga, @tipebarang)
        ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
        -- select noakunjual untuk barang
        SET @noakunjual = (SELECT noakunjual FROM mitem WHERE id = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @noakunjual, @totalharga, 0, @tipebarang)
        ON DUPLICATE KEY UPDATE debet = debet + @totalharga;

      ELSE
        SET @total_pemesanan = (SELECT total FROM tpemesananpenjualan WHERE id = @pemesananid);
        -- piutang
        SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @piutangbelumditagih, new.subtotal, 0)
        ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
        -- pendapatan
        SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @pendapatanbelumditagih, 0, new.subtotal)
        ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;

        -- select noakun 
        SET @akunno = (SELECT akunno FROM mnoakun WHERE idakun = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @akunno, 0, @total_pemesanan, @tipebarang)
        ON DUPLICATE KEY UPDATE kredit = kredit + @total_pemesanan;
        
        SET @noakun = (SELECT akunno FROM mnoakun WHERE idakun = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @noakun, @total_pemesanan, 0, @tipebarang)
        ON DUPLICATE KEY UPDATE debet = debet + @total_pemesanan;
      END IF;
    END IF;
  END IF;
ELSE

  SELECT pemesananid, notrans, tipe, statusauto, gudangid, kontakid 
  INTO varpemesananid, varnopenerimaan, vartipe, varstatusauto, vargudangid, varkontakid
  FROM tpengirimanpenjualan
  WHERE id = new.idpengiriman;

  IF(varstatusauto = 0) THEN
    SET @idjurnal = (SELECT id FROM tjurnalpenjualan WHERE refid = new.idpengiriman AND tipe = 1);
    IF(vartipe = 2) THEN
      SET @tipebarang = (SELECT tipe FROM tpemesananpenjualandetail WHERE idpemesanan = @pemesananid AND itemid = new.itemid);

      IF (@tipebarang = 'barang') THEN
        SET @gudangid = vargudangid;
        -- simpan data ke stok keluar
        INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, harga, jumlah, refid)
        VALUES(@gudangid, CURRENT_DATE(), new.itemid, new.harga, new.jumlah, new.idpengiriman);
        
        SET @stokkeluarid = LAST_INSERT_ID();
        SET @totalharga = (SELECT totalharga FROM tstokkeluar WHERE id = @stokkeluarid);
        -- piutang
        SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @piutangbelumditagih, new.subtotal, 0)
        ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
        -- pendapatan
        SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @pendapatanbelumditagih, 0, new.subtotal)
        ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;
        -- select noakun persedian untuk barang
        SET @noakunpersediaan = (SELECT noakunpersediaan FROM mitem WHERE id = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @noakunpersediaan, 0, @totalharga, @tipebarang)
        ON DUPLICATE KEY UPDATE kredit = kredit + @totalharga;
        -- select noakunjual untuk barang
        SET @noakunjual = (SELECT noakunjual FROM mitem WHERE id = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @noakunjual, @totalharga, 0, @tipebarang)
        ON DUPLICATE KEY UPDATE debet = debet + @totalharga;

      ELSE 
        SET @total_pemesanan = (SELECT total FROM tpemesananpenjualan WHERE id = @pemesananid);
        -- piutang
        SET @piutangbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 1);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @piutangbelumditagih, new.subtotal, 0)
        ON DUPLICATE KEY UPDATE debet = debet + new.subtotal;
        -- pendapatan
        SET @pendapatanbelumditagih = (SELECT noakun FROM mnoakunpengaturan WHERE id = 7);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit)
        VALUES (@idjurnal, @pendapatanbelumditagih, 0, new.subtotal)
        ON DUPLICATE KEY UPDATE kredit = kredit + new.subtotal;

        -- select noakun 
        SET @akunno = (SELECT akunno FROM mnoakun WHERE idakun = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @akunno, 0, @total_pemesanan, @tipebarang)
        ON DUPLICATE KEY UPDATE kredit = kredit + @total_pemesanan;
        
        SET @noakun = (SELECT akunno FROM mnoakun WHERE idakun = new.itemid);
        INSERT INTO tjurnalpenjualandetail (idjurnal, noakun, debet, kredit, tipe)
        VALUES (@idjurnal, @noakun, @total_pemesanan, 0, @tipebarang)
        ON DUPLICATE KEY UPDATE debet = debet + @total_pemesanan;
      END IF;
    END IF;
  END IF;
END IF;

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeInsertpengirimanpenjualanDetail` BEFORE INSERT ON `tpengirimanpenjualandetail` FOR EACH ROW BEGIN

DECLARE varpemesananid VARCHAR(100);
DECLARE varnopenerimaan VARCHAR(20);
DECLARE varharga DECIMAL;
DECLARE vardiskon, varppn FLOAT;

SET @pemesananid = (SELECT pemesananid FROM tpengirimanpenjualan WHERE id = new.idpengiriman );

IF(@pemesananid IS NOT NULL) THEN

  SELECT pemesananid, notrans 
  INTO varpemesananid, varnopenerimaan
  FROM tpengirimanpenjualan
  WHERE id = new.idpengiriman;

  SELECT harga, diskon, ppn
  INTO varharga, vardiskon, varppn
  FROM tpemesananpenjualandetail 
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
  UPDATE tpengirimanpenjualan SET
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
  UPDATE tpengirimanpenjualan SET
  subtotal = subtotal + new.subtotal,
  diskon = diskon + @nominaldiskon,
  ppn = ppn + @nominalppn,
  total = total + new.total
  WHERE id = new.idpengiriman;
END IF;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trequiremen`
--

CREATE TABLE `trequiremen` (
  `id` int(11) NOT NULL,
  `notrans` varchar(30) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `idperusahaan` int(11) NOT NULL,
  `departemen` varchar(10) NOT NULL,
  `pejabat` varchar(20) NOT NULL,
  `jenis_pembelian` varchar(20) DEFAULT NULL,
  `jenis_barang` varchar(20) DEFAULT NULL,
  `cara_pembayaran` varchar(10) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `akunno` varchar(20) NOT NULL,
  `diskon` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT NULL,
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `trequiremen`
--

INSERT INTO `trequiremen` (`id`, `notrans`, `tanggal`, `kontakid`, `gudangid`, `idperusahaan`, `departemen`, `pejabat`, `jenis_pembelian`, `jenis_barang`, `cara_pembayaran`, `catatan`, `subtotal`, `ppn`, `akunno`, `diskon`, `total`, `tipe`, `status`, `cby`, `cdate`) VALUES
(2, '#SO200903001', '2020-09-03', 2, 5, 6, 'keuangan', 'adi', 'barang', 'barang_dagangan', 'cash', 'asdasdadas', 0, 0, '', 0, 0, '2', '1', 'admin', '2020-09-03 07:15:13');

--
-- Trigger `trequiremen`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertrequiremen` BEFORE INSERT ON `trequiremen` FOR EACH ROW BEGIN
  SET new.notrans = generatecodepemesanan(new.tipe);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `trequiremendetail`
--

CREATE TABLE `trequiremendetail` (
  `idrequiremen` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10,0) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `jumlahditerima` int(11) NOT NULL,
  `jumlahsisa` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `diskon` float NOT NULL,
  `ppn` float NOT NULL,
  `akunno` varchar(20) NOT NULL,
  `total` decimal(10,0) NOT NULL,
  `status` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `trequiremendetail`
--

INSERT INTO `trequiremendetail` (`idrequiremen`, `itemid`, `harga`, `jumlah`, `jumlahditerima`, `jumlahsisa`, `subtotal`, `diskon`, `ppn`, `akunno`, `total`, `status`) VALUES
(2, 1, 1800000, 1, 0, 0, 0, 0, 0, '13111', 0, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tretur`
--

CREATE TABLE `tretur` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `fakturid` int(11) DEFAULT NULL,
  `catatan` varchar(255) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` decimal(10,0) DEFAULT '0',
  `ppn` decimal(10,0) DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `tipe` char(1) DEFAULT '1',
  `status` char(1) DEFAULT '1',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Trigger `tretur`
--
DELIMITER $$
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

END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeInsertRetur` BEFORE INSERT ON `tretur` FOR EACH ROW BEGIN

DECLARE varsubtotal, vardiskon, varppn, vartotal DECIMAL;
DECLARE varpemesananid, varkontakid, vargudangid INT;

SELECT gudangid, kontakid
INTO vargudangid, varkontakid
FROM tfaktur WHERE id = new.fakturid;

SET new.kontakid = varkontakid;
SET new.gudangid = vargudangid;
SET new.notrans = generatecoderetur();

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `treturdetail`
--

CREATE TABLE `treturdetail` (
  `idretur` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `jumlahditerima` int(11) DEFAULT NULL,
  `jumlahsisa` int(11) DEFAULT NULL,
  `subtotal` decimal(10,0) DEFAULT '0',
  `diskon` float DEFAULT '0',
  `ppn` float DEFAULT '0',
  `total` decimal(10,0) DEFAULT '0',
  `opsiretur` char(1) DEFAULT '1',
  `alasan` varchar(255) DEFAULT NULL,
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Trigger `treturdetail`
--
DELIMITER $$
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

END
$$
DELIMITER ;
DELIMITER $$
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

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tsaldoawal`
--

CREATE TABLE `tsaldoawal` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `status` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tsaldoawal`
--

INSERT INTO `tsaldoawal` (`id`, `tanggal`, `status`) VALUES
(1, '2019-08-16', '1');

--
-- Trigger `tsaldoawal`
--
DELIMITER $$
CREATE TRIGGER `insertAfterSaldoAwal` AFTER INSERT ON `tsaldoawal` FOR EACH ROW BEGIN
  SET @idsaldoawal = new.id;
  INSERT INTO tsaldoawaldetail (idsaldoawal, noakun, debet, kredit)
  SELECT @idsaldoawal, noakun, 0, 0 FROM mnoakun WHERE stdel = '0';
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tsaldoawaldetail`
--

CREATE TABLE `tsaldoawaldetail` (
  `idsaldoawal` int(11) NOT NULL,
  `noakun` varchar(30) NOT NULL,
  `debet` decimal(10,0) DEFAULT NULL,
  `kredit` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tsaldoawaldetail`
--

INSERT INTO `tsaldoawaldetail` (`idsaldoawal`, `noakun`, `debet`, `kredit`) VALUES
(1, '11', 0, 0),
(1, '111', 0, 0),
(1, '1111', 0, 0),
(1, '1112', 100000000, 0),
(1, '112', 0, 0),
(1, '121', 0, 0),
(1, '1211', 0, 0),
(1, '12111', 0, 0),
(1, '12112', 0, 0),
(1, '1212', 0, 0),
(1, '1213', 0, 0),
(1, '12131', 0, 0),
(1, '131', 0, 0),
(1, '1311', 0, 0),
(1, '13111', 0, 0),
(1, '13112', 0, 0),
(1, '141', 0, 0),
(1, '1411', 0, 0),
(1, '1412', 0, 0),
(1, '151', 0, 0),
(1, '1511', 0, 0),
(1, '15111', 0, 0),
(1, '1512', 0, 0),
(1, '15121', 0, 0),
(1, '1513', 0, 0),
(1, '1514', 0, 0),
(1, '161', 0, 0),
(1, '17', 0, 0),
(1, '171', 0, 0),
(1, '1711', 0, 0),
(1, '21', 0, 0),
(1, '211', 0, 0),
(1, '2111', 0, 0),
(1, '21111', 0, 0),
(1, '2112', 0, 0),
(1, '2113', 0, 0),
(1, '2114', 0, 0),
(1, '212', 0, 0),
(1, '22', 0, 0),
(1, '221', 0, 0),
(1, '2211', 0, 0),
(1, '2212', 0, 0),
(1, '31', 0, 0),
(1, '311', 0, 0),
(1, '3111', 0, 100000000),
(1, '3112', 0, 0),
(1, '312', 0, 0),
(1, '3121', 0, 0),
(1, '41', 0, 0),
(1, '411', 0, 0),
(1, '4111', 0, 0),
(1, '41111', 0, 0),
(1, '41112', 0, 0),
(1, '4112', 0, 0),
(1, '4113', 0, 0),
(1, '4114', 0, 0),
(1, '421', 0, 0),
(1, '4211', 0, 0),
(1, '4212', 0, 0),
(1, '51', 0, 0),
(1, '511', 0, 0),
(1, '5111', 0, 0),
(1, '5112', 0, 0),
(1, '5113', 0, 0),
(1, '51131', 0, 0),
(1, '511311', 0, 0),
(1, '51132', 0, 0),
(1, '5114', 0, 0),
(1, '51141', 0, 0),
(1, '51142', 0, 0),
(1, '521', 0, 0),
(1, '5211', 0, 0),
(1, '5212', 0, 0),
(1, '531', 0, 0),
(1, '5311', 0, 0),
(1, '541', 0, 0),
(1, '551', 0, 0),
(1, '5511', 0, 0),
(1, '5512', 0, 0),
(1, '71', 0, 0),
(1, '18', 0, 0);

--
-- Trigger `tsaldoawaldetail`
--
DELIMITER $$
CREATE TRIGGER `BeforeInsertJurnaldetail_copy1` BEFORE UPDATE ON `tsaldoawaldetail` FOR EACH ROW BEGIN

-- UPDATE tsaldoawal SET totaldebet = new.debet + totaldebet, totalkredit = new.kredit + totalkredit;

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tsetorkaskecil`
--

CREATE TABLE `tsetorkaskecil` (
  `id` int(11) NOT NULL,
  `nokwitansi` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `perusahaan` int(11) NOT NULL,
  `pejabat` int(11) NOT NULL,
  `nominal` decimal(10,0) NOT NULL,
  `kas` int(11) NOT NULL,
  `rekening` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `status` int(11) DEFAULT '0',
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(100) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(100) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(100) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tsetorkaskecil`
--

INSERT INTO `tsetorkaskecil` (`id`, `nokwitansi`, `tanggal`, `perusahaan`, `pejabat`, `nominal`, `kas`, `rekening`, `keterangan`, `status`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, '001/01/KK/2020', '2020-09-27', 6, 5, 100000, 4, 6, 'test2', 0, '0', 'admin', '2020-09-27 17:46:59', 'admin', '2020-09-27 18:24:50', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tstokkeluar`
--

CREATE TABLE `tstokkeluar` (
  `id` int(11) NOT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `tanggalkeluar` date DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `totalharga` decimal(10,0) DEFAULT '0',
  `refid` int(11) DEFAULT NULL,
  `tipe` char(1) DEFAULT '1' COMMENT '1 pengiriman penjualan\r\n2 pengiriman retur\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tstokkeluar`
--
DELIMITER $$
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

END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tstokmasuk`
--

CREATE TABLE `tstokmasuk` (
  `id` int(11) NOT NULL,
  `gudangid` int(11) NOT NULL,
  `tanggalmasuk` date DEFAULT NULL,
  `itemid` int(11) NOT NULL,
  `harga` decimal(10,0) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `keluar` int(11) DEFAULT '0',
  `sisa` int(11) DEFAULT '0',
  `refid` int(11) DEFAULT NULL,
  `tipe` char(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `tstokmasuk`
--

INSERT INTO `tstokmasuk` (`id`, `gudangid`, `tanggalmasuk`, `itemid`, `harga`, `jumlah`, `keluar`, `sisa`, `refid`, `tipe`) VALUES
(1, 5, '2020-03-05', 1, 1800000, 10, 2, 8, 1, '1'),
(2, 5, '2020-03-05', 4, 500000, 2, 0, 2, 3, '1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tstokopname`
--

CREATE TABLE `tstokopname` (
  `id` int(11) NOT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `itemid` int(11) DEFAULT NULL,
  `gudangid` int(11) DEFAULT NULL,
  `kategori` char(1) DEFAULT '1',
  `noakunpenyesuaian` varchar(30) DEFAULT NULL,
  `jumlahsistem` int(11) DEFAULT NULL,
  `jumlahsebenarnya` int(11) DEFAULT NULL,
  `selisih` int(255) DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Trigger `tstokopname`
--
DELIMITER $$
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
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `BeforeInsertStokOpname` BEFORE INSERT ON `tstokopname` FOR EACH ROW BEGIN
  SET new.notrans = generatecodestokopname();
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `viewitem`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `viewitem` (
`id` int(11)
,`kode` varchar(20)
,`nama` varchar(255)
,`satuanid` int(11)
,`kategoriid` int(11)
,`hargabeli` decimal(10,0)
,`hargajual` decimal(10,0)
,`hargabeliterakhir` decimal(10,0)
,`noakunbeli` varchar(20)
,`noakunjual` varchar(20)
,`noakunpersediaan` varchar(20)
,`noakunpajak` varchar(20)
,`noakunpajakmasukan` varchar(20)
,`noakunpajakkeluaran` varchar(20)
,`gambar` varchar(100)
,`stdel` char(1)
,`cby` varchar(100)
,`cdate` datetime
,`uby` varchar(100)
,`udate` datetime
,`dby` varchar(255)
,`ddate` datetime
,`satuan` varchar(100)
,`kategori` varchar(100)
,`stok` decimal(32,0)
,`totalpersediaan` decimal(42,0)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `viewjurnaldetail`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `viewjurnaldetail` (
`id` int(11)
,`tanggalwaktu` datetime
,`tanggal` varchar(10)
,`keterangan` varchar(255)
,`noakuntop` varchar(11)
,`noakunheader` varchar(255)
,`noakun` varchar(30)
,`namaakun` varchar(255)
,`debet` decimal(10,0)
,`kredit` decimal(10,0)
,`stdebet` char(1)
,`tipe` varchar(1)
);

-- --------------------------------------------------------

--
-- Stand-in struktur untuk tampilan `viewmemo`
-- (Lihat di bawah untuk tampilan aktual)
--
CREATE TABLE `viewmemo` (
`id` int(11)
,`notrans` varchar(20)
,`kontakid` int(11)
,`nama` varchar(60)
,`tipememo` varchar(255)
,`tipekontak` char(1)
,`refid` int(11)
,`debet` decimal(10,0)
,`kredit` decimal(10,0)
,`saldo` decimal(33,0)
);

-- --------------------------------------------------------

--
-- Struktur dari tabel `viewstokakhirbarang`
--

CREATE TABLE `viewstokakhirbarang` (
  `id` int(11) DEFAULT NULL,
  `kode` varchar(20) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `satuan` varchar(100) DEFAULT NULL,
  `kategori` varchar(100) DEFAULT NULL,
  `stok` decimal(32,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `view_laporan_utang_piutang`
--

CREATE TABLE `view_laporan_utang_piutang` (
  `tipe` char(1) DEFAULT NULL,
  `idfaktur` int(11) DEFAULT NULL,
  `notrans` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `namaakun` varchar(255) DEFAULT NULL,
  `kontakid` int(11) DEFAULT NULL,
  `kontak` varchar(60) DEFAULT NULL,
  `total` decimal(10,0) DEFAULT NULL,
  `totaldibayar` decimal(10,0) DEFAULT NULL,
  `sisatagihan` decimal(10,0) DEFAULT NULL,
  `status` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `z_menu`
--

CREATE TABLE `z_menu` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `z_menu`
--

INSERT INTO `z_menu` (`id`, `name`, `url`, `stdel`) VALUES
(1, 'Dashboard', 'dashboard', '0'),
(2, 'Item', 'item', '0'),
(3, 'Kategori', 'kategori', '0'),
(4, 'Satuan', 'satuan', '0'),
(5, 'Gudang', 'gudang', '0'),
(6, 'Kontak', 'kontak', '0'),
(7, 'User', 'user', '0'),
(8, 'Akses', 'user_akses', '0'),
(9, 'Hak Akses', 'user_hak_akses', '0'),
(10, 'Pemesanan Pembelian', 'pemesanan_pembelian', '0'),
(11, 'Penerimaan Pembelian', 'penerimaan_pembelian', '0'),
(12, 'Faktur Pembelian', 'faktur_pembelian', '0'),
(13, 'Pembayaran Pembelian', 'pembayaran_pembelian', '0'),
(14, 'Retur Pembelian', 'retur_pembelian', '0'),
(15, 'Pemesanan Penjualan', 'pemesanan_penjualan', '0'),
(16, 'Penerimaan Penjualan', 'penerimaan_penjualan', '0'),
(17, 'Faktur Penjualan', 'faktur_penjualan', '0'),
(18, 'Pembayaran Penjualan', 'pembayaran_penjualan', '0'),
(19, 'Retur Penjualan', 'retur_penjualan', '0'),
(20, 'Memo', 'memo', '0'),
(21, 'Stock Opname', 'stokopname', '0'),
(22, 'Laporan Pembelian', 'laporan_pembelian', '0'),
(23, 'Laporan Penjualan', 'laporan_penjualan', '0'),
(24, 'Laporan Retur', 'laporan_retur_pembelian', '0'),
(25, 'Laporan Stok', 'laporan_stok', '0'),
(26, 'Laporan Stok Akhir Barang', 'laporan_stok_akhir_barang', '0'),
(27, 'Saldo Awal', 'saldo_awal', '0'),
(28, 'Nomor Akun', 'noakun', '0'),
(29, 'Pengeluaran Kas', 'pengeluaran_kas', '0'),
(30, 'Utang Usaha', 'utang', '0'),
(31, 'Piutang Usaha', 'piutang', '0'),
(32, 'Jurnal Umum', 'jurnal', '0'),
(33, 'Buku Besar', 'buku_besar', '0'),
(34, 'Neraca Saldo', 'neraca_saldo', '0'),
(35, 'Jurnal Penyesuaian', 'jurnal_penyesuaian', '0'),
(36, 'Neraca Saldo Penyesuaian', 'neraca_saldo_penyesuaian', '0'),
(37, 'Laba Rugi', 'laba_rugi', '0'),
(38, 'Perubahan Modal', 'perubahan_modal', '0'),
(39, 'Neraca', 'neraca', '0'),
(40, 'Pemetaan Akun', 'metaakun', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `z_module`
--

CREATE TABLE `z_module` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `z_module`
--

INSERT INTO `z_module` (`id`, `name`, `url`, `stdel`) VALUES
(1, 'Dashboard', 'dashboard', '0'),
(2, 'Item', 'item', '0'),
(3, 'Gudang', 'gudang', '0'),
(4, 'Nomor Akun', 'akun', '0');

-- --------------------------------------------------------

--
-- Struktur dari tabel `z_user`
--

CREATE TABLE `z_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `permissionid` int(11) DEFAULT NULL,
  `bahasaid` int(11) DEFAULT '1',
  `cabangid` int(11) DEFAULT NULL,
  `stban` char(1) DEFAULT '0',
  `stdel` char(1) DEFAULT '0',
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `uby` varchar(255) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `dby` varchar(255) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `z_user`
--

INSERT INTO `z_user` (`id`, `name`, `email`, `username`, `password`, `permissionid`, `bahasaid`, `cabangid`, `stban`, `stdel`, `cby`, `cdate`, `uby`, `udate`, `dby`, `ddate`) VALUES
(1, 'premium', 'pria.savic@gmail.com', 'admin', '21232f297a57a5a743894a0e4a801fc3', 1, 1, 1, '0', '0', NULL, NULL, 'admin', '2020-08-20 14:23:26', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `z_userpermission`
--

CREATE TABLE `z_userpermission` (
  `id` int(11) NOT NULL,
  `name` varchar(32) DEFAULT NULL,
  `stdel` char(1) DEFAULT '0',
  `uby` varchar(255) DEFAULT NULL,
  `udate` datetime DEFAULT NULL,
  `cby` varchar(255) DEFAULT NULL,
  `cdate` datetime DEFAULT NULL,
  `dby` varchar(255) DEFAULT NULL,
  `ddate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `z_userpermission`
--

INSERT INTO `z_userpermission` (`id`, `name`, `stdel`, `uby`, `udate`, `cby`, `cdate`, `dby`, `ddate`) VALUES
(1, 'Super Admin', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'Operator', '0', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'Kasir', '0', 'admin', '2020-02-29 21:56:53', 'admin', '2020-02-29 19:47:27', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `z_userpermissiondetail`
--

CREATE TABLE `z_userpermissiondetail` (
  `idpermission` int(11) NOT NULL,
  `menuid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data untuk tabel `z_userpermissiondetail`
--

INSERT INTO `z_userpermissiondetail` (`idpermission`, `menuid`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(2, 1),
(3, 1),
(3, 10),
(3, 11),
(3, 12);

-- --------------------------------------------------------

--
-- Struktur untuk view `laporanstok`
--
DROP TABLE IF EXISTS `laporanstok`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fa165esq`@`localhost` SQL SECURITY DEFINER VIEW `laporanstok`  AS  select `tstokmasuk`.`tanggalmasuk` AS `tanggal`,`tstokmasuk`.`itemid` AS `itemid`,`mitem`.`nama` AS `namaitem`,`tstokmasuk`.`jumlah` AS `jumlah`,'1' AS `jenis`,(case when (`tstokmasuk`.`tipe` = '1') then 'Pembelian' else 'Retur Penjualan' end) AS `keterangan`,`tstokmasuk`.`refid` AS `refid`,`tstokmasuk`.`gudangid` AS `gudangid`,`tstokmasuk`.`tipe` AS `tipe`,`mgudang`.`nama` AS `namagudang` from ((`tstokmasuk` left join `mitem` on((`tstokmasuk`.`itemid` = `mitem`.`id`))) left join `mgudang` on((`tstokmasuk`.`gudangid` = `mgudang`.`id`))) union all select `tstokkeluar`.`tanggalkeluar` AS `tanggalkeluar`,`tstokkeluar`.`itemid` AS `itemid`,`mitem`.`nama` AS `namaitem`,`tstokkeluar`.`jumlah` AS `jumlah`,'2' AS `jenis`,(case when (`tstokkeluar`.`tipe` = '1') then 'Penjualan' else 'Retur Pembelian' end) AS `keterangan`,`tstokkeluar`.`refid` AS `refid`,`tstokkeluar`.`gudangid` AS `gudangid`,`tstokkeluar`.`tipe` AS `tipe`,`mgudang`.`nama` AS `nama` from ((`tstokkeluar` left join `mitem` on((`tstokkeluar`.`itemid` = `mitem`.`id`))) left join `mgudang` on((`tstokkeluar`.`gudangid` = `mgudang`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `viewitem`
--
DROP TABLE IF EXISTS `viewitem`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fa165esq`@`localhost` SQL SECURITY DEFINER VIEW `viewitem`  AS  select `mitem`.`id` AS `id`,`mitem`.`kode` AS `kode`,`mitem`.`nama` AS `nama`,`mitem`.`satuanid` AS `satuanid`,`mitem`.`kategoriid` AS `kategoriid`,`mitem`.`hargabeli` AS `hargabeli`,`mitem`.`hargajual` AS `hargajual`,`mitem`.`hargabeliterakhir` AS `hargabeliterakhir`,`mitem`.`noakunbeli` AS `noakunbeli`,`mitem`.`noakunjual` AS `noakunjual`,`mitem`.`noakunpersediaan` AS `noakunpersediaan`,`mitem`.`noakunpajak` AS `noakunpajak`,`mitem`.`noakunpajakmasukan` AS `noakunpajakmasukan`,`mitem`.`noakunpajakkeluaran` AS `noakunpajakkeluaran`,`mitem`.`gambar` AS `gambar`,`mitem`.`stdel` AS `stdel`,`mitem`.`cby` AS `cby`,`mitem`.`cdate` AS `cdate`,`mitem`.`uby` AS `uby`,`mitem`.`udate` AS `udate`,`mitem`.`dby` AS `dby`,`mitem`.`ddate` AS `ddate`,`msatuan`.`nama` AS `satuan`,`mkategori`.`nama` AS `kategori`,(select coalesce(sum(`tstokmasuk`.`sisa`),0) from `tstokmasuk` where (`tstokmasuk`.`itemid` = `mitem`.`id`)) AS `stok`,((select coalesce(sum(`tstokmasuk`.`sisa`),0) from `tstokmasuk` where (`tstokmasuk`.`itemid` = `mitem`.`id`)) * `mitem`.`hargabeliterakhir`) AS `totalpersediaan` from ((`mitem` left join `msatuan` on((`mitem`.`satuanid` = `msatuan`.`id`))) left join `mkategori` on((`mitem`.`kategoriid` = `mkategori`.`id`))) ;

-- --------------------------------------------------------

--
-- Struktur untuk view `viewjurnaldetail`
--
DROP TABLE IF EXISTS `viewjurnaldetail`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fa165esq`@`localhost` SQL SECURITY DEFINER VIEW `viewjurnaldetail`  AS  select NULL AS `id`,`tsaldoawal`.`tanggal` AS `tanggalwaktu`,date_format(`tsaldoawal`.`tanggal`,'%Y-%m-%d') AS `tanggal`,'Saldo Awal' AS `keterangan`,`mnoakun`.`noakuntop` AS `noakuntop`,`mnoakun`.`noakunheader` AS `noakunheader`,`tsaldoawaldetail`.`noakun` AS `noakun`,`mnoakun`.`namaakun` AS `namaakun`,`tsaldoawaldetail`.`debet` AS `debet`,`tsaldoawaldetail`.`kredit` AS `kredit`,`mnoakun`.`stdebet` AS `stdebet`,'0' AS `tipe` from ((`tsaldoawaldetail` join `mnoakun` on((`tsaldoawaldetail`.`noakun` = convert(`mnoakun`.`noakun` using utf8mb4)))) join `tsaldoawal` on((`tsaldoawaldetail`.`idsaldoawal` = `tsaldoawal`.`id`))) where ((`tsaldoawaldetail`.`debet` > 0) or (`tsaldoawaldetail`.`kredit` > 0)) union all select `tjurnal`.`id` AS `id`,`tjurnal`.`tanggal` AS `tanggalwaktu`,date_format(`tjurnal`.`tanggal`,'%Y-%m-%d') AS `tanggal`,`tjurnal`.`keterangan` AS `keterangan`,`mnoakun`.`noakuntop` AS `noakuntop`,`mnoakun`.`noakunheader` AS `noakunheader`,`mnoakun`.`noakun` AS `noakun`,`mnoakun`.`namaakun` AS `namaakun`,`tjurnaldetail`.`debet` AS `debet`,`tjurnaldetail`.`kredit` AS `kredit`,`mnoakun`.`stdebet` AS `stdebet`,`tjurnal`.`tipe` AS `tipe` from ((`tjurnaldetail` join `mnoakun` on((`tjurnaldetail`.`noakun` = convert(`mnoakun`.`noakun` using utf8mb4)))) join `tjurnal` on((`tjurnaldetail`.`idjurnal` = `tjurnal`.`id`))) where (`tjurnal`.`status` = '1') ;

-- --------------------------------------------------------

--
-- Struktur untuk view `viewmemo`
--
DROP TABLE IF EXISTS `viewmemo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`fa165esq`@`localhost` SQL SECURITY DEFINER VIEW `viewmemo`  AS  select `tmemo`.`id` AS `id`,`tmemo`.`notrans` AS `notrans`,`tmemo`.`kontakid` AS `kontakid`,`mkontak`.`nama` AS `nama`,`tmemo`.`tipe` AS `tipememo`,`mkontak`.`tipe` AS `tipekontak`,`tmemo`.`refid` AS `refid`,`tmemo`.`debet` AS `debet`,`tmemo`.`kredit` AS `kredit`,(case when (`tmemo`.`tipe` = '1') then sum((`tmemo`.`debet` - `tmemo`.`kredit`)) else sum((`tmemo`.`kredit` - `tmemo`.`debet`)) end) AS `saldo` from (`tmemo` join `mkontak` on((`mkontak`.`id` = `tmemo`.`kontakid`))) group by `tmemo`.`kontakid`,`tmemo`.`tipe` ;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `mbahasadetail`
--
ALTER TABLE `mbahasadetail`
  ADD PRIMARY KEY (`idbahasa`,`kode`) USING BTREE;

--
-- Indeks untuk tabel `mgudang`
--
ALTER TABLE `mgudang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mitem`
--
ALTER TABLE `mitem`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mjasa`
--
ALTER TABLE `mjasa`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mkontak`
--
ALTER TABLE `mkontak`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `mnoakun`
--
ALTER TABLE `mnoakun`
  ADD PRIMARY KEY (`idakun`);

--
-- Indeks untuk tabel `mpajak`
--
ALTER TABLE `mpajak`
  ADD PRIMARY KEY (`id_pajak`);

--
-- Indeks untuk tabel `mperusahaan`
--
ALTER TABLE `mperusahaan`
  ADD PRIMARY KEY (`idperusahaan`);

--
-- Indeks untuk tabel `mrekening`
--
ALTER TABLE `mrekening`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tanggaranbelanja`
--
ALTER TABLE `tanggaranbelanja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tanggaranbelanjadetail`
--
ALTER TABLE `tanggaranbelanjadetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tbudgetevent`
--
ALTER TABLE `tbudgetevent`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tfaktur`
--
ALTER TABLE `tfaktur`
  ADD PRIMARY KEY (`nomor`);

--
-- Indeks untuk tabel `tfakturdetail`
--
ALTER TABLE `tfakturdetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tfakturpenjualan`
--
ALTER TABLE `tfakturpenjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tjurnalpenjualan`
--
ALTER TABLE `tjurnalpenjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tkasbank`
--
ALTER TABLE `tkasbank`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemesanan`
--
ALTER TABLE `tpemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemesananangsuran`
--
ALTER TABLE `tpemesananangsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemesanandetail`
--
ALTER TABLE `tpemesanandetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemesananpenjualan`
--
ALTER TABLE `tpemesananpenjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemesananpenjualanangsuran`
--
ALTER TABLE `tpemesananpenjualanangsuran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemesananpenjualandetail`
--
ALTER TABLE `tpemesananpenjualandetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpemindahbukuankaskecil`
--
ALTER TABLE `tpemindahbukuankaskecil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpengajuankaskecil`
--
ALTER TABLE `tpengajuankaskecil`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpengeluarankaskecil`
--
ALTER TABLE `tpengeluarankaskecil`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `tpengeluarankaskecildetail`
--
ALTER TABLE `tpengeluarankaskecildetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpengirimandet`
--
ALTER TABLE `tpengirimandet`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpengirimandetail`
--
ALTER TABLE `tpengirimandetail`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tpengirimanpenjualan`
--
ALTER TABLE `tpengirimanpenjualan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tsetorkaskecil`
--
ALTER TABLE `tsetorkaskecil`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `mgudang`
--
ALTER TABLE `mgudang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `mnoakun`
--
ALTER TABLE `mnoakun`
  MODIFY `idakun` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=803;

--
-- AUTO_INCREMENT untuk tabel `tbudgetevent`
--
ALTER TABLE `tbudgetevent`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tfaktur`
--
ALTER TABLE `tfaktur`
  MODIFY `nomor` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tfakturdetail`
--
ALTER TABLE `tfakturdetail`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `tfakturpenjualan`
--
ALTER TABLE `tfakturpenjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `tjurnalpenjualan`
--
ALTER TABLE `tjurnalpenjualan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT untuk tabel `tkasbank`
--
ALTER TABLE `tkasbank`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT untuk tabel `tpemindahbukuankaskecil`
--
ALTER TABLE `tpemindahbukuankaskecil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `tpengajuankaskecil`
--
ALTER TABLE `tpengajuankaskecil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT untuk tabel `tpengeluarankaskecil`
--
ALTER TABLE `tpengeluarankaskecil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT untuk tabel `tpengeluarankaskecildetail`
--
ALTER TABLE `tpengeluarankaskecildetail`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tpengirimandet`
--
ALTER TABLE `tpengirimandet`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `tpengirimandetail`
--
ALTER TABLE `tpengirimandetail`
  MODIFY `id` int(191) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tsetorkaskecil`
--
ALTER TABLE `tsetorkaskecil`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
