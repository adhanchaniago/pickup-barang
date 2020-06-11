<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayananPaket_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('layanan_paket');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"layanan_paket","harga_layanan_paket","durasi_pengiriman"];
		$column_search 		= ["layanan_paket","harga_layanan_paket","durasi_pengiriman"];
		$default_order 		= ["harga_layanan_paket"=>"DESC"];

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

	public function getAllLayananPaket()
	{
		$this->db->order_by('harga_layanan_paket', 'desc');
		return $this->db->get('layanan_paket')->result_array();
	}

	public function getLayananPaketById($id)
	{
		return $this->db->get_where('layanan_paket', ['id_layanan_paket' => $id])->row_array();
	}

	public function addLayananPaket()
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["layanan_paket"] 			= $this->input->post('layanan_paket',true);
		$data["harga_layanan_paket"] 	= $this->input->post('harga_layanan_paket',true);
		$data["durasi_pengiriman"] 		= $this->input->post('durasi_pengiriman',true);
		$this->db->insert('layanan_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Layanan Paket ' . $data['layanan_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Layanan Paket ' . $data['layanan_paket'], $dataUser['id_user']);
		redirect('layananPaket');
	}

	public function editLayananPaket($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["layanan_paket"] 			= $this->input->post('layanan_paket',true);
		$data["harga_layanan_paket"] 	= $this->input->post('harga_layanan_paket',true);
		$data["durasi_pengiriman"] 		= $this->input->post('durasi_pengiriman',true);

		$this->db->where('id_layanan_paket', $id);
		$this->db->update('layanan_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Layanan Paket ' . $data['layanan_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Layanan Paket ' . $data['layanan_paket'], $dataUser['id_user']);
		redirect('layananPaket');
	}

	public function deleteLayananPaket($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_layanan_paket'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data layanan_paket');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Layanan Paket', $dataUser['id_user']);
			redirect('layananPaket');
		}

		$data['layanan_paket']		 = $this->getLayananPaketById($id);
		$layanan_paket 				= $data['layanan_paket']['layanan_paket'];
		
		$this->db->delete('layanan_paket', ['id_layanan_paket' => $id]);
		$this->session->set_flashdata('message-success', 'Jabatan ' . $layanan_paket . ' berhasil dihapus');
		$this->mm->createLog('Jabatan ' . $layanan_paket . ' berhasil dihapus', $dataUser['id_user']);
		redirect('layananPaket');
	}
}