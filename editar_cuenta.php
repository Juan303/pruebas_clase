<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
if (isset($_SESSION['email'])) {
    $registro = extraer_usuario($conexion, $_SESSION['email']);
    $mensaje = "";
    if (isset($_GET['mensaje'])) {
        $mensaje = $_GET['mensaje'];
    }
    if (isset($_POST['usuario_e'])) {
        $mensaje = "<p>" . modificar_usuario($conexion, $_POST, $_SESSION['email']) . "</p>";
        $registro = extraer_usuario($conexion, $_SESSION['email']);
        $_SESSION['usuario'] = $registro['usuario']; 
        if (isset($_POST['m_pass'])) {
            $mensaje .= "<p>" . actualizar_pass($conexion, $_POST['pass_e'], $_POST['pass'], $_POST['pass2'], $_SESSION['email']) . "</p>";
        }
    }
?>
    
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Edicion de datos de usuario</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            
                            <h2>Edicion de datos de <?=$registro['usuario'];?></h2>
                            <p>
                                <?=$mensaje;?>
                            </p>
                            <form method="post" action="">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                            <label for="usuario_r">Correo Electronico</label>
                                            <input type="text" value="<?=$registro['email'];?>" class="form-control" id="email" placeholder="Correo electronico..." name="email">
                                        </div>
                                        <div class="form-group">
                                            <label for="usuario_r">Usuario</label>
                                            <input type="text" value="<?=$registro['usuario'];?>" class="form-control" id="usuario_e" placeholder="Nombre de usuario..." name="usuario_e">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Nombre</label>
                                            <input type="text" value="<?=$registro['nombre'];?>" class="form-control" id="nombre" placeholder="Nombre de usuario..." name="nombre">
                                        </div>
                                        <div class="form-group">
                                            <label for="nombre">Apellidos</label>
                                            <input type="text" value="<?=$registro['apellidos'];?>" class="form-control" id="apellidos" placeholder="Nombre de usuario..." name="apellidos">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-check">
                                            <input onchange="toggle_input_pass(this)" class="form-check-input" type="checkbox" id="m_pass" name="m_pass">
                                            <label class="form-check-label" for="gridCheck1">Modificar contraseña</label>
                                        </div>
                                        <div class="form-group">
                                            <label for="pass_r">Contraseña anterior</label>
                                            <input disabled type="password" class="form-control input_pass" id="pass_e" placeholder="Contraseña..." name="pass_e">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass_r">Nueva contraseña</label>
                                            <input disabled type="password" class="form-control input_pass" id="pass" placeholder="Contraseña..." name="pass">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass2">Repite la nueva contraseña</label>
                                            <input disabled type="password" class="form-control input_pass" id="pass2" placeholder="Repite la contraseña..." name="pass2">
                                        </div>
                                    </div>
                                   
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Guardar cambios</button>
                                    </div>
                                </div>
                            </form>
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


    <?php
} else {
    echo "Acceso denegado";
}
?>