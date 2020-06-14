<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'am');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->load->model('Layout_model','layout');
		$this->load->model('LayananPaket_model', 'lpm');
		$this->load->model('PickupBarang_model', 'pbm');
	}
	
	public function index()
	{
		$data['title'] 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
		$data['provinsi']		= $this->provinsi->getAllProvinsi();
		$data['layanan_paket'] 	= $this->lpm->getAllLayananPaket();
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

	public function pesanan()
	{
		$this->form_validation->set_rules('nama_pengirim', 'nama pengirim', 'required|trim');
		$this->form_validation->set_rules('no_whatsapp_pengirim', 'no whatsapp pengirim', 'required|trim');
		$this->form_validation->set_rules('alamat_pengirim', 'alamat pengirim', 'required|trim');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'required|trim');
		$this->form_validation->set_rules('berat_barang', 'berat barang', 'required|trim');
		$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'required|trim');
		$this->form_validation->set_rules('nama_penerima', 'nama penerima', 'required|trim');
		$this->form_validation->set_rules('no_whatsapp_penerima', 'no whatsapp penerima', 'required|trim');
		$this->form_validation->set_rules('alamat_penerima', 'alamat penerima', 'required|trim');
		$this->form_validation->set_rules('id_layanan_paket', 'id layanan paket', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
			$data['provinsi']		= $this->provinsi->getAllProvinsi();
			$data['layanan_paket']	= $this->lpm->getAllLayananPaket();
			$this->layout->view_auth('auth/index', $data);
		} else {
			$this->session->set_userdata(['pelanggan' => '1']);
			$this->pbm->addPickupBarang();
		}
	}

	public function cek_status_pesanan()
	{
		$this->form_validation->set_rules('no_resi', 'No. Resi', 'required|trim');
		if ($this->form_validation->run() == false) {
			$data['title'] 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
			$data['provinsi']		= $this->provinsi->getAllProvinsi();
			$data['layanan_paket']	= $this->lpm->getAllLayananPaket();
			$this->load->view('templates/header-auth', $data);
			$this->load->view('auth/index', $data);
			$this->load->view('templates/footer-auth', $data);
		} else {
			$data['no_resi'] = $this->pbm->cek_status_pesanan();
			if ($data['no_resi'] > 0) {
				$data['berhasil'] = true;
			} else {
				$data['error'] = true;
			}
			$data['title'] 			= 'Selamat Datang di JNE Tangsel BSD Nusaloka';
			$data['provinsi']		= $this->provinsi->getAllProvinsi();
			$data['layanan_paket']  = $this->lpm->getAllLayananPaket();
			$this->load->view('templates/header-auth', $data);
			$this->load->view('auth/index', $data);
			$this->load->view('templates/footer-auth', $data);
		}
	}
}
