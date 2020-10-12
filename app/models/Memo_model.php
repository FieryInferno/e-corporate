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


class Memo_model extends CI_Model {

	public function save_pengembalian() {
		$kontakid = $this->input->post('kontakid', TRUE);
		$kontak = get_by_id('id',$kontakid,'mkontak');

		if($kontak['tipe'] == '1') {
			$this->db->set('kontakid',$this->input->post('kontakid', TRUE));
			$this->db->set('tipe','1');
			$this->db->set('noakundebet',$this->input->post('noakunbayar', TRUE));
			$this->db->set('debet',0);
			$this->db->set('noakunkredit',$kontak['noakunpiutang']);
			$this->db->set('kredit',remove_comma($this->input->post('totaldibayar', TRUE)));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tmemo');
			if($insertHead) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			}
		} else {
			$this->db->set('kontakid',$this->input->post('kontakid', TRUE));
			$this->db->set('tipe','1');
			$this->db->set('noakunkredit',$this->input->post('noakunbayar', TRUE));
			$this->db->set('kredit',remove_comma($this->input->post('totaldibayar', TRUE)));
			$this->db->set('noakundebet',$kontak['noakunutang']);
			$this->db->set('debet',0);
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tmemo');
			if($insertHead) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			}
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}