<?php
session_start();
require_once "../vendor/autoload.php";

use controller\IndexController;
$controller = new IndexController();

$response = array();

if ($_POST) {

    try {

        if (!isset($_POST['edit'])){

            if (!empty($_POST['id'])) {

                $id = $_POST['id'];
                $name = $_POST['name'];
                $email = strtolower($_POST['email']);
                $telefono = $_POST['telefono'];
                $password = $_POST['password'];
                $nuevo = $_POST['nuevo_password'];
                $fcm_token = $_POST['fcm_token'];
                $response = $controller->update($id, $name, $email, $telefono, $password, $nuevo, $fcm_token);

            } else {
                //faltan datos.
                $response['result'] = false;
                $response['icon'] = "info";
                $response['title'] = "¡Faltan datos!";
                $response['message'] = "Todos los campos son requeridos.";
            }

        }else{

            if (!empty($_POST['rowquid'])){
                $rowquid = $_POST['rowquid'];
                if ($controller->USER_ID){
                    $response['result'] = true;
                    $response['id'] = $controller->USER_ID;
                    $response['name'] = $controller->USER_NAME;
                    $response['email'] = $controller->USER_EMAIL;
                    $response['telefono'] = $controller->USER_TELEFONO;
                    $response['fcm_token'] = $controller->USER_FMC_TOKEN;
                }else{
                    $response['result'] = false;
                    $response['icon'] = "info";
                    $response['error_id'] = true;
                    $response['title'] = "Sesión Cerrada.";
                }
            }else{
                //faltan datos.
                $response['result'] = false;
                $response['icon'] = "info";
                $response['title'] = "¡Faltan datos!";
                $response['message'] = "El ID del Usuario es requerido.";
            }

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