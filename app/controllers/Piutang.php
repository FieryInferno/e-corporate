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


class Piutang extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Piutang_model','model');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$kontakid = $this->input->get('kontakid');
		$per_page = $this->input->get('per_page');

		$base_url = site_url('piutang/index');
		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
			$base_url = site_url('piutang/index?tanggalawal='.$tanggalawal.'&tanggalakhir='.$tanggalakhir);
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
			$base_url = site_url('piutang/index?tanggalawal='.$data['tanggalawal'].'&tanggalakhir='.$data['tanggalakhir']);
		}

		if($kontakid) {
			$data['kontakid'] = $kontakid;
		} else {
			$data['kontakid'] = '';
		}

		$this->load->library('pagination');		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->model->get_count_piutang($data['tanggalawal'], $data['tanggalakhir'], $data['kontakid']);
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
		$data['get_piutang'] = $this->model->get_piutang($per_page, $config['per_page'], $data['tanggalawal'], $data['tanggalakhir'], $data['kontakid']);
		$data['title'] = lang('Piutang');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Piutang/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpengeluarankas.*');
		$this->datatables->from('tpengeluarankas');
		return print_r($this->datatables->generate());
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
			$this->db->where('mkontak.tipe', '2');
			$this->db->limit(10);
			if($term) $this->db->like('mkontak.nama', $term);
			$data = $this->db->get('mkontak')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

}