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


class Pemesanan_penjualan_model extends CI_Model {

	public function save() {
		$data_array = $this->input->post('detail_array');
		$data_array = json_decode($data_array);
		$total_item = preg_replace("/[^0-9]/", "",$this->input->post('total_penjualan'));
		$total_uangmukaterm = preg_replace("/[^0-9]/", "",$this->input->post('tum'));
		$cara_pembayaran = $this->input->post('cara_pembayaran');
		$tanggal = $this->input->post('tanggal');
		if ($data_array == ''){
			$data['status'] = 'error';
			$data['message'] = "Silahkan isi detail terlebih dulu!";
		}
		else if ($total_item != $total_uangmukaterm){
			$data['status'] = 'error';
			$data['message'] = "Total item dan total uang muka + term harus sama!";
		}else{
			$hdata_budgetevent=0;
			foreach($data_array as $row => $value) {
				if ($value[10] == 'budgetevent'){
					$hdata_budgetevent = $hdata_budgetevent +1;
				}
			}
			if (($hdata_budgetevent > 0) && ($this->input->post('rekening') == '')){
				$data['status'] = 'error';
				$data['message'] = "Rekening belum dipilih!";
			}else{
				$id_pemesanan	= uniqid('PEM-JUAL');
				$insertHead 	= $this->db->insert('tpemesananpenjualan', [
					'id'				=> $id_pemesanan,
					'notrans'			=> $this->input->post('notrans'),
					'tanggal'			=> $tanggal,
					'kontakid'			=> $this->input->post('kontakid'),
					'gudangid'			=> $this->input->post('gudangid'),
					'idperusahaan'		=> $this->input->post('idperusahaan'),
					'departemen'		=> $this->input->post('dept'),
					'pejabat'			=> $this->input->post('pejabat'),
					'jenis_pembelian'	=> $this->input->post('jenis_penjualan'),
					'jenis_barang'		=> $this->input->post('jenis_barang'),
					'cara_pembayaran'	=> $this->input->post('cara_pembayaran'),
					'catatan'			=> $this->input->post('catatan'),
					'akunno'			=> ' ',
					'tipe'				=> '2',
					'status'			=> '4',
					'cby'				=> get_user('username'),
					'cdate'				=> date('Y-m-d H:i:s')
				]);

				// $insertHead	= 1;
				if($insertHead) {
					$detail_array = $this->input->post('detail_array');
					$detail_array = json_decode($detail_array);
					// print_r($detail_array);die();
					$no	= 0;
					$total_budgetevent=0;
					$hitung_budgetevent=0;
					foreach($detail_array as $row => $value) {
						$this->db->insert('tpemesananpenjualandetail', [
							'id'			=> uniqid('PEM-JUAL-DET'),
							'idpemesanan'	=> $id_pemesanan,
							'itemid'		=> $value[0],
							'harga'			=> preg_replace("/[^0-9]/", "", $this->input->post('harga')[$no]),
							'jumlah'		=> $this->input->post('jumlah')[$no],
							'status'		=> '4',
							'diskon'		=> $this->input->post('diskon')[$no],
							'ppn'			=> $this->input->post('ppn')[$no],
							'akunno'		=> $value[0],
							'subtotal'		=> preg_replace("/[^0-9]/", "", $this->input->post('subtotal')[$no]),
							'total'			=> preg_replace("/[^0-9]/", "", $this->input->post('total')[$no]),
							'tipe'			=> $value[10],
						]);
						if ($value[10] == 'budgetevent'){
							$total = preg_replace("/[^0-9]/", "", $this->input->post('total')[$no]);
							$total_budgetevent = $total_budgetevent + $total;
							$hitung_budgetevent= $hitung_budgetevent + 1;
						}
						$no++;
					}

					if ($hitung_budgetevent > 0 ){
						$this->db->insert('tbudgetevent', [
							'idpemesanan'	=> $id_pemesanan,
							'nokwitansi'	=> $this->input->post('nokwitansi'),
							'tanggal'		=> $tanggal,
							'perusahaan'	=> $this->input->post('idperusahaan'),
							'departemen'	=> $this->input->post('dept'),
							'pejabat'		=> $this->input->post('pejabat'),
							'keterangan'	=> $this->input->post('catatan'),
							'nominal'		=> $total_budgetevent,
							'rekening'		=> $this->input->post('rekening'),
							'status'		=> '0',
							'cby'			=> get_user('username'),
							'cdate'			=> date('Y-m-d H:i:s')
						]);
					}

					$this->db->insert('tpemesananpenjualanangsuran', [
						'id'			=> uniqid('PEM-JUAL-ANG'),
						'idpemesanan'	=> $id_pemesanan,
						'uangmuka'		=> preg_replace("/[^0-9]/", "", $this->input->post('um')),
						'jumlahterm'	=> $this->input->post('jtem'),
						'total'			=> preg_replace("/[^0-9]/", "", $this->input->post('tum')),
						'a1'			=> preg_replace("/[^0-9]/", "", $this->input->post('a1')),
						'a2'			=> preg_replace("/[^0-9]/", "", $this->input->post('a2')),
						'a3'			=> preg_replace("/[^0-9]/", "", $this->input->post('a3')),
						'a4'			=> preg_replace("/[^0-9]/", "", $this->input->post('a4')),
						'a5'			=> preg_replace("/[^0-9]/", "", $this->input->post('a5')),
						'a6'			=> preg_replace("/[^0-9]/", "", $this->input->post('a6')),
						'a7'			=> preg_replace("/[^0-9]/", "", $this->input->post('a7')),
						'a8'			=> preg_replace("/[^0-9]/", "", $this->input->post('a8')),
					]);
					$data['status'] = 'success';
					$data['message'] = 'Berhasil Menyimpan Data';
				}
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update() {
		$data_array = $this->input->post('detail_array');
		$data_array = json_decode($data_array);
		$total_item = preg_replace("/[^0-9]/", "",$this->input->post('total_penjualan'));
		$total_uangmukaterm = preg_replace("/[^0-9]/", "",$this->input->post('tum'));
		$cara_pembayaran = $this->input->post('cara_pembayaran');
		$tanggal = $this->input->post('tanggal');
		if ($data_array == ''){
			$data['status'] = 'error';
			$data['message'] = "Silahkan isi detail terlebih dulu!";
		}
		else if ($total_item != $total_uangmukaterm){
			$data['status'] = 'error';
			$data['message'] = "Total item dan total uang muka + term harus sama!";
		}else{
			$hdata_budgetevent=0;
			foreach($data_array as $row => $value) {
				if ($value[10] == 'budgetevent'){
					$hdata_budgetevent = $hdata_budgetevent +1;
				}
			}
			if (($hdata_budgetevent > 0) && ($this->input->post('rekening') == '')){
				$data['status'] = 'error';
				$data['message'] = "Rekening belum dipilih!";
			}else{

				$id_pemesanan	= $this->input->post('idpemesanan');
				//update data pemesanan
				$this->db->where('id',$id_pemesanan);
				$this->db->delete('tpemesananpenjualan');
				$insertHead 	= $this->db->insert('tpemesananpenjualan', [
						'id'				=> $id_pemesanan,
						'notrans'			=> $this->input->post('notrans'),
						'tanggal'			=> $tanggal,
						'kontakid'			=> $this->input->post('kontakid'),
						'gudangid'			=> $this->input->post('gudangid'),
						'idperusahaan'		=> $this->input->post('idperusahaan'),
						'departemen'		=> $this->input->post('dept'),
						'pejabat'			=> $this->input->post('pejabat'),
						'jenis_pembelian'	=> $this->input->post('jenis_penjualan'),
						'jenis_barang'		=> $this->input->post('jenis_barang'),
						'cara_pembayaran'	=> $this->input->post('cara_pembayaran'),
						'catatan'			=> $this->input->post('catatan'),
						'akunno'			=> ' ',
						'tipe'				=> '2',
						'status'			=> '4',
						'cby'				=> get_user('username'),
						'cdate'				=> date('Y-m-d H:i:s')
					]);
				// $insertHead	= 1;
				if($insertHead) {
					//hapus data detail pemesanan
					$this->db->where('idpemesanan',$id_pemesanan);
					$this->db->delete('tpemesananpenjualandetail');
					$detail_array = $this->input->post('detail_array');
					$detail_array = json_decode($detail_array);
					// print_r($detail_array);die();
					$no	= 0;
					$total_budgetevent=0;
					$hitung_budgetevent=0;
					foreach($detail_array as $row => $value) {
						$this->db->insert('tpemesananpenjualandetail', [
								'id'			=> uniqid('PEM-JUAL-DET'),
								'idpemesanan'	=> $id_pemesanan,
								'itemid'		=> $value[0],
								'harga'			=> preg_replace("/[^0-9]/", "", $this->input->post('harga')[$no]),
								'jumlah'		=> $this->input->post('jumlah')[$no],
								'status'		=> '4',
								'diskon'		=> $this->input->post('diskon')[$no],
								'ppn'			=> $this->input->post('ppn')[$no],
								'akunno'		=> $value[0],
								'subtotal'		=> preg_replace("/[^0-9]/", "", $this->input->post('subtotal')[$no]),
								'total'			=> preg_replace("/[^0-9]/", "", $this->input->post('total')[$no]),
								'tipe'			=> $value[10],
						]);
						if ($value[10] == 'budgetevent'){
							$total = preg_replace("/[^0-9]/", "", $this->input->post('total')[$no]);
							$total_budgetevent = $total_budgetevent + $total;
							$hitung_budgetevent= $hitung_budgetevent + 1;
						}
						$no++;
					}

					//hapus data budgetevent
					$this->db->where('idpemesanan',$id_pemesanan);
					$this->db->delete('tbudgetevent');
					if ($hitung_budgetevent > 0 ){
						$this->db->insert('tbudgetevent', [
							'idpemesanan'	=> $id_pemesanan,
							'nokwitansi'	=> $this->input->post('nokwitansi'),
							'tanggal'		=> $tanggal,
							'perusahaan'	=> $this->input->post('idperusahaan'),
							'departemen'	=> $this->input->post('dept'),
							'pejabat'		=> $this->input->post('pejabat'),
							'keterangan'	=> $this->input->post('catatan'),
							'nominal'		=> $total_budgetevent,
							'rekening'		=> $this->input->post('rekening'),
							'status'		=> '0',
							'cby'				=> get_user('username'),
							'cdate'				=> date('Y-m-d H:i:s')
						]);
					}

					//hapus data pemesanan anggsuran
					$this->db->where('idpemesanan',$id_pemesanan);
					$this->db->delete('tpemesananpenjualanangsuran');
					$this->db->insert('tpemesananpenjualanangsuran', [
						'id'			=> uniqid('PEM-JUAL-ANG'),
						'idpemesanan'	=> $id_pemesanan,
						'uangmuka'		=> preg_replace("/[^0-9]/", "", $this->input->post('um')),
						'jumlahterm'	=> $this->input->post('jtem'),
						'total'			=> preg_replace("/[^0-9]/", "", $this->input->post('tum')),
						'a1'			=> preg_replace("/[^0-9]/", "", $this->input->post('a1')),
						'a2'			=> preg_replace("/[^0-9]/", "", $this->input->post('a2')),
						'a3'			=> preg_replace("/[^0-9]/", "", $this->input->post('a3')),
						'a4'			=> preg_replace("/[^0-9]/", "", $this->input->post('a4')),
						'a5'			=> preg_replace("/[^0-9]/", "", $this->input->post('a5')),
						'a6'			=> preg_replace("/[^0-9]/", "", $this->input->post('a6')),
						'a7'			=> preg_replace("/[^0-9]/", "", $this->input->post('a7')),
						'a8'			=> preg_replace("/[^0-9]/", "", $this->input->post('a8')),
					]);
					$data['status'] = 'success';
					$data['message'] = 'Berhasil Megupdate Data';
				}
			}
		}	
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function tambah_angsuran() {
		$this->db->set('total',preg_replace("/[^0-9]/", "", $this->input->post('tum')));
		$this->db->set('a1',preg_replace("/[^0-9]/", "", $this->input->post('a1')));
		$this->db->set('a2',preg_replace("/[^0-9]/", "", $this->input->post('a2')));
		$this->db->set('a3',preg_replace("/[^0-9]/", "", $this->input->post('a3')));
		$this->db->set('a4',preg_replace("/[^0-9]/", "", $this->input->post('a4')));
		$this->db->set('a5',preg_replace("/[^0-9]/", "", $this->input->post('a5')));
		$this->db->set('a6',preg_replace("/[^0-9]/", "", $this->input->post('a6')));
		$this->db->set('a7',preg_replace("/[^0-9]/", "", $this->input->post('a7')));
		$this->db->set('a8',preg_replace("/[^0-9]/", "", $this->input->post('a8')));
		$this->db->where('idpemesanan',$this->input->post('idpemesanan'));
		$this->db->update('tpemesananpenjualanangsuran');
		$data['status'] = 'success';
		$data['message'] = 'Berhasil Mengupdate Data';
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
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
		$this->db->set('stdel','1');
		$this->db->where('id', $id);
		$update = $this->db->update('tpemesananpenjualan');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = 'Berhasil menghapus data';
		} else {
			$data['status'] = 'error';
			$data['message'] = 'Gagal menghapus data';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_detail_item_barang_dagangan() {
		$itemid = $this->input->post('itemid');
		$data	= [];
		if(is_array($itemid)) {
			for ($i=0; $i < count($itemid); $i++) {
				$this->db->select('mitem.*');
				$this->db->join('tstokmasuk', 'mitem.id = tstokmasuk.itemid');
				$this->db->where('mitem.id', $itemid[$i]);
				$data[$i] = $this->db->get('mitem')->row_array();
			}
		} else {
			$this->db->select('mitem.*');
			$this->db->join('tstokmasuk', 'mitem.id = tstokmasuk.itemid');
			$this->db->where('mitem.id', $itemid);
			$data[0] = $this->db->get('mitem')->row_array();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_detail_item_jasa() {
		$jasaid = $this->input->post('jasaid');
		$data	= [];
		if(is_array($jasaid)) {
			for ($i=0; $i < count($jasaid); $i++) {
				$this->db->select('*');
				$this->db->where('mnoakun.idakun', $jasaid[$i]);
				$data[$i] = $this->db->get('mnoakun')->row_array();
			}
		} else {
			$this->db->select('*');
			$this->db->where('mnoakun.idakun', $jasaid);
			$data[0] = $this->db->get('mnoakun')->row_array();
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
		$this->db->select('tpemesananpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as lain_lain');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id');
		$this->db->join('mnoakun', 'tpemesananpenjualandetail.itemid = mnoakun.idakun');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $idpemesanan);
		$get = $this->db->get('tpemesananpenjualandetail');
		return $get->result_array();
	}

	function get_detail_angsuran($id){
        $query = $this->db->get_where('tpemesananpenjualanangsuran', array('idpemesanan' => $id));
        return $query;
    }

    function get_detail_pemesanan($id){
        $this->db->select('tpemesananpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as jasa,  CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as budgetevent');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpemesananpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $id);
		$query = $this->db->get('tpemesananpenjualandetail');
		return $query;
    }
    function get_budget_event($id){
        $this->db->select('tbudgetevent.*');
		$this->db->where('tbudgetevent.idpemesanan', $id);
		$query = $this->db->get('tbudgetevent');
		return $query;
    }
}

