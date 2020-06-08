<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['title'] = 'Dasbor - ' . $data['dataUser']['nama_lengkap'];
		$this->load->view('templates/header-admin', $data);
		$this->load->view('admin/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}

}