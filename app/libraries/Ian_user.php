<?php


class Ian_user {

	private $ci;
	private $userid;

	public function __construct() {
		$this->ci =& get_instance();
		$this->userid = $this->ci->session->userdata('userid');
	}

	public function get_user() {
		$this->ci->db->select('z_user.*, z_userpermission.name as permission, mbahasa.bahasa');
		$this->ci->db->where('z_user.id', $this->userid);
		$this->ci->db->join('z_userpermission', 'z_user.permissionid = z_user.id');
		$this->ci->db->join('mbahasa', 'z_user.bahasaid = mbahasa.id', 'left');
		$pegawai = $this->ci->db->get('z_user')->row_array();
		return $pegawai;
	}

	public function is_user() {
		if($this->userid) return true;
		else return false;
	}


}