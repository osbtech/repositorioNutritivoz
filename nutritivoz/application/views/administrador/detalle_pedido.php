<div class="row">
    <!-- productos -->
    <div class="col-md-12">
        <div class="center">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Detalle Pedido <a href="<?= base_url_control() ?>administrador/listado_pedidos">Volver a listado de pedidos</a></h3>
                </div>
                <div class="panel-body">
                    <?php echo validation_errors(); ?>
                    <?php echo form_open('administrador/detalle_pedido', 'role="form"'); ?>
                    <input type="hidden" name="idPedido" value="<?= $idPedido ?>">
                    <div class="row">
                        <div class="col-md-2">
                            Titulo
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="titulo" id="correo" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            Email
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="email" id="correo" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <button type="submit" class="btn btn-success btn-md btn-block">Enviar</button>
                        </div>	
                    </div>
                    </form>
                </div>
            </div

        </div>
    </div>
</div>
