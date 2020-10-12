<?php defined('BASEPATH') OR exit('No direct script access allowed');

class General_model extends CI_Model {

	public function modul_in_sidebar() {
		$this->db->where('stdelete', '0');
		$this->db->where('staktif', '1');
		$this->db->order_by('posisi', 'asc');
		$get = $this->db->get('mmodul');
		return $get->result_array();
	}

	public function hakakses_pegawai($idhakakses) {
		$this->db->select('mmodul.url');
		$this->db->join('mmodul', 'mpegawaihakaksesdetail.idmodul = mmodul.id', 'left');
		$this->db->from('mpegawaihakaksesdetail');
		$this->db->where('mpegawaihakaksesdetail.idhakakses', $idhakakses);
		$get = $this->db->get();
		if($get->num_rows() > 0) {
			return $get->result_array();
		} else {
			return true;
		}
	}

	public function get_lang($key) {
	    $this->db->where('idbahasa', get_pegawai('idbahasa'));
	    $this->db->where('key', $key);
	    $get = $this->db->get('mbahasadetail');
	    if($get->num_rows() > 0) return $get->row()->value;
	    else return false;
	}

}