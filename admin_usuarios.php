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
                        if (isset($_GET['eliminar_id'])){
                            if(is_admin($conexion, $_SESSION['email'])){
                                $id = $_GET['eliminar_id'];
                                $mensaje_eliminar = eliminar_registro($conexion, $id, "usuarios");
                            }
                            else{
                                $mensaje_eliminar = "solo puedes eliminar siendo administrador";
                            }
                        }
                        ?>
                                <h2>Usuarios Registrados</h2>
                                <p>
                                    <?=$mensaje_eliminar;?>
                                </p>
                                <table class="table  table-sm table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Editar</th>
                                             <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                <?php
                                $res = list_usuarios($conexion);
                                while($row = mysqli_fetch_array($res)){ ?>
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$row['usuario'];?></td>
                                        <td><?=$row['email'];?></td>
                                        <td><a class="btn btn-sm btn-info" href='editar_usuario_admin?id_usuario=<?=$row['id'];?>'>Editar</a></td>
                                        <td><a class="btn btn-sm btn-danger"href='?eliminar_id=<?=$row['id'];?>'>Eliminar</a></td>
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