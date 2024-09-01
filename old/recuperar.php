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
            if ($existe) {

                //$password = generateString(8);
                $token = generateString(60);
                $email_url = str_replace('@', '%40', $email);
                $url_recuperar = $_ENV['APP_URL'] . '/recuperar/' . $token . '/' . $email_url;
                $hoy = date("Y-m-d H:i:s");

                $mailer = new MailerController();
                $asunto = verUtf8('Notificación de restablecimiento de contraseña');
                //$mensaje = 'Hola, este es tu nuevo Password: <h4 style="color: blue">'.$password.'</h4> Asegurate de guardar bien la clave.';
                $mensaje = file_get_contents('app/view/email.php', FILE_USE_INCLUDE_PATH);
                $mensaje = str_replace('%APP_URL%', $_ENV['APP_URL'], $mensaje);
                $mensaje = str_replace('%APP_NAME%', $_ENV['APP_NAME'], $mensaje);
                $mensaje = str_replace('%URL_RECUPERAR%', $url_recuperar, $mensaje);
                $mensaje = str_replace('%APP_YEAR%', date('Y'), $mensaje);

                //$noHTML = "Este es un mensaje para los clientes que no soportan HTML. Nuevo Password: $password";
                $texto = "Este es un mensaje para los clientes de que no soportan HTML. \n 
                          Ha recibido este mensaje porque se solicitó un restablecimiento de contraseña para su cuenta.\n
                          Copie y pegue la URL de abajo en su navegador web:\n
                          ".$url_recuperar." \n
                          Este enlace de restablecimiento de contraseña expirará en 60 minutos. \n
                          Si no ha solicitado el restablecimiento de contraseña, omita este mensaje de correo electrónico. \n
                          Saludos, \n
                          ".$_ENV['APP_NAME'];
                $noHTML = verUtf8($texto);
                $mailer->enviarEmail($email, $asunto, $mensaje, $noHTML);

                $users->update($existe['id'], 'token_recuperacion', $token);
                $users->update($existe['id'], 'times_recuperacion', $hoy);

                $response['result'] = true;
                $response['icon'] = 'success';
                $response['title'] = "Enlace de restablecimiento Enviado.";
                $response['text'] = "Le hemos enviado por correo electrónico el enlace para restablecer su contraseña.";

            } else {
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