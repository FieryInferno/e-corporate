<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanModel extends CI_Model {

    private $perusahaan;
	private $rekening;
	private $tanggal;

	public function get()
    {
        $laporan    = [];
        $this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
        $this->db->join('mrekening', 'tsaldoawaldetail.noakun = mrekening.akunno');
        $saldoAwal  = $this->db->get_where('tsaldoawal', [
            'tsaldoawal.perusahaan' => $this->perusahaan,
            'mrekening.id'          => $this->rekening,
            'tanggal'               => $this->tanggal
        ])->result_array();
        if ($saldoAwal) {
            array_push($laporan, $saldoAwal);
        }
        $this->db->select('tkasbank.nomor_kas_bank as no, tkasbank.keterangan, tkasbankdetail.penerimaan as debet, tkasbankdetail.pengeluaran as kredit');
        $this->db->join('tkasbankdetail', 'tkasbank.id = tkasbankdetail.idkasbank');
        $kasBank    = $this->db->get_where('tkasbank',[
            'tkasbank.perusahaan'       => $this->perusahaan,
            'tkasbankdetail.sumberdana' => $this->rekening,
            'tkasbank.tanggal'          => $this->tanggal
        ])->result_array();
        if ($kasBank) {
            array_push($laporan, $kasBank);
        }
        return $laporan;
    }

    public function set($jenis, $isi)
    {
        $this->$jenis   = $isi;
    }
}