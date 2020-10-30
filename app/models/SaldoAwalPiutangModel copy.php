<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalPersediaanModel extends CI_Model {
    
    private $idSaldoAwalPersediaan;
    private $namaPemasok;
    private $noInvoice;
    private $tanggal;
    private $tanggalTempo;
    private $noAkun;
    private $deksripsi;
    private $nilaiPersediaan;
    private $primeOwing;
    private $taxOwing;
    private $table  = 'saldoAwalPersediaan';

    public function indexDatatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select($this->table . '.*, mperusahaan.nama_perusahaan');
		$this->datatables->from($this->table);
		$this->datatables->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
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
            'noInvoice'     => $this->noInvoice,
            'tanggal'       => $this->tanggal,
            'tanggalTempo'  => $this->tanggalTempo,
            'namaPelanggan' => $this->namaPemasok,
            'akun'          => $this->noAkun,
            'deskripsi'     => $this->deskripsi,
            'jumlah'        => $this->nilaiPersediaan,
            'primeOwing'    => $this->primeOwing,
            'taxOwing'      => $this->taxOwing,
            'ageFrDue'      => (strtotime($this->tanggalTempo) - strtotime($this->tanggal))/86400,
            'perusahaan'    => $this->perusahaan
        ];
        if ($this->idSaldoAwalPersediaan) {
            $this->db->where('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
            $data   = $this->db->update('SaldoAwalPersediaan', $data);
        } else {
            $data   = $this->db->insert('SaldoAwalPersediaan', $data);
        }
        return $data;
    }

    public function get()
    {
        $this->db->select('SaldoAwalPersediaan.*, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'SaldoAwalPersediaan.perusahaan = mperusahaan.idperusahaan');
        if ($this->idSaldoAwalPersediaan) {
            $this->db->where('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
            return $this->db->get('SaldoAwalPersediaan')->row_array();
        } else {
            return $this->db->get('SaldoAwalPersediaan')->result_array();
        }
    }

    public function delete()
    {
        $this->db->where('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
        return $this->db->delete('SaldoAwalPersediaan');
    }
}

