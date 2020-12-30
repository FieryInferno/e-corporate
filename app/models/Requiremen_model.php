<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
		$jenis_pembelian	= $this->input->post('jenis_pembelian');
		$jenis_barang 		= $this->input->post('jenis_barang');
		$noakun1 			= $this->input->post('noAkun1');
		$noakun 			= $this->input->post('noakun');
		$harga				= $this->input->post('harga');
		$tanggal				= $this->input->post('tanggal');
		$item				= $this->input->post('item');

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
				$idPemesananDetail	= uniqid('PEM-DET');
				$this->db->insert('tpemesanandetail', [
					'id'			=> $idPemesananDetail,
					'idpemesanan'	=> $id_pemesanan,
					'itemid'		=> $value[0],
					'harga'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga')[$no]),
					'jumlah'		=> $this->input->post('jumlah')[$no],
					'status'		=> '4',
					'diskon'		=> $this->input->post('diskon')[$no],
					'ppn'			=> $this->input->post('total_pajak')[$no],
					'akunno'		=>  $this->input->post('noAkun1')[$no],
					'subtotal'		=> $this->input->post('subtotal')[$no],
					'total'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('total')[$no]),
					'jumlahsisa'	=> $this->input->post('jumlah')[$no],
					'biayapengiriman'	=> $this->input->post('biayapengiriman')[$no],
				]);
				$idPajak			= explode(',', $this->input->post('idPajak')[$no]);
				$nominal			= explode(',', $this->input->post('pajak')[$no]);
				$pengurangan		= explode(',', $this->input->post('pengurangan')[$no]);
				for ($i=0; $i < count($idPajak); $i++) { 
					$this->db->insert('pajakPembelian', [
						'idPemesananDetail'	=> $idPemesananDetail,
						'idPajak'			=> $idPajak[$i],
						'nominal'			=> preg_replace("/(Rp. |,00|[^0-9])/", "", $nominal[$i]),
						'pengurangan'		=> $pengurangan[$i]
					]);
				}
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
			$this->db->insert('tPenerimaan', [
				'pemesanan'	=> $id_pemesanan,
				'total'		=> 0,
				'tipe'		=> 1
			]);

		}

		if($jenis_pembelian == 'barang' && $jenis_barang == 'inventaris'){
			$get_last_inventaris = $this->db->select('*')->from('tinventaris')->order_by('id_inventaris', 'DESC')->get()->row_array();
			$no_reg = $get_last_inventaris['no_register'];
			if(empty($get_last_inventaris)){
				$no = 1;
			} else {
				$no = intval($no_reg) + 1;
			}

			$pch_tgl = explode('-', $tanggal);

			$jml_item = count($harga);
			for($i=0; $i<$jml_item; $i++){
				$no_register = $no+$i;
				// $pch_akun = explode('.', $noakun[$i]);
				// $jenis_akun = $pch_akun[0].'.'.$pch_akun[1].'.'.$pch_akun[2];
				$get_item = $this->db->get_where('mitem', ['nama' => $item[$i]])->row_array();
				$nama_barang = $get_item['nama'];
				$kode_barang = $get_item['kode'];

				$insert_inventaris = [
					'no_register'	=> $no_register,
					'id_pemesanan'	=> $id_pemesanan,
					'idperusahaan'	=> $this->input->post('idperusahaan'),
					'jenis_akun'	=> $noakun1[$i],
					'kode_barang' 	=> $kode_barang,
					'nama_barang'	=> $nama_barang,
					'tahun_perolehan'=> $pch_tgl[0],
					'nominal_asset'=> $harga[$i],
				];

				$a = $this->db->insert('tinventaris', $insert_inventaris);
			}
		}

		$data['status'] = 'success';
		$data['message'] = lang('update_success_message');
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
				$this->db->select('mnoakun.akunno, tanggaranbelanjadetail.jumlah, mnoakun.idakun');
				$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				$this->db->where('tanggaranbelanjadetail.id', $itemid[$i]);
				$data[$i] = $this->db->get('tanggaranbelanjadetail')->row_array();
			}
		} else {
			$this->db->select('mnoakun.akunno, tanggaranbelanjadetail.jumlah');
				$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
			$this->db->where('tanggaranbelanjadetail.id', $itemid[0]);
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
		$this->db->select('tpemesanandetail.*, mitem.nama as item, mnoakun.idakun, mnoakun.akunno, mnoakun.namaakun');
		$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id', 'left');
		$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id', 'left');
		$this->db->where('tpemesanandetail.idpemesanan', $idpemesanan);
		$data	= $this->db->get('tpemesanandetail')->result_array();
		for ($i=0; $i < count($data); $i++) { 
			$this->db->select('mpajak.nama_pajak, mnoakun.akunno, mnoakun.namaakun, pajakPembelian.nominal, pajakPembelian.pengurangan');
			$this->db->join('mpajak', 'pajakPembelian.idPajak = mpajak.id_pajak');
			$this->db->join('mnoakun', 'mpajak.akun = mnoakun.idakun');
			$data[$i]['pajak']	= $this->db->get_where('pajakPembelian', [
				'idPemesananDetail'	=> $data[$i]['id']
			])->result_array();
		}
		return $data;
	}

	public function get($id)
	{
		$this->db->select('tpemesanan.*, project.noEvent');
		$this->db->join('project', 'tpemesanan.project = project.idProject', 'left');
		$data			= $this->db->get_where('tpemesanan', [
			'id'	=> $id
		])->row_array();
		$data['detail']	= $this->db->get_where('tpemesanandetail', [
			'idpemesanan'	=> $id
		])->result_array();
		return $data;
	}
}

