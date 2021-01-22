<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Inventaris extends User_Controller {

	private $perusahaan;

	public function __construct() {
		parent::__construct();
		$this->load->model('Inventaris_model','model');
		$this->perusahaan	= $this->input->get('perusahaan');
	}

	public function index() {
		$data['title']		= 'Daftar Inventaris';
		$data['subtitle']	= lang('list');
		$data['content']	= 'Inventaris/index';
		$this->model->set('perusahaan', $this->perusahaan);
		$data['inventaris']	= $this->model->get();
		$data				= array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tinventaris.*, mperusahaan.nama_perusahaan as nama_perusahaan');
		$this->datatables->join('mperusahaan', 'mperusahaan.idperusahaan=tinventaris.idperusahaan');
		$this->datatables->from('tinventaris');
		return print_r($this->datatables->generate());
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id_inventaris',$id,'tinventaris');
			if($data) {
				$data['title'] = 'Daftar Inventaris';
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Inventaris/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save($id) {
		$this->model->save($id);
	}

	public function delete() {
		$this->model->delete();
	}

	public function pemeliharaanAset()
	{
		$data['title']		= 'Pemeliharaan Aset';
		$data['subtitle']	= lang('list');
		$data['content']	= 'Inventaris/pemeliharaanAset/index';
		$data             = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function tambahPemeliharaanAset()
	{
		$data['title']		  = 'Pemeliharaan Aset';
		$data['subtitle']	  = 'Tambah';
		$data['content']	  = 'Inventaris/pemeliharaanAset/tambah';
		$data['inventaris'] = $this->model->get();
		$data				        = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function editPemeliharaanAset($idPemeliharaan)
	{
    $data                 = $this->model->getPemeliharaan($idPemeliharaan);
		$data['title']		    = 'Pemeliharaan Aset';
		$data['subtitle']	    = 'Edit';
		$data['content']	    = 'Inventaris/pemeliharaanAset/edit';
    $data['inventaris']   = $this->model->get();
		$data				          = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function editMutasiAset($idMutasi)
	{
    $data                 = $this->model->getMutasi($idMutasi);
		$data['title']		    = 'Mutasi Aset';
		$data['subtitle']	    = 'Edit';
		$data['content']	    = 'Inventaris/mutasiAset/edit';
    $data['inventaris']   = $this->model->get();
		$data				          = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function get()
	{
		$data	= $this->model->get();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
  }
  
  public function simpanPemeliharaanAset($idPemeliharaan = null)
  {
    $this->validation();
    if ($this->form_validation->run() !== false) {
      $data = $this->model->simpanPemeliharaanAset($idPemeliharaan);
      if ($data) {
        $hasil['status'] = 'success';
      } else {
        $hasil['status'] = 'fail';
      }
    } else {
      $hasil['status'] = 'fail';
    }
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
  }

  private function validation()
  {
    $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
    $this->form_validation->set_rules('jenisAset', 'Jenis Aset', 'required');
    $this->form_validation->set_rules('jenisPemeliharaan', 'Jenis Pemeliharaan', 'required');
    $this->form_validation->set_rules('noDokumen', 'No Dokumen', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    $this->form_validation->set_rules('kodeBarang[]', 'Kode Barang', 'required');
  }

  private function validationMutasi()
  {
    $this->form_validation->set_rules('jenisInventaris', 'Jenis Inventaris', 'required');
    $this->form_validation->set_rules('noSuratKeputusan', 'No. Surat Keputusan', 'required');
    $this->form_validation->set_rules('tanggalSuratKeputusan', 'Tanggal Surat Keputusan', 'required');
    $this->form_validation->set_rules('perusahaanPenerima', 'Perusahaan Penerima', 'required');
    $this->form_validation->set_rules('perusahaanAsal', 'Perusahaan Asal', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    $this->form_validation->set_rules('kodeBarang[]', 'Kode Barang', 'required');
  }

  public function dataPemeliharaanAset()
  {
    $perusahaan = $this->input->get('perusahaan');
    $data       = $this->model->dataPemeliharaanAset($perusahaan);
    return print_r($data);
  }

	public function mutasiAset()
	{
		$data['title']		= 'Mutasi Aset';
		$data['subtitle']	= lang('list');
		$data['content']	= 'Inventaris/mutasiAset/index';
		$data             = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function tambahMutasiAset()
	{
		$data['title']		  = 'Mutasi Aset';
		$data['subtitle']	  = 'Tambah';
		$data['content']	  = 'Inventaris/mutasiAset/tambah';
		$data['inventaris']	= $this->model->get();
		$data               = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
  
  public function simpanMutasiAset()
  {
    $this->validationMutasi();
    if ($this->form_validation->run() !== false) {
      $data = $this->model->simpanMutasiAset();
      if ($data) {
        $hasil['status'] = 'success';
      } else {
        $hasil['status'] = 'fail';
      }
    } else {
      $hasil['status'] = 'fail';
    }
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
  }

  public function dataMutasiAset()
  {
    $data = $this->model->dataMutasiAset();
    return print_r($data);
  }

	public function penghapusanAset()
	{
		$data['title']		= 'Penghapusan Aset';
		$data['subtitle']	= lang('list');
		$data['content']	= 'Inventaris/penghapusanAset/index';
		$data             = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

  public function dataPenghapusanAset()
  {
    $data = $this->model->dataPenghapusanAset();
    return print_r($data);
  }

	public function tambahPenghapusanAset()
	{
		$data['title']		  = 'Penghapusan Aset';
		$data['subtitle']	  = 'Tambah';
		$data['content']	  = 'Inventaris/penghapusanAset/tambah';
		$data['inventaris'] = $this->model->get();
		$data				        = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}
  
  public function simpanPenghapusanAset()
  {
    $this->validationPenghapusan();
    if ($this->form_validation->run() !== false) {
      $data = $this->model->simpanPenghapusanAset();
      if ($data) {
        $hasil['status'] = 'success';
      } else {
        $hasil['status'] = 'fail';
      }
    } else {
      $hasil['status'] = 'fail';
    }
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
  }

  private function validationPenghapusan()
  {
    $this->form_validation->set_rules('perusahaan', 'Perusahaan', 'required');
    $this->form_validation->set_rules('noSk', 'No. Surat Keputusan', 'required');
    $this->form_validation->set_rules('tanggalSk', 'Tanggal Surat Keputusan', 'required');
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
    $this->form_validation->set_rules('kodeBarang[]', 'Kode Barang', 'required');
  }

  public function hapusPemeliharaanAset($idPemeliharaan)
  {
    $this->model->hapusPemeliharaanAset($idPemeliharaan);
    $hasil['status'] = 'success';
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
  }

  public function konfigurasiPenyusutan()
  {
		$data['title']		  = 'Konfigurasi Penyusutan';
		$data['subtitle']	  = 'Daftar';
		$data['content']	  = 'Inventaris/konfigurasiPenyusutan/index';
		$data				        = array_merge($data,path_info());
		$this->parser->parse('template',$data);
  }

  public function tambahKonfigurasiPenyusutan()
  {
		$data['title']		  = 'Konfigurasi Penyusutan';
		$data['subtitle']	  = 'Tambah';
		$data['content']	  = 'Inventaris/konfigurasiPenyusutan/tambah';
		$data				        = array_merge($data,path_info());
		$this->parser->parse('template',$data);
  }
  
  public function simpanKonfigurasiPenyusutan()
  {
    $this->validationKonfigurasiPenyusutan();
    if ($this->form_validation->run() !== false) {
      $data = $this->model->simpanKonfigurasiPenyusutan();
      if ($data) {
        $hasil['status'] = 'success';
      } else {
        $hasil['status'] = 'fail';
      }
    } else {
      $hasil['status'] = 'fail';
    }
		$this->output->set_content_type('application/json')->set_output(json_encode($hasil));
  }

  private function validationKonfigurasiPenyusutan()
  {
    $this->form_validation->set_rules('barang', 'Barang', 'required');
    $this->form_validation->set_rules('masaManfaat', 'Masa Manfaat', 'required');
    $this->form_validation->set_rules('batasKapitalisasi', 'Batas Kapitalisasi', 'required');
    $this->form_validation->set_rules('tambahanMasaManfaat', 'Tambahan Masa Manfaat', 'required');
    $this->form_validation->set_rules('prosentasiPenyusutan', 'Prosentasi Penyusutan', 'required');
  }

  public function dataKonfigurasiPenyusutan()
  {
    $data = $this->model->dataKonfigurasiPenyusutan();
    return print_r($data);
  }
}