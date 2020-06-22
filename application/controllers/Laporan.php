<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Laporan_model', 'lm');
		$this->load->model('Status_model', 'status');
	}

	public function index()
	{
		$data['dataUser'] 			= $this->mm->getDataUser();
		$status 					= "Semua";
		$id_status 					= "";

		if (isset($_POST['dari_tanggal']) AND isset($_POST['sampai_tanggal']) AND isset($_POST['id_status'])) {
			$title 					= 'Laporan dari tanggal' . $_POST['dari_tanggal'] . 's/d' . $_POST['sampai_tanggal'] . ', status: '. $status;
			$getStatus 				= $this->status->getStatusById($_POST["id_status"]);
			$status					= $getStatus["status"];
			$id_status				= $getStatus["id_status"];

			$dari_tanggal 			= $this->input->post('dari_tanggal');
			$sampai_tanggal 		= $this->input->post('sampai_tanggal');
			$val_dari_tanggal 		= $dari_tanggal;
			$val_sampai_tanggal		= $sampai_tanggal;
			
			$laporan 				= $this->lm->getLaporan($dari_tanggal, $sampai_tanggal, $id_status);
		} else {
			$title 					= 'Laporan - ' . $data['dataUser']['username'];
			$laporan 				= $this->lm->getLaporan();
			$dari_tanggal 			= "";
			$sampai_tanggal 		= "";
			$val_dari_tanggal 		= date("Y/m/01");
			$val_sampai_tanggal		= date("Y/m/d");
		}

		$data["allStatus"]			= $this->status->getAllStatus();
		$data["title"]				= $title;
		$data["status"]				= $status;
		$data["id_status"]			= $id_status;
		$data["laporan"]			= $laporan;
		$data["dari_tanggal"]		= $dari_tanggal;
		$data["sampai_tanggal"]		= $sampai_tanggal;
		$data["val_dari_tanggal"]	= $val_dari_tanggal;
		$data["val_sampai_tanggal"]	= $val_sampai_tanggal;

		$this->layout->view_admin('laporan/index', $data);
	}
}