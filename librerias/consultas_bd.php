<?php

function list_usuarios($conexion)
{
    $sql = "SELECT * FROM usuarios";
    $res = mysqli_query($conexion, $sql);
    return $res;
}

function insertar_usuario($conexion, $array)
{
    //extraigo el mail para comprobar si esta en la base de datos
    $email = $_POST['email_r'];
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    //si la consulta nos da 0 resultados entonces procedemos a insertar el nuevo usuario
    if ($consulta->num_rows == 0) {
        $usuario = $array['usuario_r'];
        $nombre = $array['nombre'];
        $apellidos = $array['apellidos'];
        $pass = $array['pass_r'];
        $consulta = mysqli_query($conexion, "INSERT INTO `usuarios` (`id`, `email`, `pass`, `usuario`, `nombre`, `apellidos`) VALUES (NULL, '$email', '$pass', '$usuario', '$nombre', '$apellidos');");
        if ($consulta) {
            return "Registro satisfactorio";
        } else {
            return "Fallo en la BD. prueba mas tarde";
        }
    } else {
        return "Ya existe un usuario con ese correo electronico!";
    }
}
function modificar_usuario($conexion, $array, $email_user)
{
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email_user'");
    $registro = mysqli_fetch_array($consulta);
    //compruebo que la contraseña sea igual que la contraseña que hay en la base de datos.
    if ($registro['pass'] == $array['pass_e']) {
        //extraigo el usuario del formulario
        $usuario = $array['usuario_e']; 
        //hago una consulta para saber si ese nombre de usuario esta en la base de datos
        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
        //extraigo el registro (si no hay registro a extraer $registro será NULL)
        $registro = mysqli_fetch_array($consulta);
        //ahora si el resultado de la consulta da un registro y ademas ese registro no es el del usuario 
        //que esta haciendo la modificacion significará que hay otro usuario que no soy yo con ese nombre de usuario
        if ($consulta->num_rows > 0 && $registro['email'] != $email_user) {
            return "El nombre de usuario elegido ya está en la Base de Datos, porfavor escoja otro.";
        //en caso contrario dejo insertar el registro
        } else {
            $pass = $array['pass'];
            $usuario = $array['usuario_e'];
            $nombre = $array['nombre'];
            $apellidos = $array['apellidos'];
            $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `usuario` = '$usuario', `nombre` = '$nombre', `apellidos` = '$apellidos', `pass` = '$pass' WHERE `usuarios`.`email` = '$email_user';");
            if ($consulta) {
                login($conexion, $email_user, $pass);
                header("Location:?mensaje=Datos modificados correctamente");
            } else {
                return "Fallo al modificar los datos. Prueba de nuevo mas tarde";
            }
        }
    } else {
        return "La contraseña no es correcta";
    }
}
function extraer_usuario($conexion, $email)
{
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    $registro = mysqli_fetch_array($consulta);
    return $registro;
}
function login($conexion, $email, $pass)
{
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    print_r(mysqli_error($conexion));
    if ($consulta->num_rows > 0) {
        $row = mysqli_fetch_array($consulta);
        if ($pass == $row['pass']) {
            $_SESSION['email'] = $row['email'];
            $_SESSION['usuario'] = $row['usuario'];
            //header("refresh:0;");
            return true;
        }
    }
    return false;
}
function is_admin($conexion, $email)
{
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    if ($consulta->num_rows > 0) {
        $registro = mysqli_fetch_array($consulta);
        if ($registro['rol'] == 'admin') {
            return true;
        }
    }
    return false;
}
function eliminar_registro($conexion, $id, $tabla)
{
    $consulta = mysqli_query($conexion, "DELETE FROM $tabla WHERE id = '$id'");
    if ($consulta) {
        return "Registro eliminado con exito";

    }
    return "Ha habido problemas para eliminar el registro";
}
