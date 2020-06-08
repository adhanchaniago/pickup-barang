<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	
	public function login()
	{
		// Mengambil variabel yang diinput
		$username = $this->input->post('username', true);
		$password = $this->input->post('password', true);

		// Cek apakah ada akun yang sesuai dengan yang diinputkan username
		$user = $this->db->get_where('user', ['username' => $username])->row_array();
		if ($user) {
			if (password_verify($password, $user['password'])) {
				// Menset userdata atau session
				$data = [
					'id_user' => $user['id_user'],
					'id_jabatan' => $user['id_jabatan'],
					'username' => $user['username']
				];
				$this->mm->createLog('Pengguna ' . $data['username'] . ' berhasil login' , $data['id_user']);
				$this->session->set_userdata($data);
				redirect('admin');
			} else {
				$this->session->set_flashdata('message-failed', 'Password yang anda masukkan salah');
				redirect('auth/login');
			}
		} else {
			$this->session->set_flashdata('message-failed', 'Username yang anda masukkan salah');
			redirect('auth/login');
		}
	}
}