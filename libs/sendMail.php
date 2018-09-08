<?php

require_once 'phpmailer/class.phpmailer.php';
require_once 'Zend/Json.php';


if(isset($_POST)) {


    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];


    $body = "<b>Nombre:</b>" . $name . "<br/>"
        . "<b>Asunto:</b>" . $subject . "<br/>"
        . "<b>Correo:</b>" . $email . "<br/>"
        . "<b>Mensaje:</b>" . $message . "<br/>";


    $mail = new PHPMailer();

    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->From = "formulariocontacto@silvasilvaasociados.com";
    $mail->FromName = "Sitio web";
    $mail->Subject = $subject;
    $mail->AddAddress("contacto@silvasilvaasociados.com");
    $mail->MsgHTML($body);

    $mail->IsSMTP();
    $mail->Port = 587;
    $mail->Host = "silvasilvaasociados.com"; // mail. o solo dominio - Servidor de Salida.
    $mail->SMTPAuth = true;
    $mail->Username = "formulariocontacto@silvasilvaasociados.com"; // Correo Electrónico para SMTP
    $mail->Password = "m;j@rA4t}d"; // Contraseña para SMTP

    //$mail->Send();

    if (!$mail->Send()) {
        $result = array(
            'isSuccess' => false,
            'message' => 'Message could not be sent.' . $mail->ErrorInfo
        );

    } else {

        $result = array(
            'isSuccess' => true,
            'message' => 'Mensaje enviado correctamente'
        );

    }

    $json = Zend_Json::encode($result);
    echo $json;


}