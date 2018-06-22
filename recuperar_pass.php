<?php
session_start();
include_once "database/conexion_bd.php";
include_once "librerias/consultas_bd.php";
include_once "librerias/mails.php";
$mensaje = "";
if(isset($_POST['recuperar'])){
    $mensaje = mensaje_recuperar_pass($conexion, $mail, $_POST['email']);
}

if(isset($_POST['renovar'])){
    $mensaje = renovar_pass($conexion, $_POST['pass'], $_POST['r_pass'], $_POST['email']);
}

?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Hello, world!</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>Recuperacion de contraseña</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <?=$mensaje;?>
                        </div>
                    </div>
                    <?php
                        if(isset($_GET['codigo'])){
                            $codigo = $_GET['codigo'];
                            $email = $_GET['email'];
                            if(comprobar_codigo_activacion($conexion, $codigo, $email)){
                    ?>
                               
                     <div class="row">
                        <div class="col-6">
                            <p>Introduce los datos indicados para poder renovar tu contraseña</p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="pass">Contraseña</label>
                                    <input type="password" class="form-control" id="pass" aria-describedby="emailHelp" name="pass" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="r_pass">Repetir contraseña</label>
                                    <input type="password" class="form-control" id="r_pass" aria-describedby="emailHelp" name="r_pass" placeholder="">
                                </div>
                                <input type="hidden" name="email" value="<?=$email;?>">
                                 <button type="submit" name="renovar" class="btn btn-primary">Renovar contraseña</button>
                            </form>
                        </div>
                    </div>              

                    <?php } else { ?>
                    <p>Codigo de activacion incorrecto</p>
                    <?php } } else { ?>
                    <div class="row">
                        <div class="col-6">
                            <p>Introduce tu direccion de correo con la que te registraste para poder enviarte un enlace y puedas generar tu contraseña</p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input type="email" class="form-control" id="email" aria-describedby="emailHelp" name="email" placeholder="Introduce un mail valido...">
                                    <small id="emailHelp" class="form-text text-muted">No compartiremos tu mail con nadie.</small>
                                </div>
                                 <button type="submit" name="recuperar" class="btn btn-primary">Enviar enlace</button>
                            </form>
                        </div>
                    </div>

                    <?php } ?>
                </div>
                <div class="container-fluid">
                    <?php include "plantillas/plantilla_pie.php";?>
                </div>
        </div>

        <?php include "plantillas/plantilla_scripts.php";?>
    </body>

    </html>