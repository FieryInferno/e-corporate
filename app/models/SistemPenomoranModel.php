<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SistemPenomoranModel extends CI_Model {

	private $formulir;
    private $formatPenomoran;
    private $table  = 'sistemPenomoran';
    private $idPenomoran;
    
    public function set($jenis, $isi)
	{
		$this->$jenis	= $isi;
    }

    public function save()
    {
        if ($this->idPenomoran) {
            $this->db->where('idPenomoran', $this->idPenomoran);
            $this->db->update('sistemPenomoran', [
                'formulir'          => $this->formulir,
                'formatPenomoran'   => $this->formatPenomoran
            ]);
        } else {
            $this->db->insert('sistemPenomoran', [
                'idPenomoran'       => uniqid(),
                'formulir'          => $this->formulir,
                'formatPenomoran'   => $this->formatPenomoran
            ]);
        }
    }

    public function indexDatatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select($this->table . '.*');
        if ($this->formulir) {
            $this->datatables->like('formulir', $this->formulir);
        }
        $this->datatables->from($this->table);
        return $this->datatables->generate();
    }

    public function get()
    {
        return $this->db->get_where($this->table, [
            'idPenomoran'   => $this->idPenomoran
        ])->row_array();
    }

    public function delete()
    {
        $this->db->where('idPenomoran', $this->idPenomoran);
        $this->db->delete($this->table);
    }
}   