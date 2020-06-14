<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*, kecamatan.id_kecamatan as kec, kabupaten.id_kabupaten as kab, provinsi.id_provinsi as prov');
		$this->db->from('pengirim');
		$this->db->join('kecamatan', 'pengirim.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'kecamatan.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.id_provinsi = provinsi.id_provinsi');

	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_pengirim", "no_wa_pengirim", "alamat_pengirim", "nama_kecamatan"];
		$column_search 		= ["nama_pengirim", "no_wa_pengirim", "alamat_pengirim", "nama_kecamatan"];
		$default_order 		= ["nama_pengirim"=>"ASC"];

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

	public function getAllPengirim()
	{
		$this->db->order_by('nama_pengirim', 'ASC');
		return $this->db->get('pengirim')->result_array();
	}

	public function getPengirimById($id)
	{
		$this->db->select('*, kecamatan.id_kecamatan as kec, kabupaten.id_kabupaten as kab, provinsi.id_provinsi as prov');
		$this->db->join('kecamatan', 'pengirim.id_kecamatan = kecamatan.id_kecamatan');
		$this->db->join('kabupaten', 'kecamatan.id_kabupaten = kabupaten.id_kabupaten');
		$this->db->join('provinsi', 'kabupaten.id_provinsi = provinsi.id_provinsi');
		return $this->db->get_where('pengirim', ['id_pengirim' => $id])->row_array();
	}

	public function addPengirim()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_pengirim"] 		= ucwords(strtolower($this->input->post('nama_pengirim', true)));
		$data["no_wa_pengirim"] 	= ucwords(strtolower($this->input->post('no_wa_pengirim', true)));
		$data["alamat_pengirim"] 	= ucwords(strtolower($this->input->post('alamat_pengirim', true)));
		$data["id_kecamatan"]	 	= $this->input->post('id_kecamatan', true);
		$this->db->insert('pengirim', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pengirim ' . $data['nama_pengirim']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pengirim ' . $data['nama_pengirim'], $dataUser['id_user']);
		redirect('pengirim');
	}

	public function editPengirim($id)
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["nama_pengirim"] 		= ucwords(strtolower($this->input->post('nama_pengirim', true)));
		$data["no_wa_pengirim"] 	= ucwords(strtolower($this->input->post('no_wa_pengirim', true)));
		$data["alamat_pengirim"] 	= ucwords(strtolower($this->input->post('alamat_pengirim', true)));
		$data["id_kecamatan"]	 	= $this->input->post('id_kecamatan', true);
		$this->db->where('id_pengirim', $id);
		$this->db->update('pengirim', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah pengirim ' . $data['nama_pengirim']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah pengirim ' . $data['nama_pengirim'], $dataUser['id_user']);
		redirect('pengirim');
	}

	public function deletePengirim($id)
	{
		$dataUser 					= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data pengirim');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data pengirim', $dataUser['id_user']);
			redirect('pengirim');
		}

		$data['pengirim'] 			= $this->getPengirimById($id);
		$nama_pengirim 				= $data['pengirim']['nama_pengirim'];
		$this->db->delete('pengirim', ['id_pengirim' => $id]);
		$this->session->set_flashdata('message-success', 'pengirim ' . $nama_pengirim . ' berhasil dihapus');
		$this->mm->createLog('pengirim ' . $nama_pengirim . ' berhasil dihapus', $dataUser['id_user']);
		redirect('pengirim');
	}
}