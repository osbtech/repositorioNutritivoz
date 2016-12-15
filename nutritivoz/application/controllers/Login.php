<?php
//https://github.com/puneetkay/Facebook-PHP-CodeIgniter
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // To use site_url and redirect on this controller.
        $this->load->helper('url');
    }

    public function login() {

        $this->load->library('facebook'); // Automatically picks appId and secret from config
        // OR
        // You can pass different one like this
        //$this->load->library('facebook', array(
        //    'appId' => 'APP_ID',
        //    'secret' => 'SECRET',
        //    ));

        $user = $this->facebook->getUser();

        if ($user) {
            try {
                $data['user_profile'] = $this->facebook->api('/me?fields=name,email');
                echo '<pre>';
                print_r($data['user_profile']);
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            // Solves first time login issue. (Issue: #10)
            //$this->facebook->destroySession();
        }

        if ($user) {

            $data['logout_url'] = site_url('welcome/logout'); // Logs off application
            // OR 
            // Logs off FB!
            // $data['logout_url'] = $this->facebook->getLogoutUrl();
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('welcome/login'),
                'scope' => array('email') // permissions here
            ));
        }
        $this->load->view('login', $data);
    }

    public function logout() {

        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('welcome/login');
    }



public function loginFacebook()
{
 /* login con facebook */
        $this->load->library('facebook'); // Automatically picks appId and secret from config
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                //$data['user_profile'] = $this->facebook->api('/me?fields=name,email');
                $us = $this->facebook->api('/me?fields=name,email');
                $cliente = $this->clientes_model->obtener_clienteByMail($us['email']);
                if ($cliente == null) {
                    $idCliente = $this->clientes_model->guardar_cliente($us['email'], $us['name'], '', $us['id'], '0', '0', '', '', '', '', '');
                    $data = array(
                        'username' => $us['name'],
                        'email' => $us['email'],
                        'idUsuario' => $idCliente,
                        'fbId' => $us['id']
                    );
                    $this->session->set_userdata($data);
                    //  redirect('listado_productos/listado_productos');
                } else {
                    $this->clientes_model->actualizar_cliente($us['email'], $us['name'], $cliente['celular'], $us['id'], $cliente['idZona'], $cliente['idLocalidad'], $cliente['direccion'], $cliente['direccion_aclaracion'], $cliente['esquina1'], $cliente['esquina2']);
                    $data = array(
                        'username' => $cliente['nombre'],
                        'email' => $cliente['correo'],
                        'idUsuario' => $cliente['idCliente'],
                        'fbId' => $cliente['fbId']
                    );
                    $this->session->set_userdata($data);
                    //  redirect('listado_productos/listado_productos');
                }
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            
        }
        if ($user) {
            $data['logout_url'] = site_url('listado_productos/logoutFB'); // Logs off application
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('listado_productos/listado_productos'),
                'scope' => array('email') // permissions here
            ));
        }
        /* fin login con facebook */
}


}
