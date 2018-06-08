<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";
$mensaje = "";
if (isset($_SESSION['email']) && is_admin($conexion, $_SESSION['email'])) {
    if(isset($_GET['producto_id'])){
        if(isset($_POST['modificar'])){
            $mensaje = editar_producto($conexion, $_POST, $_GET['producto_id']);
        }
        $registro = extraer_registro($conexion, 'productos', $_GET['producto_id']);

?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Editar Producto</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
             <form method="post" action="">
               <div class="row">
                    <div class="col-12">
                        <h2>Editar producto #<?=$registro['id'];?></h2>
                        <p><?=$mensaje;?></p>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="nombre">Nombre</label>
                            <input type="text" class="form-control" value="<?=$registro['nombre'];?>" id="nombre"  name="nombre" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="categoria">Categoria</label>
                            <select class="custom-select" id="categoria" name="categoria">
                            <?php
                                $categorias = list_categorias($conexion);
                                while ($row = mysqli_fetch_array($categorias)) {
                                    if($row['id'] == $registro['id_categoria']){ ?>
                                        <option selected value="<?=$row['id'];?>"><?=$row['nombre'];?></option>
                                    <?php 
                                    } else {
                                    ?>
                                        <option value="<?=$row['id'];?>"><?=$row['nombre'];?></option>
                                    <?php } } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion_corta">Descripción corta</label>
                            <textarea class="form-control" name="descripcion_corta" rows="2" id="descripcion_corta"><?=$registro['descripcion_corta'];?></textarea>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="text" class="form-control" value="<?=$registro['precio'];?>" id="precio" placeholder="" name="precio">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="descripcion_corta">Descripción</label>
                            <textarea class="form-control" name="descripcion" rows="10" id="descripcion"><?=$registro['descripcion'];?></textarea>
                        </div>
                         <div class="form-group m-0">
                            Visibilidad:
                            <?php if($registro['visibilidad'] == 'si'){ ?>
                                <label for="si"  class="radio-inline">Si <input checked type="radio" name="visibilidad" id="si" value="si" /></label>
                                <label for="no" class="radio-inline">No <input type="radio" name="visibilidad" id="no" value="no" /></label>
                            <?php } else { ?>
                                <label for="si"  class="radio-inline">Si <input type="radio" name="visibilidad" id="si" value="si" /></label>
                                <label for="no"  class="radio-inline">No <input checked type="radio" name="visibilidad" id="no" value="no" /></label>
                            <?php } ?>
                        </div>
                        <button type="submit" class="btn btn-primary" name="modificar">Guardar Cambios</button>
                        <button type="reset" class="btn btn-warning">Restablecer</button>
                    </div>

               </div>
                </form>
                <div class="row">
                    <div class="col-12">
                        <a href="admin_productos.php" class="link-primary">&lt;&lt;Volver</a>
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

<?php }else {
    echo "No hay producto a editar";    
    }
}
else{
    echo "Acceso denegado";
}
?>