<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_create_tables extends CI_Migration
{
	public function up()
	{
		/* Creacion de la tabla de sensores */
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE,
			),
			'nombre' => array(
				'type' => 'VARCHAR',
				'constraint' => '25'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('sensores');
	
		/* Creacion de la tabla de Actuadores */
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 5,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'nombre' => array(
				'type' => 'VARCHAR',
				'constraint' => '25'
			)
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('actuadores');
	}

	public function down()
	{
		$this->dbforge->drop_table('sensores');
		$this->dbforge->drop_table('actuadores');
	}
}
