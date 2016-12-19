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
            $query = $this->db->get_where('nut_productos', array('activo' => '1'));
            return $query->result_array();
        }

        $query = $this->db->get_where('nut_productos', array('idProducto' => $idProducto));
        return $query->row_array();
    }

    public function get_marcas($idMarca = FALSE) {
        if ($idMarca === FALSE) {
            $query = $this->db->get('nut_marcas');
            return $query->result_array();
        }

        $query = $this->db->get_where('nut_marcas', array('idMarca' => $idMarca));
        return $query->row_array();
    }

    /* public function get_productosByCategoria() {
      $string = "SELECT nut_categorias.idCategoria,nut_categorias.nombre,nut_productos.idProducto,nut_productos.nombre,nut_productos.descripcion,nut_productos.unidad,nut_marcas.nombre " +
      " FROM nut_categorias " +
      " INNER JOIN nut_productos " +
      " ON nut_categorias.idCategoria=nut_productos.idCategoria " +
      " INNER JOIN nut_marcas " +
      " ON nut_productos.idMarca=nut_marcas.idMarca " +
      " WHERE nut_productos.activo = '1' AND nut_productos.stock > 1 " +
      " ORDER BY nut_categorias.orden,nut_productos.nombre";
      $query = $this->db->query($string);
      return $query->result_array();
      } */

    public function get_productosByCategoria($idZona) {
        $query = $this->db->query('SELECT categoria.*  FROM nut_categorias categoria, nut_productos producto, nut_zona_producto zonaProducto WHERE categoria.idCategoria= producto.idCategoria AND producto.idProducto = zonaProducto.idProducto 
        AND zonaProducto.idZona='. $idZona.' GROUP BY categoria.idCategoria');
        $categorias = $query->result_array();
        $resultado = array();
        foreach ($categorias as $categoria) {
            $query = $this->db->query("SELECT nut_productos.*,nut_marcas.nombre marca FROM nut_productos,nut_marcas,nut_zona_producto WHERE nut_productos.idMarca=nut_marcas.idMarca AND stock > 0 AND activo = 1 AND idCategoria = " . $categoria['idCategoria']." AND nut_productos.idProducto = nut_zona_producto.idProducto AND nut_zona_producto.idZona=". $idZona." ORDER BY nombre");
            $categoria['productos'][] = $query->result_array();
            $resultado[] = $categoria;
        }

        return $resultado;
    }

}
