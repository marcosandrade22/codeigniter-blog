<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagina extends CI_Controller {
    
    function __construct(){
        parent::__construct();
        $this->load->model('M_paginas');
        $this->load->helper('text');
        $this->load->helper('cookie');
        $this->load->model('M_select');
    }
    
    
    public function detalhe($id){
        
        $data['title'] = "Página - Blog curso";
         
        $data['pagina'] = $this->M_paginas->getpaginas_url($id);
        $this->load->view('site/headers/v_header.php', $data);
        $this->load->view('site/headers/v_menu.php', $data);
       
        $this->load->view('site/pagina/v_pagina.php', $data);
       
        $this->load->view('site/headers/v_footer.php');
    }
    
    
    
    
}