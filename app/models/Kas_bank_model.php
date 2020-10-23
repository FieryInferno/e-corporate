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

	private $idkasbank;

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
			$update = $this->db->update('tpengajuankaskecil');
			if($update) {
				$data['status'] = 'success'; 
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			$this->db->set('nomor_kas_bank',$this->input->post('nomor_kas_bank'));
			$this->db->set('perusahaan',$this->input->post('perusahaan'));
			$this->db->set('pejabat',$this->input->post('pejabat'));
			$this->db->set('tanggal',$this->input->post('tanggal'));
			$this->db->set('penerimaan',preg_replace("/[^0-9]/", "", $this->input->post('penerimaan')));
			$this->db->set('pengeluaran',preg_replace("/[^0-9]/", "", $this->input->post('pengeluaran')));
			$this->db->set('keterangan',$this->input->post('keterangan'));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert_kasbank = $this->db->insert('tkasbank');
			if($insert_kasbank)  {
				$nomor_kas_bank = $this->db->insert_id();
				$detail_array1 = $this->input->post("detail_array");
				$detail_array = json_decode($detail_array1);
				foreach($detail_array as $row) {
					$this->db->set('idkasbank',$nomor_kas_bank);
					$this->db->set('idtipe',$row[0]);
					$this->db->set('tipe',$row[2]);
					$this->db->set('tanggal',$row[3]);
					$this->db->set('nokwitansi',$row[4]);
					$this->db->set('penerimaan',preg_replace("/[^0-9]/", "", $row[5]));
					$this->db->set('pengeluaran',preg_replace("/[^0-9]/", "", $row[6]));
					$this->db->set('noakun',$row[7]);
					$this->db->set('kodeunit',$row[8]);
					$this->db->set('departemen',$row[9]);
					$this->db->set('sumberdana',$row[10]);
					$this->db->insert('tkasbankdetail');

					$id=$row[0];
					$tipe = $row[2];
					if ($tipe == 'Penjualan'){
						$this->db->set('stts_kas','1');
						$this->db->where('id', $id);
						$this->db->update('tfakturpenjualan');
            			
					}else if ($tipe == 'Budget Event'){
						$this->db->set('status_kas','1');
						$this->db->where('id', $id);
						$this->db->update('tbudgetevent');
            			
					}else if ($tipe == 'Pengajuan Kas Kecil'){
						$this->db->set('status','1');
						$this->db->set('uby',get_user('username'));
						$this->db->set('udate',date('Y-m-d H:i:s'));
						$this->db->where('id', $id);
						$this->db->update('tpengajuankaskecil');
            			
					}else if ($tipe == 'Setor Kas Kecil'){
						$this->db->set('status','1');
						$this->db->set('uby',get_user('username'));
						$this->db->set('udate',date('Y-m-d H:i:s'));
						$this->db->where('id', $id);
						$this->db->update('tsetorkaskecil');
					}
				}
				
				$this->db->set('nomor_kas_bank',$this->input->post('nomor_kas_bank'));
				$this->db->set('perusahaan',$this->input->post('perusahaan'));
				$this->db->set('pejabat',$this->input->post('pejabat'));
				$this->db->set('tanggal',$this->input->post('tanggal'));
				$this->db->set('keterangan',$this->input->post('keterangan'));
				// $this->db->set('nominal',preg_replace("/[^0-9]/", "", $this->input->post('pengeluaran_pemindahbukuan')));
				$this->db->set('cby',get_user('username'));
				$this->db->set('cdate',date('Y-m-d H:i:s'));
				$this->db->insert('tpemindahbukuankaskecil');
				

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
		$id	= $this->get('idKasBank');
		$this->db->where('id', $id);
		$update = $this->db->delete('tkasbank');
		if($update) {
			$data0	= $this->db->get_where('tkasbankdetail', [
				'idkasbank'	=> $id
			])->result_array();
			foreach ($data0 as $key) {
				if ($key['tipe'] == 'Penjualan') {
					$this->db->where('id', $key['idtipe']);
					$this->db->update('tfakturpenjualan', [
						'stts_kas'	=> '0'
					]);
				}
			}
			$this->db->where('idkasbank', $id);
			$this->db->delete('tkasbankdetail');
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

    public function kasbankdetail($idkasbank) {
		$this->db->select('tkasbankdetail.*');
		$this->db->where('tkasbankdetail.idkasbank', $idkasbank);
		$get = $this->db->get('tkasbankdetail');
		return $get->result_array();
	}

	private function get($jenis)
	{
		return $this->$jenis;
	}
}

