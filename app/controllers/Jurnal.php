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


class Jurnal extends User_Controller {

	private	$tglMulai;
	private	$tglSampai;
	private	$akunno;

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurnal_model','model');
		$this->tglMulai		= $this->input->get('tglMulai');
		$this->tglSampai	= $this->input->get('tglSampai');
		$this->akunno		= $this->input->get('kodeAkun');
		$this->tipe			= $this->input->get('tipe');
	}

	public function index() {
		$data['title']		= 'Jurnal Umum';
		$data['content']	= 'Jurnal/index';
		$data['jurnalUmum']	= [];
		$formulir			= [];
		if ($this->tipe) {
			array_push($formulir, $this->tipe);
		} else {
			$formulir	= ['penerimaanBarang', 'pengirimanBarang', 'fakturPenjualan', 'fakturPembelian', 'kasBank', 'pengeluaranKasKecil', 'saldoAwal', 'jurnalPenyesuaian'];
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
					$data1	= $this->db->get('tSetupJurnal')->row_array();
					$data2	= $this->db->get_where('tPemetaanAkun', [
						$data1['elemen']	=> $key['idakun']
					])->row_Array();
					if ($data2) {
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
			} elseif ($formulir[$i] == 'fakturPembelian') {
				$data0	= $this->Faktur_pembelian_model->get();
				if ($data0) {
					foreach ($data0 as $key) {
						foreach ($key['detail'] as $detail) {
							if (substr($detail['akunno'], 0, 1) == 1 || substr($detail['akunno'], 0, 1) == 2 || substr($detail['akunno'], 0, 1) == 3 || substr($detail['akunno'], 0, 1) == 8 || substr($detail['akunno'], 0, 1) == 9 || substr($detail['akunno'], 0, 1) == 6) {
								$this->db->select('tJurnalFinansial.elemen, tJurnalFinansial.jenis, tSetupJurnal.formulir');
								$this->db->join('tJurnalFinansial', 'tSetupJurnal.idSetupJurnal = tJurnalFinansial.idSetupJurnal');
							} else {
								$this->db->select('tJurnalAnggaran.elemen, tJurnalAnggaran.jenis, tSetupJurnal.formulir');
								$this->db->join('tJurnalAnggaran', 'tSetupJurnal.idSetupJurnal = tJurnalAnggaran.idSetupJurnal');
							}
							$this->db->where('formulir', 'fakturPembelian');
							$data1	= $this->db->get('tSetupJurnal')->row_array();
							$data2	= $this->db->get_where('tPemetaanAkun', [
								$data1['elemen']	=> $detail['idakun']
							])->row_Array();
							if ($data2) {
								array_push($data['jurnalUmum'], [
									'tanggal'			=> $key['tanggal'],
									'formulir'			=> 'Faktur Pembelian',
									'noTrans'			=> $key['notrans'],
									'departemen'		=> '',
									'nama_perusahaan' 	=> $key['namaperusahaan'],
									'akunno'			=> $detail['akunno'],
									'namaakun'			=> $detail['namaakun'],
									'jenis'				=> $data1['jenis'],
									'total'				=> $detail['total']
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

