<?php
require_once dirname(__FILE__, 3).'\\env_path.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(ENV_PATH);
$dotenv->load();
define('ROOT_PATH', $_ENV['APP_URL_ANDROID']);

function asset($url): void
{
    echo ROOT_PATH. $url;
}

function generateString($strength = 16): string
{
    $input = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $input_length = strlen($input);
    $random_string = '';
    for ($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}