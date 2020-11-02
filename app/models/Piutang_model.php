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

	public function get() {
		$this->db->select($this->table . '.tanggal, ' . $this->table . '.tanggalTempo, '  . $this->table . '.noInvoice, ' . $this->table . '.deskripsi, ' . $this->table . '.namaPelanggan, ' . $this->table . '.primeOwing, ' . $this->table . '.idSaldoAwalPiutang');
		$get = $this->db->get($this->table);
		return $get->result_array();
	}
}

