<!--body-->
<body>

    <!--middle-header-->

    <div class="middle-header" id="inicio">

        <div class="row">
            <div class="container">
                <div class="col-md-4">
                    <p> <span class="header-text-1">Envíos a Montevideo y Ciudad de la Costa</span><BR/>
                        <span class="header-text-2">Gratis para compras mayores a $ 1000</span>
                        <BR/><BR/>
                        <?php
                        if (isset($_SESSION['zona'])) {
                            $zonaActual = ObtenerZonaAndHorarios($_SESSION['zona']);
                            ?>
                            <span class="header-text-3">Zona</span><BR/>
                            <span class="header-text-2"><?php echo $zonaActual['nombre'] ?></span><BR/>
                            <span class="header-text-3">Precios vigentes hasta el</span><BR/>
                            <span class="header-text-2"><?php echo $zonaActual['fechaProxEntrega'] ?></span><BR/>
                            <span class="header-text-3">Fecha de entrega</span><BR/>
                            <span class="header-text-2"> <?php echo $zonaActual['fechaCierrePedidos'] ?></span>
                            <?php } ?>
                </div>
                <div class="col-md-4">
                    <div class="middle-header-content">
                        <div class="middle-header-img"><a href="http://nutritivoz.com"><img src="<?= asset_url(); ?>img/nutritivoz-header-title.svg" alt="" /></a></div>
                        <div class="middle-header-title">Alimentaci&oacute;n saludable para todos</div>
                    </div>

                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

    </div>


    <div  class="contact">
