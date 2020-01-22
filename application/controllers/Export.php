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

	
	public function download()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');
        
        $writer = new Xlsx($spreadsheet);
 
        $filename = 'name-of-the-generated-file';
 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
        header('Cache-Control: max-age=0');
        
        $writer->save('php://output'); // download file 
 
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
