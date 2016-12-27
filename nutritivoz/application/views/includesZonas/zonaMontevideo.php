<?php
if (isset($_SESSION['zona'])) {
    $zonaActual = ObtenerZonaAndHorarios($_SESSION['zona']);
    ?>
    <p> 
        <span class="header-text-3">Zona:</span> <span class="header-text-2"><?= $zonaActual['nombre'] ?></span> <span class="header-text-2"><a href="index.php/zona/zonas">Cambiar</a></span><BR/>
        <span class="header-text-1">Envíos a Montevideo y Ciudad de la Costa</span><BR/>
         <span class="header-text-2">Gratis para compras mayores a $ 1000</span>
        
    </p>
    
    
    <span class="header-text-3">Precios vigentes hasta el </span>
    <span class="header-text-2"><?= date_create($zonaActual['fechaProxEntrega'])->format('d/m/Y') ?></span><BR/>
    <span class="header-text-3">Fecha de entrega</span>
    <span class="header-text-2"> <?= date_create($zonaActual['fechaCierrePedidos'])->format('d/m/Y') ?></span>
<?php } ?>