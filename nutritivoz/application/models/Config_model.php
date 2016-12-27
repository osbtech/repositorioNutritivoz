<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config_model
 *
 * @author Pablo Flores
 */
class Config_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function getFechas() {
        $query = $this->db->get('nut_config');
        return $query->result_array()[0];
    }    
    
    public function setProxEntrega($fecha)  {
        $this->db->simple_query("UPDATE nut_config SET FechaProxEntrega='".$fecha."' WHERE idConfig='1'");
    }

    public function setCierrePedidos($fecha)  {
        $this->db->simple_query("UPDATE nut_config SET FechaCierrePedidos='".$fecha."' WHERE idConfig='1'");
    }
    
}
