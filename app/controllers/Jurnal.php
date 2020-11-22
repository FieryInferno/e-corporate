<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends User_Controller {

	private	$tglMulai;
	private	$tglSampai;
	private	$akunno;
	private	$perusahaan;

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurnal_model','model');
		$this->tglMulai		= $this->input->get('tglMulai');
		$this->tglSampai	= $this->input->get('tglSampai');
		$this->akunno		= $this->input->get('kodeAkun');
		$this->tipe			= $this->input->get('tipe');
		if ($this->session->userid !== '1') {
			$this->perusahaan	= $this->session->idperusahaan;
		}
	}

	public function index() {
		$data['title']		= 'Jurnal Umum';
		$data['content']	= 'Jurnal/index';
		$data['jurnalUmum']	= [];
		$formulir			= [];
		if ($this->tipe) {
			array_push($formulir, $this->tipe);
		} else {
			$formulir	= ['penerimaanBarang', 'fakturPembelian', 'pengirimanBarang', 'fakturPenjualan', 'kasBank', 'pengeluaranKasKecil', 'saldoAwal', 'jurnalPenyesuaian'];
		}
		$jumlah	= count($formulir);
		for ($i=0; $i < $jumlah; $i++) {
			if ($formulir[$i] == 'penerimaanBarang') {
				$this->db->select('tPenerimaan.tanggal, tPenerimaan.noTrans, tpemesanan.departemen, mperusahaan.nama_perusahaan, mnoakun.akunno, mnoakun.namaakun, tPenerimaan.total, mnoakun.idakun');
				$this->db->join('tPenerimaanDetail', 'tPenerimaan.idPenerimaan = tPenerimaanDetail.idPenerimaan');
				$this->db->join('tpemesanandetail', 'tPenerimaanDetail.idPemesananDetail = tpemesanandetail.id');
				$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
				$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				$this->db->join('tpemesanan', 'tPenerimaan.pemesanan = tpemesanan.id');
				$this->db->join('mperusahaan', 'tpemesanan.idperusahaan = mperusahaan.idperusahaan');
				$this->db->where('tPenerimaan.status', '3');
				if (!empty($this->tglMulai) && !empty($this->tglSampai)) {
					$this->db->where('tPenerimaan.tanggal BETWEEN "' . $this->tglMulai . '" AND "' . $this->tglSampai . '"');
				}
				if (!empty($this->akunno)) {
					$this->db->where('mnoakun.akunno', $this->akunno);
				}
				if ($this->perusahaan) {
					$this->db->where('tpemesanan.idperusahaan', $this->perusahaan);
				}
				$data0	= $this->db->get('tPenerimaan')->result_array();
				foreach ($data0 as $key) {
					if (substr($key['akunno'], 0, 1) == 1 || substr($key['akunno'], 0, 1) == 2 || substr($key['akunno'], 0, 1) == 3 || substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9 || substr($key['akunno'], 0, 1) == 6) {
						$this->db->select('tJurnalFinansial.elemen, tJurnalFinansial.jenis, tSetupJurnal.formulir');
						$this->db->join('tJurnalFinansial', 'tSetupJurnal.idSetupJurnal = tJurnalFinansial.idSetupJurnal');
					} else {
						$this->db->select('tJurnalAnggaran.elemen, tJurnalAnggaran.jenis, tSetupJurnal.formulir');
						$this->db->join('tJurnalAnggaran', 'tSetupJurnal.idSetupJurnal = tJurnalAnggaran.idSetupJurnal');
					}
					$this->db->where('formulir', 'penerimaanBarang');
					$data1	= $this->db->get_where('tSetupJurnal')->result_array();
					$no		= 0;
					if ($data1) {
						$this->db->select('mnoakun.akunno, mnoakun.namaakun, mnoakun1.akunno as akunno1, mnoakun1.namaakun as namaakun1, mnoakun2.akunno as akunno2, mnoakun2.namaakun as namaakun2');
						$this->db->join('mnoakun', 'tPemetaanAkun.kodeAkun1 = mnoakun.idakun');
						$this->db->join('mnoakun as mnoakun1', 'tPemetaanAkun.kodeAkun2 = mnoakun1.idakun');
						$this->db->join('mnoakun as mnoakun2', 'tPemetaanAkun.kodeAkun3 = mnoakun2.idakun');
						$data2	= $this->db->get_where('tPemetaanAkun', [
							'kodeAkun'	=> $detail['idakun']
						])->row_Array();
						foreach ($data1 as $setupJurnal) {
							switch ($setupJurnal['elemen']) {
								case 'kodeAkun':
									$akunno		= $detail['akunno'];
									$namaakun	= $detail['namaakun'];
									break;
								case 'mapAkun1':
									$akunno		= $data2['akunno'];
									$namaakun	= $data2['namaakun'];
									break;
								case 'mapAkun2':
									$akunno		= $data2['akunno1'];
									$namaakun	= $data2['namaakun1'];
									break;
								case 'mapAkun3':
									$akunno		= $data2['akunno2'];
									$namaakun	= $data2['namaakun2'];
									break;
								
								default:
									# code...
									break;
							}
							array_push($data['jurnalUmum'], [
								'tanggal'			=> $key['tanggal'],
								'formulir'			=> $data1['formulir'],
								'noTrans'			=> $key['noTrans'],
								'departemen'		=> $key['departemen'],
								'nama_perusahaan' 	=> $key['nama_perusahaan'],
								'akunno'			=> $key['akunno'],
								'namaakun'			=> $key['namaakun'],
								'jenis'				=> $data1['jenis'],
								'total'				=> $key['total']
							]);
						}
					}
				}
			} elseif ($formulir[$i] == 'saldoAwal') {
				$this->db->select('tsaldoawal.tanggal, tsaldoawal.no, mperusahaan.nama_perusahaan, mnoakun.akunno, tsaldoawaldetail.debet, tsaldoawaldetail.kredit, mnoakun.namaakun');
				$this->db->join('mperusahaan', 'tsaldoawal.perusahaan = mperusahaan.idperusahaan');
				$this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
				$this->db->join('mnoakun', 'tsaldoawaldetail.noakun = mnoakun.idakun');
				if (!empty($this->tglMulai) && !empty($this->tglSampai)) {
					$this->db->where('tsaldoawal.tanggal BETWEEN "' . $this->tglMulai . '" AND "' . $this->tglSampai . '"');
				}
				if (!empty($this->akunno)) {
					$this->db->where('mnoakun.akunno', $this->akunno);
				}
				if ($this->perusahaan) {
					$this->db->where('tsaldoawal.perusahaan', $this->perusahaan);
				}
				$data0	= $this->db->get('tsaldoawal')->result_array();
				if ($data0) {
					foreach ($data0 as $key) {
						array_push($data['jurnalUmum'], [
							'tanggal'			=> $key['tanggal'],
							'formulir'			=> 'Saldo Awal',
							'noTrans'			=> $key['no'],
							'departemen'		=> '',
							'nama_perusahaan' 	=> $key['nama_perusahaan'],
							'akunno'			=> $key['akunno'],
							'namaakun'			=> $key['namaakun'],
							'jenis'				=> '',
							'totalDebit'		=> $key['debet'],
							'totalKredit'		=> $key['kredit'],
						]);
					}
				}
			} elseif ($formulir[$i] == 'jurnalPenyesuaian') {
				$data0	= $this->Jurnal_penyesuaian_model->get();
				if ($data0) {
					foreach ($data0 as $key) {
						array_push($data['jurnalUmum'], [
							'tanggal'			=> $key['tanggal'],
							'formulir'			=> 'Jurnal Penyesuaian',
							'noTrans'			=> $key['notrans'],
							'departemen'		=> '',
							'nama_perusahaan' 	=> $key['nama_perusahaan'],
							'akunno'			=> $key['akunno'],
							'namaakun'			=> $key['namaakun'],
							'jenis'				=> '',
							'totalDebit'		=> $key['debet'],
							'totalKredit'		=> $key['kredit'],
						]);
					}
				}
			} elseif ($formulir[$i] == 'fakturPembelian' || $formulir[$i] == 'fakturPenjualan') {
				switch ($formulir[$i]) {
					case 'fakturPembelian':
						$data0	= $this->Faktur_pembelian_model->get();
						$jenis	= 'Faktur Pembelian';
						break;
					case 'fakturPenjualan':
						$data0	= $this->Faktur_penjualan_model->getfaktur(null, '2');
						$jenis	= 'Faktur Penjualan';
						$no		= 0;
						foreach ($data0 as $key) {
							$data0[$no]['detail']	= $this->Faktur_penjualan_model->fakturdetail($key['id'], $key['jenis_pembelian']);
							$no++;
						}
						break;
					
					default:
						# code...
						break;
				}
				if ($data0) {
					foreach ($data0 as $key) {
						foreach ($key['detail'] as $detail) {
							// if (substr($detail['akunno'], 0, 1) == 1 || substr($detail['akunno'], 0, 1) == 2 || substr($detail['akunno'], 0, 1) == 3 || substr($detail['akunno'], 0, 1) == 8 || substr($detail['akunno'], 0, 1) == 9 || substr($detail['akunno'], 0, 1) == 6) {
								$this->db->select('tJurnalFinansial.elemen, tJurnalFinansial.jenis, tSetupJurnal.formulir');
								$this->db->join('tJurnalFinansial', 'tSetupJurnal.idSetupJurnal = tJurnalFinansial.idSetupJurnal');
							// } else {
							// 	$this->db->select('tJurnalAnggaran.elemen, tJurnalAnggaran.jenis, tSetupJurnal.formulir');
							// 	$this->db->join('tJurnalAnggaran', 'tSetupJurnal.idSetupJurnal = tJurnalAnggaran.idSetupJurnal');
							// }
							$this->db->where('tSetupJurnal.idSetupJurnal', $key['setupJurnal']);
							$data1	= $this->db->get_where('tSetupJurnal')->result_array();
							$no		= 0;
							$this->db->select('mnoakun.akunno, mnoakun.namaakun, mnoakun1.akunno as akunno1, mnoakun1.namaakun as namaakun1, mnoakun2.akunno as akunno2, mnoakun2.namaakun as namaakun2');
							$this->db->join('mnoakun', 'tPemetaanAkun.kodeAkun1 = mnoakun.idakun');
							$this->db->join('mnoakun as mnoakun1', 'tPemetaanAkun.kodeAkun2 = mnoakun1.idakun');
							$this->db->join('mnoakun as mnoakun2', 'tPemetaanAkun.kodeAkun3 = mnoakun2.idakun');
							$data2	= $this->db->get_where('tPemetaanAkun', [
								'kodeAkun'	=> $detail['idakun']
							])->row_Array();
							foreach ($data1 as $setupJurnal) {
								switch ($setupJurnal['elemen']) {
									case 'kodeAkun':
										$akunno		= $detail['akunno'];
										$namaakun	= $detail['namaakun'];
										break;
									case 'mapAkun1':
										$akunno		= $data2['akunno'];
										$namaakun	= $data2['namaakun'];
										break;
									case 'mapAkun2':
										$akunno		= $data2['akunno1'];
										$namaakun	= $data2['namaakun1'];
										break;
									case 'mapAkun3':
										$akunno		= $data2['akunno2'];
										$namaakun	= $data2['namaakun2'];
										break;
									
									default:
										# code...
										break;
								}
								array_push($data['jurnalUmum'], [
									'tanggal'			=> $key['tanggal'],
									'formulir'			=> $jenis,
									'noTrans'			=> $key['notrans'],
									'departemen'		=> '',
									'nama_perusahaan' 	=> $key['namaperusahaan'],
									'akunno'			=> $akunno,
									'namaakun'			=> $namaakun,
									'jenis'				=> $setupJurnal['jenis'],
									'total'				=> $detail['total']
								]);
							}
						}
					}
				}
			} elseif ($formulir[$i] == 'pengirimanBarang') {
				// $this->db->select('tpengirimanpenjualan.tanggal, tpengirimanpenjualan.noTrans, mdepartemen.nama as departemen, mperusahaan.nama_perusahaan, mnoakun.akunno, mnoakun.namaakun, tPenerimaan.total, mnoakun.idakun');
				// $this->db->join('mdepartemen', 'tpengirimanpenjualan.departemen = mdepartemen.id');
				// $this->db->join('tpemesanandetail', 'tPenerimaanDetail.idPemesananDetail = tpemesanandetail.id');
				// $this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
				// $this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				// $this->db->join('tpemesanan', 'tPenerimaan.pemesanan = tpemesanan.id');
				// $this->db->join('mperusahaan', 'tpengirimanpenjualan.idperusahaan = mperusahaan.idperusahaan');
				// $this->db->where('tPenerimaan.status', '3');
				// if (!empty($this->tglMulai) && !empty($this->tglSampai)) {
				// 	$this->db->where('tPenerimaan.tanggal BETWEEN "' . $this->tglMulai . '" AND "' . $this->tglSampai . '"');
				// }
				// if (!empty($this->akunno)) {
				// 	$this->db->where('mnoakun.akunno', $this->akunno);
				// }
				// $data0	= $this->db->get('tpengirimanpenjualan')->result_array();
				// foreach ($data0 as $key) {
				// 	if (substr($key['akunno'], 0, 1) == 1 || substr($key['akunno'], 0, 1) == 2 || substr($key['akunno'], 0, 1) == 3 || substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9 || substr($key['akunno'], 0, 1) == 6) {
				// 		$this->db->select('tJurnalFinansial.elemen, tJurnalFinansial.jenis, tSetupJurnal.formulir');
				// 		$this->db->join('tJurnalFinansial', 'tSetupJurnal.idSetupJurnal = tJurnalFinansial.idSetupJurnal');
				// 	} else {
				// 		$this->db->select('tJurnalAnggaran.elemen, tJurnalAnggaran.jenis, tSetupJurnal.formulir');
				// 		$this->db->join('tJurnalAnggaran', 'tSetupJurnal.idSetupJurnal = tJurnalAnggaran.idSetupJurnal');
				// 	}
				// 	$this->db->where('formulir', 'penerimaanBarang');
				// 	$data1	= $this->db->get('tSetupJurnal')->row_array();
				// 	$data2	= $this->db->get_where('tPemetaanAkun', [
				// 		$data1['elemen']	=> $key['idakun']
				// 	])->row_Array();
				// 	if ($data2) {
				// 		array_push($data['jurnalUmum'], [
				// 			'tanggal'			=> $key['tanggal'],
				// 			'formulir'			=> $data1['formulir'],
				// 			'noTrans'			=> $key['noTrans'],
				// 			'departemen'		=> $key['departemen'],
				// 			'nama_perusahaan' 	=> $key['nama_perusahaan'],
				// 			'akunno'			=> $key['akunno'],
				// 			'namaakun'			=> $key['namaakun'],
				// 			'jenis'				=> $data1['jenis'],
				// 			'total'				=> $key['total']
				// 		]);
				// 	}
				// }
			} elseif ($formulir[$i] == 'pengeluaranKasKecil') {
				$this->db->select('tpengeluarankaskecil.tanggal, tpengeluarankaskecil.nokwitansi, mdepartemen.nama as departemen, mperusahaan.nama_perusahaan, mnoakun.akunno, mnoakun.namaakun, tpengeluarankaskecildetail.total, mnoakun.idakun, mnoakun1.akunno as akunnoKasKecil, mnoakun1.namaakun as namaakunKasKecil, mnoakun1.idakun as idakunKasKecil');
				$this->db->join('mdepartemen', 'tpengeluarankaskecil.departemen = mdepartemen.id');
				$this->db->join('tpengeluarankaskecildetail', 'tpengeluarankaskecil.id = tpengeluarankaskecildetail.idpengeluaran');
				$this->db->join('mnoakun', 'tpengeluarankaskecildetail.akunno = mnoakun.idakun');
				$this->db->join('mnoakun as mnoakun1', 'tpengeluarankaskecil.akunno = mnoakun1.idakun');
				$this->db->join('mperusahaan', 'tpengeluarankaskecil.perusahaan = mperusahaan.idperusahaan');
				if ($this->perusahaan) {
					$this->db->where('tpengeluarankaskecil.perusahaan', $this->perusahaan);
				}
				if (!empty($this->tglMulai) && !empty($this->tglSampai)) {
					$this->db->where('tpengeluarankaskecil.tanggal BETWEEN "' . $this->tglMulai . '" AND "' . $this->tglSampai . '"');
				}
				if (!empty($this->akunno)) {
					$this->db->where('mnoakun.akunno', $this->akunno);
				}
				$data0	= $this->db->get('tpengeluarankaskecil')->result_array();
				if ($data0) {
					foreach ($data0 as $key) {
						// if (substr($key['akunno'], 0, 1) == 1 || substr($key['akunno'], 0, 1) == 2 || substr($key['akunno'], 0, 1) == 3 || substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9 || substr($key['akunno'], 0, 1) == 6) {
							$this->db->select('tJurnalFinansial.elemen, tJurnalFinansial.jenis, tSetupJurnal.formulir');
							$this->db->join('tJurnalFinansial', 'tSetupJurnal.idSetupJurnal = tJurnalFinansial.idSetupJurnal');
						// } else {
						// 	$this->db->select('tJurnalAnggaran.elemen, tJurnalAnggaran.jenis, tSetupJurnal.formulir');
						// 	$this->db->join('tJurnalAnggaran', 'tSetupJurnal.idSetupJurnal = tJurnalAnggaran.idSetupJurnal');
						// }
						$this->db->where('formulir', 'pengeluaranKasKecil');
						$data1	= $this->db->get_where('tSetupJurnal')->result_array();
						$no		= 0;
						$this->db->select('mnoakun.akunno, mnoakun.namaakun, mnoakun1.akunno as akunno1, mnoakun1.namaakun as namaakun1, mnoakun2.akunno as akunno2, mnoakun2.namaakun as namaakun2');
						$this->db->join('mnoakun', 'tPemetaanAkun.kodeAkun1 = mnoakun.idakun');
						$this->db->join('mnoakun as mnoakun1', 'tPemetaanAkun.kodeAkun2 = mnoakun1.idakun');
						$this->db->join('mnoakun as mnoakun2', 'tPemetaanAkun.kodeAkun3 = mnoakun2.idakun');
						$data2	= $this->db->get_where('tPemetaanAkun', [
							'kodeAkun'	=> $key['idakun']
						])->row_Array();
						foreach ($data1 as $setupJurnal) {
							switch ($setupJurnal['elemen']) {
								case 'kodeAkun':
									$akunno		= $key['akunno'];
									$namaakun	= $key['namaakun'];
									break;
								case 'mapAkun1':
									$akunno		= $data2['akunno'];
									$namaakun	= $data2['namaakun'];
									break;
								case 'mapAkun2':
									$akunno		= $data2['akunno1'];
									$namaakun	= $data2['namaakun1'];
									break;
								case 'mapAkun3':
									$akunno		= $data2['akunno2'];
									$namaakun	= $data2['namaakun2'];
									break;
								
								default:
									$akunno		= $key['akunnoKasKecil'];
									$namaakun	= $key['namaakunKasKecil'];
									break;
							}
							array_push($data['jurnalUmum'], [
								'tanggal'			=> $key['tanggal'],
								'formulir'			=> $setupJurnal['formulir'],
								'noTrans'			=> $key['nokwitansi'],
								'departemen'		=> $key['departemen'],
								'nama_perusahaan' 	=> $key['nama_perusahaan'],
								'akunno'			=> $akunno,
								'namaakun'			=> $namaakun,
								'jenis'				=> $setupJurnal['jenis'],
								'total'				=> $key['total']
							]);
						}
					}
							
				}
			} elseif ($formulir[$i] == 'kasBank') {
				$this->db->select('tkasbankdetail.tanggal, tkasbank.nomor_kas_bank, mperusahaan.nama_perusahaan, mnoakun.akunno, mnoakun.namaakun, tkasbankdetail.penerimaan, tkasbankdetail.pengeluaran, mnoakun.idakun, tkasbank.setupJurnal');
				$this->db->join('tkasbankdetail', 'tkasbank.id = tkasbankdetail.idkasbank');
				$this->db->join('mnoakun', 'tkasbankdetail.noakun = mnoakun.idakun');
				$this->db->join('mperusahaan', 'tkasbank.perusahaan = mperusahaan.idperusahaan');
				if (!empty($this->tglMulai) && !empty($this->tglSampai)) {
					$this->db->where('tPenerimaan.tanggal BETWEEN "' . $this->tglMulai . '" AND "' . $this->tglSampai . '"');
				}
				if (!empty($this->akunno)) {
					$this->db->where('mnoakun.akunno', $this->akunno);
				}
				$data0	= $this->db->get('tkasbank')->result_array();
				if ($data0) {
					foreach ($data0 as $key) {
						// if (substr($key['akunno'], 0, 1) == 1 || substr($key['akunno'], 0, 1) == 2 || substr($key['akunno'], 0, 1) == 3 || substr($key['akunno'], 0, 1) == 8 || substr($key['akunno'], 0, 1) == 9 || substr($key['akunno'], 0, 1) == 6) {
							$this->db->select('tJurnalFinansial.elemen, tJurnalFinansial.jenis, tSetupJurnal.formulir');
							$this->db->join('tJurnalFinansial', 'tSetupJurnal.idSetupJurnal = tJurnalFinansial.idSetupJurnal');
						// } else {
						// 	$this->db->select('tJurnalAnggaran.elemen, tJurnalAnggaran.jenis, tSetupJurnal.formulir');
						// 	$this->db->join('tJurnalAnggaran', 'tSetupJurnal.idSetupJurnal = tJurnalAnggaran.idSetupJurnal');
						// }
						$this->db->where('formulir', 'kasBank');
						$this->db->where('tSetupJurnal.idSetupJurnal', $key['setupJurnal']);
						$data1	= $this->db->get_where('tSetupJurnal')->result_array();
						$no		= 0;
						if ($data1) {
							$this->db->select('mnoakun.akunno, mnoakun.namaakun, mnoakun1.akunno as akunno1, mnoakun1.namaakun as namaakun1, mnoakun2.akunno as akunno2, mnoakun2.namaakun as namaakun2');
							$this->db->join('mnoakun', 'tPemetaanAkun.kodeAkun1 = mnoakun.idakun');
							$this->db->join('mnoakun as mnoakun1', 'tPemetaanAkun.kodeAkun2 = mnoakun1.idakun');
							$this->db->join('mnoakun as mnoakun2', 'tPemetaanAkun.kodeAkun3 = mnoakun2.idakun');
							$data2	= $this->db->get_where('tPemetaanAkun', [
								'kodeAkun'	=> $key['idakun']
							])->row_Array();
							foreach ($data1 as $setupJurnal) {
								switch ($setupJurnal['elemen']) {
									case 'kodeAkun':
										$akunno		= $key['akunno'];
										$namaakun	= $key['namaakun'];
										break;
									case 'mapAkun1':
										$akunno		= $data2['akunno'];
										$namaakun	= $data2['namaakun'];
										break;
									case 'mapAkun2':
										$akunno		= $data2['akunno1'];
										$namaakun	= $data2['namaakun1'];
										break;
									case 'mapAkun3':
										$akunno		= $data2['akunno2'];
										$namaakun	= $data2['namaakun2'];
										break;
									
									default:
										# code...
										break;
								}
								if ($key['penerimaan'] !== '0') {
									$total	= $key['penerimaan'];
								} else {
									$total	= $key['pengeluaran'];
								}
								array_push($data['jurnalUmum'], [
									'tanggal'			=> $key['tanggal'],
									'formulir'			=> 'Kas Bank',
									'noTrans'			=> $key['nomor_kas_bank'],
									'departemen'		=> '',
									'nama_perusahaan' 	=> $key['nama_perusahaan'],
									'akunno'			=> $key['akunno'],
									'namaakun'			=> $key['namaakun'],
									'jenis'				=> $setupJurnal['jenis'],
									'total'				=> $total
								]);
							}
						}
					}
				}
			} else {
				$table = null;
			}
		}
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tjurnal');
			if($data) {
				$data['get_jurnal_detail'] = $this->model->get_jurnal_detail($data['id']);
				$data['title'] = lang('journal_entry');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Jurnal/detail';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function printpdf() {
		$this->load->library('pdf');
		$pdf = $this->pdf;

		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
		}

		$data['get_jurnal'] = $this->model->get_jurnal_print($data['tanggalawal'], $data['tanggalakhir']);
		$data['title'] = lang('journal');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Jurnal/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'landscape');
		$pdf->render();
		$time = time();
		$pdf->stream("jurnal-umum-". $time, array("Attachment" => false));
	}

	public function create() {
		$data['tanggal'] = date('Y-m-d');
		$data['title'] = lang('journal');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Jurnal/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function save() {
		$this->model->save();
	}

	// additional
	public function select2_noakun($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->limit(100);
		if($term) $this->db->like('namaakun', $term);
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function exportdata() {
		include APPPATH.'third_party/PHPExcel/IOFactory.php';
        $excel = new PHPExcel();
        $excel->getProperties()
        ->setCreator('www.isyanto.com') 
        ->setTitle("Laporan Jurnal Umum") 
        ->setSubject("Jurnal Umum") 
        ->setDescription("Laporan Jurnal Umum");

        $excel->getActiveSheet(0)->setTitle("Jurnal Umum");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporanjurnal.xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
	}
}

