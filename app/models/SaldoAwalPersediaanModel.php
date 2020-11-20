<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalPersediaanModel extends CI_Model {
    
    private $kodeBarang;
    private $perusahaan;
    private $gudang;
    private $noAkun;
    private $jumlah;
    private $hargaPokok;
    private $idSaldoAwalPersediaan;
    private $table  = 'saldoAwalPersediaan';

    public function indexDatatable($perusahaan)
    {
        $this->load->library('Datatables');
        $this->datatables->select($this->table . '.*, mperusahaan.nama_perusahaan, ' . $this->table . '.quantity, ' . $this->table . '.unitPrice');
		$this->datatables->from($this->table);
        $this->datatables->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
        if ($perusahaan) {
            $this->datatables->where('perusahaan', $perusahaan);
        }
		return $this->datatables->generate();
    }

    public function setGet($jenis, $isi)
    {
        if ($isi) {
            $this->$jenis   = $isi;
        } else {
            return $this->$jenis;
        }
    }

    public function save()
    {
        $data   = [
            'kodeItem'      => $this->kodeBarang,
            'gudang'        => $this->gudang,
            'quantity'      => $this->jumlah,
            'unitPrice'     => $this->hargaPokok,
            'nilaiTotal'    => (integer) $this->jumlah * (integer) $this->hargaPokok,
            'perusahaan'    => $this->perusahaan
        ];
        if ($this->idSaldoAwalPersediaan) {
            $this->db->where('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
            $data   = $this->db->update($this->table, $data);
        } else {
            $data   = $this->db->insert($this->table, $data);
        }
        return $data;
    }

    public function get()
    {
        $this->db->select($this->table . '.*, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
        if ($this->idSaldoAwalPersediaan) {
            $this->db->where('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
            return $this->db->get($this->table)->row_array();
        } else {
            return $this->db->get($this->table)->result_array();
        }
    }

    public function delete()
    {
        $this->db->where('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
        return $this->db->delete($this->table);
    }
}

