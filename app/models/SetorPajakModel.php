<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajakModel extends CI_Model {

	private	$tabel	= 'tfakturpenjualan';
	private	$tabel1	= 'pajakPemesananPenjualan';
	private $idPajakPemesananPenjualan;
	private $jenis;
	private $npwp;
	private $ntpn;
	private $perushaaan;
	private $tanggal;


	public function indexDatatables()
	{
		$this->load->library('Datatables');
		$this->datatables->select($this->tabel . '.noSSP, ' . $this->tabel . '.tanggal, mpajak.nama_pajak,' . $this->tabel . '.notrans, mperusahaan.nama_perusahaan, pajakPemesananPenjualan.nominal, pajakPemesananPenjualan.idPajakPemesananPenjualan, ' . $this->tabel1 . '.npwp, ' . $this->tabel1 . '.ntpn');
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
		if ($this->jenis) {
			$this->db->select($this->tabel1 . '.' . $this->jenis);
		} else {
			$this->db->select($this->tabel . '.notrans, ' . $this->tabel . '.tanggal, mkontak.nama as kontak, mgudang.nama as gudang, ' . $this->tabel . '.catatan, ' . $this->tabel . '.subtotal, ' . $this->tabel . '.diskon, ' . $this->tabel . '.totalretur, ' . $this->tabel . '.totalkreditmemo, ' . $this->tabel . '.ppn, ' . $this->tabel . '.biaya_pengiriman, ' . $this->tabel . '.total,'  . $this->tabel . '.totaldibayar, ' . $this->tabel . '.sisatagihan, mitem.nama as item, tpemesananpenjualandetail.harga, tpemesananpenjualandetail.jumlah, tpemesananpenjualandetail.subtotal, mnoakun.akunno, tpemesananpenjualandetail.total, mpajak.nama_pajak, makunPajak.akunno as akunPajak, makunPajak.namaakun as namaAkunPajak, ' . $this->tabel1 . '.nominal, ' . $this->tabel1 . '.idPajakPemesananPenjualan, ' . $this->tabel1 . '.npwp, ' . $this->tabel1 . '.ntpn, ' . $this->tabel1 . '.pengurangan, makunPajak.idakun as idAkunPajak, ' . $this->tabel . '.noSSP, mdepartemen.nama as namaDepartemen, ' . $this->tabel1 . '.idPajakPemesananPenjualan, mperusahaan.kode, mrekening.id as idRekening, mrekening.nama as namaRekening, mrekening.norek');
		}
		$this->db->join('tpemesananpenjualandetail', $this->tabel1 . '.idDetailPemesananPenjualan = tpemesananpenjualandetail.id');
		$this->db->join('tpengirimanpenjualandetail', 'tpemesananpenjualandetail.id = tpengirimanpenjualandetail.idpenjualdetail');
		$this->db->join('tpengirimanpenjualan', 'tpengirimanpenjualandetail.idpengiriman = tpengirimanpenjualan.id');
		$this->db->join($this->tabel, $this->tabel . '.pengirimanid = tpengirimanpenjualan.id');
		$this->db->join('mkontak', $this->tabel . '.kontakid = mkontak.id');
		$this->db->join('mgudang', $this->tabel . '.gudangid = mgudang.id', 'left');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id');
		$this->db->join('mnoakun', 'tpemesananpenjualandetail.akunno = mnoakun.idakun', 'left');
		$this->db->join('mpajak', $this->tabel1 . '.idPajak = mpajak.id_pajak');
		$this->db->join('mnoakun as makunPajak', 'mpajak.akun = makunPajak.idakun', 'left');
		$this->db->join('mdepartemen', 'tfakturpenjualan.departemen = mdepartemen.id');
		$this->db->join('mperusahaan', 'tfakturpenjualan.idperusahaan = mperusahaan.idperusahaan');
		$this->db->join('mrekening', 'tfakturpenjualan.rekening = mrekening.id');
		if ($this->idPajakPemesananPenjualan) {
			$this->db->where('idPajakPemesananPenjualan', $this->idPajakPemesananPenjualan);
		}
		if ($this->perusahaan) {
			$this->db->where($this->tabel . '.idperusahaan', $this->perusahaan);
		}
		if ($this->tanggal) {
			$this->db->where($this->tabel . '.tanggal <=', $this->tanggal);
		}
		if ($this->idPajakPemesananPenjualan) {
			return $this->db->get($this->tabel1)->row_array();
		} else {
			return $this->db->get($this->tabel1)->result_array();
		}
	}

	public function update()
	{
		$this->db->where('idPajakPemesananPenjualan', $this->idPajakPemesananPenjualan);
		if ($this->npwp) {
			$this->db->update($this->tabel1, [
				'npwp'	=> $this->npwp
			]);
		}
		if ($this->ntpn) {
			$this->db->update($this->tabel1, [
				'ntpn'	=> $this->ntpn
			]);
		}
	}
}