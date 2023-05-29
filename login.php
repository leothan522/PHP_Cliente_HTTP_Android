<?php
session_start();
require_once "vendor/autoload.php";

use model\User;


$response = array();

if ($_POST) {

    try {

        $users = new User();

        if (!empty($_POST['email']) && !empty($_POST['password'])) {

            $email = $_POST['email'];
            $password = $_POST['password'];

            $existe = $users->existe('email', '=', $email);
            if ($existe){

                if (password_verify($password, $existe['password'])){

                    if (!empty($_POST['fcm_token'])){
                        $users->update($existe['id'], 'fcm_token', $_POST['fcm_token']);
                    }

                    $response['result'] = true;
                    $response['icon'] = 'success';
                    $response['title'] = "Bienvenido ".ucwords($existe['name']);
                    $response['text'] = "Bienvenido ".ucwords($existe['name']);
                    $response['id'] = $existe['id'];
                    $response['name'] = ucwords($existe['name']);
                    $response['email'] = strtolower($existe['email']);
                    $response['telefono'] = $existe['telefono'];
                    $_SESSION['id'] = $existe['id'];

                }else{
                    $response['result'] = false;
                    $response['icon'] = 'warning';
                    $response['title'] = "Contraseña Incorrecta";
                    $response['text'] = "Estas credenciales no coinciden con nuestros registros.";
                }


            }else{
                $response['result'] = false;
                $response['icon'] = 'warning';
                $response['title'] = "Email NO registrado";
                $response['text'] = "Estas credenciales no coinciden con nuestros registros.";
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