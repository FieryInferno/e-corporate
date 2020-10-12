<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Change_language extends Pegawai_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index() {
		$this->load->library('user_agent');
		$id = $this->uri->segment(3);
		$this->db->set('idbahasa',$id);
		$this->db->where('id', get_pegawai('id'));
		$update = $this->db->update('mpegawai');
		if($update) {
			redirect($this->agent->referrer(),'refresh');
		} else {
			redirect($this->agent->referrer(),'refresh');
		}
	}

}