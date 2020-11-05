<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajakModel extends CI_Model {

	private	$tabel	= 'tfakturpenjualan';
	private	$tabel1	= 'pajakPemesananPenjualan';
	private $idPajakPemesananPenjualan;

	public function indexDatatables()
	{
		$this->load->library('Datatables');
		$this->datatables->select($this->tabel . '.noSSP, ' . $this->tabel . '.tanggal, mpajak.nama_pajak,' . $this->tabel . '.notrans, mperusahaan.nama_perusahaan, pajakPemesananPenjualan.nominal, pajakPemesananPenjualan.idPajakPemesananPenjualan');
		$this->datatables->join('tpengirimanpenjualan', $this->tabel . '.pengirimanid = tpengirimanpenjualan.id');
		$this->datatables->join('tpengirimanpenjualandetail', 'tpengirimanpenjualan.id = tpengirimanpenjualandetail.idpengiriman');
		$this->datatables->join('tpemesananpenjualandetail', 'tpengirimanpenjualandetail.idpenjualdetail = tpemesananpenjualandetail.id');
		$this->datatables->join('pajakPemesananPenjualan', 'tpemesananpenjualandetail.id = pajakPemesananPenjualan.idDetailPemesananPenjualan');
		$this->datatables->join('mpajak', 'pajakPemesananPenjualan.idPajak = mpajak.id_pajak');
		$this->datatables->join('mperusahaan', $this->tabel . '.idperusahaan = mperusahaan.idperusahaan');
		$this->datatables->from($this->tabel);
		return $this->datatables->generate();
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

	public function get()
	{
		$this->db->select($this->tabel . '.notrans, ' . $this->tabel . '.tanggal, mkontak.nama as kontak, mgudang.nama as gudang, ' . $this->tabel . '.catatan, ' . $this->tabel . '.subtotal, ' . $this->tabel . '.diskon, ' . $this->tabel . '.totalretur, ' . $this->tabel . '.totalkreditmemo, ' . $this->tabel . '.ppn, ' . $this->tabel . '.biaya_pengiriman, ' . $this->tabel . '.total,'  . $this->tabel . '.totaldibayar, ' . $this->tabel . '.sisatagihan');
		$this->db->join('tpemesananpenjualandetail', $this->tabel1 . '.idDetailPemesananPenjualan = tpemesananpenjualandetail.id');
		$this->db->join('tpengirimanpenjualandetail', 'tpemesananpenjualandetail.id = tpengirimanpenjualandetail.idpenjualdetail');
		$this->db->join('tpengirimanpenjualan', 'tpengirimanpenjualandetail.idpengiriman = tpengirimanpenjualan.id');
		$this->db->join($this->tabel, $this->tabel . '.pengirimanid = tpengirimanpenjualan.id');
		$this->db->join('mkontak', $this->tabel . '.kontakid = mkontak.id');
		$this->db->join('mgudang', $this->tabel . '.gudangid = mgudang.id');
		$this->db->where('idPajakPemesananPenjualan', $this->idPajakPemesananPenjualan);
		return $this->db->get($this->tabel1)->row_array();
	}
}