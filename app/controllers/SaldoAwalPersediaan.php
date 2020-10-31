<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalPersediaan extends User_Controller {

    private $title  = 'Saldo Awal Persediaan';
    private $kodeBarang;
    private $perusahaan;
    private $gudang;
    private $noAkun;
    private $jumlah;
    private $hargaPokok;
    private $idSaldoAwalPersediaan;

	public function __construct() {
        parent::__construct();
        $this->setGet('idSaldoAwalPersediaan', $this->input->post('idSaldoAwalPersediaan'));
        $this->setGet('kodeBarang', $this->input->post('kodeBarang'));
        $this->setGet('perusahaan', $this->input->post('perusahaan'));
        $this->setGet('gudang', $this->input->post('gudang'));
        $this->setGet('noAkun', $this->input->post('noAkun'));
        $this->setGet('jumlah', $this->input->post('jumlah'));
        $this->setGet('hargaPokok', $this->input->post('hargaPokok'));
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
		$this->form_validation->set_rules('kodeBarang', 'Kode Barang', 'required|trim');
		$this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
        $this->form_validation->set_rules('gudang', 'Gudang', 'required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'required');
		$this->form_validation->set_rules('hargaPokok', 'Harga Pokok', 'required|trim');
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
            $this->SaldoAwalPersediaanModel->setGet('kodeBarang', $this->kodeBarang);
            $this->SaldoAwalPersediaanModel->setGet('perusahaan', $this->perusahaan);
            $this->SaldoAwalPersediaanModel->setGet('gudang', $this->gudang);
            $this->SaldoAwalPersediaanModel->setGet('noAkun', $this->noAkun);
            $this->SaldoAwalPersediaanModel->setGet('jumlah', $this->jumlah);
            $this->SaldoAwalPersediaanModel->setGet('hargaPokok', $this->hargaPokok);
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