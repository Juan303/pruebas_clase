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
            <div class="row justify-content-center">
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
        <input type="text" class="form-control" id="usuario_r" placeholder="Nombre de usuario..." name="usuario_r">
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