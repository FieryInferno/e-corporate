<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalInventarisModel extends CI_Model {
    
    private $kodeInventaris;
    private $noRegister;
    private $kelompok;
    private $tahunPerolehan;
    private $keterangan;
    private $lokasi;
    private $kondisi;
    private $nilaiBuku;
    private $perusahaan;
    private $idSaldoAwalInventaris;
    private $namaInventaris;
    private $table  = 'saldoAwalInventaris';

    public function indexDatatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('saldoAwalInventaris.*, mperusahaan.nama_perusahaan, mnoakun.namaakun');
		$this->datatables->from('saldoAwalInventaris');
		$this->datatables->join('mperusahaan', 'saldoAwalInventaris.perusahaan = mperusahaan.idperusahaan');
		$this->datatables->join('mnoakun', 'saldoAwalInventaris.noAkun = mnoakun.idakun');
		return $this->datatables->generate();
    }

    public function setGet($jenis, $isi)
    {
        $this->$jenis   = $isi;
    }

    public function save()
    {    
        $data   = [
            'kodeInventaris'    => $this->kodeInventaris,
            'noRegister'        => $this->noRegister,
            'noAkun'            => $this->kelompok,
            'tanggalPembelian'  => $this->tahunPerolehan,
            'keterangan'        => $this->keterangan,
            'lokasi'            => $this->lokasi,
            'kondisi'           => $this->kondisi,
            'harga'             => $this->nilaiBuku,
            'perusahaan'        => $this->perusahaan,
            'namaInventaris'    => $this->namaInventaris
        ];
        if ($this->idSaldoAwalInventaris) {
            $this->db->where('idSaldoAwalInventaris', $this->idSaldoAwalInventaris);
            $data   = $this->db->update($this->table, $data);
        } else {
            $data   = $this->db->insert($this->table, $data);
        }
        return $data;
    }

    public function get()
    {
        $this->db->select($this->table . '.*, mperusahaan.nama_perusahaan, mnoakun.namaakun, mnoakun.akunno');
        $this->db->join('mperusahaan', $this->table . '.perusahaan = mperusahaan.idperusahaan');
        $this->db->join('mnoakun', $this->table . '.noAkun = mnoakun.idakun');
        if ($this->idSaldoAwalInventaris) {
            $this->db->where('idSaldoAwalInventaris', $this->idSaldoAwalInventaris);
            return $this->db->get($this->table)->row_array();
        } else {
            return $this->db->get($this->table)->result_array();
        }
    }

    public function delete()
    {
        $this->db->where('idSaldoAwalInventaris', $this->idSaldoAwalInventaris);
        return $this->db->delete($this->table);
    }
}

