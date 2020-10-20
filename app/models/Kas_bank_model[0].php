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

 
class Kas_bank_model extends CI_Model {

	function get_kodeperusahaan($id){
        $query = $this->db->get_where('mperusahaan', array('idperusahaan' => $id));
        return $query;
    }

    public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tkasbank');
			if($update) {
				$data['status'] = 'success'; 
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('penerimaan',$this->input->post('pengeluaran'));
			$this->db->set('pengeluaran','0');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tpemindahbukuankaskecil');
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert_kasbank = $this->db->insert('tkasbank');
			if($insert_kasbank)  {
				$nomor_kas_bank= $this->input->post('nomor_kas_bank');
				$idper= $this->input->post('perusahaan');

				$query= $this->db->query("SELECT * FROM tkasbank WHERE nomor_kas_bank='$nomor_kas_bank'");
				if($query->num_rows()>0){
		            foreach($query->result() as $p){
		               $idkasbank=$p->id;
		            }
		        }

				$query_pengajuan = $this->db->query("SELECT * FROM tpengajuankaskecil WHERE perusahaan='$idper' AND stdel='0' AND status='0'");
				if($query_pengajuan->num_rows()>0){
		            foreach($query_pengajuan->result() as $p){
		               	$this->db->set('idkasbank',$idkasbank);
						$this->db->set('tipe','Pengajuan Kas Kecil');
						$this->db->set('tanggal',$p->tanggal);
						$this->db->set('nokwitansi',$p->nokwitansi);
						$this->db->set('penerimaan','0');
						$this->db->set('pengeluaran',$p->nominal);
						$this->db->set('noakun',$p->kas);
						$this->db->set('kodeunit',$p->perusahaan);
						$this->db->set('departemen',$p->pejabat);
						$this->db->set('sumberdana',$p->rekening);
						$this->db->insert('tkasbankdetail');
						$this->db->set('status','1');
						$this->db->set('uby',get_user('username'));
						$this->db->set('udate',date('Y-m-d H:i:s'));
						$this->db->where('id', $p->id);
						$this->db->update('tpengajuankaskecil');
		            }
		        }

		        $query_setor = $this->db->query("SELECT * FROM tsetorkaskecil WHERE perusahaan='$idper' AND stdel='0' AND status='0'");
		        if($query_setor->num_rows()>0){
            		foreach($query_setor->result() as $p){
            			$this->db->set('idkasbank',$idkasbank);
						$this->db->set('tipe','Setor Kas Kecil');
						$this->db->set('tanggal',$p->tanggal);
						$this->db->set('nokwitansi',$p->nokwitansi);
						$this->db->set('penerimaan','0');
						$this->db->set('pengeluaran',$p->nominal);
						$this->db->set('noakun',$p->kas);
						$this->db->set('kodeunit',$p->perusahaan);
						$this->db->set('departemen',$p->pejabat);
						$this->db->set('sumberdana',$p->rekening);
						$this->db->insert('tkasbankdetail');
						$this->db->set('status','1');
						$this->db->set('uby',get_user('username'));
						$this->db->set('udate',date('Y-m-d H:i:s'));
						$this->db->where('id', $p->id);
						$this->db->update('tsetorkaskecil');
            		}
            	}
			
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('save_error_message');
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

    public function index_datatable($tabel,$perusahaan,$pejabat) {
		$this->load->library('Datatables');
		$this->datatables->select('tsetorkaskecil.*,mperusahaan.nama_perusahaan, mdepartemen.nama');
		$this->datatables->join('mperusahaan','tsetorkaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->datatables->join('mdepartemen','tsetorkaskecil.pejabat=mdepartemen.id');
		$this->db->where('tsetorkaskecil.tanggal >=',$tgl_awal);
		$this->db->where('tsetorkaskecil.tanggal <=',$tgl_akhir);
		$this->datatables->where('tsetorkaskecil.stdel', '0');
		$this->datatables->from('tsetorkaskecil');
		return print_r($this->datatables->generate());
	}

	public function delete() {
		$id = $this->uri->segment(3);
		$this->db->set('stdel','1');
		$this->db->set('uby',get_user('username'));
		$this->db->set('udate',date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$update = $this->db->update('tkasbank');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	function get_data_pengajuan($idperusahaan)
    {
    	$this->db->select('tpengajuankaskecil.*,mperusahaan.kode, mdepartemen.nama, mnoakun.namaakun as nama_akun, mnoakun.akunno as nomor_akun, mrekening.nama as nama_bank, mrekening.norek as nomor_rekening');
		$this->db->join('mperusahaan','tpengajuankaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->db->join('mdepartemen','tpengajuankaskecil.pejabat=mdepartemen.id');
		$this->db->join('mnoakun','tpengajuankaskecil.kas=mnoakun.idakun');
		$this->db->join('mrekening','tpengajuankaskecil.rekening=mrekening.id');
        $this->db->where('tpengajuankaskecil.perusahaan', $idperusahaan);
        $this->db->where('tpengajuankaskecil.stdel', '0');
        $this->db->where('tpengajuankaskecil.status', '0');
        return $this->db->from('tpengajuankaskecil')->get()->result();
    }

	function get_data_setor($idperusahaan)
    {
    	$this->db->select('tsetorkaskecil.*,mperusahaan.kode, mdepartemen.nama, mnoakun.namaakun as nama_akun, mnoakun.akunno as nomor_akun, mrekening.nama as nama_bank, mrekening.norek as nomor_rekening');
		$this->db->join('mperusahaan','tsetorkaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->db->join('mdepartemen','tsetorkaskecil.pejabat=mdepartemen.id');
		$this->db->join('mnoakun','tsetorkaskecil.kas=mnoakun.idakun');
		$this->db->join('mrekening','tsetorkaskecil.rekening=mrekening.id');
        $this->db->where('tsetorkaskecil.perusahaan', $idperusahaan);
        $this->db->where('tsetorkaskecil.status', '0');
        $this->db->where('tsetorkaskecil.stdel', '0');
        return $this->db->from('tsetorkaskecil')->get()->result();
    }

    function get_total($idperusahaan,$idpejabat)
    {
    	$this->db->select('SUM(nominal AS total_pengeluaran');
        $this->db->where('tpengajuankaskecil.perusahaan', $idperusahaan);
        $this->db->where('tpengajuankaskecil.pejabat', $idpejabat);
        $this->db->where('tpengajuankaskecil.stdel', '0');
        return $this->db->from('tpengajuankaskecil')->get()->result();
    }

	function get_nominal_kasbank()
    {
    	$this->db->select_sum('tkasbank.penerimaan');
    	$this->db->select_sum('tkasbank.pengeluaran');
		$this->db->where('tkasbank.stdel', '0');
		$data = $this->db->get('tkasbank', 1)->row_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    function get_hitungtotal($idper){
 
    	$query_pengajuan = $this->db->query("SELECT nominal FROM tpengajuankaskecil WHERE perusahaan='$idper' AND stdel='0' AND status='0'");
    	$jumlah_pengajuan =0;
        if($query_pengajuan->num_rows()>0){
            foreach($query_pengajuan->result() as $p){
                $jumlah_pengajuan=$jumlah_pengajuan+$p->nominal;
            }
        }

        $query_setor = $this->db->query("SELECT nominal FROM tsetorkaskecil WHERE perusahaan='$idper' AND stdel='0' AND status='0'");
    	$jumlah_nominal_setor =0;
        if($query_setor->num_rows()>0){
            foreach($query_setor->result() as $p){
                $jumlah_nominal_setor=$jumlah_nominal_setor+$p->nominal;
            }
        }

    	$data['penerimaan'] = $jumlah_nominal_setor;
    	$data['pengeluaran'] = $jumlah_pengajuan;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function kasbankdetail($idkasbank) {
		$this->db->select('tkasbankdetail.*, mperusahaan.kode as kode_perusahaan, mdepartemen.nama as nama_departemen, mnoakun.namaakun as nama_akun, mnoakun.akunno as nomor_akun, mrekening.nama as nama_bank, mrekening.norek as nomor_rekening');
		$this->db->join('mperusahaan', 'tkasbankdetail.kodeunit = mperusahaan.idperusahaan');
		$this->db->join('mdepartemen', 'tkasbankdetail.departemen = mdepartemen.id');
		$this->db->join('mnoakun','tkasbankdetail.noakun=mnoakun.idakun');
		$this->db->join('mrekening','tkasbankdetail.sumberdana=mrekening.id');
		$this->db->where('tkasbankdetail.idkasbank', $idkasbank);
		$get = $this->db->get('tkasbankdetail');
		return $get->result_array();
	}

	public function get($id_kas_bank)
	{
		return $this->db->get_where('tkasbank')->row_array();
	}
}

