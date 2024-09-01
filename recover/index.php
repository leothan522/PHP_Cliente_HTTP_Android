<?php
session_start();
require_once "../vendor/autoload.php";

use controller\GuestController;

$response = array();

if ($_POST) {

    try {

        if (!empty($_POST['email'])) {

            $email = $_POST['email'];
            $controller = new GuestController();
            $response = $controller->recover($email);

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