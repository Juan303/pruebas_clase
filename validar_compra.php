<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
include "librerias/PHPMailer/config.php";
$mensaje = "";
if(isset($_GET['validar_compra'])){
    if(isset($_SESSION['email'])){
        $mensaje = registrar_pedido($conexion, $_SESSION['carrito'], $_SESSION['email']);
    }
    else{
        header('Location: registro.php');
    }
    
}
?>
<!doctype html>
<html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>
        <title>Realizar Pedido</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                       <?=$mensaje;?>
                       <?php include "plantillas/carrito/plantilla_carrito_comprar.php"; ?>
                        
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