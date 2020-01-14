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
		foreach ($query->result() as $row) {
			echo $row->nombre;
		}
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
