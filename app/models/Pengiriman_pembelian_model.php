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


class Pengiriman_pembelian_model extends CI_Model {

	public function save() {
		$this->db->select('total');
		$total	= $this->db->get_where('tPenerimaan', [
			'idPenerimaan'	=> $this->input->post('idPenerimaan')
		])->row_array();
		for ($i=0; $i < count($this->input->post('itemid')); $i++) { 
			$total['total']	+= (integer) $this->input->post('jumlah')[$i] * (integer) $this->input->post('harga')[$i];
		}
		$this->db->where('idPenerimaan', $this->input->post('idPenerimaan'));
		$insertHead = $this->db->update('tPenerimaan', [
			'tanggal'	=> $this->input->post('tanggal'),
			'catatan'	=> $this->input->post('catatan'),
			'tipe'		=> 1,
			'total'		=> $total['total']
		]);
		if($insertHead) {
			for ($i=0; $i < count($this->input->post('no', TRUE)); $i++) {
				if ($this->input->post('jumlah', TRUE)[$i] > 0) {
					$this->db->insert('tPenerimaanDetail', [
						'idPenerimaan'		=> $this->input->post('idPenerimaan'),
						'idPemesananDetail'	=> $this->input->post('pemdet', TRUE)[$i],
						'jumlah'			=> $this->input->post('jumlah', TRUE)[$i]
					]);
				}
				
				$this->db->select('jumlahditerima');
				$jumlah_diterima	= $this->db->get_where('tpemesanandetail', [
					'id'	=> $this->input->post('pemdet')[$i]
				])->row_array();

				$this->db->where('id', $this->input->post('pemdet')[$i]);
				$this->db->update('tpemesanandetail', [
					'jumlahsisa'		=> (integer) $this->input->post('jumlah_sisa')[$i] - (integer) $this->input->post('jumlah')[$i],
					'jumlahditerima'	=> (integer) $this->input->post('jumlah')[$i] + (integer) $jumlah_diterima['jumlahditerima']
				]);
			}
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function cekjumlahinput() {
		$itemid = $this->input->post('itemid', TRUE);
		$idpemesanan = $this->input->post('idpemesanan', TRUE);
		if($itemid && $idpemesanan) {
			$this->db->select('jumlahsisa');
			$this->db->where('idpemesanan', $idpemesanan);
			$this->db->where('itemid', $itemid);
			$row = $this->db->get('tpemesanandetail', 1)->row_array();
			$data['jumlahsisa'] = $row['jumlahsisa'];
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function getpengiriman($id) {
		$this->db->select('tpengiriman.*, tpemesanan.kontakid, tpemesanan.gudangid, mkontak.nama as kontak, mkontak.alamat, mkontak.cp');
		$this->db->where('tpengiriman.id', $id);
		$this->db->join('tpemesanan', 'tpengiriman.pemesananid = tpemesanan.id', 'left');
		$this->db->join('mkontak', 'tpengiriman.kontakid = mkontak.id', 'left');
		$get = $this->db->get('tpengiriman',1);
		return $get->row_array();
	}

	public function pengirimandetail($idpengirman) {
		$this->db->select('tpengirimandetail.*, mitem.nama as item, msatuan.nama as satuan');
		$this->db->join('mitem', 'tpengirimandetail.itemid = mitem.id', 'left');
		$this->db->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$this->db->join('tpengiriman', 'tpengirimandetail.idpengiriman = tpengiriman.id');
		$this->db->where('tpengirimandetail.idpengiriman', $idpengirman);
		$get = $this->db->get('tpengirimandetail');
		return $get->result_array();
	}

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesanandetail.*, mitem.nama as item');
		$this->db->join('mitem', 'tpemesanandetail.itemid = mitem.id', 'left');
		$this->db->where('tpemesanandetail.idpemesanan', $idpemesanan);
		$this->db->where('tpemesanandetail.status !=', '3');
		$get = $this->db->get('tpemesanandetail');
		return $get->result_array();
	}

	public function get($id)
	{
		$this->db->select('tPenerimaan.idPenerimaan as id, tPenerimaan.notrans, tPenerimaan.catatan, mperusahaan.nama_perusahaan, tpemesanan.departemen, tpemesanan.tanggal, tpemesanan.total as nominal_pemesanan, mkontak.nama as supplier, tPenerimaan.total as nominal_penerimaan, mgudang.nama as gudang, tPenerimaan.status, tpemesanan.notrans as nopemesanan, tpemesanan.id as idpemesanan, tPenerimaan.tanggal as tanggal_pengiriman');
		$this->db->join('tpemesanan', 'tPenerimaan.pemesanan = tpemesanan.id');
		$this->db->join('mkontak','tpemesanan.kontakid = mkontak.id');
		$this->db->join('mgudang','tpemesanan.gudangid = mgudang.id', 'left');
		$this->db->join('mperusahaan','tpemesanan.idperusahaan = mperusahaan.idperusahaan');
		if ($id !== null) {
			$this->db->where('tPenerimaan.idPenerimaan', $id);
			$data	= $this->db->get('tPenerimaan')->row_array();
			$this->db->select('mitem.kode as kode_barang, mitem.nama as nama_barang, tpemesanandetail.biayapengiriman, tpemesanandetail.ppn as pajak, tpemesanandetail.subtotal, tpemesanandetail.jumlahditerima, tpemesanandetail.harga, tpemesanandetail.id as idbarang');
			$this->db->join('tpemesanandetail', 'tPenerimaanDetail.idpemesanandetail = tpemesanandetail.id');
			$this->db->join('mitem', 'tpemesanandetail.itemid = mitem.id');
			$this->db->where('tPenerimaanDetail.idPenerimaan', $data['id']);
			$data['detail_pengiriman']	= $this->db->get('tPenerimaanDetail')->result_array();
			$data['angsuran']			= $this->db->get_where('tpemesananangsuran', [
				'idpemesanan'	=> $data['idpemesanan']
			])->row_array();
		} else {
			$data	= $this->db->get('tpengiriman')->result_array();
			$no		= 0; 
			foreach ($data as $key) {
				$this->db->select('mitem.kode as kode_barang, mitem.nama as nama_barang, tpemesanandetail.biayapengiriman, tpemesanandetail.ppn as pajak, tpemesanandetail.subtotal, tpemesanandetail.jumlahditerima, tpemesanandetail.harga, tpemesanandetail.id as idbarang');
				$this->db->join('tpemesanandetail', 'tPenerimaanDetail.idpemesanandetail = tpemesanandetail.id');
				$this->db->join('mitem', 'tpemesanandetail.itemid = mitem.id');
				$this->db->where('tPenerimaanDetail.idPenerimaan', $key['id']);
				$data[$no]['detail_pengiriman']	= $this->db->get('tPenerimaanDetail')->result_array();
				$data[$no]['angsuran']			= $this->db->get_where('tpemesananangsuran', [
					'idpemesanan'	=> $key['idpemesanan']
				])->row_array();
				$no++;
			}
		}
		$no	= 0;
		return $data;
	}

	public function delete() {
		$id = $this->uri->segment(3);
		$this->db->where('id', $id);
		$update = $this->db->delete('tpengiriman');
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
		$id 	= $this->input->post('id');
		$data	= [];
		if(is_array($id)) {
			for ($i=0; $i < count($id); $i++) {
				$data[$i] = $this->get($id[$i]);
			}
		} else {
			$data[0] = $this->get($id);
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
}

