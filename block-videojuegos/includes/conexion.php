<?php

$server = 'localhost';
$username = 'root';
$password = 'P3onderey';
$database = 'blog';

$db = mysqli_connect($server, $username, $password, $database);

mysqli_query($db, "SET NAMES 'utf8'");

//INICIAR LA SESION
if(!isset($_SESSION)){
    session_start();
}


?>