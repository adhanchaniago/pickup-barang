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
		$this->db->select('*,
			kec_asal.nama_kecamatan as kec_asal, kec_tujuan.nama_kecamatan as kec_tujuan,
			kab_asal.nama_kabupaten as kab_asal, kab_tujuan.nama_kabupaten as kab_tujuan,
			prov_asal.nama_provinsi as prov_asal, prov_tujuan.nama_provinsi as prov_tujuan,
			prov_asal.negara as negara_asal, prov_tujuan.negara as negara_tujuan
			');
		$this->db->from('layanan_paket');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jenis_layanan = layanan_paket.id_jenis_layanan');
		$this->db->join('jenis_paket', 'jenis_paket.id_jenis_paket = layanan_paket.id_jenis_paket');
		$this->db->join('kecamatan kec_asal', 'kec_asal.id_kecamatan = layanan_paket.id_kecamatan_asal');
		$this->db->join('kecamatan kec_tujuan', 'kec_tujuan.id_kecamatan = layanan_paket.id_kecamatan_tujuan');
		$this->db->join('kabupaten kab_asal', 'kec_asal.id_kabupaten = kab_asal.id_kabupaten');
		$this->db->join('provinsi prov_asal', 'kab_asal.id_provinsi = prov_asal.id_provinsi');
		$this->db->join('kabupaten kab_tujuan', 'kec_tujuan.id_kabupaten = kab_tujuan.id_kabupaten');
		$this->db->join('provinsi prov_tujuan', 'kab_tujuan.id_provinsi = prov_tujuan.id_provinsi');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"jenis_layanan","kec_asal","kec_tujuan","durasi_pengiriman"];
		$column_search 		= ["jenis_layanan","kec_asal","kec_tujuan","durasi_pengiriman","jenis_paket","kab_asal","kab_tujuan","prov_asal","prov_tujuan","negara"];
		$default_order 		= ["harga"=>"DESC"];

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

	public function getAllLayananPaket()
	{
		$this->db->order_by('harga', 'desc');
		return $this->db->get('layanan_paket')->result_array();
	}

	public function getLayananPaketById($id)
	{
		$this->db->select('*,
			kec_asal.id_kecamatan as kec_asal, kec_tujuan.id_kecamatan as kec_tujuan,
			kab_asal.id_kabupaten as kab_asal, kab_tujuan.id_kabupaten as kab_tujuan,
			prov_asal.id_provinsi as prov_asal, prov_tujuan.id_provinsi as prov_tujuan
			');
		$this->db->join('kecamatan kec_asal', 'kec_asal.id_kecamatan = layanan_paket.id_kecamatan_asal');
		$this->db->join('kecamatan kec_tujuan', 'kec_tujuan.id_kecamatan = layanan_paket.id_kecamatan_tujuan');
		$this->db->join('kabupaten kab_asal', 'kec_asal.id_kabupaten = kab_asal.id_kabupaten');
		$this->db->join('provinsi prov_asal', 'kab_asal.id_provinsi = prov_asal.id_provinsi');
		$this->db->join('kabupaten kab_tujuan', 'kec_tujuan.id_kabupaten = kab_tujuan.id_kabupaten');
		$this->db->join('provinsi prov_tujuan', 'kab_tujuan.id_provinsi = prov_tujuan.id_provinsi');
		return $this->db->get_where('layanan_paket', ['id_layanan_paket' => $id])->row_array();
	}

	public function addLayananPaket()
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["id_jenis_paket"] 		= $this->input->post('id_jenis_paket',true);
		$data["id_jenis_layanan"] 		= $this->input->post('id_jenis_layanan',true);
		$data["id_kecamatan_asal"] 		= $this->input->post('id_kecamatan_asal',true);
		$data["id_kecamatan_tujuan"] 	= $this->input->post('id_kecamatan_tujuan',true);
		$data["harga"] 					= $this->input->post('harga',true);
		$data["durasi_pengiriman"] 		= $this->input->post('durasi_pengiriman',true);
		$this->db->insert('layanan_paket', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Layanan Paket ' . $data['layanan_paket']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan Layanan Paket ' . $data['layanan_paket'], $dataUser['id_user']);
		redirect('layananPaket');
	}

	public function editLayananPaket($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		$data["id_jenis_paket"] 		= $this->input->post('id_jenis_paket',true);
		$data["id_jenis_layanan"] 		= $this->input->post('id_jenis_layanan',true);
		$data["id_kecamatan_asal"] 		= $this->input->post('id_kecamatan_asal',true);
		$data["id_kecamatan_tujuan"] 	= $this->input->post('id_kecamatan_tujuan',true);
		$data["harga"] 					= $this->input->post('harga',true);
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