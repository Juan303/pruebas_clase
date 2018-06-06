<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

$titulo = "Últimos productos añadidos";
if(isset($_POST['buscar'])){
    $productos = buscar($conexion, 'productos', 'nombre', $_POST['texto']);
    $titulo = "Buscando: <i>".$_POST['texto']."...</i>";
}
else if (isset($_GET['categoria'])) {
    $titulo = nombre_categoria($conexion, $_GET['categoria']);
    if(isset($_POST['ordenar'])){
        $productos = list_productos($conexion, $_POST['orden'], $_POST['tipo'], $_GET['categoria']);
    }
    else{
        $productos = list_productos($conexion, 'fecha', "ASC",  $_GET['categoria']);
    }
}
else if(isset($_POST['ordenar'])){
    $productos = list_productos($conexion, $_POST['orden'], $_POST['tipo'], "todos"); 
}
else{
    $productos = list_productos($conexion, 'fecha', "ASC", "todos");
}
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
        </div>


        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1><?=$titulo;?></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-8">
                    <?php include 'plantillas/plantilla_nav_categorias.php' ?>
                </div>
            
                <div class="col-4">
                   <?php include "plantillas/plantilla_buscador.php" ?>
                </div>
            </div>
            <div class="row">
            <?php 
                while($producto = mysqli_fetch_array($productos)){ 
            ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card mb-2">
                        <img class="card-img-top img-fluid" src="<?=$producto['imagen'];?>" alt="Card image cap">
                        <div class="card-body bg-light">
                            <h5 class="card-title"><?=$producto['nombre'];?> <small class="text-muted font-italic">(<?=nombre_categoria($conexion,$producto['id_categoria']);?>)</small></h5>
                            <p class="card-text"><?=$producto['descripcion_corta'];?></p>
                            <a href="#" class="btn btn-primary">Detalles...</a>
                            <h5 class="float-right text-success"><?=$producto['precio'];?>€</h5>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="container-fluid">
            <?php include "plantillas/plantilla_pie.php";?>
        </div>
        <?php include "plantillas/plantilla_scripts.php";?>
    </body>

    </html>