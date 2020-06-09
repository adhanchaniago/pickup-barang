<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
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
		$dataUser = $this->mm->getDataUser();
		$data = [
			'nama_pengirim' => ucwords(strtolower($this->input->post('nama_pengirim', true))),	
			'no_whatsapp_pengirim' => $this->input->post('no_whatsapp_pengirim', true),	
			'alamat_pengirim' => $this->input->post('alamat_pengirim', true),	
			'nama_barang' => $this->input->post('nama_barang', true),	
			'berat_barang' => $this->input->post('berat_barang', true),	
			'jumlah_barang' => $this->input->post('jumlah_barang', true),	
			'nama_penerima' => ucwords(strtolower($this->input->post('nama_penerima', true))),	
			'no_whatsapp_penerima' => $this->input->post('no_whatsapp_penerima', true),	
			'alamat_penerima' => $this->input->post('alamat_penerima', true),	
			'tanggal_pemesanan' => date('Y-m-d H:i:s'),
			'id_layanan_paket' => $this->input->post('id_layanan_paket', true)
		];
		$this->db->insert('pickup_barang', $data);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $data['nama_pengirim']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $data['nama_pengirim'], $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function editPickupBarang($id)
	{
		$dataUser = $this->mm->getDataUser();
		$data = [
			'nama_pengirim' => ucwords(strtolower($this->input->post('nama_pengirim', true))),	
			'no_whatsapp_pengirim' => $this->input->post('no_whatsapp_pengirim', true),	
			'alamat_pengirim' => $this->input->post('alamat_pengirim', true),	
			'nama_barang' => $this->input->post('nama_barang', true),	
			'berat_barang' => $this->input->post('berat_barang', true),	
			'jumlah_barang' => $this->input->post('jumlah_barang', true),	
			'nama_penerima' => ucwords(strtolower($this->input->post('nama_penerima', true))),	
			'no_whatsapp_penerima' => $this->input->post('no_whatsapp_penerima', true),	
			'alamat_penerima' => $this->input->post('alamat_penerima', true),	
			'id_layanan_paket' => $this->input->post('id_layanan_paket', true),
			'status' => $this->input->post('status', true)
		];
		$this->db->where('id_pickup_barang', $id);
		$this->db->update('pickup_barang', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['pickup_barang']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['pickup_barang'], $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function deletePickupBarang($id)
	{
		$dataUser = $this->mm->getDataUser();
		if ($dataUser['id_pickup_barang'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data pickup_barang');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Pickup Barang', $dataUser['id_user']);
			redirect('pickupBarang');
		}

		$data['pickup_barang'] = $this->getPickupBarangById($id);
		$pickup_barang = $data['pickup_barang']['pickup_barang'];
		$this->db->delete('pickup_barang', ['id_pickup_barang' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $pickup_barang . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $pickup_barang . ' berhasil dihapus', $dataUser['id_user']);
		redirect('pickupBarang');
	}
}