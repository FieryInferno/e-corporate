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


class Saldo_awal extends User_Controller {

	private $title	= 'Saldo Awal';
	private $idSaldoAwal;
	private $nomor;	
	private $perusahaan;
	private $keterangan;
	private	$detail;
	private $tanggal;

	public function __construct() {
		parent::__construct();
		if(get_user('permissionid') == '2') redirect('Forbidden','refresh');
		$this->load->model('Saldo_awal_model','model');
		$this->setPerusahaan($this->input->post('perusahaan'));
		$this->setNomor($this->input->post('nomor'));
		$this->setIdSaldoAwal($this->input->post('idSaldoAwal'));
		$this->setKeterangan($this->input->post('keterangan'));
		$this->setDetail($this->input->post('idAkun'), $this->input->post('debit'), $this->input->post('kredit'));
		$this->setTanggal($this->input->post('tanggal'));
	}

	public function index() {
		$data['title']		= $this->getTitle();
		$data['subtitle']	= lang('list');
		$data['content']	= 'Saldo_awal/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
	
	public function manage() {
		$data = $this->db->get('tsaldoawal')->row_array();
		if($data) {
			$data['title'] 				= lang('beginning_balance');
			$data['saldoawaldetail']	= $this->model->get_saldoawaldetail();
			$data['subtitle']			= lang('add_new');
			$data['content']			= 'Saldo_awal/manage';
			$data						= array_merge($data,path_info());
			$this->parser->parse('template',$data);
		} else {
			redirect('saldo_awal/index','refresh');
		}
	}

	public function save() {
		$this->model->setIdSaldoAwal($this->getIdSaldoAwal());
		$this->model->setNomor($this->getNomor());
		$this->model->setTanggal($this->getTanggal());
		$this->model->setPerusahaan($this->getPerusahaan());
		$this->model->setKeterangan($this->getKeterangan());
		$this->model->setDetail($this->getDetail());
		$data	= $this->model->save();
		if ($data) {
			$data0['status'] = 'success';
			$data0['message'] = lang('save_success_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
	}

	public function savehead() {
		$this->model->savehead();
	}

	public function delete() {# code...
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

	private function getTitle()
	{
		return $this->title;
	}

	public function tambah()
	{
		$data['title']		= $this->getTitle();
		$data['subtitle']	= 'Tambah';
		$data['content']	= 'Saldo_awal/tambah';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	private function setPerusahaan($perusahaan)
	{
		$this->perusahaan	= $perusahaan;
	}

	private function setNomor($nomor)
	{
		if ($this->input->post('nomor') == null) {
			$nomor				= rand(1, 999);
			switch (strlen($nomor)) {
				case 1:
					$nomor	= '00' . (string) $nomor;
					break;
				case 2:
					$nomor	= '0' . (string) $nomor;
					break;
				
				default:
					$nomor	= $nomor;
					break;
			}
			$this->nomor	= $nomor . '/SA' . '/' . $this->getPerusahaan() . '/2020';
		} else {
			$this->nomor	= $nomor;
		}
	}

	private function getPerusahaan()
	{
		return $this->perusahaan;
	}

	private function setIdSaldoAwal($idSaldoAwal)
	{
		if ($this->input->post('idSaldoAwal') == null) {
			$this->idSaldoAwal	= uniqid('SA');
		} else {
			$this->idSaldoAwal	= $idSaldoAwal;
		}
	}

	private function setKeterangan($keterangan)
	{
		$this->keterangan	= $keterangan;
	}

	private function setDetail($idAkun, $debit, $kredit)
	{
		$this->detail	= [
			'idAkun'	=> $idAkun,
			'debit'		=> $debit,
			'kredit'	=> $kredit
		];
	}

	private function getNomor()
	{
		return $this->nomor;
	}

	private function getIdSaldoAwal()
	{
		return $this->idSaldoAwal;
	}

	private function getKeterangan()
	{
		return $this->keterangan;
	}

	private function getDetail()
	{
		return $this->detail;
	}

	private function setTanggal($tanggal)
	{
		$this->tanggal	= $tanggal;
	}

	private function getTanggal()
	{
		return $this->tanggal;
	}

	public function index_datatable() 
	{
		$data	= $this->model->indexDatatables();
		return print_r($data);
	}

	public function edit($id = null) {
		if($id) {
			$this->model->set('idSaldoAwal', $id);
			$data = $this->model->getData();
			if($data) {
				$id=$this->uri->segment(3);
				$query_pengajuan = $this->db->query("SELECT * FROM tsetorkaskecil WHERE id='$id'");
				foreach ($query_pengajuan->result() as $p) {
					$idperusahaan=$p->perusahaan;
					$iddepartemen=$p->pejabat;
					$idakun=$p->kas;
					$idrek = $p->rekening;
				}

				$data['perusahaan']=$idperusahaan;
				$data['pejabat']=$iddepartemen;
				$data['akun']=$idakun;
				$data['rekening']=$idrek;

				$data['title'] = lang('petty_cash_deposit');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Setor_kas_kecil/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}
}

