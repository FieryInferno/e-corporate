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


class Aruskas_model extends CI_Model {

	private function _nrc_persediaan($tanggal) {
		$this->db->select("
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->like('noakun', '131','after');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->saldo;
	}

	public function nrc_persediaan($tanggalawal, $tanggalakhir) {
		$nrc_gerak = $this->_nrc_persediaan($tanggalakhir);
		$nrc_awal = $this->_nrc_persediaan($tanggalawal);
		$nrc_net = $nrc_gerak-$nrc_awal;
		return $nrc_net;
	}

	private function _nrc_piutang($tanggal) {
		$this->db->select("
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->like('noakun', '1211','after');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->saldo;
	}

	public function nrc_piutang($tanggalawal, $tanggalakhir) {
		$nrc_gerak = $this->_nrc_piutang($tanggalakhir);
		$nrc_awal = $this->_nrc_piutang($tanggalawal);
		$nrc_net = -12000000;
		return $nrc_net;
	}

	private function _nrc_utang_usaha($tanggal) {
		$this->db->select("
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->like('noakun', '2111','after');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->saldo;
	}

	public function nrc_utang_usaha($tanggalawal, $tanggalakhir) {
		$nrc_gerak = $this->_nrc_utang_usaha($tanggalakhir);
		$nrc_awal = $this->_nrc_utang_usaha($tanggalawal);
		$nrc_net = -40000000;
		return $nrc_net;
	}

	private function _nrc_penyusutan($tanggal) {
		$this->db->select("
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->like('noakun', '171','after');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->saldo;
	}

	public function nrc_penyusutan($tanggalawal, $tanggalakhir) {
		$nrc_gerak = $this->_nrc_utang_usaha($tanggalakhir);
		$nrc_awal = $this->_nrc_utang_usaha($tanggalawal);
		$nrc_net = 0;
		return $nrc_net;
	}

	private function _nrc_get_saldo_akun($tanggal, $noakun) {
		$this->db->select("
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal <', $tanggal);
		$this->db->like('noakun', $noakun,'after');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->saldo;
	}

	public function nrc_get_saldo_akun($tanggalawal, $tanggalakhir, $noakun) {
		$nrc_gerak = $this->_nrc_get_saldo_akun($tanggalakhir, $noakun);
		$nrc_awal = $this->_nrc_get_saldo_akun($tanggalawal, $noakun);
		$nrc_net = $nrc_gerak-$nrc_awal;
		return $nrc_net;
	}

	public function total_laba_rugi($tanggalawal, $tanggalakhir) {
		$totallabarugi = $this->_getpendapatan($tanggalawal,$tanggalakhir) - $this->_getbeban($tanggalawal, $tanggalakhir);
		return $totallabarugi;
	}

	public function penyusutan($tanggalawal, $tanggalakhir) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->like('noakunheader', '54','after');
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function penurunan_piutang($tanggalawal, $tanggalakhir) {
		$this->db->select("COALESCE( SUM(debet),0 ) AS total");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('tipe', '3');
		$this->db->where('noakunheader', '111');
		$this->db->where('debet >', 0);
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function peningkatan_utang($tanggalawal, $tanggalakhir) {
		$this->db->select("COALESCE( SUM(kredit),0 ) AS total");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('tipe', '3');
		$this->db->where('noakunheader', '111');
		$this->db->where('kredit >', 0);
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function atperalatan($tanggalawal, $tanggalakhir) {
		$this->db->select("COALESCE( SUM(tjurnaldetail.debet),0 ) AS total");
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.tipe', '4');
		$this->db->where('noakunheader', '111');
		$this->db->or_like('mnoakun.noakun', '1511','after');
		$this->db->join('tjurnal', 'tjurnal.id = tjurnaldetail.idjurnal');
		$this->db->join('mnoakun', 'tjurnaldetail.noakun = mnoakun.noakun');
		$get = $this->db->get('tjurnaldetail');
		return $get->row()->total;
	}

	public function atkendaraan($tanggalawal, $tanggalakhir) {
		$this->db->select("COALESCE( SUM(tjurnaldetail.debet),0 ) AS total");
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.tipe', '4');
		$this->db->where('noakunheader', '111');
		$this->db->or_like('mnoakun.noakun', '1512','after');
		$this->db->join('tjurnal', 'tjurnal.id = tjurnaldetail.idjurnal');
		$this->db->join('mnoakun', 'tjurnaldetail.noakun = mnoakun.noakun');
		$get = $this->db->get('tjurnaldetail');
		return $get->row()->total;
	}

	public function atbangunan($tanggalawal, $tanggalakhir) {
		$this->db->select("COALESCE( SUM(tjurnaldetail.debet),0 ) AS total");
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.tipe', '4');
		$this->db->where('noakunheader', '111');
		$this->db->or_like('mnoakun.noakun', '1513','after');
		$this->db->join('tjurnal', 'tjurnal.id = tjurnaldetail.idjurnal');
		$this->db->join('mnoakun', 'tjurnaldetail.noakun = mnoakun.noakun');
		$get = $this->db->get('tjurnaldetail');
		return $get->row()->total;
	}

	public function attanah($tanggalawal, $tanggalakhir) {
		$this->db->select("COALESCE( SUM(tjurnaldetail.debet),0 ) AS total");
		$this->db->where('tjurnal.tanggal >=', $tanggalawal);
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir);
		$this->db->where('tjurnal.tipe', '4');
		$this->db->where('noakunheader', '111');
		$this->db->or_like('mnoakun.noakun', '1514','after');
		$this->db->join('tjurnal', 'tjurnal.id = tjurnaldetail.idjurnal');
		$this->db->join('mnoakun', 'tjurnaldetail.noakun = mnoakun.noakun');
		$get = $this->db->get('tjurnaldetail');
		return $get->row()->total;
	}

	private function _getpendapatan($tanggalawal, $tanggalakhir) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('noakuntop', '4');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	private function _getbeban($tanggalawal, $tanggalakhir) {
		$this->db->select("
			COALESCE( IF(stdebet = '1',SUM(debet)-SUM(kredit),SUM(kredit)-SUM(debet)),0 ) AS total
		");
		$this->db->where('noakuntop', '5');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$get = $this->db->get('viewjurnaldetail');
		return $get->row()->total;
	}

	public function get_penjualan($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN SUM(debet-kredit)
			ELSE SUM(kredit-debet) END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->like('noakunheader', '41', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_hpp($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->like('noakun', '5114', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_operasional($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->like('noakun', '5113', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_pendapatan_lainnya($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakuntop', '4');
		$this->db->not_like('noakun', '41', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_biaya_lainnya($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakuntop', '5');
		// $this->db->where('noakun !=', '5114');
		// $this->db->where('noakun !=', '5113');
		$this->db->not_like('noakun', '51', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tjurnal');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tjurnal');
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
		$this->db->where('id', $id);
		$update = $this->db->update('tjurnal');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

