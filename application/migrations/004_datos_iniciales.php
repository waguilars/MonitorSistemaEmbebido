<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_datos_iniciales extends CI_Migration
{
	public function up()
	{
		$data = array(
			array(
                'id' => 1,
				'nombre' => 'calefactor'
			),
			array(
                'id' => 2,
				'nombre' => 'ventilador'
			)
		);
		$this->db->insert_batch('actuadores', $data);
		$data = array(
			array(
                'id' => 1,
				'nombre' => 'temperatura'
			),
			array(
                'id' => 2,
				'nombre' => 'humedad'
			)
		);
		$this->db->insert_batch('sensores', $data);
	}

	public function down()
	{
        $this->db->empty_table('sensores');
        $this->db->empty_table('actuadores');
	}
}
