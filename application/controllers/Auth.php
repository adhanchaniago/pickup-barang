<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'am');
		$this->load->model('Layout_model','layout');
		$this->load->model('PickupBarang_model', 'pbm');
		$this->load->model('Status_model', 'status');
		$this->load->model('Pesanan_model', 'pesm');
	}
	
	public function index()
	{
		$data['title'] 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
		$this->layout->view_auth('auth/index', $data);
	}

	public function login()
	{
		if ($this->session->userdata('id_user')) {
			redirect('admin');
		}

		$data['title'] 			= 'Masuk - Pickup Barang';

		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->layout->view_auth('auth/login', $data);
		} else {
			$this->am->login();
		}
	}

	public function logout()
	{
		if ($this->session->userdata('id_user')) {
			$this->mm->createLog('Pengguna ' . $this->session->userdata('username') . ' berhasil logout' , $this->session->userdata('id_user'));
		}

		$this->session->unset_userdata('id_user');
		$this->session->unset_userdata('id_outlet');
		$this->session->unset_userdata('id_jabatan');
		$this->session->unset_userdata('username');
		$this->session->sess_destroy();
		session_destroy();
		redirect('auth/login');
	}

	public function cek_status_pesanan()
	{
		$headline 				= ' - Hari Ini';
		$status					= $this->status->getStatusById();
		$pesanan 				= $this->pesm->getPesananByNoWaPengirimNoSort($_POST['no_wa_pengirim']);
		$jml_status				= $this->pesm->getJmlStatusByNoWaPengirimNoSort($_POST['no_wa_pengirim']);
		$val_dari_tanggal		= date('Y/m/d');
		$val_sampai_tanggal		= date('Y/m/d');
		$dari_tanggal			= '';
		$sampai_tanggal			= '';

		$data["allStatus"]			= $this->status->getAllStatus();
		$data["headline"]			= $headline;
		$data["status"]				= $status;
		$data["pesanan"]			= $pesanan;
		$data["jml_status"]			= $jml_status;
		$data["val_dari_tanggal"]	= $val_dari_tanggal;
		$data["val_sampai_tanggal"]	= $val_sampai_tanggal;
		$data["dari_tanggal"]		= $dari_tanggal;
		$data["sampai_tanggal"]		= $sampai_tanggal;

		$data['title']	 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
		$this->form_validation->set_rules('no_wa_pengirim', 'No. WhatsApp Pengirim', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_auth('auth/index', $data);
		} else {
			$data['cek_status_pesanan'] = $this->pbm->cek_status_pesanan();
			if ($data['cek_status_pesanan'] > 0) {
				$data['berhasil'] = true;
			} else {
				$data['error'] = true;
			}
			$this->layout->view_auth('auth/index', $data);
		}
	}

	public function cek_status_pesanan_filter()
	{
		if (isset($_GET['dari_tanggal']) AND isset($_GET['sampai_tanggal']) AND isset($_GET['id_status'])) {
			$dari_tanggal			= $_GET["dari_tanggal"];
			$sampai_tanggal			= $_GET["sampai_tanggal"];

			$status					= $this->status->getStatusById($_GET["id_status"]);
			$headline 				= ' - '.$dari_tanggal.' s/d '.$sampai_tanggal.' - '.$status['status'];
			$pesanan 				= $this->pesm->getPesananByNoWaPengirim($_GET['dari_tanggal'], $_GET['sampai_tanggal'], $_GET['id_status'], $_GET['no_wa_pengirim']);
			$jml_status				= $this->pesm->getJmlStatusByNoWaPengirim($_GET['dari_tanggal'], $_GET['sampai_tanggal'], $_GET['no_wa_pengirim']);
			$val_dari_tanggal		= $dari_tanggal;
			$val_sampai_tanggal		= $sampai_tanggal;

			$data["allStatus"]			= $this->status->getAllStatus();
			$data["headline"]			= $headline;
			$data["status"]				= $status;
			$data["pesanan"]			= $pesanan;
			$data["jml_status"]			= $jml_status;
			$data["val_dari_tanggal"]	= $val_dari_tanggal;
			$data["val_sampai_tanggal"]	= $val_sampai_tanggal;
			$data["dari_tanggal"]		= $dari_tanggal;
			$data["sampai_tanggal"]		= $sampai_tanggal;
		}

		$data['title']	 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
		$data['cek_status_pesanan'] = $this->pbm->cek_status_pesananByNoWaPengirim($_GET['no_wa_pengirim']);
		if ($data['cek_status_pesanan'] > 0) {
			$data['berhasil'] = true;
		} else {
			$data['error'] = true;
		}
		$this->layout->view_auth('auth/index', $data);
	}

	// public function datatablePesanan()
	// {
	// 	$list 		= $this->pesm->getDatatable();
	// 	$data 		= array();
	// 	$no 		= $this->input->post('start');
	// 	foreach ($list as $item) {
	// 		$warna 			= bg_status($item->id_status,'btn');
	// 		if ($item->id_status == 1) {
	// 			$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-stopwatch"></i></span>';
	// 		}elseif ($item->id_status == 2) {
	// 			$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-shipping-fast"></i></span>';
	// 		}elseif ($item->id_status == 3){
	// 			$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-pallet"></i></span>';
	// 		}else{
	// 			$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-check"></i></span>';
	// 		}

	// 		$row 	= array();

	// 		$row[] 	= $item->no_resi;
	// 		$row[] 	= kapital($item->nama_penerima);
	// 		$row[] 	= $item->tanggal_pemesanan;
	// 		$row[] 	= $status;


	// 		$data[] = $row;
	// 	}
	// 	$output = array(
	// 		"draw" 					=> $this->input->post('draw'),
	// 		"recordsTotal" 			=> $this->pesm->countAllDatatable(),
	// 		"recordsFiltered" 		=> $this->pesm->countFilteredDatatable(),
	// 		"data" 					=> $data
	// 	);

	// 	echo json_encode($output);
	// }
}
