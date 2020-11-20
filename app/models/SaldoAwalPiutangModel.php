<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalPiutangModel extends CI_Model {
    
    private $idSaldoAwalPiutang;
    private $namaPemasok;
    private $noInvoice;
    private $tanggal;
    private $tanggalTempo;
    private $noAkun;
    private $deksripsi;
    private $nilaiPiutang;
    private $primeOwing;
    private $taxOwing;

    public function indexDatatable($perusahaan)
    {
        $this->load->library('Datatables');
        $this->datatables->select('SaldoAwalPiutang.*, mperusahaan.nama_perusahaan');
		$this->datatables->join('mperusahaan', 'SaldoAwalPiutang.perusahaan = mperusahaan.idperusahaan');
        if ($perusahaan) {
            $this->datatables->where('perusahaan', $perusahaan);
        }
		$this->datatables->from('SaldoAwalPiutang');
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
            'jumlah'        => $this->nilaiPiutang,
            'primeOwing'    => $this->primeOwing,
            'taxOwing'      => $this->taxOwing,
            'ageFrDue'      => (strtotime($this->tanggalTempo) - strtotime($this->tanggal))/86400,
            'perusahaan'    => $this->perusahaan
        ];
        if ($this->idSaldoAwalPiutang) {
            $this->db->where('idSaldoAwalPiutang', $this->idSaldoAwalPiutang);
            $data   = $this->db->update('SaldoAwalPiutang', $data);
        } else {
            $data   = $this->db->insert('SaldoAwalPiutang', $data);
        }
        return $data;
    }

    public function get()
    {
        $this->db->select('SaldoAwalPiutang.*, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'SaldoAwalPiutang.perusahaan = mperusahaan.idperusahaan');
        if ($this->idSaldoAwalPiutang) {
            $this->db->where('idSaldoAwalPiutang', $this->idSaldoAwalPiutang);
            return $this->db->get('SaldoAwalPiutang')->row_array();
        } else {
            return $this->db->get('SaldoAwalPiutang')->result_array();
        }
    }

    public function delete()
    {
        $this->db->where('idSaldoAwalPiutang', $this->idSaldoAwalPiutang);
        return $this->db->delete('SaldoAwalPiutang');
    }
}

