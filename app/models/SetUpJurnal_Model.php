<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/


class SetUpJurnal_model extends CI_Model {

	public function save() {
        $idSetupJurnal  = uniqid('SJ');
        $setupJurnal    = $this->db->insert('tSetupJurnal', [
            'idSetupJurnal' => $idSetupJurnal,
            'kodeJurnal'    => $this->input->post('kodeJurnal'),
            'formulir'      => $this->input->post('formulir'),
            'keterangan'    => $this->input->post('keterangan')
        ]);
        if ($setupJurnal) {
            if ($this->input->post('elemenjurnalAnggaran') !== null) {
                for ($i=0; $i < count($this->input->post('elemenjurnalAnggaran')); $i++) { 
                    $this->db->insert('tJurnalAnggaran', [
                        'idSetupJurnal' => $idSetupJurnal,
                        'elemen'        => $this->input->post('elemenjurnalAnggaran')[$i],
                        'jenis'         => $this->input->post('d/kjurnalAnggaran')[$i],
                        'nominal'       => $this->input->post('nominaljurnalAnggaran')[$i]
                    ]);
                }
            }
            if ($this->input->post('elemenjurnalFinansial')) {
                for ($i=0; $i < count($this->input->post('elemenjurnalFinansial')); $i++) { 
                    $this->db->insert('tJurnalFinansial', [
                        'idSetupJurnal' => $idSetupJurnal,
                        'elemen'        => $this->input->post('elemenjurnalFinansial')[$i],
                        'jenis'         => $this->input->post('d/kjurnalFinansial')[$i],
                        'nominal'       => $this->input->post('nominaljurnalFinansial')[$i]
                    ]);
                }
            }
            return $setupJurnal;
        } else {
            return $setupJurnal;
        }
    }

    public function index_datatable()
    {
        $this->load->library('Datatables');
		$this->datatables->select('*');
		$this->datatables->from('tSetupJurnal');
		return $this->datatables->generate();
    }

    public function delete($idSetupJurnal) {
		$this->db->where('idSetupJurnal', $idSetupJurnal);
		$delete = $this->db->delete('tSetupJurnal');
		if($delete) {
            $this->db->where('idSetupJurnal', $idSetupJurnal);
            $this->db->delete('tJurnalAnggaran');
            $this->db->where('idSetupJurnal', $idSetupJurnal);
            $this->db->delete('tJurnalFinansial');
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
        }
        return $data;
	}
}

