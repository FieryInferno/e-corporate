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


class Faktur_pembelian_model extends CI_Model {

	public function save() {
		$total		        = 0;
		$pajak              = 0;
		$biayapengiriman    = 0; 
		$idfaktur	        = uniqid('FAKTUR');
		foreach ($this->input->post('total') as $key) {
			$total	+= (integer) $key;
		}
		foreach ($this->input->post('pajak') as $key) {
			$pajak	+= (integer) $key;
		}
		foreach ($this->input->post('biaya_pengiriman') as $key) {
			$biayapengiriman	+= (integer) $key;
		}
		$this->db->like('notrans', '#INV' . strtoupper(date('dM')), 'after');
        $this->db->order_by('nomor', 'DESC');
        $data   = $this->db->get('tfaktur')->row_array();
		if ($data !== null) {
			$n	= (int) substr($data['notrans'], 7) + 1;
		} else {
			$n 	= '';
		}
		$id		= '#INV';
		switch (strlen($n)) {
			case 0:
				$no	= '0001';
				break;
			case 1:
				$no	= '000' . $n;
				break;
			case 2:
				$no	= '00' . $n;
				break;
			case 3:
				$no	= '0' . $n;
				break;
			case 4:
				$no	= $n;
				break;
			
			default:
				# code...
				break;
		}
		$notrans	= $id . strtoupper(date('dM')) . $no;
		$insert	= $this->db->insert('tfaktur', [
			'id'			    => $idfaktur,
			'notrans'           => $notrans,
			'tanggal'		    => $this->input->post('tanggal'),
			'kontakid'		    => $this->input->post('kontakid'),
			'perusahaanid'	    => $this->input->post('perusahaanid'),
			'total'			    => $total,
			'bank'			    => $this->input->post('rekening'),
			'ppn'				=> $pajak,
			'biayaPengiriman'	=> $biayapengiriman,
			'setupJurnal'		=> $this->input->post('setupJurnal')
		]);
		if($insert) {
			$i  = 0;
			foreach ($this->input->post('idbarang') as $key) {
				$this->db->insert('tfakturdetail', [
					'idfaktur'		=> $idfaktur,
					'itemid'		=> $key,
					'idpengiriman'	=> $this->input->post('idpengiriman')[$i]
				]);
				$i++;
			}
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
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

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesanandetail.*, mitem.nama as item');
		$this->db->join('mitem', 'tpemesanandetail.itemid = mitem.id', 'left');
		$this->db->where('tpemesanandetail.idpemesanan', $idpemesanan);
		$this->db->where('tpemesanandetail.status !=', '3');
		$get = $this->db->get('tpemesanandetail');
		return $get->result_array();
	}

	public function pengirimandetail($idpengiriman) {
		$this->db->select('
			tpengirimandetail.*, mitem.nama as item
		');
		$this->db->join('mitem', 'tpengirimandetail.itemid = mitem.id', 'left');
		$this->db->join('tpengiriman', 'tpengirimandetail.idpengiriman = tpengiriman.id');
		$this->db->where('tpengirimandetail.idpengiriman', $idpengiriman);
		$get = $this->db->get('tpengirimandetail');
		return $get->result_array();
	}

	public function getpemesanan($idpemesanan) {
		$this->db->select('tpemesanan.kontakid, tpemesanan.gudangid');
		$this->db->where('id', $idpemesanan);
		$get = $this->db->get('tpemesanan');
		return $get->row_array();
	}

	public function getfaktur($id = null) {
		$this->db->select('mkontak.nama as kontak, mkontak.alamat, mkontak.telepon, tpengiriman.notrans as nosj, tpemesanan.subtotal, tpemesanan.diskon, tfaktur.*, tpemesanan.ppn, tpemesanan.biayapengiriman, mrekening.nama as bank, tpemesanan.id as idPemesanan');
		$this->db->where('tfaktur.id', $id);
		$this->db->join('mkontak', 'tfaktur.kontakid = mkontak.id','left');
		$this->db->join('tPenerimaan', 'tfaktur.pengirimanid = tPenerimaan.idPenerimaan', 'left');
		$this->db->join('tpemesanan', 'tPenerimaan.pemesanan = tpemesanan.id', 'left');
		$this->db->join('mrekening', 'tfaktur.bank = mrekening.id', 'left');
		$get = $this->db->get('tfaktur', 1);
		return $get->row_array();
	}

	public function fakturdetail($idfaktur) {
		$this->db->select('tfakturdetail.*, mitem.nama as item, tpemesanandetail.harga, tpemesanandetail.jumlah, tpemesanandetail.subtotal, tpemesanandetail.diskon, tpemesanandetail.ppn, tpemesanandetail.total, tpemesanandetail.biayapengiriman, tpemesanandetail.akunno');
		$this->db->where('tfakturdetail.idfaktur', $idfaktur);
		$this->db->join('tpemesanandetail', 'tfakturdetail.itemid = tpemesanandetail.id', 'left');
		$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id', 'left');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id', 'left');
		$get = $this->db->get('tfakturdetail');
		return $get->result_array();
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
			$data = $this->db->get('mitem', 1)->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function getjumlahsisa($idfaktur) {
		$this->db->select_sum('jumlahsisa','sisa');
		$this->db->where('idfaktur', $idfaktur);
		$get = $this->db->get('tfakturdetail');
		return $get->row()->sisa;
	}

	public function get($id = null)
	{
		$this->db->select('tfaktur.id, tfaktur.notrans,  mperusahaan.nama_perusahaan as namaperusahaan,  tfaktur.tanggal, mkontak.nama as rekanan, mgudang.nama as gudang, mkontak.nama as supplier, tfaktur.biayapengiriman as biaya_pengiriman, tfaktur.total as total, tfaktur.status as status, tfaktur.ppn as pajak, tfaktur.biayapengiriman, mperusahaan.alamat');
		$this->db->join('mkontak','tfaktur.kontakid = mkontak.id','left');
		$this->db->join('mgudang','tfaktur.gudangid = mgudang.id','left');
		$this->db->join('mperusahaan','tfaktur.perusahaanid = mperusahaan.idperusahaan','left');
		if ($id) {
			$this->db->where('tfaktur.id', $id);
			$data	= $this->db->get('tfaktur')->row_array();
			$this->db->where('idfaktur', $data['id']);
			$this->db->join('tpemesanandetail', 'tfakturdetail.itemid = tpemesanandetail.id');
			$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
			$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
			$this->db->join('tpemesanan', 'tpemesanandetail.idpemesanan = tpemesanan.id'); 
			$this->db->select('mnoakun.namaakun, tpemesanandetail.total, tpemesanan.catatan, tpemesanan.departemen, tpemesanandetail.subtotal, tpemesanandetail.diskon, mnoakun.akunno');
			$data['detail']	= $this->db->get('tfakturdetail')->result_array();
		} else {
			$data	= $this->db->get('tfaktur')->result_array();
			for ($i=0; $i < count($data); $i++) { 
				$this->db->where('idfaktur', $data[$i]['id']);
				$this->db->join('tpemesanandetail', 'tfakturdetail.itemid = tpemesanandetail.id');
				$this->db->join('tanggaranbelanjadetail', 'tpemesanandetail.itemid = tanggaranbelanjadetail.id');
				$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
				$this->db->join('tpemesanan', 'tpemesanandetail.idpemesanan = tpemesanan.id'); 
				$this->db->select('mnoakun.namaakun, tpemesanandetail.total, tpemesanan.catatan, tpemesanan.departemen, tpemesanandetail.subtotal, tpemesanandetail.diskon, mnoakun.akunno, mnoakun.idakun');
				$data[$i]['detail']	= $this->db->get('tfakturdetail')->result_array();
			}
		}
		return $data;
	}
}

