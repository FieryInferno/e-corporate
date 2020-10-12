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


class Aruskas extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Aruskas_model','model');
		$this->load->model('Neraca_model','neracaModel');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-d');
			$data['tanggalakhir'] = date('Y-m-t');
		}
		$data['total_laba_rugi'] = $this->model->total_laba_rugi($data['tanggalawal'], $data['tanggalakhir']);
		$data['penyusutan'] = $this->model->penyusutan($data['tanggalawal'], $data['tanggalakhir']);
		$data['penurunan_piutang'] = $this->model->penurunan_piutang($data['tanggalawal'], $data['tanggalakhir']);
		$data['peningkatan_utang'] = $this->model->peningkatan_utang($data['tanggalawal'], $data['tanggalakhir']);
		$data['atkendaraan'] = $this->model->atkendaraan($data['tanggalawal'], $data['tanggalakhir']);
		$data['attanah'] = $this->model->attanah($data['tanggalawal'], $data['tanggalakhir']);
		$data['atbangunan'] = $this->model->atbangunan($data['tanggalawal'], $data['tanggalakhir']);

		$data['nrc_persediaan'] = $this->model->nrc_persediaan($data['tanggalawal'], $data['tanggalakhir']);
		$data['nrc_piutang'] = $this->model->nrc_piutang($data['tanggalawal'], $data['tanggalakhir']);
		$data['nrc_utang_usaha'] = $this->model->nrc_utang_usaha($data['tanggalawal'], $data['tanggalakhir']);
		$data['nrc_penyusutan'] = $this->model->nrc_penyusutan($data['tanggalawal'], $data['tanggalakhir']);

		$data['atperalatan'] = $this->model->nrc_get_saldo_akun($data['tanggalawal'], $data['tanggalakhir'], '1511');

		$data['title'] = lang('cashflow');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Aruskas/index';
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
		$data['title'] = lang('cashflow');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Aruskas/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("laba-rugi-". $time, array("Attachment" => false));
	}
}

