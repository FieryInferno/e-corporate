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


class Jurnal_model extends CI_Model {

	public function get_count_jurnal($tanggalawal, $tanggalakhir) {
		$this->db->where('tjurnal.tanggal >=', $tanggalawal . ' 00:00:00');
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir . ' 23:59:00');
		$this->db->where('tjurnal.status', '1');
		$get = $this->db->count_all_results('tjurnal');
		return $get;
	}

	public function get_jurnal($offset, $limit, $tanggalawal, $tanggalakhir) {
		$this->db->where('tjurnal.tanggal >=', $tanggalawal . ' 00:00:00');
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir . ' 23:59:00');
		$this->db->where('tjurnal.status', '1');
		$this->db->order_by('tjurnal.id', 'desc');
		$get = $this->db->get('tjurnal', $limit, $offset);
		return $get->result_array();
	}

	public function get_jurnal_print($tanggalawal, $tanggalakhir) {
		$this->db->where('tjurnal.tanggal >=', $tanggalawal . ' 00:00:00');
		$this->db->where('tjurnal.tanggal <=', $tanggalakhir . ' 23:59:00');
		$this->db->where('tjurnal.status', '1');
		$this->db->order_by('tjurnal.id', 'desc');
		$get = $this->db->get('tjurnal');
		return $get->result_array();
	}

	public function get_jurnal_detail($idjurnal) {
		$this->db->select('tjurnaldetail.*, mnoakun.namaakun');
		$this->db->join('mnoakun', 'tjurnaldetail.noakun = mnoakun.noakun', 'left');
		$this->db->where('tjurnaldetail.idjurnal', $idjurnal);
		$this->db->order_by('tjurnaldetail.debet', 'desc');
		$get = $this->db->get('tjurnaldetail');
		return $get->result_array();
	}

	public function save() {
		$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
		$this->db->set('tipe','4');
		$this->db->set('stauto','0');
		if($this->input->post('keterangan', TRUE)) $this->db->set('keterangan',$this->input->post('keterangan', TRUE));
		else $this->db->set('keterangan','Jurnal Umum');
		$this->db->set('cby',get_user('username'));
		$this->db->set('cdate',date('Y-m-d H:i:s'));
		$insertHead = $this->db->insert('tjurnal');

		if($insertHead) {
			$idjurnal = $this->db->insert_id();
			$detail_array = $this->input->post('detail_array');
			$detail_array = json_decode($detail_array);
			foreach($detail_array as $row) {
				$this->db->set('idjurnal',$idjurnal);
				$this->db->set('noakun',$row[0]);
				$this->db->set('debet',remove_comma($row[2]));
				$this->db->set('kredit',remove_comma($row[3]));
				$this->db->set('keterangan','-');
				$this->db->insert('tjurnaldetail');
			}
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

