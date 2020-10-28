<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SaldoAwalHutangModel extends CI_Model {

    public function indexDatatable()
    {
        $this->load->library('Datatables');
        $this->datatables->select('*');
		$this->datatables->from('SaldoAwalHutang');
		return $this->datatables->generate();
    }
}

