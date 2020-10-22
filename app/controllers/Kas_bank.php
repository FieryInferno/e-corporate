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

class Kas_bank extends User_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kas_bank_model', 'model');
    }

    public function index()
    {
        $data['title'] = lang('bank_cash');
        $data['subtitle'] = lang('Buku Kas Umum (BKU)');
        $data['content'] = 'Kas_bank/index';
        $data = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }

    public function index_datatable() {
        $this->load->library('Datatables');
        $this->datatables->select('tkasbank.*');
        $this->datatables->where('tkasbank.stdel', '0');
        $this->datatables->from('tkasbank');
        return print_r($this->datatables->generate());
    }

    public function create()
    {   
        $q = $this->db->query("SELECT MAX(LEFT(nomor_kas_bank,4)) AS kd_max FROM tkasbank");
        $kd = "";
        if($q->num_rows()>0){
            foreach($q->result() as $k){
                $tmp = ((int)$k->kd_max)+1;
                $kd = sprintf("%04s", $tmp);
            }
        }else{
            $kd = "0001";
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
        $data['title'] = lang('bank_cash');
        $data['subtitle'] = lang('add_new');
        $data['tanggal'] = date('Y-m-d');
        $data['content'] = 'Kas_bank/create';
        $data = array_merge($data, path_info());
        $this->parser->parse('template', $data);
    }

    public function select2_mperusahaan($id = null)
    {
        $term = $this->input->get('q');
        if ($id) {
            $this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
            $data = $this->db->where('idperusahaan', $id)->get('mperusahaan')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
            if($term) $this->db->like('nama_perusahaan', $term);
            $data = $this->db->get('mperusahaan')->result_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        }
    }

    public function select2_mdepartemen_pejabat($id = null, $text = null)
    {
        $term = $this->input->get('q');
        if ($text) {
            $this->db->select('mdepartemen.id, mdepartemen.pejabat as text');
            $this->db->where('mdepartemen.id_perusahaan', $id);
            $data = $this->db->get('mdepartemen')->row_array();
            $this->output->set_content_type('application/json')->set_output(json_encode($data));
        } else {
            $this->db->select('mdepartemen.id, mdepartemen.pejabat as text');
            $this->db->where('mdepartemen.id_perusahaan', $id);
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

    public function save() {
        $this->model->save();
    }
 
    public function delete() {
        $this->model->delete();
    }


    public function detail($id = null) {
        if($id) {
            $data = get_by_id('id',$id,'tkasbank');
            if($data) {
                $data['perusahaan'] = get_by_id('idperusahaan',$data['perusahaan'],'mperusahaan');
                $data['departemen'] = get_by_id('id',$data['pejabat'],'mdepartemen');
                $data['kasbankdetail'] = $this->model->kasbankdetail($data['id']);

                $data['title'] = lang('bank_cash');
                $data['subtitle'] = lang('detail');
                $data['content'] = 'Kas_bank/detail';
                $data = array_merge($data,path_info());
                $this->parser->parse('default',$data);
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
        $data = get_by_id('id',$id,'tkasbank');
        $data['perusahaan'] = get_by_id('idperusahaan',$data['perusahaan'],'mperusahaan');
        $data['departemen'] = get_by_id('id',$data['pejabat'],'mdepartemen');
        $data['akun'] = get_by_id('idakun',$data['akunno'],'mnoakun');
        $data['kasbankdetail'] = $this->model->kasbankdetail($data['id']);
        
        $data['title'] = lang('bank_cash');
        $data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
        $data = array_merge($data,path_info());
        $html = $this->load->view('Kas_bank/printpdf', $data, TRUE);
        $pdf->loadHtml($html);
        $pdf->setPaper('A4', 'portrait');
        $pdf->render();
        $time = time();
        $pdf->stream("bank-kas-detail-".$data['nomor_kas_bank'].'-'.$time, array("Attachment" => false));
    }

    public function get_Penjualan()
    {
        $tgl = $this->input->get('tgl');
        $idperusahaan = $this->input->get('idPerusahaan');
        $this->db->select('tpemesananpenjualanangsuran.*, tfakturpenjualan.notrans, mkontak.nama, tfakturpenjualan.tanggal, tfakturpenjualan.total, mrekening.norek, mrekening.nama as namaRekening, tfakturpenjualan.id as idfaktur, mnoakun.akunno, mperusahaan.kode, mdepartemen.nama as namaDepartemen');
        $this->db->join('tpengirimanpenjualan','tfakturpenjualan.pengirimanid=tpengirimanpenjualan.id');
        $this->db->join('tpemesananpenjualan','tpengirimanpenjualan.pemesananid=tpemesananpenjualan.id');
        $this->db->join('tpemesananpenjualanangsuran','tpemesananpenjualan.id=tpemesananpenjualanangsuran.idpemesanan');
        $this->db->join('mperusahaan','tpemesananpenjualan.idperusahaan=mperusahaan.idperusahaan');
        $this->db->join('mdepartemen','tpemesananpenjualan.departemen=mdepartemen.id');
        $this->db->join('mkontak','tfakturpenjualan.kontakid=mkontak.id');
        $this->db->join('mrekening','tfakturpenjualan.rekening=mrekening.id');
        $this->db->join('mnoakun','mrekening.akunno = mnoakun.idakun');
        $this->db->where('tfakturpenjualan.tanggal <=',$tgl);
        $this->db->where('tpemesananpenjualan.idperusahaan', $idperusahaan);
        $this->db->where('tfakturpenjualan.stts_kas', '0');
        $data   = $this->db->get('tfakturpenjualan')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_Pembelian()
    {
        $tgl = $this->input->get('tgl');
        $idperusahaan = $this->input->get('idPerusahaan');

        $this->db->select('tfaktur.*, tpemesananangsuran.*, tfaktur.notrans as no_kwitansi, mperusahaan.kode, mdepartemen.nama as nama_departemen, tfaktur.id as idfaktur, tfaktur.total as nominal_faktur');
        $this->db->join('tpengiriman','tfaktur.pengirimanid=tpengiriman.id');
        $this->db->join('tpemesanan','tpengiriman.pemesanan=tpemesanan.id');
        $this->db->join('mperusahaan','tpemesanan.idperusahaan=mperusahaan.idperusahaan');
        $this->db->join('mdepartemen','tpemesanan.departemen=mdepartemen.nama');
        $this->db->join('tpemesananangsuran','tpemesanan.id=tpemesananangsuran.idpemesanan');
        $this->db->where('tfaktur.tanggal <=',$tgl);
        $this->db->where('tpemesanan.idperusahaan', $idperusahaan);
        $data = $this->db->get('tfaktur')->result_array();   
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_BudgetEvent()
    {
        $tgl = $this->input->get('tgl');
        $idperusahaan = $this->input->get('idPerusahaan');
        $this->db->select('tbudgetevent.*, mperusahaan.kode, mdepartemen.nama as nama_departemen, mrekening.nama as nama_bank, mrekening.norek as nomor_rekening, mrekening.akunno, SUM(tbudgetevent.total) as nominal');
        $this->db->join('mperusahaan','tbudgetevent.perusahaan=mperusahaan.idperusahaan');
        $this->db->join('mdepartemen','tbudgetevent.departemen=mdepartemen.id');
        $this->db->join('mrekening','tbudgetevent.rekening=mrekening.id'); 
        $this->db->where('tbudgetevent.tanggal <=',$tgl);
        $this->db->where('tbudgetevent.perusahaan', $idperusahaan);
        $this->db->where('tbudgetevent.status', '3');
        $this->db->where('tbudgetevent.status_kas', '0');
        $this->db->group_by('tbudgetevent.idpemesanan');
        $data = $this->db->get('tbudgetevent')->result_array();   
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_KasKecil()
    {
        $idperusahaan = $this->input->get('idPerusahaan');
        $tgl = $this->input->get('tgl');
        $this->db->select('tpengajuankaskecil.*, mperusahaan.kode, mdepartemen.nama as nama_departemen, mnoakun.namaakun as nama_akun, mnoakun.akunno as nomor_akun, mrekening.nama as nama_bank, mrekening.norek as nomor_rekening');
        $this->db->join('mperusahaan','tpengajuankaskecil.perusahaan=mperusahaan.idperusahaan');
        $this->db->join('mdepartemen','tpengajuankaskecil.pejabat=mdepartemen.id');
        $this->db->join('mnoakun','tpengajuankaskecil.kas=mnoakun.idakun');
        $this->db->join('mrekening','tpengajuankaskecil.rekening=mrekening.id'); 
        $this->db->where('tpengajuankaskecil.perusahaan', $idperusahaan);
        $this->db->where('tpengajuankaskecil.tanggal <=',$tgl);
        $this->db->where('tpengajuankaskecil.status', '0');
        $this->db->where('tpengajuankaskecil.stdel', '0');
        $data = $this->db->get('tpengajuankaskecil')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function get_SetorKasKecil()
    {
        $tgl = $this->input->get('tgl');
        $idperusahaan = $this->input->get('idPerusahaan');
        $this->db->select('tsetorkaskecil.*,mperusahaan.kode, mdepartemen.nama as nama_departemen, mnoakun.namaakun as nama_akun, mnoakun.akunno as nomor_akun, mrekening.nama as nama_bank, mrekening.norek as nomor_rekening');
        $this->db->join('mperusahaan','tsetorkaskecil.perusahaan=mperusahaan.idperusahaan');
        $this->db->join('mdepartemen','tsetorkaskecil.pejabat=mdepartemen.id');
        $this->db->join('mnoakun','tsetorkaskecil.kas=mnoakun.idakun');
        $this->db->join('mrekening','tsetorkaskecil.rekening=mrekening.id');
        $this->db->where('tsetorkaskecil.perusahaan', $idperusahaan);
        $this->db->where('tsetorkaskecil.tanggal <=',$tgl);
        $this->db->where('tsetorkaskecil.status', '0');
        $this->db->where('tsetorkaskecil.stdel', '0');
        $data = $this->db->get('tsetorkaskecil')->result_array();
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}
