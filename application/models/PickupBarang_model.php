<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('pickup_barang');
		$this->db->join('layanan_paket', 'pickup_barang.id_layanan_paket=layanan_paket.id_layanan_paket');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_pengirim","no_whatsapp_pengirim","alamat_pengirim","nama_barang","berat_barang","jumlah_barang","nama_penerima","no_whatsapp_penerima","alamat_penerima","tanggal_pemesanan","layanan_paket","status"];
		$column_search 		= ["nama_pengirim","no_whatsapp_pengirim","alamat_pengirim","nama_barang","berat_barang","jumlah_barang","nama_penerima","no_whatsapp_penerima","alamat_penerima","tanggal_pemesanan","layanan_paket","status"];
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
		}elseif(isset($first_order)) {
			$this->db->order_by(key($first_order), $first_order[key($first_order)]);
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
		$this->db->select('*');
		$this->db->join('layanan_paket', 'pickup_barang.id_layanan_paket=layanan_paket.id_layanan_paket');
		$this->db->order_by('tanggal_pemesanan', 'desc');
		return $this->db->get('pickup_barang')->result_array();
	}

	public function getPickupBarangById($id)
	{
		return $this->db->get_where('pickup_barang', ['id_pickup_barang' => $id])->row_array();
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

		$data 			= [
			'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
			'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
			'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
			'nama_barang' 					=> $this->input->post('nama_barang', true),	
			'berat_barang' 					=> $this->input->post('berat_barang', true),	
			'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
			'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
			'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
			'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
			'tanggal_pemesanan' 			=> date('Y-m-d H:i:s'),
			'status'						=> '1',
			'no_resi'						=> $randNum,
			'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true)
		];

		if ($this->session->userdata('pelanggan') == '1') {
			$this->db->insert('pickup_barang', $data);
			$this->session->set_flashdata('message-success', 'Pelanggan ' . $data['nama_pengirim'] . ' berhasil menambahkan pesanan ' . $data['nama_barang'] . ' untuk kami kirim. Tunggu kurir kami untuk mengambil barang Anda. Terima Kasih :D');
			$this->mm->createLog('Pelanggan ' . $data['nama_pengirim'] . ' berhasil menambahkan pesanan ' . $data['nama_barang'], NULL);
			$this->session->unset_userdata('pelanggan');
			redirect('auth');
		} else {
			$this->db->insert('pickup_barang', $data);
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
		if ($statusLama == '1' AND $status == '2') {
			$data 			= [
				'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'tanggal_kurir_menjemput'		=> date('Y-m-d H:i:s'),
				'status' 						=> $status
			];
		} elseif ($statusLama == '1' AND $status == '3') {
			$data 			= [
				'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'tanggal_kurir_menjemput'		=> date('Y-m-d H:i:s'),
				'tanggal_masuk_logistik'		=> date('Y-m-d H:i:s'),
				'status' 						=> $status
			];
		} elseif ($statusLama == '2' AND $status == '3') {
			$data 			= [
				'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'tanggal_masuk_logistik'		=> date('Y-m-d H:i:s'),
				'status' 						=> $status
			];
		} elseif ($statusLama == '3' AND $status == '2') {
			$data 			= [
				'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'tanggal_masuk_logistik'		=> NULL,
				'status' 						=> $status
			];
		} elseif (($statusLama == '3' AND $status == '1') || ($statusLama == '2' AND $status == '1')) {
			$data 			= [
				'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
				'id_layanan_paket' 				=> $this->input->post('id_layanan_paket', true),
				'tanggal_kurir_menjemput'		=> NULL,
				'tanggal_masuk_logistik'		=> NULL,
				'status' 						=> $status
			];
		} else {
			$data 			= [
				'nama_pengirim' 				=> ucwords(strtolower($this->input->post('nama_pengirim', true))),	
				'no_whatsapp_pengirim' 			=> $this->input->post('no_whatsapp_pengirim', true),	
				'alamat_pengirim' 				=> $this->input->post('alamat_pengirim', true),	
				'nama_barang' 					=> $this->input->post('nama_barang', true),	
				'berat_barang' 					=> $this->input->post('berat_barang', true),	
				'jumlah_barang' 				=> $this->input->post('jumlah_barang', true),	
				'nama_penerima' 				=> ucwords(strtolower($this->input->post('nama_penerima', true))),	
				'no_whatsapp_penerima' 			=> $this->input->post('no_whatsapp_penerima', true),	
				'alamat_penerima' 				=> $this->input->post('alamat_penerima', true),	
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
		if ($dataUser['id_pickup_barang'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data pickup_barang');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Pickup Barang', $dataUser['id_user']);
			redirect('pickupBarang');
		}

		$data['pickup_barang'] 			= $this->getPickupBarangById($id);
		$pickup_barang 					= $data['pickup_barang']['pickup_barang'];
		
		$this->db->delete('pickup_barang', ['id_pickup_barang' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $pickup_barang . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $pickup_barang . ' berhasil dihapus', $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function cek_status_pesanan()
	{
		$this->db->select('*');
		$this->db->join('layanan_paket', 'pickup_barang.id_layanan_paket=layanan_paket.id_layanan_paket');
		return $this->db->get_where('pickup_barang', ['no_resi' => $this->input->post('no_resi', true)])->row_array();
	}
}