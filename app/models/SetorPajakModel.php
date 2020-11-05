<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SetorPajakModel extends CI_Model {

	private	$tabel	= 'tfakturpenjualan';

	public function indexDatatables()
	{
		$this->load->library('Datatables');
		$this->datatables->select($this->tabel . '.noSSP, ' . $this->tabel . '.tanggal, mpajak.nama_pajak,' . $this->tabel . '.notrans, mperusahaan.nama_perusahaan, pajakPemesananPenjualan.nominal, pajakPemesananPenjualan.idpajakPemesananPenjualan');
		$this->datatables->join('tpengirimanpenjualan', $this->tabel . '.pengirimanid = tpengirimanpenjualan.id');
		$this->datatables->join('tpengirimanpenjualandetail', 'tpengirimanpenjualan.id = tpengirimanpenjualandetail.idpengiriman');
		$this->datatables->join('tpemesananpenjualandetail', 'tpengirimanpenjualandetail.idpenjualdetail = tpemesananpenjualandetail.id');
		$this->datatables->join('pajakPemesananPenjualan', 'tpemesananpenjualandetail.id = pajakPemesananPenjualan.idDetailPemesananPenjualan');
		$this->datatables->join('mpajak', 'pajakPemesananPenjualan.idPajak = mpajak.id_pajak');
		$this->datatables->join('mperusahaan', $this->tabel . '.idperusahaan = mperusahaan.idperusahaan');
		$this->datatables->from($this->tabel);
		return $this->datatables->generate();
	}
}