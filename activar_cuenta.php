<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
$mensaje = "";

if (isset($_GET['email']) && isset($_GET['codigo'])) {
        $mensaje = activar_cuenta($conexion, $_GET['codigo'], $_GET['email']);
?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Editar Producto</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?=$mensaje;?>
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

<?php } 
?>