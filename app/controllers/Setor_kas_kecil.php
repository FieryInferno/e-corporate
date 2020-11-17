<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setor_kas_kecil extends User_Controller {

	public function __construct() {
		parent::__construct(); 
		$this->load->model('Setor_kas_kecil_model','model');
	}

	public function index() {
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');

		if($tanggalawal && $tanggalakhir) {
			$data['tanggalawal'] = $tanggalawal;
			$data['tanggalakhir'] = $tanggalakhir;
		} else {
			$data['tanggalawal'] = date('Y-m-01');
			$data['tanggalakhir'] = date('Y-m-t');
		}

		$data['title'] = lang('petty_cash_deposit');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Setor_kas_kecil/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$tgl_awal = $this->input->post('tanggalawal',TRUE);
		$tgl_akhir = $this->input->post('tanggalakhir',TRUE);
		$this->load->library('Datatables');
		$this->datatables->select('tsetorkaskecil.*,mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan','tsetorkaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->db->where('tsetorkaskecil.tanggal >=',$tgl_awal);
		$this->db->where('tsetorkaskecil.tanggal <=',$tgl_akhir);
		$this->datatables->where('tsetorkaskecil.stdel', '0');
		$this->datatables->from('tsetorkaskecil');
		return print_r($this->datatables->generate());
	}

	public function create()
    {
		$q = $this->db->query("SELECT MAX(LEFT(nokwitansi,3)) AS kd_max FROM tsetorkaskecil");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kd_max)+1;
				$kd = sprintf("%03s", $tmp);
			}
		}else{
			$kd = "001";
		}  

		$query_tahun = $this->db->query("SELECT tahun as thn FROM mtahun ORDER BY tahun DESC LIMIT 1");
		$tahun="";
		if ($query_tahun->num_rows() > 0){
			foreach ($query_tahun->result() as $t) {
				$tahun=$t->thn;
			}
        } 
		
        $data['tahun'] = $tahun;
        $data['kode_otomatis'] = $kd;
        $data['title'] = lang('petty_cash_deposit');
        $data['subtitle'] = lang('add_new');
        $data['tanggal'] = date('Y-m-d');
        $data['content'] = 'Setor_kas_kecil/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }

    public function select2_mperusahaan($id = null)
	{
        $term = $this->input->get('q');
		$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
		$this->db->where('mperusahaan.stdel', '0');
		if($term) $this->db->like('nama_perusahaan', $term);
		if($id) $data = $this->db->where('idperusahaan', $id)->get('mperusahaan')->row_array();
		else $data = $this->db->get('mperusahaan')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));	
	}

	public function select2_mdepartemen_pejabat($id = null, $text = null)
	{
		$term = $this->input->get('q');
		if ($text) {
			$this->db->select('mdepartemen.id as id, mdepartemen.pejabat as text');
			$this->db->where('mdepartemen.id', $id);
			$this->db->where('mdepartemen.sdel', '0');
			$data = $this->db->get('mdepartemen')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.id as id, mdepartemen.pejabat as text');
			$this->db->where('mdepartemen.id_perusahaan', $id);
			$this->db->where('mdepartemen.sdel', '0');
			if($term) $this->db->like('pejabat', $term);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mnoakun($id = null)
	{
		$term = $this->input->get('q');
		if ($id) {
			$this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text');
			$this->db->where('mnoakun.stdel', '0');
			$data = $this->db->where('idakun', $id)->get('mnoakun')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text');
			$this->db->like('mnoakun.akunno', '1', 'after');
			$this->db->where('mnoakun.stdel', '0');
			if($term) $this->db->like('akunno', $term);
			$data = $this->db->get('mnoakun')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mrekening_perusahaan($id = null, $text = null)
	{
		$term = $this->input->get('q');
		if ($text) {
			$this->db->select('mrekening.id as id, CONCAT(mrekening.nama," / ",mrekening.norek) as text');
			$this->db->where('mrekening.id', $id);
			$this->db->where('mrekening.stdel', '0');
			$data = $this->db->get('mrekening')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mrekening.id as id,  CONCAT(mrekening.nama," - ",mrekening.norek) as text');
			$this->db->where('mrekening.perusahaan', $id);
			$this->db->where('mrekening.stdel', '0');
			if($term) $this->db->like('akunno', $term);
			$data = $this->db->get('mrekening')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_kode_perusahaan(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_kodeperusahaan($id)->result();
        echo json_encode($data);
    }

    public function get_no_rekening(){
		$idakun = $this->input->post('idakun',TRUE);
        $this->model->get_nomorrekening($idakun);
    }

    public function save() {
		$this->model->save();
	}

	public function delete() {
		$this->model->delete();
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tsetorkaskecil');
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

	public function printpdf() {
		$this->load->library('pdf');
		$pdf = $this->pdf;
		
		$tanggalawal = $this->input->get('tanggalawal');
		$tanggalakhir = $this->input->get('tanggalakhir');

		if($tanggalawal && $tanggalakhir) {
			$data['tipe_cetak'] = '0';
		} else {
			$data['tipe_cetak'] = '1';
		}

		$data['getdata'] = $this->model->cetakdata($tanggalawal,$tanggalakhir);
		$data['title'] = lang('Laporan Setor Kas Kecil');
		$data['subtitle'] = lang('list');
		$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
		$data = array_merge($data,path_info());
		$html = $this->load->view('Pengajuan_kas_kecil/printpdf', $data, TRUE);
		$pdf->loadHtml($html);
		$pdf->setPaper('A4', 'portrait');
		$pdf->render();
		$time = time();
		$pdf->stream("laporan-setor-kas-kecil-". $time, array("Attachment" => false));
	}

    public function get_hitungsisakaskecil(){
		$idper = $this->input->post('idper',TRUE);
        $this->model->get_hitungsisakaskecil($idper);
    }
}
