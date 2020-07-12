<?php
require('conect.php');
session_start();

if(!isset($_SESSION['user'])){
    header("Location:index.php");
}

if(isset($_REQUEST['cerrar'])){
   session_destroy();
   header("Location:index.php");
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'ricardomallqui6@gmail.com';                     // SMTP username
    $mail->Password   = 'ricardomallqui666';                               // SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('ricardomallqui6@gmail.com', 'FISMA');
    $mail->addAddress('966878340ricardo@gmail.com', '');     // Add a recipient
    //$mail->addAddress('ellen@example.com');               // Name is optional
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');

    // Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = '<!DOCTYPE html>
    <html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    </head>
    <body>
    
    <h1 style="text-align: center;background:rgb(10,10,100);color:RGB(100,0,100);border-radius:5px;font-family:serif;font-size:0px;">
    GRACIAS POR VISITAR LA PAGINA, EMPICE A NUTRIR SUS CONOCIMENTOS '.$suscriptor.'
    </h1>
    
    
    <img style="display:block;width:500px;margin:auto;" src="https://github.com/ricardofisma/fisma/blob/master/archivos/estudianteposes-boudoir.jpg?raw=true" alt="">
                   
    <td style="text-align: left;" align="justify"><span style="font-size: 25px;">'.utf8_decode($contenido).'</span></td>
    <a style="text-decoration:none;color:rgb(100,0,100);" href="ricardomallqui.cf">Regístrese</a>
    </body>
    </html>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}







