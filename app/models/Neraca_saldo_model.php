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


class Neraca_saldo_model extends CI_Model {

	public function get_neraca_saldo_noakun() {
		$this->db->select('noakun, stauto');
		$this->db->join('tjurnal', 'tjurnal.idJurnalPenyesuaian=tjurnaldetail.idjurnal');
		$this->db->where_not_in('tipe', '5');
		$this->db->group_by('noakun');
		$get = $this->db->get('tjurnaldetail');
		return $get->result_array();
	}

	public function get_neraca_saldo_detail_awal($tanggalawal, $noakun) {
		$this->db->select("noakun, SUM(debet) AS debet, SUM(kredit) AS kredit");
		$this->db->join('tjurnal', 'tjurnal.idJurnalPenyesuaian=tjurnaldetail.idjurnal');
		$this->db->where('tanggal <', $tanggalawal);
		$this->db->where('noakun', $noakun);
		$this->db->where_not_in('tipe', '5');
		$get = $this->db->get('tjurnaldetail');
		return $get->result_array();
	}

	public function get_neraca_saldo_detail_pergerakan($tanggalawal, $tanggalakhir, $noakun) {
		$this->db->select("noakun, SUM(debet) AS debet, SUM(kredit) AS kredit");
		$this->db->join('tjurnal', 'tjurnal.idJurnalPenyesuaian=tjurnaldetail.idjurnal');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakun', $noakun);
		$this->db->where_not_in('tipe', '5');
		$get = $this->db->get('tjurnaldetail');
		return $get->result_array();
	}

	public function get_neraca_saldo_detail_akhir($tanggalakhir, $noakun) {
		$this->db->select("noakun, SUM(debet) AS debet, SUM(kredit) AS kredit");
		$this->db->join('tjurnal', 'tjurnal.idJurnalPenyesuaian=tjurnaldetail.idjurnal');
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where_not_in('tipe', '5');
		$this->db->where('noakun', $noakun);
		$get = $this->db->get('tjurnaldetail');
		return $get->result_array();
	}
}

