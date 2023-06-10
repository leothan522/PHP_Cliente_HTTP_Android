<?php
namespace controller;

require_once dirname(__FILE__, 3).'\\env_path.php';

use Dotenv\Dotenv;
use model\User;

$dotenv = Dotenv::createImmutable(ENV_PATH);
$dotenv->load();

class IndexController
{
    public $token;
    public $app_name;
    public $user_id;
    public $user_name;
    public $user_email;
    public $user_telefono;
    public $row_login;
    public $btn_cerrar_sesion = 'd-none';
    public $card_body_login;
    public $card_footer_login = 'd-none';
    public $row_register = 'd-none';
    public $row_recuperar = 'd-none';

    public function __construct()
    {
        $users = new User();

        if (isset($_SESSION['id'])) {
            $this->user_id = $_SESSION['id'];
            $getUser = $users->find($this->user_id);
            if ($getUser) {
                $this->user_name = $getUser['name'];
                $this->user_email = $getUser['email'];
                $this->user_telefono = $getUser['telefono'];
            }
        }

        $this->app_name = $_ENV['APP_NAME'];
        $this->token = $_ENV['FCM_TOKEN_TEST'];

        if ($this->user_id) {
            $this->card_body_login = "d-none";
            $this->card_footer_login = null;
            $this->btn_cerrar_sesion = null;
        }
    }

}