<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	public function getAllStatus()
	{
		return $this->db->get('status')->result_array();
	}
	public function getStatusById($id_status)
	{
		$this->db->where('id_status', $id_status);
		return $this->db->get('status')->row_array();
	}

}