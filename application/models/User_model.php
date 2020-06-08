<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function getAllUser()
	{
		return $this->db->get('user')->result_array();
	}
}