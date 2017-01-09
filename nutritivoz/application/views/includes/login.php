<?php
    $CI = & get_instance();
    $CI->load->model('clientes_model');
    $CI->load->library('facebook'); // Automatically picks appId and secret from config
    $user = $CI->facebook->getUser();
        if ($user) {
            try {
                //$data['user_profile'] = $CI->facebook->api('/me?fields=name,email');
                $us = $CI->facebook->api('/me?fields=name,email');
                $cliente = $CI->clientes_model->obtener_clienteByMail($us['email']);
                if ($cliente == null) {
                    $idCliente = $CI->clientes_model->guardar_cliente($us['email'], $us['name'], '', $us['id'], '0', '0', '', '', '', '', '');
                    $data = array(
                        'username' => $us['name'],
                        'email' => $us['email'],
                        'idUsuario' => $idCliente,
                        'fbId' => $us['id']
                    );
                    $this->session->set_userdata($data);
                } else {
                    $CI->clientes_model->actualizar_cliente($us['email'], $us['name'], $cliente['celular'], $us['id'], $cliente['idZona'], $cliente['idLocalidad'], $cliente['direccion'], $cliente['direccion_aclaracion'], $cliente['esquina1'], $cliente['esquina2']);
                    $data = array(
                        'username' => $cliente['nombre'],
                        'email' => $cliente['correo'],
                        'idUsuario' => $cliente['idCliente'],
                        'fbId' => $cliente['fbId']
                    );
                    $this->session->set_userdata($data);
                }
                if($this->session->userdata('log1')!="ok"){
                    $this->session->set_userdata('log1', 'ok');
                    redirect($redirUrl);
                }
            } catch (FacebookApiException $e) {
                $user = null;
            }
        } else {
            
        }
        if ($user) {
            $logout_url = site_url('login/logout'); // Logs off application
        } else {
            $login_url = $CI->facebook->getLoginUrl(array(
                'redirect_uri' => site_url($redirUrl),
                'scope' => array('email') // permissions here
            ));
        }
?>

    <div class="row">
        <div id="divLogin">
            <?php if ($this->session->userdata('username') == null) { ?>
                Puede <input type='button' id="btnLogin" name='basic' value='ingresar con su usuario' class='basic'/> o realizar la compra indicando sus datos debajo.
                <?php if ($this->session->flashdata('error') != null) { ?>
                    <div class="col-xs-8">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>      
            <?php } else { ?>
                Se encuentra logueado al sistema. Puede modificar los datos para el envío. 
                <a href="<?= base_url_control(); ?>login/logout" >Salir</a>  
            <?php } ?>
        </div>
        
        <?php if (@$user_profile): ?>
            <div class="col-xs-8">
                <b><?= $user_profile['name'] ?></b>                        
                <a href="<?= $logout_url ?>" class="btn btn-sm btn-primary btn-block" role="button">Logout</a>  
            </div>
        <?php else: ?>
           <!-- <div class="col-xs-8">  
                <a href="<?= $login_url ?>" class="btn btn-sm btn-primary btn-block" role="button">FB</a>
            </div>-->
        <?php endif; ?>
    </div>

    <!-- modal content para login-->
    <div id="basic-modal-content">
         <div class="row"> 
            <div class="col-xs-10" >
                <h2 style="line-height:60px" id="tituloModal">Ingresar</h2>
            </div>
        </div>
        
        <form id="loginForm" class="modalForm">
            <div class="row">
                <div class="col-xs-12" style="margin-bottom:10px;">
                    <span id="msgError" class="errorMessage"></span>
                </div>
            </div>
            <div class="row">
                <label class="col-xs-3 control-label">Correo</label>
                <div class="col-xs-9">
                    <input type="email" class="form-control" name="correou" id="correou" required />
                </div>
            </div>
            <div class="row">
                <label class="col-xs-3 control-label">Contraseña</label>
                <div class="col-xs-9">
                    <input type="password" class="form-control" name="contrasena" id="contrasena" required />                    
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3"></div>
                <div class="col-xs-5">
                    <a id="btnActivar" href="<?= site_url('login/cambiarContrasena') ?>" >Recuperar contraseña</a>
                </div>
                <div class="col-xs-4">
                    <input type="submit" class="form-control btn-lg boton-confirmar" value="Ingresar"/>
                </div>
            </div>
        </form>
        <?php if (!@$user_profile): ?>
            <div class="row" style="margin-top:35px" id="loginFacebook">
                <div class="col-xs-3">
                    O puede
                </div>
                <div class="col-xs-9">      
                    <a href="<?= $login_url ?>" class="btn btn-md btn-primary btn-block" role="button">Ingresar con Facebook</a>
                </div>
            </div>
        <?php endif; ?>
         <br>

        <div class="row">
            <div class="col-xs-12" style="margin-bottom:10px;">
                <span id="msgCambio" class="errorMessage"></span>
            </div>
        </div>

        <form id="CambioForm" class="modalForm">

            <div class="row">
                <label class="col-xs-3 control-label">Correo</label>
                <div class="col-xs-9">
                    <input type="email" class="form-control"  name="mailCambio" id="mailCambio" required />
                </div>
            </div>

            <div class="row">
                <div class="col-xs-8"></div>
                <div class="col-xs-4">
                    <input type="submit" id="cambiarBtn" class="form-control btn-lg boton-confirmar" value="Recuperar"/>
                </div>
            </div>
        </form>
    </div>
    <script>
    $("#CambioForm").hide();

    $('#btnActivar').click(function(){
        $('#loginForm').hide();
        $('#loginFacebook').hide();
        $('#tituloModal').text('Recuperar contraseña');
        $("#CambioForm").show();
        
        return false;
    });

    $('#btnLogin').click(function () {
		$('#basic-modal-content').modal();
		return false;
	});

    $("#cambiarBtn").click(function(){
        $.ajax({
            url: '<?= site_url('login/cambiarContrasena') ?>',
            type: 'post',
            data: {
                correo: $("#mailCambio").val()
            },
            dataType: 'html',
            success: function (data) {
                var result = jQuery.parseJSON(data);
                if(result.resultado){
                    $("#msgCambio").text("Proceso iniciado. Revisa el correo para cambiar la contraseña.");
                    $("#CambioForm").hide();
                    
                }else{
                    $("#msgCambio").text("No se encontró la dirección de correo.");
                }
            }
        });
        return false;
    });

    $( "#loginForm" ).submit(function() {
        $.ajax({
            url: '<?= base_url_control() ?>login/loginAjax',
            type: 'post',
            data: {
                correo: $("#correou").val(),
                contrasena: $("#contrasena").val()
            },
            dataType: 'html',
            success: function (data) {
                var result = jQuery.parseJSON(data);
                if(result.resultado){
                     location.reload();
                }else{
                    $("#msgError").text("Error en usuario o contraseña. Intente nuevamente.");
                }
            }
        });   
        return false;     
    });    
    </script>