<?php
session_start();
require_once "vendor/autoload.php";

use model\User;


$response = array();

if ($_POST) {

    try {

        $users = new User();

        if (
            !empty($_POST['name']) &&
            !empty($_POST['email']) &&
            !empty($_POST['telefono']) &&
            !empty($_POST['password'])
        ) {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $password = $_POST['password'];
            $fcm_token = $_POST['fcm_token'];

            $existe = $users->existe('email', '=', $email);
            if (!$existe){

                $data = [
                    $name,
                    $email,
                    password_hash($password, PASSWORD_DEFAULT),
                    $telefono,
                    $fcm_token,
                    date('Y-m-d H:i:s')
                ];

                $users->save($data);
                $existe = $users->first('email', '=', $email);

                $response['result'] = true;
                $response['icon'] = 'success';
                $response['title'] = "Registrado correctamente. ".ucwords($existe['name']);
                $response['text'] = "Registrado correctamente.";
                $response['id'] = $existe['id'];
                $response['name'] = ucwords($existe['name']);
                $response['email'] = strtolower($existe['email']);
                $response['telefono'] = $existe['telefono'];
                $_SESSION['id'] = $existe['id'];

            }else{
                $response['result'] = false;
                $response['icon'] = 'warning';
                $response['title'] = "Email Duplicado";
                $response['text'] = "El correo electronico ya ha sido registrado anteriormente.";
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