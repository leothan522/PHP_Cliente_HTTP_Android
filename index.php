<?php
session_start();
require_once "vendor/autoload.php";

use controller\IndexController;

$index = new IndexController();
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $index->app_name; ?> | Android</title>

    <link rel="apple-touch-icon" sizes="57x57" href="favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">


    <!-- Bootstrap-->
    <link rel="stylesheet" href="resources/bootstrap/css/bootstrap.min.css">
    <!-- our project just needs Font Awesome Solid + Brands -->
    <link href="resources/fontawesome/css/fontawesome.css" rel="stylesheet">
    <link href="resources/fontawesome/css/brands.css" rel="stylesheet">
    <link href="resources/fontawesome/css/solid.css" rel="stylesheet">

</head>
<body>

<div class="container-fluid">

    <?php require "view/card_login.php"; ?>
    <?php require "view/card_register.php"; ?>
    <?php require "view/card_recuperar.php"; ?>

</div>

<script src="resources/jquery/jquery-3.6.4.min.js"></script>
<script src="resources/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="resources/sweetalert2/sweetalert2.all.min.js"></script>
<script src="resources/inputmask/jquery.inputmask.min.js"></script>
<script src="js/sweetalert-app.js"></script>
<script src="js/app.js"></script>
</body>
</html>
