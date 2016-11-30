<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Clientes_model
 *
 * @author Juan Pablo
 */
class Clientes_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function guardar_cliente($correo, $nombre, $celular, $fbId = '') {
        $data = array(
            'correo' => $correo,
            'nombre' => $nombre,
            'celular' => $celular,
            'fbId' => $fbId
        );
        $this->db->insert('NUT_CLIENTES', $data);
        return $this->db->insert_id();
    }

    public function actualizar_cliente($correo, $nombre, $celular, $fbId = '') {
        return $this->db->simple_query("UPDATE NUT_CLIENTES SET nombre='" . $nombre . "',celular='" . $celular . "', fbId='" . $fbId . "' WHERE correo='" . $correo . "'");
    }

    public function actualizarPassword($correo, $password) {
        return $this->db->simple_query("UPDATE NUT_CLIENTES SET password='" . $password . "' WHERE correo='" . $correo . "'");
    }

    public function obtener_cliente($idCliente = FALSE) {
        if ($idCliente === FALSE) {
            $query = $this->db->get('NUT_CLIENTES');
            return $query->result_array();
        }
        $query = $this->db->get_where('NUT_CLIENTES', array('idCliente' => $idCliente));
        return $query->row_array();
    }

    public function obtener_clienteByMail($email) {
        $query = $this->db->get_where('NUT_CLIENTES', array('correo' => $email));
        return $query->row_array();
    }

}
