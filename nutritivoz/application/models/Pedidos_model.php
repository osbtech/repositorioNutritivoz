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
        return $this->db->simple_query("UPDATE NUT_PEDIDOS SET estado='CONFIRMADO' WHERE hash='" . $hash . "'");
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
    public function guardar_pedido($idCliente, $zona, $direccion, $aclaracionDir, $horario, $notaCliente, $subtotal, $costoEnvio, $total, $hash, $esquina1, $esquina2) {
        $date = date('Y-m-d H:i:s');
        $data = array(
            'fecha_realizacion' => $date,
            'idCliente' => $idCliente,
            'zona' => $zona,
            'direccion' => $direccion,
            'direccion_aclaracion' => $aclaracionDir,
            'horario' => $horario,
            'nota_cliente' => $notaCliente,
            'subtotal' => $subtotal,
            'costo_envio' => $costoEnvio,
            'total' => $total,
            'hash' => $hash,
            'esquina1' => $esquina1,
            'esquina2' => $esquina2
        );
        $this->db->insert('NUT_PEDIDOS', $data);
        return $this->db->insert_id();
    }

    public function actualizar_pedido($idPedido, $zona, $direccion, $aclaracionDir, $horario, $notaCliente, $subtotal, $costoEnvio, $total, $esquina1, $esquina2) {
        $this->db->simple_query("UPDATE NUT_PEDIDOS SET  zona ='" . $zona . "', direccion='" . $direccion . "', direccion_aclaracion='" . $aclaracionDir . "', horario='" . $horario . "', nota_cliente='" . $notaCliente . "',subtotal='" . $subtotal . "', costo_envio='" . $costoEnvio . "', total='" . $total . "', esquina1='" . $esquina1 . "',esquina2='" . $esquina2 . "' WHERE idPedido='" . $idPedido . "'");
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
        $this->db->insert('NUT_PEDIDOS_DETALLE', $data);
    }

    public function borrar_pedido_detalles($idPedido) {
        $this->db->simple_query("DELETE FROM NUT_PEDIDOS_DETALLE WHERE idPedido=" . $idPedido);
    }

    public function actualizarCantidadEntregada($idPedidoDetalle, $cantidad_entregada) {

        return $this->db->simple_query("UPDATE NUT_PEDIDOS_DETALLE SET cantidad_entregada='" . $cantidad_entregada . "' WHERE idPedidoDetalle='" . $idPedidoDetalle . "'");
    }

    public function actualizarTotalesPedido($idPedido, $subTot, $costo_envio, $tot) {

        return $this->db->simple_query("UPDATE NUT_PEDIDOS SET subtotal='" . $subTot . "', costo_envio='" . $costo_envio . "', total='" . $tot . "' WHERE idPedido='" . $idPedido . "'");
    }

    public function getPedidos($idPedido = false) {
        $sql = 'SELECT idPedido,c.idCliente, c.correo,c.nombre,c.celular,p.direccion_aclaracion aclaracion,p.nota_cliente nota,p.idPedido,p.fecha_realizacion,p.zona,p.direccion,p.subtotal,p.costo_envio,p.total,p.esquina1,p.esquina2,p.estado FROM NUT_PEDIDOS p,NUT_CLIENTES c WHERE p.idCliente=c.idCliente ';
        if ($idPedido) {
            $query = $this->db->query($sql . " AND idPedido='" . $idPedido . "'");
            return $query->row_array();
        } else {
            $query = $this->db->query($sql);
            return $query->result_array();
        }
    }

    public function getDetallePedidos($idPedido) {
        $str = 'SELECT pd.idPedidoDetalle,pd.idProducto,pd.cantidad,pd.cantidad_entregada,pd.cantidad_proveedor,pd.precio,p.nombre,p.unidad,m.nombre marca FROM NUT_PEDIDOS_DETALLE pd,NUT_PRODUCTOS p,NUT_MARCAS m ';
        $str.='WHERE idPedido =' . $idPedido . ' AND pd.idProducto = p.idProducto AND m.idMarca=p.idMarca ORDER BY p.nombre';
        $query = $this->db->query($str);
        return $query->result_array();
    }

    public function getDetallesPorProveedorCanasta($idProveedor = false) {
        $str = 'SELECT pd.idPedido,pd.cantidad,pd.precio,p.nombre,p.unidad,m.nombre marca,pv.nombre proveedor,pv.idProveedor FROM NUT_PEDIDOS_DETALLE pd,NUT_PRODUCTOS p,NUT_MARCAS m, NUT_PROVEEDORES pv, NUT_PEDIDOS ped ';
        $str.='WHERE pd.idProducto = p.idProducto AND m.idMarca=p.idMarca AND m.idProveedor=pv.idProveedor AND pv.idProveedor=' . $idProveedor . ' AND ped.idPedido = pd.idPedido AND ped.estado = "INICIADO"';
        $str.=' ORDER BY idProveedor, idPedido';
        $query = $this->db->query($str);
        return $query->result_array();
    }

    public function getDetallesPorProveedor($idProveedor = false) {
        $str = 'SELECT p.idProducto,p.costo,p.nombre,p.unidad,m.nombre marca,pv.nombre proveedor,pv.idProveedor,SUM(pd.cantidad_proveedor) cantidadTotal,SUM(pd.cantidad_proveedor)*p.costo precio  FROM NUT_PEDIDOS_DETALLE pd,NUT_PRODUCTOS p,NUT_MARCAS m, NUT_PROVEEDORES pv, NUT_PEDIDOS ped ';
        $str.='WHERE pd.idProducto = p.idProducto AND m.idMarca=p.idMarca AND m.idProveedor=pv.idProveedor AND pv.idProveedor=' . $idProveedor . ' AND ped.idPedido = pd.idPedido AND ped.estado = "INICIADO" ';
        $str.=' GROUP BY p.idProducto';
        $str2 = 'SELECT * FROM (' . $str . ') AS result WHERE cantidadTotal > 0 ';
        $query = $this->db->query($str2);
        return $query->result_array();
    }

    public function getPedidosCompleto($idPedido = FALSE) {
        if ($idPedido === FALSE) {
            $query = $this->db->get('NUT_PEDIDOS');
            return $query->result_array();
        }
        $query = $this->db->get_where('NUT_PEDIDOS', array('idPedido' => $idPedido));
        return $query->row_array();
    }

    public function getPedidosDetalleCompleto($idPedido = FALSE) {
        if ($idPedido === FALSE) {
            $query = $this->db->get('NUT_PEDIDOS_DETALLE');
            return $query->result_array();
        }
        $query = $this->db->get_where('NUT_PEDIDOS_DETALLE', array('idPedido' => $idPedido));
        return $query->row_array();
    }

    public function actualizar_pedidoAdm($idPedido, $idcliente, $fechaRealizacion, $fechaEntregaEstimada, $fechaEntrega, $zona, $direccion, $aclaracionDir, $notaCliente, $subtotal, $costoEnvio, $total, $esquina1, $esquina2, $estado, $notaPostVenta) {
        $this->db->simple_query("UPDATE NUT_PEDIDOS SET idCliente='" . $idcliente . "', estado='" . $estado . "', fecha_realizacion='" . $fechaRealizacion . "', fecha_entrega_estimada='" . $fechaEntregaEstimada . "', fecha_entrega='" . $fechaEntrega . "', nota_postventa = '" . $notaPostVenta . "', zona ='" . $zona . "', direccion='" . $direccion . "', direccion_aclaracion='" . $aclaracionDir . "', nota_cliente='" . $notaCliente . "',subtotal='" . $subtotal . "', costo_envio='" . $costoEnvio . "', total='" . $total . "', esquina1='" . $esquina1 . "',esquina2='" . $esquina2 . "' WHERE idPedido='" . $idPedido . "'");
    }

    public function quitarProductoPedidos($idProducto) {
        $query = $this->db->query("SELECT d.idPedidoDetalle,d.idPedido  FROM nut_pedidos p,nut_pedidos_detalle d WHERE d.idProducto = '" . $idProducto . "' AND p.idPedido=d.idPedido AND p.estado='INICIADO'");
        $res = $query->result_array();       
        foreach ($res as $r){
            $this->db->simple_query("UPDATE NUT_PEDIDOS_DETALLE SET cantidad_entregada='0',cantidad_proveedor='0' WHERE idPedidoDetalle='".$r['idPedidoDetalle']."' ");
        }
        return $res;
    }

}
