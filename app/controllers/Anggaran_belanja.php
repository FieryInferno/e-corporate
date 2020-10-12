<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran_belanja extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Anggaran_belanja_model', 'model');
	}

	public function index()
	{
		$data['title'] = lang('anggaran_belanja');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Anggaran_belanja/index';
		$data['total_nominal'] = $this->model->hitungJumlahNominal();	
		$data = array_merge($data, path_info());
		$this->parser->parse('default', $data);
	}

	public function index_datatable()
	{
		$this->load->library('Datatables');
		$this->datatables->select('tanggaranbelanja.*,mperusahaan.*');
		$this->datatables->join('mperusahaan','tanggaranbelanja.idperusahaan=mperusahaan.idperusahaan');
		$this->datatables->where('tanggaranbelanja.stdel', '0');
		$this->datatables->from('tanggaranbelanja');
		return print_r($this->datatables->generate());
	}

	public function create()
	{
		$data['title']		= 'Tambah';
		$data['content']	= 'Anggaran_belanja/create';
		$data				= array_merge($data, path_info());
		$data['uraian']		= $this->model->uraianAll();
		$data['satuan']		= $this->model->satuanAll();
		$this->parser->parse('template', $data);
	}

	public function edit($id = null)
	{
		if ($id) {
			$data = get_by_id('id', $id, 'tanggaranbelanja');
			if ($data) {
				$data['title'] = lang('anggaran_belanja');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Anggaran_belanja/edit';
				$data = array_merge($data, path_info());
				$this->parser->parse('default', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save()
	{
		$this->model->save();
	}

	public function delete()
	{
		$this->model->delete();
	}

	// additional
	// additional

	// Start: Ajax function

	public function add_rekeningitem()
	{

		$this->db->select('id');
		$this->db->limit(1);
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('tanggaranbelanja')->row_array();
		$items = $_POST['items'];
		$idanggaran = $data['id'];
		for ($i = 0; $i < count($items); $i++) {
			$this->db->set('nominal', $items[$i]['jumlah']);
			$this->db->set('koderekening', $items[$i]['koderekening']);
			$this->db->set('uraian', $items[$i]['uraian']);
			$this->db->set('volume', $items[$i]['volume']);
			$this->db->set('satuan', $items[$i]['satuan']);
			$this->db->set('tarif', $items[$i]['tarif']);
			$this->db->set('jumlah', $items[$i]['jumlah']);
			$this->db->set('keterangan', $items[$i]['keterangan']);
			$this->db->where('id', $idanggaran);
			$this->db->update('tanggaranbelanja');
		}	
	}
	// public function add_rekeningitem()
	// {

	// 	$this->db->select('id');
	// 	$this->db->limit(1);
	// 	$this->db->order_by('id', 'desc');
	// 	$data = $this->db->get('tanggaranbelanja')->row_array();
	// 	$items = $_POST['items'];
	// 	$idanggaran = $data['id'];
	// 	$nominal = 0;
	// 	for ($i = 0; $i < count($items); $i++) {
	// 		$this->db->set('idanggaran', $idanggaran);
	// 		$this->db->insert('tanggaranbelanjadetail', $items[$i]);
	// 		$nominal += $items[$i]['jumlah'];
	// 	}
	// 	$this->db->set('nominal', $nominal);
	// 	$this->db->where('id', $idanggaran);
	// 	$this->db->update('tanggaranbelanja');
	// }

	public function update_rekeningitem()
	{
		$items = $_POST['items'];
		$idanggaran = $_POST['idanggaran'];

		$this->db->where('idanggaran', $idanggaran);
		$this->db->delete('tanggaranbelanjadetail');


		$nominal = 0;
		for ($i = 0; $i < count($items); $i++) {
			$this->db->set('idanggaran', $idanggaran);
			$this->db->insert('tanggaranbelanjadetail', $items[$i]);
			$nominal += $items[$i]['jumlah'];
		}
		$this->db->set('nominal', $nominal);
		$this->db->where('id', $idanggaran);
		$this->db->update('tanggaranbelanja');
	}

	public function get_rekitem($id)
	{
		$this->db->select('koderekening,uraian,volume,satuan,tarif,jumlah,keterangan');
		$this->db->where('id', $id);
		$this->db->order_by('koderekening', 'asc');
		$data = $this->db->get('tanggaranbelanja')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	// public function get_rekitem($id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->where('idanggaran', $id);
	// 	$this->db->order_by('koderekening', 'asc');
	// 	$data = $this->db->get('tanggaranbelanjadetail')->result_array();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	public function get_rekeningbelanja()
	{
		$this->db->select('*');		
		$this->db->like('mnoakun.noakuntop', '5', 'after');
		$this->db->or_like('mnoakun.noakuntop', '1', 'after');
		$data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getKategori($id = null){
		$this->db->select('mkategori.id,mkategori.nama as text');
		$data=$this->db->get('mkategori')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	
	}
	public function select2_satuan($id = null)
    {
        $term = $this->input->get('q');
		$this->db->select('mdepartemen.id, mdepartemen.nama as text');
		$this->db->where('mdepartemen.sdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('id', $term);
		if($id) $data = $this->db->where('id', $id)->get('mdepartemen')->row_array();
		else $data = $this->db->get('mdepartemen')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function select_uraian($id = null) {
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
	// public function get_satuan(){	
	// 	$this->db->select('mkategori.id, mkategori.nama as text');
	// 	$this->db->limit(10);
	// 	$data = $this->db->get('mkategori')->result_array();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// 	// if ($id) {
	// 	// $this->db->select('mkategori.id as id, mkategori.nama as text');
	// 	// $data = $this->db->where('id', $id)->get('mkategori')->row_array();
	// 	// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	// 	// } else {
	// 	// $this->db->select('mkategori.id as id, mkategori.nama as text');
	// 	// $this->db->limit(10);
	// 	// $data = $this->db->get('mkategori')->result_array();
	// 	// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	// 	// }	
	// }
	// public function uraian($id = null)
	// {
	// 	$term = $this->input->get('q');
	// 	if ($id) {
	// 		$this->db->select('mitem.id, mitem.nama as text');
	// 		$data = $this->db->where('id', $id)->get('mitem')->row_array();
	// 		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// 	} else {
	// 		$this->db->select('mitem.id, mitem.nama as text');
	// 		$data = $this->db->where('id', $id)->get('mitem')->row_array();
	// 		$this->output->set_content_type('application/json')->set_output(json_encode($data));
		
	// 	}
		// $term = $this->input->get('q');
		// $this->db->select('mitem.id, mitem.nama as text');
		// $this->db->where('mitem.noakunpersediaan', $id);
		// // $this->db->limit(100);
		// // if($term) $this->db->like('nama', $term);
		// // if($id) $data = $this->db->where('id', $id)->get('mitem')->row_array();
		// // else $data = $this->db->get('mitem')->result_array();
		// $data = $this->db->get('mitem')->result_array();
		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
		// // $this->db->select('*');		
		// // // $this->db->like('mitem.noakuntop', '5', 'after');
		// // $this->db->or_like('mnoakun.noakuntop', '1', 'after');
		// $data = $this->db->get('mitem')->result_array();
		// $this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }
	// public function get_rekeningbelanja()
	// {
	// 	$this->db->select('*');
	// 	$data = $this->db->get('mrekeningbelanja')->result_array();
	// 	$this->output->set_content_type('application/json')->set_output(json_encode($data));
	// }

	// End: Ajax function

	// Start: Select Function
	public function select2_mpegawaihakakses($id = null)
	{
		$term = $this->input->get('q');
		if ($id) {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$data = $this->db->where('id', $id)->get('mpegawaihakakses')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$this->db->where('mpegawaihakakses.stdel', '0');
			$this->db->limit(10);
			if ($term) $this->db->like('mpegawaihakakses', $term);
			$data = $this->db->get('mpegawaihakakses')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_tanggaranbelanja($id = null)
	{

		$this->db->select('tanggaranbelanja.id, tanggaranbelanja.dept as text');
		$this->db->limit(10);
		$data = $this->db->get('tanggaranbelanja')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
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
	public function printpdf($id = null) {
	    $this->load->library('pdf');
	    $pdf = $this->pdf;
	    $data = get_by_id('id',$id,'tanggaranpendapatan');
	    // $data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
		// $data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
		// $data['pemesanandetail'] = $this->model->pemesanandetail($data['id']);
	    $data['title'] = lang('anggaran_pendapatan');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Anggaran_pendapatan/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("pemesanan-pembelian-". $time, array("Attachment" => false));
	}
}
