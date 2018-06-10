<?php
require_once "consultas_bd.php";

function vaciar_carrito(){
    unset($_SESSION['carrito']);
}

function agregar_articulo($conexion, $id){
    $articulo = extraer_registro($conexion, 'productos', $id);
    if(!isset($_SESSION['carrito'])){
        $_SESSION['carrito'] = array($articulo['nombre'] => array('precio' => $articulo['precio'],
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
            $_SESSION['carrito'][$articulo['nombre']] = array('precio' => $articulo['precio'],
                                                                'cantidad' => 1);
        }
    }
}






?>