<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran_pendapatan_model extends CI_Model
{

	public function save()
	{
		$id = $this->uri->segment(3);
		$nominal				= 0;
		for ($i=0; $i < count($this->input->post('jumlah')); $i++) { 
			$nominal	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jumlah')[$i]);
		}
		if ($id) {
			$this->db->where('id', $id);
			$update	= $this->db->update('tanggaranpendapatan', [
				'idPerusahaan'	=> $this->input->post('idperusahaan'),
				'dept'			=> $this->input->post('dept'),
				'pejabat'		=> $this->input->post('pejabat'),
				'thnanggaran'	=> $this->input->post('thnanggaran'),
				'tglpengajuan'	=> $this->input->post('tglpengajuan'),
				'nominal'		=> $nominal,
				'status'		=> 0
			]);
			if ($update) {
				$this->db->where('idPendapatan', $id);
				$this->db->delete('tanggaranpendapatandetail');
				for ($i=0; $i < count($this->input->post('kode_rekening')); $i++) { 
					$this->db->insert('tanggaranpendapatandetail', [
						'id'			=> rand(100, 999999999),
						'idPendapatan'	=> $id,
						'koderekening'	=> $this->input->post('kode_rekening')[$i],
						'uraian'		=> $this->input->post('uraian')[$i],
						'cabang'		=> $this->input->post('cabang')[$i],
						'volume'		=> $this->input->post('volume')[$i],
						'satuan'		=> $this->input->post('satuan')[$i],
						'tarif'			=> (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga')[$i]),
						'jumlah'		=> (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jumlah')[$i]),
						'keterangan'	=> '',
						'status'		=> 0
					]);
				}
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		// 	print_r($nominal);
		// die();
		} else {
			$idAnggaranPendapatan	= rand(100, 999999999);
			$insert = $this->db->insert('tanggaranpendapatan', [
				'id'			=> $idAnggaranPendapatan,
				'idPerusahaan'	=> $this->input->post('idperusahaan'),
				'dept'			=> $this->input->post('dept'),
				'pejabat'		=> $this->input->post('pejabat'),
				'thnanggaran'	=> $this->input->post('thnanggaran'),
				'tglpengajuan'	=> $this->input->post('tglpengajuan'),
				'nominal'		=> $nominal,
				'status'		=> 0
			]);
			if ($insert) {
				for ($i=0; $i < count($this->input->post('kode_rekening')); $i++) { 
					$this->db->insert('tanggaranpendapatandetail', [
						'id'			=> rand(100, 999999999),
						'idPendapatan'	=> $idAnggaranPendapatan,
						'koderekening'	=> $this->input->post('kode_rekening')[$i],
						'uraian'		=> $this->input->post('uraian')[$i],
						'cabang'		=> $this->input->post('cabang')[$i],
						'volume'		=> $this->input->post('volume')[$i],
						'satuan'		=> $this->input->post('satuan')[$i],
						'tarif'			=> (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('harga')[$i]),
						'jumlah'		=> (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jumlah')[$i]),
						'keterangan'	=> '',
						'status'		=> 0
					]);
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

	public function delete()
	{
		$id = $this->uri->segment(3);
        $this->db->where('id', $id);
        $update = $this->db->delete('tanggaranpendapatan');
        if ($update) {
            return jsonOutputDeleteSuccess();
        } else {
            return jsonOutputDeleteError();
		}		
	
	}
	public function hitungJumlahNominal()
	{
		$this->db->select_sum('nominal');
		$query = $this->db->get('tanggaranpendapatan');
		if($query->num_rows()>0)
		{
			return $query->row()->nominal;
		}
		else
		{
			return 0;
		}
	}
}
