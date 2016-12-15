<?php

/**
 * Description of Carrito
 *
 * @author Juan Pablo 
 */
class Carrito extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->load->model('productos_model');
    }

    public function agregar_producto() {
        $producto = $this->productos_model->get_productos($this->input->post('idProducto'));
        $this->borrarProducto($producto['idProducto']);
        $data = array(
            'id' => $producto['idProducto'],
            'qty' => $this->input->post('cantidad'),
            'price' => $producto['precio'],
            'name' => $producto['nombre'],
            'options' => array()
        );
        $this->cart->insert($data);
        $this->obtener_carrito();
    }

    public function borrarProducto($idProducto) {
        $borrar = array();
        foreach ($this->cart->contents() as $items) {
            if ($items['id'] == $idProducto) {
                $borrar[] = $items['rowid'];
            }
        }
        foreach ($borrar as $c) {
            $this->cart->remove($c);
        }
    }

    public function borrarCeros() {
        $ceros = array();
        foreach ($this->cart->contents() as $items) {
            if ($items['qty'] <= 0) {
                $ceros[] = $items['rowid'];
            }
        }
        foreach ($ceros as $c) {
            $this->cart->remove($c);
        }
    }

    public function obtener_carrito() {
        $this->borrarCeros();
        $total = 0;
        $ret = array();
        $carro = array();
        foreach ($this->cart->contents() as $items) {
            $carroItem['rowId'] = $items['rowid'];
            $carroItem['qty'] = $items['qty'];
            $carroItem['id'] = $items['id'];
            $carroItem['price'] = $items['price'];
            $carroItem['name'] = $items['name'];
            $carro[] = $carroItem;
            $total = $total + $items['price']*$items['qty'];
        }
        $ret['carro'] = $carro;
        $ret['total'] = $total;
        $ret['envio'] = calcularCostoEnvio($total);
        echo json_encode($ret);
    }

}
