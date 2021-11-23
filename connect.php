<?php
    session_start();

    //dados de acesso ao banco de dados
    $nomeDB = "gn";
    $server = "localhost";
    $user = "root";
    $pass = "";
    $conn = new mysqli($server, $user, $pass, $nomeDB);

    //checkando a conexão
    if ($conn->connect_error) {
	    die("Falha na conexão: " . $conn->connect_error);
	} 
?>