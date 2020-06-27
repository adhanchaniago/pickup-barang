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
	public function getStatusById($id_status = 0)
	{
		if ($id_status != '' && $id_status != 0 && $id_status != NULL) {
			return $this->db->get_where('status', ['id_status' => $id_status])->row_array();
		} else {
			return ['id_status' => 0,'status' => 'Semua'];
		}
	}

}