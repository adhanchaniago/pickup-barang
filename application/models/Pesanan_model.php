<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getPesanan($dari_tanggal = '', $sampai_tanggal = '', $id_status = '')
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
		}

		if ($id_status !== '') {
			$query = "SELECT *,
				SUM(IF(jenis_layanan.id_jenis_layanan = 1,1,0)) jenis1,
				SUM(IF(jenis_layanan.id_jenis_layanan = 2,1,0)) jenis2,
				SUM(IF(jenis_layanan.id_jenis_layanan = 3,1,0)) jenis3
				FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.id_status = '$id_status'
				GROUP BY pickup_barang.id_pengirim
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		} else {
			$query = "SELECT *,
				SUM(IF(jenis_layanan.id_jenis_layanan = 1,1,0)) jenis1,
				SUM(IF(jenis_layanan.id_jenis_layanan = 2,1,0)) jenis2,
				SUM(IF(jenis_layanan.id_jenis_layanan = 3,1,0)) jenis3
				FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast'
				GROUP BY pickup_barang.id_pengirim
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		}
		return $this->db->query($query)->result_array();
	}

	public function getDetailPenerima($dari_tanggal, $sampai_tanggal, $id_status,$id_pengirim)
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
		}

		if ($id_status != 0) {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' 
				AND pickup_barang.id_status = '$id_status' 
				AND pickup_barang.id_pengirim = '$id_pengirim'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		} else {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' 
				AND pickup_barang.id_pengirim = '$id_pengirim'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		}
		return $this->db->query($query)->result_array();
	}

	public function getPesananByNoWaPengirimNoSort($no_wa_pengirim = '')
	{
		$dateThen = date('Y-m-d 00:00:00');
		$dateLast = date('Y-m-d 23:59:58');
		$query = "SELECT * FROM pickup_barang 
			INNER JOIN status ON pickup_barang.id_status = status.id_status 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND 
			pengirim.no_wa_pengirim = '$no_wa_pengirim'
			ORDER BY pickup_barang.tanggal_pemesanan DESC
		";
		return $this->db->query($query)->result_array();
	}

	public function getPesananByNoWaPengirim($dari_tanggal = '', $sampai_tanggal = '', $id_status = '', $no_wa_pengirim = '')
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
		}

		if ($id_status !== '') {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.id_status = '$id_status' AND 
				pengirim.no_wa_pengirim = '$no_wa_pengirim'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		} else {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND 
				pengirim.no_wa_pengirim = '$no_wa_pengirim'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		}
		return $this->db->query($query)->result_array();
	}

	public function getJmlStatus($dari_tanggal = '', $sampai_tanggal = '')
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
		}

		$query = "SELECT SUM(IF(id_status = 1,1,0)) as pending, 
			SUM(IF(id_status = 2,1,0)) as kurir_menjemput,
			SUM(IF(id_status = 3,1,0)) as barang_masuk_logistik,
			SUM(IF(id_status = 4,1,0)) as resi_terinput
			FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast'
			ORDER BY pickup_barang.tanggal_pemesanan DESC
		";
		return $this->db->query($query)->row_array();
	}

	public function getJmlStatusByNoWaPengirimNoSort($no_wa_pengirim = '')
	{
		$dateThen = date('Y-m-d 00:00:00');
		$dateLast = date('Y-m-d 23:59:58');

		$query = "SELECT SUM(IF(id_status = 1,1,0)) as pending, 
			SUM(IF(id_status = 2,1,0)) as kurir_menjemput,
			SUM(IF(id_status = 3,1,0)) as barang_masuk_logistik,
			SUM(IF(id_status = 4,1,0)) as resi_terinput
			FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND 
			pengirim.no_wa_pengirim = '$no_wa_pengirim'
			ORDER BY pickup_barang.tanggal_pemesanan DESC
		";
		return $this->db->query($query)->row_array();
	}

	public function getJmlStatusByNoWaPengirim($dari_tanggal = '', $sampai_tanggal = '', $no_wa_pengirim = '')
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
		}

		$query = "SELECT SUM(IF(id_status = 1,1,0)) as pending, 
			SUM(IF(id_status = 2,1,0)) as kurir_menjemput,
			SUM(IF(id_status = 3,1,0)) as barang_masuk_logistik,
			SUM(IF(id_status = 4,1,0)) as resi_terinput
			FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND 
			pengirim.no_wa_pengirim = '$no_wa_pengirim'
			ORDER BY pickup_barang.tanggal_pemesanan DESC
		";
		return $this->db->query($query)->row_array();
	}

	public function _setDatatable()
	{

		$this->db->select('*');
		$this->db->from('pickup_barang');
		$this->db->join('status', 'status.id_status = pickup_barang.id_status');
		$this->db->join('pengirim', 'pengirim.id_pengirim = pickup_barang.id_pengirim');
		$this->db->join('penerima', 'penerima.id_penerima = pickup_barang.id_penerima');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jenis_layanan = pickup_barang.id_jenis_layanan');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"nama_penerima", "tanggal_pemesanan", "id_status"];
		$column_search 		= $this->column_search;
		$default_order 		= ["tanggal_pemesanan"=>"DESC"];

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

		if ($this->input->post('id_status') != '') {
			$this->db->where('id_status', $this->input->post('id_status'));
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

	// public function getAllPickupBarang()
	// {
	// 	$this->_setDatatable();
	// 	return $this->db->get()->result_array();
	// }

}