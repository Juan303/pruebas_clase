<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

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
                                    $mensaje_eliminar = eliminar_registro($conexion, $id, "productos");
                                } else {
                                    $mensaje_eliminar = "solo puedes eliminar siendo administrador";
                                }
                            }
                        ?>
                        <h2>Productos Registrados</h2>
                        <div class="row">
                            <div class="col-12">
                                <?php include 'plantillas/plantilla_nav_categorias.php' ?>
                            </div>
                        </div>
                        <p>
                            <?=$mensaje_eliminar;?>
                        </p>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion corta</th>
                                    <th scope="col">Descripcion larga</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <?php
                                $id_categoria = "todos";
                                if (isset($_GET['categoria'])) {
                                    $id_categoria = $_GET['categoria'];
                                }
                                $res = list_productos($conexion, 'fecha', $id_categoria);
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>
                                                <td>" . $row['id'] . "</td>
                                                <td>" . $row['nombre'] . "</td>
                                                <td>" . $row['descripcion_corta'] . "</td>
                                                <td>" . $row['descripcion'] . "</td>
                                                <td>" . $row['precio'] . "</td>
                                                <td>" . $row['fecha'] . "</td>
                                                <td><a class='btn btn-warning' href='editar_producto.php?eliminar_id=" . $row['id'] . "'>Editar</a></td>
                                                <td><a class='btn btn-danger' href='?eliminar_id=" . $row['id'] . "'>Eliminar</a></td>
                                            </tr>";
                                }
                            ?>
                            
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