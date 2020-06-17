<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pesanan_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function getPesanan()
	{
		$this->db->select('*');
		$this->db->join('pengirim', 'pengirim.id_pengirim=pickup_barang.id_pengirim');
		$this->db->join('penerima', 'penerima.id_penerima=pickup_barang.id_penerima');
		$this->db->join('layanan_paket', 'layanan_paket.id_layanan_paket=pickup_barang.id_layanan_paket');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jenis_layanan=layanan_paket.id_jenis_layanan');
		$this->db->order_by('tanggal_pemesanan', 'desc');
		return $this->db->get('pickup_barang')->result_array();
	}
}