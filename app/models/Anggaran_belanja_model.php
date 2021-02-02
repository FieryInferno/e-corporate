<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Anggaran_belanja_model extends CI_Model
{

	private $idAnggaranBelanja;

	public function save()
	{
		$nominal  = 0;
		for ($i=0; $i < count($this->input->post('jumlah')); $i++) { 
			$nominal	+= (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jumlah')[$i]);
		}
		
		if ($this->input->post('idAnggaranBelanja')) {
			$id_anggaran	= $this->input->post('idAnggaranBelanja');
		} else {
			$id_anggaran	= uniqid('AB');
    }
    
		$data_anggaran	= [
			'id'			      => $id_anggaran,
			'idperusahaan'	=> $this->input->post('idperusahaan'),
			'dept'			    => $this->input->post('dept'),
			'pejabat'		    => $this->input->post('pejabat'),
			'thnanggaran'	  => $this->input->post('thnanggaran'),
			'tglpengajuan'	=> $this->input->post('tglpengajuan'),
			'nominal'		    => $nominal,
			'cby'			      => get_user('username'),
			'cdate'			    => date('Y-m-d H:i:s')
    ];
    
		if ($this->input->post('idAnggaranBelanja')) {
			$this->db->where('tanggaranbelanja.id', $id_anggaran);
			$insert	= $this->db->update('tanggaranbelanja', $data_anggaran);
		} else {
			$insert	= $this->db->insert('tanggaranbelanja', $data_anggaran);
    }
    
		if ($insert) {
			if ($this->input->post('idAnggaranBelanja')) {
				$this->db->where('idanggaran', $id_anggaran);
				$insert	= $this->db->delete('tanggaranbelanjadetail');
      }
      
			for ($i=0; $i < count($this->input->post('kode_rekening')); $i++) { 
				$this->db->insert('tanggaranbelanjadetail', [
					'id'			      => uniqid('ABD'),
					'idanggaran'	  => $id_anggaran,
					'koderekening'  => $this->input->post('kode_rekening')[$i],
					'uraian'		    => $this->input->post('uraian')[$i],
					'cabang'		    => $this->input->post('cabang')[$i],
					'volume'		    => $this->input->post('volume')[$i],
					'satuan'		    => $this->input->post('satuan')[$i],
					'tarif'			    => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('tarif')[$i]),
					'jumlah'		    => (integer) preg_replace("/(Rp. |,00|[^0-9])/", "", $this->input->post('jumlah')[$i]),
					'keterangan'	  => $this->input->post('keterangan')[$i]
				]);
      }
      
			$data['status'] = 'success';
			$data['message'] = lang('save_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('save_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete()
	{
		$id = $this->uri->segment(3);
		$this->db->set('stdel', '1');
		$this->db->where('id', $id);
		$update = $this->db->update('tanggaranbelanja');
		if ($update) {
			$data['status'] = 'success';
			$data['message'] = lang('delete_success_message');
		} else {
			$data['status'] = 'error';
			$data['message'] = lang('delete_error_message');
		}
		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}
	public function hitungJumlahNominal()
	{
		$this->db->select_sum('nominal');
		$this->db->where('stdel','0');
		$query = $this->db->get('tanggaranbelanja');
		if($query->num_rows()>0)
		{
			return $query->row()->nominal;
		}
		else
		{
			return 0;
		}
	}

	function uraianAll()
    {
        $query = $this->db->query('SELECT id, nama FROM mitem where stdel=0');
        return $query->result();
    }
	function satuanAll()
    {
        $query = $this->db->query('SELECT id, nama FROM msatuan where stdel=0');
        return $query->result();
	}
	
	public function get_by_id($id)
	{
		$this->db->select('tanggaranbelanjadetail.koderekening, mnoakun.namaakun, mitem.nama as namabarang, tanggaranbelanjadetail.jumlah as total, tanggaranbelanjadetail.volume, tanggaranbelanjadetail.tarif, tanggaranbelanjadetail.satuan, mnoakun.akunno');
		$this->db->join('tanggaranbelanjadetail', 'tanggaranbelanja.id = tanggaranbelanjadetail.idanggaran');
		$this->db->join('mnoakun', 'tanggaranbelanjadetail.koderekening = mnoakun.idakun');
		$this->db->join('mitem', 'tanggaranbelanjadetail.uraian = mitem.id');
		$data = $this->db->get_where('tanggaranbelanja', [
      'tanggaranbelanja.id' => $id
    ])->result_array();
    $no		    = 0;
    $dataBaru = [];
		for ($i=0; $i < count($data); $i++) {
      $key        = $data[$i];
      $totalsemua	= 0;
      $detail     = [];
			if ($i == 0 || ($key['koderekening'] !== $data[$no]['koderekening'])) {
				for ($j=0; $j < count($data); $j++) { 
					if ($data[$j]['koderekening'] == $key['koderekening']) {
            $totalsemua += $data[$j]['total'];
            array_push($detail, [
              'namabarang'  => $data[$j]['namabarang'],
              'volume'      => $data[$j]['volume'],
              'tarif'       => $data[$j]['tarif'],
              'satuan'      => $data[$j]['satuan'],
              'total'       => $data[$j]['total']
            ]);
					}
        }
        array_push($dataBaru, [
          'akunno'      => $key['akunno'],
          'namaakun'    => $key['namaakun'],
          'totalsemua'  => $totalsemua,
          'detail'      => $detail
        ]);
				$no = $i;
			}
		}
		return $dataBaru;
	}

	public function setGet($jenis = null, $isi = null)
	{
		if ($isi) {
			$this->$jenis	= $isi;
		} else {
			return $this->$jenis;
		}
	}

	public function get()
	{
		if ($this->idAnggaranBelanja) {
			$this->db->select('tanggaranbelanja.idperusahaan, tanggaranbelanja.thnanggaran, tanggaranbelanja.tglpengajuan, tanggaranbelanja.id, tanggaranbelanja.dept, tanggaranbelanja.pejabat, tanggaranbelanja.id');
			$this->db->where('id', $this->idAnggaranBelanja);
			$data			= $this->db->get('tanggaranbelanja')->row_array();
			$data['detail']	= $this->db->get_where('tanggaranbelanjadetail', [
				'idanggaran'	=> $data['id']
			])->result_array();
			return $data;
		}
	}
}
