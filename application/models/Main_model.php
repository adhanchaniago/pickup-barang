<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_model extends CI_Model {
	public function check_status_login()
	{
		// jika belum login pindahkan ke halaman user
		if (!$this->session->userdata('id_user')) {
			redirect('auth');
		}
	}

	public function createLog($message, $id_user)
	{
		$data = [
			'isi_log' 			=> $message,
			'tanggal_log' 		=> date('Y-m-d H:i:s'),
			'id_user' 			=> $id_user
		];
		$this->db->insert('log', $data);
	}

	public function getDataUser()
	{
		$id_user = $this->session->userdata('id_user');
		$this->db->select('*');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');
		return $this->db->get_where('user', ['user.id_user' => $id_user])->row_array();
	}
}
	
