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
 

class Pengiriman_penjualan extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Pengiriman_penjualan_model','model');
	}

	public function index() {
		$data['title'] = lang('delivery');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Pengiriman_penjualan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tpengirimanpenjualan.*, tpemesananpenjualan.id idpemesanan, tpemesananpenjualan.notrans nopemesanan, mkontak.nama as supplier, mgudang.nama as gudang, mdepartemen.nama as departemen, tSetupJurnal.kodeJurnal');
		$this->datatables->where('tpengirimanpenjualan.tipe','2');
		$this->datatables->where('tpengirimanpenjualan.statusauto','0');
		$this->datatables->join('tpemesananpenjualan','tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id','left');
		$this->datatables->join('mdepartemen','tpemesananpenjualan.departemen = mdepartemen.id','left');
		$this->datatables->join('mkontak','tpemesananpenjualan.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tpemesananpenjualan.gudangid = mgudang.id','left');
		$this->datatables->join('tSetupJurnal','tpengirimanpenjualan.setupJurnal = tSetupJurnal.idSetupJurnal','left');
		$this->datatables->from('tpengirimanpenjualan');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$idpengiriman = $this->uri->segment(3);
		if($idpengiriman) {
			$pengiriman = get_by_id('id',$idpengiriman,'tpengirimanpenjualan');
			$detailpemesanan = get_by_id('id',$pengiriman['pemesananid'],'tpemesananpenjualan');
			if($detailpemesanan) {
				$data['title'] = lang('delivery');
				$data['subtitle'] = lang('add_new');
				$data['tanggal'] = date('Y-m-d');
				$data['pemesanandetail'] = $this->model->pemesanandetail($detailpemesanan['id']);
				$this->SetUpJurnal_Model->setGet('jenis', $detailpemesanan['jenis_pembelian']);
				$this->SetUpJurnal_Model->setGet('formulir', 'pengirimanBarang');
				$data['setupJurnal']	= $this->SetUpJurnal_Model->getByJenis();
				$data['content'] 		= 'Pengiriman_penjualan/create';
				$data = array_merge($data,path_info(),$detailpemesanan);
				$this->parser->parse('template',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getpengiriman($id);
			if($data) {
				$data['kontak'] 			= get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] 			= get_by_id('id',$data['gudangid'],'mgudang');
				$data['pengirimandetail']	= $this->model->pengirimandetail($data['id']);
				$data['jurpenjualan'] 		=  get_by_id('refid',$data['id'],'tjurnalpenjualan');
				$data['title'] 				= lang('delivery');
				$data['subtitle'] 			= lang('detail');
				$data['content'] 			= 'Pengiriman_penjualan/detail';
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
			$data = $this->model->getpengiriman($id);
			if($data) {
				$pemesanan = 
				$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['pemjual'] = get_by_id('id',$data['pemesananid'],'tpemesananpenjualan');
				$data['pemesanandetail'] = $this->model->pemesanandetail($data['pemesananid']);

				$data['title'] = lang('delivery');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Pengiriman_penjualan/edit';
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
	    $data = $this->model->getpengiriman($id);
		$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
		$data['pengirimandetail'] = $this->model->pengirimandetail($data['id']);
	    $data['title'] = 'Surat Jalan';
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Pengiriman_penjualan/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("pengiriman-pembelian-". $time, array("Attachment" => false));
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

	// additional
	public function cekjumlahinput() {
		$this->model->cekjumlahinput();
	}
	

	public function select2_kontak($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$data = $this->db->where('id', $id)->get('mkontak')->row_array();
			$this->db->where('mkontak.tipe', '2');
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$this->db->where('mkontak.stdel', '0');
			$this->db->where('mkontak.tipe', '2');
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
	
	public function select2_departemen($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mdepartemen.id, mdepartemen.nama as text');
			$data = $this->db->where('id', $id)->get('mdepartemen')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.id, mdepartemen.nama as text');
			$this->db->where('mdepartemen.sdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mdepartemen', $term);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function validasi()
	{
		$idpengiriman = $this->input->post('id');

		$query= $this->db->query("SELECT * FROM tpengirimanpenjualan WHERE id='$idpengiriman'");
        if ($query->num_rows() > 0){
        	foreach ($query->result() as $kirim) {
        		
        		$query_detail= $this->db->query("SELECT * FROM tpengirimanpenjualandetail WHERE idpengiriman='$kirim->id'");
		        if ($query_detail->num_rows() > 0){
		        	foreach ($query_detail->result() as $krm_detail) {


			        	$date_now = date('Y-m-d');

			        	if ($kirim->statusauto == 0){
			        		if ($kirim->tipe == 2){
			        			if ($krm_detail->tipe == 'barang'){
			        				$this->db->query(" INSERT INTO tstokkeluar (gudangid, tanggalkeluar, itemid, harga, jumlah, refid) VALUES ('$kirim->gudangid','$date_now', '$krm_detail->itemid','$krm_detail->harga','$krm_detail->jumlah','$idpengiriman')");

			        			}
			        		}
			        	}
		        	}
		        }
        	}

        	$this->db->set('validasi','1');
			$this->db->where('id', $idpengiriman);
			$update = $this->db->update('tpengirimanpenjualan');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = "Data berhasil divalidasi";
			} else {
				$data['status'] = 'error';
				$data['message'] = "Data gagal divalidasi";
			}
	    }
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function validasibatal()
	{
		$idpengiriman = $this->input->post('id');

		$query= $this->db->query("SELECT * FROM tpengirimanpenjualan WHERE id='$idpengiriman'");
        if ($query->num_rows() > 0){
        	foreach ($query->result() as $kirim) {
        		
        		$query_detail= $this->db->query("SELECT * FROM tpengirimanpenjualandetail WHERE idpengiriman='$kirim->id'");
		        if ($query_detail->num_rows() > 0){
		        	foreach ($query_detail->result() as $krm_detail) {

				        //mengembalikan stok masuk seperti semula
				        if ($krm_detail->tipe == 'barang'){
		        			$query_stokmasuk= $this->db->query("SELECT * FROM tstokmasuk WHERE itemid='$krm_detail->itemid' AND gudangid='$kirim->gudangid'");
			        		if ($query_stokmasuk->num_rows() > 0){
			        			foreach ($query_stokmasuk->result() as $stokm) {
			        				$hasil_baru_keluar = $stokm->keluar - $krm_detail->jumlah;
			        				$hasil_baru_sisa = $stokm->sisa + $krm_detail->jumlah;

			        				$this->db->set('keluar',$hasil_baru_keluar);
			        				$this->db->set('sisa',$hasil_baru_sisa);
									$this->db->where('itemid', $krm_detail->itemid);
									$this->db->where('gudangid', $kirim->gudangid);
									$this->db->update('tstokmasuk');
			        			}
			        		}
		        		} 

		        	}
		        }

		        //hapus atau batal stok keluar
				$this->db->where('refid', $idpengiriman);
				$this->db->delete('tstokkeluar');
				//update validasi pengiriman penjualan
				$this->db->set('validasi','0');
				$this->db->where('id', $idpengiriman);
				$update = $this->db->update('tpengirimanpenjualan');
				if($update) {
					$data['status'] = 'success';
					$data['message'] = "Validasi data berhasil dibatalkan";
				} else {
					$data['status'] = 'error';
					$data['message'] = "Validasi data gagal dibatalkan";
				}
			}
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

