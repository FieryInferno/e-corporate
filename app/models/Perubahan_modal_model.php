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


class Perubahan_modal_model extends CI_Model {

	public function getprive($tanggalawal, $tanggalakhir) {
		$this->db->select(" *, SUM(debet)-SUM(kredit) AS saldo");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakunheader', '312');
		$this->db->or_where('noakun', '312');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function getekuitas($tanggalawal, $tanggalakhir) {
		$this->db->select("*, SUM(kredit)-SUM(debet) AS saldo");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakunheader', '311');
		$this->db->or_where('noakun', '311');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function getpendapatan($tanggalawal, $tanggalakhir) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('noakuntop', '4');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function getbeban($tanggalawal, $tanggalakhir) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('noakuntop', '5');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function gettotallabarugi($tanggalawal, $tanggalakhir) {
		$totallabarugi = $this->getpendapatan($tanggalawal,$tanggalakhir) - $this->getbeban($tanggalawal, $tanggalakhir);
		return $totallabarugi;
	}



	// get neraca
	public function get_saldo_awal($tanggal) {
		$this->db->select("
			COALESCE( SUM(CASE WHEN stdebet = '1' THEN debet ELSE kredit END),0 ) 
			- COALESCE( SUM(CASE WHEN stdebet = '1' THEN kredit ELSE debet END),0 ) AS totalsaldoawal
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->where('noakuntop', '1');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row_array();
	}

	public function getasetlancar($tanggal) {
		$this->db->select("*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->where('noakuntop', '1');
		$this->db->not_like('noakunheader', '15','after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function getasettetap($tanggal) {
		$this->db->select("*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->where('noakuntop', '1');
		$this->db->like('noakunheader', '15','after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}
}

