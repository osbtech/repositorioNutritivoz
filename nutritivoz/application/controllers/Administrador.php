<?php

/**
 * Description of Administrador
 *
 * @author Juan Pablo
 */

class Administrador extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('pedidos_model');
        $this->load->model('clientes_model');
        $this->load->library('cart');
    }

    public function listado_pedidos() {
        $data['pedidos'] = $this->pedidos_model->getPedidos();
        $this->load->view('includes_admin/head');
        $this->load->view('includes_admin/header');
        $this->load->view('administrador/listado_pedidos', $data);
        $this->load->view('includes_admin/footer');
    }
    
    public function resumen_pedidos() {
        $data['pedidos'] = $this->pedidos_model->getPedidosEstado('CONFIRMADO');
        $this->load->view('includes_admin/head');
        $this->load->view('includes_admin/header');
        $this->load->view('administrador/resumen_pedidos', $data);
        $this->load->view('includes_admin/footer');
    }
    
    

    public function actualizarCantidadEntregada($idPedido = false) {

        if ($idPedido) {
            $listaPedidos = array($this->pedidos_model->getPedidos($idPedido));
        } else {
            $listaPedidos = $this->pedidos_model->getPedidos();
        }

        foreach ($listaPedidos as $pedido) {
            $detallesPedido = $this->pedidos_model->getDetallePedidos($pedido['idPedido']);

            foreach ($detallesPedido as $det) {
                $this->pedidos_model->actualizarCantidadEntregada($det['idPedidoDetalle'], $det['cantidad']);
            }
        }
//$pedido = $this->pedidos_model->getPedidos($idPedido);
    }

    public function actualizarTotal($idPedido = false) {

        if ($idPedido) {
            $listaPedidos = array($this->pedidos_model->getPedidos($idPedido));
        } else {
            $listaPedidos = $this->pedidos_model->getPedidos();
        }

        foreach ($listaPedidos as $pedido) {
            $detallesPedido = $this->pedidos_model->getDetallePedidos($pedido['idPedido']);
            $s = 0;
            foreach ($detallesPedido as $det) {
                if ($det['cantidad_entregada'] > 0) {
                    $s += $det['precio'];   //FIXME: Considerar el caso en que cantidad_entregada != cantidad && cantidad_entregada > 0
                }
            }
            $this->pedidos_model->actualizarTotalesPedido($pedido['idPedido'], $s, $pedido['costo_envio'], $s + $pedido['costo_envio']);
        }
    }

    public function editar_pedido($idPedido) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('correo', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('celular', 'Celular', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');
        $this->form_validation->set_rules('esquina1', 'Esquina 1', 'required');
        $this->form_validation->set_rules('esquina2', 'Esquina 2', 'required');
        $this->form_validation->set_rules('zona', 'Zona', 'required');

        if ($this->form_validation->run() === FALSE) {
            $data['categorias'] = $this->productos_model->get_productosByCategoria();
            $data['pedido'] = $this->pedidos_model->getPedidos($idPedido);
            $detalles = $this->pedidos_model->getDetallePedidos($idPedido);
            $this->cargar_carrito($detalles);
            $this->load->view('includes/head');
            $this->load->view('includes/header');
            $this->load->view('administrador/editar_pedido', $data);
            $this->load->view('includes/footer');
        } else {
            $idPedido = $this->input->post('idPedido');
            $this->pedidos_model->actualizar_pedido($idPedido, $this->input->post('direccion'), $this->input->post('aclDireccion'), '', $this->input->post('notas'), $this->cart->total(), calcularCostoEnvio($this->cart->total()), $this->cart->total() + calcularCostoEnvio($this->cart->total()), $this->input->post('esquina1'), $this->input->post('esquina2'));
            $pedido = $this->pedidos_model->getPedidos($idPedido);
            $this->clientes_model->actualizar_cliente($pedido['correo'], $this->input->post('nombre'), $this->input->post('celular'));
            $this->pedidos_model->borrar_pedido_detalles($idPedido);
            foreach ($this->cart->contents() as $items) {
                $this->pedidos_model->guardarDetallePedido($idPedido, $items['id'], $items['qty'], ($items['price'] * $items['qty']));
            }
            $this->cart->destroy();
            redirect('/administrador/listado_pedidos');
        }
    }

    public function cargar_carrito($detalles) {
        $this->cart->destroy();
        foreach ($detalles as $det) {
            $producto = $this->productos_model->get_productos($det['idProducto']);
            $data = array(
                'id' => $producto['idProducto'],
                'qty' => $det['cantidad'],
                'price' => $producto['precio'],
                'name' => $producto['nombre'],
                'options' => array()
            );
            $this->cart->insert($data);
        }
    }

    public function email_pedido($idPedido) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->form_validation->set_rules('titulo', 'Titulo', 'required');
        $this->form_validation->set_rules('email', 'Correo', 'required');

        $pedido = $this->pedidos_model->getPedidos($idPedido/* $this->input->post('idPedido') */);

        if ($this->form_validation->run() === FALSE) {
            $data['idPedido'] = $idPedido; //$this->pedidos_model->getPedidos($idPedido);            
            $data['correo'] = $pedido['correo'];
            $this->load->view('includes_admin/head');
            $this->load->view('includes_admin/header');
            $this->load->view('administrador/email_pedido', $data);
            $this->load->view('includes_admin/footer');
        } else {

            $detalles = $this->pedidos_model->getDetallePedidos($idPedido/* $this->input->post('idPedido') */);

            $datosEmail = array();
            $datosEmail['nombre'] = $pedido['nombre'];
            $datosEmail['direccion'] = $pedido['direccion'];
            $datosEmail['aclDireccion'] = $pedido['aclaracion'];
            $datosEmail['zona'] = $pedido['zona'];
            //$datosEmail['horario'] = $pedido['aclaracion'];
            $datosEmail['celular'] = $pedido['celular'];
            $datosEmail['subtotal'] = $pedido['subtotal'];
            $datosEmail['envio'] = $pedido['costo_envio'];
            $datosEmail['total'] = $pedido['total'];
            $datosEmail['notas'] = $pedido['nota'];
            $datosEmail['esquina1'] = $pedido['esquina1'];
            $datosEmail['esquina2'] = $pedido['esquina2'];
            $datosEmail['mensaje'] = $this->input->post('mensaje');

            foreach ($detalles as $detalle) {
                $carroItem['unidad'] = $detalle['unidad'];
                $carroItem['marca'] = $detalle['marca'];
                $carroItem['cantidad'] = $detalle['cantidad'];
                $carroItem['precio'] = $detalle['precio'];
                $carroItem['nombre'] = $detalle['nombre'];
                $datosEmail['items'][] = $carroItem;
            }

            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/lib/sendmail';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $this->email->initialize($config);
            $this->email->from('ventas@nutritivoz.com', "Nutritívoz - AlimentaciÃ³n saludable para todos");
            $this->email->subject($this->input->post('titulo'));
            $this->email->to($this->input->post('email'));

            if ($this->input->post('cemail') != '')
                $this->email->cc($this->input->post('cemail'));

            if ($this->input->post('bemail') != '')
                $this->email->bcc($this->input->post('bemail'));

            $this->email->set_mailtype("html");
            $this->email->message($this->load->view('productos/email_template', $datosEmail, true));
            $this->email->send();
            redirect('/administrador/listado_pedidos');
        }
    }

    public function administrar_pedido($idPedido) {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idCliente', 'Usuario', 'required');
        if ($this->form_validation->run() === FALSE) {
            $data['pedido'] = $this->pedidos_model->getPedidosCompleto($idPedido);
            $data['detalles'] = $this->pedidos_model->getDetallePedidos($idPedido);
            $data['clientes'] = $this->clientes_model->obtener_cliente();
            $data['clientePedido'] = $this->clientes_model->obtener_cliente($data['pedido']['idCliente']);
            $data['idPedido'] = $idPedido;
            $this->load->view('includes_admin/head');
            $this->load->view('includes_admin/header');
            $this->load->view('administrador/administrar_pedido', $data);
            $this->load->view('includes_admin/footer');
        } else {
            $cantidad = $this->input->post('cantidad');
            $cantidadEntregada = $this->input->post('cantidad_entregada');
            $cantidadProveedor = $this->input->post('cantidad_proveedor');
            $idProducto = $this->input->post('idProducto');
            $precio = $this->input->post('precio');
            $subtotal = 0;
            $pedido=$this->pedidos_model->getPedidosCompleto($idPedido);
            $cliente = $this->clientes_model->obtener_cliente($pedido['idCliente']);
            $this->clientes_model->actualizar_cliente($cliente['correo'],$cliente['nombre'],$this->input->post('celular'));
            $this->pedidos_model->borrar_pedido_detalles($idPedido);
            for ($x = 0; $x < count($cantidad); $x++) {
                $subtotal = $subtotal + $precio[$x];
                $this->pedidos_model->guardarDetallePedido($idPedido, $idProducto[$x], $cantidad[$x], $precio[$x], $cantidadEntregada[$x], $cantidadProveedor[$x]);
            }
            $total = $subtotal + $this->input->post('costo_envio');
            $this->pedidos_model->actualizar_pedidoAdm($idPedido, $this->input->post('idCliente'), $this->input->post('fecha_realizacion'), $this->input->post('fecha_entrega_estimada'), $this->input->post('fecha_entrega'), $this->input->post('direccion'), $this->input->post('direccion_aclaracion'), $this->input->post('nota_cliente'), $subtotal, $this->input->post('costo_envio'), $total, $this->input->post('esquina1'), $this->input->post('esquina2'), $this->input->post('estado'), $this->input->post('nota_postventa'));

            redirect('/administrador/listado_pedidos');
        }
    }

    public function quitar_prod_pedido() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('idProducto', 'Producto', 'required');
        $data['productos'] = $this->productos_model->get_productos();
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('includes_admin/head');
            $this->load->view('includes_admin/header');
            $this->load->view('administrador/quitar_producto', $data);
            $this->load->view('includes_admin/footer');
        } else {
            $data['resultado'] = $this->pedidos_model->quitarProductoPedidos($this->input->post('idProducto'));
            $this->load->view('includes_admin/head');
            $this->load->view('includes_admin/header');
            $this->load->view('administrador/quitar_producto', $data);
            $this->load->view('includes_admin/footer');
        }
    }

    public function enviar_email_osb() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->form_validation->set_rules('nombre', 'Nombre', 'required');
        $this->form_validation->set_rules('email', 'Correo', 'required');
        $this->form_validation->set_rules('mensaje', 'Mensaje', 'required');
        $this->form_validation->set_rules('firma', 'Firma', 'required');
        if ($this->form_validation->run() === FALSE) {
            $this->load->view('osbtech_mailer/mail_producto');
        } else {
            $datosEmail['nombre'] = $this->input->post('nombre');
            $datosEmail['mensaje'] = $this->input->post('mensaje');
            $datosEmail['firma'] = $this->input->post('firma');
            $config['protocol'] = 'sendmail';
            $config['mailpath'] = '/usr/lib/sendmail';
            $config['charset'] = 'utf-8';
            $config['wordwrap'] = TRUE;
            $this->email->initialize($config);
            $this->email->from('info@osbtech.uy', "OSB TECH");
            $this->email->subject("SiMEP - Reduzca el costo de sus procesos de producción");
            $this->email->to($this->input->post('email'));
            $this->email->set_mailtype("html");
            $this->email->bcc('info@osbtech.uy');
            $this->email->message($this->load->view('osbtech_mailer/email', $datosEmail, true));
            $this->email->send();
            echo "Mensaje enviado.";            
        }
    }

}
