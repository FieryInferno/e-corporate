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


class Laporan_stok_model extends CI_Model {

	public function getstok() {
		$itemid = $this->input->get('itemid');
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$tipe = $this->input->get('tipe');
		$gudangid = $this->input->get('gudangid');
		$jenis = $this->input->get('jenis');

		if(!$tanggalawal && !$tanggalakhir) {
			$tanggalawal = date('Y-m-01');
			$tanggalakhir = date('Y-m-t');
		}

		$this->db->select("laporanstok.*");
		$this->db->where('laporanstok.tanggal >=', $tanggalawal);
		$this->db->where('laporanstok.tanggal <=', $tanggalakhir);
		if($tipe) $this->db->where('laporanstok.tipe', $tipe);
		if($gudangid) $this->db->where('laporanstok.gudangid', $gudangid);
		if($jenis) $this->db->where('laporanstok.jenis', $jenis);
		if($itemid) $this->db->where('laporanstok.itemid', $itemid);
		$this->db->order_by('laporanstok.tanggal', 'desc');
		$get = $this->db->get('laporanstok');
		return $get->result_array();
	}
}