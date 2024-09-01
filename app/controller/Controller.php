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
            $this->USER_ID = $_SESSION[APP_KEY];
            $user = $model->find($this->USER_ID);
            if ($user){
                $this->USER_NAME = $user['name'];
                $this->USER_EMAIL = $user['email'];
                $this->USER_TELEFONO = $user['telefono'];
            }
        }
    }

}