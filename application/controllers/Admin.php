<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Layout_model','layout');
		$this->load->model('Admin_model', 'am');
		$this->load->model('Main_model', 'mm');
		$this->load->model('Jabatan_model', 'jm');
		$this->load->model('Pesanan_model', 'pesm');
		$this->load->model('Status_model', 'status');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 			= $this->mm->getDataUser();
		if (isset($_GET['dari_tanggal']) AND isset($_GET['sampai_tanggal']) AND isset($_GET['id_status'])) {
			$dari_tanggal			= $_GET["dari_tanggal"];
			$sampai_tanggal			= $_GET["sampai_tanggal"];

			$status					= $this->status->getStatusById($_GET["id_status"]);
			$headline 				= 'Dasbor - '.$dari_tanggal.' s/d '.$sampai_tanggal.' - '.$status['status'];
			$pesanan 				= $this->pesm->getPesanan($_GET['dari_tanggal'], $_GET['sampai_tanggal'], $_GET['id_status']);
			$jml_status				= $this->pesm->getJmlStatus($_GET['dari_tanggal'], $_GET['sampai_tanggal']);
			$val_dari_tanggal		= $dari_tanggal;
			$val_sampai_tanggal		= $sampai_tanggal;
		} else {
			$headline 				= 'Dasbor - Hari Ini';
			$status					= $this->status->getStatusById();
			$pesanan 				= $this->pesm->getPesanan();
			$jml_status				= $this->pesm->getJmlStatus();
			$val_dari_tanggal		= date('Y-m-d');
			$val_sampai_tanggal		= date('Y-m-d');
			$dari_tanggal			= '';
			$sampai_tanggal			= '';
		}

		$data['title'] 				= 'Dasbor - ' . $data['dataUser']['username'];
		$data["allStatus"]			= $this->status->getAllStatus();
		$data["headline"]			= $headline;
		$data["status"]				= $status;
		$data["pesanan"]			= $pesanan;
		$data["jml_status"]			= $jml_status;
		$data["val_dari_tanggal"]	= $val_dari_tanggal;
		$data["val_sampai_tanggal"]	= $val_sampai_tanggal;
		$data["dari_tanggal"]		= $dari_tanggal;
		$data["sampai_tanggal"]		= $sampai_tanggal;
		$this->layout->view_admin('admin/index', $data);
	}

	public function profile()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['jabatan'] 		= $this->jm->getAllJabatan();
		$data['title'] 			= 'Profil - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim');
		$this->form_validation->set_rules('id_jabatan', 'Nama Jabatan', 'required');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('admin/profile', $data);
		} else {
		    $this->am->editProfile();
		}
	}

	public function gantiPassword()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['jabatan'] 		= $this->jm->getAllJabatan();
		$data['title'] 			= 'Profil - ' . $data['dataUser']['username'];
		
		$this->form_validation->set_rules('password_old', 'Password Lama', 'required');
		$this->form_validation->set_rules('password_new', 'Password Baru', 'required|matches[password_verify]');
		$this->form_validation->set_rules('password_verify', 'Password Verifikasi', 'required|matches[password_new]');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('admin/profile', $data);
		} else {
		    $this->am->changePassword();
		}
	}
}