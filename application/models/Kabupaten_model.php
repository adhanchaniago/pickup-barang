<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kabupaten_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('kabupaten');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_kabupaten","nama_provinsi","negara"];
		$column_search 		= ["nama_kabupaten","nama_provinsi","negara"];
		$default_order 		= ["nama_kabupaten"=>"ASC"];

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

	public function getAllKabupaten()
	{
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
		return $this->db->get('kabupaten')->result_array();
	}

	public function getKabupatenById($id)
	{
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
		return $this->db->get_where('kabupaten', ['id_kabupaten' => $id])->row_array();
	}
	public function getKabupatenByProvinsi($id)
	{
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
		return $this->db->get_where('kabupaten', ['kabupaten.id_provinsi' => $id])->result_array();
	}

	public function addKabupaten()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_kabupaten"]		= $this->input->post('nama_kabupaten',true);
		$data["id_provinsi"]		= $this->input->post('id_provinsi',true);
		$this->db->insert('kabupaten', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan kabupaten ' . $data['kabupaten']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan kabupaten ' . $data['kabupaten'], $dataUser['id_user']);
		redirect('kabupaten');
	}

	public function editKabupaten($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["nama_kabupaten"]			= $this->input->post('nama_kabupaten',true);
		$data["id_provinsi"]			= $this->input->post('id_provinsi',true);

		$this->db->where('id_kabupaten', $id);
		$this->db->update('kabupaten', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah kabupaten ' . $data['kabupaten']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah kabupaten ' . $data['kabupaten'], $dataUser['id_user']);
		redirect('kabupaten');
	}

	public function deleteKabupaten($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data kabupaten');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data kabupaten', $dataUser['id_user']);
			redirect('kabupaten');
		}

		$data['kabupaten']		= $this->getKabupatenById($id);
		$kabupaten 				= $data['kabupaten']['nama_kabupaten'];
		
		$this->db->delete('kabupaten', ['id_kabupaten' => $id]);
		$this->session->set_flashdata('message-success', 'kabupaten ' . $kabupaten . ' berhasil dihapus');
		$this->mm->createLog('kabupaten ' . $kabupaten . ' berhasil dihapus', $dataUser['id_user']);
		redirect('kabupaten');
	}
}