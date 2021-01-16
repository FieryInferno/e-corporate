<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requiremen extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Requiremen_model','model');
	}

	public function index() {
		$data['title'] = lang('Permintaan Pembelian');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Requiremen/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpemesanan.*, mkontak.nama as supplier, mgudang.nama as gudang, mperusahaan.nama_perusahaan');
		$this->datatables->join('mkontak','tpemesanan.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tpemesanan.gudangid = mgudang.id','left');
		$this->datatables->join('mperusahaan','tpemesanan.idperusahaan = mperusahaan.idperusahaan','left');
		$this->datatables->from('tpemesanan');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$data['title'] = lang('Permintaan Pembelian');
		$data['subtitle'] = lang('add_new');
		$data['tanggal'] = date('Y-m-d');
		$data['content'] = 'Requiremen/tambah';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function detail($id = null) {
		if($id) {
			$data	= get_by_id('id',$id,'tpemesanan');
			if($data) {
				$data['kontak'] 			= get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] 			= get_by_id('id',$data['gudangid'],'mgudang');
				$data['pemesanandetail'] 	= $this->model->pemesanandetail($data['id']);
				$data['title'] 				= lang('purchase_order');
				$data['subtitle'] 			= lang('detail');
				$data['content'] 			= 'Requiremen/detail';
				$data['angsuran']			= $this->Pemesanan_pembelian_model->get_angsuran($data['id']);
				$data 						= array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function validasi($status= null, $id = null)
	{
		$this->db->set('uby',get_user('username'));
		$this->db->set('udate',date('Y-m-d H:i:s'));
		switch ($status) {
			case '0':
				$this->db->set('status','5');
				break;
			case '1':
				$this->db->set('status','4');
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
		redirect(base_url('requiremen'));	
	}
	
	public function print($jenis = null, $id = null) {
		switch ($jenis) {
			case 'pdf':
				$this->load->library('pdf');
				$pdf						= $this->pdf;
				$data						= $this->model->get($id);
				$data['kontak'] 			= get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] 			= get_by_id('id',$data['gudangid'],'mgudang');
				$data['pemesanandetail']	= $this->model->pemesanandetail($data['id']);
				$data['title']				= lang('purchase_order');
				$data['css']				= file_get_contents(FCPATH.'assets/css/print.min.css');
				$data						= array_merge($data,path_info());
				$html						= $this->load->view('Requiremen/printpdf', $data, TRUE);
				$pdf->loadHtml($html);
				$pdf->setPaper('A4', 'portrait');
				$pdf->render();
				$time = time();
				$pdf->stream("permintaanPembelian". $time, array("Attachment" => false));
				break;
			
			default:
				# code...
				break;
		}
	}

	public function save($id_pemesanan = null) {
		$this->model->save($id_pemesanan);
	}

	public function delete() {
		$this->model->delete();
	}

	// additional
	public function select2_item($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('tanggaranbelanjadetail.id as itemid, mitem.nama as text, tanggaranbelanjadetail.koderekening, tanggaranbelanja.*');
			$this->db->join('tanggaranbelanja', 'tanggaranbelanjadetail.idanggaran=tanggaranbelanja.id');
			$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
			$this->db->from('tanggaranbelanjadetail');
			$this->db->where('tanggaranbelanjadetail.id', $id);
			$data = $this->db->get()->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('tanggaranbelanjadetail.id as itemid, mitem.nama as text, tanggaranbelanjadetail.koderekening, tanggaranbelanja.*');
			$this->db->join('tanggaranbelanjadetail', 'tanggaranbelanjadetail.idanggaran=tanggaranbelanja.id');
			$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
			$this->db->where('tanggaranbelanja.status', 'Validate');
			$this->db->where('tanggaranbelanja.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('tanggaranbelanja.uraian', $term);
			$data = $this->db->get('tanggaranbelanja')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_item_jasa() {
		$q	= $this->input->get('q');
		$this->db->select('tanggaranbelanjadetail.id as itemid, mitem.nama as text');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
		$this->db->join('mkategori', 'mitem.kategoriid = mkategori.id');
		$this->db->where('mkategori.nama', 'Jasa');
		if ($q) {
			$this->db->like('mitem.nama', $q);
		}
		$data	= $this->db->get('tanggaranbelanjadetail')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_kontak($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$data = $this->db->where('id', $id)->get('mkontak')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mkontak.id, mkontak.nama as text');
			if($term) $this->db->like('mkontak.nama', $term);
			$data = $this->db->get('mkontak')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function update_kontakid($id)
	{
		$this->db->where('id', $id);
		$this->db->update('tpemesanan', ['kontakid' => $this->input->post('kontakid')]);
		$data['status']		= 'success';
		$data['message']	= lang('update_success_message');
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
	public function select2_mperusahaan($id = null)
	{
		if ($id) {
			$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
			$data = $this->db->where('idperusahaan', $id)->get('mperusahaan')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
			$this->db->limit(10);
			$data = $this->db->get('mperusahaan')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mdepartemen($id = null, $text = null)
	{
		if ($text) {
			$this->db->select('tanggaranbelanja.dept as id, tanggaranbelanja.dept as text');
			$this->db->where('tanggaranbelanja.idperusahaan', $id);
			$this->db->where('tanggaranbelanja.dept', $text);
			$data = $this->db->get('tanggaranbelanja')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.nama as id, mdepartemen.nama as text');
			$this->db->where('mdepartemen.id_perusahaan', $id);
			$this->db->limit(10);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mdepartemen_pejabat($dept = null, $text = null)
	{
		if ($text) {
			$this->db->select('tanggaranbelanja.pejabat as id, tanggaranbelanja.pejabat as text');
			$this->db->where('tanggaranbelanja.dept', $dept);
			$this->db->where('tanggaranbelanja.pejabat', $text);
			$data = $this->db->get('tanggaranbelanja')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.pejabat as id, mdepartemen.pejabat as text');
			$this->db->where('mdepartemen.nama', $dept);
			$this->db->limit(10);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	public function get_detail_item() {
		$this->model->get_detail_item();
	}
	public function detail_item() {
		$this->model->detail_item();
	}

	public function tambah_angsuran()
	{
		$this->model->tambah_angsuran();
	}

	public function edit($id)
	{
		$data['title']		= lang('Permintaan Pembelian');
		$data['subtitle']	= lang('Edit');
		$data['content']	= 'Requiremen/edit';
		$data['edit']		= $this->model->get($id);
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
  }
}

