<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_model extends CI_Model {

	public function view_admin($url,$data)
	{
		$this->load->view('templates/header-admin', $data);
		$this->load->view($url, $data);
		$this->load->view('templates/footer-admin', $data);
	}
	public function view_auth($url,$data)
	{
		$this->load->view('templates/header-auth', $data);
		$this->load->view($url, $data);
		$this->load->view('templates/footer-auth', $data);
	}

}

/* End of file Layout.php */
/* Location: ./application/models/Layout.php */