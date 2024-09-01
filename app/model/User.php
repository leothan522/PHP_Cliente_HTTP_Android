<?php

namespace model;

use model\Model;

class User extends Model
{

    public function __construct()
    {
        $this->TABLA = "users";
        $this->DATA = [
            'name',
            'email',
            'password',
            'telefono',
            'fcm_token',
            'rowquid',
            'created_at',
        ];
    }

}