<?php
    session_start();
    include "database/conexion_bd.php";
    include "librerias/consultas_bd.php";
    $titulo = "Productos registrados";
    $mensaje = "";
    if (isset($_GET['eliminar_id'])) {
        $mensaje = eliminar_registro($conexion, $_GET['eliminar_id'], 'productos');
    }

    if (isset($_GET['categoria'])) {
        $titulo = nombre_categoria($conexion, $_GET['categoria']);
        if (isset($_POST['ordenar'])) {
            $productos = list_registros($conexion, 'productos', $_POST['orden'], $_POST['tipo'], $_GET['categoria']);
        } else {
            $productos = list_registros($conexion, 'productos', 'fecha', "ASC", $_GET['categoria']);
        }
    }
    else if (isset($_POST['buscar'])) {
        $productos = buscar($conexion, 'productos', 'nombre', $_POST['texto']);
        $titulo = "Buscando: <i>" . $_POST['texto'] . "...</i>";
    }else if (isset($_POST['ordenar'])) {
        $productos = list_registros($conexion, 'productos', $_POST['orden'], $_POST['tipo'], "todos");
    } else {
        $productos = list_registros($conexion, 'productos', 'fecha', "ASC", "todos");
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

                    <div class="col-12">
                        <?php
                            $mensaje_eliminar = "";
                            if (isset($_GET['eliminar_id'])) {
                                if (is_admin($conexion, $_SESSION['email'])) {
                                    $id = $_GET['eliminar_id'];
                                    $mensaje_eliminar = eliminar_registro($conexion, $id, 'ASC', "productos");
                                } else {
                                    $mensaje_eliminar = "solo puedes eliminar siendo administrador";
                                }
                            }
                        ?>
                        <h2><?=$titulo;?></h2>
                        <div class="row">
                            <div class="col-lg-12 col-xl-6">
                                <?php include 'plantillas/plantilla_nav_categorias.php' ?>
                            </div>
                        
                            <div class="col-lg-12 col-xl-6">
                            <?php include "plantillas/plantilla_buscador.php" ?>
                            </div>
                        </div>
                        
                        <?=$mensaje;?>
                        
                        <table class="table  table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion corta</th>
                                    <th scope="col">Descripcion larga</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Visibilidad</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <?php
                                while ($row = mysqli_fetch_array($productos)) { ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$row['nombre'];?></td>
                                        <td><?=$row['descripcion_corta'];?></td>
                                        <td><?=$row['descripcion'];?></td>
                                        <td><?=$row['precio'];?></td>
                                        <td><?= $row['fecha'];?></td>
                                        <td><?= $row['visibilidad'];?></td>
                                        <td><a class='btn btn-sm btn-warning' href='editar_producto.php?producto_id=<?=$row['id'];?>'>Editar</a></td>
                                        <td><a class='btn btn-sm btn-danger' href='?eliminar_id=<?=$row['id'];?>'>Eliminar</a></td>
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