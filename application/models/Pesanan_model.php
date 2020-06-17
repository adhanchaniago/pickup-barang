<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getPesanan($dari_tanggal = '', $sampai_tanggal = '')
	{
		if ($dari_tanggal !== '' AND $sampai_tanggal !== '') {
			$dateThen = $dari_tanggal . ' 00:00:00';
			$dateLast = $sampai_tanggal . ' 23:59:58';
		} else {
			$dateThen = date('Y-m-d 00:00:00');
			$dateLast = date('Y-m-d 23:59:58');
		}

		$query = "SELECT * FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN layanan_paket ON pickup_barang.id_layanan_paket = layanan_paket.id_layanan_paket 
			INNER JOIN jenis_layanan ON layanan_paket.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE tanggal_pemesanan BETWEEN '$dateThen' AND '$dateLast'
			ORDER BY tanggal_pemesanan DESC
		";
		return $this->db->query($query)->result_array();
	}
}