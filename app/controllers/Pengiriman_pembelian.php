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


class Pengiriman_pembelian extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pengiriman_pembelian_model','model');
	}

	public function index() {
		$data['title'] = lang('goods_receipt');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Pengiriman_pembelian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tPenerimaan.idPenerimaan as id, tPenerimaan.notrans, tPenerimaan.catatan, mperusahaan.nama_perusahaan, tpemesanan.departemen, tpemesanan.tanggal, tpemesanan.total as nominal_pemesanan, mkontak.nama as supplier, tPenerimaan.total as nominal_penerimaan, mgudang.nama as gudang, tPenerimaan.status, tpemesanan.notrans as nopemesanan, tpemesanan.id as idpemesanan');
		$this->datatables->from('tPenerimaan');
		$this->datatables->join('tpemesanan', 'tPenerimaan.pemesanan = tpemesanan.id');
		$this->datatables->join('mkontak','tpemesanan.kontakid = mkontak.id', 'left');
		$this->datatables->join('mgudang','tPenerimaan.gudang = mgudang.id', 'left');
		$this->datatables->join('mperusahaan','tpemesanan.idperusahaan = mperusahaan.idperusahaan');
		$this->datatables->where('tpemesanan.status', '6');
		return print_r($this->datatables->generate());
	}

	public function create($id) {
		$data['title'] 					= lang('goods_receipt');
		$data['subtitle'] 				= lang('detail');
		$data['tanggal'] 				= date('Y-m-d');
		$data['content']				= 'Pengiriman_pembelian/create';
		$data['pengiriman']				= $this->model->get($id);
		$this->db->select('tpemesanandetail.*, mitem.nama as nama_barang, mitem.kode');
		$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
		$data['pengiriman']['detail']	= $this->db->get_where('tpemesanandetail', [
			'idpemesanan'	=> $data['pengiriman']['idpemesanan']
		])->result_array();
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getpengiriman($id);
			if($data) {
				$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['pengirimandetail'] = $this->model->pengirimandetail($data['id']);
				$data['title'] = lang('goods_receipt');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Pengiriman_pembelian/detail';
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
		$data = $this->model->getpengiriman($id);
		$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
		$data['pengirimandetail'] = $this->model->pengirimandetail($data['id']);
		$data['title'] = lang('Surat Jalan');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Pengiriman_pembelian/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'portrait');
		$pdf->render();
		$time = time();
		$pdf->stream("pengiriman-pembelian-". $time, array("Attachment" => false));
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tpengiriman');
			if($data) {
				$data['title'] = lang('goods_receipt');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Pengiriman_pembelian/edit';
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

	public function select2_pemesanan()
	{
		$pemesanan	= $this->Pemesanan_pembelian_model->get();
		$no			= 0;
		foreach ($pemesanan as $key) {
			$data[$no]['id']	= $key['id'];
			$data[$no]['text']	= $key['notrans'] . ' - ' . $key['nama_perusahaan'] . ' - ' . number_format($key['total'],2,',','.');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function validasi($status= null, $id = null)
	{
		switch ($status) {
			case '0':
				$this->db->set('status','3');
				break;
			case '1':
				$this->db->set('status','1');
				break;
				# code...
				break;
		}
		$this->db->where('idPenerimaan', $id);
		$update = $this->db->update('tPenerimaan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('update_error_message');
		}
		redirect(base_url('pengiriman_pembelian'));	
	}

	public function select2($kontak = null)
	{
		$data	= $this->model->get(null, $kontak);
		$no		= 0;
		foreach ($data as $key) {
			$data0[$no]['id']	= $key['id'];
			$data0[$no]['text']	= $key['notrans'] . ' - ' . $key['tanggal_pengiriman'] . ' - ' . $key['supplier'] . ' - ' . number_format($key['nominal_penerimaan'],2,',','.');
			$no++;
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data0));
	}

	public function get_detail_item()
	{
		$this->model->get_detail_item();
	}
}

