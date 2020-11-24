<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProjectModel extends CI_Model {

    private $table  = 'project';

	public function save() {
        var_dump($this->input->post('noEvent'));
        var_dump($this->input->post('grossProfit'));die();
        $idProject  = uniqid('PRJ');
        $insert = $this->db->insert($this->table, [
            'idProject'         => $idProject,
            'tanggalMulai'      => $this->input->post('tanggalMulai'),
            'perusahaan'        => $this->input->post('idperusahaan'),
            'kodeEvent'         => $this->input->post('kodeEvent'),
            'rekanan'           => $this->input->post('rekanan'),
            'tanggalSelesai'    => $this->input->post('tanggalSelesai'),
            'departemen'        => $this->input->post('departemen'),
            'kelompokUmur'      => $this->input->post('kelompokUmur'),
            'cabang'            => $this->input->post('cabang'),
            'gudang'            => $this->input->post('gudang'),
            'region'            => $this->input->post('region'),
            'noEvent'           => $this->input->post('noEvent'),
            'grossProfit'       => $this->input->post('grossProfit'),
            'totalPendapatan'   => $this->input->post('totalPendapatan'),
            'totalHPP'          => $this->input->post('totalHPP'),
        ]);
        if ($insert) {
            for ($i=0; $i < count($this->input->post('noAkun')); $i++) {
                $insert = $this->db->insert('projectDetail', [
                    'idProject' => $idProject,
                    'noAkun'    => $this->input->post('noAkun')[$i],
                    'harga'     => $this->input->post('harga')[$i],
                    'jumlah'    => $this->input->post('jumlah')[$i],
                    'subtotal'  => $this->input->post('subtotal')[$i],
                    'total'     => $this->input->post('total')[$i]
                ]);
            }
        }
        return $insert;
    }
    
    public function indexDatatables($perusahaan)
    {
        $this->load->library('Datatables');
        $this->datatables->select('project.*, mperusahaan.nama_perusahaan, mcabang.nama as namaCabang, mkontak.nama as namaRekanan, mgudang.nama as namaGudang, mdepartemen.nama as namaPejabat');
        $this->datatables->join('mperusahaan', 'project.perusahaan = mperusahaan.idperusahaan');
        $this->datatables->join('mcabang', 'project.cabang = mcabang.id');
        $this->datatables->join('mkontak', 'project.rekanan = mkontak.id');
        $this->datatables->join('mgudang', 'project.gudang = mgudang.id');
        $this->datatables->join('mdepartemen', 'project.departemen = mdepartemen.id');
        if ($perusahaan) {
            $this->datatables->where('project.perusahaan', $perusahaan);
        }
        $this->datatables->from($this->table);
        return print_r($this->datatables->generate());
    }

    public function select2($perusahaan)
    {
        $this->db->select('project.idProject as id, project.noEvent as text');
        return $this->db->get_where('project', [
            'perusahaan'    => $perusahaan
        ])->result_array();
    }
}