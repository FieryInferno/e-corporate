<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PersediaanModel extends CI_Model {

	public function get() {
		$this->db->select('mitem.kode, mitem.nama, msatuan.nama as satuan, mkategori.nama as kategori, saldoAwalPersediaan.quantity, mitem.hargabeliterakhir, saldoAwalPersediaan.nilaiTotal, mitem.id');
		$this->db->join('mitem','saldoAwalPersediaan.idItem = mitem.id');
		$this->db->join('msatuan','mitem.satuanid = msatuan.id', 'left');
		$this->db->join('mkategori','mitem.kategoriid = mkategori.id', 'left');
		$data	= $this->db->get('saldoAwalPersediaan')->result_array();
		$no		= 0;
		foreach ($data as $key) {
			// $data[$no]	
			$this->db->select('tpemesanandetail.jumlahditerima as masuk');
			$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
			$this->db->where('tanggaranbelanjadetail.uraian', $key['id']);
			$data[$no]['masuk']	= $this->db->get('tpemesanandetail')->row_array();
			$this->db->select('jumlah as keluar');
			$this->db->where('itemid', $key['id']);
			$data[$no]['keluar']	= $this->db->get('tpengirimanpenjualandetail')->row_array();
			$data[$no]['stok']	= $key['quantity'] + $data[$no]['masuk'] - $data[$no]['keluar'];
			$no++;
		}
		return $data;
	}
}

