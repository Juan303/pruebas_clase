<?php
    session_start();
    include "database/conexion_bd.php";
    include "librerias/consultas_bd.php";
    $titulo = "Mis pedidos";
    $mensaje = "";
    if(isset($_SESSION['email'])){
        $consulta = pedidos_cliente($conexion, $_SESSION['email']);
        
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

                    <div class="col-12">
                        <h2><?=$titulo;?></h2>
                        <?=$mensaje;?>
                        
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Pagado</th>
                                    <th scope="col">Detalles</th>
                                </tr>
                            </thead>
                            <?php
                                while ($row = mysqli_fetch_array($consulta)) { ?>
                                <tr>
                                    <td><?=$row['id'];?></td>
                                    <td><?=$row['fecha'];?></td>
                                    <td><?php
                                        if (!pedido_pagado($conexion, $row['id'])) {
                                            print_r(total_pedido($conexion, $row['id']));
                                        } else {
                                            echo $row['total'];
                                        }?>
                                        €
                                    </td>
                                    <td><?=$row['pagado'];?></td>
                                    <td><a class='btn btn-danger' href='detalles_pedido.php?id_pedido=<?=$row['id'];?>'>Detalles</a></td>
                                </tr>
                                <?php } ?>
                            
                        </table>
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
<?php }  else { ?>
<p>Acceso denegado</p>
<?php } ?>