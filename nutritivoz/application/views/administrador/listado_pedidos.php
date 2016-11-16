<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title">Lista de pedidos</div>
    </div>
    <div class="panel-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
                <tr><th>Id</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Zona</th>
                    <th>Teléfono</th>
                    <th>Importe</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pedidos as $pedido) {
                    ?>
                    <tr><td><?= $pedido['idPedido'] ?></td>
                        <td><?= $pedido['fecha_realizacion'] ?></td>
                        <td><?= $pedido['nombre'] ?></td>
                        <td><?= $pedido['direccion'] ?></td>
                        <td><?= $pedido['zona'] ?></td>
                        <td><?= $pedido['celular'] ?></td>
                        <td><?= $pedido['total'] ?></td>
                        <td><?= $pedido['estado'] ?></td>
                        <td>
                            <a href="<?= base_url_control() ?>reportes_pdf/pedidos/<?= $pedido['idPedido'] ?>" target="_blank">Ver</a>&nbsp;<a href="<?= base_url_control() ?>administrador/editar_pedido/<?= $pedido['idPedido'] ?>" >Editar</a>&nbsp;<a href="<?= base_url_control() ?>administrador/email_pedido/<?= $pedido['idPedido'] ?>" >Email</a>&nbsp;<a href="<?= base_url_control() ?>administrador/administrar_pedido/<?= $pedido['idPedido'] ?>" >Administrar</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
<script>
    $('#example').dataTable( {
        "aaSorting": [[0, "desc"]],
        "iDisplayLength": 100
    });
</script>