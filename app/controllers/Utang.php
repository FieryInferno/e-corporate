<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Utang extends User_Controller {

	private $perusahaan;
	private $tanggal;
	private $tanggalAwal;
	private $tanggalAkhir;
	private $kontak;
	private $usiaPiutang;

	public function __construct() {
		parent::__construct();
		$this->load->model('Utang_model','model');
		if ($this->session->idperusahaan) {
			$this->perusahaan	= $this->session->idperusahaan;
		} else {
			$this->perusahaan	= $this->input->get('perusahaanid');
		}
		$this->kontak		= $this->input->get('kontakid');
		$this->tanggalAwal	= $this->input->get('tanggalawal');
		$this->tanggalAkhir	= $this->input->get('tanggalakhir');
		$this->usiaHutang	= $this->input->get('usiaHutang');
	}

	public function index() {
		$this->model->set('perusahaan', $this->perusahaan);
		$this->model->set('kontak', $this->kontak);
		$this->model->set('tanggalAwal', $this->tanggalAwal);
		$this->model->set('tanggalAkhir', $this->tanggalAkhir);
		$saldoAwal			= $this->model->get('saldoAwal');
		$fakturPembelian	= $this->model->get('faktur');

		for ($i=0; $i < count($fakturPembelian); $i++) { 
			array_push($saldoAwal, $fakturPembelian[$i]); 
		}

		$dataHutang	= [];
		for ($i=0; $i < count($saldoAwal); $i++) { 
			$key				= $saldoAwal[$i];

			$tanggal            = new DateTime($key['tanggal']);
			$tanggalTempo       = new DateTime($key['tanggaltempo']);
			$tanggalSekarang    = new DateTime();
			$selisih            = $tanggalTempo->diff($tanggal)->days;
			$selisih1           = $tanggalSekarang->diff($tanggal)->days;
			$key['usiaHutang']	= $selisih1 - $selisih;

			switch ($this->usiaHutang) {
				case 'kurang30':
					if ($key['usiaHutang'] < 30) {
						array_push($dataHutang, $key);
					}
					break;

				case '0':
					if ($key['usiaHutang'] == 0) {
						array_push($dataHutang, $key);
					}
					break;
				case 'lebih30':
					if ($key['usiaHutang'] > 30) {
						array_push($dataHutang, $key);
					}
					break;
				
				default:
					# code...
					break;
			}
		}

		usort($dataHutang, [$this, 'date_compare']);

		$data['title']		= lang('Utang');
		$data['subtitle']	= lang('list');
		$data['content']	= 'Utang/index';
		$data['utang']		= $dataHutang;
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
	
	function date_compare($a, $b)
	{
		$t1 = strtotime($a['tanggal']);
		$t2 = strtotime($b['tanggal']);
		return $t2 - $t1;
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
		$this->model->set('perusahaan', $this->perusahaan);
		$this->model->set('tanggal', $this->tanggal);
		$data	= [];
		array_push($data, $this->model->get('saldoAwal'));
		array_push($data, $this->model->get('faktur'));
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}