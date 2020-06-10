<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Log_model', 'lm');
		$this->mm->check_status_login();
	}
	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['log'] 			= $this->lm->getAllLog();
		$data['title'] 			= 'Log - ' . $data['dataUser']['username'];
		$this->layout->view_admin('log/index', $data);
	}
}