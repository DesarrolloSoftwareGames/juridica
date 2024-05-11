<?php

//error_reporting('0');

//session_start();

$servername = "localhost";
$database = "themis"; //Base de datos Producci�n
//$database = "asesor";  //Base de datos desarrollo
$username = "admin";
$password = "123";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

/*

if (session_status() !== PHP_SESSION_ACTIVE) {

  session_start();

  

}

if (isset($conn)) {

  echo' Estoy conectado';

}

*/

?>