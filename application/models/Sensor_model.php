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
			$value = (float)$row->valor;
			$timestamp = strtotime($row->fecha);
			if ($row->id_sensor == 1) {
				array_push($data['temperatura'], array(
					$timestamp,
					$value
				));
			}
			if ($row->id_sensor == 2) {
				array_push($data['humedad'], array(
					$timestamp,
					$value
				));
			}
		}
		return $data;
	}

	public function getLast()
	{
		$this->db->select(array('valor', 'fecha', 'id_sensor'));
		$this->db->from('reg_sensor');
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit(1);
		$this->db->where('id_sensor', 1);
		$query = $this->db->get();
		$temp = $query->result();

		$this->db->select(array('valor', 'fecha', 'id_sensor'));
		$this->db->from('reg_sensor');
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit(1);
		$this->db->where('id_sensor', 2);
		$query = $this->db->get();
		$hum = $query->result();

		$data = array(
			'temperatura' => array(),
			'humedad' => array()
		);
		foreach ($temp as $prop) {
			$value = (float)$prop->valor;
			$timestamp = strtotime($prop->fecha);
			array_push($data['humedad'], $timestamp);
			array_push($data['humedad'], $value);
		}
		foreach ($hum as $prop) {
			$value = (float)$prop->valor;
			$timestamp = strtotime($prop->fecha);
			array_push($data['temperatura'], $timestamp);
			array_push($data['temperatura'], $value);
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
