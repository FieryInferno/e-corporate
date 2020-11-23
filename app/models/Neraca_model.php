<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca_model extends CI_Model {

	private $perusahaan;
	private $tanggalAkhir;
	private $tanggalAwal;

	public function getasetlancar() {
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.debet, tsaldoawaldetail.noakun');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		$this->db->where('tsaldoawal.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
		$this->db->not_like('tsaldoawaldetail.debet', '0', 'after');
		$this->db->like('mnoakun.akunno', '1', 'after');
		$saldoAwal	= $this->db->get_where('tsaldoawal', [
			'tsaldoawal.perusahaan'	=> $this->perusahaan
		])->result_array();
		for ($i=0; $i < count($saldoAwal); $i++) {
			$saldoAwal[$i]['debetPeriodeKini']	= $saldoAwal[$i]['debet']; 
			$this->db->join('mrekening', 'tfaktur.bank	= mrekening.id'); 
			$this->db->join('mnoakun', 'mrekening.akunno = mnoakun.idakun');
			$pembelian	= $this->db->get_where('tfaktur', [
				'mnoakun.idakun'	=> $saldoAwal[$i]['noakun']
			])->result_array();
			if ($pembelian) {
				foreach ($pembelian as $key) {
					$saldoAwal[$i]['debetPeriodeKini']	-= $key['total'];
				}
			}
			
			$this->db->join('mrekening', 'tfakturpenjualan.rekening	= mrekening.id'); 
			$this->db->join('mnoakun', 'mrekening.akunno = mnoakun.idakun');
			$penjualan	= $this->db->get_where('tfakturpenjualan', [
				'mnoakun.idakun'	=> $saldoAwal[$i]['noakun']
			])->result_array();
			if ($penjualan) {
				foreach ($penjualan as $key) {
					$saldoAwal[$i]['debetPeriodeKini']	+= $key['total'];
				}
			}
		}
		return $saldoAwal;
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

	public function getliabilitas() {
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.kredit');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		$this->db->where('tsaldoawal.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
		$this->db->not_like('tsaldoawaldetail.kredit', '0', 'after');
		$this->db->like('mnoakun.akunno', '2', 'after');
		return $this->db->get_where('tsaldoawal', [
			'tsaldoawal.perusahaan'	=> $this->perusahaan
		])->result_array();
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

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

	public function getEkuitas()
	{
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.kredit');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		$this->db->where('tsaldoawal.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
		$this->db->not_like('tsaldoawaldetail.kredit', '0', 'after');
		$this->db->like('mnoakun.akunno', '3', 'after');
		return $this->db->get_where('tsaldoawal', [
			'tsaldoawal.perusahaan'	=> $this->perusahaan
		])->result_array();
	}
}

