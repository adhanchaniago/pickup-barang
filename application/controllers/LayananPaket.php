<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayananPaket extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('LayananPaket_model', 'lpm');
		$this->load->model('Provinsi_model', 'provinsi');
		$this->load->model('JenisLayanan_model','jenisLayanan');
		$this->load->model('JenisPaket_model','jenisPaket');
		$this->mm->check_status_login();
	}

	public function index()
	{
		$data['dataUser'] 				= $this->mm->getDataUser();
		$data['title'] 					= 'Layanan Paket - ' . $data['dataUser']['username'];
		$data['provinsi']				= $this->provinsi->getAllProvinsi();
		$data['jenis_paket']			= $this->jenisPaket->getAllJenisPaket();
		$data['jenis_layanan']			= $this->jenisLayanan->getAllJenisLayanan();

		$this->form_validation->set_rules('harga', 'Harga', 'required|trim');
		$this->form_validation->set_rules('durasi_pengiriman', 'Durasi Pengiriman', 'required|trim');
		$this->form_validation->set_rules('id_jenis_paket', 'Jenis Paket', 'required|trim');
		$this->form_validation->set_rules('id_jenis_layanan', 'Jenis Layanan', 'required|trim');
		$this->form_validation->set_rules('id_kecamatan_asal', 'Kecamatan Asal', 'required|trim');
		$this->form_validation->set_rules('id_kecamatan_tujuan', 'Kecamatan Tujuan', 'required|trim');
		$this->form_validation->set_rules('id_kabupaten_asal', 'Kabupaten Asal', 'required|trim');
		$this->form_validation->set_rules('id_kabupaten_tujuan', 'Kabupaten Tujuan', 'required|trim');
		$this->form_validation->set_rules('id_provinsi_asal', 'Provinsi Asal', 'required|trim');
		$this->form_validation->set_rules('id_provinsi_tujuan', 'Provinsi Tujuan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('layanan_paket/index', $data);
		} else {
			if ($this->input->post('id_layanan_paket')) {
				$id_layanan_paket 	= $this->input->post('id_layanan_paket');
		    	$this->lpm->editLayananPaket($id_layanan_paket);
			}else{
		    	$this->lpm->addLayananPaket();
			}
		}
	}

	public function datatable()
	{
		$list 		= $this->lpm->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			$button 	= "<div class='text-center'>";
			$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-layananPaket' data-id='".$item->id_layanan_paket."'><i class='fas fa-fw fa-edit'></i></a>";

			if ($dataUser['id_jabatan'] == 1) {
				$button 	.= "<a href='".base_url('layananPaket/deleteLayananPaket/'.$item->id_layanan_paket) ."' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->jenis_layanan."'><i class='fas fa-fw fa-trash'></i></a>";
			}

			$button 	.= "</div>";


			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->jenis_layanan;
			$row[] 	= 'Kec. '.$item->kec_asal.', Kab / Kota. '.$item->kab_asal.', Prov. '.$item->prov_asal.', '.$item->negara_asal;
			$row[] 	= 'Kec. '.$item->kec_tujuan.', Kab / Kota. '.$item->kab_tujuan.', Prov. '.$item->prov_tujuan.', '.$item->negara_tujuan;
			$row[] 	= $item->jenis_paket;
			$row[] 	= number_format($item->harga);
			$row[] 	= $item->durasi_pengiriman;

			if ($dataUser['id_jabatan'] == '1' || $dataUser['id_jabatan'] == '2') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->lpm->countAllDatatable(),
			"recordsFiltered" 		=> $this->lpm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}
	public function getLayananPaketById()
	{
		$id_layanan_paket 	= $this->input->post('id_layanan_paket');
		$result 			= $this->lpm->getLayananPaketById($id_layanan_paket);

		echo json_encode($result);
	}

	public function deleteLayananPaket($id)
	{
		$this->lpm->deleteLayananPaket($id);
	}
}