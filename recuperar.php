<?php
session_start();
require_once "vendor/autoload.php";

use model\User;
use controller\MailerController;


$response = array();

if ($_POST) {

    try {

        $users = new User();

        if (!empty($_POST['email'])) {

            $email = $_POST['email'];

            $existe = $users->existe('email', '=', $email);
            if ($existe){

                $password = generateString(8);

                $mailer = new MailerController();
                $asunto = 'Nuevo Password';
                $mensaje = 'Hola, este es tu nuevo Password: <h4 style="color: blue">'.$password.'</h4> Asegurate de guardar bien la clave.';
                $noHTML = "Este es un mensaje para los clientes que no soportan HTML. Nuevo Password: $password";
                $mailer->enviarEmail($email, $asunto, $mensaje, $noHTML);

                $users->update($existe['id'], 'password', password_hash($password, PASSWORD_DEFAULT));

                $response['result'] = true;
                $response['icon'] = 'success';
                $response['title'] = "Nueva Contraseña Enviada.";
                $response['text'] = "La nueva clave fue enviada por correo: ".$email;

            }else{
                $response['result'] = false;
                $response['icon'] = 'warning';
                $response['title'] = "Email NO registrado";
                $response['text'] = "El correo electronico no coincide con nuestros registros.";
            }


        } else {
            //faltan datos.
            $response['result'] = false;
            $response['icon'] = "info";
            $response['title'] = "¡Faltan datos!";
            $response['text'] = "Todos los campos son requeridos.";
        }

    } catch (PDOException $e) {
        $response['result'] = false;
        $response['icon'] = "error";
        $response['title'] = 'Error en el MODEL';
        $response['text'] = "PDOException {$e->getMessage()}";
    } catch (Exception $e) {
        $response['result'] = false;
        $response['icon'] = "error";
        $response['title'] = 'Error';
        $response['text'] = "General Error: {$e->getMessage()}";
    }

    //android
    if (isset($response['result'])) {
        $response['success'] = $response['result'];
    } else {
        $response['success'] = false;
    }
    if (isset($response['text'])) {
        $response['message'] = $response['text'];
    } else {
        $response['message'] = "Error de Conexión.";
    }
    if (isset($response['title'])) {
        $response['error'] = $response['title'];
    } else {
        $response['error'] = "Error de Conexión.";
    }


} else {
    $response['result'] = false;
    $response['icon'] = "error";
    $response['title'] = "¡Algo Salio Mal!";
    $response['text'] = "Deben enviarse los usando el method POST";
}


echo json_encode($response, JSON_UNESCAPED_UNICODE);