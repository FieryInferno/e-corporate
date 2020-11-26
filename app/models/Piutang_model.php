<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang_model extends CI_Model {

	private $table	= 'SaldoAwalPiutang';
	private $perusahaan;
	private $tanggalAwal;
	private $tanggalAkhir;
	private $kontak;


	public function get() {
		$this->db->select($this->table . '.tanggal, ' . $this->table . '.tanggalTempo, '  . $this->table . '.noInvoice, ' . $this->table . '.deskripsi, ' . $this->table . '.namaPelanggan, ' . $this->table . '.primeOwing, ' . $this->table . '.idSaldoAwalPiutang, mperusahaan.nama_perusahaan, mnoakun.idakun, mnoakun.namaakun, mnoakun.akunno, mperusahaan.kode');
		$this->db->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
		$this->db->join('mnoakun', $this->table . '.akun = mnoakun.idakun');
		if ($this->perusahaan) {
			$this->db->where('perusahaan', $this->perusahaan);
		}
		if ($this->kontak) {
			$this->db->like('namaPelanggan', $this->kontak);
		}
		if ($this->tanggalAwal) {
			$this->db->where('SaldoAwalPiutang.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
		}
		$get	= $this->db->get($this->table);
		return $get->result_array();
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}
}

