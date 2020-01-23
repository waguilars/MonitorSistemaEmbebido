<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Actuadores extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('template'));
    }

    public function index(){
        $content = $this->load->view('admin/actuadores','', TRUE);
        $js = array('url'=> base_url('assets/custom/js/actuadores.js'));
        $template = getTemplate($content, 'Sistema de climatizacion', '', $js);
        $this->load->view('dashboard', $template);
    }

}
