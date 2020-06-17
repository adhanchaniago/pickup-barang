<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang_model extends CI_Model {
	public $column_search 	= ["no_resi","nama_barang","jumlah_barang","berat_barang","tanggal_pemesanan","tanggal_penjemputan","tanggal_masuk_logistik","nama_pengirim","no_wa_pengirim","alamat_pengirim","nama_penerima","no_wa_penerima","alamat_penerima","harga","durasi_pengiriman","jenis_layanan","jenis_paket","kec_pengirim.nama_kecamatan","kab_pengirim.nama_kabupaten","prov_pengirim.nama_provinsi","prov_pengirim.negara","kec_penerima.nama_kecamatan","kab_penerima.nama_kabupaten","prov_penerima.nama_provinsi","prov_penerima.negara"];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Pengirim_model','pengirim');
		$this->load->model('Penerima_model','penerima');
		$this->load->model('layananPaket_model','layanan_paket');
	}

	public function _setDatatable()
	{

		$this->db->select('*,
			kec_penerima.nama_kecamatan as kec_penerima, kec_pengirim.nama_kecamatan as kec_pengirim,
			kab_penerima.nama_kabupaten as kab_penerima, kab_pengirim.nama_kabupaten as kab_pengirim,
			prov_penerima.nama_provinsi as prov_penerima, prov_pengirim.nama_provinsi as prov_pengirim,
			prov_penerima.negara as negara_penerima, prov_pengirim.negara as negara_pengirim');
		$this->db->from('pickup_barang');
		$this->db->join('pengirim', 'pengirim.id_pengirim = pickup_barang.id_pengirim');
		$this->db->join('penerima', 'penerima.id_penerima = pickup_barang.id_penerima');
		$this->db->join('layanan_paket', 'layanan_paket.id_layanan_paket = pickup_barang.id_layanan_paket');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jenis_layanan = layanan_paket.id_jenis_layanan');
		$this->db->join('jenis_paket', 'jenis_paket.id_jenis_paket = layanan_paket.id_jenis_paket');
		$this->db->join('kecamatan kec_pengirim', 'kec_pengirim.id_kecamatan = pengirim.id_kecamatan');
		$this->db->join('kabupaten kab_pengirim', 'kec_pengirim.id_kabupaten = kab_pengirim.id_kabupaten');
		$this->db->join('provinsi prov_pengirim', 'kab_pengirim.id_provinsi = prov_pengirim.id_provinsi');
		$this->db->join('kecamatan kec_penerima', 'kec_penerima.id_kecamatan = penerima.id_kecamatan');
		$this->db->join('kabupaten kab_penerima', 'kec_penerima.id_kabupaten = kab_penerima.id_kabupaten');
		$this->db->join('provinsi prov_penerima', 'kab_penerima.id_provinsi = prov_penerima.id_provinsi');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"no_resi","nama_pengirim","nama_barang","berat_barang","jumlah_barang","nama_penerima","tanggal_pemesanan","tanggal_masuk_logistik","jenis_layanan","status"];
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

	}


	public function getDatatable()
	{
		$this->_filterDatatable();
		
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
		$sql 	= $this->db->get();
		return $sql->num_rows();
	}

	public function countAllDatatable()
	{
		$this->_setDatatable();
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
		$dataUser 		= $this->mm->getDataUser();

		// ---- random number generator ----
		$i = 0;
		$randNum = mt_rand(1,9);
		do {
		    $randNum .= mt_rand(0, 9);
		} while(++$i < 4);
		$randNum .= time();
		// ---- ./random number generator ----

		$nama_barang						= $this->input->post('nama_barang',true);
		$jumlah_barang						= $this->input->post('jumlah_barang',true);
		$berat_barang						= $this->input->post('berat_barang',true);


		// pengirim
		$pengirim 			= $this->pengirim->searchPengirim();
		if ($pengirim > 0) {
			$id_pengirim 	= $pengirim;
		}else{
			$id_pengirim 	= $this->pengirim->addPengirim();
		}

		$data 		= [];
		for ($i=0; $i < count($this->input->post('nama_penerima')); $i++) { 
			// layanan
			
			$id_layanan_paket 	= $this->layanan_paket->searchLayananPaket($i);

			// penerima
			$penerima 			= $this->penerima->searchPenerima($i);
			if (count($penerima) > 0) {
				$id_penerima 	= $penerima["id_penerima"];
			}else{
				$id_penerima 	= $this->penerima->addPenerima($i);
			}

			// pickup
			$pickup["no_resi"]				= $randNum;
			$pickup["id_pengirim"]			= $id_pengirim;
			$pickup["id_penerima"]			= $id_penerima;
			$pickup["id_layanan_paket"]		= $id_layanan_paket;
			$pickup["nama_barang"]			= $nama_barang[$i];
			$pickup["jumlah_barang"]		= $jumlah_barang[$i];
			$pickup["berat_barang"]			= $berat_barang[$i];
			$pickup["tanggal_pemesanan"]	= date('Y-m-d H:i:s');
			$pickup["status"]				= 1;
			$data[]							= $pickup;
		}



		// $data 			= [
		// 	'id_pengirim' 					=> $this->input->post('id_pengirim', true),	
		// 	'id_penerima' 					=> $this->input->post('id_penerima', true),	
		// 	'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),	
		// 	'nama_barang' 					=> $this->input->post('nama_barang', true),	
		// 	'berat_barang' 					=> $this->input->post('berat_barang', true),	
		// 	'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
		// 	'tanggal_pemesanan' 			=> date('Y-m-d H:i:s'),
		// 	'status'						=> '1',
		// 	'no_resi'						=> $randNum
		// ];

		$this->db->insert_batch('pickup_barang', $data);
		if ($this->session->userdata('pelanggan') == '1') {
			$this->session->set_flashdata('message-success', 'Pelanggan ' . $data['nama_pengirim'] . ' berhasil menambahkan pesanan ' . $data['nama_barang'] . ' untuk kami kirim. Tunggu kurir kami untuk mengambil barang Anda. Terima Kasih :D');
			$this->mm->createLog('Pelanggan ' . $data['nama_pengirim'] . ' berhasil menambahkan pesanan ' . $data['nama_barang'], NULL);
			$this->session->unset_userdata('pelanggan');
			redirect('auth');
		} else {
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $data['nama_pengirim']);
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $data['nama_pengirim'], $dataUser['id_user']);
			redirect('pickupBarang');
		}
	}

	public function editPickupBarang($id)
	{
		$dataUser 		= $this->mm->getDataUser();
		$pickup_barang 	= $this->getPickupBarangById($id);
		$statusLama		= $pickup_barang['status'];
		$status 		= $this->input->post('status', true);
		if ($status == '2') {
			$data 			= [
				'id_pengirim' 					=> $this->input->post('id_pengirim', true),	
				'id_penerima' 					=> $this->input->post('id_penerima', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'status' 						=> $status,
				'tanggal_penjemputan'			=> date('Y-m-d H:i:s'),
				'tanggal_masuk_logistik'		=> NULL
			];
		} elseif ($status == '1') {
			$data 			= [
				'id_pengirim' 					=> $this->input->post('id_pengirim', true),	
				'id_penerima' 					=> $this->input->post('id_penerima', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'status' 						=> $status,
				'tanggal_penjemputan'			=> NULL,
				'tanggal_masuk_logistik'		=> NULL
			];
		} elseif ($status == '3') {
			if ($statusLama == '1') {
				$data 			= [
					'id_pengirim' 					=> $this->input->post('id_pengirim', true),	
					'id_penerima' 					=> $this->input->post('id_penerima', true),	
					'nama_barang' 					=> $this->input->post('nama_barang', true),	
					'berat_barang' 					=> $this->input->post('berat_barang', true),	
					'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
					'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
					'status' 						=> $status,
					'tanggal_penjemputan'			=> date('Y-m-d H:i:s')
				];
			} else {
				$data 			= [
					'id_pengirim' 					=> $this->input->post('id_pengirim', true),	
					'id_penerima' 					=> $this->input->post('id_penerima', true),	
					'nama_barang' 					=> $this->input->post('nama_barang', true),	
					'berat_barang' 					=> $this->input->post('berat_barang', true),	
					'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
					'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
					'status' 						=> $status,
					'tanggal_masuk_logistik'		=> date('Y-m-d H:i:s')
				];
			}

		} else {
			$data 			= [
				'id_pengirim' 					=> $this->input->post('id_pengirim', true),	
				'id_penerima' 					=> $this->input->post('id_penerima', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'status' 						=> $status
			];
		}

		$this->db->where('id_pickup_barang', $id);
		$this->db->update('pickup_barang', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['pickup_barang']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['pickup_barang'], $dataUser['id_user']);
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
		$this->mm->createLog('Jabatan ' . $pickup_barang . ' berhasil dihapus', $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function ambilPickupBarang()
	{
		$pending 			= $this->input->post('pending');
		$alamat_pengirim	= $this->input->post('alamat_pengirim');
		foreach ($pending as $key) {
			$data["status"]					= 2;
			$data["tanggal_penjemputan"]	= date('Y-m-d H:i:s');
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
			$data["status"]					= 3;
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
		$search 	= $this->input->post('search');
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
	public function getPickupBarangByWaAndStatus($no_wa_pengirim,$status = 0)
	{
		$pengirim 			= $this->db->where('no_wa_pengirim', $no_wa_pengirim)->get('pengirim')->row_array();
		$alamat 			= $pengirim["alamat_pengirim"];
		$kecamatan 			= $pengirim["id_kecamatan"];

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

		$this->db->where('alamat_pengirim', $alamat);
		$this->db->where('pengirim.id_kecamatan', $kecamatan);
		if ($status != 0) {
			$this->db->where('status', $status);
		}
		$this->db->order_by('tanggal_pemesanan', 'desc');
		return $this->db->get()->result_array();
	}

	public function cek_status_pesanan()
	{
		$this->db->select('*');
		$this->db->join('pengirim', 'pickup_barang.id_pengirim=pengirim.id_pengirim');
		$this->db->join('penerima', 'pickup_barang.id_penerima=penerima.id_penerima');
		$this->db->join('layanan_paket', 'pickup_barang.id_layanan_paket=layanan_paket.id_layanan_paket');
		$this->db->join('jenis_layanan', 'layanan_paket.id_jenis_layanan=jenis_layanan.id_jenis_layanan');
		return $this->db->get_where('pickup_barang', ['no_resi' => $this->input->post('no_resi', true)])->row_array();
	}
}