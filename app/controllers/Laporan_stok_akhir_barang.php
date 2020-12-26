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


class Laporan_stok_akhir_barang extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Laporan_stok_akhir_barang_model','model');
	}

	public function index() {
		$itemid = $this->input->get('itemid');
		$data['itemid'] = $itemid;
		$data['getstok'] = $this->model->getstok();
		$data['title'] = lang('Laporan Stok Akhir Barang');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Laporan_stok_akhir_barang/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function printpdf() {
		$this->load->library('pdf');
	    $pdf = $this->pdf;
		$itemid = $this->input->get('itemid');
		$data['itemid'] = $itemid;
		$data['getstok'] = $this->model->getstok();
		$data['title'] = lang('Laporan Stok Akhir Barang');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Laporan_stok_akhir_barang/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("laporan-stok-akhir-barang-". $time, array("Attachment" => false));
	}

	// additional

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

