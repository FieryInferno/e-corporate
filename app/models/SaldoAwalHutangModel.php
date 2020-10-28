<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalHutangModel extends CI_Model {
    
    private $idSaldoAwalHutang;
    private $namaPemasok;
    private $noInvoice;
    private $tanggal;
    private $tanggalTempo;
    private $noAkun;
    private $deksripsi;
    private $nilaiHutang;
    private $primeOwing;
    private $taxOwing;

    public function indexDatatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('SaldoAwalHutang.*, mperusahaan.nama_perusahaan');
		$this->datatables->from('SaldoAwalHutang');
		$this->datatables->join('mperusahaan', 'SaldoAwalHutang.perusahaan = mperusahaan.idperusahaan');
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
            'namaPemasok'   => $this->namaPemasok,
            'akun'          => $this->noAkun,
            'deskripsi'     => $this->deskripsi,
            'jumlah'        => $this->nilaiHutang,
            'primeOwing'    => $this->primeOwing,
            'taxOwing'      => $this->taxOwing,
            'ageFrDue'      => (strtotime($this->tanggalTempo) - strtotime($this->tanggal))/86400
        ];
        if ($this->idSaldoAwalHutang) {
            $this->db->where('idSaldoAwalHutang', $this->idSaldoAwalHutang);
            $data   = $this->db->update('SaldoAwalHutang', $data);
        } else {
            $data   = $this->db->insert('SaldoAwalHutang', $data);
        }
        return $data;
    }

    public function get()
    {
        $this->db->select('SaldoAwalHutang.*, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'SaldoAwalHutang.perusahaan = mperusahaan.idperusahaan');
        if ($this->idSaldoAwalHutang) {
            $this->db->where('idSaldoAwalHutang', $this->idSaldoAwalHutang);
            return $this->db->get('SaldoAwalHutang')->row_array();
        } else {
            return $this->db->get('SaldoAwalHutang')->result_array();
        }
    }

    public function delete()
    {
        $this->db->where('idSaldoAwalHutang', $this->idSaldoAwalHutang);
        return $this->db->delete('SaldoAwalHutang');
    }
}

