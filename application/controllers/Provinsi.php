<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Provinsi - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('nama_provinsi', 'Nama Provinsi', 'required|trim');
		$this->form_validation->set_rules('negara', 'Negara', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('provinsi/index', $data);
		} else {
			if ($this->input->post('id_provinsi')) {
				$id_provinsi	= $this->input->post('id_provinsi');
		    	$this->provinsi->editProvinsi($id_provinsi);
			}else{
		    	$this->provinsi->addProvinsi();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->provinsi->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-provinsi' data-id='".$item->id_provinsi."'><i class='fas fa-fw fa-edit'></i></a>";

			$button 	.= "<a href='".base_url('provinsi/deleteProvinsi/'.$item->id_provinsi) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_provinsi."'><i class='fas fa-fw fa-trash'></i></a>";
			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->nama_provinsi;
			$row[] 	= $item->negara;

			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->provinsi->countAllDatatable(),
			"recordsFiltered" 		=> $this->provinsi->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getProvinsiById()
	{
		$id_provinsi 		= $this->input->post('id_provinsi');
		$result 			= $this->provinsi->getProvinsiById($id_provinsi);

		echo json_encode($result);
	}

	public function deleteProvinsi($id)
	{
		$this->provinsi->deleteProvinsi($id);
	}
}