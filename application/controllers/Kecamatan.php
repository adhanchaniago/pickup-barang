<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->load->model('Kabupaten_model', 'kabupaten');
		$this->load->model('Kecamatan_model', 'kecamatan');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Kecamatan - ' . $data['dataUser']['username'];
		$data['provinsi']		= $this->provinsi->getAllProvinsi();

		$this->form_validation->set_rules('nama_kecamatan', 'Nama Kecamatan', 'required|trim');
		$this->form_validation->set_rules('id_kabupaten', 'Kabupaten', 'required|trim');
		$this->form_validation->set_rules('id_provinsi', 'Provinsi', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('kecamatan/index', $data);
		} else {
			if ($this->input->post('id_kecamatan')) {
				$id_kecamatan	= $this->input->post('id_kecamatan');
		    	$this->kecamatan->editKecamatan($id_kecamatan);
			}else{
		    	$this->kecamatan->addKecamatan();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->kecamatan->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-kecamatan' data-id='".$item->id_kecamatan."'><i class='fas fa-fw fa-edit'></i></a>";

			$button 	.= "<a href='".base_url('kecamatan/deleteKecamatan/'.$item->id_kecamatan) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_kecamatan."'><i class='fas fa-fw fa-trash'></i></a>";
			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->nama_kecamatan;
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
			"recordsTotal" 			=> $this->kecamatan->countAllDatatable(),
			"recordsFiltered" 		=> $this->kecamatan->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getKecamatanById()
	{
		$id_kecamatan 		= $this->input->post('id_kecamatan');
		$result 			= $this->kecamatan->getKecamatanById($id_kecamatan);

		echo json_encode($result);
	}
	public function getKecamatanByKabupaten()
	{
		$id_kabupaten 		= $this->input->post('id_kabupaten');
		$result 			= $this->kecamatan->getKecamatanByKabupaten($id_kabupaten);

		echo json_encode($result);
	}

	public function deleteKecamatan($id)
	{
		$this->kecamatan->deleteKecamatan($id);
	}
}