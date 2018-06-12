<?php
    include "src/SMTP.php";
    include "src/PHPMailer.php";
    include "src/Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;

    //Configuracion PHPMailer
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = "smtp.gmail.com"; // A RELLENAR. Aquí pondremos el SMTP a utilizar. Por ej. mail.midominio.com
    $mail->Username = "informasterjuan@gmail.com"; // A RELLENAR. Email de la cuenta de correo. ej.info@midominio.com La cuenta de correo debe ser creada previamente.
    $mail->Password = "88b4R8H4s303"; // A RELLENAR. Aqui pondremos la contraseña de la cuenta de correo
    $mail->Port = 587; // Puerto de conexión al servidor de envio.
    $mail->From = "informasterjuan@gmail.com"; // A RELLENAR Desde donde enviamos (Para mostrar). Puede ser el mismo que el email creado previamente.
    $mail->FromName = "Juan"; //A RELLENAR Nombre a mostrar del remitente.

    $mail->IsHTML(true); // El correo se envía como HTML
?>