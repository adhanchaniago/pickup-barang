<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'am');
	}
	
	public function index()
	{
		if ($this->session->userdata('id_user')) {
			redirect('admin');
		}

		$data['title'] = 'Masuk - Pickup Barang';
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-auth', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('templates/footer-auth', $data);
		} else {
			$this->am->login();
		}
	}
}
