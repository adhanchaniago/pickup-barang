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
		$kecamatan_pengirim					= $this->input->post('kecamatan_pengirim',true);

		$this->db->where('nama_pengirim', $nama_pengirim);
		$this->db->where('no_wa_pengirim', $no_wa_pengirim);
		$this->db->where('alamat_pengirim', $alamat_pengirim);
		$this->db->where('id_kecamatan', $kecamatan_pengirim);
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
		$kecamatan_pengirim					= $this->input->post('kecamatan_pengirim',true);

		$pengirim["nama_pengirim"]			= $nama_pengirim;
		$pengirim["no_wa_pengirim"]			= $no_wa_pengirim;
		$pengirim["alamat_pengirim"]		= $alamat_pengirim;
		$pengirim["id_kecamatan"]			= $kecamatan_pengirim;
		$this->db->insert('pengirim', $pengirim);
		return $this->db->insert_id();
	}

}