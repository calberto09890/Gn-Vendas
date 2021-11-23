<?php
    session_start();

    //Dados de acesso ao banco de dados
    $nomeDB = "gn";
    $server = "localhost";
    $user = "root";
    $pass = "";
    $conn = new mysqli($server, $user, $pass, $nomeDB);

    //Checkando a conexão
    if ($conn->connect_error) {
	    die("Falha na conexão: " . $conn->connect_error);
	} 
?>