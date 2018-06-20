<?php
require_once "carrito.php";
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
    $pass = crypt($pass, 'rl');
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    print_r(mysqli_error($conexion));
    if ($consulta->num_rows > 0) {
        $row = mysqli_fetch_array($consulta);
        if ($pass == $row['pass'] && $row['estado'] != 'desactivada') {
            $_SESSION['email'] = $row['email'];
            $_SESSION['usuario'] = $row['usuario'];
            return true;
        }
    }
    return false;
}
function insertar_usuario($conexion, $array, $codigo)
{
    //extraigo el mail para comprobar si esta en la base de datos
    $email = $_POST['email_r'];
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    //si la consulta nos da 0 resultados entonces procedemos a insertar el nuevo usuario
    if ($consulta->num_rows == 0) {
        $usuario = $array['usuario_r'];
        $nombre = $array['nombre'];
        $apellidos = $array['apellidos'];
        $pass = crypt($array['pass_r'], 'rl');
        $consulta = mysqli_query($conexion, "INSERT INTO `usuarios` (`id`, `email`, `pass`, `usuario`, `nombre`, `apellidos`, `codigo_activacion`, `estado`) VALUES (NULL, '$email', '$pass', '$usuario', '$nombre', '$apellidos', '$codigo', 'desactivada');");
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
        $pass_nueva = crypt($pass_nueva, 'rl');
        $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
        $registro = mysqli_fetch_array($consulta);
        if($registro['pass'] == crypt($pass_antigua, 'rl')){
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

function editar_producto($conexion, $array, $id){
    $nombre = $array['nombre'];
    $id_categoria = $array['categoria'];
    $consulta = mysqli_query($conexion, "SELECT * FROM productos WHERE id_categoria = '$id_categoria' AND nombre = '$nombre'");
    $registro = extraer_registro($conexion, 'productos', $id);
    //si la consulta nos da 0 resultados entonces procedemos a insertar el nuevo usuario
    if ($consulta->num_rows == 0 || $registro['nombre']==$array['nombre']) {
        $descripcion_corta = $array['descripcion_corta'];
        $precio = $array['precio'];
        $descripcion = $array['descripcion'];
        $visibilidad = $array['visibilidad'];
        $consulta = mysqli_query($conexion, "UPDATE `productos` SET `visibilidad` = '$visibilidad', `id_categoria` = '$id_categoria', `nombre` = '$nombre',`descripcion_corta` = '$descripcion_corta',`descripcion` = '$descripcion',`precio` = '$precio' WHERE `productos`.`id` = '$id'");
        echo mysqli_error($conexion);
        if ($consulta) {
            return "Modificacion correcta";
        } else {
            return "Fallo en la BD. prueba mas tarde";
        }
    } else {
        return "Ya existe el producto [".$nombre."] en la categoria ".(nombre_categoria($conexion, $id_categoria))."!";
    }

}
function registrar_producto($conexion, $array)
{
    $nombre = $array['nombre'];
    $id_categoria = $array['categoria'];
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
        return "Ya existe el producto [" . $nombre . "] en la categoria " . (nombre_categoria($conexion, $id_categoria)) . "!";
    }

}
//=============================================================================================================PEDIDOS

function registrar_pedido($conexion, $carrito, $mail_cliente){
    $registro = extraer_usuario($conexion, $mail_cliente);
    $id_cliente = $registro['id'];
    $total = total_carrito($carrito);
    $consulta = mysqli_query($conexion, "INSERT INTO `pedidos` (`id`, `id_cliente`, `fecha`, `total`) VALUES (NULL, '$id_cliente', CURRENT_TIMESTAMP, '$total');");
    if($consulta == false){
        return "<div class='alert alert-success'>Error al registrar el pedido</div>";
    }
    $id_pedido = mysqli_insert_id($conexion);
    foreach($carrito as $indice => $valor){
        $id_producto = $valor['id'];
        $cantidad = $valor['cantidad'];
        $consulta = mysqli_query($conexion, "INSERT INTO `pedidos_productos` (`id`, `id_pedido`, `id_producto`, `cantidad`) VALUES (NULL, '$id_pedido', '$id_producto', '$cantidad');");
        if($consulta == false){
            return "<div class='alert alert-success'>Error al registrar el pedido</div>";
        }
    }
    return "<div class='alert alert-success'>Pedido registrado satisfactoriamente</div>";

}
function pedidos_cliente($conexion, $email){
    $registro = extraer_usuario($conexion, $email);
    $id_usuario = $registro['id'];
    $consulta = mysqli_query($conexion, "SELECT * FROM pedidos WHERE id_cliente = '$id_usuario'");
    return $consulta;
}
function total_pedido($conexion, $id_pedido){
    $consulta = mysqli_query($conexion, "SELECT SUM(P.precio) FROM productos P, pedidos_productos PP WHERE PP.id_pedido = '$id_pedido' AND P.id = PP.id_producto");
    $total = mysqli_fetch_array($consulta);
    return $total[0];
}
function productos_pedido($conexion, $id_pedido){
    $consulta = mysqli_query($conexion, "SELECT PP.precio AS precio_producto_pedido, PP.cantidad, PP.id AS id_pedido_producto, P.id, P.nombre, P.precio AS precio_producto FROM pedidos_productos PP, productos P WHERE PP.id_pedido = '$id_pedido' AND P.id = PP.id_producto");
    return $consulta;
}
function pedido_pagado($conexion, $id_pedido){
    $consulta = mysqli_query($conexion, "SELECT pagado FROM pedidos WHERE id='$id_pedido'");
    $registro = mysqli_fetch_array($consulta);
    if($registro['pagado'] == 'si'){
        return true;
    }
    return false;
}
function precio_producto($conexion, $id_producto){
    $consulta = mysqli_query($conexion, "SELECT precio FROM productos WHERE id = '$id_producto'");
    $producto = mysqli_fetch_array($consulta);
    return $producto['precio'];
}
function cambiar_estado_pedido($conexion, $id_pedido, $estado){
    $total_pedido = total_pedido($conexion, $id_pedido);
    $consulta = mysqli_query($conexion, "UPDATE pedidos SET pagado = '$estado', total = '$total_pedido'  WHERE id = '$id_pedido'");
    $productos = productos_pedido($conexion, $id_pedido);
    while($producto = mysqli_fetch_array($productos)){
        $id_pedido_producto = $producto['id_pedido_producto'];
        $precio_producto = $producto['precio_producto'];
        $consulta = mysqli_query($conexion, "UPDATE pedidos_productos SET precio = '$precio_producto' WHERE id = '$id_pedido_producto' ");
    }
    if($consulta){
        return "Estado del pedido cambiado";
    }
}

//=============================================================================================================BUSCAR
function buscar($conexion, $tabla, $campo, $cadena){
    $consulta = mysqli_query($conexion, "SELECT * FROM $tabla WHERE $campo LIKE '%$cadena%'");
    return $consulta;
}

//=============================================================================================================GENERALES

function list_registros($conexion, $tabla, $orden, $tipo, $id_categoria)
{
    if ($id_categoria != "todos") {
        $sql = "SELECT * FROM $tabla WHERE id_categoria = '$id_categoria' ORDER BY $orden $tipo";
    } else {
        $sql = "SELECT * FROM $tabla ORDER BY $orden $tipo";
    }
    $consulta = mysqli_query($conexion, $sql);
    return $consulta;
}

function eliminar_registro($conexion, $id, $tabla)
{
    $consulta = mysqli_query($conexion, "DELETE FROM $tabla WHERE id = '$id'");
    if ($consulta) {
        return "<div class='alert alert-success' role='alert'>Registro eliminado con exito</div>";

    }
    return "<div class='alert alert-warning' role='alert'>Ha habido problemas para eliminar el registro</div>";
}
function extraer_registro($conexion, $tabla, $id){
    $consulta = mysqli_query($conexion, "SELECT * FROM $tabla WHERE id = '$id'");
    $registro = mysqli_fetch_array($consulta);
    return $registro;
}
//===============================================================================================================ACTIVAR CUENTA
function activar_cuenta($conexion, $codigo, $email){
    $consulta = mysqli_query($conexion, "SELECT * FROM usuarios WHERE email = '$email'");
    $registro = mysqli_fetch_array($consulta);
    if($registro['codigo_activacion'] == $codigo){
        $consulta = mysqli_query($conexion, "UPDATE usuarios SET estado = 'activada' WHERE email = '$email'");
        if($consulta){
            return "<div class='alert alert-success'>Cuenta activada</div>";
        }
        else{
            return "<div class='alert alert-danger'>Error al activar la cuenta</div>";
        }
    }
    else{
        return "<div class='alert alert-danger'>Codigo de activacion incorrecto</div>";
    }


}
