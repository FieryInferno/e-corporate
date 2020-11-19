<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utang extends User_Controller {

	private $kontakid;
	private $perusahaan;
	private $tanggal;

	public function __construct() {
		parent::__construct();
		$this->load->model('Utang_model','model');
		$this->setGet('kontakid', $this->input->get('kontakid'));
		$this->perusahaan	= $this->input->get('perusahaanid');
		$this->tanggal		= $this->input->get('tanggal');
	}

	public function index() {
		$data['title']		= lang('Utang');
		$data['subtitle']	= lang('list');
		$data['content']	= 'Utang/index';
		$data['utang']		= [];
		$this->model->setGet('perusahaan', $this->perusahaan);
		array_push($data['utang'], $this->model->get('saldoAwal'));
		array_push($data['utang'], $this->model->get('faktur'));
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->model->setGet('kontakid', $this->setGet('kontakid'));
		$data	= $this->model->indexDatatables();
		return print_r($data);
	}

	public function create() {
		$data['tanggal'] = date('Y-m-d');
		$data['title'] = lang('Utang');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Utang/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function save() {
		$this->model->save();
	}

	public function printpdf() {
		$this->load->library('pdf');
		$pdf = $this->pdf;

		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$kontakid = $this->input->get('kontakid');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
		}

		if($kontakid) {
			$data['kontakid'] = $kontakid;
		} else {
			$data['kontakid'] = '';
		}

		$data['get_utang'] = $this->model->get_utang_print($data['tanggalawal'], $data['tanggalakhir'], $data['kontakid']);
		$data['title'] = lang('Laporan Utang');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Utang/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'portrait');
		$pdf->render();
		$time = time();
		$pdf->stream("laporan-utang-". $time, array("Attachment" => false));
	}

	public function select2_kontak($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$data = $this->db->where('id', $id)->get('mkontak')->row_array();
			$this->db->where('mkontak.tipe', '1');
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$this->db->where('mkontak.stdel', '0');
			$this->db->where('mkontak.tipe', '1');
			$this->db->limit(10);
			if($term) $this->db->like('mkontak.nama', $term);
			$data = $this->db->get('mkontak')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	private function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
		
	}

	public function get()
	{
		$this->model->setGet('perusahaan', $this->perusahaan);
		$this->model->setGet('tanggal', $this->tanggal);
		$data	= [];
		array_push($data, $this->model->get('saldoAwal'));
		array_push($data, $this->model->get('faktur'));
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}