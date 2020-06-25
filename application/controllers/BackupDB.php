<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackupDB extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Main_model', 'mm');
	}
	public function index()
	{
		$dataUser = $this->mm->getDataUser();
		$this->mm->createLog('Pengguna ' . $dataUser['username'] . ' berhasil membuat Backup, untuk mengakses backup tambahkan /backups diakhir url, contoh https://pickupbarang.com/backups ', $dataUser['id_user']);

		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		$date = date('Y-m-d, H.i.s');
		write_file('./backups/database-'.$date.'.zip', $backup);
		

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('database-'.$date.'.zip', $backup);

	}
}