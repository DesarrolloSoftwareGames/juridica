<?php 
/*
* SISTEMA DE AUTENTIFICACION USANDO MYSQL Y COOKIES
* Autor: CrashCool
* Fecha: 24/12/04
* Licencia GPL
* emai: crashcool@gmail.com ; crashcool@crashcool.com
* web www.crashcool.com SAFDS56D4FSD6DS56F4
*/


$documento="ingresarentrada.php"; //sustituye por el nombre del documento al que se accede
$host="localhost"; //nombre host de la db, normalmente localhost

#DATOS IMPRESCINDIBLES
		
$db="themis"; //nombre base de datos EN EL SERVIDOR asesorelectoral_asesor
$usuario="admin"; //usuario de la db
$contrasenya="123";  //contraseña del user

#DATOS OPCIONALES
//tabla="usuario"; //tabla asignada
//$campo_login="CODUSUARIO"; //el campo de la tabla que contiene el nombre de usuario

$tabla="registro"; //tabla asignada
$campo_login="NomUsuario"; //el campo de la tabla que contiene el nombre de usuario

$campo_pass="contrasena"; //el campo de la tabla que contiene la contrase�a del usuario

date_default_timezone_set('America/Bogota');

?>