<?php
class Sensor_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	public function getSensores()
	{
		$this->db->select(array('valor', 'fecha', 'id_sensor'));
		$this->db->from('reg_sensor');

		$query = $this->db->get();
		$data['temperatura'] = array();
		$data['humedad'] = array();
		foreach ($query->result() as $row) {
			if ($row->id_sensor == 1) {
				array_push($data['temperatura'], array(
					'valor' => $row->valor,
					'fecha' => $row->fecha
				));
			}
			if ($row->id_sensor == 2) {
				array_push($data['humedad'], array(
					'valor' => $row->valor,
					'fecha' => $row->fecha
				));
			}
		}
		return $data;
	}

	public function getData($sensor)
	{
		$query = $this->db->get_where('reg_sensor', array(
			'id_sensor' => $sensor
		));
		return $query->result();
	}

	public function getlastData($sensor)
	{
		$this->db->where('id_sensor', $sensor);
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('reg_sensor');
		return $query->result();
	}

	public function insert($temp_value, $hum_value)
	{
		$temp = array(
			'id_sensor' => 1,
			'valor' => $temp_value
		);
		$this->db->set('fecha', 'NOW()', false);
		$this->db->insert('reg_sensor', $temp);
		$hum = array(
			'id_sensor' => 2,
			'valor' => $hum_value
		);
		$this->db->set('fecha', 'NOW()', false);
		$this->db->insert('reg_sensor', $hum);
		return 200;
	}
}
