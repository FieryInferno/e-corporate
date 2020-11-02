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

	private $kontakid;
	private $table	= 'SaldoAwalHutang';
	private $table0	= 'tfaktur';

	public function get_count_utang($tanggalawal, $tanggalakhir, $kontakid) {
		$this->db->where('view_laporan_utang_piutang.tanggal >=', $tanggalawal);
		$this->db->where('view_laporan_utang_piutang.tanggal <=', $tanggalakhir);
		if($kontakid) $this->db->where('view_laporan_utang_piutang.kontakid', $kontakid);
		$this->db->where('view_laporan_utang_piutang.tipe', '1');
		$get = $this->db->count_all_results('view_laporan_utang_piutang');
		return $get;
	}

	public function get($jenis) {
		switch ($jenis) {
			case 'saldoAwal':
				$this->db->select($this->table . '.tanggal, ' . $this->table . '.tanggaltempo, ' . $this->table . '.noInvoice as notrans, ' . $this->table . '.deskripsi as catatan, ' . $this->table . '.namaPemasok as rekanan, ' . $this->table . '.primeOwing as total, ' . $this->table . '.idSaldoAwalHutang');
				return $this->db->get($this->table)->result_array();
				break;
			case 'faktur':
				$this->db->select($this->table0 . '.tanggal, ' . $this->table0 . '.tanggaltempo, ' . $this->table0 . '.notrans, ' . $this->table0 . '.catatan, mkontak.nama as rekanan, ' . $this->table0 . '.total, ' . $this->table0 . '.totaldibayar, (' . $this->table0 . '.total - ' . $this->table0 . '.totaldibayar) as sisaUtang, ' . $this->table0 . '.id');
				$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id');
				return $this->db->get($this->table0)->result_array();
				break;
			
			default:
				# code...
				break;
		}
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

	public function indexDatatables()
	{
		// $this->load->library('Datatables');
		// $this->datatables->select('tfaktur.tanggal, tfaktur.tanggaltempo, tfaktur.notrans, tfaktur.catatan, mkontak.nama as rekanan, tfaktur.total, tfaktur.totaldibayar, (tfaktur.total - tfaktur.totaldibayar) as sisaUtang, tfaktur.id');
		// $this->datatables->join('mkontak', 'tfaktur.kontakid = mkontak.id');
		// $this->datatables->from('tfaktur');
		// return $this->datatables->generate();

		// $this->load->library('Datatables');
		// $this->datatables->select('tfaktur.tanggal, tfaktur.tanggaltempo, tfaktur.notrans, tfaktur.catatan, mkontak.nama as rekanan, tfaktur.total, tfaktur.totaldibayar, (tfaktur.total - tfaktur.totaldibayar) as sisaUtang, tfaktur.id');
		// $this->datatables->join('mkontak', 'tfaktur.kontakid = mkontak.id');
		// $this->datatables->from('tfaktur');
		// $this->datatables->select('SaldoAwalHutang.tanggal as tanggalsa, SaldoAwalHutang.tanggaltempo as tanggaltemposa, SaldoAwalHutang.noInvoice as notrans, SaldoAwalHutang.deskripsi as catatan, SaldoAwalHutang.namaPemasok as rekanan, SaldoAwalHutang.primeOwing as total, SaldoAwalHutang.idSaldoAwalHutang');
		// // $this->datatables->join('mkontak', 'tfaktur.kontakid = mkontak.id');
		// $this->datatables->from('SaldoAwalHutang');
		// return $this->datatables->generate();
	}

	public function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
		
	}
}

