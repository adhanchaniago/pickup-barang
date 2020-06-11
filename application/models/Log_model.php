<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}

	public function _setDatatable()
	{
		$this->db->select('*');
		$this->db->from('log');
		$this->db->join('user', 'log.id_user=user.id_user', 'left');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"username","isi_log","tanggal_log"];
		$column_search 		= ["username","isi_log","tanggal_log"];
		$default_order 		= ["tanggal_log"=>"DESC"];

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

	public function getAllLog()
	{
		$this->db->select('*');
		$this->db->join('user', 'log.id_user=user.id_user', 'left');
		$this->db->order_by('tanggal_log', 'desc');
		return $this->db->get('log')->result_array();
	}
}