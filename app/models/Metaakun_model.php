<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Metaakun_model extends CI_Model {

	public function save() {
		$pemetaanAkun	= [
			'kodeAkun'	=> $this->input->post('kode_akun'),
			'kodeAkun1'	=> $this->input->post('kode_akun_1'),
			'kodeAkun2'	=> $this->input->post('kode_akun_2'),
			'kodeAkun3'	=> $this->input->post('kode_akun_3'),
		];
		if ($this->input->post('idPemetaanAkun') !== null) {
			$this->db->where('idPemetaanAkun', $this->input->post('idPemetaanAkun'));
			$this->db->update('tPemetaanAkun', $pemetaanAkun);
			$data['status'] = 'success';
			$data['message'] = 'Berhasil Mengupdate Pemetaan Akun';
		} else {
			$this->db->insert('tPemetaanAkun', $pemetaanAkun);
			$data['status'] = 'success';
			$data['message'] = 'Berhasil Menambah Pemetaan Akun';
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function hapus($idPemetaanAkun)
	{
		$this->db->where('idPemetaanAkun', $idPemetaanAkun);
		$this->db->delete('tPemetaanAkun');
	}

}