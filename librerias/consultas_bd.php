<?php

function list_usuarios($conexion){
    $sql = "SELECT * FROM usuarios";
    $res = mysqli_query($conexion, $sql);
    return $res;
}

function insertar_usuario($conexion, $array){
    //extraigo el mail para comprobar si esta en la base de datos
    $mail = $_POST['mail'];
    $consulta = mysqli_query($conexion, "SELECT * FROM clientes WHERE mail = $mail");
    //si la consulta nos da 0 resultados entonces procedemos a insertar el nuevo usuario
    if($consulta->num_rows == 0){
        $consulta = mysqli_query($conexion, "");
        if($consulta){
            return "";
        }
        else{
            return "";
        }
    }
    else{
        return "";
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

?>