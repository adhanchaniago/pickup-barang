<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('Laporan_model', 'lm');
	}

	public function index()
	{
		$data['dataUser'] 	= $this->mm->getDataUser();
		if (isset($_POST['dari_tanggal']) AND isset($_POST['sampai_tanggal']) AND isset($_POST['status'])) {
			$data['laporan'] 	= $this->lm->getLaporan($_POST['dari_tanggal'], $_POST['sampai_tanggal'], $_POST['status']);
			if (isset($_POST['status'])) {
		      if ($_POST['status'] == '1') {
		        $status = 'Pending';
		      } elseif ($_POST['status'] == '2') {
		        $status = 'Kurir Menjemput';
		      } elseif ($_POST['status'] == '3') {
		        $status = 'Barang Masuk Logistik';
		      } else {
		        $status = 'Semua';
		      }
		    } 
			$data['title'] 		= 'Laporan dari tanggal' . $_POST['dari_tanggal'] . 's/d' . $_POST['sampai_tanggal'] . ', status: '. $status;
		} else {
			$data['laporan'] 	= $this->lm->getLaporan();
			$data['title'] 		= 'Laporan - ' . $data['dataUser']['username'];
		}
		$this->layout->view_admin('laporan/index', $data);
	}
}