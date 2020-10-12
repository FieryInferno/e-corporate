<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pajak_model extends CI_Model
{
	public function save($id_pajak = null)
	{
		if ($id_pajak !== null) {
			$this->db->where('id_pajak', $id_pajak);
			$this->db->update('mpajak', [
				'kode_pajak'    => $this->input->post('kode_pajak'),
				'nama_pajak'    => $this->input->post('nama_pajak'),
				'akun'          => $this->input->post('noakun'),
				'persen'        => $this->input->post('persen')
			]);
		} else {
			$this->db->insert('mpajak', [
				'id_pajak'      => uniqid('PJK'),
				'kode_pajak'    => $this->input->post('kode_pajak'),
				'nama_pajak'    => $this->input->post('nama_pajak'),
				'akun'          => $this->input->post('noakun'),
				'persen'        => $this->input->post('persen')
			]);
		}
        $data['status'] = 'success';
        $data['message'] = lang('save_success_message');
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get($id_pajak = null)
	{
		$this->db->join('mnoakun', 'mpajak.akun = mnoakun.idakun');
		if ($id_pajak) {
			return $this->db->get_where('mpajak', [
				'id_pajak'	=> $id_pajak
			])->row_array();	
		} else {
			return $this->db->get('mpajak')->result_array();
		}
		
		
	}

	public function delete($id_pajak = null)
	{
		$this->db->where('id_pajak', $id_pajak);
		$this->db->delete('mpajak');
        $data['status'] = 'success';
        $data['message'] = lang('save_success_message');
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_pajak()
	{
		$this->db->select('mpajak.id_pajak as id, concat("(",mpajak.kode_pajak,") - ",mpajak.nama_pajak) as text');
		return $this->db->get('mpajak')->result_array();
	}
}
