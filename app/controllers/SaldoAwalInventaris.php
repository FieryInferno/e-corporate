<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalInventaris extends User_Controller {

    private $title  = 'Saldo Awal Inventaris';
    private $perusahaan;             
    private $kodeInventaris;
    private $noRegister;
    private $kelompok;
    private $tahunPerolehan;
    private $keterangan;
    private $lokasi;
    private $kondisi;
    private $nilaiBuku;
    private $idSaldoAwalInventaris;
    private $namaInventaris;

	public function __construct() {
        parent::__construct();
        $this->idSaldoAwalInventaris    = $this->input->post('idSaldoAwalInventaris');
        $this->kodeInventaris           = $this->input->post('kodeInventaris');
        $this->noRegister               = $this->input->post('noRegister');
        $this->kelompok                 = $this->input->post('kelompok');
        $this->perusahaan               = $this->input->post('perusahaan');
        $this->tahunPerolehan           = $this->input->post('tahunPerolehan');
        $this->keterangan               = $this->input->post('keterangan');
        $this->lokasi                   = $this->input->post('lokasi');
        $this->kondisi                  = $this->input->post('kondisi');
        $this->nilaiBuku                = $this->input->post('nilaiBuku');
        $this->namaInventaris           = $this->input->post('namaInventaris');
	}

	public function index() {
		$data['title']      = $this->title;
		$data['subtitle']   = lang('list');
		$data['content']    = 'SaldoAwalInventaris/index';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }
    
    public function create()
    {
        $data['title']      = $this->title;
		$data['subtitle']   = 'Tambah';
		$data['content']    = 'SaldoAwalInventaris/create';
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
		$this->form_validation->set_rules('kodeInventaris', 'Kode Inventaris', 'required|trim');
		$this->form_validation->set_rules('noRegister', 'No. Register', 'required|trim|numeric');
        $this->form_validation->set_rules('tahunPerolehan', 'Tahun Perolehan', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim');
		$this->form_validation->set_rules('lokasi', 'Lokasi', 'required|trim');
		$this->form_validation->set_rules('kondisi', 'Kondisi', 'trim');
        $this->form_validation->set_rules('nilaiBuku', 'Nilai Buku', 'required|trim');
        $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'trim');
    }

    public function indexDatatable()
    {
        $perusahaan = $this->session->idperusahaan;
        $data       = $this->SaldoAwalInventarisModel->indexDatatable($perusahaan);
        return print_r($data);
    }

    public function save()
    {
        $this->validation();
        if ($this->form_validation->run()) {
            $this->SaldoAwalInventarisModel->setGet('kodeInventaris', $this->kodeInventaris);
            $this->SaldoAwalInventarisModel->setGet('noRegister', $this->noRegister);
            $this->SaldoAwalInventarisModel->setGet('kelompok', $this->kelompok);
            $this->SaldoAwalInventarisModel->setGet('tahunPerolehan', $this->tahunPerolehan);
            $this->SaldoAwalInventarisModel->setGet('keterangan', $this->keterangan);
            $this->SaldoAwalInventarisModel->setGet('lokasi', $this->lokasi);
            $this->SaldoAwalInventarisModel->setGet('kondisi', $this->kondisi);
            $this->SaldoAwalInventarisModel->setGet('nilaiBuku', $this->nilaiBuku);
            $this->SaldoAwalInventarisModel->setGet('perusahaan', $this->perusahaan);
            $this->SaldoAwalInventarisModel->setGet('idSaldoAwalInventaris', $this->idSaldoAwalInventaris);
            $this->SaldoAwalInventarisModel->setGet('namaInventaris', $this->namaInventaris);
            $data   = $this->SaldoAwalInventarisModel->save();
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
        $this->SaldoAwalInventarisModel->setGet('idSaldoAwalInventaris', $this->idSaldoAwalInventaris);
        $data               = $this->SaldoAwalInventarisModel->get();
        $data['title']      = $this->title;
		$data['subtitle']   = 'Edit';
        $data['content']    = 'SaldoAwalInventaris/edit';
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
    }

    public function delete()
    {
        $this->SaldoAwalInventarisModel->setGet('idSaldoAwalInventaris', $this->idSaldoAwalInventaris);
        $data   = $this->SaldoAwalInventarisModel->delete();
        if ($data) {
            $data0['status'] = 'success';
        } else {
            $data0['status'] = 'error';
        }
        return $this->output->set_content_type('application/json')->set_output(json_encode($data0));
    }
}