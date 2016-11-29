<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Zona
 *
 * @author Ignacio
 */
class Zona extends CI_Controller {

    //put your code here
    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
    }

    public function zonas() {
        $this->load->view('includes/head');
        $this->load->view('includes/header');
        $this->load->view('productos/seleccionarZona');
        $this->load->view('includes/footer');
    }

    public function seleccionar_zona() {
        if ($this->input->post('idZona') > 0) {
            $this->cart->destroy();
            // redirect('/listado_productos/listado_productos');
        }
    }

}
