<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PickupBarang_model extends CI_Model {
	public $column_search 	= ["no_resi","tanggal_pemesanan","tanggal_penjemputan","tanggal_masuk_logistik","nama_pengirim","no_wa_pengirim","alamat_pengirim","nama_penerima","no_wa_penerima","alamat_penerima","jenis_layanan"];
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
		$this->load->model('Pengirim_model','pengirim');
		$this->load->model('Penerima_model','penerima');
	}

	public function _setDatatable()
	{

		$this->db->select('*');
		$this->db->from('pickup_barang');
		$this->db->join('pengirim', 'pengirim.id_pengirim = pickup_barang.id_pengirim');
		$this->db->join('penerima', 'penerima.id_penerima = pickup_barang.id_penerima');
		$this->db->join('jenis_layanan', 'jenis_layanan.id_jenis_layanan = pickup_barang.id_jenis_layanan');
	}
	public function _filterDatatable()
	{
		$this->_setDatatable();
		$column_order 		= [null,"no_resi","nama_pengirim","nama_penerima","tanggal_pemesanan","tanggal_penjemputan","tanggal_masuk_logistik","jenis_layanan","id_status"];
		$column_search 		= $this->column_search;
		$default_order 		= ["tanggal_pemesanan"=>"DESC"];

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

		if ($this->input->post('id_status') != '') {
			$this->db->where('id_status', $this->input->post('id_status'));
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

	public function getAllPickupBarang()
	{
		$this->_setDatatable();
		return $this->db->get()->result_array();
	}

	public function getPickupBarangById($id)
	{
		$this->_setDatatable();
		$this->db->where('id_pickup_barang', $id);
		return $this->db->get()->row_array();
	}

	public function addPickupBarang()
	{
		$dataUser 			= $this->mm->getDataUser();
		// pengirim
		$pengirim 			= $this->pengirim->searchPengirim();
		if ($pengirim ) {
			$id_pengirim 	= $pengirim;
		}else{
			$id_pengirim 	= $this->pengirim->addPengirim();
		}

		$data 		= [];
		for ($i=0; $i < count($this->input->post('nama_penerima')); $i++) { 

			// penerima
			$penerima 			= $this->penerima->searchPenerima($i);
			if ($penerima) {
				$id_penerima 	= $penerima;
			}else{
				$id_penerima 	= $this->penerima->addPenerima($i);
			}

			$id_jenis_layanan 	= $this->input->post('jenis_layanan')[$i];

			// pickup
			$pickup["no_resi"]				= NULL;
			$pickup["id_pengirim"]			= $id_pengirim;
			$pickup["id_penerima"]			= $id_penerima;
			$pickup["id_jenis_layanan"]		= $id_jenis_layanan;
			$pickup["tanggal_pemesanan"]	= date('Y-m-d H:i:s');
			$pickup["id_status"]			= 1;
			$data[]							= $pickup;
		}

		$nama_pengirim 	= $this->input->post('nama_pengirim');
		if (!isset($_SESSION['id_user'])) {
			$this->session->set_userdata(['pelanggan' => '1']);
		}
		$this->db->insert_batch('pickup_barang', $data);
		if ($this->session->userdata('pelanggan') == '1') {
			$this->session->set_flashdata('message-success', 'Pelanggan ' . $nama_pengirim . ' berhasil menambahkan pesanan untuk kami kirim. Tunggu kurir kami untuk mengambil barang Anda. Terima Kasih :D');
			$this->mm->createLog('Pelanggan ' . $nama_pengirim . ' berhasil menambahkan pesanan ', NULL);
			$this->session->unset_userdata('pelanggan');
			redirect('auth');
		} else {
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $nama_pengirim);
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil menambahkan pesanan ' . $nama_pengirim, $dataUser['id_user']);
			redirect('pickupBarang');
		}
	}

	public function editPickupBarang($id)
	{
		$dataUser 				= $this->mm->getDataUser();
		$data["no_resi"]		= $this->input->post('no_resi');
		$data["id_status"]		= 4;

		$this->db->where('id_pickup_barang', $id);
		$this->db->update('pickup_barang', $data);

		$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['no_resi']);
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil mengubah Pickup Barang ' . $data['no_resi'], $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function deletePickupBarang($id)
	{
		$dataUser 						= $this->mm->getDataUser();
		if ($dataUser['id_jabatan'] !== '1') {
			$this->session->set_flashdata('message-failed', 'Pengguna ' . $dataUser['username'] . ' tidak memiliki hak akses menghapus data pickup barang');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mencoba menghapus data Pickup Barang', $dataUser['id_user']);
			redirect('pickupBarang');
		}

		$data['pickup_barang'] 			= $this->getPickupBarangById($id);
		$pickup_barang 					= $data['pickup_barang']['nama_pengirim'] . ' | ' . $data['pickup_barang']['nama_barang'] . ' | ' . $data['pickup_barang']['nama_penerima'];
		
		$this->db->delete('pickup_barang', ['id_pickup_barang' => $id]);
		$this->session->set_flashdata('message-success', 'Pickup Barang ' . $pickup_barang . ' berhasil dihapus');
		$this->mm->createLog('Pickup Barang ' . $pickup_barang . ' berhasil dihapus', $dataUser['id_user']);
		redirect('pickupBarang');
	}

	public function ambilPickupBarang()
	{
		$pending 			= $this->input->post('pending');
		$alamat_pengirim	= $this->input->post('alamat_pengirim');
		foreach ($pending as $key) {
			$data["id_status"]					= 2;
			$data["tanggal_penjemputan"]	= date('Y-m-d H:i:s');
			$this->db->where('id_pickup_barang', $key);
			$this->db->update('pickup_barang',$data);
		}
		$dataUser 						= $this->mm->getDataUser();

		$this->session->set_flashdata('message-success', 'Kurir '.$dataUser["username"].' Akan Mengambil Barang Di ' . $alamat_pengirim);
		$this->mm->createLog('Kurir '.$dataUser["username"].' Akan Mengambil Barang Di ' . $alamat_pengirim, $dataUser['id_user']);
		redirect('pickupBarang/kurir');
	}
	public function terimaPickupBarang()
	{
		$pickup 			= $this->input->post('pickup');
		$alamat_pengirim	= $this->input->post('alamat_pengirim');
		foreach ($pickup as $key) {
			$data["id_status"]				= 3;
			$data["tanggal_masuk_logistik"]	= date('Y-m-d H:i:s');
			$this->db->where('id_pickup_barang', $key);
			$this->db->update('pickup_barang',$data);
		}
		$dataUser 						= $this->mm->getDataUser();

		$this->session->set_flashdata('message-success', 'Kurir '.$dataUser["username"].' Telah Mengambil Barang Di ' . $alamat_pengirim);
		$this->mm->createLog('Kurir '.$dataUser["username"].' Telah Mengambil Barang Di ' . $alamat_pengirim, $dataUser['id_user']);
		redirect('pickupBarang/kurir');
	}

	public function getPickupBarangGroupByAlamat($where = [])
	{
		// $start 	= $this->input->post('start');
		// $limit 	= $this->input->post('limit');
		$search 			= $this->input->post('search');
		$column_search 		= $this->column_search;
		$this->_setDatatable();
		$this->db->select('count(*) as total');

		$i 	= 0;
		foreach ($column_search as $key) {
			if ($i == 0) {
				$this->db->group_start();
				$this->db->like($key, $search, 'BOTH');
			}else{
				$this->db->or_like($key, $search, 'BOTH');
			}
			if ($i == count($column_search) - 1) {
				$this->db->group_end();
			}
			$i++;
		}

		foreach ($where as $key => $value) {
			$this->db->where($key, $value);
		}
		$this->db->order_by('tanggal_pemesanan', 'desc');
		$this->db->group_by('alamat_pengirim');
		// $this->db->limit($start,$limit);
		return $this->db->get()->result_array();
	}
	public function getPickupBarangByWaAndStatus($no_wa_pengirim, $status = 0)
	{
		$this->db->select('
			pengirim.no_wa_pengirim,
			pengirim.alamat_pengirim
		');
		$this->db->join('pickup_barang', 'pickup_barang.id_pengirim = pengirim.id_pengirim');
		$pengirim 			= $this->db->get_where('pengirim', ['no_wa_pengirim' => $no_wa_pengirim])->row_array();
		$alamat 			= $pengirim["alamat_pengirim"];

		$search 			= $this->input->post('search');
		$column_search 		= $this->column_search;
		$this->_setDatatable();

		$i 	= 0;
		foreach ($column_search as $key) {
			if ($i == 0) {
				$this->db->group_start();
				$this->db->like($key, $search, 'BOTH');
			}else{
				$this->db->or_like($key, $search, 'BOTH');
			}
			if ($i == count($column_search) - 1) {
				$this->db->group_end();
			}
			$i++;
		}

		$this->db->where('alamat_pengirim', $alamat);
		if ($status != 0) {
			$this->db->where('id_status', $status);
		}
		$this->db->order_by('tanggal_pemesanan', 'desc');
		return $this->db->get();
	}

	public function cek_status_pesanan()
	{
		$this->db->select('*');
		$this->db->join('pengirim', 'pickup_barang.id_pengirim=pengirim.id_pengirim');
		$this->db->join('penerima', 'pickup_barang.id_penerima=penerima.id_penerima');
		$this->db->join('jenis_layanan', 'pickup_barang.id_jenis_layanan=jenis_layanan.id_jenis_layanan');
		return $this->db->get_where('pickup_barang', ['no_resi' => $this->input->post('no_resi', true)])->row_array();
	}

	public function importExcel()
	{
		$config['upload_path'] 		= './assets/excel/';
		$config['allowed_types'] 	= 'csv|xls|xlsx';
		$config['encrypt_name'] 	= true;
		
		$this->load->library('upload', $config);
		
		if ( ! $this->upload->do_upload('excel')){
			$this->session->set_flashdata('message-success',  $this->upload->display_errors());
		}
		else{
			$data_upload 		= $this->upload->data('file_name');
			$explode 			= explode('.', $data_upload);
			$extension 			= end($explode);

			if ($extension == 'csv') {
				$excelreader 	= PHPExcel_IOFactory::createReader($extension);
			}else{
				$excelreader 	= PHPExcel_IOFactory::createReader('Excel2007');
			}
			$loadexcel			= $excelreader->load('assets/excel/'.$data_upload);
			$sheet 			    = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
			$numrow 			= 0;
			foreach($sheet as $row){
				if($numrow > 0){
					$no_resi 		= $row["A"];
					$no_wa_pengirim = substr($row["I"], 4);
					$no_wa_penerima = substr($row["K"], 4);

					$this->db->select('id_pickup_barang,no_wa_pengirim,nama_penerima,alamat_penerima,no_wa_penerima');
					$this->db->from('pickup_barang');
					$this->db->join('pengirim', 'pengirim.id_pengirim = pickup_barang.id_pengirim');
					$this->db->join('penerima', 'penerima.id_penerima = pickup_barang.id_penerima');
					$this->db->like('no_wa_pengirim', $no_wa_pengirim, 'LEFT');
					$this->db->like('no_wa_penerima', $no_wa_penerima, 'LEFT');
					$this->db->where('id_status', 3);
					$cek 			= $this->db->get();

					if ($cek->num_rows()  ==  1) {
						$data 					= $cek->row_array();
						$id_pickup_barang 		= $data["id_pickup_barang"];
						$no_resi 				= preg_replace('/[^0-9]/', "", $no_resi);
						$upd["no_resi"]			= $no_resi;
						$upd["id_status"]		= 4;

						$this->db->where('id_pickup_barang', $id_pickup_barang);
						$this->db->update('pickup_barang', $upd);
					}
				}
				$numrow++;
			}
			$dataUser 			= $this->mm->getDataUser();
			$this->session->set_flashdata('message-success', 'Pengguna ' . $dataUser['username'] . ' mengimport nomor resi ');
			$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' mengimport nomor resi ', $dataUser['id_user']);
		}
		return redirect('pickupBarang','refresh');

	}
}