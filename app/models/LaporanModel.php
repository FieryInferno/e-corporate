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

    $data       = [];
    $temp       = [];

		for ($i=0; $i < count($jurnalUmum); $i++) { 
			$key	= $jurnalUmum[$i];
      $total;
      switch (substr($key['akunno'], 0, 1)) {
        case '4':
        case '5':
        case '6':
        case '7':
        case '8':
        case '9':
          if (in_array($key['akunno'], $temp)) {
            $noTemp = array_keys($temp, $key['akunno']);
            var_dump($key['jenis']);echo '<br/>';
            print_r('bangsat');echo '<br/>';  
            switch ($key['jenis']) {
              case 'debit':
                $data[$noTemp]['saldo']	+= $key['total'];
                break;
              case 'kredit':
                $data[$noTemp]['saldo']	-= $key['total'];
                break;
              
              default:
                $data[$noTemp]['saldo']	+= $key['totalDebit'];
                $data[$noTemp]['saldo']	-= $key['totalKredit'];
                break;
            }
          } else {
            $total	= 0;
            switch ($key['jenis']) {
              case 'debit':
                $total	+= $key['total'];
                break;
              case 'kredit':
                $total	-= $key['total'];
                break;
                
              default:
                $total  += $key['totalDebit'];
                $total	-= $key['totalKredit'];
                break;
            }
            array_push($data, [
              'akunno'    => $key['akunno'],
              'namaakun'  => $key['namaakun'],
              'saldo'     => $total
            ]);
            array_push($temp, $key['akunno']);
          }
          break;
        
        default:
          # code...
          break;
      }
    }
		return $data;
  }
}