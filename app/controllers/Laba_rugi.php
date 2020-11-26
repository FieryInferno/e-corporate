<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi extends User_Controller {

	private $perusahaan;
	private $tanggalawal;
	private $tanggalakhir;

	public function __construct() {
		parent::__construct();
		$this->load->model('Laba_rugi_model','model');
		$this->perusahaan	= $this->input->get('perusahaan');
		$this->tanggalawal	= $this->input->get('tanggalAwal');
		$this->tanggalakhir	= $this->input->get('tanggalAkhir');
	}

	public function index() {
		$this->model->set('perusahaan', $this->perusahaan);
		$this->model->set('tanggalawal', $this->tanggalawal);
		$this->model->set('tanggalakhir', $this->tanggalakhir);
		$data['penjualan']	= $this->model->get('4', '4');
		$data['hpp']		= $this->model->get('5', '5');
		// $data['operasional'] = $this->model->get_operasional($data['tanggalawal'], $data['tanggalakhir']);
		$data['pendapatanlainnya']	= $this->model->get('7', '7');
		$data['biayalainnya']		= $this->model->get('6', '8');
		if ($this->tanggalawal) {
			$data['tanggalawal']	= $this->tanggalawal;
			$data['tanggalakhir']	= $this->tanggalakhir;
		} 
		$data['title'] = lang('income_statement');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Laba_rugi/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
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

		$data['penjualan'] = $this->model->get_penjualan($data['tanggalawal'], $data['tanggalakhir']);
		$data['hpp'] = $this->model->get_hpp($data['tanggalawal'], $data['tanggalakhir']);
		$data['operasional'] = $this->model->get_operasional($data['tanggalawal'], $data['tanggalakhir']);
		$data['pendapatanlainnya'] = $this->model->get_pendapatan_lainnya($data['tanggalawal'], $data['tanggalakhir']);
		$data['biayalainnya'] = $this->model->get_biaya_lainnya($data['tanggalawal'], $data['tanggalakhir']);
		$data['title'] = lang('income_statement');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Laba_rugi/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("laba-rugi-". $time, array("Attachment" => false));
	}
}

