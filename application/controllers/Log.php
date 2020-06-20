<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Log_model', 'lm');
		$this->mm->check_status_login();
	}
	public function index()
	{
		$data['dataUser'] 		= $this->mm->getDataUser();
		$data['title'] 			= 'Log - ' . $data['dataUser']['username'];
		$this->layout->view_admin('log/index', $data);
	}
	public function datatable()
	{
		$list 		= $this->lm->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;
			$row 	= array();

			$row[] 	= "<div class='text-center' >".$no.".</div>";
			$row[] 	= kapital($item->username);
			$row[] 	= $item->isi_log;
			$row[] 	= $item->tanggal_log;

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->lm->countAllDatatable(),
			"recordsFiltered" 		=> $this->lm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
}