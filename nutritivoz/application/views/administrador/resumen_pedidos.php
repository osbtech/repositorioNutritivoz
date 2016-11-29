<div class="content-box-large">
    <div class="panel-heading">
        <div class="panel-title">Lista de pedidos</div>
    </div>
    <div class="panel-body">
        <p><a href="<?= base_url_control() ?>reportes_pdf/pedidos/" target="_blank">Reporte PDF de pedidos confirmados.</a></p>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered" id="example">
            <thead>
                <tr><th>Id</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Esquinas</th>
                    <th>Aclaración</th>
                    <th>Teléfono</th>
                    <th>Importe</th>
                    <th>Notas</th>
                    <th>Estado</th>
                    <th>Zona</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($pedidos as $pedido) {
                    ?>
                    <tr><td><?= $pedido['idPedido'] ?></td>
                        <td><?= $pedido['nombre'] ?></td>
                        <td><?= $pedido['direccion'] ?></td>
                        <td><?= $pedido['esquina1']."<BR/>".$pedido['esquina2'] ?></td>
                        <td><?= $pedido['aclaracion'] ?></td>
                        <td><?= $pedido['celular'] ?></td>
                        <td><?= $pedido['total'] ?></td>
                        <td><?= $pedido['nota'] ?></td>
                        <td><?= $pedido['estado'] ?></td>
                        <td><?= $pedido['zona'] ?></td>
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