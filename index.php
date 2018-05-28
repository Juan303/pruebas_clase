<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

?>
    <!doctype html>
    <html lang="es">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <title>Hello, world!</title>
    </head>

    <body>
        <div class="container-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="#">Mi WEB</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Inicio <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                        </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link disabled" href="#">Disabled</a>
                        </li>
                    </ul>
                    <?php
                    $error = "";
                    if(isset($_POST['email'])){
                        $email = $_POST['email'];
                        $pass = $_POST['pass'];
                        if(login($conexion, $email, $pass)){
                            $_SESSION['email'] = $_POST['email'];
                        }
                        else{
                            $error = "Nombre de usuario o contraseña incorrectos";
                        }
                    }
                    else if(isset($_GET['salir'])){
                        session_destroy();
                        unset($_SESSION['email']);
                    }
                    if(!isset($_SESSION['email'])) { ?>
                        <form class="form-inline my-2 my-lg-0" method="post" action="">
                            <input class="form-control mr-sm-2" type="text" placeholder="Correo electronico" name="email" aria-label="Email">
                            <input class="form-control mr-sm-2" type="password" placeholder="Contraseña" name="pass" aria-label="pass">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Entrar</button>
                        </form>
                        <p>
                            <?=$error;?>
                        </p>
                        <?php } else { ?>
                            <p>Bienvenid@
                                <?=$_SESSION['email'];?>
                            </p>
                            <p><a href="?salir=1" class="link-danger">Salir</a></p>
                            <?php } ?>
                </div>
            </nav>
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <?php
                    $mensaje = "";
                    if(isset($_POST['email_r'])){
                        $mensaje = insertar_usuario($conexion, $_POST);
                    }
                    ?>
                            <h2>Registro de usuarios</h2>
                            <p>
                                <?=$mensaje;?>
                            </p>
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="email">Correo Electronico</label>
                                    <input type="email" class="form-control" id="email_r" aria-describedby="emailHelp" name="email_r" placeholder="Introduce un mail valido...">
                                    <small id="emailHelp" class="form-text text-muted">No compartiremos tu mail con nadie.</small>
                                </div>
                                <div class="form-group">
                                    <label for="usuario_r">Nombre de Usuario</label>
                                    <input type="password" class="form-control" id="usuario_r" placeholder="Nombre de usuario..." name="usuario_r">
                                </div>
                                <div class="form-group">
                                    <label for="pass_r">Contraseña</label>
                                    <input type="password" class="form-control" id="pass_r" placeholder="Contraseña..." name="pass_r">
                                </div>
                                <div class="form-group">
                                    <label for="pass2">Repite la contraseña</label>
                                    <input type="password" class="form-control" id="pass2" placeholder="Repite la contraseña..." name="pass2">
                                </div>

                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </form>
                    </div>
                    <div class="col-6">
                       <?php
                        $mensaje_eliminar = "";
                        if (isset($_GET['eliminar_id'])){
                            if(isset($_SESSION['email'])){
                                $id = $_GET['eliminar_id'];
                                $mensaje_eliminar = eliminar_registro($conexion, $id, "usuarios");
                            }
                            else{
                                $mensaje_eliminar = "solo puedes eliminar estando logueado";
                            }
                        }
                        ?>
                        <h2>Usuarios Registrados</h2>
                        <p><?=$mensaje_eliminar;?></p>
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
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>

    </html>