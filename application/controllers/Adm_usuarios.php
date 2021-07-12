<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Adm_usuarios extends MY_Controller {
    
    function __construct(){
      parent::__construct();
      $this->load->model('M_usuarios');
       
    }
    
    public function index(){
        $data['title'] = "Usuários - Blog Curso";
        $data['pagina'] = "Usuários";
        
        $data['usuarios'] = $this->M_usuarios->getusuarios()->result();
        $data['usuarios_num'] = $this->M_usuarios->getusuarios()->num_rows();
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/usuarios/v_usuarios', $data);
        $this->load->view('admin/headers/v_footer');
        
        
    }
    
    public function novo_usuario(){
        $data['title'] = "Usuários - Blog Curso";
        $data['pagina'] = "Novo Usuário";
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/usuarios/v_add_usuarios', $data);
        $this->load->view('admin/headers/v_footer');
    }
    
    public function edit($id){
        $data['title'] = "Usuários - Blog Curso";
        $data['pagina'] = "Edição de Usuário";
        
        $result = $this->M_usuarios->getusuarios_id($id);
        
        $data['id'] = $id;
        $data['nome'] = $result->row()->nome;
        $data['email'] = $result->row()->email_usuario;
        $data['status'] = $result->row()->status;
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/usuarios/v_add_usuarios', $data);
        $this->load->view('admin/headers/v_footer');
    }
    
     
    public function edit_senha($id){
        $data['title'] = "Usuários - Blog Curso";
        $data['pagina'] = "Edição de Senha";
        
        //$result = $this->M_usuarios->getusuarios_id($id);
        
        $data['id'] = $id;
        
        
        $this->load->view('admin/headers/v_header', $data);
        $this->load->view('admin/dashboard/v_menu_dashboard', $data);
        
        $this->load->view('admin/usuarios/v_add_senha', $data);
        $this->load->view('admin/headers/v_footer');
    }
    
    
    public function store(){
        $id = $this->input->post('id');
        $usuario = $this->input->post('nome');
        $email = $this->input->post('email');
        $status = $this->input->post('status');
        
        $dados = array(
           'nome' => $usuario,
           'email_usuario' => $email,
           'status' => $status,
        );
        
        if($this->M_usuarios->store($dados, $id)){
         echo '<script>alert("Salvo com sucesso!"), history.go(-2);</script>'  ; 
        }
        else{
            echo '<script>alert("Erro ao salvar"), history.go(-1);</script>'  ;  
        }
                
    }
    
    public function store_senha(){
        $id = $this->input->post('id');
        $senha = sha1($this->input->post('password'));
        
        $dados = array(
           'senha_usuario' => $senha,
        );
        
        if($this->M_usuarios->store($dados, $id)){
         echo '<script>alert("Salvo com sucesso!"), history.go(-2);</script>'  ; 
        }
        else{
            echo '<script>alert("Erro ao salvar"), history.go(-1);</script>'  ;  
        }
                
    }
    
    
    
    public function ajax_delete($id)
    {
      
       if($this->M_usuarios->delete_by_id($id) == "Success"){
        echo json_encode(array("status" => TRUE)); 
       }else{
        echo json_encode(array("status" => FALSE));
       }
       
    }
    
    
    
}