<?php

namespace model;

class Fcm extends Model
{

    public function __construct()
    {
        $this->TABLA = "fcm_tokens";
        $this->DATA = [
            'users_id',
            'token',
            'rowquid',
            'created_at',
        ];
    }

}