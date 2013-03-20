<?php
$host = 'localhost';
$user = '';
$pass = '';
$db = 'berrugas';
$link = mysqli_connect($host,$user,$pass,$db) or die('No se ha podido contectar a la base de datos de Berrugas');
/*if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}*/
?>