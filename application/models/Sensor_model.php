<?php
class Sensor_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	public function getSensores()
	{
		$query = $this->db->get('sensores');
		return $query->result();
	}

	public function getData($sensor){
		
		$query = $this->db->get_where('reg_sensor', array('id_sensor'=>$sensor));
		return $query->result();

	}

	public function getlastData($sensor){
		$this->db->where('id_sensor', $sensor);
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('reg_sensor');
		return $query->result();

	}

	public function insert($sensor, $value)
	{
		if ($sensor == 1 || $sensor == 2) {
			
			$data = array(
				'id_sensor' => $sensor,
				'valor' => $value,
			);
			$this->db->set('fecha', 'NOW()', FALSE);
			$this->db->insert('reg_sensor', $data);
			return 200;	
		} else {
			return 400;
		}
	}
}
