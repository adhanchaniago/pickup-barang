<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Provinsi_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('provinsi');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_provinsi","negara"];
		$column_search 		= ["nama_provinsi","negara"];
		$default_order 		= ["nama_provinsi"=>"ASC"];

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

	public function getAllProvinsi()
	{
		return $this->db->get('provinsi')->result_array();
	}

	public function getProvinsiById($id)
	{
		return $this->db->get_where('provinsi', ['id_provinsi' => $id])->row_array();
	}

	public function addProvinsi()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_provinsi"] 		= $this->input->post('nama_provinsi',true);
		$data["negara"] 			= $this->input->post('negara',true);
		$this->db->insert('provinsi', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Provinsi ' . $data['provinsi']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Provinsi ' . $data['provinsi'], $dataUser['id_user']);
		redirect('provinsi');
	}

	public function editProvinsi($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["nama_provinsi"] 			= $this->input->post('nama_provinsi',true);
		$data["negara"] 				= $this->input->post('negara',true);

		$this->db->where('id_provinsi', $id);
		$this->db->update('provinsi', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Provinsi ' . $data['provinsi']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Provinsi ' . $data['provinsi'], $dataUser['id_user']);
		redirect('provinsi');
	}

	public function deleteProvinsi($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_provinsi'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data provinsi');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Provinsi', $dataUser['id_user']);
			redirect('provinsi');
		}

		$data['provinsi']		= $this->getProvinsiById($id);
		$provinsi 				= $data['provinsi']['provinsi'];
		
		$this->db->delete('provinsi', ['id_provinsi' => $id]);
		$this->session->set_flashdata('message-success', 'Provinsi ' . $provinsi . ' berhasil dihapus');
		$this->mm->createLog('Provinsi ' . $provinsi . ' berhasil dihapus', $dataUser['id_user']);
		redirect('provinsi');
	}
}