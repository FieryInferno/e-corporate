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

	public function gettotallabarugi() {
		$totalLabaRugiPeriodeKini	= 0;
		$penjualanPeriodeKini	= $this->db->get_where('tfakturpenjualan', [
			'idperusahaan'	=> $this->perusahaan
		])->result_array();
		if ($penjualanPeriodeKini) {
			foreach ($penjualanPeriodeKini as $key) {
				$totalLabaRugiPeriodeKini	+= (integer) $key['total'];
			}
		}
		$pembelianPeriodeKini	= $this->db->get_where('tfaktur', [
			'perusahaanid'	=> $this->perusahaan
		])->result_array();
		if ($pembelianPeriodeKini) {
			foreach ($pembelianPeriodeKini as $key) {
				$totalLabaRugiPeriodeKini	-= (integer) $key['total'];
			}
		}
		$pengeluaranKasKecilPeriodeKini	= $this->db->get_where('tpengeluarankaskecil', [
			'perusahaan'	=> $this->perusahaan
		])->result_array();
		if ($pengeluaranKasKecilPeriodeKini) {
			foreach ($pengeluaranKasKecilPeriodeKini as $key) {
				$totalLabaRugiPeriodeKini	-= (integer) $key['total'];
			}
		}
		return $totalLabaRugiPeriodeKini;
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

	public function getasetlancar_standard() {
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.debet, tsaldoawaldetail.noakun');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		$this->db->where('month(tsaldoawal.tanggal) = "' . substr($this->tanggalAwal, 5, 2) . '"');
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
  
  public function getAsetTetapStandar() {
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.debet, tsaldoawaldetail.noakun');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		$this->db->where('month(tsaldoawal.tanggal) = "' . substr($this->tanggalAwal, 5, 2) . '"');
		$this->db->not_like('tsaldoawaldetail.debet', '0', 'after');
		$this->db->like('mnoakun.akunno', '1.2', 'after');
		$this->db->or_like('mnoakun.akunno', '12', 'after');
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

	public function getliabilitas_standard() {
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.kredit, tsaldoawaldetail.noakun');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		// $this->db->where('tsaldoawal.tanggal <= "' . $this->tanggalAwal . '"');
		$this->db->where('month(tsaldoawal.tanggal) = "' . substr($this->tanggalAwal, 5, 2) . '"');
		$this->db->not_like('tsaldoawaldetail.kredit', '0', 'after');
		$this->db->like('mnoakun.akunno', '2', 'after');
		return $this->db->get_where('tsaldoawal', [
			'tsaldoawal.perusahaan'	=> $this->perusahaan
		])->result_array();
	}

	public function gettotallabarugi_standard() {
		$totalLabaRugiPeriodeKini	= 0;
		$penjualanPeriodeKini	= $this->db->get_where('tfakturpenjualan', [
			'idperusahaan'	=> $this->perusahaan
		])->result_array();
		if ($penjualanPeriodeKini) {
			foreach ($penjualanPeriodeKini as $key) {
				$totalLabaRugiPeriodeKini	+= (integer) $key['total'];
			}
		}
		$pembelianPeriodeKini	= $this->db->get_where('tfaktur', [
			'perusahaanid'	=> $this->perusahaan
		])->result_array();
		if ($pembelianPeriodeKini) {
			foreach ($pembelianPeriodeKini as $key) {
				$totalLabaRugiPeriodeKini	-= (integer) $key['total'];
			}
		}
		$pengeluaranKasKecilPeriodeKini	= $this->db->get_where('tpengeluarankaskecil', [
			'perusahaan'	=> $this->perusahaan
		])->result_array();
		if ($pengeluaranKasKecilPeriodeKini) {
			foreach ($pengeluaranKasKecilPeriodeKini as $key) {
				$totalLabaRugiPeriodeKini	-= (integer) $key['total'];
			}
		}
		return $totalLabaRugiPeriodeKini;
	}

	public function getEkuitas_standard()
	{
		$this->db->select('mnoakun.namaakun, tsaldoawaldetail.kredit, tsaldoawaldetail.noakun');
		$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
		$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
		// $this->db->where('tsaldoawal.tanggal <= "' . $this->tanggalAwal . '"');
		$this->db->where('month(tsaldoawal.tanggal) = "' . substr($this->tanggalAwal, 5, 2) . '"');
		$this->db->not_like('tsaldoawaldetail.kredit', '0', 'after');
		$this->db->like('mnoakun.akunno', '3', 'after');
		return $this->db->get_where('tsaldoawal', [
			'tsaldoawal.perusahaan'	=> $this->perusahaan
		])->result_array();
	}
}

