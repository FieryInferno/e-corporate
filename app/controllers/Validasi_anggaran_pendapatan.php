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


class Validasi_anggaran_pendapatan extends User_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Validasi_anggaran_pendapatan_model', 'model');
	}

	public function index()
	{
		$data['title'] = lang('validasi_anggaran_pendapatan');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Validasi_anggaran_pendapatan/index';
		$data['total_nominal'] = $this->model->hitungJumlahNominal();
		$data = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function index_datatable()
	{
		$this->load->library('Datatables');
		$this->datatables->select('tanggaranpendapatan.*, mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan', 'tanggaranpendapatan.idperusahaan = mperusahaan.idperusahaan');
		$this->datatables->where('tanggaranpendapatan.stdel','0');
		$this->datatables->from('tanggaranpendapatan');
		return print_r($this->datatables->generate());
	}


	public function edit($id = null)
	{
		// if ($id) {
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->set('status','Validate');
			$this->db->where('id', $id);
			$update = $this->db->update('tanggaranpendapatan');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
			redirect(base_url('validasi_anggaran_pendapatan'));
			// return $this->output->set_content_type('application/json')->set_output(json_encode($data));
			// $data = get_by_id('id', $id, 'tanggaranpendapatan');
			// if ($data) {
			// 	$data['title'] = lang('validasi_anggaran_pendapatan');
			// 	$data['subtitle'] = lang('edit');
			// 	$data['content'] = 'Validasi_anggaran_pendapatan/edit';
			// 	$data = array_merge($data, path_info());
			// 	$this->parser->parse('default', $data);
			// } else {
			// 	show_404();
			// }
		// } else {
		// 	show_404();
		// }
	}

	public function save($id)
	{
		$this->db->set('status', 'Validate');
		$this->db->where('id', $id);
		$update = $this->db->update('tanggaranpendapatan');
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
	// additional

	// Start: Ajax function

	public function add_rekeningitem()
	{

		$this->db->select('id');
		$this->db->limit(1);
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('tanggaranpendapatan')->row_array();
		$items = $_POST['items'];
		$idanggaran = $data['id'];
		$nominal = 0;
		for ($i = 0; $i < count($items); $i++) {
			$this->db->set('idanggaran', $idanggaran);
			$this->db->insert('tanggaranpendapatandetail', $items[$i]);
			$nominal += $items[$i]['jumlah'];
		}
		$this->db->set('nominal', $nominal);
		$this->db->where('id', $idanggaran);
		$this->db->update('tanggaranpendapatan');
	}

	public function update_rekeningitem()
	{
		$items = $_POST['items'];
		$idanggaran = $_POST['idanggaran'];

		$this->db->where('idanggaran', $idanggaran);
		$this->db->delete('tanggaranpendapatandetail');


		$nominal = 0;
		for ($i = 0; $i < count($items); $i++) {
			$this->db->set('idanggaran', $idanggaran);
			$this->db->insert('tanggaranpendapatandetail', $items[$i]);
			$nominal += $items[$i]['jumlah'];
		}
		$this->db->set('nominal', $nominal);
		$this->db->where('id', $idanggaran);
		$this->db->update('tanggaranpendapatan');
	}

	public function get_rekitem($id)
	{
		$this->db->select('*');
		$this->db->where('idanggaran', $id);
		$this->db->order_by('koderekening', 'asc');
		$data = $this->db->get('tanggaranpendapatandetail')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_rekeningpendapatan()
	{
		$this->db->select('*');
		$data = $this->db->get('mrekeningpendapatan')->result_array();
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

	public function select2_tanggaranpendapatan($id = null)
	{

		$this->db->select('tanggaranpendapatan.id, tanggaranpendapatan.dept as text');
		$this->db->limit(10);
		$data = $this->db->get('tanggaranpendapatan')->result_array();
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
			$this->db->select('tanggaranpendapatan.dept as id, tanggaranpendapatan.dept as text');
			$this->db->where('tanggaranpendapatan.idperusahaan', $id);
			$this->db->where('tanggaranpendapatan.dept', $text);
			$data = $this->db->get('tanggaranpendapatan')->row_array();
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
			$this->db->select('tanggaranpendapatan.pejabat as id, tanggaranpendapatan.pejabat as text');
			$this->db->where('tanggaranpendapatan.dept', $dept);
			$this->db->where('tanggaranpendapatan.pejabat', $text);
			$data = $this->db->get('tanggaranpendapatan')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.pejabat as id, mdepartemen.pejabat as text');
			$this->db->where('mdepartemen.nama', $dept);
			$this->db->limit(10);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
}
