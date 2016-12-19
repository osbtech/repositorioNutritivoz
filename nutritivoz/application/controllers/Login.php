<?php
//https://github.com/puneetkay/Facebook-PHP-CodeIgniter
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // To use site_url and redirect on this controller.
        $this->load->helper('url');
        $this->load->model('clientes_model');
    }

 public function loginAjax() {
        $usuario = $this->clientes_model->login_usuarios($this->input->post('correo'), $this->input->post('contrasena'));
        if ($usuario == null) {
            $ret['resultado'] = false;                
        } else {
            $data = array(
                'username' => $usuario['nombre'],
                'email' => $usuario['correo'],
                'idUsuario' => $usuario['idCliente'],
                'fbId' => $usuario['fbId']
            );
            $this->session->set_userdata($data);
            $ret['resultado'] = true;
        }
        echo json_encode($ret);
    }

    public function logout() {
        $this->session->unset_userdata(array('username', 'email', 'idUsuario','zona','log1','fbId'));
        $this->logoutFB();
        redirect('listado_productos/listado_productos');
    }

    public function logoutFB() {
        $this->load->library('facebook');
        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.
        redirect('listado_productos/listado_productos');
    }

public function cambiarContrasena(){
        $this->load->library('email');
        $cliente = $this->clientes_model->obtener_clienteByMail($this->input->post('correo'));
        if($cliente!=null){
            $hash= $this->clientes_model->agregar_cambio_contra($cliente['idCliente']);
            $datosEmail['usuario'] =$cliente['nombre'];
            $datosEmail['link'] = site_url('login/cambioClave').'?q='.$hash;
            $this->email_model->enviar_mail('mail_templates/recuperar_contrasena', $cliente['correo'], $datosEmail, 'Nutritívoz - Alimentación saludable para todos', 'Cambio de contraseña');
             $ret['resultado'] = true; 
        }else{
             $ret['resultado'] = false; 
        }        
        echo json_encode($ret);     
}

public function cambioClave($hash){
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');

        $this->form_validation->set_rules('contra1', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('contra2', 'Password Confirmation', 'trim|required|matches[contra1]');

        $data['hash'] = $hash;
        if ($this->form_validation->run() === FALSE) {
            $cambio =  $this->clientes_model->obtener_cambio_contra($hash);
            if($cambio!=null){
                $data['tokenValido'] =true;
            }else{
                $data['tokenValido'] =false;
            }  
            $this->load->view('includes/head');
            $this->load->view('includes/header');            
            $this->load->view('clientes/cambioContrasena', $data);
            $this->load->view('includes/footer');          
        }else{   
            $cambio= $this->clientes_model->obtener_cambio_contra($this->input->post('hash'));
            $cliente = $this->clientes_model->obtener_cliente($cambio['idCliente']);
            $this->clientes_model->actualizarPassword($cliente['correo'],$this->input->post('contra1'));
            $data['cambioExitoso'] = true;         
            $this->load->view('includes/head');
            $this->load->view('includes/header');            
            $this->load->view('clientes/cambioContrasena', $data);
            $this->load->view('includes/footer'); 
        }
}

}
