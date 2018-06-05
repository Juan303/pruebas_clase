<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Productos</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <?php 
                            $titulo = "Ultimos productos añadidos";
                            if(isset($_GET['categoria'])){
                                $titulo = nombre_categoria($conexion, $_GET['categoria']);
                            }
                        ?>
                        <h1><?=$titulo;?></h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <?php include 'plantillas/plantilla_nav_categorias.php' ?>
                    </div>
                   
                </div>
                <div class="row">
                <?php 
                    $id_categoria = "todos";
                    if(isset($_GET['categoria'])){
                        $id_categoria = $_GET['categoria'];
                    }
                    $productos = list_productos($conexion, 'fecha', $id_categoria);
                    while($producto = mysqli_fetch_array($productos)){ 
                ?>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="<?=$producto['imagen'];?>" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title"><?=$producto['nombre'];?></h5>
                                <p class="card-text"><?=$producto['descripcion_corta'];?></p>
                                <a href="#" class="btn btn-primary">Detalles...</a>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="container-fluid">
                <?php include "plantillas/plantilla_pie.php";?>
            </div>
        </div>
        <?php include "plantillas/plantilla_scripts.php";?>
    </body>

    </html>