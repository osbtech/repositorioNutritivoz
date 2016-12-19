<?php

/**
 * Description of Zona_model
 *
 * @author Ignacio
 */
class Zona_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_localidadesByZona($idZona) {
        if ($idZona > 0) {
            $query = $this->db->get_where('nut_localidad', array('idZona' => $idZona));
            return $query->result_array();
        }
    }

    public function get_Zona($idZona) {
        if ($idZona > 0) {
            $query = $this->db->get_where('nut_zona', array('idZona' => $idZona));
            return $query->row_array();
        }
    }

    public function get_localidades($idLocalidad = false) {
        if ($idLocalidad === FALSE) {
            $query = $this->db->get('nut_localidad');
            return $query->result_array();
        }
        $query = $this->db->get_where('nut_localidad', array('idLocalidad' => $idLocalidad));
        return $query->row_array();
    }

}
