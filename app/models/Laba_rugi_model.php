<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laba_rugi_model extends CI_Model {

	private $perusahaan;
	private $tanggalawal;
	private $tanggalakhir;
	private $jurnalUmum;

	public function __construct() {
		parent::__construct();
		$this->load->model('Jurnal_model','model');
		$this->Jurnal_model->set('perusahaan', $this->perusahaan);
		// $this->Jurnal_model->set('tglMulai', $this->tanggalawal);
		// $this->Jurnal_model->set('tglAkhir', $this->tanggalakhir);
		$this->jurnalUmum	= $this->Jurnal_model->get();
	}

	public function get($noAkun, $noAkun1) {
		$data	= [];
		for ($i=0; $i < count($this->jurnalUmum); $i++) { 
			$key	= $this->jurnalUmum[$i];
			$total;
			if ($key['akunno'] !== '') {
				if (substr($key['akunno'], 0, 1) == $noAkun || substr($key['akunno'], 0, 1) == $noAkun1) {
					if (count($data) == 0) {
						$total	= 0;
						switch ($key['jenis']) {
							case 'debit':
								$total	+= $key['total'];
								break;
							case 'kredit':
								$total	-= $key['total'];
								break;
							
							default:
								# code...
								break;
						}
						array_push($data, [
							'akunno'	=> $key['akunno'],
							'namaakun'	=> $key['namaakun'],
							'saldo'		=> $total
						]);
						$temp	= $key['akunno'] . $key['namaakun'];
						$noTemp	= 0;
					} else {
						if (($key['akunno'] . $key['namaakun']) == $temp) {
							switch ($key['jenis']) {
								case 'debit':
									$data[$noTemp]['saldo']	+= $key['total'];
									break;
								case 'kredit':
									$data[$noTemp]['saldo']	-= $key['total'];
									break;
								
								default:
									# code...
									break;
							}
						} else {
							array_push($data, [
								'akunno'	=> $key['akunno'],
								'namaakun'	=> $key['namaakun'],
								'saldo'		=> $key['total']
							]);
							$temp	= $key['akunno'] . $key['namaakun'];
							$noTemp++;
							$total	= 0;
						}
					}
				}
			}
		}
		return $data;
	}

	public function get_hpp($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->like('noakun', '5114', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_operasional($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->like('noakun', '5113', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_pendapatan_lainnya($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakuntop', '4');
		$this->db->not_like('noakun', '41', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function get_biaya_lainnya($tanggalawal, $tanggalakhir) {
		$this->db->select("
			*,
			CASE WHEN stdebet = '1' THEN
				SUM(debet)-SUM(kredit)
			ELSE
				SUM(kredit)-SUM(debet)
			END AS saldo
		");
		$this->db->where('tanggal >=', $tanggalawal);
		$this->db->where('tanggal <=', $tanggalakhir);
		$this->db->where('noakuntop', '5');
		// $this->db->where('noakun !=', '5114');
		// $this->db->where('noakun !=', '5113');
		$this->db->not_like('noakun', '51', 'after');
		$this->db->group_by('noakun');
		$get = $this->db->get('viewjurnaldetail');
		return $get->result_array();
	}

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tjurnal');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tjurnal');
			if($insert) {
				$data['status'] = 'success';
				$data['message'] = lang('save_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('save_error_message');
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$id = $this->uri->segment(3);
		$this->db->set('stdel','1');
		$this->db->where('id', $id);
		$update = $this->db->update('tjurnal');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
	}
}

