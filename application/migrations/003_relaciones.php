<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Migration_relaciones extends CI_Migration
{
	public function up(){
        $this->load->helper('db');
        $this->db->query(add_foreign_key('reg_actuador', 'id_actuador', 'actuadores(id)', 'CASCADE', 'CASCADE'));
        $this->db->query(add_foreign_key('reg_sensor', 'id_sensor', 'sensores(id)', 'CASCADE', 'CASCADE'));
    }
    
    public function down(){
        $this->load->helper('db');
        $this->db->query(drop_foreign_key('reg_actuador', 'id_actuador'));
        $this->db->query(drop_foreign_key('reg_sensor', 'id_sensor'));

    }
}
