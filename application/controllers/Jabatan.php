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
		$data['title'] 			= 'Jabatan - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_jabatan', 'Nama Jabatan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('jabatan/index', $data);
		} else {
			if ($this->input->post('id_jabatan')) {
				$id_jabatan 	= $this->input->post('id_jabatan');
		    	$this->jm->editJabatan($id_jabatan);
			}else{
		    	$this->jm->addJabatan();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->jm->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			if ($item->id_jabatan != 1) {
				$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-jabatan' data-id='".$item->id_jabatan."'><i class='fas fa-fw fa-edit'></i></a>";

				$button 	.= "<a href='".base_url('jabatan/deleteJabatan/'.$item->id_jabatan) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_jabatan."'><i class='fas fa-fw fa-trash'></i></a>";
			}

			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->nama_jabatan;

			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->jm->countAllDatatable(),
			"recordsFiltered" 		=> $this->jm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getJabatanById()
	{
		$id_jabatan 		= $this->input->post('id_jabatan');
		$result 			= $this->jm->getJabatanById($id_jabatan);

		echo json_encode($result);
	}


	public function deleteJabatan($id)
	{
		$this->jm->deleteJabatan($id);
	}
}