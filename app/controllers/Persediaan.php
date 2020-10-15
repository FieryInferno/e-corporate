<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Persediaan extends User_Controller {

	public function index()
	{
		$data['title']      = 'Persediaan';
		$data['content']    = 'Persediaan/index';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
    }
    
    public function tambah()
    {
        $data['title']      = 'Set Up Jurnal';
        $data['subtitle']   = 'Tambah';
		$data['content']    = 'SetUpJurnal/tambah';	
		$data               = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}
	
	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tPenerimaanDetail.idDetailPenerimaan as id, mitem.kode, mitem.nama as namaBarang, msatuan.nama as namaSatuan, mkategori.nama as namaKategori, mitem.hargabeliterakhir, tPenerimaanDetail.jumlah as masuk');
		$this->datatables->join('tpemesanandetail','tPenerimaanDetail.idPemesananDetail = tpemesanandetail.id');
		$this->datatables->join('tanggaranbelanjadetail','tpemesanandetail.itemid = tanggaranbelanjadetail.id');
		$this->datatables->join('mitem','tanggaranbelanjadetail.uraian = mitem.id');
		$this->datatables->join('msatuan','mitem.satuanid = msatuan.id');
		$this->datatables->join('mkategori','mitem.kategoriid = mkategori.id');
		$this->datatables->like('tanggaranbelanjadetail.koderekening', '1.1.3', 'after');
		$this->datatables->or_like('tanggaranbelanjadetail.koderekening', '113', 'after');
		$this->datatables->from('tPenerimaanDetail');
		return print_r($this->datatables->generate());
	}

}