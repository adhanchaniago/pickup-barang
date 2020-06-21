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
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.id_status = '$id_status'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		} else {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN status ON pickup_barang.id_status = status.id_status 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast'
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
}