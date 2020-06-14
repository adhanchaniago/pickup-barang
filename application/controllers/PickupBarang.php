<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang extends CI_Controller {
	public $status 	= [];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('PickupBarang_model', 'pbm');
		$this->load->model('LayananPaket_model', 'lpm');
		$this->load->model('Pengirim_model', 'pengm');
		$this->load->model('Penerima_model', 'pm');
		$this->mm->check_status_login();
		$this->status[1] 			= "Pending";
		$this->status[2] 			= "Kurir Menjemput";
		$this->status[3] 			= "Barang Sampai Logistik";
	}

	public function index()
	{
		
		$data['status']				= $this->status;
		$data['dataUser'] 			= $this->mm->getDataUser();
		$data['layanan_paket'] 		= $this->lpm->getAllLayananPaket();
		$data['penerima']			= $this->pm->getAllPenerima();
		$data['pengirim']			= $this->pengm->getAllPengirim();
		$data['pickup_barang'] 		= $this->pbm->getAllPickupBarang();
		$data['title'] 				= 'Pickup Barang - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('id_pengirim', 'nama pengirim', 'required|trim');
		$this->form_validation->set_rules('id_penerima', 'nama penerima', 'required|trim');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'required|trim');
		$this->form_validation->set_rules('berat_barang', 'berat barang', 'required|trim');
		$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'required|trim');
		$this->form_validation->set_rules('id_layanan_paket', 'id layanan paket', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('pickup_barang/index', $data);
		} else {
		    $this->pbm->addPickupBarang();
		}
	}

	public function datatable()
	{
		$list 		= $this->pbm->getDatatable();
		$data 		= array();
		$no 		= $this->input->post('start');
		$dataUser	= $this->mm->getDataUser();
		foreach ($list as $item) {
			$no++;

			if ($dataUser['id_jabatan'] == '1' || $dataUser['id_jabatan'] == '2') {
				$button 	= "<div class='text-center'>";
					$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-pickupBarang' data-id='".$item->id_pickup_barang."'><i class='fas fa-fw fa-edit'></i></a>";
					$button 	.= "<a href='".base_url('pickupBarang/deletePickupBarang/'.$item->id_pickup_barang) ."'' class='m-1 btn btn-danger btn-delete' data-text=' ".$item->nama_pengirim." | ".$item->nama_barang." |  ".$item->nama_penerima."'><i class='fas fa-fw fa-trash'></i></a>";
				$button 	.= "</div>";
			}

			if ($item->status == 1) {
				$status 	= '<span class="btn btn-danger"><i class="fas fa-fw fa-stopwatch"></i></span>';
			}elseif ($item->status == 2) {
				$status 	= '<span class="btn btn-warning"><i class="fas fa-fw fa-shipping-fast"></i></span>';
			}else{
				$status 	= '<span class="btn btn-success"><i class="fas fa-fw fa-pallet"></i></span>';
			}

			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->no_resi;
			$row[] 	= $item->nama_pengirim;
			$row[] 	= $item->nama_barang;
			$row[] 	= $item->berat_barang;
			$row[] 	= $item->jumlah_barang;
			$row[] 	= $item->nama_penerima;
			$row[] 	= $item->tanggal_pemesanan;
			$row[] 	= $item->tanggal_penjemputan;
			$row[] 	= $item->tanggal_masuk_logistik;
			$row[] 	= $item->jenis_layanan;
			$row[] 	= $status;

			if ($dataUser['id_jabatan'] == '1' || $dataUser['id_jabatan'] == '2') {
				$row[] 	= $button;
			}

			$data[] = $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->pbm->countAllDatatable(),
			"recordsFiltered" 		=> $this->pbm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}

	public function getPickupBarangById()
	{
		$id_pickup_barang 	= $this->input->post('id_pickup_barang');
		$result 			= $this->pbm->getPickupBarangById($id_pickup_barang);

		echo json_encode($result);
	}

	public function editPickupBarang($id)
	{
		$data['status']				= $this->status;
		$data['dataUser'] 			= $this->mm->getDataUser();
		$data['layanan_paket'] 		= $this->lpm->getAllLayananPaket();
		$data['pickup_barang'] 		= $this->pbm->getAllPickupBarang();
		$data['title'] 				= 'Pickup Barang - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('id_pengirim', 'nama pengirim', 'required|trim');
		$this->form_validation->set_rules('id_penerima', 'nama penerima', 'required|trim');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'required|trim');
		$this->form_validation->set_rules('berat_barang', 'berat barang', 'required|trim');
		$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'required|trim');
		$this->form_validation->set_rules('id_layanan_paket', 'id layanan paket', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('pickup_barang/index', $data);
		} else {
		    $this->pbm->editPickupBarang($id);
		}
	}

	public function deletePickupBarang($id)
	{
		$this->pbm->deletePickupBarang($id);
	}
}