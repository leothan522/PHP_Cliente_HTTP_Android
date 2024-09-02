<?php

namespace model;

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
            'plataforma',
            'rowquid',
            'created_at',
        ];
    }

}