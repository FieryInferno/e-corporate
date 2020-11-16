<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemindahbukuan_model extends CI_Model {

	private $idPemindahbukuan;

	public function cetakdata($tanggalawal,$tanggalakhir) {
		// $this->db->select('tpemindahbukuankaskecil.*,mperusahaan.nama_perusahaan, mnoakun.akunno as nomor_akun');
		$this->db->select('tpemindahbukuankaskecil.*,mperusahaan.nama_perusahaan');
		$this->db->join('mperusahaan','tpemindahbukuankaskecil.perusahaan=mperusahaan.idperusahaan');
		// $this->db->join('mnoakun','tpemindahbukuankaskecil.akunno=mnoakun.idakun');
		if ((!empty($tanggalawal)) & (!empty($tanggalakhir))) {
			$this->db->where('tpemindahbukuankaskecil.tanggal >=',$tanggalawal);
			$this->db->where('tpemindahbukuankaskecil.tanggal <=',$tanggalakhir);
		}
		$get = $this->db->get('tpemindahbukuankaskecil');
		return $get->result_array();
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

	public function get()
	{
		$this->db->select('tpemindahbukuankaskecil.*, tkasbankdetail.pengeluaran, concat(mnoakun.namaakun, " ", mnoakun.akunno) as akun, mperusahaan.nama_perusahaan');
		$this->db->join('tkasbank', 'tpemindahbukuankaskecil.nomor_kas_bank = tkasbank.nomor_kas_bank');
		$this->db->join('tkasbankdetail', 'tkasbank.id = tkasbankdetail.idkasbank');
		$this->db->join('mnoakun', 'tkasbankdetail.noakun = mnoakun.idakun');
		$this->db->join('mperusahaan', 'tpemindahbukuankaskecil.perusahaan = mperusahaan.idperusahaan');
		return $this->db->get_where('tpemindahbukuankaskecil', [
			'tpemindahbukuankaskecil.id'	=> 3
		])->row_array();
	}

}

