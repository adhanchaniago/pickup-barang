<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'am');
		$this->load->model('Layout_model','layout');
		$this->load->model('PickupBarang_model', 'pbm');
	}
	
	public function index()
	{
		$data['title'] 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
		$this->layout->view_auth('auth/index', $data);
	}

	public function login()
	{
		if ($this->session->userdata('id_user')) {
			redirect('admin');
		}

		$data['title'] 			= 'Masuk - Pickup Barang';

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->layout->view_auth('auth/login', $data);
		} else {
			$this->am->login();
		}
	}

	public function logout()
	{
		if ($this->session->userdata('id_user')) {
			$this->mm->createLog('Pengguna ' . $this->session->userdata('username') . ' berhasil logout' , $this->session->userdata('id_user'));
		}

		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('id_outlet');
		$this->session->unset_userdata('id_jabatan');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		session_destroy();
		redirect('auth/login');
	}

	public function cek_status_pesanan()
	{
		$this->form_validation->set_rules('no_resi', 'No. Resi', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->index();
		} else {
			$data['no_resi'] = $this->pbm->cek_status_pesanan();
			if ($data['no_resi'] > 0) {
				$data['berhasil'] = true;
			} else {
				$data['error'] = true;
			}
			$this->index();
		}
	}
}
