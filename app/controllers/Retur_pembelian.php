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


class Retur_pembelian extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Retur_pembelian_model','model');
	}

	public function arr() {
		$data = array('id' => 1);
		$jumlahsisa = array('jumlahsisa' => 1);
		$data = array_merge($data, $jumlahsisa);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function index() {
		$data['title'] = lang('return');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Retur_pembelian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tretur.*, mkontak.nama as supplier, mgudang.nama as gudang, tfaktur.notrans as nofaktur');
		$this->datatables->join('mkontak','tretur.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tretur.gudangid = mgudang.id','left');
		$this->datatables->join('tfaktur','tretur.fakturid = tfaktur.id','left');
		$this->datatables->where('tretur.tipe','1');
		$this->datatables->from('tretur');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$idfaktur = $this->input->get('idfaktur');
		$idpengiriman = $this->input->get('idpengiriman');
		if($idfaktur && $idpengiriman) {
			show_404();
		}

		if($idfaktur) {
			$detailfaktur = get_by_id('id',$idfaktur,'tfaktur');
			if(!$detailfaktur) {
				show_404();
			}
			$data['tanggal'] = date('Y-m-d');
			$data['fakturdetail'] = $this->model->fakturdetail($detailfaktur['id']);
			$data['content'] = 'Retur_pembelian/create';
			$data['title'] = lang('return');
			$data['subtitle'] = lang('add_new');
			$data = array_merge($data,path_info(),$detailfaktur);
			$this->parser->parse('default',$data);
		}
	}

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getretur($id);
			if($data) {
				$data['returdetail'] = $this->model->returdetail($data['id']);
				$data['title'] = lang('return');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Retur_pembelian/detail';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function printpdf($id = null) {
	    $this->load->library('pdf');
	    $pdf = $this->pdf;
	    $data = $this->model->getretur($id);
		$data['returdetail'] = $this->model->returdetail($data['id']);
	    $data['title'] = 'Pengembalian Barang';
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Retur_pembelian/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("pemesanan-pembelian-". $time, array("Attachment" => false));
	}

	public function save() {
		$this->model->save();
	}	

	public function delete() {
		$this->model->delete();
	}

	// additional
	
	public function get_detail_item_faktur() {
		$this->model->get_detail_item_faktur();
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
			if($term) $this->db->like('mkontak', $term);
			$data = $this->db->get('mkontak')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_gudang($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mgudang.id, mgudang.nama as text');
			$data = $this->db->where('id', $id)->get('mgudang')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mgudang.id, mgudang.nama as text');
			$this->db->where('mgudang.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mgudang', $term);
			$data = $this->db->get('mgudang')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_item($id = null) {
		$idfaktur = $this->input->get('idfaktur');
		$faktur = get_by_id('id',$idfaktur,'tfaktur');

		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->join('mitem', 'mitem.id = tfakturdetail.itemid', 'left');
			$this->db->where('tfakturdetail.jumlahsisa >', 0);
			$this->db->where('tfakturdetail.refid', $idfaktur);
			$data = $this->db->where('mitem.id', $id)->get('tfakturdetail')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('tfakturdetail.jumlahsisa >', 0);
			$this->db->where('tfakturdetail.idfaktur', $idfaktur);
			$this->db->join('mitem', 'mitem.id = tfakturdetail.itemid', 'left');
			$this->db->limit(100);
			if($term) $this->db->like('mitem.nama', $term, 'after');
			$data = $this->db->get('tfakturdetail')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_detail_item() {
		$this->model->get_detail_item();
	}
}

