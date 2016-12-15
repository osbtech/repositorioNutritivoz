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
               <!-- copiado a nt -->
               <?php $data["redirUrl"]="listado_productos/listado_productos"; ?>
               <?php $this->view('includes/login',$data); ?>
               <!-- fin -->
                <hr>
                <?php echo validation_errors(); ?>
                <?php echo form_open('listado_productos/listado_productos', 'role="form"'); ?>
                <!--campos a ingresar -->
                <div class="row">
                    <label class="col-xs-4 col-md-4 control-label">Correo</label>
                    <div class="col-xs-8">
                        <input type="email" <?= isset($cliente['correo']) ? 'readonly' : '' ?> value="<?= isset($cliente['correo']) ? $cliente['correo'] : '' ?>" class="form-control" name="correo" id="correo" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 col-md-4 control-label">Nombre</label>
                    <div class="col-xs-8">
                        <input type="text" value="<?= isset($cliente['nombre']) ? $cliente['nombre'] : '' ?>" class="form-control" name="nombre" id="correo" required />
                    </div>
                </div>            
                <div class="row">
                    <label class="col-xs-4 control-label">Celular</label>
                    <div class="col-xs-8">
                        <input type="text" value="<?= isset($cliente['celular']) ? $cliente['celular'] : '' ?>" class="form-control" name="celular" id="celular" required />
                    </div>
                </div>

                <div class="row">
                    <label class="col-xs-4 control-label">Dirección</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" value="<?= isset($cliente['direccion']) ? $cliente['direccion'] : '' ?>" name="direccion" id="direccion" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Esquina 1</label>
                    <div class="col-xs-8">
                        <input type="text" class="form-control" value="<?= isset($cliente['esquina1']) ? $cliente['esquina1'] : '' ?>" name="esquina1" id="esquina1" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Esquina 2</label>
                    <div class="col-xs-8">
                        <input type="text" value="<?= isset($cliente['esquina2']) ? $cliente['esquina2'] : '' ?>" class="form-control" name="esquina2" id="esquina2" required />
                    </div>
                </div>
                <div class="row">
                    <label class="col-xs-4 control-label">Aclaración dir.</label>
                    <div class="col-xs-8">
                        <input type="text" value="<?= isset($cliente['direccion_aclaracion']) ? $cliente['direccion_aclaracion'] : '' ?>" class="form-control" name="aclDireccion" id="aclDireccion" />
                    </div>
                </div>

                <div class="row">
                    <label class="col-xs-4 control-label">Localidad</label>
                    <div class="col-xs-8 selectContainer">
                        <select class="form-control" name="localidad" id="localidad" required>
                            <?php if (isset($cliente['localidad'])&&$cliente['idZona']==$_SESSION['zona']) { ?>
                            <option selected="selected" value="<?= $cliente['localidad']['idLocalidad'] ?>"><?= $cliente['localidad']['nombre'] ?></option>
                            <?php } ?>
                            <?php print_r($localidades); ?>
                            <?php foreach ($localidades as $localidad) { ?>
                                <option value="<?= $localidad['idLocalidad'] ?>"><?= $localidad['nombre'] ?></option>
                            <?php } ?>
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


        obtenerCarrito();
        agregarCambio();

        var lastScrollTop = 0;
        var indice = 1;
        $(window).on("scroll", function () {

            var headerHeight = $('#inicio')[0].clientHeight;
            var carritoHeight = $("#divCarrito")[0].clientHeight;
            var carritoTop = $("#divCarrito")[0].offsetTop;
            var footerHeight = $('footer')[0].clientHeight;

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
