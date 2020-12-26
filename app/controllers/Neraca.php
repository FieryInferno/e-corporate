<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Neraca extends User_Controller {

	private $perusahaan;
	private $tanggalAkhir;
	private $tanggalAwal;

	public function __construct() {
		parent::__construct();
		$this->load->model('Neraca_model','model');
		$this->perusahaan	= $this->input->get('perusahaan');
		$this->tanggalAwal	= $this->input->get('tanggalAwal');
		$this->tanggalAkhir	= $this->input->get('tanggalAkhir');
	}

	public function testing() {
		echo $this->model->getpendapatan('2019-06-27');
	}

	public function index() {
		if ($this->perusahaan) {
			$this->model->set('perusahaan', $this->perusahaan);
			$this->model->set('tanggalAwal', $this->tanggalAwal);
			$this->model->set('tanggalAkhir', $this->tanggalAkhir);
			$data['getasetlancar']		= $this->model->getasetlancar();
			// $data['getasettetap'] = $this->model->getasettetap($data['tanggal']);
			$data['getliabilitas']		= $this->model->getliabilitas();
			// $data['getmodal'] = $this->model->getmodal($data['tanggal']);
			$data['gettotallabarugi']	= $this->model->gettotallabarugi();
			$data['ekuitas']			= $this->model->getEkuitas();
			$tanggalAwal_ = date('Y-m-d', strtotime('-1 month', strtotime($this->tanggalAwal))); 
			$data['periode_ini'] = date('F Y', strtotime($this->tanggalAkhir));
			$data['periode_lalu'] = date('F Y', strtotime($tanggalAwal_));
		} else {
			$data['getasetlancar']	= null;
			// $data['getasettetap'] = $this->model->getasettetap($data['tanggal']);
			$data['getliabilitas']	= null;
			// $data['getmodal'] = $this->model->getmodal($data['tanggal']);
			$data['gettotallabarugi']	= null;
			$data['ekuitas']			= null;
			$data['periode_ini'] = 'Periode Ini';
			$data['periode_lalu'] = 'Periode Lalu';
		}
		$data['title']		= lang('balance_sheet');
		
		$data['subtitle']	= lang('list');
		$data['content']	= 'Neraca/index';
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
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

