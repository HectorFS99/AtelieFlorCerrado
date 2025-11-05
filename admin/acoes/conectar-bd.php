<?php
    $servidor = "localhost";
    $usuario  = "root";
    $senha    = "usbw";
    $banco    = "ecommerce";

    $con = new mysqli($servidor, $usuario, $senha, $banco);
    if ($con -> connect_error) {
        die("Erro na conexão com o banco de dados: " . $con -> connect_error);
    }

    $con -> set_charset("utf8");
    date_default_timezone_set('America/Sao_Paulo'); // Define o fuso horário para o Brasil
?>