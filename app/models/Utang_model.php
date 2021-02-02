<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utang_model extends CI_Model {

	private $kontak;
	private $table	= 'SaldoAwalHutang';
	private $table0	= 'tfaktur';
	private $perusahaan;
	private $tanggal;
	private $tanggalAwal;
	private $tanggalAkhir;

	public function get_count_utang($tanggalawal, $tanggalakhir, $kontakid) {
		$this->db->where('view_laporan_utang_piutang.tanggal >=', $tanggalawal);
		$this->db->where('view_laporan_utang_piutang.tanggal <=', $tanggalakhir);
		if($kontakid) $this->db->where('view_laporan_utang_piutang.kontakid', $kontakid);
		$this->db->where('view_laporan_utang_piutang.tipe', '1');
		$get = $this->db->count_all_results('view_laporan_utang_piutang');
		return $get;
	}

	public function getSaldoAwal() {
    $this->load->library('Datatables');
    $this->datatables->select('SaldoAwalHutang.tanggal, ' . 'SaldoAwalHutang.tanggaltempo, ' . 'SaldoAwalHutang.noInvoice as notrans, ' . 'SaldoAwalHutang.deskripsi as catatan, ' . 'SaldoAwalHutang.namaPemasok as rekanan, ' . 'SaldoAwalHutang.primeOwing as total, ' . 'SaldoAwalHutang.idSaldoAwalHutang as id, mperusahaan.nama_perusahaan, mnoakun.idakun, mnoakun.namaakun, mnoakun.akunno, mperusahaan.kode');
    $this->datatables->join('mperusahaan', 'SaldoAwalHutang.perusahaan = mperusahaan.idperusahaan');
    $this->datatables->join('mnoakun', 'SaldoAwalHutang.akun = mnoakun.idakun');
    // if ($this->perusahaan) {
      $this->datatables->where('SaldoAwalHutang.perusahaan', $this->perusahaan);
    // }
    if ($this->tanggalAwal) {
      $this->datatables->where('SaldoAwalHutang.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
    }
    if ($this->kontak) {
      $this->datatables->like('SaldoAwalHutang.namaPemasok', $this->kontak);
    }
    $this->datatables->from('SaldoAwalHutang');
    return $this->datatables->generate();
  }
  
  public function getFaktur()
  {
    $this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id');
    $this->db->join('mperusahaan', 'tfaktur.perusahaanid = mperusahaan.idperusahaan');
    $this->db->join('tfakturdetail', 'tfaktur.id = tfakturdetail.idfaktur');
    $this->db->join('tpemesanandetail', 'tfakturdetail.itemid = tpemesanandetail.id');
    $this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
    $this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
    $this->db->join('tpemesanan', 'tpemesanandetail.idpemesanan = tpemesanan.id');
    $this->db->where('tpemesanan.cara_pembayaran', 'credit');
    $this->db->where('tfaktur.sisatagihan >', 0);
    if ($this->perusahaan) {
      $this->db->where('tfaktur.perusahaanid', $this->perusahaan);
    }
    if ($this->tanggalAwal) {
      $this->db->where('tfaktur.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
    }
    if ($this->kontak) {
      $this->db->like('mkontak.nama', $this->kontak);
    }
    $sql        = $this->db->get('tfaktur');
    $sql_count  = $sql->num_rows();
    $query      = 'tfaktur';
    $sql_filter       = $this->db->query("SELECT * FROM ".$query);
    $sql_filter_count = $sql_filter->num_rows();

    $callback = array(    
        'draw'            => 0, 
        'recordsTotal'    => $sql_count,    
        'recordsFiltered' => $sql_count,    
        'data'            => $sql->result_array()
    );
    return $callback;
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
  
  public function get($jenis)
  {
    switch ($jenis) {
      case 'saldoAwal':
        $this->db->select('SaldoAwalHutang.tanggal, ' . 'SaldoAwalHutang.tanggaltempo, ' . 'SaldoAwalHutang.noInvoice as notrans, ' . 'SaldoAwalHutang.deskripsi as catatan, ' . 'SaldoAwalHutang.namaPemasok as rekanan, ' . 'SaldoAwalHutang.primeOwing as total, ' . 'SaldoAwalHutang.idSaldoAwalHutang as id, mperusahaan.nama_perusahaan, mnoakun.idakun, mnoakun.namaakun, mnoakun.akunno, mperusahaan.kode');
        $this->db->join('mperusahaan', 'SaldoAwalHutang.perusahaan = mperusahaan.idperusahaan');
        $this->db->join('mnoakun', 'SaldoAwalHutang.akun = mnoakun.idakun');
        if ($this->perusahaan) {
          $this->db->where('SaldoAwalHutang.perusahaan', $this->perusahaan);
        }
        if ($this->tanggalAwal) {
          $this->db->where('SaldoAwalHutang.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
        }
        if ($this->kontak && $this->kontak !== 'semua') {
          $this->db->like('SaldoAwalHutang.namaPemasok', $this->kontak);
        }
        return $this->db->get('SaldoAwalHutang')->result_array();
        break;
      case 'faktur':
        $this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id');
        $this->db->join('mperusahaan', 'tfaktur.perusahaanid = mperusahaan.idperusahaan');
        $this->db->join('tfakturdetail', 'tfaktur.id = tfakturdetail.idfaktur');
        $this->db->join('tpemesanandetail', 'tfakturdetail.itemid = tpemesanandetail.id');
        $this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
        $this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
        $this->db->join('tpemesanan', 'tpemesanandetail.idpemesanan = tpemesanan.id');
        $this->db->where('tpemesanan.cara_pembayaran', 'credit');
        $this->db->where('tfaktur.sisatagihan >', 0);
        if ($this->perusahaan) {
          $this->db->where('tfaktur.perusahaanid', $this->perusahaan);
        }
        if ($this->tanggalAwal) {
          $this->db->where('tfaktur.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
        }
        if ($this->kontak && $this->kontak !== 'semua') {
          $this->db->like('mkontak.nama', $this->kontak);
        }
        return $this->db->get('tfaktur')->result_array();
        break;
      
      default:
        # code...
        break;
    }
  }
}

