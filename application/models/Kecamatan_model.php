<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kecamatan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('kecamatan');
		$this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.id_kabupaten');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_kecamatan","nama_kabupaten","nama_provinsi","negara"];
		$column_search 		= ["nama_kecamatan","nama_kabupaten","nama_provinsi","negara"];
		$default_order 		= ["nama_kecamatan"=>"ASC"];

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

	public function getAllKecamatan()
	{
		$this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.id_kabupaten');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
		return $this->db->get('kecamatan')->result_array();
	}

	public function getKecamatanById($id)
	{
		$this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.id_kabupaten');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
		return $this->db->get_where('kecamatan', ['id_kecamatan' => $id])->row_array();
	}
	public function getKecamatanByKabupaten($id)
	{
		$this->db->join('kabupaten', 'kabupaten.id_kabupaten = kecamatan.id_kabupaten');
		$this->db->join('provinsi', 'provinsi.id_provinsi = kabupaten.id_provinsi');
		return $this->db->get_where('kecamatan', ['kecamatan.id_kabupaten' => $id])->result_array();
	}

	public function addKecamatan()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_kecamatan"]		= $this->input->post('nama_kecamatan',true);
		$data["id_kabupaten"]		= $this->input->post('id_kabupaten',true);
		$this->db->insert('kecamatan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan kecamatan ' . $data['kecamatan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan kecamatan ' . $data['kecamatan'], $dataUser['id_user']);
		redirect('kecamatan');
	}

	public function editKecamatan($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["nama_kecamatan"]			= $this->input->post('nama_kecamatan',true);
		$data["id_kabupaten"]			= $this->input->post('id_kabupaten',true);

		$this->db->where('id_kecamatan', $id);
		$this->db->update('kecamatan', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah kecamatan ' . $data['kecamatan']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah kecamatan ' . $data['kecamatan'], $dataUser['id_user']);
		redirect('kecamatan');
	}

	public function deleteKecamatan($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data kecamatan');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data kecamatan', $dataUser['id_user']);
			redirect('kecamatan');
		}

		$data['kecamatan']		= $this->getKecamatanById($id);
		$kecamatan 				= $data['kecamatan']['nama_kecamatan'];
		
		$this->db->delete('kecamatan', ['id_kecamatan' => $id]);
		$this->session->set_flashdata('message-success', 'kecamatan ' . $kecamatan . ' berhasil dihapus');
		$this->mm->createLog('kecamatan ' . $kecamatan . ' berhasil dihapus', $dataUser['id_user']);
		redirect('kecamatan');
	}
}