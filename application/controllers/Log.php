<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Log_model', 'lm');
	}
	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['log'] = $this->lm->getAllLog();
		$data['title'] = 'Log - ' . $data['dataUser']['username'];
		$this->load->view('templates/header-admin', $data);
		$this->load->view('log/index', $data);
		$this->load->view('templates/footer-admin', $data);
	}
}