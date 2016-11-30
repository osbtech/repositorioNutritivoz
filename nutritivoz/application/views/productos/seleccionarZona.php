<div class="row">
    <div class="col-md-12">
        <div class="center">
            <div class="pricelist-box">
                <h2 style="text-align: center;">Por favor elige la zona donde se entregará tu pedido:<br/></h2>
                <div class="row">
                    <div class="col-lg-6" style="text-align: center;margin-top: 15px;margin-bottom: 15px;">
                        <div class="col-lg-12">
                            <img src="<?= asset_url(); ?>img/zona_1.jpeg" alt="" />
                        </div>
                        <div class="col-lg-12">
                            <button  id="btnZona1" class="btn btn-sm boton-agregar" style="margin-top: 10px;" data-zona="1">Montevideo y Ciudad de la Costa</button>
                        </div>
                    </div>
                    <div class="col-lg-6" style="text-align: center;margin-top: 15px;margin-bottom: 15px;">
                        <div class="col-lg-12">
                            <img src="<?= asset_url(); ?>img/zona_2.jpeg" alt="" />
                        </div>
                        <div class="col-lg-12">
                            <button  id="btnZona2" class="btn btn-sm boton-agregar" style="margin-top: 15px;" data-zona="2">Punta del Este y Maldonado</button>
                        </div>
                    </div>
                </div>     
            </div>    
        </div>  
    </div>
</div>

<script>
    $(':button').click(function () {
        if (this.value == '') {
            $.ajax({
                url: '<?= base_url_control() ?>zona/seleccionar_zona',
                type: 'post',
                data: {
                    idZona: $(this).attr("data-zona")
                },
                dataType: 'html',
                success: function (data) {
                  window.location.href = '<?= base_url_control() ?>Listado_productos/listado_productos'; 
                },
                error: function (ex) {
                  
                }
            });
        }
    });

</script>
