<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
include "librerias/PHPMailer/config.php";



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
                <div class="row justify-content-center">
                    <div class="col-6">
                        <?php
                        $mensaje = "";
                        if (isset($_POST['email_r'])) {
                            $codigo = crypt(rand(0,10000), 'rl');
                            $mail->AddAddress($_POST['email_r']); // Esta es la dirección a donde enviamos
                            $mail->Subject = "Registro"; // Este es el titulo del email.
                            $mail->Body = "Haz click en el siguiente link para activar tu cuenta <a href='localhost:8000/php/Proyecto_1_BD/activar_cuenta.php?codigo=".$codigo."&email=".$_POST['email_r']."'>ACTIVAR CUENTA</a>"; // Mensaje a enviar.
                            // Envía el correo.
                            if($mail->Send()){
                                $mansaje = "El correo fue enviado correctamente.<br/>";
                                $mensaje .= insertar_usuario($conexion, $_POST, $codigo);
                            }else{ 
                                echo "Hubo un problema. Contacta a un administrador."; 
                            } 
                           
                        }
                        ?>
                        <h2>Registro de usuarios</h2>
                        <p>
                            <?=$mensaje;?>
                        </p>
                        <form method="post" action="">
                            <div class="form-group">
                                <label for="email">Correo Electronico</label>
                                <input type="email" class="form-control" id="email_r" aria-describedby="emailHelp" name="email_r" placeholder="Introduce un mail valido...">
                                <small id="emailHelp" class="form-text text-muted">No compartiremos tu mail con nadie.</small>
                            </div>
                            <div class="form-group">
                                <label for="usuario_r">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="usuario_r" placeholder="Nombre de usuario..." name="usuario_r">
                            </div>
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" placeholder="Nombre..." name="nombre">
                            </div>
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" placeholder="Apellidos..." name="apellidos">
                            </div>
                            <div class="form-group">
                                <label for="pass_r">Contraseña</label>
                                <input type="password" class="form-control" id="pass_r" placeholder="Contraseña..." name="pass_r">
                            </div>
                            <div class="form-group">
                                <label for="pass2">Repite la contraseña</label>
                                <input type="password" class="form-control" id="pass2" placeholder="Repite la contraseña..." name="pass2">
                            </div>

                            <button type="submit" class="btn btn-primary">Registrar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                        <?php include "plantillas/plantilla_pie.php";?>
                    </div>
        </div>

         <?php include "plantillas/plantilla_scripts.php";?>
    </body>

</html>