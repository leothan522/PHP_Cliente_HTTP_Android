<?php
session_start();

$response = array();

if ($_POST){

    $opcion = $_POST['opcion'];

    if ($opcion == "cerrar_sesion"){
        $_SESSION = array();
        $response['result'] = true;
        $response['icon'] = "info";
        $response['title'] = "Sesión Cerrada.";
    }

}else{
    $response['result'] = false;
    $response['icon'] = "error";
    $response['title'] = "¡Algo Salio Mal!";
    $response['text'] = "Deben enviarse los usando el method POST";
}

echo json_encode($response, JSON_UNESCAPED_UNICODE);