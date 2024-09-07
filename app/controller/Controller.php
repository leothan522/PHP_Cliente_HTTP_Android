<?php

namespace controller;

use model\User;

class Controller
{
    public $USER_ID;
    public $USER_NAME;
    public $USER_EMAIL;
    public $USER_TELEFONO;

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
            }else{
                session_destroy();
            }
        }
    }

}