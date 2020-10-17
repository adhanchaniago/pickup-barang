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
		$this->form_validation->set_rules('berat_barang', 'Berat Barang', 'required|trim');
		$this->form_validation->set_rules('harga_pengiriman', 'Harga Pengiriman', 'required|trim');
		if ($this->form_validation->run() == false) {
			if (!empty($this->input->get('id_pengirim'))) {
				$data["id_pengirim"]		= $this->input->get('id_pengirim');
				$data["pengirim"]			= $this->db->where('id_pengirim', $this->input->get('id_pengirim'))->get('pengirim')->row();
				$data["tanggal_pemesanan"]	= $this->input->get('tanggal_pemesanan');
				$this->layout->view_admin('pickup_barang/detail', $data);
			}else{
				$this->layout->view_admin('pickup_barang/index', $data);
			}
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
			$tanggal_pemesanan 	= date('Y-m-d',strtotime($item->tanggal_pemesanan));
			$button 	= "<div class='text-center'>";
			if ($item->id_status == 4) {
				$button 	.= "<a href='".base_url('pickupBarang/kirimResi?id_pengirim='.$item->id_pengirim.'&tanggal_pemesanan='.$tanggal_pemesanan) ."' class='m-1 btn btn-primary btn-kirim-resi btn-xs' data-text=' ".kapital($item->nama_pengirim)."  |  ".kapital($item->no_wa_pengirim)."'><i class='fab fa-fw fa-whatsapp'></i></a>";
			}else{
				$button 	.= "<a href='javascript:;' class='m-1 btn btn-primary btn-xs disabled'><i class='fab fa-fw fa-whatsapp'></i></a>";
			}

			$button 	.= "<a href='".base_url('pickupBarang/index?id_pengirim='.$item->id_pengirim.'&tanggal_pemesanan='.date('Y-m-d',strtotime($item->tanggal_pemesanan))) ."'' class='m-1 btn btn-secondary btn-xs'><i class='fas fa-fw fa-bars'></i></a>";
			$button 	.= "</div>";

			$warna 		= bg_status($item->id_status,'btn');
			$icon 		= icon_status($item->id_status);
			$status 	= '<span class="btn '.$warna.' btn-xs "><i class="fas fa-fw '.$icon.'"></i> '.$item->status.'</span>';
			$status 	= '<div class="text-center">'.$status.'</div>';

			$row 		= array();

			$row[] 		= "<div class='text-center'>".$no.".</div>";
			$row[] 		= kapital($item->nama_pengirim);
			$row[] 		= $item->no_wa_pengirim;
			$row[] 		= $item->alamat_pengirim;
			$row[] 		= $tanggal_pemesanan;
			$row[] 		= $status;
			$row[] 		= $button;

			$data[] 	= $row;
		}
		$output = array(
			"draw" 					=> $this->input->post('draw'),
			"recordsTotal" 			=> $this->pbm->countAllDatatable(),
			"recordsFiltered" 		=> $this->pbm->countFilteredDatatable(),
			"data" 					=> $data
		);

		echo json_encode($output);
	}

	public function datatable2()
	{
		$list 		= $this->pbm->getDatatable2();
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
					$button 	.= "<a href='".base_url('pickupBarang/kirimResi?id_pickup_barang='.$item->id_pickup_barang) ."'' class='m-1 btn btn-primary btn-kirim-resi btn-xs' data-text=' ".kapital($item->nama_pengirim)."  |  ".kapital($item->no_wa_pengirim)."'><i class='fab fa-fw fa-whatsapp'></i></a>";
				}

				$button 	.= "<a href='".base_url('pickupBarang/deletePickupBarang/'.$item->id_pickup_barang) ."'' class='m-1 btn btn-danger btn-delete btn-xs' data-text=' ".kapital($item->nama_pengirim)."  |  ".kapital($item->nama_penerima)."'><i class='fas fa-fw fa-trash'></i></a>";
				$button 	.= "</div>";
			}
			$warna 		= bg_status($item->id_status,'btn');
			$icon 		= icon_status($item->id_status);
			$status 	= '<span class="btn '.$warna.' btn-xs d-block" style="width:140px"><i class="fas fa-fw '.$icon.' "></i> '.$item->status.'</span>';

			$row 	= array();

			$row[] 	= "<div class='text-center'>".$no.".</div>";
			$row[] 	= $item->no_resi;
			$row[] 	= kapital($item->nama_penerima);
			$row[] 	= $item->no_wa_penerima;
			$row[] 	= $item->alamat_penerima;
			$row[] 	= $item->nama_barang;
			$row[] 	= $item->jumlah_barang;
			$row[] 	= $item->berat_barang;
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
			"recordsTotal" 			=> $this->pbm->countAllDatatable2(),
			"recordsFiltered" 		=> $this->pbm->countFilteredDatatable2(),
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
		require_once APPPATH.'/third_party/PHPExcel/PHPExcel.php';
		$pengirim 							= $this->pengirim->getPengirimByIp();
		$dataUser 							= $this->mm->getDataUser();
		if (empty($pengirim) || $dataUser !== NULL) {
			$pengirim["nama_pengirim"]		= "";
			$pengirim["alamat_pengirim"]	= "";
			$pengirim["no_wa_pengirim"]		= "";
			$data["pengirim"]				= $pengirim;
		}
		$data["pengirim"]					= $pengirim;
		$data["title"] 						= "Form Pickup Barang";
		$data["jenis_layanan"]				= $this->jenis_layanan->getAllJenisLayanan();
		$this->form_validation->set_rules('nama_pengirim', 'Nama Pengirim', 'required|trim');
		$this->form_validation->set_rules('no_wa_pengirim', 'No. Whatsapp Pengirim', 'required|trim');
		$this->form_validation->set_rules('alamat_pengirim', 'Alamat Pengirim', 'required|trim');

		//$this->form_validation->set_rules('nama_penerima[]', 'Nama Penerima', 'required|trim');
		//$this->form_validation->set_rules('no_wa_penerima[]', 'No. Whatsapp Penerima', 'required|trim');
		//$this->form_validation->set_rules('alamat_penerima[]', 'Alamat Penerima', 'required|trim');
		//$this->form_validation->set_rules('jenis_layanan[]', 'Jenis Layanan', 'required|trim');
		if ($this->form_validation->run() == false) {
			$this->layout->view_auth('pickup_barang/form',$data);
		} else {
			$this->pbm->addPickupBarang();
		}
	}
	
	public function kurir()
	{
		$this->mm->check_status_login();
		$status_all 				= $this->status->getAllStatus();
		$status 					= [];
		foreach ($status_all as $row) {
			$this->db->select('alamat_pengirim');
			$this->db->from('pengirim');
			$this->db->join('pickup_barang', 'pengirim.id_pengirim = pickup_barang.id_pengirim', 'inner');
			$this->db->where('id_status', $row["id_status"]);
			$this->db->group_by('alamat_pengirim');
			$count 					= $this->db->get()->num_rows();
			$row["total"]			= $count;
			$status[] 				= $row;
		}
		$this->db->select('alamat_pengirim');
		$this->db->from('pengirim');
		$this->db->join('pickup_barang', 'pengirim.id_pengirim = pickup_barang.id_pengirim', 'inner');
		$this->db->group_by('alamat_pengirim');
		$count_all					= $this->db->get()->num_rows();

		$warna 						= ["danger","warning",'success','primary'];
		$data["total_semua"]		= $count_all;
		$data['dataUser'] 			= $this->mm->getDataUser();
		$data["title"] 				= "Pickup Barang";
		$data["status"]				= $status;
		$data["warna"]				= $warna;
		$this->layout->view_operator('pickup_barang/kurirPickup',$data);
	}
	
	public function kurirAjax()
	{
		$data 		= [];
		$id_status 	= $this->input->post('id_status');
		if ($id_status) {
			$data 	= ["pickup_barang.id_status" 	=> $id_status];
		}
		$get 	= $this->pbm->getPickupBarangGroupByAlamat($data);
		$data 	= [];
		foreach ($get as $key) {
			$warna 			= bg_status($id_status);
			$warnaText		= text_status($id_status);
			// $params 		= $key["no_wa_pengirim"];
			$params 		= $key["alamat_pengirim"];
			$data[] 	= "<div class='col-12 col-md-6 col-lg-4 my-1'>
			<a class='".$warna." ".$warnaText." p-3 shadow-sm d-block' href='". base_url('pickupBarang/detailPickup/?alamat_pengirim='.urlencode($params))."&&status=".$id_status."'>
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
	public function detailPickup()
	{
		$this->mm->check_status_login();
		$alamat_pengirim 	= urldecode($_GET["alamat_pengirim"]);
		$status 			= (!empty($_GET["status"]) ? $_GET["status"] : 0);
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
			$data["pickup_barang"]	= $this->pbm->getPickupBarangByAlamatAndStatus($alamat_pengirim, $status)->row_array();
			$this->layout->view_operator('pickup_barang/kurirDetailPickup',$data);
		}
	}
	public function detailPickupAjax()
	{
		$data 				= [];
		$id_status 			= $this->input->post('id_status');
		$alamat_pengirim 	= $this->input->post('alamat_pengirim');
		$get 				= $this->pbm->getPickupBarangByAlamatAndStatus($alamat_pengirim,$id_status)->result_array();
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
	
	public function kirimResi()
	{
		// $data 	= $this->pbm->getPickupBarangById($id_pickup_barang);
		// $text 	= "No Resi Untuk Pengiriman Kepada ". $data["nama_penerima"] . " Di Alamat ". $data["alamat_penerima"]. " Adalah ". $data["no_resi"];
		// redirect('https://api.whatsapp.com/send?phone='.$data['no_wa_pengirim'].'&text=' . $text);
		$this->pbm->sendMessage();
		$this->pbm->sendFile();
		redirect('pickupBarang','refresh');
	}

	

	


}