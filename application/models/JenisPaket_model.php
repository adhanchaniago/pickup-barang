<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class JenisPaket_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('jenis_paket');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"jenis_paket"];
		$column_search 		= ["jenis_paket"];
		$default_order 		= ["jenis_paket"=>"ASC"];

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

	public function getAllJenisPaket()
	{
		$this->db->order_by('jenis_paket', 'asc');
		return $this->db->get('jenis_paket')->result_array();
	}

	public function getJenisPaketById($id)
	{
		return $this->db->get_where('jenis_paket', ['id_jenis_paket' => $id])->row_array();
	}

	public function addJenisPaket()
	{
		$dataUser 					= $this->mm->getDataUser();
		$data["jenis_paket"] 		= $this->input->post('jenis_paket',true);
		$this->db->insert('jenis_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Jenis Paket ' . $data['jenis_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Jenis Paket ' . $data['jenis_paket'], $dataUser['id_user']);
		redirect('jenisPaket');
	}

	public function editJenisPaket($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["jenis_paket"] 			= $this->input->post('jenis_paket',true);

		$this->db->where('id_jenis_paket', $id);
		$this->db->update('jenis_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Jenis Paket ' . $data['jenis_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Jenis Paket ' . $data['jenis_paket'], $dataUser['id_user']);
		redirect('jenisPaket');
	}

	public function deleteJenisPaket($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data Jenis Paket');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Jenis Paket', $dataUser['id_user']);
			redirect('jenisPaket');
		}

		$data['jenisPaket']	= $this->getJenisPaketById($id);
		$jenis_paket 			= $data['jenisPaket']['jenis_paket'];
		
		$this->db->delete('jenis_paket', ['id_jenis_paket' => $id]);
		$this->session->set_flashdata('message-success', 'Jenis Paket ' . $jenis_paket . ' berhasil dihapus');
		$this->mm->createLog('Jenis Paket ' . $jenis_paket . ' berhasil dihapus', $dataUser['id_user']);
		redirect('jenisPaket');
	}
}