<?php
$dbHost = 'localhost';
$dbName = 'texkoin';
$dbUser = 'master';
$dbPass = '633';

$connection = mysqli_connect('p:' . $dbHost, $dbUser, $dbPass, $dbName);
if (!$connection) {
    die("Erro ao conectar ao banco de dados: " . mysqli_connect_error());
}else{
    #echo 'db ok';
    #exit();
}
?>