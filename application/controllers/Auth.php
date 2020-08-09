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
		$this->load->model('Pengirim_model', 'peng');
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
		if (!isset($_GET['no_wa_pengirim'])) {
			redirect('auth/index#tracking');
		}
		$data['title']	 			= 'Cek Pesanan - '.$this->input->get('no_wa_pengirim');

		if (!isset($_GET['dari_tanggal']) AND !isset($_GET['sampai_tanggal'])) {
			$headline 				= ' - Semua';
			$status					= $this->status->getStatusById();
			$no_wa_pengirim 		= $this->mm->no_telepon_validasi($_GET['no_wa_pengirim']);
			$pesanan 				= $this->pesm->getPesananByNoWaPengirimNoSort($no_wa_pengirim);
			$jml_status				= $this->pesm->getJmlStatusByNoWaPengirimNoSort($no_wa_pengirim);
			$val_dari_tanggal		= date('Y-m-d');
			$val_sampai_tanggal		= date('Y-m-d');
			$dari_tanggal			= '';
			$sampai_tanggal			= '';
		} else {
			$dari_tanggal			= $_GET["dari_tanggal"];
			$sampai_tanggal			= $_GET["sampai_tanggal"];
			$id_status	 			= $_GET["id_status"];
			$status					= $this->status->getStatusById($id_status);
			$headline 				= ' - '.$dari_tanggal.' s/d '.$sampai_tanggal.' - '.$status['status'];
			$no_wa_pengirim 		= $this->mm->no_telepon_validasi($_GET['no_wa_pengirim']);
			$pesanan 				= $this->pesm->getPesananByNoWaPengirim($dari_tanggal, $sampai_tanggal, $id_status, $no_wa_pengirim);
			$jml_status				= $this->pesm->getJmlStatusByNoWaPengirim($dari_tanggal, $sampai_tanggal, $id_status, $no_wa_pengirim);
			$val_dari_tanggal		= $dari_tanggal;
			$val_sampai_tanggal		= $sampai_tanggal;
		}


		$data["allStatus"]			= $this->status->getAllStatus();
		$data["headline"]			= $headline;
		$data["status"]				= $status;
		$data["pesanan"]			= $pesanan;
		$data["jml_status"]			= $jml_status;
		$data["val_dari_tanggal"]	= $val_dari_tanggal;
		$data["val_sampai_tanggal"]	= $val_sampai_tanggal;
		$data["dari_tanggal"]		= $dari_tanggal;
		$data["sampai_tanggal"]		= $sampai_tanggal;

		$no_wa_pengirim = $this->mm->no_telepon_validasi($this->input->get('no_wa_pengirim', true));
		$data['pengirim'] 			= $this->peng->getPengirimByNoWa($no_wa_pengirim);
		$data['pesanan'] 			= $this->pbm->cek_status_pesanan($no_wa_pengirim);
		// print_r($_GET);die;
		if (isset($_GET["printExcel"])) {
			$filename 	= 'JNETangseLBsd'.$no_wa_pengirim.'Tgl'.$val_dari_tanggal.'-'.$val_sampai_tanggal.'.xls';
			header("Content-type: application/vnd-ms-excel");
			header("Content-Disposition: attachment; filename=".$filename);
			echo $this->layout->view_auth('auth/print_excel', $data, TRUE);
			die;
		}
		if (count($data['pesanan']) > 0 OR $data['pengirim'] > 0) {
			$data['berhasil'] 		= true;
			$this->layout->view_auth('auth/cek_pesanan', $data);

		} else {
			// redirect('auth/index#cek_pesanan','refresh');
			$data['error'] 			= true;
			$this->layout->view_auth('auth/index', $data);
		}
	
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
