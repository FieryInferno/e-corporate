<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {

	public function login($username, $password) {
		$this->db->where('z_user.username', $username);
		$this->db->where('z_user.password', md5($password));
		$this->db->where('z_user.stdel', '0');
		$this->db->where('z_user.stban', '0');
		$user = $this->db->get('z_user');
		if($user->num_rows() > 0) {
			$rowuser = $user->row_array();
			$this->session->set_userdata( array('userid' => $rowuser['id']) );
			return true;
		} else {
			return false;
		}
	}

}