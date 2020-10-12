<?php defined('BASEPATH') OR exit('No direct script access allowed');



class Ajaxselect_model extends CI_Model {
	
	private $id;
	private $term;

	public function __construct() {
		parent::__construct();
		$this->id = $this->uri->segment(3);
		$this->term = $this->input->get('q');
	}

	public function get_mpegawaihakakses() {
		$this->db->select('mpegawaihakakses.id, mpegawaihakakses.nama as text');
		$this->db->where('mpegawaihakakses.stdelete', '0');
		$this->db->limit(10);
		if($this->term) $this->db->like('nama', $this->term);
		if($this->id) $data = $this->db->where('id', $this->id)->get('mpegawaihakakses')->row_array();
		else $data = $this->db->get('mpegawaihakakses')->result_array();
		$this->output->set_content_type('application/json')->set_output(json_encode($data));
	}

}