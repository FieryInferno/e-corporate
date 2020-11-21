<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Saldo_awal_model extends CI_Model {

	private $title	= 'Saldo Awal';
	private $idSaldoAwal;
	private $nomor;	
	private $perusahaan;
	private $keterangan;
	private	$detail;

	public function get_saldoawaldetail() {
		$this->db->select('tsaldoawaldetail.*, mnoakun.namaakun, mnoakun.idakun, mnoakun.akunno as noAkun');
		$this->db->join('mnoakun', 'mnoakun.idakun = tsaldoawaldetail.noakun');
		// $this->db->where('mnoakun.stbayar', '1');
		if ($this->idSaldoAwal) {
			$this->db->where('idsaldoawal', $this->idSaldoAwal);
		}
		$this->db->order_by('mnoakun.noakun', 'ASC');
		$get = $this->db->get('tsaldoawaldetail');
		return $get->result_array();
	}

	public function save() {
		$totalDebit		= 0;
		$totalKredit	= 0;
		for ($i=0; $i < count($this->detail['idAkun']); $i++) { 
			if ($this->detail['debit'][$i] !== '') {
				$totalDebit	+= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->detail['debit'][$i]);
			} else {
				$totalDebit	= 0;
			}
			if ($this->detail['kredit'][$i] !== '') {
				$totalKredit	+= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->detail['kredit'][$i]);
			} else {
				$totalKredit	= 0;
			}
		}
		if ($this->uri->segment(3)) {
			$this->db->where('idSaldoAwal', $this->idSaldoAwal);
			$data	= $this->db->update('tsaldoawal', [
				'idSaldoAwal'	=> $this->idSaldoAwal,
				'no'			=> $this->nomor,
				'tanggal'		=> $this->tanggal,
				'perusahaan'	=> $this->perusahaan,
				'keterangan'	=> $this->keterangan,
				'debit'			=> $totalDebit,
				'kredit'		=> $totalKredit
			]);
			$this->db->where('idsaldoawal', $this->idSaldoAwal);
			$this->db->delete('tsaldoawaldetail');
		} else {
			$data	= $this->db->insert('tsaldoawal', [
				'idSaldoAwal'	=> $this->idSaldoAwal,
				'no'			=> $this->nomor,
				'tanggal'		=> $this->tanggal,
				'perusahaan'	=> $this->perusahaan,
				'keterangan'	=> $this->keterangan,
				'debit'			=> $totalDebit,
				'kredit'		=> $totalKredit
			]);
		}
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
		$perusahaan	= $this->session->idperusahaan;
		$this->load->library('Datatables');
		$this->datatables->select('tsaldoawal.*, mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan', 'tsaldoawal.perusahaan = mperusahaan.idperusahaan');
		if ($perusahaan) {
			$this->datatables->where('tsaldoawal.perusahaan', $perusahaan);
		}
		$this->datatables->from('tsaldoawal');
		return $this->datatables->generate();
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

	public function getData()
	{
		if ($this->get('idSaldoAwal') !== null) {
			$this->db->where('idSaldoAwal', $this->get('idSaldoAwal'));
			return $this->db->get('tsaldoawal')->row_array();
		} else {
			$this->db->get('tsaldoawal')->result_array();
		}
		
	}

	public function get($jenis)
	{
		return $this->$jenis;
	}
}

