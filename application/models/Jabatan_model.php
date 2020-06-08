<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getAllJabatan()
	{
		return $this->db->get('jabatan')->result_array();
	}

	public function getJabatanById($id)
	{
		return $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
	}

	public function addJabatan()
	{
		$dataUser = $this->mm->getDataUser();
		$data = [
			'nama_jabatan' => ucwords(strtolower($this->input->post('nama_jabatan', true)))
		];
		$this->db->insert('jabatan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan jabatan ' . $data['nama_jabatan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan jabatan ' . $data['nama_jabatan'], $dataUser['id_user']);
		redirect('jabatan');
	}

	public function editJabatan($id)
	{
		$dataUser = $this->mm->getDataUser();
		$data = [
			'nama_jabatan' => ucwords(strtolower($this->input->post('nama_jabatan', true)))
		];
		$this->db->where('id_jabatan', $id);
		$this->db->update('jabatan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah jabatan ' . $data['nama_jabatan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah jabatan ' . $data['nama_jabatan'], $dataUser['id_user']);
		redirect('jabatan');
	}

	public function deleteJabatan($id)
	{
		$dataUser = $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jabatan');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Jabatan', $dataUser['id_user']);
			redirect('jabatan');
		}

		$data['jabatan'] = $this->getJabatanById($id);
		$nama_jabatan = $data['jabatan']['nama_jabatan'];
		$this->db->delete('jabatan', ['id_jabatan' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $nama_jabatan . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $nama_jabatan . ' berhasil dihapus', $dataUser['id_user']);
		redirect('jabatan');
	}
}