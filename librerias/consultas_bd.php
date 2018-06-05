<?php
//====================================================================================================================================USUARIOS
function list_usuarios($conexion)
{
    $sql = "SELECT * FROM usuarios";
    $res = mysqli_query($conexion, $sql);
    return $res;
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
    //extraigo el usuario del formulario
    $usuario = $array['usuario_e'];
    $email = $array['email']; 
    //hago una consulta para saber si ese nombre de usuario esta en la base de datos
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario = '$usuario'");
    $consulta2 = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");

    //extraigo el registro (si no hay registro a extraer $registro será NULL)
    $registro = mysqli_fetch_array($consulta);
    $registro2 = mysqli_fetch_array($consulta2);

    //ahora si el resultado de la consulta da un registro y ademas ese registro no es el del usuario 
    //que esta haciendo la modificacion significará que hay otro usuario que no soy yo con ese nombre de usuario
    if($consulta2->num_rows > 0 && $registro2['email'] != $email_user){
        return "<div class='alert alert-primary' role='alert'>El e-mail elegido ya está en la Base de Datos, porfavor escoja otro.</div>";
    }
    if ($consulta->num_rows > 0 && $registro['email'] != $email_user) {
        return "<div class='alert alert-primary' role='alert'>El nombre de usuario elegido ya está en la Base de Datos, porfavor escoja otro.</div>";
    //en caso contrario dejo insertar el registro
    } else {
        $usuario = $array['usuario_e'];
        $nombre = $array['nombre'];
        $apellidos = $array['apellidos'];
        $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `usuario` = '$usuario', `nombre` = '$nombre', `apellidos` = '$apellidos' WHERE `usuarios`.`email` = '$email_user';");
        if ($consulta) {
            return "<div class='alert alert-success' role='alert'>Datos de usuario modificados correctamente</div>";
        } else {
            return "<div class='alert alert-danger' role='alert'>Fallo al modificar los datos. Prueba de nuevo mas tarde</div>";
        }
    }
} 


function actualizar_pass($conexion, $pass_antigua, $pass_nueva, $pass_nueva_r, $email){
    if($pass_nueva == $pass_nueva_r){
        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
        $registro = mysqli_fetch_array($consulta);
        if($registro['pass'] == $pass_antigua){
            $consulta = mysqli_query($conexion, "UPDATE `usuarios` SET `pass` = '$pass_nueva' WHERE `usuarios`.`email` = '$email'");
            if($consulta){
                return "<div class='alert alert-success' role='alert'>Contraseña cambiada satisfactoriamente</div>";
            }
            else{
                return "<div class='alert alert-danger' role='alert'>No se ha podido cambiar la contraseña: fallo al cambiar la contraseña</div>";
            }
        }
        else{
            return "<div class='alert alert-danger' role='alert'>No se ha podido cambiar la contraseña: contraseña erronea</div>";
        }
    }
    else{
        return "<div class='alert alert-danger' role='alert'>No se ha podido cambiar la contraseña: las contraseñas no coinciden</div>";
    }

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
//=========================================================================================================CATEGORIAS
function nombre_categoria($conexion, $id_categoria){
    $consulta = mysqli_query($conexion, "SELECT nombre FROM categorias WHERE id = '$id_categoria'");
    $categoria = mysqli_fetch_array($consulta);
    return $categoria['nombre'];
}
function list_categorias($conexion)
{
    $sql = "SELECT * FROM categorias";
    $res = mysqli_query($conexion, $sql);
    return $res;
}
//=========================================================================================================PRODUCTOS
function list_productos($conexion, $orden, $tipo, $id_categoria)
{
    if($id_categoria != "todos"){
        $sql = "SELECT * FROM productos WHERE id_categoria = '$id_categoria' ORDER BY $orden $tipo";
    }
    else{
        $sql = "SELECT * FROM productos ORDER BY $orden $tipo";
    }
    $res = mysqli_query($conexion, $sql);
    return $res;
}
function registrar_producto($conexion, $array){
    $nombre = $_POST['nombre'];
    $id_categoria = $_POST['categoria'];
    $consulta = mysqli_query($conexion, "SELECT * FROM productos WHERE id_categoria = '$id_categoria' AND nombre = '$nombre'");
    //si la consulta nos da 0 resultados entonces procedemos a insertar el nuevo usuario
    if ($consulta->num_rows == 0) {
        $descripcion_corta = $array['descripcion_corta'];
        $precio = $array['precio'];
        $descripcion = $array['descripcion'];
        $consulta = mysqli_query($conexion, "INSERT INTO `productos` (`id`, `id_categoria`, `id_imagenes`, `nombre`, `descripcion_corta`, `descripcion`, `precio`, `imagen`) VALUES (NULL, '$id_categoria', 0, '$nombre', '$descripcion_corta', '$descripcion', '$precio', 'imagenes/productos/mando_3.jpg');");
        echo mysqli_error($conexion);
        if ($consulta) {
            return "Registro satisfactorio";
        } else {
            return "Fallo en la BD. prueba mas tarde";
        }
    } else {
        return "Ya existe el producto [".$nombre."] en la categoria ".(nombre_categoria($conexion, $id_categoria))."!";
    }

}

