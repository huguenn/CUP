<!-- CUPemailPASSWORD1990! -->

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'include/Exception.php';
require 'include/PHPMailer.php';
require 'include/SMTP.php';
$mail = new PHPMailer(true);




try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'cup@3tdeploy.com';                     //SMTP username
    $mail->Password   = 'secret';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


    $errors = '';
    $myemail = 'hugo@nubeit.net';
    if(empty($_POST['name'])  ||
       empty($_POST['email']) ||
       empty($_POST['telefono']) ||
       empty($_POST['mensaje']))
    {
        $errors .= "\n Error: Todos los campos son requeridos";
    }
    $name = $_POST['name'];
    $email_address = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];
    if (!preg_match(
    "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/i",
    $email_address))
    {
        $errors .= "\n Error: Correo Electronico inválido";
    }
    
    if( empty($errors))
    {
    $to = $myemail;
    $email_subject = "Formulario de contacto de: $name";
    $email_body = "Ha recibido un nuevo correo de contacto. ".
    "\n Nombre: $name \n ".
    "Email: $email_address\n".
    "Teléfono: $email_address\n".
    "Mensaje: \n $mensaje";
    $headers = "From: $myemail\n";
    $headers .= "Reply-To: $email_address";
    mail($to,$email_subject,$email_body,$headers);
    
    header('Location: index.php');
    }
    ?>