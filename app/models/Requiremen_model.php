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


class Requiremen_model extends CI_Model {

	public function save($id) {
		if ($id == null) {
			$id_pemesanan	= uniqid('PEMESANAN');
		} else {
			$id_pemesanan	= $id;
		}
		$total				= 0;
		$pajak				= 0;
		$diskon				= 0;
		$subtotal			= 0;
		$biayapengiriman	= 0;
		foreach ($this->input->post('total') as $key) {
			$total	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
		}
		foreach ($this->input->post('total_pajak') as $key) {
			$pajak	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
		}
		foreach ($this->input->post('diskon') as $key) {
			$diskon	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
		}
		foreach ($this->input->post('subtotal') as $key) {
			$subtotal	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
		}
		foreach ($this->input->post('biayapengiriman') as $key) {
			$subtotal	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $key);
		}
		if ($id == null) {
			$insertHead	= $this->db->insert('tpemesanan', [
				'id'				=> $id_pemesanan,
				'notrans'			=> $this->input->post('notrans'),
				'tanggal'			=> $this->input->post('tanggal'),
				'kontakid'			=> $this->input->post('kontakid'),
				'gudangid'			=> $this->input->post('gudangid'),
				'idperusahaan'		=> $this->input->post('idperusahaan'),
				'departemen'		=> $this->input->post('dept'),
				'pejabat'			=> $this->input->post('pejabat'),
				'jenis_pembelian'	=> $this->input->post('jenis_pembelian'),
				'jenis_barang'		=> $this->input->post('jenis_barang'),
				'cara_pembayaran'	=> $this->input->post('cara_pembayaran'),
				'catatan'			=> $this->input->post('catatan'),
				'tipe'				=> '2',
				'status'			=> '4',
				'cby'				=> get_user('username'),
				'cdate'				=> date('Y-m-d H:i:s'),
				'total'				=> $total,
				'ppn'				=> $pajak,
				'diskon'			=> $diskon,
				'subtotal'			=> $subtotal,
				'biayapengiriman'	=> $biayapengiriman
			]);
		} else {
			$this->db->where('id', $id_pemesanan);
			$insertHead	= $this->db->update('tpemesanan', [
				'tanggal'			=> $this->input->post('tanggal'),
				'kontakid'			=> $this->input->post('kontakid'),
				'gudangid'			=> $this->input->post('gudangid'),
				'idperusahaan'		=> $this->input->post('idperusahaan'),
				'departemen'		=> $this->input->post('dept'),
				'pejabat'			=> $this->input->post('pejabat'),
				'jenis_pembelian'	=> $this->input->post('jenis_pembelian'),
				'jenis_barang'		=> $this->input->post('jenis_barang'),
				'cara_pembayaran'	=> $this->input->post('cara_pembayaran'),
				'catatan'			=> $this->input->post('catatan'),
				'tipe'				=> '2',
				'status'			=> '4',
				'cby'				=> get_user('username'),
				'cdate'				=> date('Y-m-d H:i:s'),
				'total'				=> $total,
				'ppn'				=> $pajak,
				'diskon'			=> $diskon,
				'subtotal'			=> $subtotal,
				'biayapengiriman'	=> $biayapengiriman
			]);
		}
		if($insertHead) {
			$this->db->where('idpemesanan', $id);
			$this->db->delete('tpemesanandetail');
			$detail_array = $this->input->post('detail_array');
			$detail_array = json_decode($detail_array);
			$no	= 0;
			foreach($detail_array as $row => $value) {
				$this->db->insert('tpemesanandetail', [
					'id'			=> uniqid('PEM-DET'),
					'idpemesanan'	=> $id_pemesanan,
					'itemid'		=> $value[0],
					'harga'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga')[$no]),
					'jumlah'		=> $this->input->post('jumlah')[$no],
					'status'		=> '4',
					'diskon'		=> $this->input->post('diskon')[$no],
					'ppn'			=> $this->input->post('total_pajak')[$no],
					'akunno'		=> $value[8],
					'subtotal'		=> $this->input->post('subtotal')[$no],
					'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total')[$no]),
					'jumlahsisa'	=> $this->input->post('jumlah')[$no],
					'biayapengiriman'	=> $this->input->post('biayapengiriman')[$no],
				]);
				$no++;
			}
			$angsuran['id']				= uniqid('PEM-ANG');
			$angsuran['idpemesanan']	= $id_pemesanan;
			if ($this->input->post('tum') !== '') {
				$angsuran['uangmuka']	= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('um'));
				$angsuran['jumlahterm']	= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jtem'));
				$angsuran['total']		= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('tum'));
				$angsuran['a1']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a1'));
				$angsuran['a2']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a2'));
				$angsuran['a3']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a3'));
				$angsuran['a4']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a4'));
				$angsuran['a5']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a5'));
				$angsuran['a6']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a6'));
				$angsuran['a7']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a7'));
				$angsuran['a8']			= preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a8'));
			}
			$this->db->insert('tpemesananangsuran', $angsuran);
			$this->db->insert('tpengiriman', [
				'pemesananid'	=> $id_pemesanan,
				'total'			=> 0
			]);
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function tambah_angsuran() {
		if (preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('tum')) == $this->input->post('grandtotal')) {
			$this->db->where('id', $this->input->post('id_angsuran'));
			$this->db->update('tpemesananangsuran', [
				'uangmuka'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('um')),
				'jumlahterm'	=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jtem')),
				'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('tum')),
				'a1'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a1')),
				'a2'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a2')),
				'a3'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a3')),
				'a4'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a4')),
				'a5'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a5')),
				'a6'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a6')),
				'a7'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a7')),
				'a8'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a8')),
			]);
			$this->db->where('id', $this->input->post('idpemesanan'));
			$this->db->update('tpemesanan', [
				'status'	=> '6'
			]);
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$data['status']		= 'gagal';
			$data['message']	= 'Jumlah Total dan Jumlah Uang Muka tidak sama';
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function requiremendetail($idpemesanan) {
		$this->db->select('trequiremendetail.*, mitem.nama as item');
		$this->db->join('mitem', 'trequiremendetail.itemid = mitem.id', 'left');
		$this->db->where('trequiremendetail.idpemesanan', $idpemesanan);
		$get = $this->db->get('trequiremendetail');
		return $get->result_array();
	}

	public function delete() {
		$id = $this->uri->segment(3);
		// $this->db->set('stdel','1');
		$this->db->where('id', $id);
		$update = $this->db->delete('tpemesanan');
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
		$itemid = $this->input->post('itemid');
		$data	= [];
		if(is_array($itemid)) {
			for ($i=0; $i < count($itemid); $i++) {
				// $this->db->select('tanggaranbelanjadetail.*, tanggaranbelanja.*, mitem.nama');
				$this->db->select('tanggaranbelanjadetail.koderekening, tanggaranbelanjadetail.jumlah');
				// $this->db->join('tanggaranbelanjadetail', 'tanggaranbelanja.id=tanggaranbelanjadetail.idanggaran');
				$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
				$this->db->where('mitem.id', $itemid[$i]);
				// $data[$i] = $this->db->get('tanggaranbelanja')->row_array();
				$data[$i] = $this->db->get('tanggaranbelanjadetail')->row_array();
			}
		} else {
			// $this->db->select('tanggaranbelanjadetail.*, tanggaranbelanja.*, mitem.nama');
			$this->db->select('tanggaranbelanjadetail.koderekening, tanggaranbelanjadetail.jumlah');
			// $this->db->join('tanggaranbelanjadetail', 'tanggaranbelanja.id=tanggaranbelanjadetail.idanggaran');
			$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
			$this->db->where('mitem.id', $itemid[$i]);
			// $data[$i] = $this->db->get('tanggaranbelanja')->row_array();
			$data[0] = $this->db->get('tanggaranbelanjadetail')->row_array();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_stok_item() {
		$itemid = $this->input->post('itemid', TRUE);
		$gudangid = $this->input->post('gudangid', TRUE);
		if($itemid && $gudangid) {
			$this->db->select_sum('sisa','stok');
			$this->db->where('itemid', $itemid);
			$this->db->where('gudangid', $gudangid);
			$data = $this->db->get('tstokmasuk', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	public function detail_item() {
		$id = $this->input->post('itemid');
		if($id) {
			$data['status'] = 'success';
			$data['data'] = $this->db->get_where('tanggaranbelanja', array('id' => $id))->row_array();
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('bad_request');
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesanandetail.*, tanggaranbelanjadetail.uraian as item');
		$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id', 'left');
		$this->db->where('tpemesanandetail.idpemesanan', $idpemesanan);
		$get = $this->db->get('tpemesanandetail');
		return $get->result_array();
	}

	public function get($id)
	{
		$data			= $this->db->get_where('tpemesanan', [
			'id'	=> $id
		])->row_array();
		$data['detail']	= $this->db->get_where('tpemesanandetail', [
			'idpemesanan'	=> $id
		])->result_array();
		return $data;
	}
}

