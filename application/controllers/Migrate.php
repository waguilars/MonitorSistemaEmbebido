<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migrate extends CI_Controller
{
	public function index()
	{
		$this->load->library('migration');

		if ($this->migration->current() === false) {
			show_error($this->migration->error_string());
		} else {
			echo "migracion completa";
		}
	}

	public function version($ver = 3)
	{
		$this->load->library("migration");

		if (!$this->migration->version($ver)) {
			show_error($this->migration->error_string());
		}else{
			echo "Se completo con exito";
		}
	}
}
