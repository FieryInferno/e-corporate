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

 
class Setor_kas_kecil_model extends CI_Model {

	public function get_kodeperusahaan($id){
        $query = $this->db->get_where('mperusahaan', array('idperusahaan' => $id));
        return $query;
    }

    public function get_nomorrekening($idakun){
    	$query_mnoakun = $this->db->query("SELECT * FROM mnoakun WHERE idakun='$idakun'");
        if($query_mnoakun->num_rows()>0){
            foreach($query_mnoakun->result() as $mno){
                $akunno= $mno->akunno;
            }
        } else { $akunno=0; }


        $query_rek = $this->db->query("SELECT * FROM mrekening WHERE akunno='$akunno'");
        if($query_rek->num_rows()>0){
            foreach($query_rek->result() as $rek){
                $hasil=$rek->norek;
            }
        } else { $hasil = ''; }

    	$data['hasil'] = $hasil;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('nominal',preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tsetorkaskecil');
			if($update) {
				$data['status'] = 'success'; 
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('nominal', preg_replace("/[^0-9]/", "", $this->input->post('nominal')));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tsetorkaskecil');
			if($insert) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('save_error_message');
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$id = $this->uri->segment(3); 
		$this->db->set('stdel','1');
		$this->db->set('dby',get_user('username'));
		$this->db->set('ddate',date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$update = $this->db->update('tsetorkaskecil');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function cetakdata($tanggalawal,$tanggalakhir) {
		$this->db->select('tsetorkaskecil.*,mperusahaan.nama_perusahaan');
		$this->db->join('mperusahaan','tsetorkaskecil.perusahaan=mperusahaan.idperusahaan');
		if ((!empty($tanggalawal)) & (!empty($tanggalakhir))) {
			$this->db->where('tsetorkaskecil.tanggal >=',$tanggalawal);
			$this->db->where('tsetorkaskecil.tanggal <=',$tanggalakhir);
		}
		$this->db->where('tsetorkaskecil.stdel', '0');
		$get = $this->db->get('tsetorkaskecil');
		return $get->result_array();
	}


    function get_hitungsisakaskecil($idper){

    	$query_pemindahbukuan = $this->db->query("SELECT penerimaan,pengeluaran FROM tpemindahbukuankaskecil WHERE perusahaan='$idper'");
    	$jumlah_penerimaan=0;
    	$jumlah_pengeluaran=0;
        if($query_pemindahbukuan->num_rows()>0){
            foreach($query_pemindahbukuan->result() as $p){
                $jumlah_penerimaan=$jumlah_penerimaan+$p->penerimaan;
    			$jumlah_pengeluaran=$jumlah_pengeluaran+$p->pengeluaran;
            }
        }
        $nominal_pemindahbukuan = $jumlah_penerimaan - $jumlah_pengeluaran;

        $query_pengeluaran = $this->db->query("SELECT subtotal FROM tpengeluarankaskecil WHERE perusahaan='$idper' AND stdel='0'");
    	$jumlah_nominal_pengeluaran =0;
        if($query_pengeluaran->num_rows()>0){
            foreach($query_pengeluaran->result() as $p){
                $jumlah_nominal_pengeluaran=$jumlah_nominal_pengeluaran+$p->subtotal;
            }
        }

        $query_setor = $this->db->query("SELECT nominal FROM tsetorkaskecil WHERE perusahaan='$idper' AND stdel='0' AND status='0'");
    	$jumlah_nominal_setor =0;
        if($query_setor->num_rows()>0){
            foreach($query_setor->result() as $p){
                $jumlah_nominal_setor=$jumlah_nominal_setor+$p->nominal;
            }
        }

        $hasil = $nominal_pemindahbukuan - $jumlah_nominal_pengeluaran - $jumlah_nominal_setor;
    	$data['hasil'] = $hasil;
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
    }
}

