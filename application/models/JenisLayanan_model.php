<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisLayanan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('jenis_layanan');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"jenis_layanan"];
		$column_search 		= ["jenis_layanan"];
		$default_order 		= ["jenis_layanan"=>"ASC"];

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

	public function getAllJenisLayanan()
	{
		return $this->db->get('jenis_layanan')->result_array();
	}

	public function getJenisLayananById($id)
	{
		return $this->db->get_where('jenis_layanan', ['id_jenis_layanan' => $id])->row_array();
	}

	public function addJenisLayanan()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["jenis_layanan"] 		= $this->input->post('jenis_layanan',true);
		$this->db->insert('jenis_layanan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Jenis Layanan ' . $data['jenis_layanan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Jenis Layanan ' . $data['jenis_layanan'], $dataUser['id_user']);
		redirect('jenisLayanan');
	}

	public function editJenisLayanan($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["jenis_layanan"] 			= $this->input->post('jenis_layanan',true);

		$this->db->where('id_jenis_layanan', $id);
		$this->db->update('jenis_layanan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Jenis Layanan ' . $data['jenis_layanan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Jenis Layanan ' . $data['jenis_layanan'], $dataUser['id_user']);
		redirect('jenisLayanan');
	}

	public function deleteJenisLayanan($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jenis Layanan');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Jenis Layanan', $dataUser['id_user']);
			redirect('jenisLayanan');
		}

		$data['jenisLayanan']	= $this->getJenisLayananById($id);
		$jenis_layanan 			= $data['jenisLayanan']['jenis_layanan'];
		
		$this->db->delete('jenis_layanan', ['id_jenis_layanan' => $id]);
		$this->session->set_flashdata('message-success', 'Jenis Layanan ' . $jenis_layanan . ' berhasil dihapus');
		$this->mm->createLog('Jenis Layanan ' . $jenis_layanan . ' berhasil dihapus', $dataUser['id_user']);
		redirect('jenisLayanan');
	}
}