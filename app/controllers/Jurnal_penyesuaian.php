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


class Jurnal_penyesuaian extends User_Controller {

	private $idJurnalPenyesuaian;
	private $tanggal;
	private $perusahaan;
	private $debit;
	private $kredit;
	private $keterangan;
	private $noAkun;

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurnal_penyesuaian_model','model');
		$this->set('idJurnalPenyesuaian', $this->input->post('idJurnalPenyesuaian'));
		$this->set('tanggal', $this->input->post('tanggal'));
		$this->set('perusahaan', $this->input->post('perusahaan'));
		$this->set('debit', $this->input->post('debit'));
		$this->set('kredit', $this->input->post('kredit'));
		$this->set('keterangan', $this->input->post('keterangan'));
		$this->set('noAkun', $this->input->post('idAkun'));
	}

	public function index() 
	{
		$data['title']		= lang('adjusting_entries');
		$data['subtitle']	= lang('list');
		$data['content']	= 'Jurnal_penyesuaian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
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

		$data['get_jurnal'] = $this->model->get_jurnal_print($data['tanggalawal'], $data['tanggalakhir']);
		$data['title'] = lang('adjusting_entries');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Jurnal_penyesuaian/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'landscape');
		$pdf->render();
		$time = time();
		$pdf->stream("jurnal-penyesuaian-". $time, array("Attachment" => false));
	}

	public function create() {
		$data['tanggal']	= date('Y-m-d');
		$data['title']		= lang('adjusting_entries');
		$data['subtitle']	= lang('add_new');
		$data['content']	= 'Jurnal_penyesuaian/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function save() {
		$this->model->set('idJurnalPenyesuaian', $this->get('idJurnalPenyesuaian'));
		$this->model->set('tanggal', $this->get('tanggal'));
		$this->model->set('perusahaan', $this->get('perusahaan'));
		$this->model->set('debit', $this->get('debit'));
		$this->model->set('kredit', $this->get('kredit'));
		$this->model->set('keterangan', $this->get('keterangan'));
		$this->model->set('noAkun', $this->get('noAkun'));
		$this->model->set('noAkun', $this->get('noAkun'));
		$data	= $this->model->save();
		if ($data) {
			$data0['status']	= 'success';
		} else {
			$data0['status']	= 'error';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data0));
	}

	// additional
	public function select2_noakun($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		$this->db->where('mnoakun.stdel', '0');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->limit(100);
		if($term) $this->db->like('namaakun', $term);
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	private function set($jenis, $isi)
	{
		if ($jenis == 'idJurnalPenyesuaian') {
			if ($isi) {
				$this->idJurnalPenyesuaian	= $isi;
			} else {
				$this->idJurnalPenyesuaian	= rand(10, 999999999);
			}
		} else {
			$this->$jenis	= $isi;
		}
	}

	private function get($jenis)
	{
		return $this->$jenis;
	}
}

