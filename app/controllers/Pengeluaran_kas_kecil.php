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
  

class Pengeluaran_kas_kecil extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pengeluaran_kas_kecil_model','model');
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

		$data['title'] = lang('petty_cash_outlay');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Pengeluaran_kas_kecil/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$tgl_awal = $this->input->post('tanggalawal',TRUE);
		$tgl_akhir = $this->input->post('tanggalakhir',TRUE);
		$this->load->library('Datatables');
		$this->datatables->select('tpengeluarankaskecil.*,mperusahaan.nama_perusahaan, mdepartemen.nama');
		$this->datatables->join('mperusahaan','tpengeluarankaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->datatables->join('mdepartemen','tpengeluarankaskecil.departemen=mdepartemen.id');
		$this->db->where('tpengeluarankaskecil.tanggal >=',$tgl_awal);
		$this->db->where('tpengeluarankaskecil.tanggal <=',$tgl_akhir);
		$this->datatables->where('tpengeluarankaskecil.stdel', '0');
		$this->datatables->from('tpengeluarankaskecil');
		return print_r($this->datatables->generate());
	}

	public function create()
    {
    	$q = $this->db->query("SELECT MAX(LEFT(nokwitansi,3)) AS kd_max FROM tpengeluarankaskecil");
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
        $data['title'] = lang('petty_cash_outlay');
        $data['subtitle'] = lang('add_new');
        $data['tanggal'] = date('Y-m-d');
        $data['content'] = 'Pengeluaran_kas_kecil/create';
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

	public function select2_mdepartemen($id = null, $text = null)
	{	
		$term = $this->input->get('q');
		if ($text) {
			$this->db->select('mdepartemen.id as id, mdepartemen.nama as text');
			$this->db->where('mdepartemen.id', $id);
			$this->db->where('mdepartemen.sdel', '0');
			$data = $this->db->get('mdepartemen')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.id as id, mdepartemen.nama as text');
			$this->db->where('mdepartemen.id_perusahaan', $id);
			$this->db->where('mdepartemen.sdel', '0');
			if($term) $this->db->like('mdepartemen.nama', $term);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	public function select2_mdepartemen_pejabat($id = null, $text = null)
	{
		$term = $this->input->get('q');
		if ($text) {
			$this->db->select('mdepartemen.pejabat as id, mdepartemen.pejabat as text');
            $this->db->where('mdepartemen.pejabat', $id);
            $this->db->where('mdepartemen.sdel', '0');
            $data = $this->db->get('mdepartemen')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.pejabat as id, mdepartemen.pejabat as text');
			$this->db->where('mdepartemen.id', $id);
			$this->db->where('mdepartemen.sdel', '0');
			if($term) $this->db->like('pejabat', $term);
			$this->db->limit(10);
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
			$this->db->where('mnoakun.noakuntop', '1');
			$this->db->where('mnoakun.noakunheader', '1');
			$this->db->where('mnoakun.jenis', '02');
			$this->db->where('mnoakun.stdel', '0');
			if($term) $this->db->like('CONCAT(mnoakun.akunno," / ",mnoakun.namaakun)', $term);
			$data = $this->db->get('mnoakun')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_kode_perusahaan(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_kodeperusahaan($id)->result();
        echo json_encode($data);
    }

    public function validasi($id = null)
	{
		$this->db->set('uby',get_user('username'));
		$this->db->set('udate',date('Y-m-d H:i:s'));
		$this->db->set('status','1');
		$this->db->where('id', $id);
		$update = $this->db->update('tpengeluarankaskecil');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('update_error_message');
		}
		redirect(base_url('Pengeluaran_kas_kecil'));
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
		$data['title'] = lang('Laporan Pengeluaran Kas Kecil');
		$data['subtitle'] = lang('list');
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Pengeluaran_kas_kecil/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("laporan-pengeluaran-kas-kecil-". $time, array("Attachment" => false));
	}

    public function get_hitungsisakaskecil(){
		$idper = $this->input->post('idper',TRUE);
        $this->model->get_hitungsisakaskecil($idper);
    }

    public function get_pejabat(){
    	$id = $this->input->post('id',TRUE);
    	$iddep = $this->input->post('iddep',TRUE);
        $this->model->get_pejabat_model($id,$iddep);
    }
 
	public function select2_item($id = null, $iddepart=null, $text = null)
	{
		$query = $this->db->query("SELECT * FROM mdepartemen WHERE id='$iddepart'");
		if ($query->num_rows() > 0){
			foreach ($query->result() as $depart) {
				$nama_departemen=$depart->nama;
			}
        }
		$term = $this->input->get('q');
		if ($text) {

			$this->db->select('tanggaranbelanja.*, tanggaranbelanjadetail.id as id, tanggaranbelanjadetail.uraian as text');
            $this->db->join('tanggaranbelanjadetail', 'tanggaranbelanja.id=tanggaranbelanjadetail.idanggaran');
            $data = $this->db->where('tanggaranbelanjadetail.id', $id)->get('tanggaranbelanjadetail')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));

			
		} else {
			$this->db->select('tanggaranbelanja.*, tanggaranbelanjadetail.id as id, mitem.nama as text');
			$this->db->join('tanggaranbelanjadetail', 'tanggaranbelanja.id=tanggaranbelanjadetail.idanggaran');
			$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
			$this->db->where('tanggaranbelanja.idperusahaan',$id);
			$this->db->where('tanggaranbelanja.dept',$nama_departemen);
			$this->db->where('tanggaranbelanja.status','Validate');
			$this->db->where('tanggaranbelanja.stdel','0');
			if($term) $this->db->like('tanggaranbelanjadetail.uraian', $term);
			$data = $this->db->get('tanggaranbelanja')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

    public function select2_noakun_pengiriman() {
        $this->db->select('mnoakun.idakun as id, concat("(",mnoakun.akunno,") - ",mnoakun.namaakun) as text');
        $data = $this->db->get('mnoakun')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function get_noakun_pengiriman() {
        $id = $this->input->post('id');
        $this->db->select('mnoakun.*');
        $this->db->where('mnoakun.idakun', $id);
        $data = $this->db->get('mnoakun')->row_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_PilihanPajak()
    {
        $this->db->select('mpajak.*, mnoakun.akunno , mnoakun.namaakun ');
        $this->db->join('mnoakun','mpajak.akun=mnoakun.idakun');
        $data = $this->db->get('mpajak')->result_array();   
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
	public function get_detail_item()
    {
        $this->model->get_detail_item();
    }
    public function get_stok_item()
    {
        $this->model->get_stok_item();
    }

    public function save() {
		$this->model->save();
	}

	public function update() {
		$this->model->update();
	}

	public function delete() {
		$this->model->delete();
	}


	public function detail($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tpengeluarankaskecil');
			if($data) {
				$data['perusahaan'] = get_by_id('idperusahaan',$data['perusahaan'],'mperusahaan');
				$data['departemen'] = get_by_id('id',$data['departemen'],'mdepartemen');
				$data['pengeluarkaskecildetail'] = $this->model->pengeluarandetail($data['id']);

				$data['title'] = lang('petty_cash_outlay');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Pengeluaran_kas_kecil/detail';
				$data = array_merge($data,path_info());
				$this->parser->parse('template',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tpengeluarankaskecil');
			if($data) {
				$data['pengeluarkaskecildetail'] = $this->model->pengeluarandetail($data['id']);

				$data['title'] = lang('petty_cash_outlay');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Pengeluaran_kas_kecil/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('template',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function get_detail_pengeluarandetail(){
        $idpengeluaran = $this->input->post('id',TRUE);
        $data = $this->model->get_detail_pengeluarandetail($idpengeluaran)->result();
        echo json_encode($data);
    }

}
