<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jurnal extends User_Controller {

	private	$tglMulai;
	private	$tglSampai;
	private	$akunno;
	private	$perusahaan;
	private	$tipe;

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
		$this->model->set('tipe', $this->tipe);
		$this->model->set('tglMulai', $this->tglMulai);
		$this->model->set('tglSampai', $this->tglSampai);
		$this->model->set('akunno', $this->akunno);
		$this->model->set('perusahaan', $this->perusahaan);
		$data['jurnalUmum']	= $this->model->get();
		// $data['jurnalUmum']	= [];
		
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

