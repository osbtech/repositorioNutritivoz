<?php

/**
 * Description of Productos_model
 *
 * @author Juan Pablo
 */
class Productos_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function get_productos($idProducto = FALSE) {
        if ($idProducto === FALSE) {
            $query = $this->db->get_where('NUT_PRODUCTOS', array('activo' => '1'));
            return $query->result_array();
        }

        $query = $this->db->get_where('NUT_PRODUCTOS', array('idProducto' => $idProducto));
        return $query->row_array();
    }

    public function get_marcas($idMarca = FALSE) {
        if ($idMarca === FALSE) {
            $query = $this->db->get('NUT_MARCAS');
            return $query->result_array();
        }

        $query = $this->db->get_where('NUT_MARCAS', array('idMarca' => $idMarca));
        return $query->row_array();
    }

    /* public function get_productosByCategoria() {
      $string = "SELECT NUT_CATEGORIAS.idCategoria,NUT_CATEGORIAS.nombre,NUT_PRODUCTOS.idProducto,NUT_PRODUCTOS.nombre,NUT_PRODUCTOS.descripcion,NUT_PRODUCTOS.unidad,NUT_MARCAS.nombre " +
      " FROM NUT_CATEGORIAS " +
      " INNER JOIN NUT_PRODUCTOS " +
      " ON NUT_CATEGORIAS.idCategoria=NUT_PRODUCTOS.idCategoria " +
      " INNER JOIN NUT_MARCAS " +
      " ON NUT_PRODUCTOS.idMarca=NUT_MARCAS.idMarca " +
      " WHERE NUT_PRODUCTOS.activo = '1' AND NUT_PRODUCTOS.stock > 1 " +
      " ORDER BY NUT_CATEGORIAS.orden,NUT_PRODUCTOS.nombre";
      $query = $this->db->query($string);
      return $query->result_array();
      } */

    public function get_productosByCategoria($idZona) {
        $query = $this->db->get('NUT_CATEGORIAS');
        $categorias = $query->result_array();
        $resultado = array();
        foreach ($categorias as $categoria) {
            $query = $this->db->query("SELECT NUT_PRODUCTOS.*,NUT_MARCAS.nombre marca FROM NUT_PRODUCTOS,NUT_MARCAS,NUT_ZONA_PRODUCTO WHERE NUT_PRODUCTOS.idMarca=NUT_MARCAS.idMarca AND stock > 0 AND activo = 1 AND idCategoria = " . $categoria['idCategoria']." AND NUT_PRODUCTOS.idProducto = NUT_ZONA_PRODUCTO.idProducto AND NUT_ZONA_PRODUCTO.idZona=". $idZona." ORDER BY nombre");
            $categoria['productos'][] = $query->result_array();
            $resultado[] = $categoria;
        }
        echo '<pre>';
        print_r($resultado);
        exit();
        return $resultado;
    }

}
