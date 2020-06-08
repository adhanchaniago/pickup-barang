<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function editProfile()
	{
		$id_user = $this->session->userdata('id_user');
		$dataUser = $this->mm->getDataUser();

		$img_profile = $_FILES['img_profile']['name'];
		if ($img_profile) {
			$config['upload_path'] = './assets/img/img_profiles/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('img_profile')) {
				$new_img_profile = $this->upload->data('file_name');
				$this->db->set('img_profile', $new_img_profile);
			} else {
				echo $this->upload->display_errors();
			}
		}
		
		$data = [
			'nama_lengkap' => ucwords(strtolower($this->input->post('nama_lengkap', true))),
			'id_jabatan' => $this->input->post('id_jabatan', true)
		];

		$this->db->where('user.id_user', $id_user);
		$this->db->update('user', $data);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil diubah');
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil diubah', $id_user);
		redirect('admin/profile');
	}

	public function changePassword()
	{
		$dataUser = $this->mm->getDataUser();
		$password_old = $this->input->post('password_old', true);
		$password_new = $this->input->post('password_new', true);
		
		if (password_verify($password_old, $dataUser['password'])) {
			$password_hash = password_hash($password_new, PASSWORD_DEFAULT);
			$data = [
				'password' => $password_hash
			];
			
			$this->db->where('user.id_user', $dataUser['id_user']);
			$this->db->update('user', $data);
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Password');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Password', $dataUser['id_user']);		
			redirect('admin/profile');
		} else {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' gagal mengubah Password! Password tidak sesuai dengan password lama');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' gagal mengubah Password! Password tidak sesuai dengan password lama', $dataUser['id_user']);		
			redirect('admin/profile');
			return false;
		}
	}
}