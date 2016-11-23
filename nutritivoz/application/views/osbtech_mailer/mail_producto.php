<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>SiMEP OEE</title>
    </head>
    <body style="background:#EEE;" bgcolor="#EEE" >
        <?php echo validation_errors(); ?>
        <?php echo form_open('administrador/enviar_email_osb/', 'role="form" class="form-horizontal"'); ?> 
        <table>
            <tr>
                <td>Nombre</td>
                <td><input type="text" required="required" name="nombre"/></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="email" required="required" name="email"/></td>
            </tr>
            <tr>
                <td>Mensaje</td>
                <td><textarea rows="4" cols="30" name="mensaje"></textarea></td>
            </tr>
            <tr>
                <td>firma</td>
                <td><input type="text" required="required" name="firma"/></td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="enviar" />
                </td>
            </tr>
        </table>
        </form>
    </body>
</html>