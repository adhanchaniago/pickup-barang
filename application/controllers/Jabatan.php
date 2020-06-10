<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Jabatan_model', 'jm');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['jabatan'] 		= $this->jm->getAllJabatan();
		$data['title'] 			= 'Jabatan - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('jabatan/index', $data);
		} else {
		    $this->jm->addJabatan();
		}
	}

	public function editJabatan($id)
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['jabatan'] 		= $this->jm->getAllJabatan();
		$data['title'] 			= 'Jabatan - ' . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('jabatan/index', $data);
		} else {
		    $this->jm->editJabatan($id);
		}
	}

	public function deleteJabatan($id)
	{
		$this->jm->deleteJabatan($id);
	}
}