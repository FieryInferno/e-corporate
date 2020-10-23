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


class Jurnal_penyesuaian_model extends CI_Model {

	private $idJurnalPenyesuaian;
	private $tanggal;
	private $perusahaan;
	private $totalDebit;
	private $debit;
	private $kredit;
	private $keterangan;
	private $noAkun;

	public function get_count_jurnal($tanggalawal, $tanggalakhir) {
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.status', '1');
		$this->db->where('tjurnal.tipe', '5');
		$get = $this->db->count_all_results('tjurnal');
		return $get;
	}

	public function get_jurnal($offset, $limit, $tanggalawal, $tanggalakhir) {
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.status', '1');
		$this->db->where('tjurnal.tipe', '5');
		$this->db->order_by('tjurnal.id', 'desc');
		$get = $this->db->get('tjurnal', $limit, $offset);
		return $get->result_array();
	}

	public function get_jurnal_print($tanggalawal, $tanggalakhir) {
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.status', '1');
		$this->db->where('tjurnal.tipe', '5');
		$this->db->order_by('tjurnal.id', 'desc');
		$get = $this->db->get('tjurnal');
		return $get->result_array();
	}

	public function get_jurnal_detail($idjurnal) {
		$this->db->select('tjurnaldetail.*, mnoakun.namaakun');
		$this->db->join('mnoakun', 'tjurnaldetail.noakun = mnoakun.noakun', 'left');
		$this->db->where('tjurnaldetail.idjurnal', $idjurnal);
		$this->db->order_by('tjurnaldetail.debet', 'desc');
		$get = $this->db->get('tjurnaldetail');
		return $get->result_array();
	}

	public function save() {
		$insertHead	= $this->db->insert('tjurnal', [
			'idJurnalPenyesuaian'	=> $this->get('idJurnalPenyesuaian'),
			'tanggal'				=> $this->get('tanggal'),
			'perusahaan'			=> $this->get('perusahaan'),
			'totaldebet'			=> $this->getTotal('debit', $this->get('debit')),
			'totalkredit'			=> $this->getTotal('kredit', $this->get('kredit')),
			'keterangan'			=> $this->get('keterangan')
		]);

		if($insertHead) {
			for ($i=0; $i < count($this->get('noAkun')); $i++) { 
				$insertHead	+= $this->db->insert('tjurnaldetail', [
					'idjurnal'		=> $this->get('idJurnalPenyesuaian'),
					'noakun'		=> $this->get('noAkun')[$i],
					'debet'			=> $this->get('debit')[$i],
					'kredit'		=> $this->get('kredit')[$i],
					'keterangan'	=> '-'
				]);
			}
		}
		if ($insertHead == (1 + count($this->get('noAkun')))) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	private function getTotal($jenis, $data)
	{
		switch ($jenis) {
			case 'debit':
				$this->totalDebit	= 0;
				foreach ($data as $key) {
					$this->totalDebit	+= (integer) $key;
				}
				return $this->totalDebit;
				break;

			case 'kredit':
				$this->totalKredit	= 0;
				foreach ($data as $key) {
					$this->totalKredit	+= (integer) $key;
				}
				return $this->totalDebit;
				break;
			
			default:
				# code...
				break;
		}
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

	private function get($jenis)
	{
		return $this->$jenis;
	}

	public function index_datatable()
	{
		$this->load->library('Datatables');
		$this->datatables->select('tjurnal.notrans, tjurnal.tanggal, mperusahaan.nama_perusahaan, tjurnal.keterangan, tjurnal.totaldebet, tjurnal.totalkredit, tjurnal.idJurnalPenyesuaian');
		$this->datatables->join('mperusahaan', 'tjurnal.perusahaan = mperusahaan.idperusahaan');
        $this->datatables->from('tjurnal');
		return $this->datatables->generate();
	}
}

