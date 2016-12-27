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

    public function guardar_cliente($correo, $nombre, $celular, $fbId, $idZona, $idLocalidad, $direccion, $dirAclaracion, $esquina1, $esquina2,$pass) {
        $data = array(
            'correo' => $correo,
            'nombre' => $nombre,
            'celular' => $celular,
            'fbId' => $fbId,
            'idZona' => $idZona,
            'idLocalidad' => $idLocalidad,
            'direccion' => $direccion,
            'direccion_aclaracion' => $dirAclaracion,
            'esquina1' => $esquina1,
            'esquina2' => $esquina2,
            'password' => $pass
        );
        $this->db->insert('nut_clientes', $data);
        return $this->db->insert_id();
    }

    public function actualizar_cliente($correo, $nombre, $celular, $fbId, $idZona, $idLocalidad, $direccion, $dirAclaracion, $esquina1, $esquina2) {
        return $this->db->simple_query("UPDATE nut_clientes SET nombre='" . $nombre . "',celular='" . $celular . "', fbId='" . $fbId . "', idZona='" . $idZona . "', idLocalidad='" . $idLocalidad . "',direccion='" . $direccion . "', direccion_aclaracion='" . $dirAclaracion . "', esquina1 ='" . $esquina1 . "',esquina2='" . $esquina2 . "'  WHERE correo='" . $correo . "'");
    }

    public function actualizarPassword($correo, $password) {
        return $this->db->simple_query("UPDATE nut_clientes SET password='" . $password . "' WHERE correo='" . $correo . "'");
    }

    public function obtener_cliente($idCliente = FALSE) {
        if ($idCliente === FALSE) {
            $query = $this->db->get('nut_clientes');
            return $query->result_array();
        }
        $query = $this->db->get_where('nut_clientes', array('idCliente' => $idCliente));
        return $query->row_array();
    }

    public function obtener_clienteByMail($email) {
        $query = $this->db->get_where('nut_clientes', array('correo' => $email));
        return $query->row_array();
    }

    public function login_usuarios($correo, $password) {
        $query = $this->db->get_where('nut_clientes', array('correo' => $correo, 'password' => $password));
        return $query->row_array();
    }

    public function agregar_cambio_contra($idCliente){
       $hash =  md5($idCliente+rand());
       $data=array(
       'idCliente' => $idCliente,
       'token'=>$hash,
       'vence'=>date('Y-m-d H:i:s',time())
       );
       $this->db->insert('nut_cambios_contrasena', $data);
       return $hash;
    }
//TODO:VALIDAR FECHA!
    public function obtener_cambio_contra($hash) {
        $query = $this->db->get_where('nut_cambios_contrasena', array('token' => $hash));
        return $query->row_array();
    }
}
