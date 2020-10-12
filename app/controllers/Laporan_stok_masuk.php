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


class Laporan_stok_masuk extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Laporan_stok_masuk','model');
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

		$data['get_faktur_stok_masuk'] = $this->model->get_faktur_stok_masuk();
		$data['title'] = lang('purchase_report');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Laporan_stok_masuk/index';
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

		$data['get_faktur_stok_masuk'] = $this->model->get_faktur_stok_masuk();
		$data['title'] = lang('purchase_report');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Laporan_stok_masuk/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'landscape');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("laporan-pembelian-". $time, array("Attachment" => false));
	}

	public function export_excel() {
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

		$get_faktur_stok_masuk = $this->model->get_faktur_stok_masuk();


		include APPPATH.'third_party/PHPExcel/IOFactory.php';
		$excel = new PHPExcel();
        $excel->getProperties()
        ->setCreator('Isyanto')
        ->setLastModifiedBy('Isyanto.id@gmail.com')
        ->setTitle(lang('purchase_report')) 
        ->setSubject(lang('purchase_report')) 
        ->setDescription(lang('purchase_report')) 
        ->setKeywords(lang('purchase_report'));

        $excel->setActiveSheetIndex(0)->setCellValue('A1', 'NO');
        $excel->setActiveSheetIndex(0)->setCellValue('B1', 'TANGGAL');
        $excel->setActiveSheetIndex(0)->setCellValue('C1', 'KETERANGAN');
        $excel->setActiveSheetIndex(0)->setCellValue('D1', 'NOAKUN');
        $excel->setActiveSheetIndex(0)->setCellValue('E1', 'DEBET');
        $excel->setActiveSheetIndex(0)->setCellValue('F1', 'KREDIT');
        $excel->setActiveSheetIndex(0)->setCellValue('G1', 'KOREKSI');
	}

	// additional
	public function select2_kontakid($id = null) {
		$term = $this->input->get('q');
		$this->db->select('mkontak.id, mkontak.nama as text');
		$this->db->where('mkontak.stdel', '0');
		$this->db->where('mkontak.tipe', '1');
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

