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
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
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
                        <p><?=$error;?></p>
                <?php } else { ?>
                    <p>Bienvenid@ <?=$_SESSION['email'];?></p>
                    <p><a href="?salir=1" class="link-danger">Salir</a></p>
                <?php } ?>
            </div>
        </nav>
        <div class="row">
            <div class="col-12">
                <table>
                    <tr>
                        <td>Id</td>
                        <td>Nombre de usuario</td>
                        <td>E-mail</td>
                    </tr>
                <?php
                    $res = list_usuarios($conexion);
                    while($row = mysqli_fetch_array($res)){
                        echo "<tr><td>".$row['id']."</td><td>".$row['usuario']."</td><td>".$row['email']."</td></tr>";
                    } 
                ?>
                </table>
               
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