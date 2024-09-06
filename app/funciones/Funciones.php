<?php

use Carbon\Carbon;
use Dotenv\Dotenv;

init();

function init(): void
{
    try {
        $dotenvPATH = Dotenv::createImmutable(dirname(__FILE__, 3));
        $dotenvPATH->load();
        if (env('ENV_PATH')){
            $path = dirname(__FILE__,4)."\\".env('ENV_PATH');
            $dotenv = Dotenv::createImmutable($path);
            $dotenv->load();
        }
    }catch (Exception $e){
        echo $e->getMessage();
        exit();
    }

    define('ROOT_PATH', dirname(__FILE__, 3));

    //Definimois valores por defecto para las variebles de entorno
    define('APP_NAME', env('APP_NAME'));
    $key = 'id';
    if (env('APP_KEY')){
        $key = str_replace(':', '', env('APP_KEY'));
        $key = str_replace('=', '', $key);
    }
    define('APP_KEY', $key);
    define('APP_DEBUG', env('APP_DEBUG', true));
    define('APP_URL', env('APP_URL', getURLActual()));
    define('APP_URL_ANDROID', env('APP_URL_ANDROID', getURLActual()));
    define('APP_TIMEZONE', env('APP_TIMEZONE', "America/Caracas"));

    //database
    define('DB_CONNECTION', env('DB_CONNECTION', "mysql"));
    define('DB_HOST', env('DB_HOST', "127.0.0.1"));
    define('DB_PORT', env('DB_PORT', 3306));
    define('DB_DATABASE', env('DB_DATABASE', "nombre_database"));
    define('DB_USERNAME', env('DB_USERNAME', "root"));
    define('DB_PASSWORD', env('DB_PASSWORD'));

    //mail
    define('MAIL_MAILER', env('MAIL_MAILER', "smtp"));
    define('MAIL_HOST', env('MAIL_HOST', "mailpit"));
    define('MAIL_PORT', env('MAIL_PORT', 1025));
    define('MAIL_USERNAME', env('MAIL_USERNAME'));
    define('MAIL_PASSWORD', env('MAIL_PASSWORD'));
    define('MAIL_ENCRYPTION', env('MAIL_ENCRYPTION'));
    define('MAIL_FROM_ADDRESS', env('MAIL_FROM_ADDRESS', "hello@example.com"));
    define('MAIL_FROM_NAME', env('MAIL_FROM_NAME', APP_NAME));

    //firebase
    define('FCM_TOKEN_TEST', env('FCM_TOKEN_TEST'));
}

function env($env, $default = null): mixed
{
    if (isset($_ENV[mb_strtoupper($env)])){
        $response = $_ENV[mb_strtoupper($env)];
    }else{
        $response = $default;
    }
    return $response;
}

function asset($url, $noCache = false): void
{
    $version = null;
    if ($noCache){
        if (env('APP_DEBUG')){
            $version = "?v=".rand();
        }
    }
    echo APP_URL_ANDROID . '/' . $url . $version;
}

function public_path($url): string
{
    return ROOT_PATH."/".$url;
}

function getURLActual(): string
{
    // Obtener el protocolo (http o https)
    $protocolo = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    // Obtener el nombre del host
    $host = $_SERVER['HTTP_HOST'];
    // Obtener la URI de la solicitud
    $uri = $_SERVER['REQUEST_URI'];
    // Combinar todo para obtener la URL completa
    return $protocolo . $host . $uri;
}

function generarStringAleatorio($largo = 10, $espacio = false): string
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $caracteres = $espacio ? $caracteres . ' ' : $caracteres;
    $string = '';
    for ($i = 0; $i < $largo; $i++) {
        $string .= $caracteres[rand(0, strlen($caracteres) - 1)];
    }
    return $string;
}

function verUtf8($string, $safeNull = false): string
{
    //$utf8_string = "Some UTF-8 encoded BATE QUEBRADO ÑñíÍÁÜ niño ó Ó string: é, ö, ü";
    $response = null;
    $text = 'NULL';
    if ($safeNull){
        $text = '';
    }
    if (!is_null($string)){
        $response = mb_convert_encoding($string, 'ISO-8859-1', 'UTF-8');
    }
    if (!is_null($response)){
        $text = "$response";
    }
    return $text;
}

function getFecha($fecha = null, $format = null): string
{
    if (is_null($fecha)){
        if (is_null($format)){
            $date = Carbon::now(APP_TIMEZONE)->toDateString();
        }else{
            $date = Carbon::now(APP_TIMEZONE)->format($format);
        }
    }else{
        if (is_null($format)){
            $date = Carbon::parse($fecha)->format('d/m/Y');
        }else{
            $date = Carbon::parse($fecha)->format($format);
        }
    }
    return $date;
}

function haceCuanto($fecha): string
{
    return Carbon::parse($fecha)->diffForHumans();
}

// Obtener la fecha en español
function fechaEnLetras($fecha, $isoFormat = null): string
{
    // dddd => Nombre del DIA ejemplo: lunes
    // MMMM => nombre del mes ejemplo: febrero
    $format = "dddd D [de] MMMM [de] YYYY"; // fecha completa
    if (!is_null($isoFormat)){
        $format = $isoFormat;
    }
    return Carbon::parse($fecha)->isoFormat($format);
}