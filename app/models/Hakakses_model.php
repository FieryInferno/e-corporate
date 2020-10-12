<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Hakakses_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);

		if($id) {
			$this->db->set('nama',$this->input->post('nama'));
			$this->db->where('id', $id);
			$update = $this->db->update('mpegawaihakakses');
			if($update) {
				$this->db->where('idhakakses', $id);
				$delete = $this->db->delete('mpegawaihakaksesdetail');
				if($delete) {
					$modul = explode(',', $this->input->post('modul'));
					foreach($modul as $r) {
						$this->db->set('idhakakses',$id);
						$this->db->set('idmodul',$r);
						$this->db->insert('mpegawaihakaksesdetail');
					}
					$data['status'] = 'success';
					$data['message'] = lang('success_update');
				} else {
					$data['status'] = 'error';
					$data['message'] = lang('error_update');
				}
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('error_update');
			}
		} else {
			$cekhakakses = $this->db->where('nama', $this->input->post('nama'))->get('mpegawaihakakses');
			if($cekhakakses->num_rows() > 0) {
				$data['status'] = 'error';
				$data['message'] = lang('data_already_exists');
				return $this->output->set_content_type('application/json')->set_output(json_encode($data));
			}
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$insert = $this->db->insert('mpegawaihakakses');
			if($insert) {
				$data['status'] = 'success';
				$data['message'] = lang('success_save');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('error_save');
			}
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$id = $this->uri->segment(3);

		$this->db->set('stdelete','1');
		$this->db->where('id', $id);
		$update = $this->db->update('mpegawaihakakses');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('success_delete');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('error_delete');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_all_modul_edit($idhakakses) {
		$this->db->select('
			mmodul.*,
			( SELECT idhakakses 
			FROM t_mpegawaihakaksesdetail WHERE 
			idmodul = t_mmodul.id AND idhakakses = '.$idhakakses.'  ) AS stakses
		');
		$this->db->where('staktif', '1');
		$get = $this->db->get('mmodul')->result_array();
		return $get;
	}

	public function get_all_modul() {
		$this->db->where('staktif', '1');
		$get = $this->db->get('mmodul')->result_array();
		return $get;
	}

}