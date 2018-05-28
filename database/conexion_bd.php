<?php
$conexion = mysqli_connect("localhost", "root", "", "mi_bd");
if (!$conexion) {
    echo "Error " . mysqli_connect_errno() . ": " . mysqli_connect_error();
} else {
    //echo "Conexion exitosa con: ".mysqli_get_host_info($conexion);
    if(!$conexion->set_charset("utf8")){
        echo "Error al cambiar el conjunto de caracteres de la conexion";

    }
}
?>