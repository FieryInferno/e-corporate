<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard_model extends CI_Model {

	public function totalpembelian() {
		$this->db->select('total');
		$this->db->where('tipe', '1');
		$this->db->where('tanggal', date('Y-m-d'));
		$get = $this->db->get('tfaktur');
		if($get->num_rows() > 0) {
			return $get->row()->total;
		} else {
			return 0;
		}
	}

	public function totalreturpembelian() {
		$this->db->select('total');
		$this->db->where('tipe', '1');
		$this->db->where('tanggal', date('Y-m-d'));
		$get = $this->db->get('tretur');
		if($get->num_rows() > 0) {
			return $get->row()->total;
		} else {
			return 0;
		}
	}

	public function totalpenjualan() {
		$this->db->select('total');
		$this->db->where('tipe', '2');
		$this->db->where('tanggal', date('Y-m-d'));
		$get = $this->db->get('tfaktur');
		if($get->num_rows() > 0) {
			return $get->row()->total;
		} else {
			return 0;
		}
	}

	public function totalreturpenjualan() {
		$this->db->select('total');
		$this->db->where('tipe', '2');
		$this->db->where('tanggal', date('Y-m-d'));
		$get = $this->db->get('tretur');
		if($get->num_rows() > 0) {
			return $get->row()->total;
		} else {
			return 0;
		}
	}
	

}
