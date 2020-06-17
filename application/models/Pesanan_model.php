<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getPesanan($dari_tanggal = '', $sampai_tanggal = '', $status = '1')
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '' AND $status !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
			$status = $status;
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
			$status = '1';
		}

		if ($status !== '4') {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
				INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.status = '$status'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		} else {
			$query = "SELECT * FROM pickup_barang 
				INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
				INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
				INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
				INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
				WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast'
				ORDER BY pickup_barang.tanggal_pemesanan DESC
			";
		}
		$rs = $this->db->query($query);
		while($obj = $rs->free_result()) {
	    	$result[] = $obj;
	    }
	    echo $_GET['callback'] . '{"result":' . json_encode($result) . '}';
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

		$query = "SELECT *, (SELECT count(status) FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
			INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.status = '1') as pending, 
			(SELECT count(status) FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
			INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.status = '2') as kurir_menjemput,
			(SELECT count(status) FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
			INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast' AND pickup_barang.status = '3') as barang_masuk_logistik
			FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
			INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pickup_barang.tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast'
			ORDER BY pickup_barang.tanggal_pemesanan DESC
		";
		return $this->db->query($query)->row_array();
	}
}