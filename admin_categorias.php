<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Admin: Categorias</title>
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
                                    $mensaje_eliminar = eliminar_registro($conexion, $id, "categorias");
                                } else {
                                    $mensaje_eliminar = "solo puedes eliminar siendo administrador";
                                }
                            }
                            ?>
                        <h2>Categorias Registradas</h2>
                        <p>
                            <?=$mensaje_eliminar;?>
                        </p>
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <?php
                               
                                $res = list_categorias($conexion);
                                while ($row = mysqli_fetch_array($res)) {
                                    echo "<tr>
                                                <td>" . $row['id'] . "</td>
                                                <td>" . $row['nombre'] . "</td>
                                                <td>" . $row['descripcion'] . "</td>
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