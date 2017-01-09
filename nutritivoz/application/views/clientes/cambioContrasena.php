
<?php if(!isset($cambioExitoso)) { ?>

<?php if($tokenValido!=null) { ?>
<div class="row">
    <div class="container">
    <span>
        <?php echo validation_errors(); ?>
    </span>
<label>Cambiar contraseña</label>
<?php echo form_open("login/cambioClave/".$hash, 'role="form"'); ?>
    <input type="hidden" value="<?= $hash ?>" name="hash" />
    <label class="col-xs-4 col-md-4 control-label">Nueva contraseña</label>
    <div class="col-xs-8">
        <input type="password" value="" class="form-control" name="contra1" id="contra1" required />
    </div>
        <label class="col-xs-4 col-md-4 control-label">Confirmar contraseña</label>
    <div class="col-xs-8">
        <input type="password" value="" class="form-control" name="contra2" id="contra2" required />
    </div>
    <div class="col-xs-8">
            <input type="submit" class="form-control" value = "enviar" id="btnEnviar" name="enviar"/>
    </div>
</form>    
</div>
</div>
<?php } else { ?>
<div class="row">
    <div class="container">
        <span>No fue posible procesar la solicitud!</span>
    </div>
</div>
<?php } ?>

<?php } else { ?>

<div class="row">
    <div class="container">
        <span>Contraseña cambiada con exito!</span>
    </div>
</div> 

<?php } ?>

