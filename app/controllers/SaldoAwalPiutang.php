<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalPiutang extends User_Controller {

    private $title  = 'Saldo Awal Piutang';
    private $namaPemasok;
    private $noInvoice;
    private $tanggal;
    private $tanggalTempo;
    private $noAkun;
    private $deskripsi;
    private $nilaiPiutang;
    private $primeOwing;
    private $taxOwing;
    private $idSaldoAwalPiutang;
    private $perusahaan;

	public function __construct() {
        parent::__construct();
        $this->setGet('idSaldoAwalPiutang', $this->input->post('idSaldoAwalPiutang'));
        $this->setGet('noInvoice', $this->input->post('noInvoice'));
        $this->setGet('tanggal', $this->input->post('tanggal'));
        $this->setGet('tanggalTempo', $this->input->post('tanggalTempo'));
        $this->setGet('namaPemasok', $this->input->post('pemasok'));
        $this->setGet('noAkun', $this->input->post('noAkun'));
        $this->setGet('deskripsi', $this->input->post('deskripsi'));
        $this->setGet('nilaiPiutang', $this->input->post('nilaiPiutang'));
        $this->setGet('primeOwing', $this->input->post('primeOwing'));
        $this->setGet('taxOwing', $this->input->post('taxOwing'));
        $this->setGet('perusahaan', $this->input->post('perusahaan'));
	}

	public function index() {
		$data['title']      = $this->title;
		$data['subtitle']   = lang('list');
		$data['content']    = 'SaldoAwalPiutang/index';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function create()
    {
        $data['title']      = $this->title;
		$data['subtitle']   = 'Tambah';
		$data['content']    = 'SaldoAwalPiutang/create';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }

    private function setGet($jenis, $isi)
    {
        if ($isi) {
            $this->$jenis   = $isi;
        } else {
            return $this->$jenis;
        }
    }

    private function validation()
    {
		$this->form_validation->set_rules('noInvoice', 'No. Invoice', 'required|trim');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('tanggalTempo', 'Tanggal Tempo', 'required');
        $this->form_validation->set_rules('pemasok', 'Nama Pemasok', 'required');
        $this->form_validation->set_rules('noAkun', 'No. Akun', 'required');
        $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
		$this->form_validation->set_rules('nilaiPiutang', 'Nilai Piutang', 'required|trim');
		$this->form_validation->set_rules('primeOwing', 'Prime Owing', 'required|trim');
        $this->form_validation->set_rules('taxOwing', 'Tax Owing', 'required|trim');
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
    }

    public function indexDatatable()
    {
        $perusahaan = $this->session->idperusahaan;
        $data       = $this->SaldoAwalPiutangModel->indexDatatable($perusahaan);
        return print_r($data);
    }

    public function save()
    {
        $this->validation();
        if ($this->form_validation->run()) {
            $this->SaldoAwalPiutangModel->setGet('noInvoice', $this->noInvoice);
            $this->SaldoAwalPiutangModel->setGet('tanggal', $this->tanggal);
            $this->SaldoAwalPiutangModel->setGet('tanggalTempo', $this->tanggalTempo);
            $this->SaldoAwalPiutangModel->setGet('noAkun', $this->noAkun);
            $this->SaldoAwalPiutangModel->setGet('deskripsi', $this->deskripsi);
            $this->SaldoAwalPiutangModel->setGet('nilaiPiutang', $this->nilaiPiutang);
            $this->SaldoAwalPiutangModel->setGet('primeOwing', $this->primeOwing);
            $this->SaldoAwalPiutangModel->setGet('taxOwing', $this->taxOwing);
            $this->SaldoAwalPiutangModel->setGet('namaPemasok', $this->namaPemasok);
            $this->SaldoAwalPiutangModel->setGet('perusahaan', $this->perusahaan);
            $this->SaldoAwalPiutangModel->setGet('idSaldoAwalPiutang', $this->idSaldoAwalPiutang);
            $data   = $this->SaldoAwalPiutangModel->save();
            if ($data) {
                $data0['status'] = 'success';
            } else {
                $data0['status'] = 'error';
            }
        } else {
            $data0['status'] = 'error';
            $data0['pesan'] = validation_errors();
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
    }

    public function edit()
    {
        $this->SaldoAwalPiutangModel->setGet('idSaldoAwalPiutang', $this->idSaldoAwalPiutang);
        $data               = $this->SaldoAwalPiutangModel->get();
        $data['title']      = $this->title;
		$data['subtitle']   = 'Edit';
        $data['content']    = 'SaldoAwalPiutang/edit';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }

    public function delete()
    {
        $this->SaldoAwalPiutangModel->setGet('idSaldoAwalPiutang', $this->idSaldoAwalPiutang);
        $data   = $this->SaldoAwalPiutangModel->delete();
        if ($data) {
            $data0['status'] = 'success';
        } else {
            $data0['status'] = 'error';
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
    }
}