<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utang_model extends CI_Model {

	private $kontakid;
	private $table	= 'SaldoAwalHutang';
	private $table0	= 'tfaktur';
	private $perusahaan;
	private $tanggal;

	public function get_count_utang($tanggalawal, $tanggalakhir, $kontakid) {
		$this->db->where('view_laporan_utang_piutang.tanggal >=', $tanggalawal);
		$this->db->where('view_laporan_utang_piutang.tanggal <=', $tanggalakhir);
		if($kontakid) $this->db->where('view_laporan_utang_piutang.kontakid', $kontakid);
		$this->db->where('view_laporan_utang_piutang.tipe', '1');
		$get = $this->db->count_all_results('view_laporan_utang_piutang');
		return $get;
	}

	public function get($jenis) {
		switch ($jenis) {
			case 'saldoAwal':
				$this->db->select($this->table . '.tanggal, ' . $this->table . '.tanggaltempo, ' . $this->table . '.noInvoice as notrans, ' . $this->table . '.deskripsi as catatan, ' . $this->table . '.namaPemasok as rekanan, ' . $this->table . '.primeOwing as total, ' . $this->table . '.idSaldoAwalHutang as id, mperusahaan.nama_perusahaan, mnoakun.idakun, mnoakun.namaakun, mnoakun.akunno, mperusahaan.kode');
				$this->db->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
				$this->db->join('mnoakun', $this->table . '.akun = mnoakun.idakun');
				if ($this->perusahaan) {
					$this->db->where($this->table . '.perusahaan', $this->perusahaan);
				}
				if ($this->tanggalAwal) {
					$this->db->where($this->table . '.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
				}
				if ($this->kontak) {
					$this->db->like($this->table . '.namaPemasok', $this->kontak);
				}
				return $this->db->get($this->table)->result_array();
				break;
			case 'faktur':
				$this->db->select($this->table0 . '.tanggal, ' . $this->table0 . '.tanggaltempo, ' . $this->table0 . '.notrans, ' . $this->table0 . '.catatan, mkontak.nama as rekanan, ' . $this->table0 . '.total, ' . $this->table0 . '.totaldibayar, (' . $this->table0 . '.total - ' . $this->table0 . '.totaldibayar) as sisaUtang, ' . $this->table0 . '.id, mperusahaan.nama_perusahaan, mnoakun.idakun, mnoakun.namaakun, mnoakun.akunno, mperusahaan.kode');
				$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id');
				$this->db->join('mperusahaan', $this->table0 . '.perusahaanid = mperusahaan.idperusahaan');
				$this->db->join('tfakturdetail', $this->table0 . '.id = tfakturdetail.idfaktur');
				$this->db->join('tpemesanandetail', 'tfakturdetail.itemid = tpemesanandetail.id');
				$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
				$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				$this->db->join('tpemesanan', 'tpemesanandetail.idpemesanan = tpemesanan.id');
				$this->db->where('tpemesanan.cara_pembayaran', 'credit');
				$this->db->where('tfaktur.sisatagihan >', 0);
				if ($this->perusahaan) {
					$this->db->where($this->table0 . '.perusahaanid', $this->perusahaan);
				}
				if ($this->tanggalAwal) {
					$this->db->where($this->table0 . '.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
				}
				if ($this->kontak) {
					$this->db->like('mkontak.nama', $this->kontak);
				}
				return $this->db->get($this->table0)->result_array();
				break;
			
			default:
				# code...
				break;
		}
	}

	public function get_utang_print($tanggalawal, $tanggalakhir, $kontakid) {
		$this->db->select('view_laporan_utang_piutang.*');
		$this->db->where('view_laporan_utang_piutang.tanggal >=', $tanggalawal);
		$this->db->where('view_laporan_utang_piutang.tanggal <=', $tanggalakhir);
		if($kontakid) $this->db->where('view_laporan_utang_piutang.kontakid', $kontakid);
		$this->db->where('view_laporan_utang_piutang.tipe', '1');
		$this->db->order_by('view_laporan_utang_piutang.idfaktur', 'desc');
		$get = $this->db->get('view_laporan_utang_piutang');
		return $get->result_array();
	}

	public function set($jenis = null, $isi = null)
	{
		$this->$jenis	= $isi;
	}
}

