<?php
require_once "consultas_bd.php";

function vaciar_carrito(){
    unset($_SESSION['carrito']);
}

function agregar_articulo($conexion, $id){
    $articulo = extraer_registro($conexion, 'productos', $id);
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = array($articulo['nombre'] => array('id' => $articulo['id'],
                                                                  'precio' => $articulo['precio'],
                                                                  'cantidad' => 1));
    }
    else{
        $encontrado = false;
        foreach($_SESSION['carrito'] as $indice => &$valor){
            if($indice == $articulo['nombre']){
                $valor['precio'] += $articulo['precio'];
                $valor['cantidad'] += 1;
                $encontrado = true;
            }
        }
        if(!$encontrado){
            $_SESSION['carrito'][$articulo['nombre']] = array('id' => $articulo['id'],
                                                              'precio' => $articulo['precio'],
                                                              'cantidad' => 1);
        }
    }
}
function cuenta_articulos(){
    if(isset($_SESSION['carrito'])){
        $n_items = 0;
        foreach($_SESSION['carrito'] as $indice => $valor){
            $n_items += $valor['cantidad'];
        }
    }
    return $n_items;
}
function total_carrito($carrito){
    $total = 0;
    foreach($carrito as $value => $valor){
        $total += $valor['precio'];
    }
    return $total;
}





?>