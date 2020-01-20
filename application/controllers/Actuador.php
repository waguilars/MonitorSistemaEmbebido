<?php
class Actuador extends CI_Controller
{

    public function __construct()
	{
		parent::__construct();
		$this->load->model(array('actuador_model'));
		$this->load->helper('url_helper');
    }
    public function index()
	{
        $actudores = $this->actuador_model->getActuadores();
        // echo json_encode($actuadores);
    }
    public function insertar($cal,$ven)
	{
		//$temperatura = $this->input->post('temp');
		//$humedad = $this->input->post('hum');
		$status = $this->actuador_model->insert($cal, $ven);
		
		$this->output->set_status_header($status);
	}
}