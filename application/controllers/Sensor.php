<?php
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
		$this->sensor_model->getSensores();
	}

	public function insertar()
	{
		$sensor = $this->input->post('sensor');
		$valor = $this->input->post('value');

		$status = $this->sensor_model->insert($sensor, $valor);
		echo json_encode($status);
		$this->output->set_status_header($status);
	}
}
