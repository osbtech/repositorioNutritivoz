<div class="row">
    <!-- productos -->

    <div class="container">


        <div class="col-md-8">
            <div class="center">
                <div class="pricelist-box">
                    <?php
                    foreach ($categorias as $categoria) {
                        ?>
                        <table class='table table-striped table-condensed'>
                            <thead ><tr class='head-lista-precios'><th><?= $categoria['nombre'] ?> <img src="<?= asset_url(); ?>img/cat-<?= $categoria['idCategoria'] ?>.png"/></th><th class="text-center">Productor</th><th class="text-center">Unidad</th><th class="text-center">Precio</th><th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pedido</th></tr></thead>
                            <tbody>
                                <?php
                                foreach ($categoria['productos'] as $productos) {
                                    foreach ($productos as $producto) {
                                        // echo $producto['nombre'];
                                        ?>
                                        <tr><td scope='row'><?= $producto['nombre'] ?></td><td class="text-center"><?= $producto['marca'] ?></td><td class="text-center"><?= $producto['unidad'] ?></td><td class="text-center"><?= $producto['precio'] ?></td><td><input id="<?= $producto['idProducto'] ?>" data-idProducto="<?= $producto['idProducto'] ?>" class="form-control myspin rinput ingreso-cantidad" type="number" value="" min="0" max="10" /></td></tr>
                                        <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>



        <!-- carrito -->
        <div class="col-md-4" id="divCarrito">
            <div class="row carrito">
                <div id="tituloCarrito">
                    <div style="align:center; width:100%;">Tu pedido</div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class='table table-striped table-condensed' id="carritoItems">
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <table class='table'>
                            <tr>
                                <td>Costo de envío</td>
                                <td></td>
                                <td></td>
                                <td class="tdRight cenvio">$0</td>
                            </tr>
                            <tr>
                                <td>Total</td>
                                <td></td>
                                <td></td>
                                <td class="tdRight ctotal">$0</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">

                    <?php if (($this->session->userdata('username') == null)) { ?>
                        <div class="col-md-8"> 
                            <?php echo form_open('listado_productos/login', 'role="form"'); ?> 
                            <?php if ($this->session->flashdata('error') != null) { ?>
                                <div class="col-xs-8">
                                    <?php echo $this->session->flashdata('error'); ?>
                                </div>
                            <?php } ?>                        
                            <label class="col-xs-4 col-md-4 control-label">Email</label>
                            <div class="col-xs-8">
                                <input type="email" class="form-control" name="email" id="correo" required />
                            </div>
                            <label class="col-xs-4 col-md-4 control-label">Pass</label>
                            <div class="col-xs-8">
                                <input type="password" class="form-control" name="contrasena" id="correo" required />
                            </div>
                            <div class="col-xs-8">
                                <input type="submit" class="form-control" value="Enviar"/>
                            </div>
                            </form>
                        </div>
                        <div class="col-md-4"> 
                            <a href="<?= $login_url ?>" class="btn btn-sm btn-primary btn-block" role="button">FB</a>
                        </div>                     
                    <?php } else { ?>

                        <div class="col-md-8"> 
                            <b><?= $this->session->userdata('username') ?></b>                        
                            <a href="<?= base_url_control(); ?>listado_productos/logout" class="btn btn-sm btn-primary btn-block" role="button">Logout</a>  
                        </div>

                    <?php } ?>

                    <!--    <div class="col-md-4">
                    <?php if (@$user_profile): ?>
                                    <b><?= $user_profile['name'] ?></b>                        
                                    <a href="<?= $logout_url ?>" class="btn btn-sm btn-primary btn-block" role="button">Logout</a>                         
                    <?php else: ?>
                                    <a href="<?= $login_url ?>" class="btn btn-sm btn-primary btn-block" role="button">FB</a>
                    <?php endif; ?>
                        </div>-->

                </div>
                <hr>
                <?php echo validation_errors(); ?>
                <?php echo form_open('listado_productos/listado_productos', 'role="form"'); ?>
                <!--campos a ingresar -->
                <div class="row">
                    <label class="col-xs-4 col-md-4 control-label">Correo</label>
                    <div class="col-xs-8">
                        <input type="email" class="form-control" name="correo" id="correo" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 col-md-4 control-label">Nombre</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="nombre" id="correo" required />
                    </div>
                </div>            
                <div class="row">
                    <label class="col-xs-4 control-label">Celular</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="celular" id="celular" required />
                    </div>
                </div>

                <div class="row">
                    <label class="col-xs-4 control-label">Dirección</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="direccion" id="direccion" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Esquina 1</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="esquina1" id="direccion" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Esquina 2</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="esquina2" id="direccion" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Aclaración dir.</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" name="aclDireccion" id="aclDireccion" />
                    </div>
                </div>

                <div class="row">
                    <label class="col-xs-4 control-label">Zona</label>
                    <div class="col-xs-8 selectContainer">
                        <select class="form-control" name="zona" id="zona" required>

                            <option value=''>Seleccionar</option>
                            <optgroup label="Montevideo">
                                <option value='Aguada'>Aguada</option>
                                <option value='Aires Puros'>Aires Puros</option>
                                <option value='Atahualpa'>Atahualpa</option>
                                <option value='Bañados de Carrasco'>Bañados de Carrasco</option>
                                <option value='Barrio Sur'>Barrio Sur</option>
                                <option value='Belvedere'>Belvedere</option>
                                <option value='Brazo Oriental'>Brazo Oriental</option>
                                <option value='Buceo'>Buceo</option>
                                <option value='Capurro / Bella Vista'>Capurro / Bella Vista</option>
                                <option value='Carrasco'>Carrasco</option>
                                <option value='Carrasco Norte'>Carrasco Norte</option>
                                <option value='Casabó / Pajas Blancas'>Casabó / Pajas Blancas</option>
                                <option value='Casavalle'>Casavalle</option>
                                <option value='Castro Castellanos'>Castro Castellanos</option>
                                <option value='Centro'>Centro</option>
                                <option value='Cerrito'>Cerrito</option>
                                <option value='Cerro'>Cerro</option>
                                <option value='Ciudad Vieja'>Ciudad Vieja</option>
                                <option value='Colón'>Colón</option>
                                <option value='Colón / Sureste Abayuba'>Colón / Sureste Abayuba</option>
                                <option value='Conciliación'>Conciliación</option>
                                <option value='Cordón'>Cordón</option>
                                <option value='Figurita'>Figurita</option>
                                <option value='Flor de Maroñas'>Flor de Maroñas</option>
                                <option value='Ituzaingó'>Ituzaingó</option>
                                <option value='Jacinto Vera'>Jacinto Vera</option>
                                <option value='Jardines del Hipódromo'>Jardines del Hipódromo</option>
                                <option value='La Blanqueada'>La Blanqueada</option>
                                <option value='La Comercial'>La Comercial</option>
                                <option value='La Paloma / Tomkinson'>La Paloma / Tomkinson</option>
                                <option value='La Teja'>La Teja</option>
                                <option value='Larrañaga'>Larrañaga</option>
                                <option value='Las Acacias'>Las Acacias</option>
                                <option value='Las Canteras'>Las Canteras</option>
                                <option value='Lezica / Melilla'>Lezica / Melilla</option>
                                <option value='Malvín'>Malvín</option>
                                <option value='Malvín Norte'>Malvín Norte</option>
                                <option value='Manga'>Manga</option>
                                <option value='Manga Toledo Chico'>Manga Toledo Chico</option>
                                <option value='Maroñas / Parque Guaraní'>Maroñas / Parque Guaraní</option>
                                <option value='Mercado Modelo / Bolivar'>Mercado Modelo / Bolivar</option>
                                <option value='Nuevo París'>Nuevo París</option>
                                <option value='Palermo'>Palermo</option>
                                <option value='Parque Batlle / Villa Dolores'>Parque Batlle / Villa Dolores</option>
                                <option value='Parque Rodó'>Parque Rodó</option>
                                <option value='Paso de la Arena'>Paso de la Arena</option>
                                <option value='Paso de las Duranas'>Paso de las Duranas</option>
                                <option value='Peñarol / Lavalleja'>Peñarol / Lavalleja</option>
                                <option value='Piedras Blancas'>Piedras Blancas</option>
                                <option value='Pocitos'>Pocitos</option>
                                <option value='Prado / Nueva Savona'>Prado / Nueva Savona</option>
                                <option value='Punta Carretas'>Punta Carretas</option>
                                <option value='Punta de Rieles / Bella Italia'>Punta de Rieles / Bella Italia</option>
                                <option value='Punta Gorda'>Punta Gorda</option>
                                <option value='Reducto'>Reducto</option>
                                <option value='Sayago'>Sayago</option>
                                <option value='Tres Cruces'>Tres Cruces</option>
                                <option value='Tres Ombúes / Pueblo Victoria'>Tres Ombúes / Pueblo Victoria</option>
                                <option value='Unión'>Unión</option>
                                <option value='Villa Española'>Villa Española</option>
                                <option value='Villa García / Manga Rural'>Villa García / Manga Rural</option>
                                <option value='Villa Muñóz / Retiro'>Villa Muñóz / Retiro</option>
                            </optgroup>
                            <optgroup label="Ciudad de la Costa">
                                <option value='El Pinar'>El Pinar</option>
                                <option value='Lagomar'>Lagomar</option>
                                <option value='Lomas de Solymar'>Lomas de Solymar</option>
                                <option value='Médanos de Solymar'>Médanos de Solymar</option>
                                <option value='Parque Miramar'>Parque Miramar</option>
                                <option value='Paso Carrasco'>Paso Carrasco</option>
                                <option value='Shangrila'>Shangrila</option>
                                <option value='Solymar'>Solymar</option>
                            </optgroup>
                        </select>
                    </div>
                </div>

                <div class="row" style="display:none;">
                    <label class="col-xs-4 control-label">Horario</label>
                    <div class="col-xs-8 selectContainer">
                        <select class="form-control" name="horario" id="horario">
                            <option value="">Seleccionar horario</option>
                            <option value="9">9:00</option>
                            <option value="11">11:00</option>
                            <option value="13">13:00</option>
                            <option value="15">15:00</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <label class="col-xs-4 control-label">Notas</label>
                    <div class="col-xs-8">
                        <textarea name="notas" class="form-control" rows="3" id="notas"></textarea>
                    </div>	
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" id="btnEnviarPedido" class="btn boton-confirmar btn-md btn-block">Hacer pedido</button>
                    </div>	
                </div>
                </form> 
            </div>

        </div>

    </div>



    <script>
        var url = '<?= base_url_control() ?>/carrito/agregar_producto';

        var delay = (function () {
            var timer = 0;
            return function (callback, ms) {
                clearTimeout(timer);
                timer = setTimeout(callback, ms);
            };
        })();

        var actualizarCarrito = function (idProducto, cantidad, update) {
            if (cantidad == 0) {
                $("[name='namei" + idProducto + "']").val(0);
                $("#" + idProducto).val(0);
            }
            $.ajax({
                url: url,
                type: 'post',
                data: {
                    idProducto: idProducto,
                    cantidad: cantidad
                },
                dataType: 'html',
                success: function (data) {
                    var result = jQuery.parseJSON(data);
                    dibujarResumenCarro(result.carro, result.envio, result.total);
                }
            });
        };
        var obtenerCarrito = function () {
            $.ajax({
                url: '<?= base_url_control() ?>/carrito/obtener_carrito',
                type: 'post',
                dataType: 'html',
                success: function (data) {

                    var result = jQuery.parseJSON(data);
                    dibujarResumenCarro(result.carro, result.envio, result.total);
                }
            });
        };
        var aux = null;
        var aux1 = null;

        var agregarCambio = function () {
            $('.rinput').keyup(function () {
                aux = this.value;
                aux1 = $(this).attr("data-idProducto");
                delay(function () {
                    // alert('sdfsdf');
                    if (jQuery.isNumeric(aux)) {
                        actualizarCarrito(aux1, aux);
                    }
                }, 500);


            });

            $('.rinput').focusout(function () {
                if (this.value == '') {
                    actualizarCarrito($(this).attr("data-idProducto"), 0);
                }
            });
        };
        var dibujarResumenCarro = function (items, envio, total) {
            $('#carritoItems').empty();
            var html = "";
            $.each(items, function (i, item) {
                $('#' + item.id).val(item.qty);
                $("[name='name" + item.id + "']").attr("data-update", 0);
                $("[name='name" + item.id + "']").trigger("click");
                html += '<tr>' +
                        '<td><input class="form-control cant rinput" type="text" data-idProducto="' + item.id + '" value="' + item.qty + '" name="namei' + item.id + '" /></td>' +
                        '<td><label><strong>' + item.name + '</strong></label></td>' +
                        '<td class="tdRight"><label>$' + (item.price * item.qty) + '</label></td>' +
                        '</tr>';
            });
            $('#carritoItems').append(html);
            $('.cenvio').text('$' + envio);
            $('.ctotal').text('$' + (total + envio));
            if (total == 0) {
                $('#btnEnviarPedido').attr('disabled', 'disabled');
            } else {
                $('#btnEnviarPedido').removeAttr('disabled');
            }
            agregarCambio();
        };
        $('#after').bootstrapNumber();
        $(".myspin").each(function () {
            $(this).bootstrapNumber($(this).attr("data-idProducto"));
        });

        /*  var scrollCarrito = function () {
         var offset = $("#divCarrito").offset();
         var topPadding = 15;
         $(window).scroll(function () {
         if ($("#divCarrito").height() < $(window).height() && $(window).scrollTop() > offset.top) {
         $("#divCarrito").stop().animate({
         marginTop: $(window).scrollTop() - offset.top + topPadding
         });
         } else {
         $("#divCarrito").stop().animate({
         marginTop: 0
         });
         }
         ;
         });
         };*/

        obtenerCarrito();
        agregarCambio();
        /*$('#comprar').click(function(){
         window.location.replace("<?= base_url_control() ?>/carrito/resumen");
         });*/

        var lastScrollTop = 0;
        var indice = 1;
        $(window).on("scroll", function () {

            var headerHeight = $('#inicio')[0].clientHeight;
            var carritoHeight = $("#divCarrito")[0].clientHeight;
            var carritoTop = $("#divCarrito")[0].offsetTop;
            var footerHeight = $('footer')[0].clientHeight;

            console.log("---");
            console.log("window.innerHeight " + window.innerHeight);
            console.log("carritoHeight ", carritoHeight);
            console.log("headerHeight ", headerHeight);
            console.log(window.innerHeight - carritoHeight - headerHeight);
            console.log(carritoHeight - document.body.scrollTop);
            console.log("document.body.scrollTop ", document.body.scrollTop);
            console.log("document.body.scrollHeight ", document.body.scrollHeight);
            console.log("carritoTop " + carritoTop);


            var st = $(this).scrollTop();
            if (st > lastScrollTop) {
                // downscroll code
                indice = 1;

                if (document.body.scrollHeight - document.body.scrollTop <= window.innerHeight + 50) {
                    $("#divCarrito").css("margin-top", window.innerHeight - carritoHeight - footerHeight - 30);
                    $("#divCarrito").css("position", "fixed");
                }
                //else if(carritoHeight - document.body.scrollTop < 450) {
                else if (Math.abs(window.innerHeight - carritoHeight - headerHeight) < document.body.scrollTop) {
                    $("#divCarrito").css("margin-top", window.innerHeight - carritoHeight - 10); //inicial -400
                    $("#divCarrito").css("position", "fixed");

                } else {
                    $("#divCarrito").css("margin-top", headerHeight + 30);
                    $("#divCarrito").css("position", "absolute");
                    //                indice = indice + 30;
                    //                var a = carritoHeight - 10;
                    //                $("#divCarrito").css("margin-top", a + indice);
                    //                $("#divCarrito").css("position", "fixed");
                }
            } else {
                // upscroll code

                if (document.body.scrollTop <= headerHeight) {
                    $("#divCarrito").css("margin-top", headerHeight + 30);
                    $("#divCarrito").css("position", "absolute");
                } else if (carritoTop >= 0) {
                    $("#divCarrito").css("margin-top", 10);
                    $("#divCarrito").css("position", "fixed");
                } else {
                    indice = indice + 30;
                    var a = window.innerHeight - carritoHeight - 10;
                    $("#divCarrito").css("margin-top", a + indice);
                    $("#divCarrito").css("position", "fixed");
                }


            }
            lastScrollTop = st;

        });



    </script>

    <style>
        #divCarrito{
            width: 25%;
            float:right;
            margin: 20px;
            margin-top:270px;
            float:right;
            right:0;
            top:0;
            margin-right: 4%;
            position: absolute;
        }
    </style>
