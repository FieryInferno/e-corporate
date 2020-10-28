<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalHutang extends User_Controller {

    private $title  = 'Saldo Awal Hutang';
    private $namaPemasok;

	public function __construct() {
        parent::__construct();
        $this->validation();
        if ($this->form_validation->run()) {
            $this->setGet('namaPemasok', $this->input->post('namaPemasok'));
            $this->setGet('tanggal', $this->input->post('tanggal'));
            $this->setGet('noInvoice', $this->input->post('namaPemasok'));
            $this->setGet('namaPemasok', $this->input->post('namaPemasok'));
        } else {
            switch ($this->uri->segment('2')) {
                case 'create':
                    $this->create();
                    break;
                case 'edit':
                    $this->edit();
                    break;
                
                default:
                    # code...
                    break;
            }
        }
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
        $this->form_validation->set_rules('namaPemasok', 'Nama Pemasok', 'required');
		$this->form_validation->set_rules('tanggal', 'Tanggal', 'required|');
		$this->form_validation->set_rules('noInvoice', 'No. Invoice', 'required|trim');
		$this->form_validation->set_rules('nilaiHutang', 'Nilai Hutang', 'required|trim');
    }

    public function indexDatatable()
    {
        $data   = $this->SaldoAwalHutangModel->indexDatatable();
        return print_r($data);
    }
}