<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->helper(array('template'));
    }

    public function index(){
        $js = array('url'=> base_url("assets/custom/js/custom.js"));
        $content = $this->load->view('admin/main-content','', TRUE);
        $template = getTemplate($content, 'Sistema de climatizacion','',$js);
        
        $this->load->view('dashboard', $template);
    }


}