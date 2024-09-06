<?php

namespace controller;

use model\User;
use model\Fcm;
use PHPMailer\PHPMailer\Exception;

class GuestController extends MailerController
{

    public function login($email, $password, $fcm_token): array
    {
        $model = new User();
        $user = $model->existe('email', '=', $email);
        if ($user){

            if (password_verify($password, $user['password'])){

                if (!empty($fcm_token)){
                    $modelFCM = new Fcm();
                    $existe = $modelFCM->existe('token', '=', $fcm_token);
                    if (!$existe){
                        $data = [
                            $user['id'],
                            $fcm_token,
                            generarStringAleatorio(16),
                            getFecha()
                        ];
                        $modelFCM->save($data);
                    }
                }

                $response['result'] = true;
                $response['icon'] = 'success';
                $response['title'] = "Bienvenido ".ucwords($user['name']);
                $response['message'] = "Bienvenido ".ucwords($user['name']);
                $response['id'] = $user['rowquid'];
                $response['name'] = ucwords($user['name']);
                $response['email'] = strtolower($user['email']);
                $response['telefono'] = $user['telefono'];
                $_SESSION[APP_KEY] = $user['rowquid'];

            }else{
                $response['result'] = false;
                $response['icon'] = 'warning';
                $response['title'] = "Contraseña Incorrecta";
                $response['message'] = "Estas credenciales no coinciden con nuestros registros.";
            }
        }else{
            $response['result'] = false;
            $response['icon'] = 'warning';
            $response['title'] = "Email NO registrado";
            $response['message'] = "Estas credenciales no coinciden con nuestros registros.";
        }
        return $response;
    }

    public function register($name, $email, $telefono, $password, $fcm_token): array
    {
        $model = new User();
        $existe = $model->existe('email', '=', $email);
        if (!$existe){

            $data = [
                $name,
                $email,
                password_hash($password, PASSWORD_DEFAULT),
                $telefono,
                1,
                generarStringAleatorio(16),
                getFecha()
            ];

            $model->save($data);

            $user = $model->first('email', '=', $email);

            if (!empty($fcm_token)){
                $modelFCM = new Fcm();
                $existe = $modelFCM->existe('token', '=', $fcm_token);
                if (!$existe){
                    $data = [
                        $user['id'],
                        $fcm_token,
                        generarStringAleatorio(16),
                        getFecha()
                    ];
                    $modelFCM->save($data);
                }
            }

            $response['result'] = true;
            $response['icon'] = 'success';
            $response['title'] = "Bienvenido ".ucwords($user['name']);
            $response['message'] = "Bienvenido ".ucwords($user['name']);
            $response['id'] = $user['rowquid'];
            $response['name'] = ucwords($user['name']);
            $response['email'] = strtolower($user['email']);
            $response['telefono'] = $user['telefono'];
            $_SESSION[APP_KEY] = $user['rowquid'];

        }else{
            $response['result'] = false;
            $response['icon'] = 'warning';
            $response['title'] = "Email Duplicado";
            $response['message'] = "El correo electronico ya ha sido registrado anteriormente.";
        }
        return $response;
    }

    /**
     * @throws Exception
     */
    public function recover($email): array
    {
        $model = new User();
        $user = $model->existe('email', '=', $email);
        if ($user){

            //$password = generateString(8);
            $token = generarStringAleatorio(60);
            $email_url = str_replace('@', '%40', $email);
            $url_recuperar = APP_URL . '/recuperar/' . $token . '/' . $email_url;
            $hoy = getFecha();

            //preparo los datos para el MAILER
            $asunto = verUtf8('Notificación de restablecimiento de contraseña');
            //$mensaje = 'Hola, este es tu nuevo Password: <h4 style="color: blue">'.$password.'</h4> Asegurate de guardar bien la clave.';
            $mensaje = file_get_contents(public_path('app/view/email.php'), FILE_USE_INCLUDE_PATH);
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

            //enviamos el correo
            $this->enviarEmail($email, $asunto, $mensaje, $noHTML);

            $model->update($user['id'], 'token_recuperacion', $token);
            $model->update($user['id'], 'times_recuperacion', $hoy);

            $response['result'] = true;
            $response['icon'] = 'success';
            $response['title'] = "Enlace de restablecimiento Enviado.";
            $response['message'] = "Le hemos enviado por correo electrónico el enlace para restablecer su contraseña.";

        }else{
            $response['result'] = false;
            $response['icon'] = 'warning';
            $response['title'] = "Email NO registrado";
            $response['message'] = "El correo electronico no coincide con nuestros registros.";
        }
        return $response;
    }

}