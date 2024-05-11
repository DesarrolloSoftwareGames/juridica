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








<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Modal 1</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Show a second modal and hide this one with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                    Open second modal</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel2">Modal 2</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Hide this modal and show the first with the button below.
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-bs-target="#exampleModalToggle" data-bs-toggle="modal"
                    data-bs-dismiss="modal">Back to first</button>
            </div>
        </div>
    </div>
</div>

<a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Open first modal</a>