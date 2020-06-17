<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penerima_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function searchPenerima($i)
	{

		$nama_penerima						= $this->input->post('nama_penerima',true)[$i];
		$no_wa_penerima						= $this->input->post('no_wa_penerima',true)[$i];
		$alamat_penerima					= $this->input->post('alamat_penerima',true)[$i];
		$kecamatan_penerima					= $this->input->post('kecamatan_penerima',true)[$i];

		$this->db->where('nama_penerima', $nama_penerima);
		$this->db->where('no_wa_penerima', $no_wa_penerima);
		$this->db->where('alamat_penerima', $alamat_penerima);
		$this->db->where('id_kecamatan', $kecamatan_penerima);
		$cek_penerima 		= $this->db->get('penerima');
		if ($cek_penerima)->num_rows() > 0) {
			$get_penerima 	= $cek_penerima->row_array();
			return 	$get_penerima["id_penerima"];
		}else{
			return 0;
		}
	}

	public function addPenerima($i)
	{
		$nama_penerima						= $this->input->post('nama_penerima',true)[$i];
		$no_wa_penerima						= $this->input->post('no_wa_penerima',true)[$i];
		$alamat_penerima					= $this->input->post('alamat_penerima',true)[$i];
		$kecamatan_penerima					= $this->input->post('kecamatan_penerima',true)[$i];

		$penerima["nama_penerima"]			= $nama_penerima;
		$penerima["no_wa_penerima"]			= $no_wa_penerima;
		$penerima["alamat_penerima"]		= $alamat_penerima;
		$penerima["id_kecamatan"]			= $kecamatan_penerima;
		$this->db->insert('penerima', $penerima);
		return $this->db->insert_id();
	}
}