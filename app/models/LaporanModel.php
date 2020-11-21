<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanModel extends CI_Model {

    private $perusahaan;
	private $rekening;
    private $tanggal;
	private $kasKecil;
	private $tanggalAwal;
	private $tanggalAkhir;

	public function get($jenis = null)
    {
        $laporan    = [];
        $this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
        $this->db->join('mrekening', 'tsaldoawaldetail.noakun = mrekening.akunno');
        if ($jenis) {
            $this->db->where('tanggal <= ', $this->tanggal);
        } else {
            $this->db->where('tanggal', $this->tanggal);
        }
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
        if ($jenis) {
            $this->db->where('tkasbank.tanggal <= ', $this->tanggal);
        } else {
            $this->db->where('tkasbank.tanggal', $this->tanggal);
        }
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

    public function getBukuPembantuKasKecil($jenis = null)
    {
        $laporan    = [];
        $this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
        $this->db->join('mrekening', 'tsaldoawaldetail.noakun = mrekening.akunno');
        if ($jenis) {
            $this->db->where('tanggal <= ', $this->tanggal);
        } else {
            $this->db->where('tsaldoawal.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
        }
        $saldoAwal  = $this->db->get_where('tsaldoawal', [
            'tsaldoawal.perusahaan'     => $this->perusahaan,
            'tsaldoawaldetail.noakun'   => $this->kasKecil
        ])->result_array();
        if ($saldoAwal) {
            array_push($laporan, $saldoAwal);
        }

        $this->db->select('tkasbank.nomor_kas_bank as no, tkasbank.keterangan, tkasbankdetail.penerimaan as debet, tkasbankdetail.pengeluaran as kredit');
        $this->db->join('tkasbank', 'tkasbank.nomor_kas_bank = tpemindahbukuankaskecil.nomor_kas_bank');
        $this->db->join('tkasbankdetail', 'tkasbank.id = tkasbankdetail.idkasbank');
        if ($jenis) {
            $this->db->where('tkasbank.tanggal <= ', $this->tanggal);
        } else {
            $this->db->where('tkasbank.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
        }
        $kasBank    = $this->db->get_where('tpemindahbukuankaskecil',[
            'tpemindahbukuankaskecil.perusahaan'    => $this->perusahaan,
            'tkasbankdetail.noakun'                 => $this->kasKecil,
            'tkasbankdetail.tipe'                   => 'Pengajuan Kas Kecil'
        ])->result_array();
        if ($kasBank) {
            array_push($laporan, $kasBank);
        }

        $this->db->select('tpengeluarankaskecil.nokwitansi as no, tpengeluarankaskecil.keterangan, tpengeluarankaskecil.total as kredit');
        if ($jenis) {
            $this->db->where('tpengeluarankaskecil.tanggal <= ', $this->tanggal);
        } else {
            $this->db->where('tpengeluarankaskecil.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
        }
        $pengeluaranKasKecil    = $this->db->get_where('tpengeluarankaskecil',[
            'perusahaan'    => $this->perusahaan,
            'akunno'        => $this->kasKecil
        ])->result_array();
        for ($i=0; $i < count($pengeluaranKasKecil); $i++) { 
            $pengeluaranKasKecil[$i]['debet']   = 0;
        }
        if ($pengeluaranKasKecil) {
            array_push($laporan, $pengeluaranKasKecil);
        }
        
        $this->db->select('tsetorkaskecil.nokwitansi as no, tsetorkaskecil.keterangan, tsetorkaskecil.nominal as kredit');
        if ($jenis) {
            $this->db->where('tsetorkaskecil.tanggal <= ', $this->tanggal);
        } else {
            $this->db->where('tsetorkaskecil.tanggal BETWEEN "' . $this->tanggalAwal . '" AND "' . $this->tanggalAkhir . '"');
        }
        $setorKasKecil    = $this->db->get_where('tsetorkaskecil',[
            'perusahaan'    => $this->perusahaan,
            'kas'           => $this->kasKecil
        ])->result_array();
        for ($i=0; $i < count($setorKasKecil); $i++) { 
            $setorKasKecil[$i]['debet']   = 0;
        }
        if ($setorKasKecil) {
            array_push($laporan, $setorKasKecil);
        }

        return $laporan;
    }
}