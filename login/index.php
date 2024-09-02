<?php
session_start();
require_once "../vendor/autoload.php";

use controller\GuestController;

$response = array();

if ($_POST) {

    try {

        if (!isset($_POST['cerrar_sesion'])){

            if (!empty($_POST['email']) && !empty($_POST['password'])) {

                $email = $_POST['email'];
                $password = $_POST['password'];
                $fcm_token = $_POST['fcm_token'];
                $controller = new GuestController();
                $response = $controller->login($email, $password, $fcm_token);

            } else {
                //faltan datos.
                $response['result'] = false;
                $response['icon'] = "info";
                $response['title'] = "¡Faltan datos!";
                $response['message'] = "Todos los campos son requeridos.";
            }

        }else{

            $_SESSION = array();
            $response['result'] = true;
            $response['icon'] = "info";
            $response['title'] = "Sesión Cerrada.";

        }


    } catch (PDOException $e) {
        $response['result'] = false;
        $response['icon'] = "error";
        $response['title'] = 'Error en el MODEL';
        $response['error'] = 'Error en el MODEL';
        $response['message'] = "PDOException {$e->getMessage()}";
    } catch (Exception $e) {
        $response['result'] = false;
        $response['icon'] = "error";
        $response['title'] = 'Error';
        $response['error'] = 'Error';
        $response['message'] = "General Error: {$e->getMessage()}";
    }

    //android
    if (isset($response['result'])) {
        $response['success'] = $response['result'];
    } else {
        $response['success'] = false;
    }


} else {
    $response['result'] = false;
    $response['icon'] = "error";
    $response['title'] = "¡Algo Salio Mal!";
    $response['message'] = "Deben enviarse los usando el method POST";
}


echo json_encode($response, JSON_UNESCAPED_UNICODE);