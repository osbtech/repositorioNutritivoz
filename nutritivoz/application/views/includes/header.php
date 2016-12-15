<!--body-->
<body>

    <!--middle-header-->

    <div class="middle-header" id="inicio">

        <div class="row">
            <div class="container">
                <div class="col-md-4">
                    <div class="middle-header-content">
                        <div class="middle-header-img"><a href="http://nutritivoz.com"><img src="<?= asset_url(); ?>img/nutritivoz-header-title.svg" alt="" /></a></div>
                        <div class="middle-header-title">Alimentaci&oacute;n saludable para todos</div>
                    </div>
                </div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                  <?php      
                    if (isset($_SESSION['zona'])) {
                         $zonaActual = ObtenerZonaAndHorarios($_SESSION['zona']);                       
                         $this->load->view('includesZonas/'+ $zonaActual['include']  );
                    }else {
                         $this->load->view('includesZonas/zonaDefault'  );
                    }
                    ?>
                </div>
                        <a href='<?= base_url_control() ?>zona/zonas'>Cambiar Zona</a>
            </div>
        </div>
    </div>
    <div  class="contact"></div>


 