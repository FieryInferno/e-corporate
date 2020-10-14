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
		$this->datatables->select('
			tpengirimanpenjualan.*, tpemesananpenjualan.id idpemesanan, tpemesananpenjualan.notrans nopemesanan, mkontak.nama as supplier, mgudang.nama as gudang, mdepartemen.nama as departemen
		');
		$this->datatables->where('tpengirimanpenjualan.tipe','2');
		$this->datatables->where('tpengirimanpenjualan.statusauto','0');
		$this->datatables->join('tpemesananpenjualan','tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id','left');
		$this->datatables->join('mdepartemen','tpemesananpenjualan.departemen = mdepartemen.id','left');
		$this->datatables->join('mkontak','tpemesananpenjualan.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tpemesananpenjualan.gudangid = mgudang.id','left');
		$this->datatables->from('tpengirimanpenjualan');
		return print_r($this->datatables->generate());
	}

	public function create() {
		$idpemesanan = $this->input->get('idpemesanan');
		if($idpemesanan) {
			$detailpemesanan = get_by_id('id',$idpemesanan,'tpemesananpenjualan');
			if($detailpemesanan) {
				$data['title'] = lang('delivery');
				$data['subtitle'] = lang('add_new');
				if($detailpemesanan['status'] == '3') {
					$data['content'] = 'Pengiriman_penjualan/detail';
				} else {
					$data['tanggal'] = date('Y-m-d');
					$data['pemesanandetail'] = $this->model->pemesanandetail($detailpemesanan['id']);
					$data['content'] = 'Pengiriman_penjualan/create';
				}
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
				$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['pengirimandetail'] = $this->model->pengirimandetail($data['id']);
				$data['jurpenjualan'] =  get_by_id('refid',$data['id'],'tjurnalpenjualan');

				$data['title'] = lang('delivery');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Pengiriman_penjualan/detail';
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

	public function validasi()
	{
		$id = $this->input->post('id');
		$this->db->set('validasi','1');
		$this->db->where('id', $id);
		$update = $this->db->update('tpengirimanpenjualan');
		$this->db->set('validasi','1');
		$this->db->where('idpengiriman', $id);
		$update_detail = $this->db->update('tpengirimanpenjualandetail');
		if($update && $update_detail) {
			$data['status'] = 'success';
			$data['message'] = "Data berhasil divalidasi";
		} else {
			$data['status'] = 'error';
			$data['message'] = "Gagal memvalidasi data";
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function validasibatal()
	{
		$id = $this->input->post('id');
		$kirimjual = get_by_id('id',$id,'tpengirimanpenjualan');
		$pemesananid = $kirimjual['pemesananid'];
		$gudangid = $kirimjual['gudangid'];

		$query_pengjualdetail= $this->db->query("SELECT * FROM tpengirimanpenjualandetail WHERE idpengiriman='$id'");
        if ($query_pengjualdetail->num_rows() > 0){
        	foreach ($query_pengjualdetail->result() as $row) {
        		$idpenjualdetail = $row->idpenjualdetail;
        		$jumlah = $row->jumlah;
				$query_pemjualdetail= $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE id='$idpenjualdetail'");
        		if ($query_pemjualdetail->num_rows() > 0){
        			foreach ($query_pemjualdetail->result() as $row1) {
        				$hasil_baru_jt = $row1->jumlahditerima - $jumlah;
        				$hasil_baru_js = $row1->jumlahsisa + $jumlah;

        				$this->db->set('jumlahditerima',$hasil_baru_jt);
        				$this->db->set('jumlahsisa',$hasil_baru_js);
        				if ($hasil_baru_js == 0){
        					$this->db->set('status','3');
        				}else if ($row1->jumlah == $hasil_baru_js){
        					$this->db->set('status','4');
        				}else{
        					$this->db->set('status','2');
        				}
						$this->db->where('id', $idpenjualdetail);
						$this->db->update('tpemesananpenjualandetail');
        			}
        		}

        		if ($row->tipe == 'barang'){
        			$itemid = $row->itemid;
        			$query_stokmasuk= $this->db->query("SELECT * FROM tstokmasuk WHERE itemid='$itemid' AND gudangid='$gudangid'");
	        		if ($query_stokmasuk->num_rows() > 0){
	        			foreach ($query_stokmasuk->result() as $row2) {
	        				$hasil_keluar = $row2->keluar - $jumlah;
	        				$hasil_sisa = $row2->sisa + $jumlah;
	        				$this->db->set('keluar',$hasil_keluar);
	        				$this->db->set('sisa',$hasil_sisa);
							$this->db->where('itemid', $itemid);
							$this->db->where('gudangid', $gudangid);
							$this->db->update('tstokmasuk');
	        			}
	        		}
        		}        		

        	}
        }

        $query_pesanjual= $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE idpemesanan='$pemesananid'");
        $total_sisa = 0;
        $total_jumlah = 0;
        if ($query_pesanjual->num_rows() > 0){
        	foreach ($query_pesanjual->result() as $row3) {
        		$total_jumlah = $total_jumlah + $row3->jumlah;
        		$total_sisa = $total_sisa + $row3->jumlahsisa;
        	}
        	if ($total_sisa == 0){
	        	$this->db->set('status','3');
				$this->db->where('id', $pemesananid);
				$update = $this->db->update('tpemesananpenjualan');
	        }else if ($total_sisa < $total_jumlah){
	        	$this->db->set('status','2');
				$this->db->where('id', $pemesananid);
				$update = $this->db->update('tpemesananpenjualan');
	        }else{
	        	$this->db->set('status','1');
				$this->db->where('id', $pemesananid);
				$update = $this->db->update('tpemesananpenjualan');
	        }

        }

		$jurnalid = get_by_id('refid',$id,'tjurnalpenjualan');
		$this->db->where('id', $jurnalid['id']);
		$this->db->delete('tjurnalpenjualan');

		$this->db->where('idjurnal', $jurnalid['id']);
		$this->db->delete('tjurnalpenjualandetail');

		$this->db->where('refid', $id);
		$this->db->delete('tstokkeluar');

		$this->db->set('validasi','0');
		$this->db->where('id', $id);
		$update = $this->db->update('tpengirimanpenjualan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = "Validasi data berhasil digagalkan";
		} else {
			$data['status'] = 'error';
			$data['message'] = "Gagal Validasi data";
		}

		
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}

