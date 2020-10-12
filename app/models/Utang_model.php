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


class Utang_model extends CI_Model {

	public function get_count_utang($tanggalawal, $tanggalakhir, $kontakid) {
		$this->db->where('view_laporan_utang_piutang.tanggal >=', $tanggalawal);
		$this->db->where('view_laporan_utang_piutang.tanggal <=', $tanggalakhir);
		if($kontakid) $this->db->where('view_laporan_utang_piutang.kontakid', $kontakid);
		$this->db->where('view_laporan_utang_piutang.tipe', '1');
		$get = $this->db->count_all_results('view_laporan_utang_piutang');
		return $get;
	}

	public function get_utang($offset, $limit, $tanggalawal, $tanggalakhir, $kontakid) {
		$this->db->select('view_laporan_utang_piutang.*');
		$this->db->where('view_laporan_utang_piutang.tanggal >=', $tanggalawal);
		$this->db->where('view_laporan_utang_piutang.tanggal <=', $tanggalakhir);
		if($kontakid) $this->db->where('view_laporan_utang_piutang.kontakid', $kontakid);
		$this->db->where('view_laporan_utang_piutang.tipe', '1');
		$this->db->order_by('view_laporan_utang_piutang.idfaktur', 'desc');
		$get = $this->db->get('view_laporan_utang_piutang', $limit, $offset);
		return $get->result_array();
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
}

