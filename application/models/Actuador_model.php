<?php
class Actuador_model extends CI_Model
{
	function __construct()
	{
		$this->load->database();
	}
	
	public function getActuadores()
	{
		$this->db->select(array('estado', 'fecha', 'id_actuador'));
		$this->db->from('reg_actuador');

		$query = $this->db->get();
		$data['calefactor'] = array();
		$data['ventilador'] = array();
		foreach ($query->result() as $row) {
			if ($row->id_actuador == 1) {
				array_push($data['calefactor'], array(
					'estado' => $row->estado,
					'fecha' => $row->fecha
				));
			}
			if ($row->id_actuador == 2) {
				array_push($data['ventilador'], array(
					'estado' => $row->estado,
					'fecha' => $row->fecha
				));
			}
		}
		foreach ($query-result() as  $row) {
			echo $row->estado;
		}
		return $data;
	}

	public function getLast(){
		$this->db->select(array('estado', 'fecha', 'id_actuador'));
		$this->db->from('reg_actuador');
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get();
		return $query->result();
	}

	public function getData($sactuador)
	{
		$query = $this->db->get_where('reg_actuador', array(
			'id_actuador' => $sactuador
		));
		return $query->result();
	}

	public function getlastData($sactuador)
	{
		$this->db->where('id_actuador', $sactuador);
		$this->db->order_by('fecha', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('reg_actuador');
		return $query->result();
	}
	
	public function insert($vent_est, $cale_est)
	{
		$vent = array(
			'id_actuador' => 1,
			'estado' => $vent_est
		);
		$this->db->set('fecha', 'NOW()', false);
		$this->db->insert('reg_actuador', $vent);
		$cale = array(
			'id_actuador' => 2,
			'estado' => $cale_est
		);
		$this->db->set('fecha', 'NOW()', false);
		$this->db->insert('reg_actuador', $cale);
		return 200;
	}



} 