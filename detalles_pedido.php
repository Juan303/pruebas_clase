<?php
    session_start();
    include "database/conexion_bd.php";
    include "librerias/consultas_bd.php";
    
    $mensaje = "";
    if($_SESSION['email']){
        if($_GET['id_pedido']){
            $consulta = productos_pedido($conexion, $_GET['id_pedido']);
            $pagado = pedido_pagado($conexion, $_GET['id_pedido']);
            $titulo = "Pedidos ".$_GET['id_pedido'];
        
?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Detalles pedido</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
                <div class="row">

                    <div class="col-12">
                      
                        <h2><?=$titulo;if($pagado){ echo " (Pagado)";}else{ echo " (Pendiente)";} ?></h2>
                        <div class="row">
                            <div class="col-4">
                                <?php include "plantillas/plantilla_buscador_pedidos.php"?>
                            </div>
                        </div>
                        
                        <?=$mensaje;?>
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <?php
                                while ($row = mysqli_fetch_array($consulta)) { ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$row['nombre'];?></td>
                                        <td><?=$row['cantidad'];?></td>
                                        <td><?=$row['precio'];?></td>
                                    </tr>
                                   
                             <?php } ?>
                            
                        </table>
                        <a class="btn btn-success" href="registrar_producto.php">Registrar producto</a>
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
    <?php }} ?>