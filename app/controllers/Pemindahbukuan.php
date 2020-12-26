<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemindahbukuan extends User_Controller {

	private $idPemindahbukuan;

	public function __construct() {
		parent::__construct();
		$this->load->model('Pemindahbukuan_model','model');
		$this->idPemindahbukuan	= $this->input->post('idPemindahbukuan');
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

		$data['title'] = lang('book-entry');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Pemindahbukuan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpemindahbukuankaskecil.*,mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan','tpemindahbukuankaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->datatables->join('mdepartemen','tpemindahbukuankaskecil.pejabat=mdepartemen.id');
		$this->datatables->from('tpemindahbukuankaskecil');
		return print_r($this->datatables->generate());
	}

	public function printpdf() {
		$this->load->library('pdf');
		$pdf = $this->pdf;
		
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		if($tanggalawal && $tanggalakhir) {
			$data['tipe_cetak'] = '0';
		} else {
			$data['tipe_cetak'] = '1';
		}
		$data['getdata'] = $this->model->cetakdata($tanggalawal,$tanggalakhir);
		$data['title'] = lang('Laporan Pemindahbukuan Kas Kecil');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Pemindahbukuan/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'portrait');
		$pdf->render();
		$time = time();
		$pdf->stream("laporan-pemindahbukuan-kas-kecil-". $time, array("Attachment" => false));
	}

	public function detail()
	{
		$this->model->set('idPemindahbukuan', $this->idPemindahbukuan);
		$data	= $this->model->get();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}
