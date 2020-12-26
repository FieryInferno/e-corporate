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


class Retur_penjualan_model extends CI_Model {

	public function fakturdetail($idfaktur) {
		$this->db->select('tfakturdetail.*, mitem.nama as item');
		$this->db->join('mitem', 'tfakturdetail.itemid = mitem.id', 'left');
		$this->db->where('tfakturdetail.idfaktur', $idfaktur);
		$get = $this->db->get('tfakturdetail');
		return $get->result_array();
	}

	public function get_detail_item_faktur() {
		$itemid = $this->input->post('itemid', TRUE);
		$idfaktur = $this->input->post('idfaktur', TRUE);
		if($itemid) {
			$this->db->where('itemid', $itemid);
			$this->db->where('idfaktur', $idfaktur);
			$data = $this->db->get('tfakturdetail')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function save() {
		$fakturid = $this->input->post('fakturid', TRUE);
		$getfaktur = get_by_id('id',$fakturid,'tfaktur');
		if($fakturid) {
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('fakturid',$fakturid);
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('tipe','2');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tretur');
			if($insertHead) {
				$idretur = $this->db->insert_id();
				$detail_array = $this->input->post('detail_array');
				$detail_array = json_decode($detail_array);
				foreach($detail_array as $row) {
					$this->db->set('idretur',$idretur);
					$this->db->set('itemid',$row[0]);
					$this->db->set('jumlah',remove_comma($row[2]));
					$this->db->set('alasan',$row[3]);
					$this->db->insert('treturdetail');
				}
			}

			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('save_error_message');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function save_() {
		$fakturid = $this->input->post('fakturid', TRUE);
		if($fakturid) {
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('fakturid',$fakturid);
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tretur');
			if($insertHead) {
				$idretur = $this->db->insert_id();
				for ($i=0; $i < count($this->input->post('no', TRUE)); $i++) {
					if(remove_comma($this->input->post('jumlah', TRUE)[$i]) > 0) {
						$this->db->set('idretur',$idretur);
						$this->db->set('itemid',$this->input->post('itemid', TRUE)[$i]);
						$this->db->set('jumlah',remove_comma($this->input->post('jumlah', TRUE)[$i]));
						$this->db->insert('treturdetail');
					}
				}

				$faktur = get_by_id('id',$fakturid,'tfaktur');
				$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
				$this->db->set('keterangan','Debet Memo '.$faktur['notrans']);
				$this->db->set('stauto','1');
				$this->db->set('tipe','7');
				$this->db->set('refid',$idretur);
				$insertJurnal = $this->db->insert('tjurnal');
				if($insertJurnal) {
					$idjurnal = $this->db->insert_id();
					$kontak = get_by_id('id',$faktur['kontakid'],'mkontak');
					$jurnalretur = $this->db->get_where('tjurnal', array('refid' => $idretur, 'tipe' => '6') )->row_array();

					$object = array(
						array(
							'idjurnal' => $idjurnal,
							'noakun' => $kontak['noakunutang'],
							'debet' => 0,
							'kredit' => $jurnalretur['totalkredit'],
						),
						array(
							'idjurnal' => $idjurnal,
							'noakun' => $kontak['noakunpiutang'],
							'debet' => $jurnalretur['totalkredit'],
							'kredit' => 0,
						),
					);
					$this->db->insert_batch('tjurnaldetail', $object);
				}
			}

			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getretur($id) {
		$this->db->select('tretur.*, mkontak.nama as kontak, mgudang.nama as gudang');
		$this->db->where('tretur.id', $id);
		$this->db->join('mkontak', 'tretur.kontakid = mkontak.id', 'left');
		$this->db->join('mgudang', 'tretur.gudangid = mgudang.id', 'left');
		$get = $this->db->get('tretur', 1);
		return $get->row_array();
	}

	public function returdetail($idretur) {
		$this->db->select('treturdetail.*, mitem.nama as item');
		$this->db->where('treturdetail.idretur', $idretur);
		$this->db->join('mitem', 'treturdetail.itemid = mitem.id', 'left');
		$get = $this->db->get('treturdetail');
		return $get->result_array();
	}
}

