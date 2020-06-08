<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('PickupBarang_model', 'pbm');
		$this->load->model('LayananPaket_model', 'lpm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['layanan_paket'] = $this->lpm->getAllLayananPaket();
		$data['pickup_barang'] = $this->pbm->getAllPickupBarang();
		$data['title'] = 'Pickup Barang - ' . $data['dataUser']['username'];
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
			$this->load->view('templates/header-admin', $data);
			$this->load->view('pickup_barang/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} else {
		    $this->pbm->addPickupBarang();
		}
	}

	public function editPickupBarang($id)
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['pickup_barang'] = $this->pbm->getAllPickupBarang();
		$data['title'] = 'Pickup Barang - ' . $data['dataUser']['username'];
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
			$this->load->view('templates/header-admin', $data);
			$this->load->view('pickup_barang/index', $data);
			$this->load->view('templates/footer-admin', $data);
		} else {
		    $this->pbm->editPickupBarang($id);
		}
	}

	public function deletePickupBarang($id)
	{
		$this->pbm->deletePickupBarang($id);
	}
}