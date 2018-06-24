<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
$n_elementos_pagina = 3;
$titulo = "Últimos productos añadidos";
if(isset($_POST['buscar'])){
    $productos = buscar($conexion, 'productos', 'nombre', $_POST['texto']);
    $titulo = "Buscando: <i>".$_POST['texto']."...</i>";
}
else if (isset($_GET['categoria'])) {
    $titulo = nombre_categoria($conexion, $_GET['categoria']);
    $n_registros = n_elementos_tabla($conexion, 'productos', $_GET['categoria']);
    if(isset($_POST['ordenar'])){
        $productos = list_registros($conexion, 'productos',$_POST['orden'], $_POST['tipo'], $_GET['categoria'], 0, $n_elementos_pagina);
    }
    else if(isset($_GET['lim_inf'])){
        $productos = list_registros($conexion, 'productos', 'fecha', "ASC", $_GET['categoria'], $_GET['lim_inf'], $n_elementos_pagina);
    }
    else{
        $productos = list_registros($conexion, 'productos','fecha', "ASC",  $_GET['categoria'], 0, $n_elementos_pagina);
    }
}
else if(isset($_POST['ordenar'])){
    $productos = list_registros($conexion, 'productos',$_POST['orden'], $_POST['tipo'], "todos", 0, $n_elementos_pagina);
    $n_registros = n_elementos_tabla($conexion, 'productos');
}
else{
    if(isset($_GET['lim_inf'])){
        $productos = list_registros($conexion, 'productos', 'fecha', "ASC", "todos", $_GET['lim_inf'], $n_elementos_pagina);
    }
    else{
        $productos = list_registros($conexion, 'productos', 'fecha', "ASC", "todos", 0, $n_elementos_pagina);
    }
    $n_registros = n_elementos_tabla($conexion,'productos');
}
$n_paginas = intdiv($n_registros, $n_elementos_pagina);

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
                <div class="col-lg-12 col-xl-6">
                    <?php include 'plantillas/plantilla_nav_categorias.php' ?>
                </div>
            
                <div class="col-lg-12 col-xl-6">
                   <?php include "plantillas/plantilla_buscador.php" ?>
                </div>
            </div>
            <div class="row">
            <?php 
                while($producto = mysqli_fetch_array($productos)){
                    if($producto['visibilidad']=='si'){
            ?>
                <div class="col-sm-12 col-md-6 col-lg-4">
                    <div class="card mb-2">
                        <img class="card-img-top img-fluid" src="<?=$producto['imagen'];?>" alt="Card image cap">
                        <div class="card-body bg-light">
                            <h5 class="card-title"><?=$producto['nombre'];?> <small class="text-muted font-italic">(<?=nombre_categoria($conexion,$producto['id_categoria']);?>)</small></h5>
                            <p class="card-text"><?=$producto['descripcion_corta'];?></p>
                            <a href="#" class="btn btn-primary">Detalles...</a>
                            <a href="?agregar_carrito=1&id=<?=$producto['id'];?>" class="btn btn-primary"><i class="material-icons">add_shopping_cart</i></a>
                            <h5 class="float-right text-success"><?=$producto['precio'];?>€</h5>
                        </div>
                    </div>
                </div>
                <?php } }?>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul>
                        <?php

                            for ($i=0; $i<=$n_paginas; $i++){ 
                                $lim_inf = $i*$n_elementos_pagina;
                                if(isset($_GET['categoria'])){ 
                            ?>
                            
                               <li><a href="?categoria=<?=$_GET['categoria'];?>&lim_inf=<?=$lim_inf;?>"><?=($i+1);?></a></li> 
                          <?php  } else { ?>
                                <li><a href="?lim_inf=<?=$lim_inf;?>"><?=($i+1);?></a></li>
                          <?php }} ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <?php include "plantillas/plantilla_pie.php";?>
        </div>
        <?php include "plantillas/plantilla_scripts.php";?>
    </body>

    </html>