<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengirim_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function searchPengirim()
	{
		$nama_pengirim						= $this->input->post('nama_pengirim',true);
		$no_wa_pengirim						= $this->input->post('no_wa_pengirim',true);
		$alamat_pengirim					= $this->input->post('alamat_pengirim',true);
		$ip_address 						= $this->input->ip_address();

		$this->db->where('nama_pengirim', $nama_pengirim);
		$this->db->where('no_wa_pengirim', $no_wa_pengirim);
		$this->db->where('alamat_pengirim', $alamat_pengirim);
		$this->db->where('ip_address', $ip_address);
		$cek_pengirim 		= $this->db->get('pengirim');
		if ($cek_pengirim->num_rows() > 0) {
			$get_pengirim 	= $cek_pengirim->row_array();
			return 	$get_pengirim["id_pengirim"];
		}else{
			return 0;
		}
	}

	public function addPengirim()
	{
		$nama_pengirim						= $this->input->post('nama_pengirim',true);
		$no_wa_pengirim						= $this->input->post('no_wa_pengirim',true);
		$alamat_pengirim					= $this->input->post('alamat_pengirim',true);
		$ip_address 						= $this->input->ip_address();

		$pengirim["nama_pengirim"]			= $nama_pengirim;
		$pengirim["alamat_pengirim"]		= $alamat_pengirim;
		$pengirim["ip_address"]				= $ip_address;

		$no_wa_pengirim 					= $this->mm->no_telepon_validasi($no_wa_pengirim);
		$pengirim["no_wa_pengirim"]			= $no_wa_pengirim;

		$this->db->insert('pengirim', $pengirim);
		return $this->db->insert_id();
	}

	public function getPengirimByIp()
	{
		$ip_address 		= $this->input->ip_address();
		$this->db->where('ip_address', $ip_address);
		$this->db->order_by('id_pengirim', 'desc');
		$cek_pengirim 		= $this->db->get('pengirim');
		$get_pengirim 		= $cek_pengirim->row_array();
		return 	$get_pengirim;
	}

	public function getPengirimByNoWa($no_wa_pengirim)
	{
		//$no_wa_pengirim = $this->mm->no_telepon_validasi($this->input->post('no_wa_pengirim', true));
		$query = "SELECT * FROM pickup_barang 
			INNER JOIN pengirim ON pickup_barang.id_pengirim = pengirim.id_pengirim 
			INNER JOIN status ON pickup_barang.id_status = status.id_status 
			INNER JOIN penerima ON pickup_barang.id_penerima = penerima.id_penerima 
			INNER JOIN jenis_layanan ON pickup_barang.id_jenis_layanan = jenis_layanan.id_jenis_layanan 
			WHERE pengirim.no_wa_pengirim = '$no_wa_pengirim'
		";
		return $this->db->query($query)->row_array();
	}


}