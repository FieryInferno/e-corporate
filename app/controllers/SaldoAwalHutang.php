<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalHutang extends User_Controller {

    private $title  = 'Saldo Awal Hutang';
    private $namaPemasok;
    private $noInvoice;
    private $tanggal;
    private $tanggalTempo;
    private $noAkun;
    private $deskripsi;
    private $nilaiHutang;
    private $primeOwing;
    private $taxOwing;
    private $idSaldoAwalHutang;
    private $perusahaan;

	public function __construct() {
        parent::__construct();
        $this->setGet('idSaldoAwalHutang', $this->input->post('idSaldoAwalHutang'));
        $this->setGet('noInvoice', $this->input->post('noInvoice'));
        $this->setGet('tanggal', $this->input->post('tanggal'));
        $this->setGet('tanggalTempo', $this->input->post('tanggalTempo'));
        $this->setGet('namaPemasok', $this->input->post('pemasok'));
        $this->setGet('noAkun', $this->input->post('noAkun'));
        $this->setGet('deskripsi', $this->input->post('deskripsi'));
        $this->setGet('nilaiHutang', $this->input->post('nilaiHutang'));
        $this->setGet('primeOwing', $this->input->post('primeOwing'));
        $this->setGet('taxOwing', $this->input->post('taxOwing'));
        $this->perusahaan   = $this->input->post('perusahaan');
	}

	public function index() {
		$data['title']      = $this->title;
		$data['subtitle']   = lang('list');
		$data['content']    = 'SaldoAwalHutang/index';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function create()
    {
        $data['title']      = $this->title;
		$data['subtitle']   = 'Tambah';
		$data['content']    = 'SaldoAwalHutang/create';
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
		$this->form_validation->set_rules('nilaiHutang', 'Nilai Hutang', 'required|trim');
		$this->form_validation->set_rules('primeOwing', 'Prime Owing', 'required|trim');
		$this->form_validation->set_rules('taxOwing', 'Tax Owing', 'required|trim');
    }

    public function indexDatatable()
    {
        $perusahaan = $this->session->idperusahaan;
        $data       = $this->SaldoAwalHutangModel->indexDatatable($perusahaan);
        return print_r($data);
    }

    public function save()
    {
        $this->validation();
        if ($this->form_validation->run()) {
            $this->SaldoAwalHutangModel->setGet('noInvoice', $this->noInvoice);
            $this->SaldoAwalHutangModel->setGet('tanggal', $this->tanggal);
            $this->SaldoAwalHutangModel->setGet('tanggalTempo', $this->tanggalTempo);
            $this->SaldoAwalHutangModel->setGet('noAkun', $this->noAkun);
            $this->SaldoAwalHutangModel->setGet('deskripsi', $this->deskripsi);
            $this->SaldoAwalHutangModel->setGet('nilaiHutang', $this->nilaiHutang);
            $this->SaldoAwalHutangModel->setGet('primeOwing', $this->primeOwing);
            $this->SaldoAwalHutangModel->setGet('taxOwing', $this->taxOwing);
            $this->SaldoAwalHutangModel->setGet('namaPemasok', $this->namaPemasok);
            $this->SaldoAwalHutangModel->setGet('perusahaan', $this->perusahaan);
            $data   = $this->SaldoAwalHutangModel->save();
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
        $this->SaldoAwalHutangModel->setGet('idSaldoAwalHutang', $this->idSaldoAwalHutang);
        $data               = $this->SaldoAwalHutangModel->get();
        $data['title']      = $this->title;
		$data['subtitle']   = 'Edit';
        $data['content']    = 'SaldoAwalHutang/edit';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }

    public function delete()
    {
        $this->SaldoAwalHutangModel->setGet('idSaldoAwalHutang', $this->idSaldoAwalHutang);
        $data   = $this->SaldoAwalHutangModel->delete();
        if ($data) {
            $data0['status'] = 'success';
        } else {
            $data0['status'] = 'error';
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
    }
}