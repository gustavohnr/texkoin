<?php
$dbHost = 'localhost';
$dbName = 'tk_users';
$dbUser = 'root';
$dbPass = '';

$connection = mysqli_connect('p:' . $dbHost, $dbUser, $dbPass, $dbName);
if (!$connection) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}
?>