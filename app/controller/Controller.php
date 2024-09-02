<?php

namespace controller;

use model\User;

class Controller
{
    public $USER_ID;
    public $USER_NAME;
    public $USER_EMAIL;
    public $USER_TELEFONO;
    public $USER_FMC_TOKEN;

    public function auth(): void
    {
        $model = new User();
        if (isset($_SESSION[APP_KEY])) {
            $user = $model->first('rowquid', '=', $_SESSION[APP_KEY]);
            if ($user){
                $this->USER_ID = $user['rowquid'];
                $this->USER_NAME = $user['name'];
                $this->USER_EMAIL = $user['email'];
                $this->USER_TELEFONO = $user['telefono'];
                $this->USER_FMC_TOKEN = $user['fcm_token'];
            }else{
                $_SESSION = array();
            }
        }
    }

}