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


class Buku_besar extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Buku_besar_model','model');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$per_page = $this->input->get('per_page');

		$base_url = site_url('buku_besar/index');
		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
			$base_url = site_url('buku_besar/index?tanggalawal='.$tanggalawal.'&tanggalakhir='.$tanggalakhir);
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
			$base_url = site_url('buku_besar/index?tanggalawal='.$data['tanggalawal'].'&tanggalakhir='.$data['tanggalakhir']);
		}

		$this->load->library('pagination');		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->model->get_count_noakun($data['tanggalawal'], $data['tanggalakhir']);
		$config['per_page'] = 10;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-link">';
		$config['first_tag_close'] = '</li>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-link">';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li class="page-link">';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li class="page-link">';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="page-link bg-info">';
		$config['cur_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li class="page-link">';
		$config['num_tag_close'] = '</li>';
		$config['page_query_string'] = TRUE;
		
		$this->pagination->initialize($config);

		$data['pagination'] = $this->pagination->create_links();
		$data['get_noakun'] = $this->model->get_noakun($per_page, $config['per_page'], $data['tanggalawal'], $data['tanggalakhir']);

		$data['title'] = lang('ledger');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Buku_besar/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
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

		$data['get_noakun'] = $this->model->get_noakun_print($data['tanggalawal'], $data['tanggalakhir']);
		$data['title'] = lang('ledger');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Buku_besar/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'landscape');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("buku-besar-". $time, array("Attachment" => false));
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tjurnal.*');
		$this->datatables->where('tjurnal.stdel', '0');
		$this->datatables->from('tjurnal');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('ledger');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Buku_besar/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tjurnal');
			if($data) {
				$data['title'] = lang('ledger');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Buku_besar/edit';
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
	public function select2_mpegawaihakakses($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$data = $this->db->where('id', $id)->get('mpegawaihakakses')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$this->db->where('mpegawaihakakses.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mpegawaihakakses', $term);
			$data = $this->db->get('mpegawaihakakses')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}

