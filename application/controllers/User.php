<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('User_model', 'um');
	}
	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['user'] = $this->um->getAllUser();
		$data['title'] = 'Daftar Pengguna';
		$this->load->view('templates/header-admin', $data);
		$this->load->view('user/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}