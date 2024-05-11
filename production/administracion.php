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

<style>
header {
    background: #8E2DE2;
    background: -webkit-linear-gradient(to right, #4A00E0, #8E2DE2);
    background: linear-gradient(to right, #4A00E0, #8E2DE2);
}

/*estilos para la tabla  background-color: #337ab7 !important;*/
table th {

    color: white;
}

table>tbody>tr>td {
    vertical-align: middle !important;
}

/*para alinear los botones y cuadro de busqueda*/
.btn-group,
.btn-group-vertical {
    /*position: absolute !important;*/
    margin-top: 100px;
}
.tam {
    width: 100px;
    height: 100px;
}

.pos {
    margin: 200px 10px 50px 10px;
}
</style>
<!-- xxxxxxxxxxxxxxxxx para los botones de la tabla exportar, pdf, imprimir xxxxxxxxxxxxxxxxxxxxxxx -->
<!--datables CSS básico-->
<link rel="stylesheet" type="text/css" href="datatables/datatables.min.css" />
<!--datables estilo bootstrap 4 CSS-->
<link rel="stylesheet" type="text/css" href="datatables/DataTables-1.10.18/css/dataTables.bootstrap4.min.css">

<!--font awesome con CDN-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
    integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<!-- xxxxxxxxxxxxxxxxxx  para los botones de la tabla exportar, pdf, imprimir xxxxxxxxxxxxxxxxxxxxxxx -->

<!--
<button type="button" class="btn btn-primary boton" data-toggle="modal"
    data-target=".bs-example-modal-ingresar-elector">Ingresar Radicación</button>-->
<div class="container" style="margin: 100px 0px 100px 420px ">

    <div class="row">
        <div class="col-lg-12">
            <div class="az-content-label mg-b-5">Módulos Administración</div>
            <p class="mg-b-20">Presione su opción</p>

            <div class="row row-xs wd-xl-80p">
                <div class="col-sm-6 col-md-3">
                <a class="btn btn-indigo btn-with-icon btn-block" href="dependencia.php<?php echo '?galletaAUX=' . $galleta; ?>" >Dependencias</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                <a class="btn btn-primary btn-with-icon btn-block" href="usuario.php<?php echo '?galletaAUX=' . $galleta; ?>" >Usuario</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                <a class="btn btn-success btn-with-icon btn-block" href="usuario.php<?php echo '?galletaAUX=' . $galleta; ?>" >Roles y permisos</a> 
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="az-content-label mg-b-5"></div>
            <p class="mg-b-20"></p>
            <div class="row row-xs wd-xl-80p">
            <div class="col-sm-6 col-md-3">
                <a class="btn btn-indigo btn-with-icon btn-block" href="dias_no_habiles.php<?php echo '?galletaAUX=' . $galleta; ?>" >Días no hábiles</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                <a class="btn btn-primary btn-with-icon btn-block" href="envio_correspondencia.php<?php echo '?galletaAUX=' . $galleta; ?>" >Envío de correspondencia</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                <a class="btn btn-success btn-with-icon btn-block" href="tablas_sencillas.php<?php echo '?galletaAUX=' . $galleta; ?>" >Tablas sencillas</a> 
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="az-content-label mg-b-5"></div>
            <p class="mg-b-20"></p>

            <div class="row row-xs wd-xl-80p">
            <div class="col-sm-6 col-md-3">
                <a class="btn btn-indigo btn-with-icon btn-block" href="tipos_radicación.php<?php echo '?galletaAUX=' . $galleta; ?>" >Tipos de radicación</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                <a class="btn btn-primary btn-with-icon btn-block" href="tarifas.php<?php echo '?galletaAUX=' . $galleta; ?>" >Tarifas</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                <a class="btn btn-success btn-with-icon btn-block" href="Paises.php<?php echo '?galletaAUX=' . $galleta; ?>" >Países</a> 
                </div>      
            </div>
        </div>

        <div class="col-lg-12">
            <div class="az-content-label mg-b-5"></div>
            <p class="mg-b-20"></p>

            <div class="row row-xs wd-xl-80p">
            <div class="col-sm-6 col-md-3">
                <a class="btn btn-indigo btn-with-icon btn-block" href="departamentos.php<?php echo '?galletaAUX=' . $galleta; ?>" >Departamentos</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                <a class="btn btn-primary btn-with-icon btn-block" href="municipios.php<?php echo '?galletaAUX=' . $galleta; ?>" >Municipios</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                <a class="btn btn-success btn-with-icon btn-block" href="Contactos.php<?php echo '?galletaAUX=' . $galleta; ?>" >Contactos</a> 
                </div>  
            </div>
        </div>
        <div class="col-lg-12">
            <div class="az-content-label mg-b-5"></div>
            <p class="mg-b-20"></p>
            <div class="row row-xs wd-xl-80p">
            <div class="col-sm-6 col-md-3">
                
                <a class="btn btn-indigo btn-with-icon btn-block" href="terceros.php<?php echo '?galletaAUX=' . $galleta; ?>" >Terceros</a> 
                </div>
                <div class="col-sm-6 col-md-3 mg-t-10 mg-sm-t-0">
                <a class="btn btn-primary btn-with-icon btn-block" href="configuracion_password.php<?php echo '?galletaAUX=' . $galleta; ?>" >Configuración Password</a> 
                </div>
                <!--<div class="col-sm-6 col-md-3 mg-t-10 mg-md-t-0">
                <a class="btn btn-success btn-with-icon btn-block" href="Contactos.php<?php echo '?galletaAUX=' . $galleta; ?>" >Contactos</a> 
                </div>-->  
            </div>
            </div>
        </div>

    </div>
</div>

</div>

<!-- Fin Contenido -->
<?php include('includes/footer.php'); ?>