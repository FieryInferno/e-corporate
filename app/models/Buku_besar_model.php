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


class Buku_besar_model extends CI_Model {

	public function get_count_noakun($tanggalawal, $tanggalakhir) {
		$this->db->select('noakun');
		$this->db->group_by('noakun');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);		
		$get = $this->db->count_all_results('viewjurnaldetail');
		return $get;
	}

	public function get_noakun($offset, $limit, $tanggalawal, $tanggalakhir) {
		$this->db->select('noakun, tanggal, keterangan, namaakun, stdebet');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail', $limit, $offset);
		return $get->result_array();
	}

	public function get_noakun_print($tanggalawal, $tanggalakhir) {
		$this->db->select('noakun, tanggal, keterangan, namaakun, stdebet');
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_jurnal_detail_($noakun) {
		$queryString = "SELECT 
		tjurnal.tipe, tjurnal.tanggal, tjurnal.keterangan, tjurnaldetail.noakun, mnoakun.namaakun, tjurnaldetail.debet, tjurnaldetail.kredit,
		CASE WHEN mnoakun.stdebet = '1' THEN (@sum := @sum + tjurnaldetail.debet - tjurnaldetail.kredit) 
		ELSE (@sum := @sum + tjurnaldetail.kredit - tjurnaldetail.debet) END AS saldo
		FROM tjurnaldetail
		JOIN (SELECT @sum := 0) AS getsum
		INNER JOIN mnoakun ON tjurnaldetail.noakun = mnoakun.noakun
		INNER JOIN tjurnal ON tjurnaldetail.idjurnal = tjurnal.id
		WHERE tjurnaldetail.noakun = '".$noakun."' AND tjurnal.status = '1' ORDER BY tjurnal.tanggal ASC";

		$get = $this->db->query($queryString);
		return $get->result_array();
	}

	public function get_jurnal_detail($noakun, $tanggalawal, $tanggalakhir) {
		$queryString = "SELECT tipe, tanggal, keterangan, noakun, namaakun, debet, kredit,
		CASE WHEN stdebet = '1' THEN (@sum := @sum + debet - kredit) 
		ELSE (@sum := @sum + kredit - debet) END AS saldo
		FROM viewjurnaldetail
		JOIN (SELECT @sum := 0) AS getsum
		WHERE noakun = '".$noakun."'
		AND tanggal >= '".$tanggalawal."'
		AND tanggal <= '".$tanggalakhir."'
		ORDER BY tanggal ASC";

		$get = $this->db->query($queryString);
		return $get->result_array();
	}

	public function get_jurnal_detail_saldoawal($noakun, $tanggalawal) {
		$queryString = "SELECT
		CASE WHEN stdebet = '1' THEN (debet - kredit) 
		ELSE (kredit - debet) END AS saldo
		FROM viewjurnaldetail
		WHERE noakun = '".$noakun."' AND tanggal < '".$tanggalawal."'
		ORDER BY tanggal";

		$get = $this->db->query($queryString);
		return $get->row_array()['saldo'];
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

