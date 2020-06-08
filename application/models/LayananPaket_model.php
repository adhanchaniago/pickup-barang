<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayananPaket_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllLayananPaket()
	{
		$this->db->order_by('harga_layanan_paket', 'desc');
		return $this->db->get('layanan_paket')->result_array();
	}

	public function getLayananPaketById($id)
	{
		return $this->db->get_where('layanan_paket', ['id_layanan_paket' => $id])->row_array();
	}

	public function addLayananPaket()
	{
		$dataUser = $this->mm->getDataUser();
		$data = [
			'layanan_paket' => ucwords(strtolower($this->input->post('layanan_paket', true))),
			'harga_layanan_paket' => $this->input->post('harga_layanan_paket', true),
			'durasi_pengiriman' => $this->input->post('durasi_pengiriman', true)
		];
		$this->db->insert('layanan_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Layanan Paket ' . $data['layanan_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Layanan Paket ' . $data['layanan_paket'], $dataUser['id_user']);
		redirect('layananPaket');
	}

	public function editLayananPaket($id)
	{
		$dataUser = $this->mm->getDataUser();
		$data = [
			'layanan_paket' => ucwords(strtolower($this->input->post('layanan_paket', true))),
			'harga_layanan_paket' => $this->input->post('harga_layanan_paket', true),
			'durasi_pengiriman' => $this->input->post('durasi_pengiriman', true)
		];
		$this->db->where('id_layanan_paket', $id);
		$this->db->update('layanan_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Layanan Paket ' . $data['layanan_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Layanan Paket ' . $data['layanan_paket'], $dataUser['id_user']);
		redirect('layananPaket');
	}

	public function deleteLayananPaket($id)
	{
		$dataUser = $this->mm->getDataUser();
		if ($dataUser['id_layanan_paket'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data layanan_paket');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Layanan Paket', $dataUser['id_user']);
			redirect('layananPaket');
		}

		$data['layanan_paket'] = $this->getLayananPaketById($id);
		$layanan_paket = $data['layanan_paket']['layanan_paket'];
		$this->db->delete('layanan_paket', ['id_layanan_paket' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $layanan_paket . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $layanan_paket . ' berhasil dihapus', $dataUser['id_user']);
		redirect('layananPaket');
	}
}