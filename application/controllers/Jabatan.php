<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Jabatan_model', 'jm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jabatan'] = $this->jm->getAllJabatan();
		$data['title'] = 'Jabatan - ' . $data['dataUser']['username'];
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header-admin', $data);
			$this->load->view('jabatan/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} else {
		    $this->jm->addJabatan();
		}
	}

	public function editJabatan($id)
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['jabatan'] = $this->jm->getAllJabatan();
		$data['title'] = 'Jabatan - ' . $data['dataUser']['username'];
		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->load->view('templates/header-admin', $data);
			$this->load->view('jabatan/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} else {
		    $this->jm->editJabatan($id);
		}
	}

	public function deleteJabatan($id)
	{
		$this->jm->deleteJabatan($id);
	}
}