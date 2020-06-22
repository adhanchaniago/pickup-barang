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

	public function no_telepon_validasi($no_wa = '')
	{
		$firstDigit = substr($no_wa, 0, 1);
		if ($firstDigit == '0') {
			$no_wa = substr($no_wa, 1);
			$no_wa = '+62' . $no_wa;
		} elseif ($firstDigit == '6') {
			$no_wa = '+' . $no_wa;
		} elseif ($firstDigit == '8') {
			$no_wa = '+62' . $no_wa;
		} elseif ($firstDigit !== '+') {
			$no_wa = '+62' . $no_wa;
		}
		return $no_wa;
	}
}
	
