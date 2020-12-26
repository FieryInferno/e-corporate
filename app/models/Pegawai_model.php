<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);

		$config['upload_path'] = './uploads/pegawai/';
		$config['allowed_types'] = 'jpg|png';
		$config['max_size']  = '50';
		$config['encrypt_name']  = true;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if($id) {

			$username = $this->db->get_where('mpegawai', array('id' => $id) )->row()->username;
			if($username != $this->input->post('username')) {
				$newusername = $this->db->get_where('mpegawai', array('username' => $this->input->post('username')) );
				if($newusername->num_rows() > 0) {
					$data['status'] = 'error';
					$data['message'] = 'Username already exist!';
					return $this->output->set_content_type('application/json')->set_output(json_encode($data));
				}
			}			

			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			if ( $this->upload->do_upload('photo') ){
				$getphoto = $this->db->get_where('mpegawai', array('id' => $id) )->row()->photo;
				if($getphoto) {
					if(file_exists(FCPATH.'uploads/pegawai/'.$getphoto)) {
						unlink(FCPATH.'uploads/pegawai/'.$getphoto);
					}
				}
				$dataimg = $this->upload->data();
				$this->db->set('photo',$dataimg['file_name']);
			}

			$this->db->where('id', $id);
			$update = $this->db->update('mpegawai');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('success_save');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('error_save');
			}
		} else {

			$cekusername = $this->db->where('username', $this->input->post('username'))->get('mpegawai');
			if($cekusername->num_rows() > 0) {
				$data['status'] = 'error';
				$data['message'] = 'Username already exist!';
				return $this->output->set_content_type('application/json')->set_output(json_encode($data));
			}
						
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('password',md5($this->input->post('password')));
			if ( $this->upload->do_upload('photo') ){
				$dataimg = $this->upload->data();
				$this->db->set('photo',$dataimg['file_name']);
			}
			$insert = $this->db->insert('mpegawai');
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

	public function save_password() {
		$id = $this->uri->segment(3);

		if(md5($this->input->post('password')) != get_pegawai('password')) {
			$data['status'] = 'error';
			$data['message'] = 'Password sekarang salah!';
			return $this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
		
		$this->db->set('password',md5($this->input->post('new_password')));
		$this->db->where('id', $id);
		$update = $this->db->update('mpegawai');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('success_save');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('error_save');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$id = $this->uri->segment(3);

		$this->db->set('stdelete','1');
		$this->db->where('id', $id);
		$update = $this->db->update('mpegawai');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('success_delete');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('error_delete');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function activate() {
		$id = $this->uri->segment(3);

		$this->db->set('staktif','1');
		$this->db->where('id', $id);
		$update = $this->db->update('mpegawai');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('success_save');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('error_save');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function deactivate() {
		$id = $this->uri->segment(3);

		$this->db->set('staktif','0');
		$this->db->where('id', $id);
		$update = $this->db->update('mpegawai');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('success_save');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('error_save');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function language() {
		$this->load->library('user_agent');
		$id = $this->uri->segment(3);
		$this->db->set('idbahasa',$id);
		$this->db->where('id', get_pegawai('id'));
		$update = $this->db->update('mpegawai');
		if($update) {
			redirect($this->agent->referrer(),'refresh');
		} else {
			redirect($this->agent->referrer(),'refresh');
		}
	}

}