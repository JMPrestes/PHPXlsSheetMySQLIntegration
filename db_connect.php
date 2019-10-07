<?php
//Conexão com DB
$servername = "localhost";
$username = "admin";
$password = "insert your connection password here";
$db_name = "jordancrud";

$connect = mysqli_connect($servername, $username, $password, $db_name);
mysqli_set_charset($connect, "utf-8");
if(mysqli_connect_error()):
    echo "<h1>Falha na Conexão: </h1>".mysqli_connect_error();
endif;
