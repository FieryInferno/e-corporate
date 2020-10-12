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


class Jurnal extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurnal_model','model');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');
		$per_page = $this->input->get('per_page');

		$base_url = site_url('jurnal/index');
		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
			$base_url = site_url('jurnal/index?tanggalawal='.$tanggalawal.'&tanggalakhir='.$tanggalakhir);
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
			$base_url = site_url('jurnal/index?tanggalawal='.$data['tanggalawal'].'&tanggalakhir='.$data['tanggalakhir']);
		}

		$this->load->library('pagination');		
		$config['base_url'] = $base_url;
		$config['total_rows'] = $this->model->get_count_jurnal($data['tanggalawal'], $data['tanggalakhir']);
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
		$data['get_jurnal'] = $this->model->get_jurnal($per_page, $config['per_page'], $data['tanggalawal'], $data['tanggalakhir']);
		$data['title'] = lang('journal');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Jurnal/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tjurnal');
			if($data) {
				$data['get_jurnal_detail'] = $this->model->get_jurnal_detail($data['id']);
				$data['title'] = lang('journal_entry');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Jurnal/detail';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
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
		$data['title'] = lang('journal');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Jurnal/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'landscape');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("jurnal-umum-". $time, array("Attachment" => false));
	}

	public function create() {
		$data['tanggal'] = date('Y-m-d');
		$data['title'] = lang('journal');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Jurnal/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
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


	public function exportdata() {
		include APPPATH.'third_party/PHPExcel/IOFactory.php';
        $excel = new PHPExcel();
        $excel->getProperties()
        ->setCreator('www.isyanto.com') 
        ->setTitle("Laporan Jurnal Umum") 
        ->setSubject("Jurnal Umum") 
        ->setDescription("Laporan Jurnal Umum");

        $excel->getActiveSheet(0)->setTitle("Jurnal Umum");
        $excel->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="laporanjurnal.xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
	}
}

