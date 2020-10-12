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

class Faktur_pembelian extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Faktur_pembelian_model','model');
	}

	public function index() {
		$data['title'] = lang('invoice');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Faktur_pembelian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tfaktur.id, tfaktur.notrans,  mperusahaan.nama_perusahaan as namaperusahaan,  tfaktur.tanggal, mkontak.nama as rekanan, mgudang.nama as gudang, mkontak.nama as supplier, tfaktur.biayapengiriman as biaya_pengiriman, tfaktur.total as total, tfaktur.status as status, tfaktur.ppn as pajak, tfaktur.biayapengiriman');
		$this->datatables->join('mkontak','tfaktur.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tfaktur.gudangid = mgudang.id','left');
		$this->datatables->join('mperusahaan','tfaktur.perusahaanid = mperusahaan.idperusahaan','left');
		// $this->datatables->where('tfaktur.tipe','1');
		$this->datatables->from('tfaktur');
		return print_r($this->datatables->generate());
	}

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getfaktur($id);
			if($data) {
				$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['fakturdetail'] = $this->model->fakturdetail($data['id']);

				$data['title'] = lang('invoice');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Faktur_pembelian/detail';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function create() {
		// $idpemesanan = $this->input->get('idpemesanan');
		// $idpengiriman = $this->input->get('idpengiriman');
		// if($idpemesanan && $idpengiriman) {
		// 	show_404();
		// }

		// if($idpemesanan) {
		// 	$detailpemesanan = get_by_id('id',$idpemesanan,'tpemesanan');
		// 	if(!$detailpemesanan) {
		// 		show_404();
		// 	}
		// 	$data['tanggal'] = date('Y-m-d');
		// 	$data['pemesanandetail'] = $this->model->pemesanandetail($detailpemesanan['id']);
		// 	$data['content'] = 'Faktur_pembelian/create_from_pemesanan';
		// 	$data['title'] = lang('invoice');
		// 	$data['subtitle'] = lang('add_new');
		// 	$data = array_merge($data,path_info(),$detailpemesanan);
		// 	$this->parser->parse('default',$data);
		// } 
		// if($idpengiriman) {
		// 	$detailpengiriman = get_by_id('id',$idpengiriman,'tpengiriman');
		// 	if(!$detailpengiriman) {
		// 		show_404();
		// 	}
		// 	$data = $this->model->getpemesanan($detailpengiriman['pemesananid']);
		// 	$data['tanggal'] = date('Y-m-d');
		// 	$data['pengirimandetail'] = $this->model->pengirimandetail($detailpengiriman['id']);
		// 	$data['content'] = 'Faktur_pembelian/create_from_pengiriman';
		// 	$data['title'] = lang('invoice');
		// 	$data['subtitle'] = lang('add_new');
		// 	$data = array_merge($data,path_info(),$detailpengiriman);
		// 	$this->parser->parse('default',$data);
		// }
		// if(!$idpengiriman && !$idpemesanan) {
			$data['tanggal'] = date('Y-m-d');
			$data['content'] = 'Faktur_pembelian/create';
			$data['title'] = lang('invoice');
			$data['subtitle'] = lang('add_new');
			$data = array_merge($data,path_info());
			$this->parser->parse('template',$data);			
		// }

	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tfaktur');
			if($data) {
				$data['title'] = lang('invoice');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Faktur_pembelian/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save() {
		$this->model->save();
	}

	public function delete() {
		$this->model->delete();
	}

	// additional
	public function cekjumlahinput() {
		$this->model->cekjumlahinput();
	}

	public function detailitem() {
		$this->model->detailitem();
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
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mitem.id, mitem.nama as text');
			$data = $this->db->where('id', $id)->get('mitem')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('mitem.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('nama', $term);
			$data = $this->db->get('mitem')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_detail_item() {
		$this->model->get_detail_item();
	}



	public function printpdf($id = null) {
	    $this->load->library('pdf');
	    $pdf = $this->pdf;
	    $data = $this->model->getfaktur($id);
		$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
		$data['fakturdetail'] = $this->model->fakturdetail($data['id']);
	    $data['title'] = 'FAKTUR PEMBELIAN';
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Faktur_pembelian/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("faktur-pembelian-". $time, array("Attachment" => false));
	}
}

