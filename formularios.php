<?php
session_start();
require_once "vendor/autoload.php";
use controller\IndexController;
$index = new IndexController();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<p><small><pre>(FCM TOKEN = <?php echo $index->token; ?>)</pre></small></p>
<p>Registrar Usuario
    <form action="old_register.php" method="post">
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="telefono" placeholder="telefono">
        <input type="text" name="password" placeholder="Password">
        <input type="hidden" name="fcm_token" value="<?php echo $index->token;; ?>">
        <input type="submit" value="enviar">
    </form>
</p>
<p>Login ...
    <form action="login.php" method="post">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="password" placeholder="Password">
        <input type="hidden" name="fcm_token" value="<?php echo $index->token;; ?>">
		<input type="submit" value="enviar">
    </form>
</p>
<p>Recuperar
    <form action="old_recuperar.php" method="post">
		<input type="text" name="email" placeholder="Email">
        <input type="submit" value="enviar">
    </form>
</p>
<p>Actualizar Usuario
    <form action="old_update.php" method="post">
        <input type="text" name="name" placeholder="Nombre">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="telefono" placeholder="Telefono">
        <input type="text" name="password" placeholder="Password Actual">
        <input type="text" name="nuevo_password" placeholder="Nuevo Password">
        <input type="text" name="id" placeholder="ID Users">
        <input type="hidden" name="fcm_token" value="<?php echo $index->token;; ?>">
        <input type="submit" value="enviar">
    </form>
</p>
<p>Listar Usuarios
<form action="old_listar.php" method="post">
    <input type="submit" value="enviar">
</form>
</p>
</body>
</html>