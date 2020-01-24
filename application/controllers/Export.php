<?php
defined('BASEPATH') or exit('No direct script access allowed');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Export extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
		$this->load->model('sensor_model');
	}

	public function excel()
	{
		$spreadsheet = new Spreadsheet();
		$sheet = $spreadsheet->getActiveSheet();
		// Encabezado
		$data = array();
		$header = array('id', 'fecha', 'valor', 'id_sensor');

		array_push($data, $header);
		$sensorData = $this->sensor_model->getSensores();

		
		foreach ($sensorData as $val) {
			array_push($data, array(
				$val->id,
				$val->fecha,
				$val->valor,
				$val->id_sensor
			));
		}
		
		$sheet->fromArray($data, null, 'A1');

		
		//escribir datos en excel
		$writer = new Xlsx($spreadsheet);

		$filename = 'reporte';

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"');
		header('Cache-Control: max-age=0');

		$writer->save('php://output'); // download file
	}

	public function pdf()
	{
		$temp_data = $this->sensor_model->getlastData(1, 100);
		$hum_data = $this->sensor_model->getlastData(2, 100);


		$data = array(
			'temp' => $temp_data,
			'hum' => $hum_data
		);
		$html = $this->load->view('exports/pdf', $data, true);
		$filename = 'reporte';

		$this->pdf->load_html($html);
		$this->pdf->render();
		$this->pdf->stream($filename, array("Attachment" => 0));
	}
}
