<?php
namespace controller;

use model\Fcm;
use model\User;

class IndexController extends Controller
{
    public $row_login;
    public $btn = 'd-none';
    public $card_body_login;
    public $card_footer_login = 'd-none';
    public $row_register = 'd-none';
    public $row_recuperar = 'd-none';
    public $row_edit = 'd-none';
    public $title = "Login";

    public function __construct()
    {
        $this->auth();
        if ($this->USER_ID) {
            $this->card_body_login = "d-none";
            $this->card_footer_login = null;
            $this->btn = null;
            $this->title = "Perfil";
        }
    }

    public function update($rowquid, $name, $email, $telefono, $password, $nuevo, $fcm_token): array
    {
        $model = new User();
        $user = $model->first('rowquid', '=', $rowquid);

        if ($user){
            $id = $user['id'];
            $error_email = false;
            $error_password = false;
            $cambios = false;

            if (!empty($name)){
                if ($user['name'] != $name){
                    $model->update($id, 'name', $name);
                    $cambios = true;
                }
            }

            if (!empty($telefono)){
                if ($user['telefono'] != $telefono){
                    $model->update($id, 'telefono', $telefono);
                    $cambios = true;
                }
            }

            if (!empty($email)){
                if ($user['email'] != $email){
                    $exite = $model->existe('email', '=', $email, $id);
                    if (!$exite){
                        $model->update($id, 'email', $email);
                        $cambios = true;
                    }else{
                        $error_email = true;
                    }
                }
            }

            if (!empty($password) && !empty($nuevo)){
                if (password_verify($password, $user['password'])){
                    $new_password = password_hash($nuevo, PASSWORD_DEFAULT);
                    $model->update($id, 'password', $new_password);
                    $cambios = true;
                }else{
                    $error_password = true;
                }
            }

            if (!empty($fcm_token)){
                $modelFCM = new Fcm();
                $existe = $modelFCM->existe('token', '=', $fcm_token);
                if (!$existe){
                    $data = [
                        $user['id'],
                        $fcm_token,
                        getRowquid($modelFCM),
                        getFecha()
                    ];
                    $modelFCM->save($data);
                }
            }

            if ($cambios){
                $user = $model->find($id);
                $response['result'] = true;
                $response['icon'] = 'success';
                $response['title'] = 'Datos Guardados.';
                $response['message'] = 'Cambios Guardados Correctamente.';
                $response['id'] = $user['rowquid'];
                $response['name'] = ucwords($user['name']);
                $response['email'] = strtolower($user['email']);
                $response['telefono'] = $user['telefono'];
            }else{
                $response['result'] = false;
                $response['icon'] = 'warning';
                $response['title'] = "¡Sin Cambios!";
                $response['message'] = "No se realizo ningun cambio.";
            }

            $response['error_email'] = $error_email;
            $response['error_password'] = $error_password;

        }else{
            session_destroy();
            $response['result'] = false;
            $response['error_email'] = false;
            $response['error_password'] = false;
            $response['error_id'] = true;
            $response['icon'] = 'warning';
            $response['title'] = "Usuario NO encontrado.";
            $response['message'] = "Estas credenciales no coinciden con nuestros registros.";
        }

        return $response;
    }

}