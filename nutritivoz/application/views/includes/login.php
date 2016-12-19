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
        <?php if ($this->session->userdata('username') == null) { ?>
            <div class="col-xs-8">
                <input type='button' id="btnLogin" name='basic' value='login' class='basic'/>
            </div>
                <?php if ($this->session->flashdata('error') != null) { ?>
                    <div class="col-xs-8">
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php } ?>      
        <?php } else { ?>
                <div class="col-md-8"> 
                    <b><?= $this->session->userdata('username') ?></b>                        
                    <a href="<?= base_url_control(); ?>login/logout" class="btn btn-sm btn-primary btn-block" role="button">Logout</a>  
                </div>
        <?php } ?>
        
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
            <form id="loginForm">                
                <div class="col-xs-8">
                    <span id="msgError" ></span>
                </div>                                      
                <label class="col-xs-4 col-md-4 control-label">Email</label>
                <div class="col-xs-8">
                    <input type="email" class="form-control" name="correou" id="correou" required />
                </div>
                <label class="col-xs-4 col-md-4 control-label">Pass</label>
                <div class="col-xs-8">
                    <input type="password" class="form-control" name="contrasena" id="contrasena" required />                    
                </div>
                <div class="col-xs-8">
                    <input type="submit" class="form-control" value="Enviar"/>
                </div>
            </form>
            <div class="col-xs-8">
            <a id="btnActivar" href="<?= site_url('login/cambiarContrasena') ?>" >Cambiar/recuperar contraseña</a>
            </div>
            <?php if (!@$user_profile): ?>
                <div class="col-xs-8">  
                    <a href="<?= $login_url ?>" class="btn btn-sm btn-primary btn-block" role="button">FB</a>
                </div>
            <?php endif; ?>
         </div>
         <br>
         <div class="row" id="cambiarContrasena">
            <form id="CambioForm">
                <div class="col-xs-8">
                    <span id="msgCambio"></span>
                </div> 
                <div class="col-xs-8"> 
                    <label class="col-xs-4 col-md-4 control-label">Email</label>
                </div>
                <div class="col-xs-8"> 
                    <input type="email" class="form-control" name="mailCambio" id="mailCambio" required />
                </div>
                <div class="col-xs-8">
                    <input type="button" id="cambiarBtn" class="form-control" value="Enviar"/>
                </div>
            </form>
         </div>
    </div>
    <script>
    $("#cambiarContrasena").hide();

    $('#btnActivar').click(function(){
        $("#cambiarContrasena").show();
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
                    $("#msgCambio").text("po favor revisa el correo indicado para cambiar la contrasena.");
                }else{
                    $("#msgCambio").text("No se encontro el correo indicado.");
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
                    $("#msgError").text("Error en usuario o contraseña!");
                }
            }
        });   
        return false;     
    });    
    </script>