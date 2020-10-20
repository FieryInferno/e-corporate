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


class Faktur_penjualan extends User_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Faktur_penjualan_model','model');
	}

	public function index() {
		$data['title'] = lang('invoice');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Faktur_penjualan/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tfakturpenjualan.*, mkontak.nama as supplier, mgudang.nama as gudang, mdepartemen.nama as namadepartemen');
		$this->datatables->join('mkontak','tfakturpenjualan.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tfakturpenjualan.gudangid = mgudang.id','left');
		$this->datatables->join('mdepartemen','tfakturpenjualan.departemen = mdepartemen.id','left');
		$this->datatables->where('tfakturpenjualan.tipe','2');
		$this->datatables->from('tfakturpenjualan');
		return print_r($this->datatables->generate());
	}

	 public function edit($id = null)
    {
        if ($id) {
            $data = get_by_id('id', $id, 'tfakturpenjualan');
            if ($data) {
                $data['title'] = lang('invoice');
                $data['subtitle'] = lang('edit');
                $data['content'] = 'faktur_penjualan/edit';
                $data = array_merge($data, path_info());
                $this->parser->parse('template', $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }   
    }

	public function detail($id = null) {
		if($id) {
			$data = $this->model->getfaktur($id);
			if($data) {
				$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['fakturdetail'] = $this->model->fakturdetail($data['id']);
				$data['jurpenjualan'] =  get_by_id('refid',$data['id'],'tjurnalpenjualan');
				
				$data['title'] = lang('invoice');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Faktur_penjualan/detail';
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
	    $data = $this->model->getfaktur($id);
		$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
		$data['fakturdetail'] = $this->model->fakturdetail($data['id']);
	    $data['title'] = 'Faktur Penjualan';
	    $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
	    $data = array_merge($data,path_info());
	    $html = $this->load->view('Faktur_penjualan/printpdf', $data, TRUE);
	    $pdf->loadHtml($html);
	    $pdf->setPaper('A4', 'portrait');
	    $pdf->render();
	    $time = time();
	    $pdf->stream("faktur-penjualan-". $time, array("Attachment" => false));
	}

	public function create() {
		$idpemesanan = $this->input->get('idpemesanan');
		$idpengiriman = $this->input->get('idpengiriman');
		if($idpemesanan && $idpengiriman) {
			show_404();
		}

		if($idpemesanan) {
			$detailpemesanan = get_by_id('id',$idpemesanan,'tpemesanan');
			if(!$detailpemesanan) {
				show_404();
			}
			$data['tanggal'] = date('Y-m-d');
			$data['pemesanandetail'] = $this->model->pemesanandetail($detailpemesanan['id']);
			$data['content'] = 'Faktur_penjualan/create_from_pemesanan';
			$data['title'] = lang('invoice');
			$data['subtitle'] = lang('add_new');
			$data = array_merge($data,path_info(),$detailpemesanan);
			$this->parser->parse('template',$data);
		} 
		if($idpengiriman) {
			$detailpengiriman = get_by_id('id',$idpengiriman,'tpengiriman');
			if(!$detailpengiriman) {
				show_404();
			}
			$data = $this->model->getpemesanan($detailpengiriman['pemesananid']);
			$data['tanggal'] = date('Y-m-d');
			$data['pengirimandetail'] = $this->model->pengirimandetail($detailpengiriman['id']);
			$data['content'] = 'Faktur_penjualan/create_from_pengiriman';
			$data['title'] = lang('invoice');
			$data['subtitle'] = lang('add_new');
			$data = array_merge($data,path_info(),$detailpengiriman);
			$this->parser->parse('template',$data);
		}
		if(!$idpengiriman && !$idpemesanan) {
			$data['tanggal'] = date('Y-m-d');
			$data['content'] = 'Faktur_penjualan/create';
			$data['title'] = lang('invoice');
			$data['subtitle'] = lang('add_new');
			$data = array_merge($data,path_info());
			$this->parser->parse('template',$data);			
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

	public function detailitem() {
		$this->model->detailitem();
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

	public function select2_item($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mitem.id, mitem.nama as text');
			$data = $this->db->where('id', $id)->get('mitem')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('mitem.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mitem', $term);
			$data = $this->db->get('mitem')->result_array();
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
			$this->db->where('mdepartemen.stdel', '0');
			if($term) $this->db->like('mdepartemen.nama', $term);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}



	public function get_detail_item() {
		$this->model->get_detail_item();
	}
	public function get_stok_item() {
		$this->model->get_stok_item();
	}

	public function select2_nomor_pengiriman($id=null, $text=null) {
        $term = $this->input->get('q');
        if ($text) {
             $this->db->select('tpengirimanpenjualan.id as id, CONCAT(tpengirimanpenjualan.notrans," - ",tpengirimanpenjualan.tanggal," - ",mkontak.nama," - Rp. ",tpengirimanpenjualan.total) as text, tpengirimanpenjualan.total as total_harga');
             $this->db->where('validasi', '1');
            $data = $this->db->where('id', $id)->get('tpengirimanpenjualan')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('tpengirimanpenjualan.id as id, CONCAT(tpengirimanpenjualan.notrans," - ",tpengirimanpenjualan.tanggal," - ",mkontak.nama," - Rp. ",tpengirimanpenjualan.total) as text, tpengirimanpenjualan.total as total_harga');
            $this->db->join('mkontak','tpengirimanpenjualan.kontakid = mkontak.id');
      		$this->db->where('kontakid', $id);
      		$this->db->where('validasi', '1');
      		$this->db->where('status <>', '3');
      		if($term) $this->db->like('CONCAT(tpengirimanpenjualan.notrans," - ",tpengirimanpenjualan.tanggal," - ",mkontak.nama," - Rp. ",tpengirimanpenjualan.total)', $term);
            $data = $this->db->get('tpengirimanpenjualan')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function get_data_pengiriman(){
        $idpengiriman = $this->input->post('idpengiriman');
        $data = $this->model->get_data_pengiriman_model($idpengiriman)->result();
        echo json_encode($data);
    }

    public function get_detail_angsuran(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_detail_angsuran($id)->result();
        echo json_encode($data);
    }

     public function get_detail_pengiriman(){
        $pengirimanid = $this->input->post('pengirimanid',TRUE);
        $data = $this->model->get_detail_pengiriman($pengirimanid)->result();
        echo json_encode($data);
    }
}

