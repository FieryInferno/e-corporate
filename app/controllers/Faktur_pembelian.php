<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/** 
* =================================================
* @package	CGC (CODEIGNITER GENERATE CRUD)
* @author	isyanto.id@gmail.com
* @link	https://isyanto.com
* @since	Version 1.0.0
* @filesource
* ================================================= 
*/

use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Faktur_pembelian extends User_Controller {

	private $id;

	public function __construct() {
		parent::__construct();
		$this->load->model('Faktur_pembelian_model','model');
		$this->setGet('id', $this->input->post('id'));
	}

	public function index() {
		$data['title'] = lang('invoice');
		$data['subtitle'] = lang('list');
		$data['content'] = 'Faktur_pembelian/index';
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);
	}

	public function index_datatable() {
		$this->load->library('Datatables');
		$this->datatables->select('tfaktur.id, tfaktur.notrans,  mperusahaan.nama_perusahaan as namaperusahaan,  tfaktur.tanggal, mkontak.nama as rekanan, mgudang.nama as gudang, mkontak.nama as supplier, tfaktur.biayapengiriman as biaya_pengiriman, tfaktur.total as total, tfaktur.status as status, tfaktur.ppn as pajak, tfaktur.biayapengiriman');
		$this->datatables->join('mkontak','tfaktur.kontakid = mkontak.id','left');
		$this->datatables->join('mgudang','tfaktur.gudangid = mgudang.id','left');
		$this->datatables->join('mperusahaan','tfaktur.perusahaanid = mperusahaan.idperusahaan','left');
		// $this->datatables->where('tfaktur.tipe','1');
		$this->datatables->from('tfaktur');
		return print_r($this->datatables->generate());
	}

	public function detail() {
		$id	= $this->setGet('id');
		if($id) {
			$data = $this->model->getfaktur($id);
			if($data) {
				$data['kontak'] = get_by_id('id',$data['kontakid'],'mkontak');
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['fakturdetail'] = $this->model->fakturdetail($data['id']);
				$data['title'] = lang('invoice');
				$data['subtitle'] = lang('detail');
				$data['content'] = 'Faktur_pembelian/detail';
				$data = array_merge($data,path_info());
				$this->parser->parse('template',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function create() {
		$data['tanggal'] = date('Y-m-d');
		$data['content'] = 'Faktur_pembelian/create';
		$data['title'] = lang('invoice');
		$data['subtitle'] = lang('add_new');
		$data = array_merge($data,path_info());
		$this->parser->parse('template',$data);	
	}

	public function edit($id = null) {
		if($id) {
			$data = get_by_id('id',$id,'tfaktur');
			if($data) {
				$data['title'] = lang('invoice');
				$data['subtitle'] = lang('edit');
				$data['content'] = 'Faktur_pembelian/edit';
				$data = array_merge($data,path_info());
				$this->parser->parse('default',$data);
			} else {
				show_404();
			}
		} else {
			show_404();
		}
	}

	public function save() {
		$this->model->save();
	}

	public function delete() {
		$this->model->delete();
	}

	// additional
	public function cekjumlahinput() {
		$this->model->cekjumlahinput();
	}

	public function detailitem() {
		$this->model->detailitem();
	}
	
	public function select2_kontak($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$data = $this->db->where('id', $id)->get('mkontak')->row_array();
			$this->db->where('mkontak.tipe', '1');
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mkontak.id, mkontak.nama as text');
			$this->db->where('mkontak.stdel', '0');
			$this->db->where('mkontak.tipe', '1');
			$this->db->limit(10);
			if($term) $this->db->like('mkontak', $term);
			$data = $this->db->get('mkontak')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_gudang($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mgudang.id, mgudang.nama as text');
			$data = $this->db->where('id', $id)->get('mgudang')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mgudang.id, mgudang.nama as text');
			$this->db->where('mgudang.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('mgudang', $term);
			$data = $this->db->get('mgudang')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function select2_item($id = null) {
		$term = $this->input->get('q');
		if($id) {
			$this->db->select('mitem.id, mitem.nama as text');
			$data = $this->db->where('id', $id)->get('mitem')->row_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		} else {
			$this->db->select('mitem.id, mitem.nama as text');
			$this->db->where('mitem.stdel', '0');
			$this->db->limit(10);
			if($term) $this->db->like('nama', $term);
			$data = $this->db->get('mitem')->result_array();
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function get_detail_item() {
		$this->model->get_detail_item();
	}

	public function printpdf($jenis = null, $id = null) {
		switch ($jenis) {
			case 'pdf':
				$data = $this->model->getfaktur($id);
				$data['gudang'] = get_by_id('id',$data['gudangid'],'mgudang');
				$data['faktur']	= $this->model->get($id);
				$data['title'] = 'FAKTUR PEMBELIAN';
				$data['css'] = file_get_contents(FCPATH.'assets/css/print.min.css');
				$data = array_merge($data,path_info());
				ob_start();
					$this->load->view('Faktur_pembelian/printpdf', $data);
					$html = ob_get_contents();
				ob_end_clean();
				// ob_clean();
				$options  	= new Options();
				$options->set('isRemoteEnabled', TRUE);
				$pdf = new Dompdf($options);
				$pdf->loadHtml($html);
				$pdf->setPaper('A4', 'portrait');
				$pdf->render();
				$time = time();
				$pdf->stream("faktur-pembelian-". $time, array("Attachment" => false));
				break;

			case 'excel':
				$data['faktur']	= $this->model->get($id);
				$spreadsheet	= \PhpOffice\PhpSpreadsheet\IOFactory::load('assets/Format Faktur Pembelian.xlsx');
				$worksheet		= $spreadsheet->getActiveSheet();
				$worksheet->getCell('F1')->setValue($data['faktur']['namaperusahaan']);
				$worksheet->getCell('F2')->setValue($data['faktur']['alamat']);
				$worksheet->getCell('Q6')->setValue($data['faktur']['tanggal']);
				$worksheet->getCell('S6')->setValue($data['faktur']['notrans']);
				$no 		= 0;
				$x			= 15;
				$subtotal	= 0;
				$diskon		= 0;
				foreach ($data['faktur']['detail'] as $key) {
					$subtotal	+= (integer) $key['subtotal'];
					$diskon		+= (integer) $key['diskon'];
					$worksheet->getCell('A' . $x)->setValue($key['namaakun']);
					$worksheet->getCell('F' . $x)->setValue('Rp. ' . number_format($key['total'],2,',','.'));
					$worksheet->getCell('K' . $x)->setValue($key['catatan']);
					$worksheet->getCell('P' . $x)->setValue($key['departemen']);
					$worksheet->getCell('S' . $x)->setValue('');
					$x++;
				}
				$worksheet->getCell('B45')->setValue(penyebut($subtotal) . ' Rupiah');
				$worksheet->getCell('S45')->setValue('Rp. ' . number_format($subtotal,2,',','.'));
				$worksheet->getCell('S46')->setValue('Rp. ' . number_format($diskon,2,',','.'));
				$worksheet->getCell('S48')->setValue('Rp. ' . number_format(($subtotal + $diskon),2,',','.'));
				$writer = new Xlsx($spreadsheet);
				$filename = 'Report Faktur Pembelian';
				
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

	public function validasi($status= null, $id = null)
	{
		$this->db->set('cby',get_user('username'));
		$this->db->set('cdate',date('Y-m-d H:i:s'));
		switch ($status) {
			case '0':
				$this->db->set('status','3');
				break;
			case '1':
				$this->db->set('status','1');
				break;
				# code...
				break;
		}
		$this->db->where('id', $id);
		$update = $this->db->update('tfaktur');
		if($update) {
			$data['status'] = 'success';
			$data['message'] = lang('update_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('update_error_message');
		}
		redirect(base_url('faktur_pembelian'));	
	}

	private function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
	}
}

