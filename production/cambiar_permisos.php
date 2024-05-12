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

html,
body {
    height: 100%;
}

.sep {
    margin-top: 20px;
}

.sepa {
    margin-bottom: 20px;
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
<div class="container">

    <div class="row">

        <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
            <!--<li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Editar Usuarios</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Editar Usuarios</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Consultar Usuarios</a>
            </li>-->

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form>
                    <div class="x_panel">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Personalizar Permisos</b></p>
                        <!-- boton primer modal -->
                        <div style="margin-left: 75%;">
                            <!--<button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-toggle="modal"
                                data-target=".bs-example-modal-ingresar-remitente">
                                Ingresar Remitente</button>-->
                        </div>
                        <form>
                            <div class="x_panel" style="width: 1000px; margin-top: 20px; margin-bottom:20px;">
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Permisos de Usuarios</th>
                                                    <th>Permisos de Accesos</th>
                                                    <th>Permisos de Módulos</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td scope="row">
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Activar
                                                                    usuario</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Solicitar cambio
                                                                    contraseña</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Usuario
                                                                    público</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Radicación
                                                                    Masiva</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Puede
                                                                    reasignar radicado</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Acceso a
                                                                    consultas</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Ingresar
                                                                    por directorio activo</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Puede
                                                                    modificar anexos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Puede
                                                                    borrar anexos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep">
                                                            <label class="ckbox"><input type="checkbox" /><span>Firma
                                                                    QR</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Consultar radicados
                                                                    confidenciales</span></label>
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Digitalización de
                                                                    documentos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Modificación de
                                                                    radicado</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Devolución de
                                                                    correspondencia</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Impresión</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Estadísticas</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Agregar
                                                                    Destinatarios/Remitentes</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Pre-radicación</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Radicación
                                                                    e-mail</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Administrador del
                                                                    sistema</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Descarga
                                                                    de archivos originales</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Publicar
                                                                    documentos</span></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Administrador de
                                                                    Archivos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Tablas
                                                                    de Retención Documental</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Anulación de
                                                                    Radicado</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Puede
                                                                    Archivar Documentos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Solicitar anulación de
                                                                    radicado</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Préstamo
                                                                    de Documentos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Expedientes
                                                                    virtuales</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input type="checkbox" /><span>Envió de
                                                                    Correspondencia</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Descargar
                                                                    Documentos</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Transferencias
                                                                    documentales</span></label>
                                                        </div>
                                                        <div class="col-md-12 sep sepa">
                                                            <label class="ckbox"><input
                                                                    type="checkbox" /><span>Reasignación
                                                                    Masiva</span></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table id="example" class="table table-striped table-bordered"
                                                        cellspacing="0" width="100%">
                                                        <thead>
                                                            <tr>
                                                                <th colspan="3" style="text-align: center;">Tipos de
                                                                    Radicados</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <div class="col-md-12 sep sepa">
                                                                        <label class="ckbox"><input
                                                                                type="checkbox" /><span>Entrada</span></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-12 sep sepa">
                                                                        <label class="ckbox"><input
                                                                                type="checkbox" /><span>Salida</span></label>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <div class="col-md-12 sep sepa">
                                                                        <label class="ckbox"><input
                                                                                type="checkbox" /><span>PQRSD</span></label>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </table>
                                        <div class="modal-footer">
                                        <input type="reset" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                        value="Guardar" onclick="alert('Permisos Guardados Correctamente');">
                                    <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                        value="Cancelar">
                                    </div>
                                    </div>
                                </div>

                                    

                            </div>
                        </form>

                    </div>
                </form>
            </div>
        </div>

    </div>
    <!-- Fin Contenido -->
    <?php include('includes/footer.php'); ?>