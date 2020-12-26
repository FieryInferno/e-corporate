<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Ajaxselect extends Pegawai_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('Ajaxselect_model','model');
	}

	public function get_mpegawaihakakses() {
		$this->model->get_mpegawaihakakses();
	}

}