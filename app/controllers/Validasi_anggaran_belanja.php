<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** 
 * =================================================
 * @package	CGC (CODEIGNITER GENERATE CRUD)
 * @author	isyanto.id@gmail.com
 * @link	https://isyanto.com
 * @since	Version 1.0.0
 * @filesource
 * ================================================= 
 */


class Validasi_anggaran_belanja extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Validasi_anggaran_belanja_model', 'model');
	}

	public function index()
	{
		$data['title'] = lang('validasi_anggaran_belanja');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Validasi_anggaran_belanja/index';		
		$data['total_nominal'] = $this->model->hitungJumlahNominal();	
		$data = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function index_datatable()
	{
		$this->load->library('Datatables');
		$this->datatables->select('tanggaranbelanja.*, mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan', 'tanggaranbelanja.idperusahaan = mperusahaan.idperusahaan');
		$this->datatables->where('tanggaranbelanja.stdel','0');
		$this->datatables->from('tanggaranbelanja');
		return print_r($this->datatables->generate());
	}

	public function create()
	{
		$data['title'] = lang('validasi_anggaran_belanja');
		$data['subtitle'] = lang('add_new');
		$data['content'] = 'Validasi_anggaran_belanja/create';
		$data = array_merge($data, path_info());
		$this->parser->parse('default', $data);
	}

	public function edit($id = null)
	{
		$this->db->set('uby',get_user('username'));
		$this->db->set('udate',date('Y-m-d H:i:s'));
		$this->db->set('status','Validate');
		$this->db->where('id', $id);
		$update = $this->db->update('tanggaranbelanja');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('update_error_message');
		}
		redirect(base_url('validasi_anggaran_belanja'));
	}

	public function save($id)
	{
		$this->db->set('status', 'Validate');
		$this->db->where('id', $id);
		$update = $this->db->update('tanggaranbelanja');
		if ($update) {
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('update_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete()
	{
		$this->model->delete();
	}

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
		$this->db->select('*');
		$this->db->where('idanggaran', $id);
		$this->db->order_by('koderekening', 'asc');
		$data = $this->db->get('tanggaranbelanjadetail')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_rekeningbelanja()
	{
		$this->db->select('*');
		$data = $this->db->get('mrekeningbelanja')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

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
			$this->db->select('mperusahaan.id as id, mperusahaan.nama_perusahaan as text');
			$data = $this->db->where('id', $id)->get('mperusahaan')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mperusahaan.id as id, mperusahaan.nama_perusahaan as text');
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

	public function validasi($status = null, $id = null)
	{
		switch ($status) {
			case 0:
				$status_baru	= "Validate";
				break;
			case 1:
				$status_baru	= "Belum Validate";
				break;
			
			default:
				# code...
				break;
		}
		$this->db->where('id', $id);
		$this->db->update('tanggaranbelanja', [
			'status'	=> $status_baru
		]);
		redirect('validasi_anggaran_belanja');
	}
}
