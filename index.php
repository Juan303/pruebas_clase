<?php
session_start();
include "database/conexion_bd.php";
include "librerias/consultas_bd.php";

?>
    <!doctype html>
    <html lang="es">

    <head>
        <?php include "plantillas/plantilla_cabecera.php";?>

            <title>Hello, world!</title>
    </head>

    <body>
        <div class="container-fluid">

            <?php include "plantillas/plantilla_navegacion.php";?>

                <div class="container">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h1>Mi pagina web</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat ea, hic soluta laboriosam facere necessitatibus accusamus aperiam saepe accusantium fugit eum eaque veniam modi, ipsam libero, commodi ex, repudiandae optio!</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis placeat repudiandae accusantium perspiciatis reprehenderit facilis odit, assumenda dignissimos, asperiores doloremque impedit. Temporibus dolores totam reiciendis.</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit eligendi illum harum quibusdam, aspernatur, totam.</p>
                        </div>
                        <div class="col-6">
                            <img class="img-fluid" src="imagenes/imagen_portada.jpg" alt="Ferrari">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat fuga, pariatur quas quidem odit! Vel?</p>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magni suscipit eaque tempora nihil praesentium omnis perspiciatis, error molestiae quo recusandae quas dolorum obcaecati ut dicta ea mollitia eos. Molestias voluptatum inventore eos amet nobis saepe magni maxime maiores consequatur aliquid.</p>
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