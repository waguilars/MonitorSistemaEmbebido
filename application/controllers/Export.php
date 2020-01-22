<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}

	public function pdf()
	{

		$html = $this->load->view('exports/pdf');
		$filename = 'reporte';

		//$this->pdf->load_html($html);
		//$this->pdf->render();
		//$this->pdf->stream($filename, array("Attachment" => 0));
	}
}
