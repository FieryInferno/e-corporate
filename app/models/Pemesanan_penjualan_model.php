<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan_penjualan_model extends CI_Model {

	public function save() {
		$data_array_item = $this->input->post('detail_array_item');
		$data_array_item = json_decode($data_array_item);
		$total_item			= preg_replace("/(Rp. |,00|[^0-9])/", "",$this->input->post('total_penjualan'));
		$total_uangmukaterm = preg_replace("/(Rp. |,00|[^0-9])/", "",$this->input->post('tum'));
		if ($data_array_item == ''){
			$data['status'] = 'error';
			$data['message'] = "Silahkan isi detail terlebih dulu!";
		}
		else if ($total_item != $total_uangmukaterm){
			$data['status'] = 'error';
			$data['message'] = "Total item dan total uang muka + term harus sama!";
		}else{
			$data_array_budgetevent = $this->input->post('detail_array_budgetevent');
			$data_array_budgetevent = json_decode($data_array_budgetevent);

			$jumlah_budgetevent=0;
			if ($data_array_budgetevent != ''){
				foreach($data_array_budgetevent as $row => $value) {
					$jumlah_budgetevent = $jumlah_budgetevent +1;
				}
			}

			if (($data_array_budgetevent > 0) && ($this->input->post('rekening') == '')){
				$data['status'] = 'error';
				$data['message'] = "Rekening budget event belum dipilih!";
			}else{
				$id_pemesanan	= uniqid('PEM-JUAL');
				$insertHead 	= $this->db->insert('tpemesananpenjualan', [
					'id'				=> $id_pemesanan,
					'notrans'			=> $this->input->post('notrans'),
					'tanggal'			=> $this->input->post('tanggal'),
					'kontakid'			=> $this->input->post('kontakid'),
					'gudangid'			=> $this->input->post('gudangid'),
					'idperusahaan'		=> $this->input->post('idperusahaan'),
					'departemen'		=> $this->input->post('dept'),
					'pejabat'			=> $this->input->post('pejabat'),
					'cabang'			=> $this->input->post('cabang'),
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
				if ($insertHead){

					$no	= 0;
					foreach($data_array_item as $row => $value) {
						$idDetailPemesananPenjualan	= uniqid('PEM-JUAL-DET'); 
						$this->db->insert('tpemesananpenjualandetail', [
							'id'			=> $idDetailPemesananPenjualan,
							'idpemesanan'	=> $id_pemesanan,
							'itemid'		=> $value[0],
							'harga'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga')[$no]),
							'jumlah'		=> $this->input->post('jumlah')[$no],
							'status'		=> '4',
							'diskon'		=> $this->input->post('diskon')[$no],
							'ppn'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total_pajak')[$no]),
							'biaya_pengiriman'=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('biayapengiriman')[$no]),
							'akunno'		=> $value[9],
							'subtotal'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('subtotal')[$no]),
							'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total')[$no]),
							'tipe'			=> $value[12],
						]);
						$idPajak			= explode(',', $this->input->post('idPajak')[$no]);
						$nominal			= explode(',', $this->input->post('pajak')[$no]);
						$pengurangan		= explode(',', $this->input->post('pengurangan')[$no]);
						for ($i=0; $i < count($idPajak); $i++) { 
							$this->db->insert('pajakPemesananPenjualan', [
								'idDetailPemesananPenjualan'	=> $idDetailPemesananPenjualan,
								'idPajak'						=> $idPajak[$i],
								'nominal'						=> preg_replace("/(Rp. |,00|[^0-9])/", "", $nominal[$i]),
								'pengurangan'					=> $pengurangan[$i]
							]);
						}
						$no++;
					}

					$no1 = 0;
					if ($data_array_budgetevent != ''){
						foreach($data_array_budgetevent as $row => $value) {
							$this->db->insert('tbudgetevent', [
								'idpemesanan'	=> $id_pemesanan,
								'nokwitansi'	=> $this->input->post('nokwitansi'),
								'idbudgetevent'	=> $value[0],
								'harga'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga1')[$no1]),
								'jumlah'		=> $this->input->post('jumlah1')[$no1],
								'subtotal'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('subtotal1')[$no1]),
								'diskon'		=> $this->input->post('diskon1')[$no1],
								'ppn'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total_pajak1')[$no1]),
								'biaya_pengiriman'=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('biayapengiriman1')[$no1]),
								'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total1')[$no1]),
								'tanggal'		=> $this->input->post('tanggal'),
								'perusahaan'	=> $this->input->post('idperusahaan'),
								'departemen'	=> $this->input->post('dept'),
								'pejabat'		=> $this->input->post('pejabat'),
								'keterangan'	=> $this->input->post('catatan'),
								'rekening'		=> $this->input->post('rekening'),
								'status'		=> '4',
								'cby'			=> get_user('username'),
								'cdate'			=> date('Y-m-d H:i:s')
							]);
							$no1++;
						}
					}

					$this->db->insert('tpemesananpenjualanangsuran', [
						'id'			=> uniqid('PEM-JUAL-ANG'),
						'idpemesanan'	=> $id_pemesanan,
						'uangmuka'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('um')),
						'jumlahterm'	=> $this->input->post('jtem'),
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

					$data['status'] = 'success';
					$data['message'] = 'Berhasil menyimpan data';
				}else{
					$data['status'] = 'error';
					$data['message'] = 'Gagal menyimpan data';
				}
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function update() {
		
		$data_array_item = $this->input->post('detail_array_item');
		$data_array_item = json_decode($data_array_item);
		$total_item			= preg_replace("/(Rp. |,00|[^0-9])/", "",$this->input->post('total_penjualan'));
		$total_uangmukaterm = preg_replace("/(Rp. |,00|[^0-9])/", "",$this->input->post('tum'));
		if ($data_array_item == ''){
			$data['status'] = 'error';
			$data['message'] = "Silahkan isi detail terlebih dulu!";
		}
		else if ($total_item != $total_uangmukaterm){
			$data['status'] = 'error';
			$data['message'] = "Total item dan total uang muka + term harus sama!";
		}else{
			$data_array_budgetevent = $this->input->post('detail_array_budgetevent');
			$data_array_budgetevent = json_decode($data_array_budgetevent);

			$jumlah_budgetevent=0;
			if ($data_array_budgetevent != ''){
				foreach($data_array_budgetevent as $row => $value) {
					$jumlah_budgetevent = $jumlah_budgetevent +1;
				}
			}

			if (($data_array_budgetevent > 0) && ($this->input->post('rekening') == '')){
				$data['status'] = 'error';
				$data['message'] = "Rekening budget event belum dipilih!";
			}else{
				$id_pemesanan = $this->input->post('idpemesanan');

				$this->db->set('tanggal', $this->input->post('tanggal'));
				$this->db->set('kontakid', $this->input->post('kontakid'));
				$this->db->set('gudangid', $this->input->post('gudangid'));
				$this->db->set('idperusahaan', $this->input->post('idperusahaan'));
				$this->db->set('departemen', $this->input->post('dept'));
				$this->db->set('pejabat', $this->input->post('pejabat'));
				$this->db->set('jenis_pembelian', $this->input->post('jenis_penjualan'));
				$this->db->set('jenis_barang', $this->input->post('jenis_barang'));
				$this->db->set('cara_pembayaran', $this->input->post('cara_pembayaran'));
				$this->db->set('catatan', $this->input->post('catatan'));
				$this->db->set('subtotal','');
				$this->db->set('ppn','');
				$this->db->set('biaya_pengiriman','');
				$this->db->set('diskon','');
				$this->db->set('total','');
				$this->db->set('akunno','');
				$this->db->set('tipe', '2');
				$this->db->set('status', '4');
				$this->db->set('uby', get_user('username'));
				$this->db->set('udate', date('Y-m-d H:i:s'));
				$this->db->where('id', $id_pemesanan);
				$update = $this->db->update('tpemesananpenjualan');

				if ($update){
					$this->db->where('idpemesanan', $id_pemesanan);
					$this->db->delete('tpemesananpenjualandetail');

					$no	= 0;
					foreach($data_array_item as $row => $value) {
						$this->db->insert('tpemesananpenjualandetail', [
							'id'			=> uniqid('PEM-JUAL-DET'),
							'idpemesanan'	=> $id_pemesanan,
							'itemid'		=> $value[0],
							'harga'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga')[$no]),
							'jumlah'		=> $this->input->post('jumlah')[$no],
							'status'		=> '4',
							'diskon'		=> $this->input->post('diskon')[$no],
							'ppn'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total_pajak')[$no]),
							'biaya_pengiriman'=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('biayapengiriman')[$no]),
							'akunno'		=> $value[9],
							'subtotal'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('subtotal')[$no]),
							'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total')[$no]),
							'tipe'			=> $value[12],
						]);
						$no++;
					}

					$this->db->where('idpemesanan', $id_pemesanan);
					$this->db->delete('tbudgetevent');

					$no1 = 0;
					if ($data_array_budgetevent != ''){
						foreach($data_array_budgetevent as $row => $value) {
							$this->db->insert('tbudgetevent', [
								'idpemesanan'	=> $id_pemesanan,
								'nokwitansi'	=> $this->input->post('nokwitansi'),
								'idbudgetevent'	=> $value[0],
								'harga'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga1')[$no1]),
								'jumlah'		=> $this->input->post('jumlah1')[$no1],
								'subtotal'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('subtotal1')[$no1]),
								'diskon'		=> $this->input->post('diskon1')[$no1],
								'ppn'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total_pajak1')[$no1]),
								'biaya_pengiriman'=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('biayapengiriman1')[$no1]),
								'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total1')[$no1]),
								'tanggal'		=> $this->input->post('tanggal'),
								'perusahaan'	=> $this->input->post('idperusahaan'),
								'departemen'	=> $this->input->post('dept'),
								'pejabat'		=> $this->input->post('pejabat'),
								'keterangan'	=> $this->input->post('catatan'),
								'rekening'		=> $this->input->post('rekening'),
								'status'		=> '4',
								'cby'			=> get_user('username'),
								'cdate'			=> date('Y-m-d H:i:s')
							]);
							$no1++;
						}
					}

					$this->db->where('idpemesanan', $id_pemesanan);
					$this->db->delete('tpemesananpenjualanangsuran');

					$this->db->insert('tpemesananpenjualanangsuran', [
						'id'			=> uniqid('PEM-JUAL-ANG'),
						'idpemesanan'	=> $id_pemesanan,
						'uangmuka'		=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('um')),
						'jumlahterm'	=> $this->input->post('jtem'),
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


					$data['status'] = 'success';
					$data['message'] = 'Berhasil mengubah data';
				}else{
					$data['status'] = 'error';
					$data['message'] = 'Gagal mengubah data';
				}
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function tambah_angsuran() {
		$this->db->set('total',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('tum')));
		$this->db->set('a1',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a1')));
		$this->db->set('a2',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a2')));
		$this->db->set('a3',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a3')));
		$this->db->set('a4',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a4')));
		$this->db->set('a5',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a5')));
		$this->db->set('a6',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a6')));
		$this->db->set('a7',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a7')));
		$this->db->set('a8',preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('a8')));
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
		$this->db->set('stdel', '1');
		$this->db->set('dby', get_user('username'));
		$this->db->set('ddate', date('Y-m-d H:i:s'));
		$this->db->where('id', $id);
		$update_pesanan = $this->db->update('tpemesananpenjualan');
		if ($update_pesanan) {
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
		$data	= $this->db->get('tpemesananpenjualandetail')->result_array();
		for ($i=0; $i < count($data); $i++) { 
			$this->db->select('mpajak.nama_pajak, mnoakun.akunno, mnoakun.namaakun, pajakPemesananPenjualan.nominal, pajakPemesananPenjualan.pengurangan');
			$this->db->join('mpajak', 'pajakPemesananPenjualan.idPajak = mpajak.id_pajak');
			$this->db->join('mnoakun', 'mpajak.akun = mnoakun.idakun');
			$data[$i]['pajak']	= $this->db->get_where('pajakPemesananPenjualan', [
				'idDetailPemesananPenjualan'	=> $data[$i]['id']
			])->result_array();
		}
		return $data;
	}

	function get_detail_angsuran($id){
        $query = $this->db->get_where('tpemesananpenjualanangsuran', array('idpemesanan' => $id));
        return $query;
    }

    function get_detail_pemesanan($id){
        $this->db->select('tpemesananpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as inventaris, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as jasa');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpemesananpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $id);
		$query = $this->db->get('tpemesananpenjualandetail');
		return $query;
    }

    function get_detail_budgetevent($id){
        $this->db->select('tbudgetevent.*, mnoakun.akunno as akunno, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as budgetevent');
		$this->db->join('mnoakun', 'tbudgetevent.idbudgetevent = mnoakun.idakun', 'left');
		$this->db->where('tbudgetevent.idpemesanan', $id);
		$query = $this->db->get('tbudgetevent');
		return $query;
    }
    function get_budget_event($id){
        $this->db->select('tbudgetevent.*');
		$this->db->where('tbudgetevent.idpemesanan', $id);
		$query = $this->db->get('tbudgetevent');
		return $query;
    }

    function get_noakun_item($id,$jenisitem){
    	if ($jenisitem == 'barang'){
    		$this->db->select('mitem.noakunjual as koderekening');
    		$this->db->where('mitem.id',$id);
    		$query = $this->db->get('mitem');
    	}else if ($jenisitem == 'inventaris'){
    		$this->db->select('mnoakun.akunno as koderekening');
    		$this->db->where('mnoakun.idakun',$id);
    		$query = $this->db->get('mnoakun');
    	}else if ($jenisitem == 'jasa'){
    		$this->db->select('mnoakun.akunno as koderekening');
    		$this->db->where('mnoakun.idakun',$id);
    		$query = $this->db->get('mnoakun');
    	}else if ($jenisitem == 'budgetevent'){
    		$this->db->select('mnoakun.akunno as koderekening');
    		$this->db->where('mnoakun.idakun',$id);
    		$query = $this->db->get('mnoakun');
    	}
        return $query;
    }
}

