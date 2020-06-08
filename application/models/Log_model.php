<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllLog()
	{
		$this->db->select('*');
		$this->db->join('user', 'log.id_user=user.id_user', 'left');
		$this->db->order_by('tanggal_log', 'desc');
		return $this->db->get('log')->result_array();
	}
}