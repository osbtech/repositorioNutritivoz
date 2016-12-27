<?php

/**
 * Description of ListadoProductos
 *
 * @author Juan Pablo
 */
class Listado_productos extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('productos_model');
        $this->load->model('pedidos_model');
        $this->load->model('clientes_model');
        $this->load->model('config_model');
        $this->load->model('email_model');
        $this->load->helper('url');
        $this->load->model('zona_model');
    }

    public function confirmar_pedido($hash) {
        $this->pedidos_model->confirmar_pedido($hash);
        $data['titulo'] = "¡Muchas gracias!";
        $data['mensaje'] = "Su pedido está confirmado y será procesado a partir de este momento.";
        $data['immagen'] = "carrito.png";
        $this->load->view('includes/head');
        $this->load->view('includes/header');
        $this->load->view('productos/confirmacion', $data);
        $this->load->view('includes/footer');
    }

    public function listado_productos() {
        $this->session->sess_expiration = '28800';      // Session expires in 8 hours
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('email');
        $this->load->library('cart');
        $this->form_validation->set_rules('correo', 'Correo electrónico', 'required');
        $this->form_validation->set_rules('celular', 'Celular', 'required');
        $this->form_validation->set_rules('direccion', 'Dirección', 'required');
        $this->form_validation->set_rules('esquina1', 'Esquina 1', 'required');
        $this->form_validation->set_rules('esquina2', 'Esquina 2', 'required');
        //$this->form_validation->set_rules('aclDireccion', 'Aclaración dirreción', 'required');
        $this->form_validation->set_rules('localidad', 'Localidad', 'required');
        // $this->form_validation->set_rules('horario', 'Horario', 'required');

        /* login con facebook */
        $this->load->library('facebook'); // Automatically picks appId and secret from config
        $user = $this->facebook->getUser();
        if ($user) {
            try {
                //$data['user_profile'] = $this->facebook->api('/me?fields=name,email');
                $us = $this->facebook->api('/me?fields=name,email');
                $cliente = $this->clientes_model->obtener_clienteByMail($us['email']);
                if ($cliente == null) {
                    $idCliente = $this->clientes_model->guardar_cliente($us['email'], $us['name'], '', $us['id'], '0', '0', '', '', '', '', '');
                    $data = array(
                        'username' => $us['name'],
                        'email' => $us['email'],
                        'idUsuario' => $idCliente,
                        'fbId' => $us['id']
                    );
                    $this->session->set_userdata($data);
                    //  redirect('listado_productos/listado_productos');
                } else {
                    $this->clientes_model->actualizar_cliente($us['email'], $us['name'], $cliente['celular'], $us['id'], $cliente['idZona'], $cliente['idLocalidad'], $cliente['direccion'], $cliente['direccion_aclaracion'], $cliente['esquina1'], $cliente['esquina2']);
                    $data = array(
                        'username' => $cliente['nombre'],
                        'email' => $cliente['correo'],
                        'idUsuario' => $cliente['idCliente'],
                        'fbId' => $cliente['fbId']
                    );
                    $this->session->set_userdata($data);
                    //  redirect('listado_productos/listado_productos');
                }
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            
        }
        if ($user) {
            $data['logout_url'] = site_url('listado_productos/logoutFB'); // Logs off application
        } else {
            $data['login_url'] = $this->facebook->getLoginUrl(array(
                'redirect_uri' => site_url('listado_productos/listado_productos'),
                'scope' => array('email') // permissions here
            ));
        }
        /* fin login con facebook */

        if ($this->form_validation->run() === FALSE) {
            //Obtener cliente
            if ($this->session->userdata('username') != null) {
                $data['cliente'] = $this->clientes_model->obtener_clienteByMail($this->session->userdata('email'));
                $data['cliente']['localidad'] = $this->zona_model->get_localidades($data['cliente']['idLocalidad']);
            }
            if (isset($_SESSION['zona'])) {
                $data['categorias'] = $this->productos_model->get_productosByCategoria($_SESSION['zona']);
                $data['localidades'] = $this->zona_model->get_localidadesByZona($_SESSION['zona']);
                $q = $this->config_model->getFechas();
                $data['fechaProxEntrega'] = $q['FechaProxEntrega'];
                $data['fechaCierrePedidos'] = array('Domingo', 'Lunes', 'Martes', 'Miércoles',
                    'Jueves', 'Viernes', 'S&aacute;bado')[date('w', strtotime($q['FechaCierrePedidos']))] . " " .
                        date("j/n", strtotime($q['FechaCierrePedidos']));
                $this->load->view('includes/head');
                $this->load->view('includes/header');
                $this->load->view('productos/listado', $data);
                $this->load->view('includes/footer');
            } else {
                redirect('/zona/zonas');
            }
        } else {
            $idCliente = 0;
            $cliente = $this->clientes_model->obtener_clienteByMail($this->input->post('correo'));
            if ($cliente == null) {
                $ps = $this->rand_passwd();
                $idCliente = $this->clientes_model->guardar_cliente($this->input->post('correo'), $this->input->post('nombre'), (string) $this->input->post('celular'), '', $_SESSION['zona'], $this->input->post('localidad'), $this->input->post('direccion'), $this->input->post('aclDireccion'), $this->input->post('esquina1'), $this->input->post('esquina2'), $ps);
                $data['contrasena'] = $ps;
                $data['usuario'] = $this->input->post('correo');
                $this->email_model->enviar_mail('mail_templates/cuenta_creada', $this->input->post('correo'), $data, "Cuenta creada", "Cuenta creada");
            } else {
                $idCliente = $cliente['idCliente'];
                $this->clientes_model->actualizar_cliente($this->input->post('correo'), $this->input->post('nombre'), (string) $this->input->post('celular'), $cliente['fbId'],$_SESSION['zona'], $this->input->post('localidad'), $this->input->post('direccion'), $this->input->post('aclDireccion'), $this->input->post('esquina1'), $this->input->post('esquina2'));
            }
            $idPedido = $this->pedidos_model->guardar_pedido($idCliente, '', $this->input->post('direccion'), $this->input->post('aclDireccion'), '', $this->input->post('notas'), $this->cart->total(), calcularCostoEnvio($this->cart->total()), $this->cart->total() + calcularCostoEnvio($this->cart->total()), md5($idCliente + $this->cart->total()), $this->input->post('esquina1'), $this->input->post('esquina2'), $_SESSION['zona'], $this->input->post('localidad'));
            $datosEmail = array();
            $datosEmail['nombre'] = $this->input->post('nombre');
            $datosEmail['direccion'] = $this->input->post('direccion');
            $datosEmail['aclDireccion'] = $this->input->post('aclDireccion');
            $l=$this->zona_model->get_localidades($this->input->post('localidad'));
            $datosEmail['zona'] = $l['nombre'].' '.$l['departamento'];
            $datosEmail['horario'] = $this->input->post('horario');
            $datosEmail['celular'] = $this->input->post('celular');
            $datosEmail['subtotal'] = $this->cart->total();
            $datosEmail['envio'] = calcularCostoEnvio($this->cart->total());
            $datosEmail['total'] = $this->cart->total() + calcularCostoEnvio($this->cart->total());
            $datosEmail['hash'] = md5($idCliente + $this->cart->total());
            $datosEmail['notas'] = $this->input->post('notas');
            $datosEmail['esquina1'] = $this->input->post('esquina1');
            $datosEmail['esquina2'] = $this->input->post('esquina2');
            foreach ($this->cart->contents() as $items) {
                $this->pedidos_model->guardarDetallePedido($idPedido, $items['id'], $items['qty'], ($items['price'] * $items['qty']), $items['qty'], $items['qty']);
                $producto = $this->productos_model->get_productos($items['id']);
                $marca = $this->productos_model->get_marcas($producto['idMarca']);
                $carroItem['unidad'] = $producto['unidad'];
                $carroItem['marca'] = $marca['nombre'];
                $carroItem['cantidad'] = $items['qty'];
                $carroItem['precio'] = $items['price'];
                $carroItem['nombre'] = $items['name'];
                $datosEmail['items'][] = $carroItem;
            }
            $this->email_model->enviar_mail('productos/email_template', $this->input->post('correo'), $datosEmail, 'Nutritívoz - Alimentación saludable para todos', 'Por favor, confirma tu pedido');
            $this->cart->destroy();
            $data['titulo'] = "Ya casi estamos";
            $data['mensaje'] = "Para confirmar el pedido por favor revisa tu correo electrónico.";
            $data['imagen'] = "img/smartphone.png";
            $this->load->view('includes/head');
            $this->load->view('includes/header');
            $this->load->view('productos/confirmacion', $data);
            $this->load->view('includes/footer');
        }
    }

    public function login() {
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        if ($this->form_validation->run() === FALSE) {
            $usuario = $this->clientes_model->login_usuarios($this->input->post('email'), $this->input->post('contrasena'));
            if ($usuario == null) {
                $this->session->set_flashdata('error', 'Usuario o contraseña incorrecta!');
                redirect('listado_productos/listado_productos');
            } else {
                $data = array(
                    'username' => $usuario['nombre'],
                    'email' => $usuario['correo'],
                    'idUsuario' => $usuario['idCliente'],
                    'fbId' => $usuario['fbId']
                );
                $this->session->set_userdata($data);
                redirect('listado_productos/listado_productos');
            }
        } else {
            
        }
    }

    public function logout() {
        $this->session->unset_userdata(array('username', 'email', 'idUsuario','zona'));
        $this->logoutFB();
        redirect('listado_productos/listado_productos');
        //poner lo mismo en logout facebook
    }

    public function logoutFB() {
        $this->load->library('facebook');

        // Logs off session from website
        $this->facebook->destroySession();
        // Make sure you destory website session as well.

        redirect('listado_productos/listado_productos');
    }

    function rand_passwd($length = 8, $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789') {
        return substr(str_shuffle($chars), 0, $length);
    }

}
