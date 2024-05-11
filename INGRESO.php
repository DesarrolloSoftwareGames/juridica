<?php
session_start();
error_reporting('0');
$_SESSION['id'] = session_id();
require("configuracion.php");
$s = $_GET["s"];
$galleta = $galletaAUX;
$aux = base64_decode($galleta);
$aux = explode("@", $aux);
$LAB = $aux[0];

if ($s == 1) {
	echo "ESTOY AQUI IF 1";
	$LAB = NULL;
	$galleta = NULL;
	session_destroy();
}

if ($galleta != NULL  && $_SESSION['id']) {
	echo "ESTOY AQUI IF 2";
	$aux = base64_decode($galleta);
	$aux = explode("@", $aux);
	$usu = $aux[0];
	$contra = $aux[1];
	$conexion = mysqli_connect($host, $usuario, $contrasenya) or die("No se pudo Conectar la Base de Datos:<b></b>");
	mysqli_select_db($conexion, $db) or die("Error en la seleccion de la base de datos: <b></b>");
	$salida = mysqli_query($conexion, "SELECT $campo_pass,NOMUSUARIO FROM $tabla WHERE $campo_login='$usu'");
	if (mysqli_affected_rows($conexion) == 1) {
		$row = mysqli_fetch_row($salida);
		if ($row[0] == $contra) {
			///define("AUTENTIFICADO", null);
			//include("DATOS.PHP"); //include($documento);
			$_SESSION['USUARIO'] = $row[1];
			$_SESSION['LOGIN'] = $usu;
			header("Location: production/index.php?galletaAUX=$galleta");
			//echo "<div align=\"center\"><a href=\"index.php?s=1\">                                                                                                <font style=\"FONT-SIZE: 8pt\" face=\"Verdana\">Salir</font></a>";
		} else {
			//Intento de modificacion de cookie
			setcookie("crashLogin", NULL, time() + 20);
			header("Location: INGRESO.php?s=1");
		}
	} else {
		//Intento de modificacion de cookie
		setcookie("crashLogin", NULL, time() + 20);
		header("Location: INGRESO.php?s=1");
	}
} else {
	if ($_POST) {
		echo "ESTOY AQUI IF 3";
		$miLogin = $_POST["login"];
		$miPass = $_POST["password"];
		if ($miLogin != NULL && $miPass != NULL) //4
		{
			echo "<script>console.log('ENTRO IF 4');</script>";
			$conexion = mysqli_connect($host, $usuario, $contrasenya) or die("No se pudo Conectar la Base de Datos: <b></b> $host,$usuario,$contrasenya");
			echo "<script>console.log('CONEXION OK');</script>";
			mysqli_select_db($conexion, $db) or die("Error en la seleccion de la base de datos: <b></b>");
			echo "<script>console.log('SELECCION OK');</script>";
			$salida = mysqli_query($conexion, "SELECT $campo_pass,tipousuario FROM $tabla WHERE $campo_login='$miLogin'");
			echo "<script>console.log('COSULTA OK');</script>";
			if (mysqli_affected_rows($conexion) == 1) {
				echo "OK CONECCION";
				$row = mysqli_fetch_row($salida);
				if ($row[0] == md5($miPass)) {
					/*$salida2=mysqli_query($conexion,"SELECT * FROM bdempresa,periodo WHERE bdempresa.CODPERIODO=periodo.CODPERIODO");
							$row2=mysqli_fetch_row($salida2);
							$_SESSION['CODPERIODO']=$row2[1];
							$_SESSION['NOMPERIODO']=$row2[4];
							$_SESSION['NOMEMPRESA']=$row2[2];*/
					$_SESSION['TIPOUSUARIO'] = $row[1];
					$_SESSION['LOGIN'] = $miLogin;
					$gall = base64_encode("$miLogin@" . md5($miPass) . "");
					header("Location: production/index.php?galletaAUX=$gall");
					//header("Location: entraghghdas.php?galletaAUX=$gall");
				} else {
					echo "<div align=\"center\"><font style=\"FONT-SIZE: 11pt\" color=\"#000000\" face=\"Verdana\">Contrase�a incorrecta</font></div>";
					echo "<div align=\"center\"><font style=\"FONT-SIZE: 11pt\" color=\"#000000\" face=\"Verdana\">Por favor verifique</font></div>";
					@include("index.php");
					echo "<BR>";
				}
			} else {
				echo "CONEXION BARRO";
				echo "<div align=\"center\"><font style=\"FONT-SIZE: 11pt\" color=\"#000000\" face=\"Verdana\">Usuario inexistente</font></div>";
				echo "<div align=\"center\"><font style=\"FONT-SIZE: 11pt\" color=\"#000000\" face=\"Verdana\">Por favor verifique</font></div>";
				@include("index.php");
				echo "<BR>";
			}
			///////////////////////////////////
		} else @include("index.php"); //4
	} else
		@include("index.php");
}
