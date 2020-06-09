<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Auth_model', 'am');
		$this->load->model('LayananPaket_model', 'lpm');
	}
	
	public function index()
	{
		$data['title'] = 'Selamat Datang di JNE Tangsel BSD Nusaloka';
		$data['layanan_paket'] = $this->lpm->getAllLayananPaket();
		$this->load->view('templates/header-auth', $data);
		$this->load->view('auth/index', $data);
		$this->load->view('templates/footer-auth', $data);
	}

	public function login()
	{
		if ($this->session->userdata('id_user')) {
			redirect('admin');
		}

		$data['title'] = 'Masuk - Pickup Barang';
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('password', 'Password', 'required');
		if ($this->form_validation->run() == FALSE) {
			$this->load->view('templates/header-auth', $data);
			$this->load->view('auth/login', $data);
			$this->load->view('templates/footer-auth', $data);
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
			$data['title'] = 'Landing Page';
			$data['layanan_paket'] = $this->lpm->getAllLayananPaket();
			$this->load->view('templates/header-auth', $data);
			$this->load->view('auth/index', $data);
			$this->load->view('templates/footer-auth', $data);
		} else {
			$data = [
				'nama_pengirim' => ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' => $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' => $this->input->post('alamat_pengirim', true),	
				'nama_barang' => $this->input->post('nama_barang', true),	
				'berat_barang' => $this->input->post('berat_barang', true),	
				'jumlah_barang' => $this->input->post('jumlah_barang', true),	
				'nama_penerima' => ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' => $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' => $this->input->post('alamat_penerima', true),	
				'tanggal_pemesanan' => date('Y-m-d H:i:s'),
				'id_layanan_paket' => $this->input->post('id_layanan_paket', true)
			];
			$this->db->insert('pickup_barang', $data);
			$this->session->set_flashdata('message-success', 'Pelanggan ' . $data['nama_pengirim'] . ' berhasil menambahkan pesanan ' . $data['nama_barang'] . ' untuk kami kirim. Tunggu kurir kami untuk mengambil barang Anda. Terima Kasih :D');
			$this->mm->createLog('Pelanggan ' . $data['nama_pengirim'] . ' berhasil menambahkan pesanan ' . $data['nama_barang'], NULL);
			redirect('auth');
		}
	}
}
