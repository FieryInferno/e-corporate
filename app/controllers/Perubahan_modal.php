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


class Perubahan_modal extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Perubahan_modal_model','model');
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
		$data['getprive'] = $this->model->getprive($data['tanggalawal'], $data['tanggalakhir']);
		$data['getekuitas'] = $this->model->getekuitas($data['tanggalawal'], $data['tanggalakhir']);
		$data['gettotallabarugi'] = $this->model->gettotallabarugi($data['tanggalawal'], $data['tanggalakhir']);
		$data['get_saldo_awal'] = $this->model->get_saldo_awal($data['tanggalawal']);
		$data['title'] = lang('Statement_of_Owner_Equity');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Perubahan_modal/index';
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

		$data['getprive'] = $this->model->getprive($data['tanggalawal'], $data['tanggalakhir']);
		$data['getekuitas'] = $this->model->getekuitas($data['tanggalawal'], $data['tanggalakhir']);
		$data['gettotallabarugi'] = $this->model->gettotallabarugi($data['tanggalawal'], $data['tanggalakhir']);
		$data['get_saldo_awal'] = $this->model->get_saldo_awal($data['tanggalawal']);
		$data['title'] = lang('Statement_of_Owner_Equity');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Perubahan_modal/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("perubahan-modal-". $time, array("Attachment" => false));
	}
}

