<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerima extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->load->model('Penerima_model', 'pm');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Penerima - ' . $data['dataUser']['username'];
		$data['provinsi']		= $this->provinsi->getAllProvinsi();
		$data['penerima']		= $this->pm->getAllPenerima();

		$this->form_validation->set_rules('id_kecamatan', 'Nama Kecamatan', 'required|trim');
		$this->form_validation->set_rules('no_wa_penerima', 'No. WA Penerima', 'required|trim');
		$this->form_validation->set_rules('alamat_penerima', 'Alamat Penerima', 'required|trim');
		$this->form_validation->set_rules('nama_penerima', 'Nama Penerima', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('penerima/index', $data);
		} else {
			if ($this->input->post('id_penerima')) {
				$id_penerima 	= $this->input->post('id_penerima');
		    	$this->pm->editPenerima($id_penerima);
			}else{
		    	$this->pm->addPenerima();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->pm->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			if ($dataUser['id_jabatan'] == '1') {
				$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-penerima' data-id='".$item->id_penerima."'><i class='fas fa-fw fa-edit'></i></a>";

				$button 	.= "<a href='".base_url('penerima/deletePenerima/'.$item->id_penerima) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_penerima."'><i class='fas fa-fw fa-trash'></i></a>";
			}

			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->nama_penerima;

			if ($item->no_wa_penerima == '') {
				$wa_penerima 	= "No. WA tidak diisi";
			}else{
				$wa_penerima 	= "<a target='_blank' href='https://api.whatsapp.com/send?phone=". $item->no_wa_penerima."'>".$item->no_wa_penerima."</a>";
			}

			$row[] 	= $wa_penerima;
			$row[] 	= $item->alamat_penerima;
			$row[] 	= 'Kec. '.$item->nama_kecamatan.', Kab / Kota. '.$item->nama_kabupaten.', Prov. '.$item->nama_provinsi.', '.$item->negara;
			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->pm->countAllDatatable(),
			"recordsFiltered" 		=> $this->pm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getPenerimaById()
	{
		$id_penerima 		= $this->input->post('id_penerima');
		$result 			= $this->pm->getPenerimaById($id_penerima);

		echo json_encode($result);
	}


	public function deletePenerima($id)
	{
		$this->pm->deletePenerima($id);
	}
}