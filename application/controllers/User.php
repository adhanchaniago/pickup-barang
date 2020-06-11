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

	public function datatable()
	{
		$list 		= $this->um->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$img 		= "<a href='". base_url('assets/img/img_profiles/') . $item->img_profile."' class='enlarge'>
                        <img width='75' src='". base_url('assets/img/img_profiles/') . $item->img_profile."' alt='foto profile'>
                      </a>";

			$button 	= "<div class='text-center'>";
			if ($item->id_jabatan != 1) {
				$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-user' data-id='".$item->id_user."'><i class='fas fa-fw fa-edit'></i></a>";

				$button 	.= "<a href='".base_url('user/deleteUser/'.$item->id_user) ."'' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->username."'><i class='fas fa-fw fa-trash'></i></a>";
			}

			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $img;
			$row[] 	= $item->username;
			$row[] 	= $item->nama_lengkap;
			$row[] 	= $item->nama_jabatan;

			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->um->countAllDatatable(),
			"recordsFiltered" 		=> $this->um->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getUserById()
	{
		$id_user 			= $this->input->post('id_user');
		$result 			= $this->um->getUserById($id_user);

		echo json_encode($result);
	}

	public function editUser($id)
	{
		$data['dataUser'] 			= $this->mm->getDataUser();
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