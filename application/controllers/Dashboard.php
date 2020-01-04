<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct(){
        parent::__construct();
    
    }

    public function index(){
        $content = $this->load->view('admin/main-content','', TRUE);
        $this->showView($content, 'Dashboard');
    }

    public function showView($view, $title){
        $data = array(
            'title' => $title,
            'content' => $view,
            'header' => $this->load->view('layouts/links','', TRUE),
            'scripts' => $this->load->view('layouts/scripts','', TRUE),
            'footer' => $this->load->view('layouts/footer','', TRUE),
            'aside' => $this->load->view('layouts/aside','', TRUE),
            'topnav' => $this->load->view('layouts/top-nav','', TRUE),
        );
        
        $this->load->view('dashboard', $data);
    }
}