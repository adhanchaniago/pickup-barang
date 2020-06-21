<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Layout_model','layout');
		$this->load->model('PickupBarang_model', 'pbm');
		$this->load->model('JenisLayanan_model', 'jenis_layanan');
		$this->load->model('Status_model', 'status');
	}

	public function index()
	{
		$this->mm->check_status_login();
		$dataUser 					= $this->mm->getDataUser();
		$data['status']				= $this->status->getAllStatus();
		$data['dataUser'] 			= $dataUser;
		$data['title'] 				= 'Pickup Barang - ' . $data['dataUser']['username'];

		$this->form_validation->set_rules('no_resi', 'Nomor Resi', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_admin('pickup_barang/index', $data);
		} else {
			$id_pickup_barang 	= $this->input->post('id_pickup_barang');
		    $this->pbm->editPickupBarang($id_pickup_barang);
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

				if ($item->id_status == 3 ) {
					$button 	.= "<a href='#' class='m-1 btn btn-success btn-edit-pickupBarang btn-xs' data-id='".$item->id_pickup_barang."'><i class='fas fa-fw fa-edit'></i></a>";
				}elseif($item->id_status == 4){
					$button 	.= "<a target='_blank' href='".base_url('pickupBarang/kirimResi/'.$item->id_pickup_barang) ."'' class='m-1 btn btn-primary btn-kirim-resi btn-xs' data-text=' ".kapital($item->nama_pengirim)."  |  ".kapital($item->no_wa_pengirim)."'><i class='fas fa-fw fa-paper-plane'></i></a>";
				}

				$button 	.= "<a href='".base_url('pickupBarang/deletePickupBarang/'.$item->id_pickup_barang) ."'' class='m-1 btn btn-danger btn-delete btn-xs' data-text=' ".kapital($item->nama_pengirim)."  |  ".kapital($item->nama_penerima)."'><i class='fas fa-fw fa-trash'></i></a>";
				$button 	.= "</div>";
			}
			$warna 			= bg_status($item->id_status,'btn');
			if ($item->id_status == 1) {
				$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-stopwatch"></i></span>';
			}elseif ($item->id_status == 2) {
				$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-shipping-fast"></i></span>';
			}elseif ($item->id_status == 3){
				$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-pallet"></i></span>';
			}else{
				$status 	= '<span class="btn '.$warna.' btn-xs"><i class="fas fa-fw fa-check"></i></span>';
			}

			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->no_resi;
			$row[] 	= kapital($item->nama_pengirim);
			$row[] 	= kapital($item->nama_penerima);
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
		$pengirim 							= $this->pengirim->getPengirimByIp();
		$dataUser 							= $this->mm->getDataUser();
		if (empty($pengirim) || $dataUser["id_jabatan"] !== NULL) {
			$pengirim["nama_pengirim"]		= "";
			$pengirim["alamat_pengirim"]	= "";
			$pengirim["no_wa_pengirim"]		= "";
			$data["pengirim"]				= $pengirim;
		}
		$data["pengirim"]					= $pengirim;
		$data["title"] 						= "Form Pickup Barang";
		$data["jenis_layanan"]				= $this->jenis_layanan->getAllJenisLayanan();
		$this->layout->view_auth('pickup_barang/form',$data);
	}
	
	public function kurir()
	{
		$this->mm->check_status_login();
		$status 					= $this->status->getAllStatus();
		$data["title"] 				= "Pickup Barang";
		$data["status"]				= $status;
		$this->layout->view_auth('pickup_barang/kurirPickup',$data);
	}
	
	public function kurirAjax()
	{
		$data 		= [];
		$id_status 	= $this->input->post('id_status');
		if ($id_status) {
			$data 	= ["id_status" 	=> $id_status];
		}
		$get 	= $this->pbm->getPickupBarangGroupByAlamat($data);
		$data 	= [];
		foreach ($get as $key) {
			$warna 			= bg_status($id_status);
			$warnaText		= text_status($id_status);

			$data[] 	= "<div class='col-12 col-md-6 col-lg-4 my-1'>
			<a class='".$warna." ".$warnaText." p-3 shadow-sm d-block' href='". base_url('pickupBarang/detailPickup/'.$key["no_wa_pengirim"])."/".$id_status."'>
				<div class='row'>
					<div class='col-5 text-center relative border-right border-dark'>
						<i class='fas fa-fw fa-map-marker-alt fa-lg font'></i>
						<p class='text-center total'>".nominal($key["total"])." Paket</p>
					</div>
					<div class='col'>
						<p>".kapital($key["alamat_pengirim"])."</p>
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
			$get_status 			= $this->status->getStatusById($status);
			$statusText 			= $get_status["status"];

			$data["title"] 			= "Detail Pickup Barang";
			$data["statusText"]		= $statusText;
			$data["status"]			= $status;
			$data["pickup_barang"]	= $this->pbm->getPickupBarangByWaAndStatus($no_wa_pengirim, $status)->row_array();
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
			$warna 			= bg_status($key["id_status"]);
			$warnaText		= text_status($key["id_status"]);
			if ($key["id_status"] == 1) {
				$checkbox 	= "<input type='hidden' name='pending[]' value='".$key["id_pickup_barang"]."' class='font'>";
				$pending++;
			}elseif($key["id_status"] == 2){
				$checkbox 	= "<input type='checkbox' name='pickup[]' value='".$key["id_pickup_barang"]."' class='font'>";
				$pickup++;
			}else{
				$checkbox 	= "";
			}
			$data[] 	= "
			<div class='col-12 col-sm-6 col-md-4 col-lg-3 my-1'>
				<div class='".$warna." p-3 shadow-sm'>
					<div class='row'>
						<div class='col-2 text-center border-right'>".$checkbox."</div>
						<a class='col d-block ".$warnaText." btnDetail' href='".$key["id_pickup_barang"]."'>
							<p>".kapital($key["nama_penerima"])."</p>
							<small>".kapital($key["no_wa_penerima"])."</small>
						</a>
					</div>
				</div>
			</div>";
		}
		echo json_encode([$data,$pending,$pickup]);
	}

	public function importExcel()
	{
		require_once APPPATH.'/third_party/PHPExcel/PHPExcel.php';
		$this->pbm->importExcel();
	}
	
	public function kirimResi($id_pickup_barang)
	{
		$data = $this->pbm->getPickupBarangById($id_pickup_barang);
		redirect('https://api.whatsapp.com/send?phone='.$data['no_wa_pengirim'].'&text=No. Resi Anda ' . $data['no_resi']);
	}

}