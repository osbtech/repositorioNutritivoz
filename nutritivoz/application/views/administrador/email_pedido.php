<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title"><h3>Enviar pedido <a href="<?= base_url_control() ?>administrador/listado_pedidos">Volver a listado de pedidos</a></h3></div>
    </div>
    <div class="panel-body">
        <?php echo validation_errors(); ?>
        <?php echo form_open('administrador/email_pedido/' . $idPedido, 'role="form" class="form-horizontal"'); ?>
        <input type="hidden" name="idPedido" value="<?= $idPedido ?>">
        <div class="form-group">
            <label for="titulo" class="col-sm-2 control-label">Titulo</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Titulo" value="Detalle de su pedido">
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $correo ?>">
            </div>
        </div>

        <div class="form-group">
            <label for="cemail" class="col-sm-2 control-label">CC</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="cemail" name="cemail" placeholder="CC Email">
            </div>
        </div>
        <div class="form-group">
            <label for="bemail" class="col-sm-2 control-label">BCC</label>
            <div class="col-sm-5">
                <input type="email" class="form-control" id="bemail" name="bemail" placeholder="BCC Email" value="ventas@nutritivoz.com">
            </div>
        </div>
        <div class="form-group">
            <label for="mensaje" class="col-sm-2 control-label">Mensaje</label>
            <div class="col-sm-5">
                <input type="text" class="form-control" id="mensaje" name="mensaje" placeholder="Mensaje" value="A continuación el detalle de su pedido. Quedamos atentos por cualquier consulta.<BR/>Equipo de Nutritívoz.">
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-2"></div>
            <div class="col-lg-2">
                <button type="submit" class="btn btn-success btn-md btn-block">Enviar</button>
            </div>	
        </div>
        </form>
    </div>
</div>
