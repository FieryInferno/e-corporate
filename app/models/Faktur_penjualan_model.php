<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faktur_penjualan_model extends CI_Model {

	private	$id;
	private $status;
	private $perusahaan;
	private $tanggalAwal;
	private $tanggalAkhir;
	private $kontak;

	public function save() {
		$notrans = $this->input->post('notrans', TRUE);
		$ceknotrans = get_by_id('notrans',$notrans,'tfakturpenjualan');
		if($ceknotrans) {
			$data['status'] = 'error';
			$data['message'] = 'Kode sudah ada';
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}

		$statusauto = $this->input->post('statusauto', TRUE);
		if($statusauto == '0') {
			$this->db->set('notrans',$this->input->post('notrans', TRUE));
			$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('tanggaltempo',$this->input->post('tanggalJT', TRUE));
			$this->db->set('rekening',$this->input->post('rekening', TRUE));
			$this->db->set('pengirimanid',$this->input->post('pengirimanid', TRUE));
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('cara_pembayaran',$this->input->post('cara_pembayaran', TRUE));
			$this->db->set('tipe','2');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$this->db->set('setupJurnal', $this->input->post('setupJurnal'));
			$this->db->set('cabang', $this->input->post('cabang'));
			$insertHead = $this->db->insert('tfakturpenjualan');
			if($insertHead) {
				$this->db->set('validasi','2');
				$this->db->where('id',$this->input->post('pengirimanid',TRUE));
				$this->db->update('tpengirimanpenjualan');
				$data['status'] = 'success';
				$data['message'] = "Data berhasil disimpan.";
			}else{
				$data['status'] = 'error';
				$data['message'] = "Data gagal disimpan.";
			}	
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}


	public function update() {
		$id = $this->input->post('fakturid');
		$faktur = get_by_id('id',$id,'tfakturpenjualan');
		$this->db->set('validasi','1');
		$this->db->where('id',$faktur['pengirimanid']);
		$this->db->update('tpengirimanpenjualan');

		$this->db->where('idfaktur', $id);
		$this->db->delete('tfakturpenjualandetail');

		$this->db->where('id', $id);
		$delete = $this->db->delete('tfakturpenjualan');

		$statusauto = $this->input->post('statusauto', TRUE);
		if($statusauto == '0') {
			$this->db->set('notrans',$this->input->post('notrans', TRUE));
			$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
			$this->db->set('tanggal',$this->input->post('tanggal', TRUE));
			$this->db->set('tanggaltempo',$this->input->post('tanggalJT', TRUE));
			$this->db->set('rekening',$this->input->post('rekening', TRUE));
			$this->db->set('pengirimanid',$this->input->post('pengirimanid', TRUE));
			$this->db->set('catatan',$this->input->post('catatan', TRUE));
			$this->db->set('carabayar',$this->input->post('carabayar', TRUE));
			$this->db->set('tipe','2');
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insertHead = $this->db->insert('tfakturpenjualan');
			if($insertHead) {
				$this->db->set('validasi','2');
				$this->db->where('id',$this->input->post('pengirimanid',TRUE));
				$this->db->update('tpengirimanpenjualan');
				$data['status'] = 'success';
				$data['message'] = "Data berhasil diupdate.";
			}else{
				$data['status'] = 'error';
				$data['message'] = "Data gagal diupdate.";
			}	
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
			$row = $this->db->get('tpemesananpenjualandetail', 1)->row_array();
			$data['jumlahsisa'] = $row['jumlahsisa'];
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesananpenjualandetail.*, mitem.nama as item');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id', 'left');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $idpemesanan);
		$this->db->where('tpemesananpenjualandetail.status !=', '3');
		$get = $this->db->get('tpemesananpenjualandetail');
		return $get->result_array();
	}

	public function pengirimandetail($idpengiriman) {
		$this->db->select('
			tpengirimanpenjualandetail.*, mitem.nama as item
		');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('tpengirimanpenjualan', 'tpengirimanpenjualandetail.idpengiriman = tpengirimanpenjualan.id');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $idpengiriman);
		$get = $this->db->get('tpengirimanpenjualandetail');
		return $get->result_array();
	}

	public function getpemesanan($idpemesanan) {
		$this->db->select('tpemesananpenjualan.kontakid, tpemesananpenjualan.gudangid');
		$this->db->where('id', $idpemesanan);
		$get = $this->db->get('tpemesananpenjualan');
		return $get->row_array();
	}

	public function getfaktur($id = null, $validasi = null) {
		$this->db->select('tfakturpenjualan.*, mkontak.nama as kontak, mkontak.alamat, mkontak.telepon, tpengirimanpenjualan.notrans as nosj, tpemesananpenjualan.jenis_pembelian, tfakturpenjualan.setupJurnal, mperusahaan.nama_perusahaan as namaperusahaan');
		$this->db->join('mkontak', 'tfakturpenjualan.kontakid = mkontak.id','left');
		$this->db->join('tpengirimanpenjualan', 'tfakturpenjualan.pengirimanid = tpengirimanpenjualan.id','left');
		$this->db->join('tpemesananpenjualan', 'tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id','left');
		$this->db->join('mperusahaan', 'tfakturpenjualan.idperusahaan = mperusahaan.idperusahaan','left');
		if ($this->session->userid !== '1') {
			$this->db->where('tfakturpenjualan.idperusahaan', $this->session->idperusahaan);
		}
		switch ($validasi) {
			case '1':
				$this->db->where('tpengirimanpenjualan.validasi', 1);
				break;
			case '2':
				$this->db->where('tpengirimanpenjualan.validasi', 2);
				break;
			
			default:
				# code...
				break;
		}
		if ($id) {
			$this->db->where('tfakturpenjualan.id', $id);
			return $this->db->get('tfakturpenjualan')->row_array();
		} else {
			return $this->db->get('tfakturpenjualan')->result_array();
		}
	}

	public function fakturdetail($idfaktur, $jenisPembelian) {
		$this->db->where('tfakturpenjualandetail.idfaktur', $idfaktur);
		switch ($jenisPembelian) {
			case 'jasa':
				$this->db->select('tfakturpenjualandetail.*, concat(mnoakun.akunno, "/", mnoakun.namaakun) as item, mnoakun.akunno, mnoakun.idakun, mnoakun.namaakun, tfakturpenjualan.id as idFaktur');
				$this->db->join('mnoakun', 'tfakturpenjualandetail.itemid = mnoakun.idakun', 'left');
				$this->db->join('tfakturpenjualan', 'tfakturpenjualandetail.idfaktur = tfakturpenjualan.id');
				break;
			case 'barang':
				$this->db->select('tfakturpenjualandetail.*, mitem.nama as item, mnoakun.akunno, mnoakun.idakun, mnoakun.namaakun, tfakturpenjualan.id as idFaktur');
				$this->db->join('mitem', 'tfakturpenjualandetail.itemid = mitem.id', 'left');
				$this->db->join('mnoakun', 'mitem.noakunjual = mnoakun.idakun', 'left');
				$this->db->join('tfakturpenjualan', 'tfakturpenjualandetail.idfaktur = tfakturpenjualan.id');
				break;
			
			default:
				# code...
				break;
		}
		$data = $this->db->get('tfakturpenjualandetail')->result_array();
		for ($i=0; $i < count($data); $i++) {
			$this->db->select('mpajak.nama_pajak, mnoakun.akunno, mnoakun.namaakun, pajakPemesananPenjualan.nominal, pajakPemesananPenjualan.pengurangan');
			$this->db->join('mpajak', 'pajakPemesananPenjualan.idPajak = mpajak.id_pajak');
			$this->db->join('mnoakun', 'mpajak.akun = mnoakun.idakun');
			$this->db->join('tpengirimanpenjualandetail', 'tpengirimanpenjualandetail.idpenjualdetail = pajakPemesananPenjualan.idDetailPemesananPenjualan');
			$this->db->join('tfakturpenjualan', 'tfakturpenjualan.pengirimanid = tpengirimanpenjualandetail.idpengiriman');
			$data[$i]['pajak']	= $this->db->get_where('pajakPemesananPenjualan', [
				'tfakturpenjualan.id'	=> $data[$i]['idFaktur']
			])->result_array();
		}
		return $data;
	}

	public function detailitem() {
		$itemid = $this->input->post('itemid', TRUE);
		if($itemid) {
			$this->db->where('id', $itemid);
			$get = $this->db->get('mitem',1);
			$data = $get->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_detail_item() {
		$itemid = $this->input->post('itemid', TRUE);
		if($itemid) {
			$this->db->where('id', $itemid);
			$this->db->where('stdel', '0');
			$data = $this->db->get('mitem', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
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

	public function getjumlahsisa($idfaktur) {
		$this->db->select_sum('jumlahsisa','sisa');
		$this->db->where('idfaktur', $idfaktur);
		$get = $this->db->get('tfakturpenjualandetail');
		return $get->row()->sisa;
	}

	function get_data_pengiriman_model($idpengiriman){
		$this->db->select('tpengirimanpenjualan.*,  tpemesananpenjualan.id as pemesananid, tpemesananpenjualan.tanggal as tgl_pemesanan, tpemesananpenjualan.cara_pembayaran as carabayar, tpemesananpenjualan.cabang');
		$this->db->join('tpemesananpenjualan','tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id', 'LEFT');
		$this->db->where('tpengirimanpenjualan.id', $idpengiriman);
		$query = $this->db->get('tpengirimanpenjualan');
        return $query;
    }

    function get_detail_angsuran($id){
        $query = $this->db->get_where('tpemesananpenjualanangsuran', array('idpemesanan' => $id));
        return $query;
    }

    function get_detail_pengiriman($pengirimanid){
        $this->db->select('tpengirimanpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as jasa,  CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as inventeris, tpemesananpenjualan.cara_pembayaran, tpemesananpenjualandetail.id as idDetailPemesananPenjualan, tpemesananpenjualan.cabang, tpengirimanpenjualan.tanggal as tanggalPengiriman');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpengirimanpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->join('tpemesananpenjualandetail', 'tpengirimanpenjualandetail.idpenjualdetail = tpemesananpenjualandetail.id', 'left');
		$this->db->join('tpemesananpenjualan', 'tpemesananpenjualandetail.idpemesanan = tpemesananpenjualan.id', 'left');
		$this->db->join('tpengirimanpenjualan', 'tpemesananpenjualandetail.idpemesanan = tpengirimanpenjualan.pemesananid', 'left');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $pengirimanid);
		$data	= $this->db->get('tpengirimanpenjualandetail')->result();
		for ($i=0; $i < count($data); $i++) { 
			$this->db->select('mpajak.nama_pajak, mnoakun.akunno, mnoakun.namaakun, pajakPemesananPenjualan.nominal, pajakPemesananPenjualan.pengurangan');
			$this->db->join('mpajak', 'pajakPemesananPenjualan.idPajak = mpajak.id_pajak');
			$this->db->join('mnoakun', 'mpajak.akun = mnoakun.idakun');
			$data[$i]->pajak	= $this->db->get_where('pajakPemesananPenjualan', [
				'idDetailPemesananPenjualan'	=> $data[$i]->idDetailPemesananPenjualan
			])->result_array();
		}
		return $data;
    }

    function get_detail_budgetevent($pemesananid){
        $this->db->select('tbudgetevent.*, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as budgetevent');
		$this->db->join('mnoakun', 'tbudgetevent.idbudgetevent = mnoakun.idakun', 'left');
		$this->db->where('tbudgetevent.idpemesanan', $pemesananid);
		$query = $this->db->get('tbudgetevent');
		return $query;
    }

    public function delete() {
		$id = $this->uri->segment(3);
		$faktur = get_by_id('id',$id,'tfakturpenjualan');

		$this->db->where('id', $id);
		$delete = $this->db->delete('tfakturpenjualan');
		if($delete) {
			$this->db->where('idfaktur', $id);
			$this->db->delete('tfakturpenjualandetail');

			$this->db->set('validasi','1');
			$this->db->where('id', $faktur['pengirimanid']);
			$this->db->update('tpengirimanpenjualan');

			$data['status'] = 'success';
			$data['message'] = 'Berhasil menghapus data';
		} else {
			$data['status'] = 'error';
			$data['message'] = 'Gagal menghapus data';
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
	}

	public function validasi()
	{
		switch ($this->status) {
			case '1':
				$status	= 3;
				$this->db->select('noSSP');
				$this->db->order_by('noSSP', 'DESC');
				$noSSP	= $this->db->get_where('tfakturpenjualan', [
					'status'	=> '3'
				])->row_array();
				if ($noSSP == null) {
					$noSSPBaru	= '00001/SSP/2020';
				} else {
					$no		= (integer) substr($noSSP['noSSP'], 0, 5);
					$noBaru	= $no + 1;
					switch (strlen($noBaru)) {
						case 1:
							$noBaru	= '0000' . $noBaru;
							break;
						case 2:
							$noBaru	= '000' . $noBaru;
							break;
						case 3:
							$noBaru	= '00' . $noBaru;
							break;
						case 4:
							$noBaru	= '0' . $noBaru;
							break;
						case 5:
							$noBaru	= $noBaru;
							break;
						
						default:
							# code...
							break;
					}
					$noSSPBaru	= $noBaru . '/SSP/2020';
				}
				break;
			case '3':
				$status		= 1;
				$noSSPBaru	= NULL;
			
			default:
				# code...
				break;
		}
		$this->db->where('id', $this->setGet('id'));
		$validasi	= $this->db->update('tfakturpenjualan', [
			'status'	=> $status,
			'noSSP'		=> $noSSPBaru
		]);
		return $validasi;
	}

	public function piutang()
	{
		$this->db->select('tfakturpenjualan.tanggal, tfakturpenjualan.tanggaltempo as tanggalTempo, tfakturpenjualan.nomorsuratjalan as noInvoice, tfakturpenjualan.catatan as deskripsi, mkontak.nama as namaPelanggan, tfakturpenjualan.sisatagihan as primeOwing, mperusahaan.nama_perusahaan');
		$this->db->join('mkontak', 'tfakturpenjualan.kontakid = mkontak.id');
		$this->db->join('mperusahaan', 'tfakturpenjualan.idperusahaan = mperusahaan.idperusahaan');
		$this->db->where('tfakturpenjualan.sisatagihan >', 0);
		$this->db->where('tfakturpenjualan.cara_pembayaran', 'credit');
		if ($this->perusahaan) {
			$this->db->where('tfakturpenjualan.idperusahaan', $this->perusahaan);
		}
		if ($this->kontak) {
			$this->db->like('mkontak.nama', $this->kontak);
		}
		if ($this->tanggalAwal) {
			$this->db->where('tfakturpenjualan.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
		}
		return $this->db->get('tfakturpenjualan')->result_array();
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}
}

