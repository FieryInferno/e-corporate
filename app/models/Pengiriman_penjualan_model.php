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


class Pengiriman_penjualan_model extends CI_Model {

	public function save() {
		$idpengiriman = $this->input->post('idpengiriman');
		$pengiriman = get_by_id('id',$idpengiriman,'tpengirimanpenjualan');
        $action = $this->uri->segment(3);
        $idpemesanan =$pengiriman['pemesananid'];

        $qpengiriman= $this->db->query("SELECT * FROM tpengirimanpenjualan WHERE id='$idpengiriman'");
	        if ($qpengiriman->num_rows() > 0){
	        	foreach ($qpengiriman->result() as $row) {
	        		if ($row->status == '2'){
	        			for ($i=0; $i < count($this->input->post('no', TRUE)); $i++) {
								if ($this->input->post('jumlah', TRUE)[$i]) {
									$harga = $this->input->post('harga', TRUE)[$i];
									$jumlah = $this->input->post('jumlah', TRUE)[$i];
									$idpenjualdetail = $this->input->post('idpenjualdetail', TRUE)[$i];
									$itemid = $this->input->post('itemid', TRUE)[$i];
									
									$subtotal = $harga * $jumlah;
									$total = $subtotal;
									$diskon = $this->input->post('diskon', TRUE)[$i];
										if ($diskon > 0){
											$nominaldiskon = ($diskon * $subtotal / 100);
											$total = $total - $nominaldiskon;
										}else{
											$nominaldiskon = 0;
											$total = $total - $nominaldiskon;
										}

										$ppn = $this->input->post('ppn', TRUE)[$i];
										if ($ppn > 0){
											$nominalppn = $ppn;
											$total = $total + $nominalppn;
										}else{
											$nominalppn = 0;
											$total = $total  + $nominalppn;
										}

										$biaya_pengiriman = $this->input->post('biaya_pengiriman', TRUE)[$i];
										if ($biaya_pengiriman > 0){
											$nominalbiayapengiriman = $biaya_pengiriman;
											$total = $total +  $nominalbiayapengiriman;
										}else{
											$nominalbiayapengiriman = 0;
											$total = $total + $nominalbiayapengiriman;
										}
										$hasil_total = $total - $nominalppn - $nominalbiayapengiriman;

									$this->db->query("UPDATE tpengirimanpenjualandetail SET jumlah = jumlah + '$jumlah', subtotal = subtotal + '$subtotal', diskon = '$diskon', ppn='$ppn', biaya_pengiriman='$biaya_pengiriman', total= total + '$hasil_total' WHERE idpengiriman='$idpengiriman' AND idpenjualdetail='$idpenjualdetail' AND itemid='$itemid'");

									$this->db->query("UPDATE tpemesananpenjualandetail SET jumlahditerima = '$jumlah' + jumlahditerima WHERE id='$idpenjualdetail' AND itemid='$itemid'");
									
									$this->db->query("UPDATE tpemesananpenjualandetail SET jumlahsisa = jumlahsisa - '$jumlah' WHERE id='$idpenjualdetail' AND itemid='$itemid'");

										$query_pemesanan_detail= $this->db->query("SELECT jumlah,jumlahsisa FROM tpemesananpenjualandetail WHERE id='$idpenjualdetail' AND itemid='$itemid'");
						        		if ($query_pemesanan_detail->num_rows() > 0){
							        		foreach ($query_pemesanan_detail->result() as $pemesanandetail) {
							        			if ($pemesanandetail->jumlahsisa == 0){
							        				$this->db->query("UPDATE tpemesananpenjualandetail SET status = '3' WHERE id='$idpenjualdetail' AND itemid='$itemid'");
							        			}else if ($pemesanandetail->jumlah == $pemesanandetail->jumlahsisa){
							        				$this->db->query("UPDATE tpemesananpenjualandetail SET status = '5' WHERE id='$idpenjualdetail' AND itemid='$itemid'");
							        			}else{
							        				$this->db->query("UPDATE tpemesananpenjualandetail SET status = '2' WHERE id='$idpenjualdetail' AND itemid='$itemid'");
							        			} 
							        		}
							        	}

							        	//update status pemesanan
							        	$query_pemesanan1= $this->db->query("SELECT SUM(jumlahsisa) as sumjumlahsisa, SUM(jumlah) as sumjumlah FROM tpemesananpenjualandetail WHERE idpemesanan='$row->pemesananid'");
						        		if ($query_pemesanan1->num_rows() > 0){
							        		foreach ($query_pemesanan1->result() as $psn1) {
							        			if ($psn1->sumjumlahsisa == 0){
							        				$this->db->query("UPDATE tpemesananpenjualan SET status = '3' WHERE id='$row->pemesananid'");
							        			}else if ($psn1->sumjumlah == $psn1->sumjumlahsisa){
							        				$this->db->query("UPDATE tpemesananpenjualan SET status = '5' WHERE id='$row->pemesananid'");
							        			}else{
							        				$this->db->query("UPDATE tpemesananpenjualan SET status = '2' WHERE id='$row->pemesananid'");
							        			}

							        			if ($psn->sumjumlahsisa == 0){
											        $this->db->query("UPDATE tbudgetevent SET status = '3' WHERE idpemesanan='$kirim->pemesananid'");
											  	}else if ($psn->sumjumlah == $psn->sumjumlahsisa){
								    				$this->db->query("UPDATE tbudgetevent SET status = '5' WHERE idpemesanan='$kirim->pemesananid'");
											    }else{
								    				$this->db->query("UPDATE tbudgetevent SET status = '2' WHERE idpemesanan='$kirim->pemesananid'");
											    }

							        			if ($psn1->sumjumlahsisa == 0){
							        				$this->db->query("UPDATE tpengirimanpenjualan SET status = '3' WHERE id='$idpengiriman'");
							        			}else if ($psn1->sumjumlah == $psn1->sumjumlahsisa){
							        				$this->db->query("UPDATE tpengirimanpenjualan SET status = '1' WHERE id='$idpengiriman'");
							        			}else{
							        				$this->db->query("UPDATE tpengirimanpenjualan SET status = '2' WHERE id='$idpengiriman'");
							        			}
							        		}
							        	}
								}
							}
	        		}else{

	        			$this->db->set('tanggalterima',$this->input->post('tanggalterima', TRUE));
						$this->db->set('nomorsuratjalan',$this->input->post('nomorsuratjalan', TRUE));
						$this->db->set('catatan',$this->input->post('catatan', TRUE));
						$this->db->where('id',$idpengiriman);
						$update = $this->db->update('tpengirimanpenjualan');
						if($update) {
							for ($i=0; $i < count($this->input->post('no', TRUE)); $i++) {
								if ($this->input->post('jumlah', TRUE)[$i]) {
									$harga = $this->input->post('harga', TRUE)[$i];
									$jumlah = $this->input->post('jumlah', TRUE)[$i];
									
									$subtotal = $harga * $jumlah;
									$total = $subtotal;
									$diskon = $this->input->post('diskon', TRUE)[$i];
										if ($diskon > 0){
											$nominaldiskon = ($diskon * $subtotal / 100);
											$total = $total - $nominaldiskon;
										}else{
											$nominaldiskon = 0;
											$total = $total - $nominaldiskon;
										}

										$ppn = $this->input->post('ppn', TRUE)[$i];
										if ($ppn > 0){
											$nominalppn = $ppn;
											$total = $total + $nominalppn;
										}else{
											$nominalppn = 0;
											$total = $total  + $nominalppn;
										}

										$biaya_pengiriman = $this->input->post('biaya_pengiriman', TRUE)[$i];
										if ($biaya_pengiriman > 0){
											$nominalbiayapengiriman = $biaya_pengiriman;
											$total = $total +  $nominalbiayapengiriman;
										}else{
											$nominalbiayapengiriman = 0;
											$total = $total + $nominalbiayapengiriman;
										}
									$this->db->set('harga',$this->input->post('harga', TRUE)[$i]);
									$this->db->set('jumlah',$this->input->post('jumlah', TRUE)[$i]);
									$this->db->set('subtotal',$subtotal);
									$this->db->set('diskon',$this->input->post('diskon', TRUE)[$i]);
									$this->db->set('ppn',$this->input->post('ppn', TRUE)[$i]);
									$this->db->set('biaya_pengiriman',$this->input->post('biaya_pengiriman', TRUE)[$i]);
									$this->db->set('total',$total);
									$this->db->where('idpenjualdetail',$this->input->post('idpenjualdetail', TRUE)[$i]);
									$this->db->where('itemid',$this->input->post('itemid', TRUE)[$i]);
									$this->db->where('idpengiriman',$idpengiriman);
									$this->db->update('tpengirimanpenjualandetail');
								}
							}

							$query= $this->db->query("SELECT * FROM tpengirimanpenjualan WHERE id='$idpengiriman'");
					        if ($query->num_rows() > 0){
					        	foreach ($query->result() as $kirim) {
					        		
					        		$query_detail= $this->db->query("SELECT * FROM tpengirimanpenjualandetail WHERE idpengiriman='$kirim->id'");
							        if ($query_detail->num_rows() > 0){
							        	foreach ($query_detail->result() as $krm_detail) {

							        		$query_psn= $this->db->query("SELECT jumlahsisa FROM tpemesananpenjualandetail WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");
									        if ($query_psn->num_rows() > 0){
									        	foreach ($query_psn->result() as $psn) {
									        		if ($psn->jumlahsisa != 0){
									        			
									        			
									        				//update jumlahditerima pemesanan
									        				$this->db->query("UPDATE tpemesananpenjualandetail SET jumlahditerima = '$krm_detail->jumlah' + jumlahditerima WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");

									        				//update jumlahsisa pemesanan
															$this->db->query("UPDATE tpemesananpenjualandetail SET jumlahsisa = jumlahsisa - '$krm_detail->jumlah' WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");
									        			
													    
													    

										        		//update status pemesanan detail
										        		$query_pemdetail= $this->db->query("SELECT jumlah,jumlahsisa FROM tpemesananpenjualandetail WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");
										        		if ($query_detail->num_rows() > 0){
											        		foreach ($query_pemdetail->result() as $psn_detail) {
											        			if ($psn_detail->jumlahsisa == 0){
											        				$this->db->query("UPDATE tpemesananpenjualandetail SET status = '3' WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");
											        			}else if ($psn_detail->jumlah == $psn_detail->jumlahsisa){
											        				$this->db->query("UPDATE tpemesananpenjualandetail SET status = '5' WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");
											        			}else{
											        				$this->db->query("UPDATE tpemesananpenjualandetail SET status = '2' WHERE id='$krm_detail->idpenjualdetail' AND itemid='$krm_detail->itemid'");
											        			} 
											        		}
											        	}

											        	//update status pemesanan
											        	$query_pemesanan= $this->db->query("SELECT SUM(jumlahsisa) as sumjumlahsisa, SUM(jumlah) as sumjumlah FROM tpemesananpenjualandetail WHERE idpemesanan='$kirim->pemesananid'");
										        		if ($query_pemesanan->num_rows() > 0){
											        		foreach ($query_pemesanan->result() as $psn) {
											        			if ($psn->sumjumlahsisa == 0){
											        				$this->db->query("UPDATE tpemesananpenjualan SET status = '3' WHERE id='$kirim->pemesananid'");
											        			}else if ($psn->sumjumlah == $psn->sumjumlahsisa){
											        				$this->db->query("UPDATE tpemesananpenjualan SET status = '5' WHERE id='$kirim->pemesananid'");
											        			}else{
											        				$this->db->query("UPDATE tpemesananpenjualan SET status = '2' WHERE id='$kirim->pemesananid'");
											        			}

											        			if ($psn->sumjumlahsisa == 0){
											        				$this->db->query("UPDATE tbudgetevent SET status = '3' WHERE idpemesanan='$kirim->pemesananid'");
											        			}else if ($psn->sumjumlah == $psn->sumjumlahsisa){
											        				$this->db->query("UPDATE tbudgetevent SET status = '5' WHERE idpemesanan='$kirim->pemesananid'");
											        			}else{
											        				$this->db->query("UPDATE tbudgetevent SET status = '2' WHERE idpemesanan='$kirim->pemesananid'");
											        			}

											        			if ($psn->sumjumlahsisa == 0){
											        				$this->db->query("UPDATE tpengirimanpenjualan SET status = '3' WHERE id='$idpengiriman'");
											        			}else if ($psn->sumjumlah == $psn->sumjumlahsisa){
											        				$this->db->query("UPDATE tpengirimanpenjualan SET status = '1' WHERE id='$idpengiriman'");
											        			}else{
											        				$this->db->query("UPDATE tpengirimanpenjualan SET status = '2' WHERE id='$idpengiriman'");
											        			}


											        		}
											        	}
									        		}
									        	}
									        }
								        }
								    }
								}
							}	

	        		}
	        	}
	        }

			if ($action == 'save'){
				$data['status'] = 'success';
				$data['message'] = 'Berhasil menyimpan data';
			}else{
				$data['status'] = 'success';
				$data['message'] = 'Berhasil mengupdate data';
			}
		}else{
			if ($action == 'save'){
				$data['status'] = 'error';
				$data['message'] = 'Gagal menyimpan data';
			}else{
				$data['status'] = 'error';
				$data['message'] = 'Gagal mengupdate data';
			}
		}

		return $this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function delete() {
		$idpengiriman = $this->uri->segment(3);

		$query= $this->db->query("SELECT * FROM tpengirimanpenjualan WHERE id='$idpengiriman'");
        if ($query->num_rows() > 0){
        	foreach ($query->result() as $kirim) {

        		if ($kirim->validasi == '0'){
        			$this->db->set('status', '4');
        			$this->db->where('id', $kirim->pemesananid);
					$this->db->update('tpemesananpenjualan');

        			$this->db->where('idpengiriman', $idpengiriman);
					$this->db->delete('tpengirimanpenjualandetail');
					$this->db->where('id', $idpengiriman);
					$delete = $this->db->delete('tpengirimanpenjualan');
					if($delete) {
						$data['status'] = 'success';
						$data['message'] = "Data berhasil dihapus";
					} else {
						$data['status'] = 'error';
						$data['message'] = "Data gagal dihapus";
					}

        		}else{
        			$query_detail= $this->db->query("SELECT * FROM tpengirimanpenjualandetail WHERE idpengiriman='$kirim->id'");
			        if ($query_detail->num_rows() > 0){
			        	foreach ($query_detail->result() as $krm_detail) {

			        		//mengembalikan jumlah diterima dan jumlah sisa seperti semula
			        		$query_psndetail= $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE id='$krm_detail->idpenjualdetail'");
					        if ($query_psndetail->num_rows() > 0){
					        	foreach ($query_psndetail->result() as $psn_detail) {
					        		$hasil_baru_jlmtrm = $psn_detail->jumlahditerima - $krm_detail->jumlah;
					        		$hasil_baru_jlmsisa = $krm_detail->jumlah - $psn_detail->jumlahsisa;

					        		$this->db->set('jumlahditerima',$hasil_baru_jlmtrm);
			        				$this->db->set('jumlahsisa',$hasil_baru_jlmsisa);
			        				if ($hasil_baru_jlmsisa == 0){
			        					$this->db->set('status','3');
			        				}else if ($krm_detail->jumlah == $hasil_baru_jlmsisa){
			        					$this->db->set('status','5');
			        				}else{
			        					$this->db->set('status','2');
			        				}
									$this->db->where('id', $krm_detail->idpenjualdetail);
									$this->db->update('tpemesananpenjualandetail');
					        	}
					        }

					        //mengembalikan stok masuk seperti semula
					        if ($krm_detail->tipe == 'barang'){
			        			$query_stokmasuk= $this->db->query("SELECT * FROM tstokmasuk WHERE itemid='$krm_detail->itemid' AND gudangid='$kirim->gudangid'");
				        		if ($query_stokmasuk->num_rows() > 0){
				        			foreach ($query_stokmasuk->result() as $stokm) {
				        				$hasil_baru_keluar = $stokm->keluar - $krm_detail->jumlah;
				        				$hasil_baru_sisa = $stokm->sisa + $krm_detail->jumlah;

				        				$this->db->set('keluar',$hasil_baru_keluar);
				        				$this->db->set('sisa',$hasil_baru_sisa);
										$this->db->where('itemid', $krm_detail->itemid);
										$this->db->where('gudangid', $kirim->gudangid);
										$this->db->update('tstokmasuk');
				        			}
				        		}
			        		} 

			        	}
			        }

			        //mengembalikan status dari pemesanan penjualan
					$query_pesan_detail= $this->db->query("SELECT * FROM tpemesananpenjualandetail WHERE idpemesanan='$kirim->pemesananid'");
			        $total_sisa = 0;
			        $total_jumlah = 0;
			        if ($query_pesan_detail->num_rows() > 0){	
			        	foreach ($query_pesan_detail->result() as $psn_detail) {
			        		$total_jumlah = $total_jumlah + $psn_detail->jumlah;
	        				$total_sisa = $total_sisa + $psn_detail->jumlahsisa;
			        	}
			        	if ($total_sisa == 0){
				        	$this->db->set('status','3');
				        }else if ($total_sisa == $total_jumlah){
				        	$this->db->set('status','5');
				        }else if ($total_sisa < $total_jumlah){
				        	$this->db->set('status','2');
				        }else{
				        	$this->db->set('status','1');
				        }
				        $this->db->where('id', $kirim->pemesananid);
						$this->db->update('tpemesananpenjualan');

						if ($total_sisa == 0){
				        	$this->db->set('status','3');
				        }else if ($total_sisa == $total_jumlah){
				        	$this->db->set('status','5');
				        }else if ($total_sisa < $total_jumlah){
				        	$this->db->set('status','2');
				        }else{
				        	$this->db->set('status','1');
				        }
				        $this->db->where('idpemesanan', $kirim->pemesananid);
						$this->db->update('tbudgetevent');
			        }        

			        //hapus atau batal stok keluar
					$this->db->where('refid', $idpengiriman);
					$this->db->delete('tstokkeluar');
					//update validasi pengiriman penjualan
					$this->db->set('validasi','0');
					$this->db->where('id', $idpengiriman);
					$update = $this->db->update('tpengirimanpenjualan');
					if($update) {
						$data['status'] = 'success';
						$data['message'] = "Validasi data berhasil dibatalkan";
					} else {
						$data['status'] = 'error';
						$data['message'] = "Validasi data gagal dibatalkan";
					}
        		}
        	}
        		
        		
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

	public function cekjumlahinput() {
		$itemid = $this->input->post('itemid', TRUE);
		$idpemesanan = $this->input->post('idpemesanan', TRUE);
		if($itemid && $idpemesanan) {
			$this->db->select('jumlahsisa');
			$this->db->where('idpemesanan', $idpemesanan);
			$this->db->where('itemid', $itemid);
			$row = $this->db->get('tpemesananpenjualandetail', 1)->row_array();
			$data['jumlahsisa'] = $row['jumlahsisa'];
			$this->output->set_content_type('application/json')->set_output(json_encode($data));
		}
	}

	public function getpengiriman($id) {
		$this->db->select('tpengirimanpenjualan.*, tpemesananpenjualan.kontakid, tpemesananpenjualan.gudangid, mkontak.nama as kontak, mkontak.alamat, mkontak.cp');
		$this->db->where('tpengirimanpenjualan.id', $id);
		$this->db->join('tpemesananpenjualan', 'tpengirimanpenjualan.pemesananid = tpemesananpenjualan.id', 'left');
		$this->db->join('mkontak', 'tpengirimanpenjualan.kontakid = mkontak.id', 'left');
		$get = $this->db->get('tpengirimanpenjualan',1);
		return $get->row_array();
	}

	public function pengirimandetail($idpengiriman) {
		$this->db->select('tpengirimanpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, msatuan.nama as satuan, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as lain_lain');
		$this->db->join('mitem', 'tpengirimanpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('msatuan', 'mitem.satuanid = msatuan.id', 'left');
		$this->db->join('tpengirimanpenjualan', 'tpengirimanpenjualandetail.idpengiriman = tpengirimanpenjualan.id');
		$this->db->join('mnoakun', 'tpengirimanpenjualandetail.itemid = mnoakun.idakun');
		$this->db->where('tpengirimanpenjualandetail.idpengiriman', $idpengiriman);
		$get = $this->db->get('tpengirimanpenjualandetail');
		return $get->result_array();
	}

	public function pemesanandetail($idpemesanan) {
		$this->db->select('tpemesananpenjualandetail.*, CONCAT(mitem.noakunjual," - ",mitem.nama) as item, CONCAT(mnoakun.akunno," / ",mnoakun.namaakun) as lain_lain,  tstokmasuk.sisa as sisastok');
		$this->db->join('mitem', 'tpemesananpenjualandetail.itemid = mitem.id', 'left');
		$this->db->join('mnoakun', 'tpemesananpenjualandetail.itemid = mnoakun.idakun', 'left');
		$this->db->join('tstokmasuk', 'tpemesananpenjualandetail.itemid = tstokmasuk.itemid', 'left');
		$this->db->where('tpemesananpenjualandetail.idpemesanan', $idpemesanan);
		$this->db->where('tpemesananpenjualandetail.status !=', '3');
		$get = $this->db->get('tpemesananpenjualandetail');
		return $get->result_array();
	}
}

