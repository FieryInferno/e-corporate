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


class Laporan_stok_akhir_barang_model extends CI_Model {

	public function getstok() {
		$itemid = $this->input->get('itemid');
		if($itemid) $this->db->where('viewstokakhirbarang.id', $itemid);
		$this->db->order_by('viewstokakhirbarang.id', 'desc');
		$get = $this->db->get('viewstokakhirbarang');
		return $get->result_array();
	}
}