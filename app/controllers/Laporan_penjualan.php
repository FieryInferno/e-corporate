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


class Laporan_penjualan extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Laporan_penjualan_model','model');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$kontakid = $this->input->get('kontakid');
		$gudangid = $this->input->get('gudangid');
		$itemid = $this->input->get('itemid');
		$status = $this->input->get('status');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
		}

		$data['kontakid'] = $kontakid;
		$data['gudangid'] = $gudangid;
		$data['itemid'] = $itemid;
		$data['status'] = $status;

		$data['get_faktur_penjualan'] = $this->model->get_faktur_penjualan();
		$data['title'] = lang('sales_report');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Laporan_penjualan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function printpdf() {
		$this->load->library('pdf');
	    $pdf = $this->pdf;

		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$kontakid = $this->input->get('kontakid');
		$gudangid = $this->input->get('gudangid');
		$itemid = $this->input->get('itemid');
		$status = $this->input->get('status');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
		}

		$data['kontakid'] = $kontakid;
		$data['gudangid'] = $gudangid;
		$data['itemid'] = $itemid;
		$data['status'] = $status;

		$data['get_faktur_penjualan'] = $this->model->get_faktur_penjualan();
		$data['title'] = lang('purchase_report');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Laporan_penjualan/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'landscape');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("laporan-penjualan-". $time, array("Attachment" => false));
	}

	// additional
	public function select2_kontakid($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mkontak.id, mkontak.nama as text');
		$this->db->where('mkontak.stdel', '0');
		$this->db->where('mkontak.tipe', '2');
		$this->db->limit(100);
		if($term) $this->db->like('nama', $term);
		if($id) $data = $this->db->where('id', $id)->get('mkontak')->row_array();
		else $data = $this->db->get('mkontak')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_gudangid($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mgudang.id, mgudang.nama as text');
		$this->db->where('mgudang.stdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('nama', $term);
		if($id) $data = $this->db->where('id', $id)->get('mgudang')->row_array();
		else $data = $this->db->get('mgudang')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_itemid($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mitem.id, mitem.nama as text');
		$this->db->where('mitem.stdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('nama', $term);
		if($id) $data = $this->db->where('id', $id)->get('mitem')->row_array();
		else $data = $this->db->get('mitem')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

