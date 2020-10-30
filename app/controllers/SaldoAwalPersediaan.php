<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalPersediaan extends User_Controller {

    private $title  = 'Saldo Awal Persediaan';
    private $namaPemasok;
    private $noInvoice;
    private $tanggal;
    private $tanggalTempo;
    private $noAkun;
    private $deskripsi;
    private $nilaiPersediaan;
    private $primeOwing;
    private $taxOwing;
    private $idSaldoAwalPersediaan;
    private $perusahaan;

	public function __construct() {
        parent::__construct();
        $this->setGet('idSaldoAwalPersediaan', $this->input->post('idSaldoAwalPersediaan'));
        $this->setGet('noInvoice', $this->input->post('noInvoice'));
        $this->setGet('tanggal', $this->input->post('tanggal'));
        $this->setGet('tanggalTempo', $this->input->post('tanggalTempo'));
        $this->setGet('namaPemasok', $this->input->post('pemasok'));
        $this->setGet('noAkun', $this->input->post('noAkun'));
        $this->setGet('deskripsi', $this->input->post('deskripsi'));
        $this->setGet('nilaiPersediaan', $this->input->post('nilaiPersediaan'));
        $this->setGet('primeOwing', $this->input->post('primeOwing'));
        $this->setGet('taxOwing', $this->input->post('taxOwing'));
        $this->setGet('perusahaan', $this->input->post('perusahaan'));
	}

	public function index() {
		$data['title']      = $this->title;
		$data['subtitle']   = lang('list');
		$data['content']    = 'SaldoAwalPersediaan/index';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function create()
    {
        $data['title']      = $this->title;
		$data['subtitle']   = 'Tambah';
		$data['content']    = 'SaldoAwalPersediaan/create';
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
		$this->form_validation->set_rules('nilaiPersediaan', 'Nilai Persediaan', 'required|trim');
		$this->form_validation->set_rules('primeOwing', 'Prime Owing', 'required|trim');
        $this->form_validation->set_rules('taxOwing', 'Tax Owing', 'required|trim');
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required|trim');
    }

    public function indexDatatable()
    {
        $data   = $this->SaldoAwalPersediaanModel->indexDatatable();
        return print_r($data);
    }

    public function save()
    {
        $this->validation();
        if ($this->form_validation->run()) {
            $this->SaldoAwalPersediaanModel->setGet('noInvoice', $this->noInvoice);
            $this->SaldoAwalPersediaanModel->setGet('tanggal', $this->tanggal);
            $this->SaldoAwalPersediaanModel->setGet('tanggalTempo', $this->tanggalTempo);
            $this->SaldoAwalPersediaanModel->setGet('noAkun', $this->noAkun);
            $this->SaldoAwalPersediaanModel->setGet('deskripsi', $this->deskripsi);
            $this->SaldoAwalPersediaanModel->setGet('nilaiPersediaan', $this->nilaiPersediaan);
            $this->SaldoAwalPersediaanModel->setGet('primeOwing', $this->primeOwing);
            $this->SaldoAwalPersediaanModel->setGet('taxOwing', $this->taxOwing);
            $this->SaldoAwalPersediaanModel->setGet('namaPemasok', $this->namaPemasok);
            $this->SaldoAwalPersediaanModel->setGet('perusahaan', $this->perusahaan);
            $this->SaldoAwalPersediaanModel->setGet('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
            $data   = $this->SaldoAwalPersediaanModel->save();
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
        $this->SaldoAwalPersediaanModel->setGet('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
        $data               = $this->SaldoAwalPersediaanModel->get();
        $data['title']      = $this->title;
		$data['subtitle']   = 'Edit';
        $data['content']    = 'SaldoAwalPersediaan/edit';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }

    public function delete()
    {
        $this->SaldoAwalPersediaanModel->setGet('idSaldoAwalPersediaan', $this->idSaldoAwalPersediaan);
        $data   = $this->SaldoAwalPersediaanModel->delete();
        if ($data) {
            $data0['status'] = 'success';
        } else {
            $data0['status'] = 'error';
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
    }
}