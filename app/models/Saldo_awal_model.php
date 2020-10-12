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


class Saldo_awal_model extends CI_Model {

	public function get_saldoawaldetail() {
		$this->db->select('tsaldoawaldetail.*, mnoakun.namaakun');
		$this->db->join('mnoakun', 'mnoakun.noakun = tsaldoawaldetail.noakun');
		$this->db->where('mnoakun.stbayar', '1');
		$this->db->order_by('mnoakun.noakun', 'ASC');
		$get = $this->db->get('tsaldoawaldetail');
		return $get->result_array();
	}

	public function save() {
		for ($i=0; $i < count($this->input->post('noakun')); $i++) {
			$this->db->set('debet',remove_comma($this->input->post('debet')[$i]));
			$this->db->set('kredit',remove_comma($this->input->post('kredit')[$i]));
			$this->db->where('noakun', $this->input->post('noakun')[$i]);
			$this->db->update('tsaldoawaldetail');
		}
		$ekuitassaldoawal = get_pengaturan_akun(21);
		$totalkredit = remove_comma($this->input->post('totalkredit'));
		$totaldebet = remove_comma($this->input->post('totaldebet'));
		if($totaldebet > $totalkredit) {
			$this->db->set('kredit','kredit + '.($totaldebet-$totalkredit), false);
			$this->db->where('noakun', $ekuitassaldoawal);
			$this->db->update('tsaldoawaldetail');
		}

		if($totaldebet < $totalkredit) {
			$this->db->set('debet','debet + ' . ($totalkredit-$totaldebet), false);
			$this->db->where('noakun', $ekuitassaldoawal);
			$this->db->update('tsaldoawaldetail');
		}

		$data['status'] = 'success';
		$data['message'] = lang('save_success_message');
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function savehead() {
		$count = $this->db->count_all_results('tsaldoawal');
		if($count > 0) {
			$this->db->truncate('tsaldoawal');
			$this->db->truncate('tsaldoawaldetail');
		}

		$this->db->set('tanggal',$this->input->post('tanggal'));
		$inserthead = $this->db->insert('tsaldoawal');
		if($inserthead) {
			$data['status'] = 'success';
			$data['redir'] = 'manage';
			$data['message'] = lang('save_success_message');
		}		
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

