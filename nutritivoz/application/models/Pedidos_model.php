<?php

/**
 * Description of Pedidos_model
 *
 * @author Juan Pablo
 */
class Pedidos_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function confirmar_pedido($hash) {
        return $this->db->simple_query("UPDATE nut_pedidos SET estado='CONFIRMADO' WHERE hash='" . $hash . "'");
    }

    /**
     * 
     * @param type $idCliente
     * @param type $zona
     * @param type $direccion
     * @param type $aclaracionDir
     * @param type $horario
     * @param type $notaCliente
     * @param type $zona
     */
    public function guardar_pedido($idCliente, $direccion, $aclaracionDir, $horario, $notaCliente, $subtotal, $costoEnvio, $total, $hash, $esquina1, $esquina2, $idZona, $idLocalidad) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'fecha_realizacion' => $date,
            'idCliente' => $idCliente,
            'direccion' => $direccion,
            'direccion_aclaracion' => $aclaracionDir,
            'horario' => $horario,
            'nota_cliente' => $notaCliente,
            'subtotal' => $subtotal,
            'costo_envio' => $costoEnvio,
            'total' => $total,
            'hash' => $hash,
            'esquina1' => $esquina1,
            'esquina2' => $esquina2,
            'idZona' => $idZona,
            'idLocalidad' => $idLocalidad
        );
        $this->db->insert('nut_pedidos', $data);
        return $this->db->insert_id();
    }

    public function actualizar_pedido($idPedido, $direccion, $aclaracionDir, $horario, $notaCliente, $subtotal, $costoEnvio, $total, $esquina1, $esquina2) {
        $this->db->simple_query("UPDATE nut_pedidos SET ', direccion='" . $direccion . "', direccion_aclaracion='" . $aclaracionDir . "', horario='" . $horario . "', nota_cliente='" . $notaCliente . "',subtotal='" . $subtotal . "', costo_envio='" . $costoEnvio . "', total='" . $total . "', esquina1='" . $esquina1 . "',esquina2='" . $esquina2 . "' WHERE idPedido='" . $idPedido . "'");
    }

    public function guardarDetallePedido($idPedido, $idProducto, $cantidad, $precio, $cantidad_entregada = 0, $cantidad_proveedor = 0) {
        $data = array(
            'idPedido' => $idPedido,
            'idProducto' => $idProducto,
            'cantidad' => $cantidad,
            'precio' => $precio,
            'cantidad_entregada' => $cantidad_entregada,
            'cantidad_proveedor' => $cantidad_proveedor
        );
        $this->db->insert('nut_pedidos_detalle', $data);
    }

    public function borrar_pedido_detalles($idPedido) {
        $this->db->simple_query("DELETE FROM nut_pedidos_detalle WHERE idPedido=" . $idPedido);
    }

    public function actualizarCantidadEntregada($idPedidoDetalle, $cantidad_entregada) {

        return $this->db->simple_query("UPDATE nut_pedidos_detalle SET cantidad_entregada='" . $cantidad_entregada . "' WHERE idPedidoDetalle='" . $idPedidoDetalle . "'");
    }

    public function actualizarTotalesPedido($idPedido, $subTot, $costo_envio, $tot) {

        return $this->db->simple_query("UPDATE nut_pedidos SET subtotal='" . $subTot . "', costo_envio='" . $costo_envio . "', total='" . $tot . "' WHERE idPedido='" . $idPedido . "'");
    }

    /*
      private function sqlPedidos() {
      return 'SELECT idPedido,c.idCliente, c.correo,c.nombre,c.celular,p.direccion_aclaracion aclaracion,p.nota_cliente nota,p.idPedido,p.fecha_realizacion,p.zona,p.direccion,p.subtotal,p.costo_envio,p.total,p.esquina1,p.esquina2,p.estado FROM nut_pedidos p,nut_clientes c WHERE p.idCliente=c.idCliente ';
      }
     */

    const SQL_PEDIDOS = 'SELECT idPedido,c.idCliente, c.correo,c.nombre,c.celular,p.direccion_aclaracion aclaracion,p.nota_cliente nota,p.idPedido,p.fecha_realizacion,p.direccion,p.subtotal,p.costo_envio,p.total,p.esquina1,p.esquina2,p.estado, z.nombre zona, p.nombre localidad FROM nut_pedidos p,nut_clientes c, nut_zona z , nut_localidad  l WHERE p.idCliente=c.idCliente  AND p.idZona= z.IdZona  AND p.idLocalidad= l.idLocalidad';

    public function getPedidos($idPedido = false) {
        if ($idPedido) {
            $query = $this->db->query(self::SQL_PEDIDOS . " AND idPedido='" . $idPedido . "'");
            return $query->row_array();
        } else {
            $query = $this->db->query(self::SQL_PEDIDOS);
            return $query->result_array();
        }
    }

    public function getPedidosEstado($estado) {
        $sql = self::SQL_PEDIDOS . " AND p.estado = '" . $estado . "'";
        $query = $this->db->query($sql);
        return $query->result_array();
    }

    public function getDetallePedidos($idPedido) {
        $str = 'SELECT pd.idPedidoDetalle,pd.idProducto,pd.cantidad,pd.cantidad_entregada,pd.cantidad_proveedor,pd.precio,p.nombre,p.unidad,m.nombre marca FROM nut_pedidos_detalle pd,nut_productos p,nut_marcas m ';
        $str .= 'WHERE idPedido =' . $idPedido . ' AND pd.idProducto = p.idProducto AND m.idMarca=p.idMarca ORDER BY p.nombre';
        $query = $this->db->query($str);
        return $query->result_array();
    }

    public function getDetallesPorProveedorCanasta($idProveedor = false) {
        $str = 'SELECT pd.idPedido,pd.cantidad,pd.precio,p.nombre,p.unidad,m.nombre marca,pv.nombre proveedor,pv.idProveedor FROM nut_pedidos_detalle pd,nut_productos p,nut_marcas m, nut_proveedores pv, nut_pedidos ped ';
        $str .= 'WHERE pd.idProducto = p.idProducto AND m.idMarca=p.idMarca AND m.idProveedor=pv.idProveedor AND pv.idProveedor=' . $idProveedor . " AND ped.idPedido = pd.idPedido AND ped.estado = 'CONFIRMADO'";
        $str .= ' ORDER BY idProveedor, idPedido';
        $query = $this->db->query($str);
        return $query->result_array();
    }

    public function getDetallesPorProveedor($idProveedor = false) {
        $str = 'SELECT p.idProducto,p.costo,p.nombre,p.unidad,m.nombre marca,pv.nombre proveedor,pv.idProveedor,SUM(pd.cantidad_proveedor) cantidadTotal,SUM(pd.cantidad_proveedor)*p.costo precio  FROM nut_pedidos_detalle pd,nut_productos p,nut_marcas m, nut_proveedores pv, nut_pedidos ped ';
        $str .= 'WHERE pd.idProducto = p.idProducto AND m.idMarca=p.idMarca AND m.idProveedor=pv.idProveedor AND pv.idProveedor=' . $idProveedor . " AND ped.idPedido = pd.idPedido AND ped.estado = 'CONFIRMADO'";
        $str .= ' GROUP BY p.idProducto';
        $str2 = 'SELECT * FROM (' . $str . ') AS result WHERE cantidadTotal > 0 ';
        $query = $this->db->query($str2);
        return $query->result_array();
    }
	
	
	 public function getItemsPedidos($idProveedor = false) {
        $str = 'SELECT p.idProducto,p.nombre,p.unidad,m.nombre marca,pd.cantidad_proveedor cantidad, ped.idPedido '.
				'FROM NUT_PEDIDOS_DETALLE pd,NUT_PRODUCTOS p,NUT_MARCAS m, NUT_PROVEEDORES pv, NUT_PEDIDOS ped '.
				'WHERE pd.idProducto = p.idProducto AND m.idMarca=p.idMarca AND m.idProveedor=pv.idProveedor AND ped.idPedido = pd.idPedido AND '.
				'pv.idProveedor=' . $idProveedor . " AND ped.estado = 'CONFIRMADO' ".
				'ORDER BY ped.idPedido, p.nombre';
        $query = $this->db->query($str);
        return $query->result_array();
    }
	

    public function getPedidosCompleto($idPedido = FALSE) {
        if ($idPedido === FALSE) {
            $query = $this->db->get('nut_pedidos');
            return $query->result_array();
        }
        $query = $this->db->get_where('nut_pedidos', array('idPedido' => $idPedido));
        return $query->row_array();
    }

    public function getPedidosDetalleCompleto($idPedido = FALSE) {
        if ($idPedido === FALSE) {
            $query = $this->db->get('nut_pedidos_detalle');
            return $query->result_array();
        }
        $query = $this->db->get_where('nut_pedidos_detalle', array('idPedido' => $idPedido));
        return $query->row_array();
    }

    public function actualizar_pedidoAdm($idPedido, $idcliente, $fechaRealizacion, $fechaEntregaEstimada, $fechaEntrega, $direccion, $aclaracionDir, $notaCliente, $subtotal, $costoEnvio, $total, $esquina1, $esquina2, $estado, $notaPostVenta) {
        $this->db->simple_query("UPDATE NUT_PEDIDOS SET idCliente='" . $idcliente . "', estado='" . $estado . "', fecha_realizacion='" . $fechaRealizacion . "', fecha_entrega_estimada='" . $fechaEntregaEstimada . "', fecha_entrega='" . $fechaEntrega . "', nota_postventa = '" . $notaPostVenta . "', direccion='" . $direccion . "', direccion_aclaracion='" . $aclaracionDir . "', nota_cliente='" . $notaCliente . "',subtotal='" . $subtotal . "', costo_envio='" . $costoEnvio . "', total='" . $total . "', esquina1='" . $esquina1 . "',esquina2='" . $esquina2 . "' WHERE idPedido='" . $idPedido . "'");
    }

    public function quitarProductoPedidos($idProducto) {
        $query = $this->db->query("SELECT d.idPedidoDetalle,d.idPedido  FROM nut_pedidos p,nut_pedidos_detalle d WHERE d.idProducto = '" . $idProducto . "' AND p.idPedido=d.idPedido AND p.estado='INICIADO'");
        $res = $query->result_array();
        foreach ($res as $r) {
            $this->db->simple_query("UPDATE nut_pedidos_detalle SET cantidad_entregada='0',cantidad_proveedor='0' WHERE idPedidoDetalle='" . $r['idPedidoDetalle'] . "' ");
        }
        return $res;
    }

}
