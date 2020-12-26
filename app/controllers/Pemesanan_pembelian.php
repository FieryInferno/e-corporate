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


class Pemesanan_pembelian extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pemesanan_pembelian_model','model');
	}

	public function index() {
		$data['title'] 		= lang('purchase_order');
		$data['subtitle'] 	= lang('list');
		$data['content'] 	= 'Pemesanan_pembelian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpemesanan.*, mkontak.nama as supplier, mgudang.nama as gudang, mperusahaan.nama_perusahaan, tpemesananangsuran.id as rencana_pembayaran');
		$this->datatables->join('mkontak','tpemesanan.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tpemesanan.gudangid = mgudang.id','left');
		$this->datatables->join('mperusahaan','tpemesanan.idperusahaan = mperusahaan.idperusahaan','left');
		$this->datatables->join('tpemesananangsuran','tpemesanan.id = tpemesananangsuran.idpemesanan', 'left');
		$this->datatables->where('tpemesanan.status','5');
		$this->datatables->or_where('tpemesanan.status','6');
		$this->datatables->from('tpemesanan');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('purchase_order');
		$data['subtitle'] = lang('add_new');
		$data['tanggal'] = date('Y-m-d');
		$data['content'] = 'Pemesanan_pembelian/create';
		$data = array_merge($data,path_info());
		$this->parser->parse('default',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tpemesanan');
			if($data) {
				$data['kontak']				= get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang']				= get_by_id('id',$data['gudangid'],'mgudang');
				$data['pemesanandetail']	= $this->model->pemesanandetail($data['id']);
				$data['title']				= 'Detail';
				$data['content']			= 'Pemesanan_pembelian/detail_baru';
				$data['angsuran']			= $this->model->get_angsuran($data['id']);
				$data = array_merge($data,path_info());
				$this->parser->parse('template',$data);
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
		$data = get_by_id('id',$id,'tpemesanan');
		$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
		$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
		$data['pemesanandetail'] = $this->model->pemesanandetail($data['id']);
		$data['title'] = lang('purchase_order');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Pemesanan_pembelian/printpdf', $data, TRUE);
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
			if($term) $this->db->like('mitem.nama', $term);
			$data = $this->db->get('mitem')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
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
			if($term) $this->db->like('mkontak.nama', $term);
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
			if($term) $this->db->like('mgudang.nama', $term);
			$data = $this->db->get('mgudang')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	public function get_detail_item() {
		$this->model->get_detail_item();
	}

	public function edit($id)
	{
		$data['title']		= lang('Pemesanan Pembelian');
		$data['subtitle']	= lang('Edit');
		$data['content']	= 'Pemesanan_pembelian/edit';
		$data['edit']		= $this->model->get($id);
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function validasi($status= null, $id = null)
	{
		$this->db->set('uby',get_user('username'));
		$this->db->set('udate',date('Y-m-d H:i:s'));
		switch ($status) {
			case '0':
				$this->db->set('status','6');
				break;
			case '1':
				$this->db->set('status','5');
				break;
				# code...
				break;
		}
		$this->db->where('id', $id);
		$update = $this->db->update('tpemesanan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('update_error_message');
		}
		redirect(base_url('pemesanan_pembelian'));	
	}

	public function get()
	{
		$id		= $this->input->post('id');
		$data	= $this->model->get($id);
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

