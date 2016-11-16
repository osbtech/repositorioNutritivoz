<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title"><h3>Quitar producto de pedidos<a href="<?= base_url_control() ?>administrador/listado_pedidos">Volver a listado de pedidos</a></h3></div>
    </div>
    <div class="panel-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open('administrador/quitar_prod_pedido/', 'role="form" class="form-horizontal"'); ?>
        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Producto</label>
            <div class="col-sm-5">
                <select name="idProducto" class="form-control">
                    <?php foreach ($productos as $producto) { ?>
                        <option  value="<?= $producto['idProducto'] ?>"><?= $producto['nombre'] ?></option>                                              
                    <?php } ?>
                </select>
            </div>
        </div>        
        <div class="form-group">
            <div class="col-lg-2"></div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-success btn-md btn-block">Quitar</button>
            </div>	
        </div>
        </form>
    </div>

    <?php if (isset($resultado)) { ?>
        <div class="content-box-large">
            <div class="panel-heading">
                <div class="panel-title"><h3>Pedidos afectados</h3></div>
            </div>    
            <div class="panel-body">
                <p>
                    <?php
                    foreach ($resultado as $r) {
                        echo $r['idPedido'].', ';
                    }
                    ?>
                </p>
            </div>
        </div> 
    <?php } ?>
</div>
