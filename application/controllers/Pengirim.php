<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->load->model('Pengirim_model', 'pengm');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Pengirim - ' . $data['dataUser']['username'];
		$data['provinsi']		= $this->provinsi->getAllProvinsi();
		$data['pengirim']		= $this->pengm->getAllPengirim();

		$this->form_validation->set_rules('id_kecamatan', 'Nama Kecamatan', 'required|trim');
		$this->form_validation->set_rules('no_wa_pengirim', 'No. WA Pengirim', 'required|trim');
		$this->form_validation->set_rules('alamat_pengirim', 'Alamat Pengirim', 'required|trim');
		$this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('pengirim/index', $data);
		} else {
			if ($this->input->post('id_pengirim')) {
				$id_pengirim 	= $this->input->post('id_pengirim');
		    	$this->pengm->editPengirim($id_pengirim);
			}else{
		    	$this->pengm->addPengirim();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->pengm->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			if ($dataUser['id_jabatan'] == '1') {
				$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-pengirim' data-id='".$item->id_pengirim."'><i class='fas fa-fw fa-edit'></i></a>";

				$button 	.= "<a href='".base_url('pengirim/deletePengirim/'.$item->id_pengirim) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_pengirim."'><i class='fas fa-fw fa-trash'></i></a>";
			}

			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->nama_pengirim;

			if ($item->no_wa_pengirim == '') {
				$wa_pengirim 	= "No. WA tidak diisi";
			}else{
				$wa_pengirim 	= "<a target='_blank' href='https://api.whatsapp.com/send?phone=". $item->no_wa_pengirim."'>".$item->no_wa_pengirim."</a>";
			}

			$row[] 	= $wa_pengirim;
			$row[] 	= $item->alamat_pengirim;
			$row[] 	= 'Kec. '.$item->nama_kecamatan.', Kab / Kota. '.$item->nama_kabupaten.', Prov. '.$item->nama_provinsi.', '.$item->negara;
			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->pengm->countAllDatatable(),
			"recordsFiltered" 		=> $this->pengm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getPengirimById()
	{
		$id_pengirim 		= $this->input->post('id_pengirim');
		$result 			= $this->pengm->getPengirimById($id_pengirim);

		echo json_encode($result);
	}


	public function deletePengirim($id)
	{
		$this->pengm->deletePengirim($id);
	}
}