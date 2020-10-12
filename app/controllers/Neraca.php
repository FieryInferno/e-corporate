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


class Neraca extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Neraca_model','model');
	}

	public function testing() {
		echo $this->model->getpendapatan('2019-06-27');
	}

	public function index() {
		$tanggal = $this->input->get('tanggal');

		if($tanggal) {
			$data['tanggal'] = $tanggal;
		} else {
			$data['tanggal'] = date('Y-m-d');
		}
		$data['getasetlancar'] = $this->model->getasetlancar($data['tanggal']);
		$data['getasettetap'] = $this->model->getasettetap($data['tanggal']);
		$data['getliabilitas'] = $this->model->getliabilitas($data['tanggal']);
		$data['getmodal'] = $this->model->getmodal($data['tanggal']);
		$data['gettotallabarugi'] = $this->model->gettotallabarugi($data['tanggal']);
		$data['title'] = lang('balance_sheet');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Neraca/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function printpdf() {
		$this->load->library('pdf');
	    $pdf = $this->pdf;

		$tanggal = $this->input->get('tanggal');

		if($tanggal) {
			$data['tanggal'] = $tanggal;
		} else {
			$data['tanggal'] = date('Y-m-d');
		}

		$data['getasetlancar'] = $this->model->getasetlancar($data['tanggal']);
		$data['getasettetap'] = $this->model->getasettetap($data['tanggal']);
		$data['getliabilitas'] = $this->model->getliabilitas($data['tanggal']);
		$data['getmodal'] = $this->model->getmodal($data['tanggal']);
		$data['gettotallabarugi'] = $this->model->gettotallabarugi($data['tanggal']);
		$data['title'] = lang('balance_sheet');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Neraca/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("neraca-". $time, array("Attachment" => false));
	}
}

