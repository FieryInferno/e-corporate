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

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurnal_penyesuaian_model','model');
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
		$this->model->save();
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
}

