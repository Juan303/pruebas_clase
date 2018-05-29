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
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">Id</th>
                                            <th scope="col">Usuario</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                    <?php
                            $res = list_usuarios($conexion);
                            while($row = mysqli_fetch_array($res)){
                                echo "<tr><td>".$row['id']."</td><td>".$row['usuario']."</td><td>".$row['email']."</td><td><a href='?eliminar_id=".$row['id']."'>Eliminar</a></td></tr>";
                            } 
                        ?>
                                </table>
                        </div>

                    </div>
                </div>
                <div class="container-fluid">
                    <?php include "plantillas/plantilla_pie.php";?>
                </div>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->


        <script src="js/jquery3.3.1.min.js" type="text/javascript"></script>
        <script src="js/pooper.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>



        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    </body>

    </html>