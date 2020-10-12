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


class Pemindahbukuan_model extends CI_Model {

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

}

