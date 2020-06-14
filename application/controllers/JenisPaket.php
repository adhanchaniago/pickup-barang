<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisPaket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('JenisPaket_model', 'jenisPaket');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Jenis Paket - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('jenis_paket', 'Jenis Paket', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('jenis_paket/index', $data);
		} else {
			if ($this->input->post('id_jenis_paket')) {
				$id_jenis_paket	= $this->input->post('id_jenis_paket');
		    	$this->jenisPaket->editJenisPaket($id_jenis_paket);
			}else{
		    	$this->jenisPaket->addJenisPaket();
			}
		}
	}
	public function datatable()
	{
		$list 		= $this->jenisPaket->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-jenisPaket' data-id='".$item->id_jenis_paket."'><i class='fas fa-fw fa-edit'></i></a>";

			$button 	.= "<a href='".base_url('jenisPaket/deleteJenisPaket/'.$item->id_jenis_paket) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->jenis_paket."'><i class='fas fa-fw fa-trash'></i></a>";
			$button 	.= "</div>";

			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= $item->jenis_paket;

			if ($dataUser['id_jabatan'] == '1') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->jenisPaket->countAllDatatable(),
			"recordsFiltered" 		=> $this->jenisPaket->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getJenisPaketById()
	{
		$id_jenis_paket 	= $this->input->post('id_jenis_paket');
		$result 			= $this->jenisPaket->getJenisPaketById($id_jenis_paket);

		echo json_encode($result);
	}

	public function deleteJenisPaket($id)
	{
		$this->jenisPaket->deleteJenisPaket($id);
	}
}