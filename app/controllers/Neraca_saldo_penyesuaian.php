<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca_saldo_penyesuaian extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Neraca_saldo_penyesuaian_model','model');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
		}
		$data['saldo_detail_noakun'] = $this->model->get_neraca_saldo_noakun();
		$data['title'] = lang('adjusted_trial_balance');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Neraca_saldo_penyesuaian/index';
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

		$data['saldo_detail_noakun'] = $this->model->get_neraca_saldo_noakun();
		$data['title'] = lang('adjusted_trial_balance');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Neraca_saldo_penyesuaian/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'landscape');
		$pdf->render();
		$time = time();
		$pdf->stream("neraca-saldo-penyesuaian". $time, array("Attachment" => false));
	}
}

