<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris_model extends CI_Model {

    public function save($id)
    {
        $id = $this->uri->segment(3);
        foreach ($this->input->post() as $key => $val) {
            $this->db->set($key, strip_tags($val));
        }

        
        $this->db->where('id_inventaris', $id);
        $update = $this->db->update('tinventaris');
        if ($update) {
            $data['status'] = 'success';
            $data['message'] = lang('update_success_message');
        } else {
            $data['status'] = 'error';
            $data['message'] = lang('update_error_message');
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

	public function delete()
    {
        $id = $this->uri->segment(3);
        $this->db->where('id_inventaris', $id);
        $update = $this->db->delete('tinventaris');
        if ($update) {
            $data['status'] = 'success';
            $data['message'] = lang('delete_success_message');
        } else {
            $data['status'] = 'error';
            $data['message'] = lang('delete_error_message');
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

}

