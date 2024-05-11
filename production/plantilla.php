<?php session_start();
include("includes/conexion.php");
error_reporting('0');
$galleta = $_GET["galletaAUX"];
$aux = base64_decode($galleta);
$aux = explode("@", $aux);
$codigousuario = $aux[0];


///si estoy dentro////
if ($galleta != NULL  && $_SESSION['id']) {
    $usuario=$_SESSION['LOGIN'];
    $tipousuario=$_SESSION['TIPOUSUARIO'];
    $query = mysqli_query($conn, "select * from registro where NomUsuario='$usuario' "); 
    $row = mysqli_fetch_row($query);
    $nombredeusuario=$row[2]." ".$row[4];
    $foto=$row[12];
} //si entro

else {
    header("Location: error.php");
    exit();
}

?>
<?php include('includes/conexion.php'); ?>
<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); ?>
<!-- Inicio Contenido -->

<!-- Fin Contenido -->
<?php include('includes/footer.php'); ?>