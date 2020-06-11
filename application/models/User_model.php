<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');

	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"username","nama_lengkap","nama_jabatan"];
		$column_search 		= ["username","nama_lengkap","nama_jabatan"];
		$default_order 		= ["username"=>"DESC"];

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

	public function getAllUser()
	{
		$this->db->select('*');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');
		return $this->db->get('user')->result_array();
	}

	public function getUserById($id)
	{
		$this->db->select('*');
		$this->db->join('jabatan', 'user.id_jabatan = jabatan.id_jabatan');
		return $this->db->get_where('user', ['id_user' => $id])->row_array();
	}

	public function addUser()
	{
		$dataUser 		= $this->mm->getDataUser();
		$this->db->set('img_profile', 'default.png');

		$img_profile 	= $_FILES['img_profile']['name'];
		if ($img_profile) {
			$config['upload_path'] 		= './assets/img/img_profiles/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('img_profile')) {
				$new_img_profile = $this->upload->data('file_name');
				$this->db->set('img_profile', $new_img_profile);
			} else {
				echo $this->upload->display_errors();
			}
		}
		
		$data = [
			'username' 			=> strtolower($this->input->post('username', true)),
			'nama_lengkap' 		=> ucwords(strtolower($this->input->post('nama_lengkap', true))),
			'password' 			=> password_hash($this->input->post('password_new', true), PASSWORD_DEFAULT),
			'id_jabatan' 		=> $this->input->post('id_jabatan', true)
		];

		$this->db->insert('user', $data);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pengguna ' . $data['username']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pengguna ' . $data['username'], $dataUser['id_user']);
		redirect('user');
	}

	public function editUser($id)
	{
		$dataUser 				= $this->mm->getDataUser();
		$data['user'] 			= $this->getUserById($id);
		$this->db->set('img_profile', $data['user']['img_profile']);
		$img_profile 			= $_FILES['img_profile']['name'];
		if ($img_profile) {
			$config['upload_path'] 		= './assets/img/img_profiles/';
			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
		
			$this->load->library('upload', $config);
		
			if ($this->upload->do_upload('img_profile')) {
				$new_img_profile = $this->upload->data('file_name');
				$this->db->set('img_profile', $new_img_profile);
			} else {
				echo $this->upload->display_errors();
			}
		}
		
		$data = [
			'nama_lengkap' 			=> ucwords(strtolower($this->input->post('nama_lengkap', true))),
			'id_jabatan' 			=> $this->input->post('id_jabatan', true)
		];

		$this->db->where('id_user', $id);
		$this->db->update('user', $data);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah pengguna ' . $data['username']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah pengguna ' . $data['username'], $dataUser['id_user']);
		redirect('user');
	}

	public function deleteUser($id)
	{
		$dataUser 			= $this->mm->getDataUser();
		$data['user'] 		= $this->getUserById($id);
		$username 			= $data['user']['username'];
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jabatan');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data pengguna ' . $username, $dataUser['id_user']);
			redirect('user');
		}
		$this->db->delete('user', ['id_user' => $id]);
		$this->session->set_flashdata('message-success', 'Pengguna ' . $username . ' berhasil dihapus');
		$this->mm->createLog('Pengguna ' . $username . ' berhasil dihapus', $dataUser['id_user']);
		redirect('user');
	}
}