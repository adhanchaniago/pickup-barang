<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang_model extends CI_Model {
	public $column_search 	= ["no_resi","tanggal_pemesanan","tanggal_penjemputan","tanggal_masuk_logistik","nama_pengirim","no_wa_pengirim","alamat_pengirim","nama_penerima","no_wa_penerima","alamat_penerima","jenis_layanan"];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Pengirim_model','pengirim');
		$this->load->model('Penerima_model','penerima');
		$this->load->model('JenisLayanan_model','jenis_layanan');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('pickup_barang');
		$this->db->join('pengirim', 'pengirim.id_pengirim = pickup_barang.id_pengirim');
		$this->db->join('penerima', 'penerima.id_penerima = pickup_barang.id_penerima');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jenis_layanan = pickup_barang.id_jenis_layanan');
		$this->db->join('status', 'status.id_status = pickup_barang.id_status');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_pengirim","no_wa_pengirim","alamat_pengirim","tanggal_pemesanan"];
		$column_search 		= $this->column_search;
		$default_order 		= ["tanggal_pemesanan"=>"DESC"];

		$search 			= $this->input->post('search');
		$i = 0;
		foreach ($column_search as $item) { 
			if($search["value"]) { 
				if($i===0) {
					$this->db->group_start();
					$this->db->like($item, $search['value']);
				} else {
					$this->db->or_like($item, $search['value']);
				}

				if(count($column_search) - 1 == $i){
					$this->db->group_end(); 
				}
			}
			$i++;
		}

		$order 	= $this->input->post('order');
		if(isset($order) && $order['0']['column']!=0) {
			$this->db->order_by($column_order[$order['0']['column']], $order['0']['dir']);
		}elseif(isset($default_order)) {
			$this->db->order_by(key($default_order), $default_order[key($default_order)]);
		}

		if ($this->input->post('id_status') != '') {
			$this->db->where('pickup_barang.id_status', $this->input->post('id_status'));
		}

	}


	public function getDatatable()
	{
		$this->_filterDatatable();
		$this->db->group_by('pengirim.id_pengirim');
		$this->db->group_by('DATE(tanggal_pemesanan) DESC');
		$length 	= $this->input->post('length');
		$start 		= $this->input->post('start');
		if($length != -1){
			$this->db->limit($length, $start);
		}

		$sql 	= $this->db->get();
		return $sql->result();
	}

	public function countFilteredDatatable()
	{
		$this->_filterDatatable();
		$this->db->group_by('pengirim.id_pengirim');
		$this->db->group_by('DATE(tanggal_pemesanan)');
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function countAllDatatable()
	{
		$this->_setDatatable();
		$this->db->group_by('pengirim.id_pengirim');
		$this->db->group_by('DATE(tanggal_pemesanan)');
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function _filterDatatable2()
	{
		$this->_setDatatable();
		$column_order 		= [null,"no_resi","nama_penerima","no_wa_penerima","alamat_penerima","tanggal_pemesanan","tanggal_penjemputan","tanggal_masuk_logistik","jenis_layanan","id_status"];
		$column_search 		= $this->column_search;
		$default_order 		= ["tanggal_pemesanan"=>"DESC"];

		$search 			= $this->input->post('search');
		$i = 0;
		foreach ($column_search as $item) { 
			if($search["value"]) { 
				if($i===0) {
					$this->db->group_start();
					$this->db->like($item, $search['value']);
				} else {
					$this->db->or_like($item, $search['value']);
				}

				if(count($column_search) - 1 == $i){
					$this->db->group_end(); 
				}
			}
			$i++;
		}

		$order 	= $this->input->post('order');
		if(isset($order) && $order['0']['column']!=0) {
			$this->db->order_by($column_order[$order['0']['column']], $order['0']['dir']);
		}elseif(isset($default_order)) {
			$this->db->order_by(key($default_order), $default_order[key($default_order)]);
		}

		if ($this->input->post('id_status') != '') {
			$this->db->where('pickup_barang.id_status', $this->input->post('id_status'));
		}

	}

	public function getDatatable2()
	{
		$this->_filterDatatable2();
		$id_pengirim 		= $this->input->get('id_pengirim');
		$tanggal_pemesanan 	= $this->input->get('tanggal_pemesanan');
		$this->db->where('pickup_barang.id_pengirim', $id_pengirim);
		$this->db->where('DATE(pickup_barang.tanggal_pemesanan)', $tanggal_pemesanan);
		$length 	= $this->input->post('length');
		$start 		= $this->input->post('start');
		if($length != -1){
			$this->db->limit($length, $start);
		}

		$sql 	= $this->db->get();
		return $sql->result();
	}

	public function countFilteredDatatable2()
	{
		$this->_filterDatatable2();
		$id_pengirim 		= $this->input->get('id_pengirim');
		$tanggal_pemesanan 	= $this->input->get('tanggal_pemesanan');
		$this->db->where('pickup_barang.id_pengirim', $id_pengirim);
		$this->db->where('DATE(pickup_barang.tanggal_pemesanan)', $tanggal_pemesanan);
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function countAllDatatable2()
	{
		$this->_setDatatable();
		$id_pengirim 		= $this->input->get('id_pengirim');
		$tanggal_pemesanan 	= $this->input->get('tanggal_pemesanan');
		$this->db->where('pickup_barang.id_pengirim', $id_pengirim);
		$this->db->where('DATE(pickup_barang.tanggal_pemesanan)', $tanggal_pemesanan);
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function getAllPickupBarang()
	{
		$this->_setDatatable();
		return $this->db->get()->result_array();
	}

	public function getPickupBarangById($id)
	{
		$this->_setDatatable();
		$this->db->where('id_pickup_barang', $id);
		return $this->db->get()->row_array();
	}

	public function addPickupBarang()
	{
		$dataUser 			= $this->mm->getDataUser();
		// pengirim
		$pengirim 			= $this->pengirim->searchPengirim();
		if ($pengirim ) {
			$id_pengirim 	= $pengirim;
		}else{
			$id_pengirim 	= $this->pengirim->addPengirim();
		}

		$data 		= [];
		for ($i=0; $i < count($this->input->post('nama_penerima')); $i++) { 
			$nama_penerima 		= $this->input->post('nama_penerima')[$i];
			$alamat_penerima 	= $this->input->post('alamat_penerima')[$i];
			$jumlah_barang 		= $this->input->post('jumlah_barang')[$i];
			$id_jenis_layanan 	= $this->input->post('jenis_layanan')[$i];
			if (empty($nama_penerima) || empty($$alamat_penerima) || empty($jumlah_barang) || empty($layanan)) {
				continue;
			}
			// penerima
			$penerima 			= $this->penerima->searchPenerima($i);
			if ($penerima) {
				$id_penerima 	= $penerima;
			}else{
				$id_penerima 	= $this->penerima->addPenerima($i);
			}

			$id_jenis_layanan 	= $this->input->post('jenis_layanan')[$i];
			$nama_barang 		= $this->input->post('nama_barang')[$i];
			$jumlah_barang 		= $this->input->post('jumlah_barang')[$i];

			// pickup
			$pickup 						= [];
			$pickup["no_resi"]				= NULL;
			$pickup["id_pengirim"]			= $id_pengirim;
			$pickup["id_penerima"]			= $id_penerima;
			$pickup["id_jenis_layanan"]		= $id_jenis_layanan;
			$pickup["nama_barang"]			= $nama_barang;
			$pickup["jumlah_barang"]		= $jumlah_barang;
			$pickup["tanggal_pemesanan"]	= date('Y-m-d H:i:s');
			$pickup["id_status"]			= 1;
			$data[]							= $pickup;
		}

		$nama_pengirim 	= $this->input->post('nama_pengirim');
		if (!isset($_SESSION['id_user'])) {
			$this->session->set_userdata(['pelanggan' => '1']);
		}

		if (!empty($_FILES["file"]["name"])) {
			$config['upload_path'] 		= './assets/excel/';
			$config['allowed_types'] 	= 'xls|xlsx|csv';
			$config['max_size']  		= '1024';
			$config['encrypt_name']  	= true;
			
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('file')){
				$this->session->set_flashdata('message-success',  $this->upload->display_errors());
			}
			else{
				$data_upload 		= $this->upload->data('file_name');
				$explode 			= explode('.', $data_upload);
				$extension 			= end($explode);

				if (strtolower($extension) == 'csv') {
					$excelreader 	= PHPExcel_IOFactory::createReader("CSV");
				}else{
					$excelreader 	= PHPExcel_IOFactory::createReader('Excel2007');
				}
				$loadexcel			= $excelreader->load('assets/excel/'.$data_upload);
				$sheet 			    = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
				$numrow 			= 0;
				$failed 			= 0;

				foreach($sheet as $row){
					if($numrow > 0){

						$nama_penerima 		  			= $row["A"];
						$no_wa_penerima	  				= $row["B"];
						$alamat_penerima   				= $row["C"];
						$nama_barang   					= $row["D"];
						$jumlah_barang 					= $row["E"];
						$layanan 	  					= $row["F"];
						echo "<pre>";

						if (empty($nama_penerima) || empty($alamat_penerima) || empty($jumlah_barang) || empty($layanan)) {
							continue;
							$failed++;
						}

						$penerima 						= $this->penerima->getPenerimaByField($nama_penerima,$no_wa_penerima,$alamat_penerima);
						$id_penerima 					= $penerima['id_penerima'];

						$jenis_layanan 					= $this->jenis_layanan->getJenisLayananBySingkatan($layanan);
						$id_jenis_layanan 				= $jenis_layanan['id_jenis_layanan'];

						$pickup 						= [];
						$pickup["no_resi"]				= NULL;
						$pickup["id_pengirim"]			= $id_pengirim;
						$pickup["id_penerima"]			= $id_penerima;
						$pickup["id_jenis_layanan"]		= $id_jenis_layanan;
						$pickup["nama_barang"]			= $nama_barang;
						$pickup["jumlah_barang"]		= $jumlah_barang;
						$pickup["tanggal_pemesanan"]	= date('Y-m-d H:i:s');
						$pickup["id_status"]			= 1;
						$data[]							= $pickup;
					}
					$numrow++;
				}
			}
		}
		$failed 	= true;
		if (count($data)) {
			if ($this->db->insert_batch('pickup_barang', $data)) {
				$failed 	= false;
			}
		}
		if ($this->session->userdata('pelanggan') == '1') {
			if ($failed) {
				$this->session->set_flashdata('message-failed', 'Pelanggan ' . $nama_pengirim . ' gagal menambahkan pesanan');
				$this->session->unset_userdata('pelanggan');
				redirect('auth');
			}else{
				$this->session->set_flashdata('message-success', 'Pelanggan ' . $nama_pengirim . ' berhasil menambahkan pesanan untuk kami kirim. Tunggu kurir kami untuk mengambil barang Anda. Terima Kasih :D');
				$this->mm->createLog('Pelanggan ' . $nama_pengirim . ' berhasil menambahkan pesanan ', NULL);
				$this->session->unset_userdata('pelanggan');
				redirect('auth');
			}
		} else {
			if ($failed) {
				$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' gagal menambahkan pesanan ' . $nama_pengirim);
				redirect('pickupBarang');
			}else{
				$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $nama_pengirim);
				$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $nama_pengirim, $dataUser['id_user']);
				redirect('pickupBarang');
			}
		}
	}

	public function editPickupBarang($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["no_resi"]				= $this->input->post('no_resi');
		$data["berat_barang"]			= $this->input->post('berat_barang');
		$data["harga_pengiriman"]		= $this->input->post('harga_pengiriman');
		$data["id_status"]				= 4;
		$data ['tanggal_input_resi']	= date('Y-m-d H:i:s');

		$this->db->where('id_pickup_barang', $id);
		$this->db->update('pickup_barang', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['no_resi']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['no_resi'], $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function deletePickupBarang($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data pickup barang');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Pickup Barang', $dataUser['id_user']);
			redirect('pickupBarang');
		}

		$data['pickup_barang'] 			= $this->getPickupBarangById($id);
		$pickup_barang 					= $data['pickup_barang']['nama_pengirim'] . ' | ' . $data['pickup_barang']['nama_barang'] . ' | ' . $data['pickup_barang']['nama_penerima'];
		
		$this->db->delete('pickup_barang', ['id_pickup_barang' => $id]);
		$this->session->set_flashdata('message-success', 'Pickup Barang ' . $pickup_barang . ' berhasil dihapus');
		$this->mm->createLog('Pickup Barang ' . $pickup_barang . ' berhasil dihapus', $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function ambilPickupBarang()
	{
		$pending 			= $this->input->post('pending');
		$alamat_pengirim	= $this->input->post('alamat_pengirim');
		foreach ($pending as $key) {
			$data["id_status"]					= 2;
			$data["tanggal_penjemputan"]		= date('Y-m-d H:i:s');
			$this->db->where('id_pickup_barang', $key);
			$this->db->update('pickup_barang',$data);
		}
		$dataUser 						= $this->mm->getDataUser();

		$this->session->set_flashdata('message-success', 'Kurir '.$dataUser["username"].' Akan Mengambil Barang Di ' . $alamat_pengirim);
		$this->mm->createLog('Kurir '.$dataUser["username"].' Akan Mengambil Barang Di ' . $alamat_pengirim, $dataUser['id_user']);
		redirect('pickupBarang/kurir');
	}
	public function terimaPickupBarang()
	{
		$pickup 			= $this->input->post('pickup');
		$alamat_pengirim	= $this->input->post('alamat_pengirim');
		foreach ($pickup as $key) {
			$data["id_status"]				= 3;
			$data["tanggal_masuk_logistik"]	= date('Y-m-d H:i:s');
			$this->db->where('id_pickup_barang', $key);
			$this->db->update('pickup_barang',$data);
		}
		$dataUser 						= $this->mm->getDataUser();

		$this->session->set_flashdata('message-success', 'Kurir '.$dataUser["username"].' Telah Mengambil Barang Di ' . $alamat_pengirim);
		$this->mm->createLog('Kurir '.$dataUser["username"].' Telah Mengambil Barang Di ' . $alamat_pengirim, $dataUser['id_user']);
		redirect('pickupBarang/kurir');
	}

	public function getPickupBarangGroupByAlamat($where = [])
	{
		// $start 	= $this->input->post('start');
		// $limit 	= $this->input->post('limit');
		$search 			= $this->input->post('search');
		$column_search 		= $this->column_search;
		$this->_setDatatable();
		$this->db->select('count(*) as total');

		$i 	= 0;
		foreach ($column_search as $key) {
			if ($i == 0) {
				$this->db->group_start();
				$this->db->like($key, $search, 'BOTH');
			}else{
				$this->db->or_like($key, $search, 'BOTH');
			}
			if ($i == count($column_search) - 1) {
				$this->db->group_end();
			}
			$i++;
		}

		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		$this->db->order_by('tanggal_pemesanan', 'desc');
		$this->db->group_by('alamat_pengirim');
		// $this->db->limit($start,$limit);
		return $this->db->get()->result_array();
	}
	public function getPickupBarangByAlamatAndStatus($alamat_pengirim, $status = 0)
	{
		// $this->db->select('
		// 	pengirim.no_wa_pengirim,
		// 	pengirim.alamat_pengirim
		// ');
		// $this->db->join('pickup_barang', 'pickup_barang.id_pengirim = pengirim.id_pengirim');
		// $pengirim 			= $this->db->get_where('pengirim', ['pengirim.alamat_pengirim' => $alamat_pengirim])->row_array();
		// // $alamat 			= $pengirim["alamat_pengirim"];
		$search 			= $this->input->post('search');
		$column_search 		= $this->column_search;
		$this->_setDatatable();

		$i 	= 0;
		foreach ($column_search as $key) {
			if ($i == 0) {
				$this->db->group_start();
				$this->db->like($key, $search, 'BOTH');
			}else{
				$this->db->or_like($key, $search, 'BOTH');
			}
			if ($i == count($column_search) - 1) {
				$this->db->group_end();
			}
			$i++;
		}
		$this->db->where('alamat_pengirim', $alamat_pengirim);
		if ($status != 0) {
			$this->db->where('pickup_barang.id_status', $status);
		}
		$this->db->order_by('tanggal_pemesanan', 'desc');

		return $this->db->get();
	}

	public function cek_status_pesanan($no_wa_pengirim)
	{
		//$no_wa_pengirim = $this->mm->no_telepon_validasi($this->input->post('no_wa_pengirim', true));
		$dari_tanggal 	= $this->input->post('dari_tanggal', true);
		$sampai_tanggal	= $this->input->post('sampai_tanggal', true);
		$id_status 		= $this->input->post('id_status', true);

		if (isset($_POST['dari_tanggal']) AND isset($_POST['sampai_tanggal'])) {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
			if ($id_status != '') {
				$query = "SELECT * FROM pickup_barang 
					INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
					INNER JOIN status ON pickup_barang.id_status = status.id_status 
					INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
					INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
					WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.id_status = '$id_status' AND 
					pengirim.no_wa_pengirim = '$no_wa_pengirim'
					ORDER BY pickup_barang.tanggal_pemesanan DESC
				";
			} else {
				$query = "SELECT * FROM pickup_barang 
					INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
					INNER JOIN status ON pickup_barang.id_status = status.id_status 
					INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
					INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
					WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND 
					pengirim.no_wa_pengirim = '$no_wa_pengirim'
					ORDER BY pickup_barang.tanggal_pemesanan DESC
				";
			}
		} else {
			if ($id_status != '') {
				$query = "SELECT * FROM pickup_barang 
					INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
					INNER JOIN status ON pickup_barang.id_status = status.id_status 
					INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
					INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
					WHERE pickup_barang.id_status = '$id_status' AND 
					pengirim.no_wa_pengirim = '$no_wa_pengirim'
					ORDER BY pickup_barang.tanggal_pemesanan DESC
				";
			} else {
				$query = "SELECT * FROM pickup_barang 
					INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
					INNER JOIN status ON pickup_barang.id_status = status.id_status 
					INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
					INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
					WHERE pengirim.no_wa_pengirim = '$no_wa_pengirim'
					ORDER BY pickup_barang.tanggal_pemesanan DESC
				";
			}
		}


		return $this->db->query($query)->result_array();
	}

	public function importExcel()
	{
		$config['upload_path'] 		= './assets/excel/';
		$config['allowed_types'] 	= 'csv|xls|xlsx';
		$config['encrypt_name'] 	= true;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('excel')){
			$this->session->set_flashdata('message-success',  $this->upload->display_errors());
		}
		else{
			$data_upload 		= $this->upload->data('file_name');
			$explode 			= explode('.', $data_upload);
			$extension 			= end($explode);

			if (strtolower($extension) == 'csv') {
				$excelreader 	= PHPExcel_IOFactory::createReader("CSV");
			}else{
				$excelreader 	= PHPExcel_IOFactory::createReader('Excel2007');
			}
			$loadexcel			= $excelreader->load('assets/excel/'.$data_upload);
			$sheet 			    = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			$numrow 			= 0;
			$success 			= 0;
			$failed 			= 0;
			$id_pickup_barang_arr 	= [];
			foreach($sheet as $row){
				if($numrow > 0){
					$no_resi 		  	= $row["A"];
					$berat_barang	  	= $row["D"];
					$no_wa_pengirim   	= $row["I"];
					$no_wa_penerima   	= $row["K"];
					$nama_penerima 		= $row["J"];
					$jumlah_barang 	  	= $row["E"];
					$harga_pengiriman 	= $row["O"];

					$this->db->select('id_pickup_barang,no_wa_pengirim,nama_penerima,alamat_penerima,no_wa_penerima');
					$this->db->from('pickup_barang');
					$this->db->join('pengirim', 'pengirim.id_pengirim = pickup_barang.id_pengirim');
					$this->db->join('penerima', 'penerima.id_penerima = pickup_barang.id_penerima');
					$this->db->where('no_wa_pengirim', $no_wa_pengirim);
					$this->db->group_start();
					$this->db->where('no_wa_penerima', $no_wa_penerima);
					$this->db->or_where('nama_penerima', $nama_penerima);
					$this->db->group_end();
					$this->db->where('jumlah_barang', $jumlah_barang);
					$this->db->where('id_status', 3);
					$cek 			= $this->db->get();

					$this->db->select('id_pickup_barang');
					$this->db->from('pickup_barang');
					$this->db->where('no_resi', $no_resi);
					$cek_resi 		= $this->db->get()->num_rows();

					if ($cek->num_rows()  ==  1 && $cek_resi == 0) {
						$data 						= $cek->row_array();
						$id_pickup_barang 			= $data["id_pickup_barang"];
						$no_resi 					= preg_replace('/[^0-9]/', "", $no_resi);
						$berat_barang 				= preg_replace('/[^0-9]/', "", $berat_barang);
						$harga_pengiriman			= preg_replace('/[^0-9]/', "", $harga_pengiriman);
						$upd["berat_barang"]		= $berat_barang;
						$upd["harga_pengiriman"]	= $harga_pengiriman;
						$upd["no_resi"]				= $no_resi;
						$upd["id_status"]			= 4;
						$upd['tanggal_input_resi']	= date('Y-m-d H:i:s');
						$this->db->where('id_pickup_barang', $id_pickup_barang);
						$this->db->update('pickup_barang', $upd);
						$this->sendMessage($id_pickup_barang);
						$id_pickup_barang_arr[] 	= $id_pickup_barang;
						$success++;
					}else{
						$failed++;
					}
				}
				$failed++;
				$numrow++;
			}
			if (!empty($id_pickup_barang_arr)) {
				$this->sendFile($id_pickup_barang_arr);
			}
			$dataUser 			= $this->mm->getDataUser();
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' mengimport nomor resi &nbsp;'.$success.' Sukses, '.$failed.' Gagal');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mengimport nomor resi ', $dataUser['id_user']);
		}
		return redirect('pickupBarang','refresh');
	}

	public function sendMessage($id_pickup_barang = 0)
	{
		if (!empty($id_pickup_barang)) {
			$this->_setDatatable();
			$this->db->where('pickup_barang.id_pickup_barang', $id_pickup_barang);
			$this->db->where('pickup_barang.id_status', 4);
			$data_arr				= $this->db->get()->result();
		}else{
			if (!empty($this->input->get('id_pickup_barang'))) {
				$id_pickup_barang 	= $this->input->get('id_pickup_barang');
				$this->_setDatatable();
				$this->db->where('pickup_barang.id_pickup_barang', $id_pickup_barang);
				$this->db->where('pickup_barang.id_status', 4);
				$data_arr			= $this->db->get()->result();
			}else{
				$id_pengirim 		= $this->input->get('id_pengirim');
				$tanggal_pemesanan 	= $this->input->get('tanggal_pemesanan');

				$this->_setDatatable();
				$this->db->where('pickup_barang.id_pengirim', $id_pengirim);
				$this->db->where('DATE(pickup_barang.tanggal_pemesanan)', $tanggal_pemesanan);
				$this->db->where('pickup_barang.id_status', 4);
				$data_arr			= $this->db->get()->result();
			}
		}

		$all_message 	= "";
		$key			='77a9f91954dab844a9de83b55e005dda68819542a2c77cbe';
		$url_msg 		='http://116.203.92.59/api/send_message';
		foreach ($data_arr as $data) {
			$message	= 	"Tn/Ny. " . $data->nama_pengirim . ", berikut adalah detail pengiriman anda : " . '\n' . '\n' . 
						"No. Resi : " . $data->no_resi . '\n' . 
						"Nama Penerima : " . $data->nama_penerima . '\n' . 
						"Alamat Penerima : " . $data->alamat_penerima . '\n' . 
						"Jenis Layanan : " . $data->jenis_layanan . '\n' . 
						"Biaya Pengiriman : Rp. " . number_format($data->harga_pengiriman) . '\n' . '\n' . 
						"Terima kasih sudah menggunakan jasa pengiriman JNE kami." . '\n' .
						"Untuk melihat detail lebih lengkap, klik link dibawah ini. " . '\n' .
						base_url('auth');
			$phone 		= $data->no_wa_pengirim;

			// woowa Message
			$data = array(
			  "phone_no"=> $phone,
			  "key"		=> $key,
			  "message"	=> $message
			);
			$data_string = json_encode($data);

			$ch = curl_init($url_msg);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_VERBOSE, 0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 360);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  'Content-Type: application/json',
			  'Content-Length: ' . strlen($data_string))
			);
			echo $res=curl_exec($ch);
			switch ($res) {
				case 'phone_offline':
					$failed 	= 'Telepon Offline';
					break;
			}
			curl_close($ch);
		}

		
		if (!empty($failed)) {
			$this->session->set_flashdata('message-failed', $failed);
		}
	}
	public function sendFile($ids = [])
	{
		if (!empty($this->input->get('id_pengirim')) && !empty($this->input->get('id_pengirim'))) {
			$id_pengirim 		= $this->input->get('id_pengirim');
			$tanggal_pemesanan 	= $this->input->get('tanggal_pemesanan');

			$this->_setDatatable();
			$this->db->where('pickup_barang.id_pengirim', $id_pengirim);
			$this->db->where('DATE(pickup_barang.tanggal_pemesanan)', $tanggal_pemesanan);
			$this->db->where('pickup_barang.id_status', 4);
			$data_arr			= $this->db->get()->result();
		}else{
			if (!empty($ids)) {
				$this->_setDatatable();
				$this->db->where('pickup_barang.id_status', 4);
				$i 	= 0;
				foreach ($ids as $id_pickup_barang) {
					if ($i == 0) {
						$this->db->group_start();
						$this->db->where('pickup_barang.id_pickup_barang', $id_pickup_barang);
					}else{
						$this->db->or_where('pickup_barang.id_pickup_barang', $id_pickup_barang);

					}
					if ($i == count($ids) - 1) {
						$this->db->group_end();
					}
					$i++;
				}
				$data_arr			= $this->db->get()->result();
			}
		}
		if (!count($data_arr)) {
			exit;
		}

		$new_data_arr 				= [];
		foreach ($data_arr as $data) {
			$new_data_arr[$data->no_wa_pengirim][$data->id_pickup_barang] = $data;
		}

		$key			='77a9f91954dab844a9de83b55e005dda68819542a2c77cbe';
		$url_file 		='http://116.203.92.59/api/send_file_url';

		// woowa File
		foreach ($new_data_arr as $phone => $data) {
			$url 		= $this->get_excel($data);
			$send = array(
			  "phone_no"=> $phone,
			  "key"		=> $key,
			  "url"		=> $url
			);
			$data_string = json_encode($send);

			$ch = curl_init($url_file);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_VERBOSE, 0);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
			curl_setopt($ch, CURLOPT_TIMEOUT, 360);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			  'Content-Type: application/json',
			  'Content-Length: ' . strlen($data_string))
			);
			echo $res=curl_exec($ch);
			switch ($res) {
				case 'phone_offline':
					$failed 	= 'Telepon Offline';
					break;
			}
			curl_close($ch);
		}
		

		
		if (!empty($failed)) {
			$this->session->set_flashdata('message-failed', $failed);
		}
	}

	public function get_excel($datas)
	{
		$rows[] 	= ["No Resi","Layanan","Nama Barang","Berat Barang","Jumlah Barang","Destinasi","Pengirim","Penerima","No Wa Penerima","Harga Pengiriman"];
		foreach ($datas as $data) {
			$row 		= [];
			$row[] 		= $data->no_resi;
			$row[] 		= $data->jenis_layanan;
			$row[] 		= $data->nama_barang;
			$row[]		= $data->berat_barang . ' kg';
			$row[]		= $data->jumlah_barang . ' pcs';
			$row[]		= $data->alamat_penerima;
			$row[]		= $data->nama_pengirim;
			$row[]		= $data->nama_penerima;
			$row[]		= $data->no_wa_penerima;
			$row[]		= 'Rp ' . str_replace(',', '.', number_format($data->harga_pengiriman));
			$rows[] 	= $row;
		}
		$excel 			= '<table border="1">';
		foreach ($rows as $row) {
			if (count($row)) {
				$excel 	.= '<tr>';
			}
			foreach ($row as $key) {
				$excel 	.= '<td>'.(is_numeric($key) ? '`': '').$key.'</td>';
			}
			if (count($row)) {
				$excel 	.= '</tr>';
			}
		}
		$excel 			.= '</table>';
		$filename 		= 'csv/DAFTAR-PENGIRIMAN-'.date('Ymd').'.xls';
		file_put_contents($filename, $excel);
		$file 			= base_url($filename);
		echo $file;
	}
}