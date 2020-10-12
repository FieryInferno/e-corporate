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


class Laba_rugi extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Laba_rugi_model','model');
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
		$data['penjualan'] = $this->model->get_penjualan($data['tanggalawal'], $data['tanggalakhir']);
		$data['hpp'] = $this->model->get_hpp($data['tanggalawal'], $data['tanggalakhir']);
		$data['operasional'] = $this->model->get_operasional($data['tanggalawal'], $data['tanggalakhir']);
		$data['pendapatanlainnya'] = $this->model->get_pendapatan_lainnya($data['tanggalawal'], $data['tanggalakhir']);
		$data['biayalainnya'] = $this->model->get_biaya_lainnya($data['tanggalawal'], $data['tanggalakhir']);
		$data['title'] = lang('income_statement');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Laba_rugi/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
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

