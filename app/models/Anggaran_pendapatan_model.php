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


class Anggaran_pendapatan_model extends CI_Model
{

	public function save()
	{
		$id = $this->uri->segment(3);
		if ($id) {
			foreach ($this->input->post() as $key => $val) $this->db->set($key, $val);
			$this->db->set('uby', get_user('username'));
			$this->db->set('udate', date('Y-m-d H:i:s'));
			$this->db->where('id', $id);
			$update = $this->db->update('tanggaranpendapatan');
			if ($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach ($this->input->post() as $key => $val) $this->db->set($key, $val);
			$this->db->set('cby', get_user('username'));
			$this->db->set('cdate', date('Y-m-d H:i:s'));
			$insert = $this->db->insert('tanggaranpendapatan');
			if ($insert) {
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
        $update = $this->db->update('tanggaranpendapatan');
        if ($update) {
            return jsonOutputDeleteSuccess();
        } else {
            return jsonOutputDeleteError();
		}		
	
	}
	public function hitungJumlahNominal()
	{
		$this->db->select_sum('nominal');
		$this->db->where('stdel','0');
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
