<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Export extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('sensor_model');
	}

	public function pdf()
	{
		$temp_data = $this->sensor_model->getData(1);
		$hum_data = $this->sensor_model->getData(2);
		
		$data = array(
			'temp'=> $temp_data,
			'hum' => $hum_data
		);
		$html = $this->load->view('exports/pdf', $data, true);
		$filename = 'reporte';

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream($filename, array("Attachment" => 0));
	}
}
