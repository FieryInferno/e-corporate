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


class Pembayaran_pembelian extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pembayaran_pembelian_model','model');
	}

	public function index() {
		$data['title'] = lang('payment');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Pembayaran_pembelian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpembayaran.*, tfaktur.id as fakturid, tfaktur.notrans as nofaktur, mkontak.nama as kontak');
		$this->datatables->join('tfaktur','tpembayaran.fakturid = tfaktur.id');
		$this->datatables->join('mkontak','tfaktur.kontakid = mkontak.id');
		$this->datatables->where('tpembayaran.tipe','1');
		$this->datatables->from('tpembayaran');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$idfaktur = $this->input->get('idfaktur');
		if(!$idfaktur) {
			show_404();
		}
		
		$data = $this->model->getfaktur($idfaktur);
		if(!$data || $data['status'] == '3') {
			show_404();
		}

		$data['getfakturdetail'] = $this->model->getfakturdetail($idfaktur);
		$data['totaldebetmemo'] = $this->model->gettotaldebetmemo($data['kontakid']);
		$data['title'] = lang('payment');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Pembayaran_pembelian/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getpembayaran($id);
			$data['fakturdetail'] = $this->model->getfakturdetail($data['id']);
			$data['title'] = lang('payment');
			$data['subtitle'] = lang('detail');
			$data['content'] = 'Pembayaran_pembelian/detail';
			$data = array_merge($data,path_info());
			$this->parser->parse('default',$data);
		}
	}

	public function printpdf($id = null) {
	    $this->load->library('pdf');
	    $pdf = $this->pdf;
		$data = $this->model->getpembayaran($id);
		$data['fakturdetail'] = $this->model->getfakturdetail($data['id']);
	    $data['title'] = 'Pembayaran Pembelian';
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Pembayaran_pembelian/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'landscape');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("pembayaran-pembelian-". $time, array("Attachment" => false));
	}

	public function save() {
		$this->model->save();
	}

	public function delete() {
		$this->model->delete();
	}

	// additional
	public function select2_noakunbayar($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$this->db->where('noakunheader', '111');
			$this->db->where('stbayar', '1');
			$data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mnoakun.noakun as id, mnoakun.namaakun as text');
			$this->db->where('noakunheader', '111');
			$this->db->where('stbayar', '1');
			$this->db->where('mnoakun.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('namaakun', $term);
			$data = $this->db->get('mnoakun')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function create_memo() {
		$idfaktur = $this->input->get('idfaktur');
		if(!$idfaktur) {
			show_404();
		}
		
		$data = $this->model->getfaktur($idfaktur);
		if(!$data || $data['status'] == '3') {
			show_404();
		}

		$data['getfakturdetail'] = $this->model->getfakturdetail($idfaktur);
		$data['totaldebetmemo'] = $this->model->gettotaldebetmemo($data['kontakid']);
		$data['title'] = lang('payment');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Pembayaran_pembelian/create_memo';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function save_memo() {
		$this->model->save_memo();
	}
}

