<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sensor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model(array('sensor_model'));
		$this->load->helper('url_helper');
	}

	public function index()
	{
		$data = $this->sensor_model->getSensores();

		$sensores['temperatura'] = array();
		$sensores['humedad'] = array();
		foreach ($data as $row) {
			$value = (float)$row->valor;
			$timestamp = $row->fecha;
			if ($row->id_sensor == 1) {
				array_push($sensores['temperatura'], array(
					$timestamp,
					$value
				));
			}
			if ($row->id_sensor == 2) {
				array_push($sensores['humedad'], array(
					$timestamp,
					$value
				));
			}
		}

		echo json_encode($sensores);
	}

	public function getLast(){
		$lastData = $this->sensor_model->getLast();
		echo json_encode($lastData);
	}	

	public function getDataSensor($sensor){
		$data = $this->sensor_model->getData($sensor);
		echo json_encode($data);
	}

	public function getLastSensor($sensor, $limit){
		$data = $this->sensor_model->getlastData($sensor, $limit);
		echo json_encode($data);
	}

	public function insertar()
	{
		$temperatura = $this->input->post('temp');
		$humedad = $this->input->post('hum');
		$status = $this->sensor_model->insert($temperatura, $humedad);
		
		$this->output->set_status_header($status);
	}

	public function getData($limit){
		$data = $this->sensor_model->getlimitData($limit);
		$sensores['temperatura'] = array();
		$sensores['humedad'] = array();
		foreach ($data['tem'] as $row) {
			$value = (float)$row->valor;
			$timestamp = $row->fecha;
			if ($row->id_sensor == 1) {
				array_push($sensores['temperatura'], array(
					$timestamp,
					$value
				));
			}
		}

		foreach ($data['hum'] as $row) {
			$value = (float)$row->valor;
			$timestamp = $row->fecha;

			if ($row->id_sensor == 2) {
				array_push($sensores['humedad'], array(
					$timestamp,
					$value
				));
			}
		}
		echo json_encode($sensores);
	}
}
