<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Layout_model extends CI_Model {

	public function view_admin($url,$data)
	{
		$path 							= explode('/', $this->input->server('PATH_INFO'));
		if (count($path) <= 2) {
			$link 						= $path[1];
		}else{
			$link 						= $path[1].'/'.$path[2];
		}
		$data["def_link"]				= $link;

		$this->load->view('templates/header-admin', $data);
		$this->load->view($url, $data);
		$this->load->view('templates/footer-admin', $data);
	}
	public function view_auth($url,$data,$render = false)
	{
		$path 							= explode('/', $this->input->server('PATH_INFO'));
		if (count($path) == 1) {
			redirect('auth','refresh');
		}
		elseif (count($path) == 2) {
			$link 						= $path[1];
		}else{
			$link 						= $path[1].'/'.$path[2];
		}
		$data["def_link"]				= $link;

		if ($render) {
			$html 	= $this->load->view('templates/header-auth', $data,TRUE);
			$html 	.= $this->load->view($url, $data,TRUE);
			$html 	.= $this->load->view('templates/footer-auth', $data,TRUE);
			return $html;
		}else{			
			$this->load->view('templates/header-auth', $data);
			$this->load->view($url, $data);
			if ($this->uri->segment(2) !== 'login' AND $this->uri->segment(2) !== 'kurir' AND $this->uri->segment(2) !== 'detailPickup') {
				$this->load->view('templates/footer-landing', $data);
			}
			$this->load->view('templates/footer-auth', $data);
		}
	}
	public function view_operator($url,$data)
	{
		$path 							= explode('/', $this->input->server('PATH_INFO'));
		if (count($path) <= 2) {
			$link 						= $path[1];
		}else{
			$link 						= $path[1].'/'.$path[2];
		}
		$data["def_link"]				= $link;

		$this->load->view('templates/header-operator', $data);
		$this->load->view($url, $data);
		$this->load->view('templates/footer-operator', $data);
	}

}

/* End of file Layout.php */
/* Location: ./application/models/Layout.php */