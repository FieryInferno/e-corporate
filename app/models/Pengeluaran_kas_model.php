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


class Pengeluaran_kas_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tpengeluarankas');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('nominal',remove_comma($this->input->post('nominal')));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tpengeluarankas');
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

	public function get_count_pengeluaran($tanggalawal, $tanggalakhir) {
		$this->db->where('tpengeluarankas.tanggal >=', $tanggalawal);
		$this->db->where('tpengeluarankas.tanggal <=', $tanggalakhir);
		$this->db->where('tpengeluarankas.status', '1');
		$get = $this->db->count_all_results('tpengeluarankas');
		return $get;
	}

	public function get_pengeluaran($offset, $limit, $tanggalawal, $tanggalakhir) {
		$this->db->select('tpengeluarankas.*, noakunbiaya.namaakun as namaakunbiaya, noakunkas.namaakun as namaakunkas');
		$this->db->where('tpengeluarankas.tanggal >=', $tanggalawal);
		$this->db->where('tpengeluarankas.tanggal <=', $tanggalakhir);
		$this->db->join('mnoakun noakunbiaya', 'tpengeluarankas.noakunbiaya = noakunbiaya.noakun', 'left');
		$this->db->join('mnoakun noakunkas', 'tpengeluarankas.noakunkas = noakunkas.noakun', 'left');
		$this->db->where('tpengeluarankas.status', '1');
		$this->db->order_by('tpengeluarankas.id', 'desc');
		$get = $this->db->get('tpengeluarankas', $limit, $offset);
		return $get->result_array();
	}

	public function get_pengeluaran_print($tanggalawal, $tanggalakhir) {
		$this->db->select('tpengeluarankas.*, noakunbiaya.namaakun as namaakunbiaya, noakunkas.namaakun as namaakunkas');
		$this->db->where('tpengeluarankas.tanggal >=', $tanggalawal);
		$this->db->where('tpengeluarankas.tanggal <=', $tanggalakhir);
		$this->db->join('mnoakun noakunbiaya', 'tpengeluarankas.noakunbiaya = noakunbiaya.noakun', 'left');
		$this->db->join('mnoakun noakunkas', 'tpengeluarankas.noakunkas = noakunkas.noakun', 'left');
		$this->db->where('tpengeluarankas.status', '1');
		$this->db->order_by('tpengeluarankas.id', 'desc');
		$get = $this->db->get('tpengeluarankas');
		return $get->result_array();
	}
}

