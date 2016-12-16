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



}
