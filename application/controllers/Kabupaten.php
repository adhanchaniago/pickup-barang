<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->load->model('Kabupaten_model', 'kabupaten');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Kabupaten - ' . $data['dataUser']['username'];
		$data['provinsi']		= $this->provinsi->getAllProvinsi();

		$this->form_validation->set_rules('nama_kabupaten', 'Nama Kabupaten', 'required|trim');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('kabupaten/index', $data);
		} else {
			if ($this->input->post('id_kabupaten')) {
				$id_kabupaten	= $this->input->post('id_kabupaten');
		    	$this->kabupaten->editKabupaten($id_kabupaten);
			}else{
		    	$this->kabupaten->addKabupaten();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->kabupaten->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-kabupaten' data-id='".$item->id_kabupaten."'><i class='fas fa-fw fa-edit'></i></a>";

			$button 	.= "<a href='".base_url('kabupaten/deleteKabupaten/'.$item->id_kabupaten) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_kabupaten."'><i class='fas fa-fw fa-trash'></i></a>";
			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->nama_kabupaten;
			$row[] 	= $item->nama_provinsi;
			$row[] 	= $item->negara;

			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->kabupaten->countAllDatatable(),
			"recordsFiltered" 		=> $this->kabupaten->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getKabupatenById()
	{
		$id_kabupaten 		= $this->input->post('id_kabupaten');
		$result 			= $this->kabupaten->getKabupatenById($id_kabupaten);

		echo json_encode($result);
	}
	public function getKabupatenByProvinsi()
	{
		$id_provinsi 		= $this->input->post('id_provinsi');
		$result 			= $this->kabupaten->getKabupatenByProvinsi($id_provinsi);

		echo json_encode($result);
	}

	public function deleteKabupaten($id)
	{
		$this->kabupaten->deleteKabupaten($id);
	}
}