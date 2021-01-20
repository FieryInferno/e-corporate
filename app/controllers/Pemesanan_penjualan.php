<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pemesanan_penjualan extends User_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pemesanan_penjualan_model', 'model');
  }

  public function index() {
    $data['title']      = lang('sales_order');
    $data['subtitle']   = lang('list');
    $data['content']    = 'Pemesanan_penjualan/index';
    $data['pemesanan']  = $this->model->get(); 
    $data               = array_merge($data,path_info());
    $this->parser->parse('template',$data);
  }

  public function index_datatable() {
    $this->load->library('Datatables');
    $this->datatables->select('tpemesananpenjualan.*, mkontak.nama as supplier, mgudang.nama as gudang, mcabang.nama as cabang');
    $this->datatables->join('mkontak', 'tpemesananpenjualan.kontakid = mkontak.id','LEFT');
    $this->datatables->join('mgudang', 'tpemesananpenjualan.gudangid = mgudang.id','LEFT');
    $this->datatables->join('mcabang', 'tpemesananpenjualan.cabang = mcabang.id','LEFT');
    $this->datatables->where('tpemesananpenjualan.tipe', '2');
    $this->datatables->where('tpemesananpenjualan.stdel', '0');
    $this->datatables->from('tpemesananpenjualan');
    return print_r($this->datatables->generate());
  }

  public function create() {
    $q  = $this->db->query("SELECT MAX(LEFT(nokwitansi,3)) AS kd_max FROM tbudgetevent");
    $kd = "";
    if($q->num_rows()>0){
      foreach($q->result() as $k){
          $tmp  = ((int)$k->kd_max)+1;
          $kd   = sprintf("%03s", $tmp);
      }
    }else{
        $kd = "001";
    }  

    $query_tahun  = $this->db->query("SELECT tahun as thn FROM mtahun ORDER BY tahun DESC LIMIT 1");
    $tahun        = "";
    if ($query_tahun->num_rows() > 0){
      foreach ($query_tahun->result() as $t) {
        $tahun=$t->thn;
      }
    }
    $data['tahun']          = $tahun;
    $data['kode_otomatis']  = $kd;
    $data['title']          = lang('sales_order');
    $data['subtitle']       = lang('add_new');
    $data['tanggal']        = date('Y-m-d');
    $data['content']        = 'Pemesanan_penjualan/create';
    $data                   = array_merge($data, path_info());
    $this->parser->parse('template', $data);
  }

  public function detail($id = null) {
    if ($id) {
      $data = get_by_id('id', $id, 'tpemesananpenjualan');
      if ($data) {
        $data['kontak']             = get_by_id('id', $data['kontakid'], 'mkontak');
        $data['gudang']             = get_by_id('id', $data['gudangid'], 'mgudang');
        $data['angsuran']           = get_by_id('idpemesanan', $data['id'], 'tpemesananpenjualanangsuran');
        $data['pemesanandetail']    = $this->model->pemesanandetail($data['id']);
        $data['title']              = lang('sales_order');
        $data['subtitle']           = lang('detail');
        $data['content']            = 'Pemesanan_penjualan/detail';
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
        if ($id) {
            $data = get_by_id('id', $id, 'tpemesananpenjualan');
            if ($data) {
                $q = $this->db->query("SELECT MAX(LEFT(nokwitansi,3)) AS kd_max FROM tbudgetevent");
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
                $data['title'] = lang('sales_order');
                $data['subtitle'] = lang('edit');
                $data['angsuran'] = get_by_id('idpemesanan', $data['id'], 'tpemesananpenjualanangsuran');
                $data['content'] = 'Pemesanan_penjualan/edit';
                $data = array_merge($data, path_info());
                $this->parser->parse('template', $data);
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

    public function update() {
        $this->model->update();
    }

    public function delete() {
        $this->model->delete();
    }

    public function validasi()
    {
      $id = $this->input->post('id');
      $this->db->set('status','5');
      $this->db->where('idpemesanan', $id);
      $update_detail = $this->db->update('tpemesananpenjualandetail');
      $this->db->set('uby', get_user('username'));
      $this->db->set('udate', date('Y-m-d H:i:s'));
      $this->db->set('status','5');
      $this->db->where('id', $id);
      $update = $this->db->update('tpemesananpenjualan');
      if (($update_detail) && ($update)) {
        $this->db->set('status','5');
        $this->db->where('idpemesanan', $id);
        $this->db->update('tbudgetevent');
        $query = $this->db->query("SELECT * FROM tpemesananpenjualan WHERE id = '$id'");
          if ($query->num_rows() > 0){
            foreach ($query->result() as $psn) {
              $q  = $this->db->query("SELECT id AS kd_max FROM tpengirimanpenjualan");
              $kd = "";
              if($q->num_rows()>0){
                foreach($q->result() as $k){
                  $kd = ((int)$k->kd_max)+1;
                }
              }else{
                $kd = "1";
              } 
              $id_pengiriman  = $kd;
              $this->load->helper('penomoran');
              $penomoran  = penomoran('pengirimanBarang', $psn->idperusahaan, $psn->departemen);
              $this->db->set('id',$id_pengiriman);
              $this->db->set('nomor', $penomoran['nomor']);
              $this->db->set('notrans', $penomoran['notrans']);
              $this->db->set('tanggal',$psn->tanggal);
              $this->db->set('pemesananid',$id);
              $this->db->set('tipe','2');
              $this->db->set('statusauto','0');
              $this->db->set('cby',get_user('username'));
              $this->db->set('cdate',date('Y-m-d H:i:s'));
              $this->db->insert('tpengirimanpenjualan');
              $query_detail = $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE idpemesanan = '$id'");
              if ($query_detail->num_rows() > 0){
                foreach ($query_detail->result() as $psn_detail) {
                  $this->db->set('idpengiriman',$id_pengiriman);
                  $this->db->set('idpenjualdetail',$psn_detail->id);
                  $this->db->set('itemid',$psn_detail->itemid);
                  $this->db->set('tipe',$psn_detail->tipe);
                  $this->db->insert('tpengirimanpenjualandetail');
                }
              }
            }
          }
        $data['status'] = 'success';
        $data['message'] = "Data berhasil divalidasi";
      } else {
          $data['status'] = 'error';
          $data['message'] = "Data gagal divalidasi";
      }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function batalvalidasi()
    {
        $id = $this->input->post('id');

        $this->db->set('uby', get_user('username'));
        $this->db->set('udate', date('Y-m-d H:i:s'));
        $this->db->set('status','4');
        $this->db->where('id', $id);
        $update = $this->db->update('tpemesananpenjualan');
        if($update) {
            $this->db->set('status','4');
            $this->db->where('idpemesanan', $id);
            $this->db->update('tbudgetevent');

            $kirim = get_by_id('pemesananid',$id,'tpengirimanpenjualan');

            $this->db->where('id', $kirim['id']);
            $this->db->delete('tpengirimanpenjualan');
            $this->db->where('idpengiriman', $kirim['id']);
            $this->db->delete('tpengirimanpenjualandetail');

            $data['status'] = 'success';
            $data['message'] = "Berhasil membatalkan validasi data";
        } else {
            $data['status'] = 'error';
            $data['message'] = "Gagal membatalkan validasi data";
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }


    // additional
    public function select2_item($id = null, $idgudang = null,$text = null) {
        $term = $this->input->get('q');
        if ($text) {
            $this->db->select('mitem.id as id, CONCAT(mitem.noakunjual," - ",mitem.nama) as text, mnoakun.akunno as koderekening, mnoakun.idakun');
            // $this->db->join('tstokmasuk', 'mitem.id = tstokmasuk.itemid');
            $this->db->join('mnoakun', 'mitem.noakunjual = mnoakun.idakun');
            // $this->db->group_by('tstokmasuk.itemid');
            $data = $this->db->where('mitem.id', $id)->get('mitem')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mitem.id as id, CONCAT(mitem.noakunjual," - ",mitem.nama) as text, mnoakun.akunno as koderekening, mnoakun.idakun');
            // $this->db->join('tstokmasuk', 'mitem.id = tstokmasuk.itemid', 'left');
            $this->db->join('mnoakun', 'mitem.noakunjual = mnoakun.idakun');
            // $this->db->where('tstokmasuk.gudangid', $idgudang);
            // $this->db->group_by('tstokmasuk.itemid');
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
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text, mnoakun.akunno as koderekening');
            $this->db->like('mnoakun.akunno', '4', 'after');
            $this->db->or_like('mnoakun.akunno', '7', 'after');
            $data = $this->db->where('idakun', $id)->get('mnoakun')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text, mnoakun.akunno as koderekening');
            $this->db->like('mnoakun.akunno', '4', 'after');
            $this->db->or_like('mnoakun.akunno', '7', 'after');
            if($term) $this->db->or_like('CONCAT(mnoakun.akunno," / ",mnoakun.namaakun)', $term);
            $data = $this->db->get('mnoakun')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

     public function select2_item_inventaris($id=null) {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text, mnoakun.akunno as koderekening');
            $this->db->where('mnoakun.stdel', '0');
            $data = $this->db->where('idakun', $id)->get('mnoakun')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text, mnoakun.akunno as koderekening');
            $this->db->where('mnoakun.noakuntop', '1');
            $this->db->where('mnoakun.stdel', '0');
            if($term) $this->db->like('CONCAT(mnoakun.akunno," / ",mnoakun.namaakun)', $term);
            $data = $this->db->get('mnoakun')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function select2_budgetevent($id=null) {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text, mnoakun.akunno as koderekening, mnoakun.idakun');
            $this->db->where('mnoakun.stdel', '0');
            $data = $this->db->where('idakun', $id)->get('mnoakun')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mnoakun.idakun as id, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as text, mnoakun.akunno as koderekening, mnoakun.idakun');
            $this->db->like('mnoakun.akunno', '1', 'after');
            $this->db->or_like('mnoakun.akunno', '5', 'after');
            $this->db->or_like('mnoakun.akunno', '6', 'after');
            if($term) $this->db->like('CONCAT(mnoakun.akunno," / ",mnoakun.namaakun)', $term);
            $data = $this->db->get('mnoakun')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

  public function select2_kontak($id = null)
  {
    $term = $this->input->get('q');
    if ($id) {
      $this->db->select('mkontak.id, mkontak.nama as text');
      $data = $this->db->where('id', $id)->get('mkontak')->row_array();
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    } else {
      $this->db->select('mkontak.id, mkontak.nama as text');
      if ($term) $this->db->like('mkontak.nama', $term);
      $data = $this->db->get('mkontak')->result_array();
      $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
  }

    public function select2_kontak_manual()
    {
        $term = $this->input->get('q');
        $this->db->select('mkontak.id, mkontak.nama as text');
        $this->db->where('mkontak.stdel', '0');
        $this->db->where('mkontak.tipe', '2');
        if ($term) { $this->db->like('mkontak', $term); }
        $data = $this->db->get('mkontak')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
        
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

    public function select2_mrekening_perusahaan($id = null, $text = null)
    {
        $term = $this->input->get('q');
        if ($text) {
            $this->db->select('mrekening.id as id, CONCAT(mrekening.nama," - ",mrekening.norek) as text');
            $this->db->where('mrekening.id', $id);
            $data = $this->db->get('mrekening')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mrekening.id as id,  CONCAT(mrekening.nama," - ",mrekening.norek) as text');
            $this->db->where('mrekening.perusahaan', $id);
            $this->db->where('mrekening.stdel', '0');
            if($term) $this->db->like('CONCAT(mrekening.nama," - ",mrekening.norek)', $term);
            $data = $this->db->get('mrekening')->result_array();
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

    public function get_detail_angsuran(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_detail_angsuran($id)->result();
        echo json_encode($data);
    }

    public function get_detail_pemesanan(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_detail_pemesanan($id)->result();
        echo json_encode($data);
    }
    public function get_detail_budgetevent(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_detail_budgetevent($id)->result();
        echo json_encode($data);
    }

    public function get_budget_event(){
        $id = $this->input->post('id',TRUE);
        $data = $this->model->get_budget_event($id)->result();
        echo json_encode($data);
    }

    public function get_PilihanPajak()
    {
        $this->db->select('mpajak.*, mnoakun.akunno , mnoakun.namaakun ');
        $this->db->join('mnoakun','mpajak.akun=mnoakun.idakun');
        $data = $this->db->get('mpajak')->result_array();   
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
    public function select2_noakun() {
        $id = $this->input->post('id');
        $this->db->select('mnoakun.*');
        $this->db->where('mnoakun.idakun', $id);
        $data = $this->db->get('mnoakun')->row_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function select2_noakun_pengiriman() {
        $this->db->select('mnoakun.idakun as id, concat("(",mnoakun.akunno,") - ",mnoakun.namaakun) as text');
        $data = $this->db->get('mnoakun')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_noakun_item(){
        $id = $this->input->post('id',TRUE);
        $jenisitem = $this->input->post('jenisitem',TRUE);
        $data = $this->model->get_noakun_item($id,$jenisitem)->result();
        echo json_encode($data);
    }

}
