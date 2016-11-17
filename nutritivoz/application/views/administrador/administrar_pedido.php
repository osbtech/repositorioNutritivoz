<?php echo form_open('administrador/administrar_pedido/' . $idPedido, 'role="form" class="form-horizontal"'); ?>
<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title"><h3>Administrar pedido <a href="<?= base_url_control() ?>administrador/listado_pedidos">Volver a listado de pedidos</a></h3></div>
    </div>
    <div class="panel-body">
        <?php echo validation_errors(); ?>

        <input type="hidden" name="idPedido" value="<?= $idPedido ?>">
        <div class="form-group">

            <label for="fecha_realizacion" class="col-sm-2 control-label">fecha_realizacion</label>
            <div class="col-sm-4">
                <input type='text' value="<?= $pedido['fecha_realizacion'] ?>" class="form-control" id='fecha_realizacion' name="fecha_realizacion" />
            </div>            
            <label for="fecha_entrega_estimada" class="col-sm-2 control-label">fecha_entrega_estimada</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['fecha_entrega_estimada'] ?>" id="fecha_entrega_estimada" name="fecha_entrega_estimada">
            </div>
        </div>

        <div class="form-group">
            <label for="fecha_entrega" class="col-sm-2 control-label">fecha_entrega</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['fecha_entrega'] ?>" id="fecha_entrega" name="fecha_entrega">
            </div>
            <label for="idCliente" class="col-sm-2 control-label">idCliente</label>
            <div class="col-sm-4">
                <select name="idCliente" class="form-control">
                    <?php foreach ($clientes as $cliente) { ?>
                        <option <?php if ($cliente['idCliente'] == $pedido['idCliente']) echo 'selected'; ?> value="<?= $cliente['idCliente'] ?>"><?= $cliente['nombre'] ?></option>                                              
                    <?php } ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="zona" class="col-sm-2 control-label">zona</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['zona'] ?>" id="zona" name="zona">
            </div>
            <label for="direccion" class="col-sm-2 control-label">direccion</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['direccion'] ?>" id="direccion" name="direccion">
            </div>
        </div>  

        <div class="form-group">
            <label for="direccion_aclaracion" class="col-sm-2 control-label">direccion_aclaracion</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['direccion_aclaracion'] ?>" id="direccion_aclaracion" name="direccion_aclaracion">
            </div>
            <label for="esquina1" class="col-sm-2 control-label">esquina1</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['esquina1'] ?>" id="esquina1" name="esquina1">
            </div>
        </div>  
        <div class="form-group">
            <label for="esquina2" class="col-sm-2 control-label">esquina2</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['esquina2'] ?>" id="esquina2" name="esquina2">
            </div>
            <label for="nota_cliente" class="col-sm-2 control-label">nota_cliente</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['nota_cliente'] ?>" id="nota_cliente" name="nota_cliente">
            </div>
        </div>  
        <div class="form-group">
            <label for="nota_postventa" class="col-sm-2 control-label">nota_postventa</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['nota_postventa'] ?>" id="nota_postventa" name="nota_postventa">
            </div>
            <label for="estado" class="col-sm-2 control-label">estado</label>
            <div class="col-sm-4">
                <select name="estado" class="form-control">
                    <option <?php if ($pedido['estado'] == 'INICIADO') echo 'selected'; ?> value="INICIADO">INICIADO</option>
                    <option <?php if ($pedido['estado'] == 'CONFIRMADO') echo 'selected'; ?> value="CONFIRMADO">CONFIRMADO</option>
                    <option <?php if ($pedido['estado'] == 'ENTREGADO') echo 'selected'; ?> value="ENTREGADO">ENTREGADO</option>
                    <option <?php if ($pedido['estado'] == 'CANCELADO') echo 'selected'; ?> value="CANCELADO">CANCELADO</option>                                             
                </select>
            </div>
        </div>  
        <div class="form-group">
            <label for="costo_envio" class="col-sm-2 control-label">costo_envio</label>
            <div class="col-sm-4">
                <input type="text" class="form-control" value="<?= $pedido['costo_envio'] ?>" id="costo_envio" name="costo_envio">
            </div>
            <div class="col-lg-6"></div>
        </div>  

        <div class="form-group">
            <div class="col-lg-2"></div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-success btn-md btn-block">Enviar</button>
            </div>	
        </div>

    </div>
</div>


<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title">Detalles</div>
    </div>
    <div class="panel-body">
        <div class="form-group">
            <div class="col-sm-3">Producto</div>
            <div class="col-sm-2">Cantidad</div>
            <div class="col-sm-2">Precio</div>
            <div class="col-sm-2">Cantidad Entregada</div>
            <div class="col-sm-2">Cantidad Proveedor</div>            
        </div>
        <?php foreach ($detalles as $detalle) { ?>
            <div class="form-group">
                <input type="hidden" name="idProducto[]" value="<?= $detalle['idProducto'] ?>"/>
                <div class="col-sm-3"><input type="text" class="form-control" readonly="readonly" name="nombre[]" value="<?= $detalle['nombre'] ?>" /></div>
                <div class="col-sm-2"><input type="text" class="form-control"  name="cantidad[]" value="<?= $detalle['cantidad'] ?>" /></div>
                <div class="col-sm-2"><input type="text" class="form-control"  name="precio[]" value="<?= $detalle['precio'] ?>" /></div>
                <div class="col-sm-2"><input type="text" class="form-control"  name="cantidad_entregada[]" value="<?= $detalle['cantidad_entregada'] ?>" /></div>
                <div class="col-sm-2"><input type="text" class="form-control"  name="cantidad_proveedor[]" value="<?= $detalle['cantidad_proveedor'] ?>" /></div>                
            </div>
        <?php } ?>
    </div>
</div>
</form>
<script type="text/javascript">
    $(function () {
        $('#fecha_realizacion').datetimepicker();
        $('#fecha_entrega_estimada').datetimepicker();
        $('#fecha_entrega').datetimepicker();
    });
</script>