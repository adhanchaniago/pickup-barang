<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayananPaket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('LayananPaket_model', 'lpm');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['layanan_paket'] = $this->lpm->getAllLayananPaket();
		$data['title'] = 'Layanan Paket - ' . $data['dataUser']['username'];
		$this->form_validation->set_rules('layanan_paket', 'Layanan Paket', 'required|trim');
		$this->form_validation->set_rules('harga_layanan_paket', 'Harga Layanan Paket', 'required|trim');
		$this->form_validation->set_rules('durasi_pengiriman', 'Durasi Pengiriman', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('layanan_paket/index', $data);
		} else {
		    $this->lpm->addLayananPaket();
		}
	}

	public function editLayananPaket($id)
	{
		$this->mm->check_status_login();
		$data['dataUser'] = $this->mm->getDataUser();
		$data['layanan_paket'] = $this->lpm->getAllLayananPaket();
		$data['title'] = 'Layanan Paket - ' . $data['dataUser']['username'];
		$this->form_validation->set_rules('layanan_paket', 'Layanan Paket', 'required|trim');
		$this->form_validation->set_rules('harga_layanan_paket', 'Harga Layanan Paket', 'required|trim');
		$this->form_validation->set_rules('durasi_pengiriman', 'Durasi Pengiriman', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('layanan_paket/index', $data);
		} else {
		    $this->lpm->editLayananPaket($id);
		}
	}

	public function deleteLayananPaket($id)
	{
		$this->lpm->deleteLayananPaket($id);
	}
}