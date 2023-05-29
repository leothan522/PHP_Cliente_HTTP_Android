<?php

namespace controller;

use Dotenv\Dotenv;

$rutaActual = $_SERVER['SCRIPT_FILENAME'];
$rutaEnv = explode('android/', $rutaActual);
$dotenv = Dotenv::createImmutable($rutaEnv);
$dotenv->load();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailerController
{
    public function enviarEmail($email, $asunto, $mensaje, $noHTML)
    {
        // Al pasar true habilitamos las excepciones
        $mail = new PHPMailer(true);
        // Ajustes del Servidor
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER; // Comenta esto antes de producción
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = $_ENV['MAIL_USERNAME'];
        $mail->Password = $_ENV['MAIL_PASSWORD'];
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Destinatario
        $mail->setFrom($_ENV['MAIL_FROM_ADDRESS'], $_ENV['APP_NAME']);
        $mail->addAddress($email);

        // Mensaje
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;
        $mail->AltBody = $noHTML;

        $mail->send();
        //echo 'Se envio el mensaje';
    }

}