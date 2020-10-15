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


class Pemesanan_pembelian_model extends CI_Model {

	public function save() {

		$this->db->set('notrans',$this->input->post('notrans', TRUE));
		$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
		$this->db->set('kontakid',$this->input->post('kontakid', TRUE));
		$this->db->set('gudangid',$this->input->post('gudangid', TRUE));
		$this->db->set('tipe','1');
		$this->db->set('catatan',$this->input->post('catatan', TRUE));
		$this->db->set('cby',get_user('username'));
		$this->db->set('cdate',date('Y-m-d H:i:s'));
		$insertHead = $this->db->insert('tpemesanan');
		if($insertHead) {
			$idpemesanan = $this->db->insert_id();
			$detail_array = $this->input->post('detail_array');
			$detail_array = json_decode($detail_array);
			foreach($detail_array as $row) {
				$this->db->set('idpemesanan',$idpemesanan);
				$this->db->set('itemid',$row[0]);
				$this->db->set('harga',remove_comma($row[2]));
				$this->db->set('jumlah',remove_comma($row[3]));
				$this->db->set('diskon',remove_comma($row[5]));
				$this->db->set('ppn',remove_comma($row[6]));
				$this->db->insert('tpemesanandetail');
			}
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesanandetail.*, mitem.nama as item');
		$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id', 'left');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id', 'left');
		$this->db->where('tpemesanandetail.idpemesanan', $idpemesanan);
		$get = $this->db->get('tpemesanandetail');
		return $get->result_array();
	}

	public function delete() {
		$id = $this->uri->segment(3);
		$this->db->set('stdel','1');
		$this->db->where('id', $id);
		$update = $this->db->update('tpemesanan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_detail_item() {
		$itemid = $this->input->post('itemid', TRUE);
		if($itemid) {
			$this->db->where('id', $itemid);
			$data = $this->db->get('mitem', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get($id = null)
	{
		if ($id !== null) {
			$this->db->select('tpemesanan.*, mkontak.nama as nama_kontak, mgudang.nama as nama_gudang');
			$this->db->join('mkontak', 'tpemesanan.kontakid = mkontak.id');
			$this->db->join('mgudang', 'tpemesanan.gudangid = mgudang.id');
			$data	= $this->db->get_where('tpemesanan', [
				'tpemesanan.id'	=> $id
			])->row_array();
			$this->db->select('tpemesanandetail.*, tanggaranbelanjadetail.uraian');
			$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
			$data['detail']		= $this->db->get_where('tpemesanandetail', [
				'idpemesanan'	=> $id
			])->result_array();
			$data['angsuran']	= $this->db->get_where('tpemesananangsuran', [
				'idpemesanan'	=> $id
			])->row_array();
		} else {
			$this->db->join('mperusahaan', 'tpemesanan.idperusahaan = mperusahaan.idperusahaan');
			$data	= $this->db->get('tpemesanan')->result_array();
		}
		return $data;
	}

	public function get_angsuran($id)
	{
		return $this->db->get_where('tpemesananangsuran', [
			'idpemesanan'	=> $id
		])->row_array();
	}
}

