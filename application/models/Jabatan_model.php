<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	public function getAllJabatan()
	{
		$this->db->order_by('nama_jabatan', 'ASC');
		return $this->db->get('jabatan')->result_array();
	}

}