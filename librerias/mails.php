<?php

    //include_once "database/conexion_bd.php";
    include_once "consultas_bd.php";
    include_once "PHPMailer/config.php";

    function mensaje_contacto(){}

    function mensaje_confirmacion_cuenta($mail, $datos, $codigo){
        $mail->AddAddress($datos['email_r']); // Esta es la dirección a donde enviamos
        $mail->Subject = "Cuenta creada"; // Este es el titulo del email.
        $mail->Body = "Haz click en el siguiente link para activar tu cuenta <a href='localhost:8000/php/Proyecto_1_BD/activar_cuenta.php?codigo=".$codigo ."&email=".$datos['email_r']."'>LINK ACTIVACION</a>";
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }
    function mensaje_recuperar_pass($conexion, $mail, $mail_usuario){
        $registro = extraer_usuario($conexion, $mail_usuario);
        if($registro == NULL){
            return "Ese mail no esta registrado en nuestra base de datos";
        }
        else{
            $codigo = rand(0,9999);
            $consulta = mysqli_query($conexion, "UPDATE usuarios SET codigo_activacion = '$codigo' WHERE email = '$mail_usuario'");
            $mail->AddAddress($mail_usuario); // Esta es la dirección a donde enviamos
            $mail->Subject = "Recuperacion de contraseña"; // Este es el titulo del email.
            $mail->Body = "Haz click en el siguiente link para elegir contraseña <a href='localhost:8000/php/Proyecto_1_BD/recuperar_pass.php?codigo=" . $codigo . "&email=" . $mail_usuario."'>Recuperar Contraseña</a>";
            if($mail->Send()){
                return "Te hemos enviado un mail con instrucciones para recuperar tu contraseña";
            }
            else{
                return "Ha habido algun problema al enviar el mail. prueba de nuevo mas tarde";
            }
        }
    }



?>