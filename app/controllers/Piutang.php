<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Piutang extends User_Controller {

	private $perusahaan;
	private $tanggalAwal;
	private $tanggalAkhir;
	private $tanggal;
	private $kontak;
	private $usiaPiutang;

	public function __construct() {
		parent::__construct();
		$this->load->model('Piutang_model','model');
		if ($this->session->idperusahaan) {
			$this->perusahaan	= $this->session->idperusahaan;
		} else {
			$this->perusahaan	= $this->input->get('perusahaanid');
		}
		$this->kontak		= $this->input->get('kontakid');
		$this->tanggalAwal	= $this->input->get('tanggalawal');
		$this->tanggalAkhir	= $this->input->get('tanggalakhir');
		$this->usiaPiutang	= $this->input->get('usiaPiutang');
	}

	public function index() {
		$this->model->set('perusahaan', $this->perusahaan);
		$this->model->set('kontak', $this->kontak);
		$this->model->set('tanggalAwal', $this->tanggalAwal);
		$this->model->set('tanggalAkhir', $this->tanggalAkhir);
		$dataPiutang	= $this->model->getPiutang();

		$this->Faktur_penjualan_model->set('perusahaan', $this->perusahaan);
		$this->Faktur_penjualan_model->set('kontak', $this->kontak);
		$this->Faktur_penjualan_model->set('tanggalAwal', $this->tanggalAwal);
		$this->Faktur_penjualan_model->set('tanggalAkhir', $this->tanggalAkhir);
		$piutang		= $this->Faktur_penjualan_model->piutang();

		for ($i=0; $i < count($piutang); $i++) { 
			array_push($dataPiutang, $piutang[$i]); 
    }
    // print_r($dataPiutang);
    // die();

		$dataPiutang1	= [];
		for ($i=0; $i < count($dataPiutang); $i++) { 
			$key				= $dataPiutang[$i];

			$tanggal            = new DateTime($key['tanggal']);
			$tanggalTempo       = new DateTime($key['tanggalTempo']);
			$tanggalSekarang    = new DateTime();
			$selisih            = $tanggalTempo->diff($tanggal)->days;
			$selisih1           = $tanggalSekarang->diff($tanggal)->days;
			$key['usiaPiutang']	= $selisih1 - $selisih;
			
      switch ($this->usiaPiutang) {
        case 'kurang30':
          if ($key['usiaPiutang'] < 30) {
            array_push($dataPiutang1, $key);
          }
          break;

        case '0':
          if ($key['usiaPiutang'] == 0) {
            array_push($dataPiutang1, $key);
          }
          break;
        case 'lebih30':
          if ($key['usiaPiutang'] > 30) {
            array_push($dataPiutang1, $key);
          }
          break;
        
        default:
          # code...
          break;
      } 
    }
    
    usort($dataPiutang1, [$this, 'date_compare']);
    
		$data['title']		= lang('Piutang');
		$data['subtitle']	= lang('list');
		$data['content']	= 'Piutang/index';
		$data['piutang']	= $dataPiutang1;
		$data             = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}
	
	function date_compare($a, $b)
	{
		$t1 = strtotime($a['tanggal']);
		$t2 = strtotime($b['tanggal']);
		return $t2 - $t1;
	}    

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

	public function select2_kontak_piutang($idPerusahaan = null, $idKontak = null) {
    $data = [
      0 => [
        'id'    => 'semua',
        'text'  => 'Semua Kontak'
      ]
    ];
		$term = $this->input->get('q');
		$this->db->select('mkontak.id as id, mkontak.nama as text');
		$this->db->where('mkontak.perusahaan', $idPerusahaan);
		if($term) $this->db->like('mkontak.nama', $term);
    $data1  = $this->db->get('mkontak')->result_array();
    $data   = array_merge($data, $data1);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get()
	{
		$this->model->set('perusahaan', $this->perusahaan);
		$this->model->set('tanggal', $this->tanggal);
    $data	= $this->model->get();
    return print_r($data);
	}

}