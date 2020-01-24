<?php
class Sensor_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}

	public function getSensores()
	{
		$this->db->select(array('id','valor', 'fecha', 'id_sensor'));
		$this->db->from('reg_sensor');

		$query = $this->db->get();
		
		return $query->result();
	}

	public function getlimitData($limit){
		$sql =  "SELECT * FROM ( SELECT * FROM reg_sensor WHERE id_sensor = 1 ORDER BY id DESC LIMIT $limit ) sub ORDER BY id ASC";
		$temp = $this->db->query($sql);
		$res = $temp->result();

		$sql =  "SELECT * FROM ( SELECT * FROM reg_sensor WHERE id_sensor = 2 ORDER BY id DESC LIMIT $limit ) sub ORDER BY id ASC";
		$hum = $this->db->query($sql);
		$res2 = $hum->result();
		
	
		return array(
			'tem' => $res,
			'hum' => $res2
		) ;
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
			$timestamp = $prop->fecha;
			array_push($data['temperatura'], $timestamp);
			array_push($data['temperatura'], $value);
		}
		foreach ($hum as $prop) {
			$value = (float)$prop->valor;
			$timestamp = $prop->fecha;
			array_push($data['humedad'], $timestamp);
			array_push($data['humedad'], $value);
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

	public function getlastData($sensor, $lim)
	{
		$this->db->where('id_sensor', $sensor);
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit($lim);
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
