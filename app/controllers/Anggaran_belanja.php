<?php
defined('BASEPATH') or exit('No direct script access allowed');

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Anggaran_belanja extends User_Controller
{
	private $idAnggaranBelanja;

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Anggaran_belanja_model', 'model');
		$this->setGet('idAnggaranBelanja', $this->input->post('idAnggaranBelanja'));
	}

	public function index()
	{
		$data['title']          = 'Anggaran Belanja';
		$data['subtitle']       = lang('list');
		$data['content']        = 'Anggaran_belanja/index';
		$data['total_nominal']  = $this->model->hitungJumlahNominal();	
		$data                   = array_merge($data, path_info());
		$this->parser->parse('template', $data);
	}

	public function index_datatable()
	{
		$perusahaan	= $this->session->idperusahaan;
		$this->load->library('Datatables');
		$this->datatables->select('tanggaranbelanja.*,mperusahaan.*, mdepartemen.nama as namaDepartemen');
		$this->datatables->join('mperusahaan','tanggaranbelanja.idperusahaan = mperusahaan.idperusahaan');
		$this->datatables->join('mdepartemen','tanggaranbelanja.dept = mdepartemen.id');
		$this->datatables->where('tanggaranbelanja.stdel', '0');
		if ($perusahaan) {
			$this->datatables->where('tanggaranbelanja.idperusahaan', $perusahaan);
		}
		$this->datatables->from('tanggaranbelanja');
		return print_r($this->datatables->generate());
	}

	public function create()
	{
		$data['title']    = 'Anggaran Belanja';
		$data['subtitle'] = 'Tambah';
		$data['content']	= 'Anggaran_belanja/create';
		$data				      = array_merge($data, path_info());
		$data['uraian']		= $this->model->uraianAll();
		$data['satuan']		= $this->model->satuanAll();
		$this->parser->parse('template', $data);
	}

	public function edit()
	{
		if ($this->idAnggaranBelanja) {
			$this->model->setGet('idAnggaranBelanja', $this->idAnggaranBelanja);
			$data = $this->model->get();
			if ($data) {
				$data['title']		= 'Anggaran Belanja';
				$data['subtitle']	= lang('edit');
				$data['uraian']		= $this->model->uraianAll();
				$data['satuan']		= $this->model->satuanAll();
				$data['content']	= 'Anggaran_belanja/edit';
				$data             = array_merge($data, path_info());
				$this->parser->parse('template', $data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save()
	{
		$this->model->save();
	}

	public function delete()
	{
		$this->model->delete();
	}

	public function add_rekeningitem()
	{

		$this->db->select('id');
		$this->db->limit(1);
		$this->db->order_by('id', 'desc');
		$data = $this->db->get('tanggaranbelanja')->row_array();
		$items = $_POST['items'];
		$idanggaran = $data['id'];
		for ($i = 0; $i < count($items); $i++) {
			$this->db->set('nominal', $items[$i]['jumlah']);
			$this->db->set('koderekening', $items[$i]['koderekening']);
			$this->db->set('uraian', $items[$i]['uraian']);
			$this->db->set('volume', $items[$i]['volume']);
			$this->db->set('satuan', $items[$i]['satuan']);
			$this->db->set('tarif', $items[$i]['tarif']);
			$this->db->set('jumlah', $items[$i]['jumlah']);
			$this->db->set('keterangan', $items[$i]['keterangan']);
			$this->db->where('id', $idanggaran);
			$this->db->update('tanggaranbelanja');
		}	
	}

	public function update_rekeningitem()
	{
		$items = $_POST['items'];
		$idanggaran = $_POST['idanggaran'];

		$this->db->where('idanggaran', $idanggaran);
		$this->db->delete('tanggaranbelanjadetail');


		$nominal = 0;
		for ($i = 0; $i < count($items); $i++) {
			$this->db->set('idanggaran', $idanggaran);
			$this->db->insert('tanggaranbelanjadetail', $items[$i]);
			$nominal += $items[$i]['jumlah'];
		}
		$this->db->set('nominal', $nominal);
		$this->db->where('id', $idanggaran);
		$this->db->update('tanggaranbelanja');
	}

	public function get_rekitem($id)
	{
		$this->db->select('tanggaranbelanjadetail.*, mnoakun.idakun');
		$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
		$this->db->join('mcabang', 'tanggaranbelanjadetail.cabang = mcabang.id');
		$this->db->where('idanggaran', $id);
		$this->db->order_by('koderekening', 'asc');
		$data = $this->db->get('tanggaranbelanjadetail')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function get_rekeningbelanja()
	{
		$this->db->select('*');		
		$this->db->like('mnoakun.akunno', '1', 'after');
		$this->db->or_like('mnoakun.akunno', '5', 'after');
		$this->db->or_like('mnoakun.akunno', '6', 'after');
		$data = $this->db->get('mnoakun')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function getKategori($id = null){
		$this->db->select('mkategori.id,mkategori.nama as text');
		$data=$this->db->get('mkategori')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	
	}
	public function select2_satuan($id = null)
    {
        $term = $this->input->get('q');
		$this->db->select('mdepartemen.id, mdepartemen.nama as text');
		$this->db->where('mdepartemen.sdel', '0');
		$this->db->limit(100);
		if($term) $this->db->like('id', $term);
		if($id) $data = $this->db->where('id', $id)->get('mdepartemen')->row_array();
		else $data = $this->db->get('mdepartemen')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function select_uraian($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mitem.id, mitem.nama as text');
			$data = $this->db->where('id', $id)->get('mitem')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('mitem.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mitem.nama', $term);
			$data = $this->db->get('mitem')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mpegawaihakakses($id = null)
	{
		$term = $this->input->get('q');
		if ($id) {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$data = $this->db->where('id', $id)->get('mpegawaihakakses')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
			$this->db->where('mpegawaihakakses.stdel', '0');
			$this->db->limit(10);
			if ($term) $this->db->like('mpegawaihakakses', $term);
			$data = $this->db->get('mpegawaihakakses')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_tanggaranbelanja($id = null)
	{

		$this->db->select('tanggaranbelanja.id, tanggaranbelanja.dept as text');
		$this->db->limit(10);
		$data = $this->db->get('tanggaranbelanja')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function select2_mperusahaan($id = null)
	{
		if ($id) {
			$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
			$data = $this->db->where('idperusahaan', $id)->get('mperusahaan')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mperusahaan.idperusahaan as id, mperusahaan.nama_perusahaan as text');
			$this->db->limit(10);
			$data = $this->db->get('mperusahaan')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mdepartemen($id = null, $text = null)
	{
    $term = $this->input->get('term');
		if ($term) {
			$this->db->select('mdepartemen.id as id, mdepartemen.nama as text');
      $this->db->where('mdepartemen.id', $id);
      $this->db->like('mdepartemen.nama', $term);
			$data = $this->db->get('mdepartemen')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.id as id, mdepartemen.nama as text');
			$this->db->where('mdepartemen.id_perusahaan', $id);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_mdepartemen_pejabat($dept = null, $text = null)
	{
		if ($text) {
			$this->db->select('tanggaranbelanja.pejabat as id, tanggaranbelanja.pejabat as text');
			$this->db->where('tanggaranbelanja.dept', $dept);
			$this->db->where('tanggaranbelanja.pejabat', $text);
			$data = $this->db->get('tanggaranbelanja')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mdepartemen.pejabat as id, mdepartemen.pejabat as text');
			$this->db->where('mdepartemen.id', $dept);
			$this->db->limit(10);
			$data = $this->db->get('mdepartemen')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}
	
	public function printpdf($jenis = null, $id = null) {
		$data['anggaranbelanja']	= $this->model->get_by_id($id);
		switch ($jenis) {
			case 'pdf':
				$this->load->library('pdf');
				$pdf						= $this->pdf;
				$data['anggaranbelanja']	= $this->model->get_by_id($id);
				$data['title'] 				= lang('anggaran_belanja');
				$data['css'] 				= file_get_contents(FCPATH.'assets/css/print.min.css');
				$data 						= array_merge($data,path_info());
				$html 						= $this->load->view('Anggaran_belanja/printpdf', $data, TRUE);
				$pdf->loadHtml($html);
				$pdf->setPaper('A4', 'landscape');
				$pdf->render();
				$time = time();
				$pdf->stream("anggaran-belanja-". $time, array("Attachment" => false));
				break;

			case 'excel':
				$spreadsheet	= \PhpOffice\PhpSpreadsheet\IOFactory::load('assets/Form Anggaran 2020.xls');
				$worksheet		= $spreadsheet->getActiveSheet();

				$no = 0;
				$x	= 9;
                for ($i=0; $i < count($data['anggaranbelanja']); $i++) { 
                    if ($i == 0 || ($data['anggaranbelanja'][$i]['koderekening'] !== $data['anggaranbelanja'][$no]['koderekening'])) {
						$worksheet->getCell('A' . $x)->setValue($data['anggaranbelanja'][$i]['koderekening']);
						$worksheet->getCell('B' . $x)->setValue($data['anggaranbelanja'][$i]['namaakun']);
						$worksheet->getCell('C' . $x)->setValue('');
						$worksheet->getCell('D' . $x)->setValue('');
						$worksheet->getCell('E' . $x)->setValue('');
						$worksheet->getCell('F' . $x)->setValue('Rp. ' . number_format($data['anggaranbelanja'][$i]['totalsemua'],2,',','.'));
						$worksheet->getCell('G' . $x)->setValue('');
						$x++;
                        for ($j=0; $j < count($data['anggaranbelanja']); $j++) { 
                            if ($data['anggaranbelanja'][$j]['koderekening'] == $data['anggaranbelanja'][$i]['koderekening']) { 
								$worksheet->getCell('A' . $x)->setValue('');
								$worksheet->getCell('B' . $x)->setValue($data['anggaranbelanja'][$j]['namabarang']);
								$worksheet->getCell('C' . $x)->setValue($data['anggaranbelanja'][$j]['volume']);
								$worksheet->getCell('D' . $x)->setValue('Rp. ' . number_format($data['anggaranbelanja'][$j]['tarif'],2,',','.'));
								$worksheet->getCell('E' . $x)->setValue($data['anggaranbelanja'][$j]['satuan']);
								$worksheet->getCell('F' . $x)->setValue('Rp. ' . number_format($data['anggaranbelanja'][$j]['total'],2,',','.'));
								$worksheet->getCell('G' . $x)->setValue('');
							}
							$x++;
                        }
                        $no = $i;
                    }
                }
				$writer = new Xlsx($spreadsheet);
				$filename = 'laporan-anggaran-belanja';
				
				header('Content-Type: application/vnd.ms-excel');
				header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
				header('Cache-Control: max-age=0');
		
				$writer->save('php://output');
				break;
			
			default:
				# code...
				break;
		}
	}

	private function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
	}

	public function gantiUraian()
	{
		$data	= $this->db->get('tanggaranbelanjadetail')->result_array();
		foreach ($data as $key) {
			// print_r($key['uraian']);echo ' -> ';
			$uraian	= $this->db->get_where('mitem', [
				'kode'	=> $key['uraian']
			])->row_array();
			// print_r($uraian['id']);echo '<br/>';
			if ($uraian) {
				$this->db->where('id', $key['id']);
				$this->db->update('tanggaranbelanjadetail', [
					'uraian'	=> $uraian['id']
				]);
			} else {
        print_r($key['uraian']);echo '<br/>';
      }
		}
	}
}
