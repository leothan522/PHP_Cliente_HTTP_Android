<?php
namespace controller;

use model\User;

class IndexController extends Controller
{
    public $row_login;
    public $btn_cerrar_sesion = 'd-none';
    public $card_body_login;
    public $card_footer_login = 'd-none';
    public $row_register = 'd-none';
    public $row_recuperar = 'd-none';

    public function __construct()
    {
        $this->auth();
        if ($this->USER_ID) {
            $this->card_body_login = "d-none";
            $this->card_footer_login = null;
            $this->btn_cerrar_sesion = null;
        }
    }

}