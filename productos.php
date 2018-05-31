<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

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
                <div class="row">
                    <div class="col-12 text-center">
                        <h1>Mis Productos</h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="imagenes/productos/1.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Mando Arcade 1</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Detalles...</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="imagenes/productos/2.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Mando Arcade 1</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Detalles...</a>
                            </div>
                        </div> 
                    </div>
                        <div class="col-sm-12 col-md-6 col-lg-4">
                        <div class="card">
                            <img class="card-img-top img-fluid" src="imagenes/productos/3.jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">Mando Arcade 1</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                <a href="#" class="btn btn-primary">Detalles...</a>
                            </div>
                        </div> 
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