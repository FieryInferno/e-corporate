<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kas_bank_model extends CI_Model {

	private $idkasbank;
	private $perusahaan;
	private $tanggal;
	private $idRekening;

	function get_kodeperusahaan($id){
        $query = $this->db->get_where('mperusahaan', array('idperusahaan' => $id));
        return $query;
    }

    public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tpengajuankaskecil');
			if($update) {
				$data['status'] = 'success'; 
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			$this->db->set('nomor_kas_bank',$this->input->post('nomor_kas_bank'));
			$this->db->set('perusahaan',$this->input->post('perusahaan'));
			$this->db->set('pejabat',$this->input->post('pejabat'));
			$this->db->set('tanggal',$this->input->post('tanggal'));
			$this->db->set('penerimaan', preg_replace("/(,00|[^0-9])/", "", $this->input->post('penerimaan')));
			$this->db->set('pengeluaran', preg_replace("/(,00|[^0-9])/", "", $this->input->post('pengeluaran')));
			$this->db->set('keterangan',$this->input->post('keterangan'));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert_kasbank = $this->db->insert('tkasbank');
			if($insert_kasbank)  {
				$nomor_kas_bank = $this->db->insert_id();
				$detail_array1 	= $this->input->post("detail_array");
				$detail_array 	= json_decode($detail_array1);
				$no				= 0;
				$noIdakun		= 0;
				foreach($detail_array as $row) {
					$this->db->set('idkasbank',$nomor_kas_bank);
					$this->db->set('idtipe',$row[0]);
					$this->db->set('tipe',$row[2]);
					$this->db->set('tanggal',$row[3]);
					$this->db->set('nokwitansi',$row[4]);
					$this->db->set('penerimaan',preg_replace("/(,00|[^0-9])/", "", $row[5]));
					$this->db->set('pengeluaran',preg_replace("/(,00|[^0-9])/", "", $row[6]));
					if ($row[2] == 'PB' || $row[2] == 'Pengajuan Kas Kecil' || $row[2] == 'Penjualan' || $row[2] == 'Saldo Awal Piutang' || $row[2] == 'Pembelian' || $row[2] == 'Budget Event') {
						$this->db->set('noakun',$this->input->post('idakun')[$noIdakun]);
						$noIdakun++;
					} else {
						$this->db->set('noakun',$row[7]);
					}
					$this->db->set('kodeunit',$row[8]);
					$this->db->set('departemen',$row[9]);
					$this->db->set('sumberdana', $this->input->post('idRekening')[$no]);
					$this->db->insert('tkasbankdetail');

					$id=$row[0];
					$tipe = $row[2];
					if ($tipe == 'Penjualan'){
						$this->db->set('stts_kas','1');
						$this->db->where('id', $id);
						$this->db->update('tfakturpenjualan');
						
					}else if ($tipe == 'Budget Event'){
						$this->db->set('status_kas','1');
						$this->db->where('id', $id);
						$this->db->update('tbudgetevent');
						
					}else if ($tipe == 'Pengajuan Kas Kecil'){
						$this->db->set('status','1');
						$this->db->set('uby',get_user('username'));
						$this->db->set('udate',date('Y-m-d H:i:s'));
						$this->db->where('id', $id);
						$this->db->update('tpengajuankaskecil');

						$this->db->set('nomor_kas_bank',$this->input->post('nomor_kas_bank'));
						$this->db->set('perusahaan',$this->input->post('perusahaan'));
						$this->db->set('pejabat',$this->input->post('pejabat'));
						$this->db->set('tanggal',$this->input->post('tanggal'));
						$this->db->set('keterangan',$this->input->post('keterangan'));
						$this->db->set('nominal',preg_replace("/(,00|[^0-9])/", "", $this->input->post('pengeluaran_pemindahbukuan')));
						$this->db->set('cby',get_user('username'));
						$this->db->set('cdate',date('Y-m-d H:i:s'));
						$this->db->insert('tpemindahbukuankaskecil');
						
					}else if ($tipe == 'Setor Kas Kecil'){
						$this->db->set('status','1');
						$this->db->set('uby',get_user('username'));
						$this->db->set('udate',date('Y-m-d H:i:s'));
						$this->db->where('id', $id);
						$this->db->update('tsetorkaskecil');
					}
					$no++;
				}

				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('save_error_message');
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

    public function index_datatable($tabel,$perusahaan,$pejabat) {
		$this->load->library('Datatables');
		$this->datatables->select('tsetorkaskecil.*,mperusahaan.nama_perusahaan, mdepartemen.nama');
		$this->datatables->join('mperusahaan','tsetorkaskecil.perusahaan=mperusahaan.idperusahaan');
		$this->datatables->join('mdepartemen','tsetorkaskecil.pejabat=mdepartemen.id');
		$this->db->where('tsetorkaskecil.tanggal >=',$tgl_awal);
		$this->db->where('tsetorkaskecil.tanggal <=',$tgl_akhir);
		$this->datatables->where('tsetorkaskecil.stdel', '0');
		$this->datatables->from('tsetorkaskecil');
		return print_r($this->datatables->generate());
	}

	public function delete() {
		$id	= $this->get('idKasBank');
		$kasBank	= $this->db->get_where('tkasbank', [
			'id'	=> $id
		])->row_array();
		$this->db->where('id', $id);
		$update = $this->db->delete('tkasbank');
		if($update) {
			$data0	= $this->db->get_where('tkasbankdetail', [
				'idkasbank'	=> $id
			])->result_array();
			foreach ($data0 as $key) {
				if ($key['tipe'] == 'Penjualan') {
					$this->db->where('id', $key['idtipe']);
					$this->db->update('tfakturpenjualan', [
						'stts_kas'	=> '0'
					]);
				}
				if ($key['tipe'] == 'Budget Event') {
					$this->db->where('id', $key['idtipe']);
					$this->db->update('tbudgetevent', [
						'status_kas'	=> '0'
					]);
				}
				if ($key['tipe'] == 'Pengajuan Kas Kecil') {
					$this->db->where('id', $key['idtipe']);
					$this->db->update('tpengajuankaskecil', [
						'status'	=> '0'
					]);
				}
			}
			$this->db->where('idkasbank', $id);
			$this->db->delete('tkasbankdetail');
			$this->db->where('nomor_kas_bank', $kasBank['nomor_kas_bank']);
			$this->db->delete('tpemindahbukuankaskecil');
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}

    public function kasbankdetail($idkasbank = null) {
		$this->db->select('tkasbankdetail.*');
		if ($idkasbank) {
			$this->db->where('tkasbankdetail.idkasbank', $idkasbank);
		}
		if ($this->idRekening) {
			$this->db->where('tkasbankdetail.sumberdana', $this->idRekening);
		}
		$get = $this->db->get('tkasbankdetail');
		return $get->result_array();
	}

	private function get($jenis)
	{
		return $this->$jenis;
	}

	public function getSaldoSumberDana()
	{
		if ($this->idRekening) {
			$data	= [
				'id'	=> $this->idRekening
			];
		} else {
			$data	= [
				'perusahaan'	=> $this->perusahaan
			];
		}
		$this->db->select('nama, id, akunno');
		$rekening	= $this->db->get_where('mrekening', $data)->result_array();
		$no	= 0;
		foreach ($rekening as $key) {
			$idRekening		= $key['id'];
			$pemetaanAkun	= $this->db->get_where('tPemetaanAkun', [
				'kodeAkun'	=> $key['akunno']
			])->row_array();
			$totalSaldo	= 0;
			if ($pemetaanAkun) {
				$saldoKodeAkun	= $this->db->get_where('tsaldoawaldetail', [
					'noakun'	=> $pemetaanAkun['kodeAkun']
				])->result_array();
				$saldoKodeAkun1	= $this->db->get_where('tsaldoawaldetail', [
					'noakun'	=> $pemetaanAkun['kodeAkun1']
				])->result_array();
				$saldoKodeAkun2	= $this->db->get_where('tsaldoawaldetail', [
					'noakun'	=> $pemetaanAkun['kodeAkun2']
				])->result_array();
				$saldoKodeAkun3	= $this->db->get_where('tsaldoawaldetail', [
					'noakun'	=> $pemetaanAkun['kodeAkun3']
				])->result_array();
				foreach ($saldoKodeAkun as $key) {
					$totalSaldo	+= $key['debet'];
				}
				foreach ($saldoKodeAkun1 as $key) {
					$totalSaldo	+= $key['debet'];
				}
				foreach ($saldoKodeAkun2 as $key) {
					$totalSaldo	+= $key['debet'];
				}
				foreach ($saldoKodeAkun3 as $key) {
					$totalSaldo	+= $key['debet'];
				}
			}
			if ($this->idRekening) {
				$data	= [
					'rekening'	=> $this->idRekening
				];
			} else {
				$data	= [
					'idperusahaan'	=> $this->perusahaan,
					'tanggal <='	=> $this->tanggal,
					'rekening'		=> $idRekening 
				];
			}
			$penerimaan	=	$this->db->get_where('tfakturpenjualan', $data)->result_array();
			if ($penerimaan) {
				foreach ($penerimaan as $terima) {
					$totalSaldo	+= $terima['total'];
				}
			}
			if ($this->idRekening) {
				$data	= [
					'bank'	=> $this->idRekening
				];
			} else {
				$data	= [
					'perusahaanid'	=> $this->perusahaan,
					'tanggal <='	=> $this->tanggal,
					'bank'		=> $idRekening 
				];
			}
			$pengeluaran	= $this->db->get_where('tfaktur', $data)->result_array();
			if ($pengeluaran) {
				foreach ($pengeluaran as $keluar) {
					$totalSaldo	-= $keluar['total'];
				}
			}
			$rekening[$no]['totalSaldo']	= $totalSaldo;
			$no++;
		}
		return $rekening;
	}

	public function sisaKasBank()
	{
		$data			= $this->getSaldoSumberDana();
		$kasBank		= $this->kasbankdetail();
		$sisaKasBank	= $data[0]['totalSaldo'];
		foreach ($kasBank as $key) {
			$sisaKasBank	+= (integer) $key['penerimaan'];
			$sisaKasBank	-= (integer) $key['pengeluaran'];
		}
		return $sisaKasBank;
	}
}

