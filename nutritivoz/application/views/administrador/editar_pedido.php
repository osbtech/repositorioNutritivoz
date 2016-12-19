<div class="row">
    <!-- productos -->
    <div class="col-md-9">
        <div class="center">
            <div class="pricelist-box">
                <a href="<?= base_url_control() ?>administrador/listado_pedidos">Volver a listado de pedidos</a>
                <h2>Edición de pedido<br/></h2>                
                <?php
                foreach ($categorias as $categoria) {
                    ?>
                    <table class='table table-striped table-condensed'>
                        <thead class='thead-inverse'><tr><th><?= $categoria['nombre'] ?></th><th>Productor</th><th>Unidad</th><th>Precio ($)</th><th align='right'>Pedido</th></tr></thead>
                        <tbody>
                            <?php
                            foreach ($categoria['productos'] as $productos) {
                                foreach ($productos as $producto) {
                                    // echo $producto['nombre'];
                                    ?>
                                    <tr><td scope='row'><?= $producto['nombre'] ?></td><td><?= $producto['marca'] ?></td><td><?= $producto['unidad'] ?></td><td><?= $producto['precio'] ?></td><td><input id="<?= $producto['idProducto'] ?>" data-idProducto="<?= $producto['idProducto'] ?>" class="form-control myspin rinput" type="number" value="" min="0" max="10" /></td></tr>
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
    <div class="col-md-3" id="divCarrito" >
        <div class="carrito">
            <div class="row" id="tituloCarrito">
                Tu pedido
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
            <hr>
            <?php echo validation_errors(); ?>
            <?php echo form_open('administrador/editar_pedido/' . $pedido['idPedido'], 'role="form"'); ?>
            <input type="hidden" name="idPedido" value="<?= $pedido['idPedido'] ?>"/>
            <!--campos a ingresar-->
            <div class="row">
                <label class="col-xs-4 col-md-4 control-label">Correo</label>
                <div class="col-xs-8">
                    <input type="email" class="form-control" value="<?= $pedido['correo'] ?>" readonly="readonly" name="correo" id="correo" required />
                </div>
            </div>
            <div class="row">
                <label class="col-xs-4 col-md-4 control-label">Nombre</label>
                <div class="col-xs-8">
                    <input type="text" value="<?= $pedido['nombre'] ?>" class="form-control" name="nombre" id="correo" required />
                </div>
            </div>            
            <div class="row">
                <label class="col-xs-4 control-label">Celular</label>
                <div class="col-xs-8">
                    <input type="text" value="<?= $pedido['celular'] ?>" class="form-control" name="celular" id="celular" required />
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 control-label">Dirección</label>
                <div class="col-xs-8">
                    <input type="text" value="<?= $pedido['direccion'] ?>" class="form-control" name="direccion" id="direccion" required />
                </div>
            </div>
            <div class="row">
                <label class="col-xs-4 control-label">Esquina 1</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" value="<?= $pedido['esquina1'] ?>"  name="esquina1" id="direccion" required />
                </div>
            </div>
            <div class="row">
                <label class="col-xs-4 control-label">Esquina 2</label>
                <div class="col-xs-8">
                    <input type="text" class="form-control" value="<?= $pedido['esquina2'] ?>" name="esquina2" id="direccion" required />
                </div>
            </div>
            <div class="row">
                <label class="col-xs-4 control-label">Aclaración dir.</label>
                <div class="col-xs-8">
                    <input type="text" value="<?= $pedido['aclaracion'] ?>" class="form-control" name="aclDireccion" id="aclDireccion" />
                </div>
            </div>

            <div class="row">
                <label class="col-xs-4 control-label">Zona</label>
                <div class="col-xs-8 selectContainer">
                        <select class="form-control" name="localidad" id="localidad" required>
                            <?php foreach ($localidades as $localidad) { ?>
                            <?php if ($pedido['idLocalidad'] == $localidad['idLocalidad'] ) { ?>
                             <option  selected="selected" value="<?= $localidad['idLocalidad'] ?>"><?= $localidad['nombre'] ?></option>
                            <?php }else{ ?>
                             <option value="<?= $localidad['idLocalidad'] ?>"><?= $localidad['nombre'] ?></option>
                            <?php } }?>
                        </select>
                </div>
            </div>

            <div class="row" style="display:none;">
                <label class="col-xs-4 control-label">Horario</label>
                <div class="col-xs-8 selectContainer">
                    <select class="form-control" name="horario" id="horario">                        
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
                    <textarea name="notas" class="form-control" rows="3" id="notas"><?= $pedido['nota'] ?></textarea>
                </div>	
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <button type="submit" class="btn btn-success btn-md btn-block">Grabar</button>
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
        agregarCambio();
        // scrollCarrito();
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
</script>
