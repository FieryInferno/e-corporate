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


class Saldo_awal_model extends CI_Model {

	private $title	= 'Saldo Awal';
	private $idSaldoAwal;
	private $nomor;	
	private $perusahaan;
	private $keterangan;
	private	$detail;

	public function get_saldoawaldetail() {
		$this->db->select('tsaldoawaldetail.*, mnoakun.namaakun');
		$this->db->join('mnoakun', 'mnoakun.noakun = tsaldoawaldetail.noakun');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->order_by('mnoakun.noakun', 'ASC');
		$get = $this->db->get('tsaldoawaldetail');
		return $get->result_array();
	}

	public function save() {
		$data	= $this->db->insert('tsaldoawal', [
			'idSaldoAwal'	=> $this->idSaldoAwal,
			'no'			=> $this->nomor,
			'tanggal'		=> $this->tanggal,
			'perusahaan'	=> $this->perusahaan,
			'keterangan'	=> $this->keterangan
		]);
		if ($data) {
			for ($i=0; $i < count($this->detail['idAkun']); $i++) { 
				if ($this->detail['debit'][$i] !== '') {
					$debit	= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->detail['debit'][$i]);
				} else {
					$debit	= 0;
				}
				if ($this->detail['kredit'][$i] !== '') {
					$kredit	= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->detail['kredit'][$i]);
				} else {
					$kredit	= 0;
				}
				$data	= $this->db->insert('tsaldoawaldetail', [
					'idsaldoawal'	=> $this->idSaldoAwal,
					'noakun'		=> $this->detail['idAkun'][$i],
					'debet'			=> $debit,
					'kredit'		=> $kredit
				]);
			}
		}
		return $data;
	}

	public function savehead() {
		$count = $this->db->count_all_results('tsaldoawal');
		if($count > 0) {
			$this->db->truncate('tsaldoawal');
			$this->db->truncate('tsaldoawaldetail');
		}

		$this->db->set('tanggal',$this->input->post('tanggal'));
		$inserthead = $this->db->insert('tsaldoawal');
		if($inserthead) {
			$data['status'] = 'success';
			$data['redir'] = 'manage';
			$data['message'] = lang('save_success_message');
		}		
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function setIdSaldoAwal($idSaldoAwal)
	{
		$this->idSaldoAwal	= $idSaldoAwal;
	}

	public function setNomor($nomor)
	{
		$this->nomor	= $nomor;
	}

	public function setTanggal($tanggal)
	{
		$this->tanggal	= $tanggal;
	}

	public function setPerusahaan($perusahaan)
	{
		$this->perusahaan	= $perusahaan;
	}

	public function setKeterangan($keterangan)
	{
		$this->keterangan	= $keterangan;
	}

	public function setDetail($detail)
	{
		$this->detail	= $detail;
	}

	public function indexDatatables()
	{
		$data	= $this->db->get('tsaldoawal')->result_array();
		foreach ($data as $key) {
			$data0	= $this->db->get_where('tsaldoawaldetail', [
				'idsaldoawal'	=> $key['idSaldoAwal']
			])->result_array();
			$debit	= 0;
			$kredit	= 0;
			foreach ($data0 as $key) {
				$debit	+= $key['debet'];
				$kredit	+= $key['kredit'];
			}
			$data['debit']	= $debit;
			$data['kredit']	= $kredit;
		}
		$this->load->library('Datatables');
		$this->datatables->select('tsaldoawal.*, mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan', 'tsaldoawal.perusahaan = mperusahaan.idperusahaan');
		$this->datatables->from('tsaldoawal');
		$this->datatables->add_column('debit', $data['debit']);
		$this->datatables->add_column('kredit', $data['kredit']);
		return $this->datatables->generate();
		// $this->db->select('tsaldoawal.*, mperusahaan.nama_perusahaan');
		// $this->db->join('mperusahaan', 'tsaldoawal.perusahaan = mperusahaan.idperusahaan');
		// print_r($this->db->get('tsaldoawal')->result_array());
	}

}

