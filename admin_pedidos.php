<?php
    session_start();
    include "database/conexion_bd.php";
    include "librerias/consultas_bd.php";
    $titulo = "Pedidos registrados";
    $mensaje = "";
    if($_SESSION['email'] && is_admin($conexion,$_SESSION['email'])){
        if (isset($_GET['eliminar_id'])) {
            $mensaje = eliminar_registro($conexion, $_GET['eliminar_id'], 'pedidos');
            echo mysqli_error($conexion);
        }
        if(isset($_POST['guardar'])){
            $mensaje = cambiar_estado_pedido($conexion, $_POST['id_pedido'], $_POST['pagado'], $_POST['id_transporte']);
        }
        if (isset($_POST['buscar'])) {
           echo "Hola";

            $consulta = buscar($conexion, 'pedidos', 'id', $_POST['texto']);
            $titulo = "Buscando: <i>" . $_POST['texto'] . "...</i>";
        }else if (isset($_POST['ordenar'])) {
            $consulta = list_registros($conexion, 'pedidos', $_POST['orden'], $_POST['tipo'], "todos");
        } else {
            $consulta = list_registros($conexion, 'pedidos', 'fecha', "DESC", "todos");
        }
?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Administracion: pedidos</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

            <div class="container">
                <div class="row">

                    <div class="col-12">
                      
                        <h2><?=$titulo;?></h2>
                        <div class="row">
                            <div class="col-12">
                                <?php include "plantillas/plantilla_buscador_pedidos.php"?>
                            </div>
                        </div>
                        
                        <?=$mensaje;?>
                        
                        <table class="table table-sm table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Pagado</th>
                                    <th scope="col">Detalles</th>
                                    <th scope="col">Editar</th>
                                    <th scope="col">Eliminar</th>
                                </tr>
                            </thead>
                            <?php
                                while ($row = mysqli_fetch_array($consulta)) { ?>
                                    <form action="" method="post">
                                    <tr>
                                        <td><?=$row['id'];?></td>
                                        <td><?=$row['fecha'];?></td>
                                        <td>
                                        <?php 
                                            if($row['pagado'] == 'no'){
                                                print_r(total_pedido($conexion, $row['id']));
                                            }
                                            else{
                                                echo $row['total'];
                                            }
                                        ?>
                                        </td>
                                        <td>
                                            <select class="custom-select custom-select-sm" name="pagado" id="pagado">
                                            <?php
                                                if($row['pagado'] == 'si'){
                                                    echo "<option value='si' selected>si</option>";
                                                    echo "<option value='no'>no</option>";
                                                }
                                                else{
                                                    echo "<option value='si'>si</option>";
                                                    echo "<option value='no' selected>no</option>";
                                                }
                                            ?>
                                            </select>
                                        </td>
                                       
                                        <td><a class='btn btn-sm btn-info' href='detalles_pedido.php?id_pedido=<?=$row['id'];?>'>Detalles</a></td>
                                        <td>
                                            <button type="submit" name="guardar" class='btn btn-sm btn-success'>Guardar</button>
                                            <input type="hidden" name="id_pedido" value="<?=$row['id'];?>">
                                            <input type="hidden" name="id_transporte" value="<?=$row['id_transporte'];?>">
                                        </td>
                                        <td><a class='btn btn-sm btn-danger' href='?eliminar_id=<?=$row['id'];?>'>Eliminar</a></td>
                                    </tr>
                                   </form>
                             <?php } ?>
                            
                        </table>
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
    <?php } ?>