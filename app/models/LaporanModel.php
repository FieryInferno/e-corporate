<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LaporanModel extends CI_Model {

  private $perusahaan;
	private $rekening;
    private $tanggal;
	private $kasKecil;
	private $tanggalAwal;
	private $tanggalAkhir;

	public function getLaporanKasBank()
    {
        $laporan    = [];
        $this->db->join('tsaldoawaldetail', 'tsaldoawal.idSaldoAwal = tsaldoawaldetail.idsaldoawal');
        $this->db->join('mrekening', 'tsaldoawaldetail.noakun = mrekening.akunno');
        $this->db->where('tanggal >= ', $this->tanggalAwal);
        $this->db->where('tanggal <= ', $this->tanggalAkhir);
        $saldoAwal  = $this->db->get_where('tsaldoawal', [
            'tsaldoawal.perusahaan' => $this->perusahaan,
            'mrekening.id'          => $this->rekening
        ])->result_array();
        if ($saldoAwal) {
            array_push($laporan, $saldoAwal);
        }
        $this->db->select('tkasbank.nomor_kas_bank as no, tkasbank.keterangan, tkasbankdetail.penerimaan as debet, tkasbankdetail.pengeluaran as kredit, tkasbank.tanggal');
        $this->db->join('tkasbankdetail', 'tkasbank.id = tkasbankdetail.idkasbank');
        $this->db->where('tkasbank.tanggal >= ', $this->tanggalAwal);
        $this->db->where('tkasbank.tanggal <= ', $this->tanggalAkhir);
        $kasBank    = $this->db->get_where('tkasbank',[
            'tkasbank.perusahaan'       => $this->perusahaan,
            'tkasbankdetail.sumberdana' => $this->rekening
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

    public function getOutstandingInvoice()
    {
        $this->db->select('tfakturpenjualan.nomorsuratjalan, tfakturpenjualan.tanggal, tfakturpenjualan.tanggaltempo, tfakturpenjualan.total, tfakturpenjualan.sisatagihan, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'tfakturpenjualan.idperusahaan = mperusahaan.idperusahaan');
        $this->db->where('tanggal = ', $this->tanggal);
        return $this->db->get_where('tfakturpenjualan', [
            'tfakturpenjualan.idperusahaan' => $this->perusahaan
        ])->result_array();
    }

    public function getOutstandingPayable()
    {
        $laporan    = [];
        $this->db->select('tfaktur.noFaktur, tfaktur.tanggal, tfaktur.tanggaltempo, tfaktur.total, tfaktur.sisatagihan, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'tfaktur.perusahaanid = mperusahaan.idperusahaan');
        $fakturBeli = $this->db->get_where('tfaktur', [
            'tfaktur.perusahaanid'    => $this->perusahaan,
            'tfaktur.tanggal'       => $this->tanggal
        ])->result_array();
        if ($fakturBeli) {
            array_push($laporan, $fakturBeli);
        }
        $this->db->select('SaldoAwalHutang.noInvoice as noFaktur, SaldoAwalHutang.tanggal, SaldoAwalHutang.tanggalTempo as tanggaltempo, SaldoAwalHutang.jumlah as total, SaldoAwalHutang.primeOwing as sisatagihan, mperusahaan.nama_perusahaan');
        $this->db->join('mperusahaan', 'SaldoAwalHutang.perusahaan = mperusahaan.idperusahaan');
        $hutang = $this->db->get_where('SaldoAwalHutang',[
            'SaldoAwalHutang.perusahaan'    => $this->perusahaan,
            'SaldoAwalHutang.tanggal'       => $this->tanggal
        ])->result_array();
        if ($hutang) {
            array_push($laporan, $hutang);
        }
        return $laporan;
    }

  public function getProject()
  {
    $this->db->select('project.noEvent, project.deskripsi, project.region, mcabang.nama as cabang, project.totalPendapatan, project.totalHPP, project.kodeEvent, project.kelompokUmur, project.tanggalMulai, project.tanggalSelesai');
    $this->db->join('mcabang', 'project.cabang = mcabang.id');
    $this->db->where('tanggalMulai >= ', $this->tanggalAwal);
    $this->db->where('tanggalselesai <= ', $this->tanggalAkhir);
    return $this->db->get_where('project',[
        'project.perusahaan'    => $this->perusahaan
    ])->result_array();
  }

  public function labarugiStandar()
  {
		$this->Jurnal_model->set('perusahaan', $this->perusahaan);
		$this->Jurnal_model->set('tglMulai', $this->tanggalAwal);
		$this->Jurnal_model->set('tglAkhir', $this->tanggalAkhir);
    $jurnalUmum	= $this->Jurnal_model->get();

    $this->db->like('akunno', '4', 'after');
    $this->db->or_like('akunno', '5', 'after');
    $this->db->or_like('akunno', '6', 'after');
    $this->db->or_like('akunno', '7', 'after');
    $this->db->or_like('akunno', '8', 'after');
    $this->db->or_like('akunno', '9', 'after');
    $this->db->order_by('akunno', 'asc');
    $noakun     = $this->db->get('mnoakun')->result_array();

    $data       = [];

    foreach ($noakun as $key) {
      $total  = 0;
      foreach ($jurnalUmum as $value) {
        if (strpos($key['akunno'], $value['akunno']) !== FALSE) {
          switch ($value['jenis']) {
            case 'debit':
              $total  += $value['total'];
              break;
            case 'kredit':
              $total	-= $value['total'];
              break;
            
            default:
              $total	+= $value['totalDebit'];
              $total	-= $value['totalKredit'];
              break;
          }
        }
      }
      array_push($data, [
        'akunno'    => $key['akunno'],
        'namaAkun'  => $key['namaakun'],
        'total'     => $total
      ]);
    }
    return $data;
  }

  public function labarugiMultiPeriod()
  {
    $this->db->like('akunno', '4', 'after');
    $this->db->or_like('akunno', '5', 'after');
    $this->db->or_like('akunno', '6', 'after');
    $this->db->or_like('akunno', '7', 'after');
    $this->db->or_like('akunno', '8', 'after');
    $this->db->or_like('akunno', '9', 'after');
    $this->db->order_by('akunno', 'asc');
    $noakun = $this->db->get('mnoakun')->result_array();

    $data       = [];
    $no = 0;
    foreach ($noakun as $key) {
      $data[$no]['akunno']    = $key['akunno'];
      $data[$no]['namaakun']  = $key['namaakun'];
      $data[$no]['total']     = []; 

      $tanggalAwal  = strtotime($this->tanggalAwal);
      $tanggalAkhir = strtotime($this->tanggalAkhir);
      $numBulan     = 1 + (date("Y", $tanggalAkhir) - date("Y", $tanggalAwal)) * 12;
      $numBulan     += date("m", $tanggalAkhir) - date("m", $tanggalAwal);
      $tahun        = substr($this->tanggalAwal, 0, 4);
      $bulan        = substr($this->tanggalAwal, 5, 2);

      for ($i=0; $i < $numBulan; $i++) { 
        $this->Jurnal_model->set('perusahaan', $this->perusahaan);
        $this->Jurnal_model->set('tglMulai', $tahun . '-' . $bulan . '-01');
        $this->Jurnal_model->set('tglAkhir', $tahun . '-' . $bulan . '-30');
        $jurnalUmum	= $this->Jurnal_model->get();
        $total  = 0;
        foreach ($jurnalUmum as $value) {
          if (strpos($key['akunno'], $value['akunno']) !== FALSE) {
            switch ($value['jenis']) {
              case 'debit':
                $total  += $value['total'];
                break;
              case 'kredit':
                $total	-= $value['total'];
                break;
              
              default:
                $total	+= $value['totalDebit'];
                $total	-= $value['totalKredit'];
                break;
            }
          }
        }
        $data[$no]['total'][$bulan . '-' . $tahun] = $total;
        $bulan++;
        if ($bulan > 12) {
          $bulan  = 1;
          $tahun++;
        }
      }
      $no++;
    }
    return $data;
  }

  public function salesReceiptsDetail()
  {
    $this->db->select('tpemesananpenjualan.notrans as formNo, tpemesananpenjualan.tanggal as recvDate, mkontak.nama as namaCustomer, tfakturpenjualan.notrans as invoiceNo, tfakturpenjualan.tanggal as invoiceDate, tfakturpenjualan.total');
    $this->db->join('tpengirimanpenjualan', 'tfakturpenjualan.pengirimanid = tpengirimanpenjualan.id');
    $this->db->join('tpemesananpenjualan', 'tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id');
    $this->db->join('mkontak', 'tpemesananpenjualan.kontakid = mkontak.id');
    if ($this->perusahaan) $this->db->where('tfakturpenjualan.idperusahaan', $this->perusahaan);
    if ($this->tanggalAwal) $this->db->where('tfakturpenjualan.tanggal >= ', $this->tanggalAwal);
    if ($this->tanggalAkhir) $this->db->where('tfakturpenjualan.tanggal <= ', $this->tanggalAkhir);
    return $this->db->get('tfakturpenjualan')->result_array();
  }
}