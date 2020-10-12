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


class Laporan_penjualan_model extends CI_Model {

	public function get_faktur_penjualan() {
		$itemid = $this->input->get('itemid');
		if($itemid) {
			$tanggalawal = $this->input->get('tanggalawal');
			$tanggalakhir = $this->input->get('tanggalakhir');
			$kontakid = $this->input->get('kontakid');
			$gudangid = $this->input->get('gudangid');
			$status = $this->input->get('status');

			if(!$tanggalawal && !$tanggalakhir) {
				$tanggalawal = date('Y-m-01');
				$tanggalakhir = date('Y-m-t');
			}

			$this->db->select("
				tfaktur.id,
				tfaktur.tanggal,
				tfaktur.notrans as nofaktur,
				case when tpengiriman.statusauto = '1' then '-' else tpengiriman.notrans end as nopengiriman,
				case when tpengiriman.statusauto = '1' then '-' else tpemesanan.notrans end as nopemesanan,
				'1' as countdetail,
				mkontak.nama as kontak,
				mgudang.nama as gudang,
			");
			$this->db->where('tfaktur.tanggal >=', $tanggalawal);
			$this->db->where('tfaktur.tanggal <=', $tanggalakhir);
			if($itemid) $this->db->where('tfakturdetail.itemid', $itemid);
			if($kontakid) $this->db->where('tfaktur.kontakid', $kontakid);
			if($gudangid) $this->db->where('tfaktur.gudangid', $gudangid);
			if($status) $this->db->where('tfaktur.status', $status);
			$this->db->where('tfaktur.tipe', '2');
			$this->db->join('tfaktur', 'tfakturdetail.idfaktur = tfaktur.id');
			$this->db->join('tpengiriman', 'tfaktur.pengirimanid = tpengiriman.id', 'left');
			$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
			$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id', 'left');
			$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
			$this->db->order_by('tfaktur.id', 'desc');
			$get = $this->db->get('tfakturdetail');
			return $get->result_array();
		} else {
			$tanggalawal = $this->input->get('tanggalawal');
			$tanggalakhir = $this->input->get('tanggalakhir');
			$kontakid = $this->input->get('kontakid');
			$gudangid = $this->input->get('gudangid');
			$status = $this->input->get('status');

			if(!$tanggalawal && !$tanggalakhir) {
				$tanggalawal = date('Y-m-01');
				$tanggalakhir = date('Y-m-t');
			}

			$this->db->select("
				tfaktur.id,
				tfaktur.tanggal,
				tfaktur.notrans as nofaktur,
				case when tpengiriman.statusauto = '1' then '-' else tpengiriman.notrans end as nopengiriman,
				case when tpengiriman.statusauto = '1' then '-' else tpemesanan.notrans end as nopemesanan,
				(select count(*) from tfakturdetail where idfaktur = tfaktur.id) as countdetail,
				mkontak.nama as kontak,
				mgudang.nama as gudang,
			");
			$this->db->where('tfaktur.tanggal >=', $tanggalawal);
			$this->db->where('tfaktur.tanggal <=', $tanggalakhir);
			if($kontakid) $this->db->where('tfaktur.kontakid', $kontakid);
			if($gudangid) $this->db->where('tfaktur.gudangid', $gudangid);
			if($status) $this->db->where('tfaktur.status', $status);
			$this->db->where('tfaktur.tipe', '2');
			$this->db->join('tpengiriman', 'tfaktur.pengirimanid = tpengiriman.id', 'left');
			$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
			$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id', 'left');
			$this->db->join('mgudang', 'tfaktur.gudangid = mgudang.id', 'left');
			$this->db->order_by('tfaktur.id', 'desc');
			$get = $this->db->get('tfaktur');
			return $get->result_array();
		}
	}

	public function get_faktur_penjualan_detail($idfaktur) {
		$this->db->select('tfakturdetail.*, mitem.nama as item, msatuan.nama as satuan');
		$this->db->where('idfaktur', $idfaktur);
		$this->db->join('mitem', 'tfakturdetail.itemid = mitem.id', 'left');
		$this->db->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$get = $this->db->get('tfakturdetail');
		return $get->result_array();
	}
}

