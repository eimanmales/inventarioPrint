<?php
    $opciones = [
        'cost' => 12,
    ];
    $pass = $_GET["password"];
    $passwordHashed = password_hash($pass, PASSWORD_BCRYPT, $opciones);

    echo $passwordHashed;
?>
