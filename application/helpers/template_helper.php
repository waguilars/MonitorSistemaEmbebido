<?php

function getTemplate($view, $title, $css='', $scripts=''){
    $CI =get_instance();

    $template = array(
        'title' => $title,
        'content' => $view,
        'header' => $CI->load->view('layouts/links',$css, TRUE),
        'scripts' => $CI->load->view('layouts/scripts',$scripts, TRUE),
        'footer' => $CI->load->view('layouts/footer','', TRUE),
        'aside' => $CI->load->view('layouts/aside','', TRUE),
        'topnav' => $CI->load->view('layouts/top-nav','', TRUE),
    );
    
    return $template;
}