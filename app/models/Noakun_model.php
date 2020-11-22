<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Noakun_model extends CI_Model {

	public function save() {
		$id = $this->uri->segment(3);
		if($id) {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('uby',get_user('username'));
			$this->db->set('udate',date('Y-m-d H:i:s'));
			$this->db->where('noakun', $id);
			$update = $this->db->update('mnoakun');
			if($update) {
				$data['status'] = 'success';
				$data['message'] = lang('update_success_message');
			} else {
				$data['status'] = 'error';
				$data['message'] = lang('update_error_message');
			}
		} else {
			foreach($this->input->post() as $key => $val) $this->db->set($key,strip_tags($val));
			$this->db->set('saldo',remove_comma($this->input->post('saldo')));
			$this->db->set('cby',get_user('username'));
			$this->db->set('cdate',date('Y-m-d H:i:s'));
			$insert = $this->db->insert('mnoakun');
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
		$this->db->where('idakun', $id);
		$update	= $this->db->delete('mnoakun');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_jurnal_detail_count($noakun, $tanggalawal, $tanggalakhir) {
		$queryString = "SELECT count(*) as total_row
		FROM viewjurnaldetail
		JOIN (SELECT @sum := 0) AS getsum
		WHERE noakun = '".$noakun."'
		AND tanggal >= '".$tanggalawal."'
		AND tanggal <= '".$tanggalakhir."'
		ORDER BY tanggalwaktu ASC";

		$get = $this->db->query($queryString);
		return $get->row()->total_row;
	}


	public function get_jurnal_detail($offset, $limit, $noakun, $tanggalawal, $tanggalakhir) {
		$queryString = "SELECT tipe, tanggal, keterangan, noakun, namaakun, debet, kredit,
		CASE WHEN stdebet = '1' THEN (@sum := @sum + debet - kredit) 
		ELSE (@sum := @sum + kredit - debet) END AS saldo
		FROM viewjurnaldetail
		JOIN (SELECT @sum := 0) AS getsum
		WHERE noakun = '".$noakun."'
		AND tanggal >= '".$tanggalawal."'
		AND tanggal <= '".$tanggalakhir."'
		ORDER BY tanggalwaktu ASC LIMIT ".$limit." OFFSET ".$offset;

		$get = $this->db->query($queryString);
		return $get->result_array();
	}

	public function get($id = null)
	{
		if ($id !== null) {
			$this->db->where('idakun', $id);
		}
		$data	= $this->db->get('mnoakun');
		if ($id !== null) {
			return $data->row_array();
		} else {
			return $data->result_array();
		}
	}

	public function upload_file()
    {            
        $config['upload_path']      = './uploads/excel/';    
        $config['allowed_types']    = 'xlsx';    
        $config['max_size']         = '2048';    
        $config['overwrite']        = true;    
		// $config['file_name']        = $filename;    
		// $this->load->library('upload',$config);  
        $this->upload->initialize($config); // Load konfigurasi uploadnya    
        if($this->upload->do_upload('file')){ // Lakukan upload dan Cek jika proses upload berhasil      
            // Jika berhasil :      
            $return = array(
                'result'    => 'success', 
                'file'      => $this->upload->data('file_name'), 
                'error'     => ''
			);
            return $return;    
        }else{      
            // Jika gagal :      
			$return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;   
        }  
    }

    public function insert_multiple($data)
    {    
        $this->db->insert_batch('mnoakun', $data);  
	}
	
	public function select2_noakun($idakun)
	{
		$this->db->select('mnoakun.idakun as id, concat("(",mnoakun.akunno,") - ",mnoakun.namaakun) as text');
		if ($idakun) {
			return $this->db->where('idakun', $idakun)->get('mnoakun')->row_array();
		} else {
			return $this->db->get('mnoakun')->result_array();
		}
	}

	public function select2NoAkunBeli($id)
	{
		$term = $this->input->get('q');
		$this->db->select('mnoakun.noakun as id, concat("(",mnoakun.noakun,") - ",mnoakun.namaakun) as text');
		// $this->db->where('mnoakun.stdel', '0');
		// $this->db->where('mnoakun.stbayar', '1');
		$this->db->like('mnoakun.noakun', '5114', 'after');
		// $this->db->limit(100);
		if($term) $this->db->or_like('namaakun', $term);
		if($id) $data = $this->db->where('noakun', $id)->get('mnoakun')->row_array();
		else $data = $this->db->get('mnoakun')->result_array();
	}
}

