<?php
class Sensor extends CI_Controller {
    public function __construct()
    {
            parent::__construct();
            $this->load->model(array('sensor_model'));
            $this->load->helper('url_helper');
    }
    
    public function index()
        {
            

           
           $this->sensor_model->realiza_con();


        }

        public function insertar($sensor,$valor){
                $this->sensor_model->insert($sensor,$valor);

        }



}