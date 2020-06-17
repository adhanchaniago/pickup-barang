<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisLayanan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('JenisLayanan_model', 'jenisLayanan');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Jenis Layanan - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('jenis_layanan', 'Jenis Layanan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('jenis_layanan/index', $data);
		} else {
			if ($this->input->post('id_jenis_layanan')) {
				$id_jenis_layanan	= $this->input->post('id_jenis_layanan');
		    	$this->jenisLayanan->editJenisLayanan($id_jenis_layanan);
			}else{
		    	$this->jenisLayanan->addJenisLayanan();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->jenisLayanan->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-jenisLayanan' data-id='".$item->id_jenis_layanan."'><i class='fas fa-fw fa-edit'></i></a>";

			$button 	.= "<a href='".base_url('jenisLayanan/deleteJenisLayanan/'.$item->id_jenis_layanan) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->jenis_layanan."'><i class='fas fa-fw fa-trash'></i></a>";
			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->jenis_layanan;

			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->jenisLayanan->countAllDatatable(),
			"recordsFiltered" 		=> $this->jenisLayanan->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getJenisLayananById()
	{
		$id_jenis_layanan 	= $this->input->post('id_jenis_layanan');
		$result 			= $this->jenisLayanan->getJenisLayananById($id_jenis_layanan);

		echo json_encode($result);
	}
	public function getJenisLayananByKecAndBerat()
	{
		$result 			= $this->jenisLayanan->getJenisLayananByKecAndBerat();
		echo json_encode($result);
	}

	public function deleteJenisLayanan($id)
	{
		$this->jenisLayanan->deleteJenisLayanan($id);
	}
}