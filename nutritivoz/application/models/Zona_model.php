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
            $query = $this->db->get_where('NUT_LOCALIDAD', array('idZona' => $idZona));
            return $query->row_array();
        }
    }

    
       public function get_Zona($idZona) {
        if ($idZona > 0) {
            $query = $this->db->get_where('NUT_ZONA', array('idZona' => $idZona));
            return $query->row_array();
        }
    }
    
}
