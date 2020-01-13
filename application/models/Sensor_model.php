<?php
class Sensor_model extends CI_Model {

 function __construct()
        {
                $this->load->database();
                
        }
     
        public function realiza_con()
        {
             
                $query = $this->db->get('sensores');
            
                foreach ($query->result() as $row){
                    echo $row->nombre;
                    }

        }

        public function insert($id,$value){
                $data= array(
                        
                        'id_sensor'=>$id 
                        ,
                        'estado'=>$value
                );

                $this->db->insert('reg_sensor',$data);
        }
    }