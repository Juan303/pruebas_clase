<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
$titulo = "Productos registrados";
if (isset($_POST['buscar'])) {
    $productos = buscar($conexion, 'productos', 'nombre', $_POST['texto']);
    $titulo = "Buscando: <i>" . $_POST['texto'] . "...</i>";
} else if (isset($_GET['categoria'])) {
    $titulo = nombre_categoria($conexion, $_GET['categoria']);
    if (isset($_POST['ordenar'])) {
        $productos = list_productos($conexion, $_POST['orden'], $_POST['tipo'], $_GET['categoria']);
    } else {
        $productos = list_productos($conexion, 'fecha', "ASC", $_GET['categoria']);
    }
} else if (isset($_POST['ordenar'])) {
    $productos = list_productos($conexion, $_POST['orden'], $_POST['tipo'], "todos");
} else {
    $productos = list_productos($conexion, 'fecha', "ASC", "todos");
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
                            <div class="col-8">
                                <?php include 'plantillas/plantilla_nav_categorias.php' ?>
                            </div>
                            <div class="col-4">
                                <?php include "plantillas/plantilla_buscador.php"?>
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
                                        <td></td>
                                        <td><a class='btn btn-warning' data-toggle="modal" data-target="#myModal_<?=$row['id'];?>" href=''>Editar</a></td>
                                        <td><a class='btn btn-danger' href='?eliminar_id=<?=$row['id'];?>'>Eliminar</a></td>
                                    </tr>
                                    <div id="myModal_<?=$row['id'];?>" class="modal fade" role="dialog">
                                        <div class="modal-dialog">
                                            <!-- Modal content-->
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Editar producto #<?=$row['id'];?></h4>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <div class="form-group m-0">
                                                            <label for="nombre">Nombre</label>
                                                            <input type="text" class="form-control" id="nombre" value="<?=$row['nombre'];?>"  name="nombre" placeholder="">
                                                        </div>
                                                        <div class="form-group  m-0">
                                                            <label for="categoria">Categoria</label>
                                                            <select class="custom-select" id="categoria" name="categoria">
                                                            <?php 
                                                                $categorias = list_categorias($conexion);
                                                                while($row_cat = mysqli_fetch_array($categorias)){ ?>
                                                                    <option value="<?=$row_cat['id'];?>"><?=$row_cat['nombre'];?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <label for="descripcion_corta">Descripción corta</label>
                                                            <textarea class="form-control" value="<?=$row['descripcion_corta'];?>" name="descripcion_corta" rows="2" id="descripcion_corta"><?=$row['descripcion_corta'];?></textarea>
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <label for="precio">Precio</label>
                                                            <input type="text" value="<?=$row['precio'];?>" class="form-control" id="precio" placeholder="" name="precio">
                                                        </div>
                                                        <div class="form-group m-0">
                                                            <label for="descripcion_corta">Descripción</label>
                                                            <textarea class="form-control" value="<?=$row['descripcion'];?>" name="descripcion" rows="10" id="descripcion"><?=$row['descripcion'];?></textarea>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary" name="editar">Editar</button>
                                                        <button type="reset" class="btn btn-warning">Restablecer</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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