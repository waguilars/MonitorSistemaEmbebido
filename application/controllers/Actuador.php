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
        $actudor = $this->actuador_model->getActuadores();
         foreach ($actudor as $row ) {
			 echo json_encode($row);
		 }
    }
    public function insertar()
	{
		$cal = $this->input->post('cal');
		$ven = $this->input->post('ven');
		

if ($cal!==NULL) {
	$status = $this->actuador_model->insertacal($cal);
	$this->output->set_status_header($status);
}else{
echo "ERROR  404";
}

if ($ven!==NULL) {
	$status = $this->actuador_model->insertaven($ven);
	$this->output->set_status_header($status);
}else{
	echo "ERROR 404";
}

		
		
	}

	public function getLast(){
		$lastData = $this->actuador_model->getLast();
		echo json_encode($lastData);
	}
	public function getAllData($actuador){
		$data = $this->actuador_model->getData($actuador);
		echo json_encode($data);
	}

	public function getLastData($actuador){
		$data = $this->actuador_model->getlastData($actuador);
		echo json_encode($data);
	}


}