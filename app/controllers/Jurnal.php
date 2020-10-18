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
	}

	public function index() {
		$data['title']		= 'Jurnal Umum';
		$data['content']	= 'Jurnal/index';
		$data['jurnalUmum']	= [];
		$formulir	= ['penerimaanBarang', 'pengirimanBarang', 'fakturPenjualan', 'fakturPembelian', 'kasBank', 'pengeluaranKasKecil', 'saldoAwal'];
		$jumlah		= count($formulir);
		for ($i=0; $i < $jumlah; $i++) {
			if ($formulir[$i] == 'penerimaanBarang') {
				$table		= 'tPenerimaan';
				$detail		= 'tPenerimaanDetail';
				$id			= 'idPenerimaan';
				$idDetail	= 'idDetailPenerimaan';
				$jenis		= 'penerimaanBarang';
			} elseif ($formulir[$i] == 'pengirimanBarang') {
				$table		= 'tpengiriman';
				$detail		= 'tpengirimandet';
				$id			= 'id';
				$idDetail	= 'id';
				$jenis		= 'pengirimanBarang';
			// } elseif ($formulir[$i] == 'fakturPenjualan') {
			// 	$table		= 'tfakturpenjualan';
			// 	$detail		= 'tfakturpenjualandetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'idDetailFakturPenjualan';
			// 	$jenis	= 'fakturPenjualan';
			// } elseif ($formulir[$i] == 'fakturPembelian') {
			// 	$table		= 'tfaktur';
			// 	$detail		= 'tfakturdetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'id';
			// 	$jenis	= 'fakturPembelian';
			// } elseif ($formulir[$i] == 'kasBank') {
			// 	$table		= 'tkasbank';
			// 	$detail		= 'tkasbankdetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'idKasBank';
			// 	$jenis	= 'kasBank';
			// } elseif ($formulir[$i] == 'pengeluaranKasKecil') {
			// 	$table		= 'tpengeluarankaskecil';
			// 	$detail		= 'tpengeluarankaskecildetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'id';
			// 	$jenis	= 'pengeluaranKasKecil';
			// } elseif ($formulir[$i] == 'saldoAwal') {
			// 	$table		= 'tsaldoAwal';
			// 	$detail		= 'tsaldoawaldetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'idsaldoawal';
			// 	$jenis	= 'saldoAwal';
			}
			if ($table) {
				$this->db->select($table . '.tanggal, tSetupJurnal.formulir, ' . $table . '.noTrans, tpemesanan.departemen, mperusahaan.nama_perusahaan, mnoakun.akunno, mnoakun.namaakun, tJurnalAnggaran.jenis as jenisAnggaran, tJurnalFinansial.jenis as jenisFinansial, ' . $table . '.total');
				$this->db->join($detail, $table . '.' . $id . ' = ' . $detail . '.' . $idDetail);
				$this->db->join('tpemesanandetail', $detail . '.idPemesananDetail = tpemesanandetail.id');
				$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
				$this->db->join('tPemetaanAkun', 'tanggaranbelanjadetail.koderekening = tPemetaanAkun.kodeAkun');
				$this->db->join('tJurnalAnggaran', 'tPemetaanAkun.idPemetaanAkun = tJurnalAnggaran.elemen', 'left');
				$this->db->join('tJurnalFinansial', 'tPemetaanAkun.idPemetaanAkun = tJurnalFinansial.elemen','left');
				$this->db->join('tSetupJurnal', 'tJurnalAnggaran.idSetupJurnal = tSetupJurnal.idSetupJurnal');
				$this->db->join('tpemesanan', $table . '.pemesanan = tpemesanan.id');
				$this->db->join('mperusahaan', 'tpemesanan.idperusahaan = mperusahaan.idperusahaan');
				$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				$this->db->where('tSetupJurnal.formulir', $jenis);
				$this->db->where($table . '.status', '3');
				if ($this->tglMulai !== '' && $this->tglSampai !== '') {
					$this->db->where($table . '.tanggal BETWEEN "' . $this->tglMulai . '" AND "' . $this->tglSampai . '"');
				}
				if ($this->akunno !== '') {
					$this->db->where('mnoakun.akunno', $this->akunno);
				}
				$data['jurnalUmum'][$i]	= $this->db->get($table)->result_array();	
			}
		}
		$data = array_merge($data,path_info());
		// print_r($data);
		// die();
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

	public function index_datatable() {
		$this->load->library('Datatables');

		// return print_r($this->datatables->generate());

		$jurnalUmum	= [];
		$formulir	= ['penerimaanBarang', 'pengirimanBarang', 'fakturPenjualan', 'fakturPembelian', 'kasBank', 'pengeluaranKasKecil', 'saldoAwal'];
		$jumlah		= count($formulir);
		for ($i=0; $i < $jumlah; $i++) {
			if ($formulir[$i] == 'penerimaanBarang') {
				$table		= 'tPenerimaan';
				$detail		= 'tPenerimaanDetail';
				$id			= 'idPenerimaan';
				$idDetail	= 'idDetailPenerimaan';
				$jenis		= 'penerimaanBarang';
			} elseif ($formulir[$i] == 'pengirimanBarang') {
				$table		= 'tpengiriman';
				$detail		= 'tpengirimandet';
				$id			= 'id';
				$idDetail	= 'id';
				$jenis		= 'pengirimanBarang';
			// } elseif ($formulir[$i] == 'fakturPenjualan') {
			// 	$table		= 'tfakturpenjualan';
			// 	$detail		= 'tfakturpenjualandetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'idDetailFakturPenjualan';
			// 	$jenis	= 'fakturPenjualan';
			// } elseif ($formulir[$i] == 'fakturPembelian') {
			// 	$table		= 'tfaktur';
			// 	$detail		= 'tfakturdetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'id';
			// 	$jenis	= 'fakturPembelian';
			// } elseif ($formulir[$i] == 'kasBank') {
			// 	$table		= 'tkasbank';
			// 	$detail		= 'tkasbankdetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'idKasBank';
			// 	$jenis	= 'kasBank';
			// } elseif ($formulir[$i] == 'pengeluaranKasKecil') {
			// 	$table		= 'tpengeluarankaskecil';
			// 	$detail		= 'tpengeluarankaskecildetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'id';
			// 	$jenis	= 'pengeluaranKasKecil';
			// } elseif ($formulir[$i] == 'saldoAwal') {
			// 	$table		= 'tsaldoAwal';
			// 	$detail		= 'tsaldoawaldetail';
			// 	$id			= 'id';
			// 	$idDetail	= 'idsaldoawal';
			// 	$jenis	= 'saldoAwal';
			}
			if ($table) {
				$this->datatables->select($table . '.tanggal, tSetupJurnal.formulir, ' . $table . '.noTrans, tpemesanan.departemen, mperusahaan.nama_perusahaan, mnoakun.akunno, mnoakun.namaakun, tJurnalAnggaran.jenis as jenisAnggaran, tJurnalFinansial.jenis as jenisFinansial, ' . $table . '.total');
				$this->datatables->from($table);
				$this->datatables->join($detail, $table . '.' . $id . ' = ' . $detail . '.' . $idDetail);
				$this->datatables->join('tpemesanandetail', $detail . '.idPemesananDetail = tpemesanandetail.id');
				$this->datatables->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
				$this->datatables->join('tPemetaanAkun', 'tanggaranbelanjadetail.koderekening = tPemetaanAkun.kodeAkun');
				$this->datatables->join('tJurnalAnggaran', 'tPemetaanAkun.idPemetaanAkun = tJurnalAnggaran.elemen', 'left');
				$this->datatables->join('tJurnalFinansial', 'tPemetaanAkun.idPemetaanAkun = tJurnalFinansial.elemen','left');
				$this->datatables->join('tSetupJurnal', 'tJurnalAnggaran.idSetupJurnal = tSetupJurnal.idSetupJurnal');
				$this->datatables->join('tpemesanan', $table . '.pemesanan = tpemesanan.id');
				$this->datatables->join('mperusahaan', 'tpemesanan.idperusahaan = mperusahaan.idperusahaan');
				$this->datatables->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				$this->datatables->where('tSetupJurnal.formulir', $jenis);
				// $this->db->where('tPenerimaan.status', '3');
				// $data	= $this->db->get($table)->result_array();
				// array_push($jurnalUmum, $data);	
				$jurnalUmum[$i]	= $this->datatables->generate();
			}
		}
		print_r($data);
		// for ($i=0; $i < count($jurnalUmum); $i++) { 
		// 	for ($j=0; $j < count($jurnalUmum[$i]); $j++) { 
		// 		$this->datatables->add_column('tanggal', $jurnalUmum[$i][$j]['tanggal']);
		// 		$this->datatables->add_column('formulir', $jurnalUmum[$i][$j]['formulir']);
		// 		$this->datatables->add_column('noTrans', $jurnalUmum[$i][$j]['noTrans']);
		// 		$this->datatables->add_column('departemen', $jurnalUmum[$i][$j]['departemen']);
		// 		$this->datatables->add_column('namaperusanaah', $jurnalUmum[$i][$j]['nama_perusahaan']);
		// 		$this->datatables->add_column('akunno', $jurnalUmum[$i][$j]['akunno']);
		// 		$this->datatables->add_column('namaakun', $jurnalUmum[$i][$j]['namaakun']);
		// 		$this->datatables->add_column('departemen', $jurnalUmum[$i][$j]['departemen']);
		// 		switch ($jurnalUmum[$i][$j]['jenisAnggaran']) {
		// 			case 'debit':
		// 				$this->datatables->add_column('debit', "Rp " . number_format($jurnalUmum[$i][$j]['total'],2,',','.'));
		// 				$this->datatables->add_column('kredit', "Rp " . number_format(0,2,',','.'));
		// 				break;
		// 			case 'kredit':
		// 				$this->datatables->add_column('kredit', "Rp " . number_format($jurnalUmum[$i][$j]['total'],2,',','.'));
		// 				$this->datatables->add_column('debit', "Rp " . number_format(0,2,',','.'));
		// 				break;
					
		// 			default:
		// 				# code...
		// 				break;
		// 		}
		// 		$this->datatables->generate();
		// 	}
		// }
	}
}

