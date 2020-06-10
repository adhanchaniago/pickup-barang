<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('User_model', 'um');
		$this->load->model('Jabatan_model', 'jm');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 			= $this->mm->getDataUser();
		$data['user'] 				= $this->um->getAllUser();
		$data['jabatan'] 			= $this->jm->getAllJabatan();
		$data['title'] 				= 'Daftar Pengguna';

		$this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]');
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('id_jabatan', 'Nama Jabatan', 'required|trim');
		$this->form_validation->set_rules('password_new', 'Password Baru', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Password Verifikasi', 'required|matches[password_new]');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('user/index', $data);
		} else {
		    $this->um->addUser();
		}
	}

	public function editUser($id)
	{
		$data['dataUser'] 			= $this->mm->getDataUser();
		$data['user'] 				= $this->um->getAllUser();
		$data['jabatan'] 			= $this->jm->getAllJabatan();
		$data['title'] 				= 'Daftar Pengguna';
		
		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('id_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('user/index', $data);
		} else {
		    $this->um->editUser($id);
		}
	}

	public function deleteUser($id)
	{
		$this->um->deleteUser($id);
	}
}