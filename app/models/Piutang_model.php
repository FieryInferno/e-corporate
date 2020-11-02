<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/


class Piutang_model extends CI_Model {

	private $table	= 'SaldoAwalPiutang';
	private $perusahaan;

	public function get() {
		$this->db->select($this->table . '.tanggal, ' . $this->table . '.tanggalTempo, '  . $this->table . '.noInvoice, ' . $this->table . '.deskripsi, ' . $this->table . '.namaPelanggan, ' . $this->table . '.primeOwing, ' . $this->table . '.idSaldoAwalPiutang, mperusahaan.nama_perusahaan');
		$this->db->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
		if ($this->perusahaan) {
			$this->db->where('perusahaan', $this->perusahaan);
		}
		$get = $this->db->get($this->table);
		return $get->result_array();
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}
}

