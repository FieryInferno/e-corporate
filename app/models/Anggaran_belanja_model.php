<?php
defined('BASEPATH') or exit('No direct script access allowed');

/** 
 * =================================================
 * @package	CGC (CODEIGNITER GENERATE CRUD)
 * @author	isyanto.id@gmail.com
 * @link	https://isyanto.com
 * @since	Version 1.0.0
 * @filesource
 * ================================================= 
 */


class Anggaran_belanja_model extends CI_Model
{

	public function save()
	{
		$id = $this->uri->segment(3);
		if ($id) {
			foreach ($this->input->post() as $key => $val) $this->db->set($key, $val);
			$this->db->set('uby', get_user('username'));
			$this->db->set('udate', date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tanggaranbelanja');
			if ($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			$id_anggaran	= uniqid('AB');
			$nominal		= 0;
			for ($i=0; $i < count($this->input->post('jumlah')); $i++) { 
				$nominal	+= $this->input->post('jumlah')[$i];
			}
			$data_anggaran	= [
				'id'			=> $id_anggaran,
				'idperusahaan'	=> $this->input->post('idperusahaan'),
				'dept'			=> $this->input->post('dept'),
				'pejabat'		=> $this->input->post('pejabat'),
				'thnanggaran'	=> $this->input->post('thnanggaran'),
				'tglpengajuan'	=> $this->input->post('tglpengajuan'),
				'nominal'		=> $nominal,
				'cby'			=> get_user('username'),
				'cdate'			=> date('Y-m-d H:i:s')
			];
			$insert	= $this->db->insert('tanggaranbelanja', $data_anggaran);
			if ($insert) {
				for ($i=0; $i < count($this->input->post('kode_rekening')); $i++) { 
					$this->db->insert('tanggaranbelanjadetail', [
						'id'			=> uniqid('ABD'),
						'idanggaran'	=> $id_anggaran,
						'koderekening'	=> $this->input->post('kode_rekening')[$i],
						'uraian'		=> $this->input->post('uraian')[$i],
						'volume'		=> $this->input->post('volume')[$i],
						'satuan'		=> $this->input->post('satuan')[$i],
						'tarif'			=> $this->input->post('tarif')[$i],
						'jumlah'		=> $this->input->post('jumlah')[$i],
						'keterangan'	=> $this->input->post('keterangan')[$i]
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
		$this->db->set('stdel', '1');
		$this->db->where('id', $id);
		$update = $this->db->update('tanggaranbelanja');
		if ($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function hitungJumlahNominal()
	{
		$this->db->select_sum('nominal');
		$this->db->where('stdel','0');
		$query = $this->db->get('tanggaranbelanja');
		if($query->num_rows()>0)
		{
			return $query->row()->nominal;
		}
		else
		{
			return 0;
		}
	}

	function uraianAll()
    {
        $query = $this->db->query('SELECT id, nama FROM mitem where stdel=0');
        return $query->result();
    }
	function satuanAll()
    {
        $query = $this->db->query('SELECT id, nama FROM msatuan where stdel=0');
        return $query->result();
	}
	
	public function get_by_id($id)
	{
		$this->db->select('tanggaranbelanjadetail.koderekening, mnoakun.namaakun, mitem.nama as namabarang, tanggaranbelanjadetail.jumlah as total, tanggaranbelanjadetail.volume, tanggaranbelanjadetail.tarif, tanggaranbelanjadetail.satuan');
		$this->db->join('tanggaranbelanjadetail', 'tanggaranbelanja.id = tanggaranbelanjadetail.idanggaran');
		$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.akunno');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
		$data	= $this->db->get('tanggaranbelanja')->result_array();
		$no		= 0;
		for ($i=0; $i < count($data); $i++) {
			$data[$i]['totalsemua']	= 0;
			if ($i == 0 || ($data[$i]['koderekening'] !== $data[$no]['koderekening'])) {
				for ($j=0; $j < count($data); $j++) { 
					if ($data[$j]['koderekening'] == $data[$i]['koderekening']) {
						$data[$i]['totalsemua']	+= $data[$j]['total'];
					}
				}
				$no = $i;
			}
		}
		return $data;
	}
}
