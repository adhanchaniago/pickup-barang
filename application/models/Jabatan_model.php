<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('jabatan');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_jabatan"];
		$column_search 		= ["nama_jabatan"];
		$default_order 		= ["nama_jabatan"=>"ASC"];

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

	public function getAllJabatan()
	{
		$this->db->order_by('nama_jabatan', 'ASC');
		return $this->db->get('jabatan')->result_array();
	}

	public function getJabatanById($id)
	{
		return $this->db->get_where('jabatan', ['id_jabatan' => $id])->row_array();
	}

	public function addJabatan()
	{
		$dataUser 				= $this->mm->getDataUser();
		$data["nama_jabatan"] 	= ucwords(strtolower($this->input->post('nama_jabatan', true)));
		$this->db->insert('jabatan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan jabatan ' . $data['nama_jabatan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan jabatan ' . $data['nama_jabatan'], $dataUser['id_user']);
		redirect('jabatan');
	}

	public function editJabatan($id)
	{
		$dataUser 				= $this->mm->getDataUser();
		$data["nama_jabatan"] 	= ucwords(strtolower($this->input->post('nama_jabatan', true)));
		$this->db->where('id_jabatan', $id);
		$this->db->update('jabatan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah jabatan ' . $data['nama_jabatan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah jabatan ' . $data['nama_jabatan'], $dataUser['id_user']);
		redirect('jabatan');
	}

	public function deleteJabatan($id)
	{
		$dataUser 					= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jabatan');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Jabatan', $dataUser['id_user']);
			redirect('jabatan');
		}

		$data['jabatan'] 			= $this->getJabatanById($id);
		$nama_jabatan 				= $data['jabatan']['nama_jabatan'];
		$this->db->delete('jabatan', ['id_jabatan' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $nama_jabatan . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $nama_jabatan . ' berhasil dihapus', $dataUser['id_user']);
		redirect('jabatan');
	}
}