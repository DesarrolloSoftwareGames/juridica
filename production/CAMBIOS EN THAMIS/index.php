<?php session_start();
include("includes/conexion.php");
error_reporting('0');
$galleta = $_GET["galletaAUX"];
$aux = base64_decode($galleta);
$aux = explode("@", $aux);
$codigousuario = $aux[0];


///si estoy dentro////
if ($galleta != NULL  && $_SESSION['id']) {
    $usuario = $_SESSION['LOGIN'];
    $tipousuario = $_SESSION['TIPOUSUARIO'];
    $query = mysqli_query($conn, "select * from registro where NomUsuario='$usuario' ");
    $row = mysqli_fetch_row($query);
    $nombredeusuario = $row[2] . " " . $row[4];
    $foto = $row[12];
} //si entro

else {
    header("Location: error.php");
    exit();
}

?>
<?php include('includes/conexion.php'); 
?>
<?php include('includes/header.php'); ?>
<?php include('includes/navigation.php'); 
?>
<!-- Inicio Contenido -->

<body>


    <!-- az-header -->
    <div class="az-content az-content-dashboard">
        <div class="container">
            <div class="az-content-body">
                <div class="az-dashboard-one-title">
                </div>
                <div class="az-content-label mg-b-5">PANTALLA DE INICIO</div>
                <p class="mg-b-20">Add zebra-striping to any table row.</p>
                <div class="table-responsive">
                    <table class="table table-striped mg-b-0">
                        <thead>
                            <tr>
                                <th>Número Radicado</th>
                                <th>Fecha Radicado</th>
                                <th>Asunto</th>
                                <th>Remitente/Destinatario</th>
                                <th>Dignatario</th>
                                <th>Tipo Documento</th>
                                <th>Días Restantes</th>
                                <th>Enviado Por</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">202405020000123</th>
                                <td>2024-05-02 12:30 PM</td>
                                <td>Factura</td>
                                <td>Colaseo</td>
                                <td></td>
                                <td>Certificación de Supervisión</td>
                                <td style="text-align: center; font-size: x-large;"><i class="icon ion-md-alarm" style="color:rgb(246, 161, 3);">15/D</i> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">202405020000124</th>
                                <td>2024-05-02 12:40 PM</td>
                                <td>Tutela</td>
                                <td>Juridica</td>
                                <td></td>
                                <td>Solicitud</td>
                                <td style="text-align: center; font-size: x-large;"><i class="icon ion-md-alarm" style="color:rgb(56, 246, 3);">30/D</i> </td>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">202405020000125</th>
                                <td>2024-05-02 12:53 PM</td>
                                <td>Derecho petición</td>
                                <td>Sec Salud</td>
                                <td></td>
                                <td>Petición</td>
                                <td style="text-align: center; font-size: x-large;"><i class="icon ion-md-alarm" style="color:rgb(246, 3, 3);">02/D</i> </td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- az-content-body -->
    </div>
    </div><!-- az-content -->

</body>
<!-- Fin Contenido -->
<?php include('includes/footer.php'); ?>