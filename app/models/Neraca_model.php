<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca_model extends CI_Model {

	public function getasetlancar($tanggal) {
		$this->db->select("*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <=', $tanggal);
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
		$this->db->where('tanggal <=', $tanggal);
		$this->db->where('noakuntop', '1');
		$this->db->like('noakunheader', '15','after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function getliabilitas($tanggal) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <=', $tanggal);
		$this->db->where('noakuntop', '2');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function getmodal($tanggal) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <=', $tanggal);
		$this->db->where('noakuntop', '3');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function getpendapatan($tanggal) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('tanggal <=', $tanggal);
		$this->db->where('noakuntop', '4');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function getbeban($tanggal) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('tanggal <=', $tanggal);
		$this->db->where('noakuntop', '5');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function gettotallabarugi($tanggal) {
		$totallabarugi = $this->getpendapatan($tanggal) - $this->getbeban($tanggal);
		return $totallabarugi;
	}
}

