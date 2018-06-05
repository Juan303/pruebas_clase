<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
$mensaje = "";
if(isset($_POST['registrar'])){
    $mensaje = registrar_producto($conexion, $_POST);
}

?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Productos</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
             <form method="post" action="">
               <div class="row">
                    <div class="col-12">
                        <h2>Registrar producto</h2>
                        <p><?=$mensaje;?></p>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" id="nombre"  name="nombre" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select class="custom-select" id="categoria" name="categoria">
                            <?php 
                                $categorias = list_categorias($conexion);
                                while($row = mysqli_fetch_array($categorias)){ ?>
                                    <option value="<?=$row['id'];?>"><?=$row['nombre'];?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion_corta">Descripción corta</label>
                            <textarea class="form-control" name="descripcion_corta" rows="2" id="descripcion_corta"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" id="precio" placeholder="" name="precio">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="descripcion_corta">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="10" id="descripcion"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="registrar">Registrar</button>
                        <button type="reset" class="btn btn-warning">Restablecer</button>
                    </div>
                   
               </div>
                </form>
            </div>
            <div class="container-fluid">
                <?php include "plantillas/plantilla_pie.php";?>
            </div>
        </div>
        <?php include "plantillas/plantilla_scripts.php";?>
    </body>

    </html>