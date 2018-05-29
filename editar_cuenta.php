<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
if(isset($_SESSION['email'])){ 
    $registro = extraer_usuario($conexion, $_SESSION['email']);
?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Edicion de datos de usuario</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <?php
                                $mensaje = "";
                                if(isset($_POST['usuario_e'])){
                                   $mensaje = modificar_usuario($conexion, $_POST, $_SESSION['email']);
                                   $registro = extraer_usuario($conexion, $_SESSION['email']);
                                }
                            ?>
                            <h2>Edicion de datos de <?=$registro['usuario'];?></h2>
                            <p>
                                <?=$mensaje;?>
                            </p>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="usuario_r">Usuario</label>
                                    <input type="text" value="<?=$registro['usuario'];?>" class="form-control" id="usuario_e" placeholder="Nombre de usuario..." name="usuario_e">
                                </div>
                                 <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" value="<?=$registro['nombre'];?>" class="form-control" id="nombre" placeholder="Nombre de usuario..." name="nombre">
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Apellidos</label>
                                    <input type="text" value="<?=$registro['apellidos'];?>" class="form-control" id="apellidos" placeholder="Nombre de usuario..." name="apellidos">
                                </div>
                                <div class="form-group">
                                    <label for="pass_r">Contraseña anterior</label>
                                    <input type="password" class="form-control" id="pass_e" placeholder="Contraseña..." name="pass_e">
                                </div>
                                <div class="form-group">
                                    <label for="pass_r">Nueva contraseña</label>
                                    <input type="password" class="form-control" id="pass" placeholder="Contraseña..." name="pass">
                                </div>
                                <div class="form-group">
                                    <label for="pass2">Repite la nueva contraseña</label>
                                    <input type="password" class="form-control" id="pass2" placeholder="Repite la contraseña..." name="pass2">
                                </div>
                                <button type="submit" class="btn btn-primary">Guardar cambios</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <?php include "plantillas/plantilla_pie.php";?>
                </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->


        <script src="js/jquery3.3.1.min.js" type="text/javascript"></script>
        <script src="js/pooper.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>



        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    </body>

    </html>


    <?php 
    }else{
        echo "Acceso denegado";
    }
?>