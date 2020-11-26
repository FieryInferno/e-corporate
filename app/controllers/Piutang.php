<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends User_Controller {

	private $perusahaan;
	private $tanggal;

	public function __construct() {
		parent::__construct();
		$this->load->model('Piutang_model','model');
		$this->perusahaan	= $this->input->get('perusahaanid');
		$this->tanggal		= $this->input->get('tanggal');
	}

	public function index() {
		$data['title']		= lang('Piutang');
		$data['subtitle']	= lang('list');
		$data['content']	= 'Piutang/index';
		$this->model->set('perusahaan', $this->perusahaan);
		$data['piutang']	= $this->model->get();
		$piutang	= $this->Faktur_penjualan_model->piutang();
		for ($i=0; $i < count($piutang); $i++) { 
			array_push($data['piutang'], $piutang[$i]); 
		}
		// usort($data['piutang'], [$this, 'date_compare']);
		// die();
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
	
	// function date_compare($a, $b)
	// {
	// 	print_r(strtotime($a['tanggal']));echo '<br/>';
	// 	$t1 = strtotime($a['tanggal']);
	// 	$t2 = strtotime($b['tanggal']);
		// $t1 = $a['primeOwing'];
		// $t2 = $b['primeOwing'];
		// return $t1 - $t2;
	// 	return ($t1 < $t2)?-1:1;
	// }    

	public function create() {
		$data['tanggal'] = date('Y-m-d');
		$data['title'] = lang('Piutang');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Piutang/create';
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

		$data['get_piutang'] = $this->model->get_piutang_print($data['tanggalawal'], $data['tanggalakhir'], $data['kontakid']);
		$data['title'] = lang('Laporan Piutang');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Piutang/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'portrait');
		$pdf->render();
		$time = time();
		$pdf->stream("laporan-utang-". $time, array("Attachment" => false));
	}

	public function select2_kontak($idPerusahaan = null, $idKontak = null) {
		$term = $this->input->get('q');
		if($idKontak) {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$this->db->where('mkontak.perusahaan', $idPerusahaan);
			$data = $this->db->where('id', $idKontak)->get('mkontak')->row_array();
			$this->db->where('mkontak.tipe', '1');
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$this->db->where('mkontak.tipe', '1');
			$this->db->where('mkontak.perusahaan', $idPerusahaan);
			// $this->db->limit(10);
			if($term) $this->db->like('mkontak.nama', $term);
			$data = $this->db->get('mkontak')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get()
	{
		$this->model->set('perusahaan', $this->perusahaan);
		$this->model->set('tanggal', $this->tanggal);
		$data	= $this->model->get();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}