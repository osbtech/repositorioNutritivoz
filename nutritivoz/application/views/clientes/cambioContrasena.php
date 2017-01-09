
<div class="row" style="height: 800px"></div>

<div id="basic-modal-content">

    <?php if(!isset($cambioExitoso)) { ?>

        <?php if($tokenValido!=null) { ?>

            <div class="row"> 
                <div class="col-xs-10" >
                    <h2 style="line-height:60px">Cambiar contraseña</h2>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 errorMessage" style="margin-bottom:10px;">
                    <?php echo validation_errors(); ?>
                </div>
            </div>

            <div class="modalForm">
                <?php echo form_open("login/cambioClave/".$hash, 'role="form"'); ?>
                    <input type="hidden" value="<?= $hash ?>" name="hash" />
                    <div class="row">
                        <label class="col-xs-4 control-label">Nueva contraseña</label>
                        <div class="col-xs-8">
                            <input type="password" value="" class="form-control" name="contra1" id="contra1" required />
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-xs-4 control-label">Repetir</label>
                        <div class="col-xs-8">
                            <input type="password" value="" class="form-control" name="contra2" id="contra2" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-8"></div>
                        <div class="col-xs-4">
                                <input type="submit" class="form-control btn-lg boton-confirmar" value = "Cambiar" id="btnEnviar" name="enviar"/>
                        </div>
                    </div>
                </form>    
            </div>

        <?php } else { ?>

            <div class="row"> 
                <div class="col-xs-12" >
                    <h2 style="line-height:60px; text-align:center;">No fue posible procesar la solicitud</h2>
                </div>
            </div>
            <div class="row" style = "margin-top: 100px;">
                <div class="col-xs-4"></div>
                <div class="col-xs-4">
                    <a href="/" class="form-control btn-lg boton-confirmar" style="text-align:center;">Ir al sitio</a>
                </div>
            </div>

        <?php } ?>

    <?php } else { ?>


        <div class="row"> 
            <div class="col-xs-12" >
                <h2 style="line-height:60px; text-align:center;">Contraseña cambiada con éxito</h2>
            </div>
        </div>
        <div class="row" style = "margin-top: 100px;">
            <div class="col-xs-4"></div>
            <div class="col-xs-4">
                <a href="/" class="form-control btn-lg boton-confirmar" style="text-align:center;">Ir al sitio</a>
            </div>
        </div>

    <?php } ?>

</div>

<script>
    $('#basic-modal-content').modal();
</script>

