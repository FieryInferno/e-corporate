<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * =================================================
 * @package    CGC (CODEIGNITER GENERATE CRUD)
 * @author    isyanto.id@gmail.com
 * @link    https://isyanto.com
 * @since    Version 1.0.0
 * @filesource
 * =================================================
 */

class Item_model extends CI_Model
{

    public function save()
    {
        $id = $this->uri->segment(3);
        $kode = $this->input->post('kode');

        if ($id) {
            $item = get_by_id('id', $id, 'mitem');
            $kodeexists = get_by_id('kode', $kode, 'mitem');

            if ($item['kode'] != $kodeexists['kode']) {
                if ($kodeexists) {
                    $data['status'] = 'error';
                    $data['message'] = 'Kode sudah ada sebelumnya';
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }

            $upload = $this->uploadgambar();
            if ($upload['status'] == 'success') {
                $this->db->set('gambar', $upload['file_name']);
            }
            foreach ($this->input->post() as $key => $val) {
                $this->db->set($key, strip_tags($val));
            }

            $this->db->set('hargabeli', remove_comma($this->input->post('hargabeli')));
            $this->db->set('hargajual', remove_comma($this->input->post('hargajual')));
            $this->db->set('uby', get_user('username'));
            $this->db->set('udate', date('Y-m-d H:i:s'));
            $this->db->where('id', $id);
            $update = $this->db->update('mitem');
            if ($update) {
                $data['status'] = 'success';
                $data['message'] = lang('update_success_message');
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $data['status'] = 'error';
                $data['message'] = lang('update_error_message');
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        } else {
            $kodeexists = get_by_id('kode', $kode, 'mitem');
            if ($kodeexists) {
                $data['status'] = 'error';
                $data['message'] = lang('kode sudah ada sebelumnya.');
                return $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {

                $upload = $this->uploadgambar();
                if ($upload['status'] == 'error') {
                    $data['status'] = 'error';
                    $data['message'] = $upload['message'];
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }

                if ($upload['status'] == 'success') {
                    $this->db->set('gambar', $upload['file_name']);
                }

                foreach ($this->input->post() as $key => $val) {
                    $this->db->set($key, strip_tags($val));
                }

                $this->db->set('hargabeli', remove_comma($this->input->post('hargabeli')));
                $this->db->set('hargajual', remove_comma($this->input->post('hargajual')));
                $this->db->set('cby', get_user('username'));
                $this->db->set('cdate', date('Y-m-d H:i:s'));
                $insert = $this->db->insert('mitem');
                if ($insert) {
                    $data['status'] = 'success';
                    $data['message'] = lang('save_success_message');
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                } else {
                    $data['status'] = 'error';
                    $data['message'] = lang('save_error_message');
                    return $this->output->set_content_type('application/json')->set_output(json_encode($data));
                }
            }
        }
    }

    public function uploadgambar()
    {
        $config['upload_path'] = './uploads/item/';
        $config['allowed_types'] = 'jpg|png';
        $config['encrypt_name'] = true;
        $config['max_size'] = 300;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('gambar')) {
            $data['status'] = 'error';
            $data['message'] = $this->upload->display_errors();
            return $data;
        } else {
            $datafile = $this->upload->data();
            $data['status'] = 'success';
            $data['file_name'] = $datafile['file_name'];
            return $data;
        }
    }

    public function delete()
    {
        $id = $this->uri->segment(3);
        $this->db->set('stdel', '1');
        $this->db->set('dby', get_user('username'));
        $this->db->set('ddate', date('Y-m-d H:i:s'));
        $this->db->where('id', $id);
        $update = $this->db->update('mitem');
        if ($update) {
            $data['status'] = 'success';
            $data['message'] = lang('delete_success_message');
        } else {
            $data['status'] = 'error';
            $data['message'] = lang('delete_error_message');
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function barcode($id = null)
    {
        if ($id) {
            $this->_generate_barcode($id);
        }
    }

    private function _generate_barcode($str)
    {
        $this->load->library('Zend');
        $this->zend->load('Zend/Barcode');
        $location = 'uploads/item/barcode/';
        $file = Zend_Barcode::draw('code128', 'image', array('text' => $str), array());
        $store_image = imagepng($file, FCPATH . $location . "{$str}.png");
        $img = $location . "{$str}.png";
        $this->load->helper('html');
        return img($img);
    }
}
