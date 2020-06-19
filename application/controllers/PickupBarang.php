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
		$this->load->model('JenisLayanan_model', 'jenis_layanan');
		$this->status[1] 			= "Pending";
		$this->status[2] 			= "Kurir Menjemput";
		$this->status[3] 			= "Barang Masuk Logistik";
	}

	public function index()
	{
		$this->mm->check_status_login();
		$dataUser 					= $this->mm->getDataUser();
		$data['status']				= $this->status;
		$data['dataUser'] 			= $dataUser;
		$data['title'] 				= 'Pickup Barang - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('id_pengirim', 'nama pengirim', 'required|trim');
		$this->form_validation->set_rules('id_penerima', 'nama penerima', 'required|trim');
		$this->form_validation->set_rules('nama_barang', 'nama barang', 'required|trim');
		$this->form_validation->set_rules('berat_barang', 'berat barang', 'required|trim');
		$this->form_validation->set_rules('jumlah_barang', 'jumlah barang', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('pickup_barang/index', $data);
		} else {
			if ($this->input->post('id_pickup_barang')) {
				$id_pickup_barang 	= $this->input->post('id_pickup_barang');
			    $this->pbm->editPickupBarang($id_pickup_barang);
			}else{
			    $this->pbm->addPickupBarang();
			}
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

	
	public function deletePickupBarang($id)
	{
		$this->pbm->deletePickupBarang($id);
	}

	public function form()
	{
		if ($this->input->post('submit')) {
			$this->pbm->addPickupBarang();
		}
		$data["title"] 				= "Form Pickup Barang";
		$data["jenis_layanan"]		= $this->jenis_layanan->getAllJenisLayanan();
		$this->layout->view_auth('pickup_barang/form',$data);
	}
	
	public function kurir()
	{
		$this->mm->check_status_login();
		$this->status[0]			= "Semua";
		$status 					= $this->status;
		$data["title"] 				= "Pickup Barang";
		$data["status"]				= [2=>$status[2],1=>$status[1],3=>$status[3],0=>$status[0]];
		$this->layout->view_auth('pickup_barang/kurirPickup',$data);
	}
	public function kurirAjax()
	{
		$data 		= [];
		$status 	= $this->input->post('status');
		if ($status) {
			$data 	= ["status" 	=> $status];
		}
		$get 	= $this->pbm->getPickupBarangGroupByAlamat($data);
		$data 	= [];
		foreach ($get as $key) {
			if ($status == 3) {
				$warna		= 'bg-success';
				$warnaText 	= 'text-light';
			}elseif($status == 2){
				$warna		= 'bg-warning';
				$warnaText 	= 'text-dark';
			}elseif($status == 1){
				$warna		= 'bg-danger';
				$warnaText 	= 'text-light';
			}else{
				$warna		= 'bg-white';
				$warnaText 	= '';
			}

			$data[] 	= "<div class='col-12 col-sm-6 col-md-4 col-lg-3 my-1'>
			<a class='".$warna." ".$warnaText." p-3 shadow-sm d-block' href='". base_url('pickupBarang/detailPickup/'.$key["no_wa_pengirim"])."/".$status."'>
				<div class='row'>
					<div class='col-3 col-sm-12 text-center relative'>
						<i class='fas fa-fw fa-map-marker-alt fa-lg font'></i>

					</div>
					<div class='col col-sm-12'>
						<p>".$key["alamat_pengirim"]."</p>
						<p class='text-center'>".$key["total"]." Paket</p>
					</div>
				</div>
			</a>
		</div>";
		}
		echo json_encode($data);
	}
	public function detailPickup($no_wa_pengirim,$status = 0)
	{
		$this->mm->check_status_login();
		if ($this->input->post('btnPending') == 1) {
			$this->pbm->ambilPickupBarang();
		}elseif ($this->input->post('btnPickup') == 1) {
			$this->pbm->terimaPickupBarang();
		}else{
			$data["title"] 			= "Detail Pickup Barang";
			$this->status[0]		= "Semua";
			$data["statusText"]		= $this->status[$status];
			$data["status"]			= $status;
			$data["pickup_barang"]	= $this->pbm->getPickupBarangByWaAndStatus($no_wa_pengirim, $status)->row_array();;
			$this->layout->view_auth('pickup_barang/kurirDetailPickup',$data);
		}
	}
	public function detailPickupAjax()
	{
		$data 				= [];
		$id_status 			= $this->input->post('id_status');
		$no_wa_pengirim 	= $this->input->post('no_wa_pengirim');
		$get 				= $this->pbm->getPickupBarangByWaAndStatus($no_wa_pengirim,$id_status)->result_array();
		$data 				= [];
		$total 				= 0;
		$pending			= 0;
		$pickup 			= 0;
		foreach ($get as $key) {
			if ($key["status"] == 3) {
				$checkbox 	= "";
				$warna		= 'bg-success';
				$warnaText 	= 'text-light';
			}elseif($key["status"] == 2){
				$checkbox 	= "<input type='checkbox' name='pickup[]' value='".$key["id_pickup_barang"]."' class='font'>";
				$warna		= 'bg-warning';
				$warnaText 	= 'text-dark';
				$pickup++;
			}elseif($key["status"] == 1){
				$checkbox 	= "<input type='hidden' name='pending[]' value='".$key["id_pickup_barang"]."' class='font'>";
				$warna		= 'bg-danger';
				$warnaText 	= 'text-light';
				$pending++;
			}
			$data[] 	= "
			<div class='col-12 col-sm-6 col-md-4 col-lg-3 my-1'>
				<div class='".$warna." p-3 shadow-sm'>
					<div class='row'>
						<div class='col-2 text-center border-right'>".$checkbox."</div>
						<a class='col d-block ".$warnaText." btnDetail' href='".$key["id_pickup_barang"]."'>
							<p>".$key["nama_barang"]."</p>
							<small>".$key["no_resi"]."</small>
						</a>
					</div>
				</div>
			</div>";
			$total 		+= $key["harga"];
		}
		echo json_encode([$data,$total,$pending,$pickup]);
	}
}