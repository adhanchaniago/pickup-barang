<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class BackupDB extends CI_Controller {
	public function index()
	{
		// Load the DB utility class
		$this->load->dbutil();

		// Backup your entire database and assign it to a variable
		$backup = $this->dbutil->backup();

		// Load the file helper and write the file to your server
		$this->load->helper('file');
		$date = date('Y-m-d, H.i.s');
		$tes = write_file('./backups/database-'.$date.'.zip', $backup);

		// Load the download helper and send the file to your desktop
		$this->load->helper('download');
		force_download('database-'.$date.'.zip', $backup);
	}
}