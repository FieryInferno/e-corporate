<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends User_Controller {

	private $perusahaan;
	private $rekening;
	private $tanggal;

	public function __construct() {
		parent::__construct();
		$this->perusahaan	= $this->input->get('perusahaan');
		$this->rekening		= $this->input->get('rekening');
		$this->tanggal		= $this->input->get('tanggal');
	}

	public function kasBank() {
		$data['laporan']	= null;
		$data['tanggal']	= null;
		if ($this->perusahaan) {
			$this->LaporanModel->set('perusahaan', $this->perusahaan);
			$this->LaporanModel->set('rekening', $this->rekening);
			$this->LaporanModel->set('tanggal', $this->tanggal);
			$data['laporan']		= $this->LaporanModel->get();
			$data['tanggal']		= $this->tgl_indo($this->tanggal);
			$tanggalAwal			= date('Y-m-d', strtotime('-1 days', strtotime($this->tanggal)));
			$data['tanggalAwal']	= $this->tgl_indo($tanggalAwal);
			$this->LaporanModel->set('tanggal', $tanggalAwal);
			$kasBank			= $this->LaporanModel->get('total');
			$data['jumlahDebetAwal']	= 0;
			$data['jumlahKreditAwal']	= 0;
			foreach ($kasBank as $key) {
				foreach ($key as $value) {
					$data['jumlahDebetAwal']	+= $value['debet'];
					$data['jumlahKreditAwal']	+= $value['kredit'];
				}
			}
		}
		$data['title']		= 'Laporan Kas Bank';
		$data['subtitle']	= lang('list');
		$data['content']	= 'laporan/kasBank/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function tgl_indo($tanggal){
		$bulan = array (
			1 =>   'Januari',
			'Februari',
			'Maret',
			'April',
			'Mei',
			'Juni',
			'Juli',
			'Agustus',
			'September',
			'Oktober',
			'November',
			'Desember'
		);
		$pecahkan = explode('-', $tanggal);
		return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
	}
}