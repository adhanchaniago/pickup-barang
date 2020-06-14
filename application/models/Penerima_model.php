<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerima_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*, kecamatan.id_kecamatan as kec, kabupaten.id_kabupaten as kab, provinsi.id_provinsi as prov');
		$this->db->from('penerima');
		$this->db->join('kecamatan', 'penerima.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'kecamatan.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.id_provinsi = provinsi.id_provinsi');

	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_penerima", "no_wa_penerima", "alamat_penerima", "nama_kecamatan"];
		$column_search 		= ["nama_penerima", "no_wa_penerima", "alamat_penerima", "nama_kecamatan"];
		$default_order 		= ["nama_penerima"=>"ASC"];

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

	public function getAllPenerima()
	{
		$this->db->order_by('nama_penerima', 'ASC');
		return $this->db->get('penerima')->result_array();
	}

	public function getPenerimaById($id)
	{
		$this->db->select('*, kecamatan.id_kecamatan as kec, kabupaten.id_kabupaten as kab, provinsi.id_provinsi as prov');
		$this->db->join('kecamatan', 'penerima.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'kecamatan.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.id_provinsi = provinsi.id_provinsi');
		return $this->db->get_where('penerima', ['id_penerima' => $id])->row_array();
	}

	public function addPenerima()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_penerima"] 		= ucwords(strtolower($this->input->post('nama_penerima', true)));
		$data["no_wa_penerima"] 	= ucwords(strtolower($this->input->post('no_wa_penerima', true)));
		$data["alamat_penerima"] 	= ucwords(strtolower($this->input->post('alamat_penerima', true)));
		$data["id_kecamatan"]	 	= $this->input->post('id_kecamatan', true);
		$this->db->insert('penerima', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan penerima ' . $data['nama_penerima']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan penerima ' . $data['nama_penerima'], $dataUser['id_user']);
		redirect('penerima');
	}

	public function editPenerima($id)
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_penerima"] 		= ucwords(strtolower($this->input->post('nama_penerima', true)));
		$data["no_wa_penerima"] 	= ucwords(strtolower($this->input->post('no_wa_penerima', true)));
		$data["alamat_penerima"] 	= ucwords(strtolower($this->input->post('alamat_penerima', true)));
		$data["id_kecamatan"]	 	= $this->input->post('id_kecamatan', true);
		$this->db->where('id_penerima', $id);
		$this->db->update('penerima', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Penerima ' . $data['nama_penerima']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Penerima ' . $data['nama_penerima'], $dataUser['id_user']);
		redirect('penerima');
	}

	public function deletePenerima($id)
	{
		$dataUser 					= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Penerima');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Penerima', $dataUser['id_user']);
			redirect('penerima');
		}

		$data['penerima'] 			= $this->getPenerimaById($id);
		$nama_penerima 				= $data['penerima']['nama_penerima'];
		$this->db->delete('penerima', ['id_penerima' => $id]);
		$this->session->set_flashdata('message-success', 'Penerima ' . $nama_penerima . ' berhasil dihapus');
		$this->mm->createLog('Penerima ' . $nama_penerima . ' berhasil dihapus', $dataUser['id_user']);
		redirect('penerima');
	}
}