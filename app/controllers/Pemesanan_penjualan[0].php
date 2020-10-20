<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * =================================================
 * @package    CGC (CODEIGNITER GENERATE CRUD)
 * @author    isyanto.id@gmail.com
 * @link    https://isyanto.com
 * @since    Version 1.0.0
 * @filesource
 * =================================================
 */

class Pemesanan_penjualan extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pemesanan_penjualan_model', 'model');
    }

   public function index() {
        $data['title'] = lang('sales_order');
        $data['subtitle'] = lang('list');
        $data['content'] = 'Pemesanan_penjualan/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }
    public function index_datatable() {
        $this->load->library('Datatables');
        $this->datatables->select('tpemesananpenjualan.*, mkontak.nama as supplier, mgudang.nama as gudang');
        $this->datatables->join('mkontak', 'tpemesananpenjualan.kontakid = mkontak.id', 'left');
        $this->datatables->join('mgudang', 'tpemesananpenjualan.gudangid = mgudang.id', 'left');
        $this->datatables->where('tpemesananpenjualan.tipe', '2');
        $this->datatables->from('tpemesananpenjualan');
        return print_r($this->datatables->generate());
    }

    public function create() {
        $data['title'] = lang('sales_order');
        $data['subtitle'] = lang('add_new');
        $data['tanggal'] = date('Y-m-d');
        $data['content'] = 'Pemesanan_penjualan/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }

    public function detail($id = null) {
        if ($id) {
            $data = get_by_id('id', $id, 'tpemesananpenjualan');
            if ($data) {
                $data['kontak'] = get_by_id('id', $data['kontakid'], 'mkontak');
                $data['gudang'] = get_by_id('id', $data['gudangid'], 'mgudang');
                $data['pemesanandetail'] = $this->model->pemesanandetail($data['id']);

                $data['title'] = lang('sales_order');
                $data['subtitle'] = lang('detail');
                $data['content'] = 'Pemesanan_penjualan/detail';
                $data = array_merge($data, path_info());
                $this->parser->parse('template', $data);
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    public function edit($id = null)
    {
        $this->db->set('uby',get_user('username'));
        $this->db->set('udate',date('Y-m-d H:i:s'));
        $this->db->set('status','5');
        $this->db->where('id', $id);
        $update = $this->db->update('tpemesananpenjualan');
        if($update) {
            $data['status'] = 'success';
            $data['message'] = lang('update_success_message');
        } else {
            $data['status'] = 'error';
            $data['message'] = lang('update_error_message');
        }
        redirect(base_url('Pemesanan_penjualan'));   
    }

    public function printpdf($id = null) {
        $this->load->library('pdf');
        $pdf = $this->pdf;
        $data = get_by_id('id',$id,'tpemesananpenjualan');
        $data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
        $data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
        $data['pemesanandetail'] = $this->model->pemesanandetail($data['id']);
        $data['title'] = lang('purchase_order');
        $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
        $data = array_merge($data,path_info());
        $html = $this->load->view('Pemesanan_pembelian/printpdf', $data, TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $time = time();
        $pdf->stream("pemesanan-penjualan-". $time, array("Attachment" => false));
    }

    public function save() {
        $this->model->save();
    }

    public function delete() {
        $this->model->delete();
    }

    // additional
    public function select2_item($id = null, $idgudang = null,$text = null) {
        $term = $this->input->get('q');
        if ($text) {
            $this->db->select('mitem.id as id, CONCAT(mitem.noakunjual," - ",mitem.nama) as text');
            $data = $this->db->where('id', $id)->get('mitem')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mitem.id as id, CONCAT(mitem.noakunjual," - ",mitem.nama) as text');
            $this->db->join('tstokmasuk', 'mitem.id = tstokmasuk.itemid');
            $this->db->where('tstokmasuk.gudangid', $idgudang);
            $this->db->where('mitem.stdel', '0');
            if ($term) {
                $this->db->like('mitem.nama', $term);
            }

            $data = $this->db->get('mitem')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function select2_item_jasa($id=null) {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text');
            $this->db->like('mnoakun.akunno', '4', 'after');
            $this->db->or_like('mnoakun.akunno', '7', 'after');
            $data = $this->db->where('idakun', $id)->get('mnoakun')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text');
            $this->db->like('mnoakun.akunno', '4', 'after');
            $this->db->or_like('mnoakun.akunno', '7', 'after');
            if($term) $this->db->like('CONCAT(mnoakun.akunno," / ",mnoakun.namaakun)', $term);
            $data = $this->db->get('mnoakun')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

     public function select2_item_inventaris($id=null) {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text');
            $this->db->where('mnoakun.stdel', '0');
            $data = $this->db->where('idakun', $id)->get('mnoakun')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text');
            $this->db->where('mnoakun.noakuntop', '1');
            $this->db->where('mnoakun.stdel', '0');
            if($term) $this->db->like('CONCAT(mnoakun.akunno," / ",mnoakun.namaakun)', $term);
            $data = $this->db->get('mnoakun')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }


    // public function select2_item($id = null) {
    //  $term = $this->input->get('q');
    //  if($id) {
    //      $this->db->select('mitem.id, mitem.nama as text');
    //      $data = $this->db->where('id', $id)->get('mitem')->row_array();
    //      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    //  } else {
    //      $this->db->select('mitem.id, mitem.nama as text');
    //      $this->db->where('mitem.stdel', '0');
    //      $this->db->limit(10);
    //      if($term) $this->db->like('mitem.nama', $term);
    //      $data = $this->db->get('mitem')->result_array();
    //      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    //  }
    // }

    public function select2_kontak($id = null)
    {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mkontak.id, mkontak.nama as text');
            $data = $this->db->where('id', $id)->get('mkontak')->row_array();
            $this->db->where('mkontak.tipe', '2');
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mkontak.id, mkontak.nama as text');
            $this->db->where('mkontak.stdel', '0');
            $this->db->where('mkontak.tipe', '2');
            $this->db->limit(10);
            if ($term) {
                $this->db->like('mkontak', $term);
            }

            $data = $this->db->get('mkontak')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function update_kontakid($id)
    {
        $this->db->where('id', $id);
        $this->db->update('tpemesananpenjualan', ['kontakid' => $this->input->post('kontakid')]);
        $data['status']     = 'success';
        $data['message']    = lang('update_success_message');
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
    
    public function get_detail_item_barang_dagangan() {
        $this->model->get_detail_item_barang_dagangan();
    }
    public function detail_item() {
        $this->model->detail_item();
    }

    public function get_detail_item_jasa() {
        $this->model->get_detail_item_jasa();
    }

    public function tambah_angsuran()
    {
        $this->model->tambah_angsuran();
    }
}
