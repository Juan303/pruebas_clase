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

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>-->
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>-->


        <script src="js/jquery3.3.1.min.js" type="text/javascript"></script>
        <script src="js/pooper.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.min.js" type="text/javascript"></script>



        <!--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>-->
    </body>

    </html>