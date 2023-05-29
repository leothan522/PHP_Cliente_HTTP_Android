<?php

namespace database;

use PDO;
use Dotenv\Dotenv;

header("Access-Control-Allow-Origin: *");
date_default_timezone_set('America/Caracas');
$rutaActual = $_SERVER['SCRIPT_FILENAME'];
$rutaEnv = explode('android/', $rutaActual);
$dotenv = Dotenv::createImmutable($rutaEnv);
$dotenv->load();

class Conexion
{

    public $CONEXION;

    public function __construct()
    {

        $db_conexion = $_ENV['DB_CONNECTION'];
        $db_host = $_ENV['DB_HOST'];
        $db_port = $_ENV['DB_PORT'];
        $db_database = $_ENV['DB_DATABASE'];
        $db_username = $_ENV['DB_USERNAME'];
        $db_password = $_ENV['DB_PASSWORD'];
        $db_dns = "$db_conexion:host=$db_host;dbname=$db_database";
        $this->CONEXION = new PDO($db_dns, $db_username, $db_password);

    }


}

