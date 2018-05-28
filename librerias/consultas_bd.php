<?php

function list_usuarios($conexion){
    $sql = "SELECT * FROM usuarios";
    $res = mysqli_query($conexion, $sql);
    return $res;
}

function insertar_usuario($conexion, $array){
    //extraigo el mail para comprobar si esta en la base de datos
    $email = $_POST['email_r'];
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    //si la consulta nos da 0 resultados entonces procedemos a insertar el nuevo usuario
    if($consulta->num_rows == 0){
        $usuario = $array['usuario_r'];
        $pass = $array['pass_r'];
        $consulta = mysqli_query($conexion, "INSERT INTO `usuarios` (`id`, `email`, `pass`, `usuario`) VALUES (NULL, '$email', '$pass', '$usuario');");
        if($consulta){
            return "Registro satisfactorio";
        }
        else{
            return "Fallo en la BD. prueba mas tarde";
        }
    }
    else{
        return "Ya existe un usuario con ese correo electronico!";
    }
}
function login($conexion, $email, $pass){

    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    print_r(mysqli_error($conexion));
    if($consulta->num_rows > 0){
        $row = mysqli_fetch_array($consulta);
        if ($pass == $row['pass']){
            return true;
        }
    }
    return false;
}
function eliminar_registro($conexion, $id, $tabla){
    $consulta = mysqli_query($conexion, "DELETE FROM $tabla WHERE id = '$id'");
    if($consulta){
        return "Registro eliminado con exito";
        
    }
    return "Ha habido problemas para eliminar el registro";
}

?>