<html>
    <head>
    </head>
    <body>
        <p>
            <?php if (isset($hash)) { ?>
                ¡Muchas gracias por tu pedido! Por favor, revisa el detalle y haz <strong>clic en el botón de abajo para confirmarlo</strong>.
            <?php } else { ?>
                <?= $mensaje ?>
            <?php } ?>
        </p><BR/>
        <p style="font-size:18px;color:#000;line-height:25px;display:block;padding-bottom:5px;border-bottom:1px solid #f6f6f6;margin-bottom:15px;">Datos del comprador:</p>

        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Nombre: </span> <b><?= $nombre ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Dirección: </span> <b><?= $direccion ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Esquina 1: </span> <b><?= $esquina1 ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Esquina 2: </span> <b><?= $esquina2 ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Aclaración dirección: </span> <b><?= $aclDireccion ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Celular: </span> <b><?= $celular ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Zona: </span> <b><?= $zona ?></b></div>
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Día de entrega: </span> <b>Sábado</b></div>
<!--        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Horario: </span> <b><?= $horario ?></b></div> -->
        <div style="margin-bottom:10px"><span style="font-size:13px;color:#464646;">Notas: </span> <b><?= $notas ?></b></div>

    <BR/>                

<p style="font-size:18px;color:#000;line-height:25px;display:block;padding-bottom:5px;border-bottom:1px solid #f6f6f6;margin-bottom:15px;">Detalle del pedido:</p>

<table style="padding-bottom:10px;padding-top:10px; line-height:25px">
<!--    <thead>
        <tr style="border-bottom:1px solid #f6f6f6; font-size:15px; color:#000; font-weight:bold" align="center">
            <td align="left">Producto</td>
            <td align="center">Cant.</td>
            <td align="right">Total</td>
        </tr>
    </thead>  -->
    <?php foreach ($items as $item) { ?>
        <tr align="center">
            <td align="left" width="380px"><b><?= $item['nombre']. "</b> (".$item['unidad'].") ". $item['marca'] ?></td>
            <td width="60px" align="center" valign="top"><?= $item['cantidad'] ?></td>
            <td width="60px" align="right" valign="top">$ <?= $item['cantidad'] * $item['precio'] ?></td>
        </tr>
    <?php } ?>
    <tr style="line-height:10px">
        <td style="border-bottom:5px solid #f6f6f6">&nbsp;</td>
        <td style="border-bottom:5px solid #f6f6f6">&nbsp;</td>
        <td style="border-bottom:5px solid #f6f6f6">&nbsp;</td>
    </tr>
    <tr>
        <td>Importe de productos</td>
        <td/>
        <td align="right">$ <?= $subtotal ?></td>
    </tr>
    <tr>
        <td>Costo de envío</td>
        <td/>
        <td align="right">$ <?= $envio ?></td>
    </tr>
    <tr style="font-weight:bold">
        <td>Importe total de la compra</td>
        <td/>
        <td align="right">$ <?= $total ?></td>
    </tr>
</table>
<BR/>
<?php if (isset($hash)) { ?>
    <table border= "0" cellpadding= "0" cellspacing= "0" style= "border-collapse: separate !important;border-radius: 3px;background-color: #CC5327">
        <tbody>
            <tr>
                <td align= "center" valign= "middle" style= "font-family: Arial;font-size: 16px;padding: 15px">

                    <a title= "CONFIRMAR PEDIDO" href= "http://nutritivoz.com/tiendabeta/index.php/listado_productos/confirmar_pedido/<?= $hash ?>" target= "_blank" style= "font-weight: bold;letter-spacing: normal;line-height: 100%;text-align: center;text-decoration: none;color: #FFFFFF;display: block;">CONFIRMAR PEDIDO</a>


                </td>
            </tr>
        </tbody>
    </table>                
<?php } ?>

</body>
</html>