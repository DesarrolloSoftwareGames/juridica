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
            <li class="nav-item">
                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
                    aria-selected="true">Creación de Usuarios</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                    aria-controls="profile" aria-selected="false">Editar Usuarios</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                    aria-controls="contact" aria-selected="false">Consultar Usuarios</a>
            </li>

        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <form>
                    <div class="x_panel">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Crear Usuario</b></p>
                        <!-- boton primer modal -->
                        <div style="margin-left: 75%;">
                            <!--<button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-toggle="modal"
                                data-target=".bs-example-modal-ingresar-remitente">
                                Ingresar Remitente</button>-->
                        </div>
                        <div class="x_panel">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-5  col-2 m">
                                        <label for="heard">Seleccionar Dependencia *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="Administrador Tablas de retención documental">Administrador
                                                Tablas de retención documental</option>
                                            <option value="Administrador del sistema">Administrador del sistema</option>
                                            <option value="Funcionario">Funcionario</option>
                                            <option value="Jefe">Jefe</option>
                                            <option value="Ventanilla de radicación">Ventanilla de radicación</option>
                                            <option value="Funcionario 2">Funcionario 2</option>
                                            <option value="Colaborador">Colaborador</option>
                                            <option value="Colaboradores">Colaboradores</option>
                                            <option value="Administrador De Actas">Administrador De Actas</option>
                                            <option value="Funcionario De Planta De Documentos">Funcionario De Planta De
                                                Documentos</option>
                                            <option value="Coordinador De Planta">Coordinador De Planta</option>
                                            <option value="Coordinador De Eventos Finales">Coordinador De Eventos
                                                Finales
                                            </option>
                                            <option value="Coordinador De Eventos">Coordinador De Eventos</option>
                                            <option value="Funcionario De Eventos">Funcionario De Eventos</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2  col-2 m">
                                        <label for="heard">Perfil *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Jefe">Jefe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-5  col-2 m">
                                        <label for="heard">Dependencia Principal *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="Canal De Recepción">Canal De Recepción</option>
                                            <option value="Despacho Alcalde">Despacho Alcalde</option>
                                            <option value="Oficina Jurídica">Oficina Jurídica</option>
                                            <option value="Secretaria Desarrollo Económico Y Competitividad">
                                                SecretariaDesarrollo Económico Y Competitividad</option>
                                            <option value="Secretaria De Hacienda Y Finanzas Públicas">Secretaria
                                                DeHacienda
                                                Y Finanzas Públicas</option>
                                            <option value="Secretaria De Gobierno Y">Secretaria De Gobierno Y</option>
                                            <option value="Desarrollo Social">Desarrollo Social</option>
                                            <option value="Secretaria De Planeación">Secretaria De Planeación</option>
                                            <option value="Oficina De Ordenamiento">Oficina De Ordenamiento</option>
                                            <option value="Territorial Y Control Urbano">Territorial Y Control Urbano
                                            </option>
                                            <option value="Oficina De Seguridad Y Convivencia Ciudadana">Oficina
                                                DeSeguridad
                                                Y Convivencia Ciudadana</option>
                                            <option value="Secretaria De Salud Y Seguridad Social">Secretaria De Salud Y
                                                Seguridad Social</option>
                                            <option value="Secretaria De Educación">Secretaria De Educación</option>
                                            <option value="Secretaria De Turismo Y Cultura">Secretaria De Turismo
                                                YCultura
                                            </option>
                                            <option value="Sisben"> Sisben </option>
                                            <option value="Oficina De Transito Y Movilidad">Oficina De Transito Y
                                                Movilidad
                                            </option>
                                            <option value="Secretaria General">Secretaria General</option>
                                            <option value="Gestión Documental">Gestión Documental</option>
                                            <option value="Comisaria De Familia">Comisaria De Familia</option>
                                            <option value="Oficina De Talento Humano">Oficina De Talento Humano</option>
                                            <option value="Programas Sociales Y Especiales">ProgramasSociales Y
                                                Especiales
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-2 m">
                                        <label for="prinombre">Número cédula *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="textHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6 col-10 m">
                                        <label for="prinombre">Usuario *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="textHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-12 col-sm-10 m">
                                        <label for="prinombre">E-mail</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="">
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="prinombre">Fecha de Nacimiento *</label>
                                        <input type="date" name="fecha" class="form-control"
                                            aria-describedby="textHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Ubicación</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Piso</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Extención</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="">
                                    </div>
                                    </p>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        </p>
                        <div class="modal-footer">
                            <input type="reset" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                value="Guardar" onclick="alert('Usuario Creado Correctamente');">
                            <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                value="Regresar">
                            <a href="cambiar_permisos.php<?php echo '?galletaAUX=' . $galleta; ?>"
                                class="nav-link btn btn-primary">Personalizar Permisos</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="x_panel">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Editar Usuario</b></p>
                        <!-- boton primer modal -->
                        <!--<div style="margin-left: 75%;">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-toggle="modal"
                                data-target=".bs-example-modal-ingresar-remitente">
                                Ingresar Remitente</button>
                        </div>-->
                        <div class="x_panel" style="width: 1000px;">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" cellspacing="0"
                                        width="100%">
                                        <thead>
                                            <tr>
                                                <th>Nombres</th>
                                                <th>Usuario</th>
                                                <th>Dependencia</th>
                                                <th>Rol</th>
                                                <th>Editar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Carlos Andres Perez Corcho</td>
                                                <td>Andres Corcho</td>
                                                <td>Canal de recepción</td>
                                                <td>Administrador de tablas de retencion documentales</td>
                                                <td>
                                                    <a href="editar_usuario.php?numeroidenti=masculino&galletaAUX=YWRtaW5AMjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA="
                                                        class="btn btn-secondary"><i class="typcn typcn-pen"></i>
                                                        <a href="eliminar_coordinadores.php?numeroidenti=masculino&galletaAUX=YWRtaW5AMjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA="
                                                            class="btn btn-danger"><i class="typcn typcn-trash"></i>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <input type="submit" class="btn btn-primary" data-toggle="modal"
                                data-target=".bs-example-modal-ingresar-elector" value="Lista de Dependencias">
                            <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                value="Agregar">
                            <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                value="Editar">
                            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="x_panel">
                    <p>
                    <p><b class="moda" style="font-size: 24px;">Consultar Usuario</b></p>
                    <!-- boton primer modal -->
                    <!--<div style="margin-left: 75%;">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-toggle="modal"
                                data-target=".bs-example-modal-ingresar-remitente">
                                Ingresar Remitente</button>
                        </div>-->
                    <div class="rows">
                        <div class="col-md-6  col-2 m" style="margin-left: 47%;">
                            <label for="heard">Seleccionar Dependencia *</label>
                            <select name="genero" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="Canal De Recepción">Canal De Recepción</option>
                                <option value="Despacho Alcalde">Despacho Alcalde</option>
                                <option value="Oficina Jurídica">Oficina Jurídica</option>
                                <option value="Secretaria Desarrollo Económico Y Competitividad">
                                    SecretariaDesarrollo Económico Y Competitividad</option>
                                <option value="Secretaria De Hacienda Y Finanzas Públicas">Secretaria
                                    DeHacienda
                                    Y Finanzas Públicas</option>
                                <option value="Secretaria De Gobierno Y">Secretaria De Gobierno Y</option>
                                <option value="Desarrollo Social">Desarrollo Social</option>
                                <option value="Secretaria De Planeación">Secretaria De Planeación</option>
                                <option value="Oficina De Ordenamiento">Oficina De Ordenamiento</option>
                                <option value="Territorial Y Control Urbano">Territorial Y Control Urbano
                                </option>
                                <option value="Oficina De Seguridad Y Convivencia Ciudadana">Oficina
                                    DeSeguridad
                                    Y Convivencia Ciudadana</option>
                                <option value="Secretaria De Salud Y Seguridad Social">Secretaria De Salud Y
                                    Seguridad Social</option>
                                <option value="Secretaria De Educación">Secretaria De Educación</option>
                                <option value="Secretaria De Turismo Y Cultura">Secretaria De Turismo
                                    YCultura
                                </option>
                                <option value="Sisben"> Sisben </option>
                                <option value="Oficina De Transito Y Movilidad">Oficina De Transito Y
                                    Movilidad
                                </option>
                                <option value="Secretaria General">Secretaria General</option>
                                <option value="Gestión Documental">Gestión Documental</option>
                                <option value="Comisaria De Familia">Comisaria De Familia</option>
                                <option value="Oficina De Talento Humano">Oficina De Talento Humano</option>
                                <option value="Programas Sociales Y Especiales">ProgramasSociales Y
                                    Especiales
                                </option>
                            </select>
                        </div>
                    </div>

                    <div class="x_panel" style="width: 1000px;">
                        <div class="col-lg-12" style="margin-top: 20px;">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped table-bordered" cellspacing="0"
                                    width="100%">
                                    <thead>
                                        <tr>
                                            <th>Nombres</th>
                                            <th>Usuario</th>
                                            <th>Dependencia</th>
                                            <!--<th>Acción</th>-->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Carlos Andres Perez Corcho</td>
                                            <td>Andres Corcho</td>
                                            <td>Administrador de tablas de retencion documentales</td>
                                            <!--<td>
                                                <a href="editar_usuario.php?numeroidenti=masculino&galletaAUX=YWRtaW5AMjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA="
                                                    class="btn btn-secondary"><i class="typcn typcn-pen"></i>
                                                    <a href="eliminar_coordinadores.php?numeroidenti=masculino&galletaAUX=YWRtaW5AMjAyY2I5NjJhYzU5MDc1Yjk2NGIwNzE1MmQyMzRiNzA="
                                                        class="btn btn-danger"><i class="typcn typcn-trash"></i>
                                            </td>-->
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary boton" data-toggle="modal"
                            data-target=".bs-example-modal-consultar-usuario">Consultar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!--  modal ingresar radicacion -->
    <form action="guardar_coordinadores_puesto.php<?php echo '?galletaAUX=' . $galleta; ?>" method="POST"
        class="row gy-2 gx-3 align-items-center">
        <div class="modal fade bs-example-modal-ingresar-elector" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Entrada de Radicación
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panelm">
                            <p>
                            <p><b class="moda" style="font-size: 24px;">Datos Remitente</b></p>
                            <!-- boton primer modal -->
                            <div style="margin-left: 75%;">
                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                    data-toggle="modal" data-target=".bs-example-modal-ingresar-remitente">
                                    Ingresar Remitente</button>
                            </div>
                            <div class="x_panelm2">
                                <div class="container">
                                    <div class="row">
                                        <p>
                                        <div class="col-md-12  col-2 m">
                                            <label for="prinombre">Fecha de Ingreso *</label>
                                            <input type="date" name="fecha" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6 col-10 m">
                                            <label for="prinombre">Número Identificación *</label>
                                            <input type="text" name="identificacion" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="heard">Tipo *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Negocios">Negocios</option>
                                                <option value="Persona Natural">Persona Natural</option>
                                                <option value="Persona Jurídica">Persona Jurídica</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6  col-10 m">
                                            <label for="prinombre">Nombres/Razón Social *</label>
                                            <input type="text" name="numeroident" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="prinombre">Apellidos/Sigla *</label>
                                            <input type="text" name="cargo" class="form-control"
                                                value="Coordinador de Puesto" aria-describedby="textHelp"
                                                placeholder="" required>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Dirección *</label>
                                            <input type="text" name="dir" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-6 col-sm-2 m">
                                            <label for="prinombre">Teléfono *</label>
                                            <input type="text" name="tel" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-12 col-sm-10 m">
                                            <label for="prinombre">E-mail</label>
                                            <input type="text" name="correo" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-12 col-sm-2 m">
                                            <label for="prinombre">Dignatario/ Funcionario</label>
                                            <input type="text" name="correo" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Continente *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Asia">Asia</option>
                                                <option value="Africa">Africa</option>
                                                <option value="América del Norte">América del Norte</option>
                                                <option value="América del Sur">América del Sur</option>
                                                <option value="Antártida">Antártida</option>
                                                <option value="Europa">Europa</option>
                                                <option value="Oceanía">Oceanía</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="heard">País *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Afganistán"> Afganistán </option>
                                                <option value="Albania"> Albania </option>
                                                <option value="Alemania"> Alemania </option>
                                                <option value="Andorra"> Andorra </option>
                                                <option value="Angola"> Angola </option>
                                                <option value="Antigua y Barbuda"> Antigua y Barbuda </option>
                                                <option value="Arabia Saudita"> Arabia Saudita </option>
                                                <option value="Argelia"> Argelia </option>
                                                <option value="Argentina"> Argentina </option>
                                                <option value="Armenia"> Armenia </option>
                                                <option value="Australia"> Australia </option>
                                                <option value="Austria"> Austria </option>
                                                <option value="Azerbaiyán"> Azerbaiyán </option>
                                                <option value="Bahamas"> Bahamas </option>
                                                <option value="Bangladés"> Bangladés </option>
                                                <option value="Barbados"> Barbados </option>
                                                <option value="Baréin"> Baréin </option>
                                                <option value="Bélgica"> Bélgica </option>
                                                <option value="Belice"> Belice </option>
                                                <option value="Benín"> Benín </option>
                                                <option value="Bielorrusia"> Bielorrusia </option>
                                                <option value="Birmania"> Birmania </option>
                                                <option value="Bolivia"> Bolivia </option>
                                                <option value="Bosnia y Herzegovina"> Bosnia y Herzegovina </option>
                                                <option value="Botsuana"> Botsuana </option>
                                                <option value="Brasil"> Brasil </option>
                                                <option value="Brunéi"> Brunéi </option>
                                                <option value="Bulgaria"> Bulgaria </option>
                                                <option value="Burkina Faso"> Burkina Faso </option>
                                                <option value="Burundi"> Burundi </option>
                                                <option value="Bután"> Bután </option>
                                                <option value="Cabo Verde"> Cabo Verde </option>
                                                <option value="Camboya"> Camboya </option>
                                                <option value="Camerún"> Camerún </option>
                                                <option value="Canadá"> Canadá </option>
                                                <option value="Catar"> Catar </option>
                                                <option value="Chad"> Chad </option>
                                                <option value="Chile"> Chile </option>
                                                <option value="China"> China </option>
                                                <option value="Chipre"> Chipre </option>
                                                <option value="Ciudad del Vaticano"> Ciudad del Vaticano </option>
                                                <option value="Colombia"> Colombia </option>
                                                <option value="Comoras"> Comoras </option>
                                                <option value="Corea del Norte"> Corea del Norte </option>
                                                <option value="Corea del Sur"> Corea del Sur </option>
                                                <option value="Costa de Marfil"> Costa de Marfil </option>
                                                <option value="Costa Rica"> Costa Rica </option>
                                                <option value="Croacia"> Croacia </option>
                                                <option value="Cuba"> Cuba </option>
                                                <option value="Dinamarca"> Dinamarca </option>
                                                <option value="Dominica"> Dominica </option>
                                                <option value="Ecuador"> Ecuador </option>
                                                <option value="Egipto"> Egipto </option>
                                                <option value="El Salvador"> El Salvador </option>
                                                <option value="Emiratos Árabes Unidos"> Emiratos Árabes Unidos </option>
                                                <option value="Eritrea"> Eritrea </option>
                                                <option value="Eslovaquia"> Eslovaquia </option>
                                                <option value="Eslovenia"> Eslovenia </option>
                                                <option value="España"> España </option>
                                                <option value="Estados Unidos"> Estados Unidos </option>
                                                <option value="Estonia"> Estonia </option>
                                                <option value="Etiopía"> Etiopía </option>
                                                <option value="Filipinas"> Filipinas </option>
                                                <option value="Finlandia"> Finlandia </option>
                                                <option value="Fiyi"> Fiyi </option>
                                                <option value="Francia"> Francia </option>
                                                <option value="Gabón"> Gabón </option>
                                                <option value="Gambia"> Gambia </option>
                                                <option value="Georgia"> Georgia </option>
                                                <option value="Ghana"> Ghana </option>
                                                <option value="Granada"> Granada </option>
                                                <option value="Grecia"> Grecia </option>
                                                <option value="Guatemala"> Guatemala </option>
                                                <option value="Guyana"> Guyana </option>
                                                <option value="Guinea"> Guinea </option>
                                                <option value="Guinea ecuatorial"> Guinea ecuatorial </option>
                                                <option value="Guinea-Bisáu"> Guinea-Bisáu </option>
                                                <option value="Haití"> Haití </option>
                                                <option value="Honduras"> Honduras </option>
                                                <option value="Hungría"> Hungría </option>
                                                <option value="India"> India </option>
                                                <option value="Indonesia"> Indonesia </option>
                                                <option value="Irak"> Irak </option>
                                                <option value="Irán"> Irán </option>
                                                <option value="Irlanda"> Irlanda </option>
                                                <option value="Islandia"> Islandia </option>
                                                <option value="Islas Marshall"> Islas Marshall </option>
                                                <option value="Islas Salomón"> Islas Salomón </option>
                                                <option value="Israel"> Israel </option>
                                                <option value="Italia"> Italia </option>
                                                <option value="Jamaica"> Jamaica </option>
                                                <option value="Japón"> Japón </option>
                                                <option value="Jordania"> Jordania </option>
                                                <option value="Kazajistán"> Kazajistán </option>
                                                <option value="Kenia"> Kenia </option>
                                                <option value="Kirguistán"> Kirguistán </option>
                                                <option value="Kiribati"> Kiribati </option>
                                                <option value="Kuwait"> Kuwait </option>
                                                <option value="Laos"> Laos </option>
                                                <option value="Lesoto"> Lesoto </option>
                                                <option value="Letonia"> Letonia </option>
                                                <option value="Líbano"> Líbano </option>
                                                <option value="Liberia"> Liberia </option>
                                                <option value="Libia"> Libia </option>
                                                <option value="Liechtenstein"> Liechtenstein </option>
                                                <option value="Lituania"> Lituania </option>
                                                <option value="Luxemburgo"> Luxemburgo </option>
                                                <option value="Macedonia del Norte"> Macedonia del Norte </option>
                                                <option value="Madagascar"> Madagascar </option>
                                                <option value="Malasia"> Malasia </option>
                                                <option value="Malaui"> Malaui </option>
                                                <option value="Maldivas"> Maldivas </option>
                                                <option value="Maldivas"> Maldivas </option>
                                                <option value="Malta"> Malta </option>
                                                <option value="Marruecos"> Marruecos </option>
                                                <option value="Mauricio"> Mauricio </option>
                                                <option value="Mauritania"> Mauritania </option>
                                                <option value="México"> México </option>
                                                <option value="Micronesia"> Micronesia </option>
                                                <option value="Moldavia"> Moldavia </option>
                                                <option value="Mónaco"> Mónaco </option>
                                                <option value="Mongolia"> Mongolia </option>
                                                <option value="Montenegro"> Montenegro </option>
                                                <option value="Mozambique"> Mozambique </option>
                                                <option value="Namibia"> Namibia </option>
                                                <option value="Nauru"> Nauru </option>
                                                <option value="Nepal"> Nepal </option>
                                                <option value="Nicaragua"> Nicaragua </option>
                                                <option value="Níger"> Níger </option>
                                                <option value="Nigeria"> Nigeria </option>
                                                <option value="Noruega"> Noruega </option>
                                                <option value="Nueva Zelanda"> Nueva Zelanda </option>
                                                <option value="Omán"> Omán </option>
                                                <option value="Países Bajos"> Países Bajos </option>
                                                <option value="Pakistán"> Pakistán </option>
                                                <option value="Palaos"> Palaos </option>
                                                <option value="Panamá"> Panamá </option>
                                                <option value="Papúa Nueva Guinea"> Papúa Nueva Guinea </option>
                                                <option value="Paraguay"> Paraguay </option>
                                                <option value="Perú"> Perú </option>
                                                <option value="Polonia"> Polonia </option>
                                                <option value="Portugal"> Portugal </option>
                                                <option value="Reino Unido"> Reino Unido </option>
                                                <option value="República Centroafricana"> República Centroafricana
                                                </option>
                                                <option value="República Checa"> República Checa </option>
                                                <option value="República del Congo"> República del Congo </option>
                                                <option value="República Democrática del Congo"> República Democrática
                                                    del
                                                    Congo </option>
                                                <option value="República Dominicana"> República Dominicana </option>
                                                <option value="República Sudafricana"> República Sudafricana </option>
                                                <option value="Ruanda"> Ruanda </option>
                                                <option value="Rumanía"> Rumanía </option>
                                                <option value="Rusia"> Rusia </option>
                                                <option value="Samoa"> Samoa </option>
                                                <option value="San Cristóbal y Nieves"> San Cristóbal y Nieves </option>
                                                <option value="San Marino"> San Marino </option>
                                                <option value="San Vicente y las Granadinas"> San Vicente y las
                                                    Granadinas
                                                </option>
                                                <option value="Santa Lucía"> Santa Lucía </option>
                                                <option value="Santo Tomé y Príncipe"> Santo Tomé y Príncipe </option>
                                                <option value="Senegal"> Senegal </option>
                                                <option value="Serbia"> Serbia </option>
                                                <option value="Seychelles"> Seychelles </option>
                                                <option value="Sierra Leona"> Sierra Leona </option>
                                                <option value="Singapur"> Singapur </option>
                                                <option value="Siria"> Siria </option>
                                                <option value="Somalia"> Somalia </option>
                                                <option value="Sri Lanka"> Sri Lanka </option>
                                                <option value="Suazilandia"> Suazilandia </option>
                                                <option value="Sudán"> Sudán </option>
                                                <option value="Sudán del Sur"> Sudán del Sur </option>
                                                <option value="Suecia"> Suecia </option>
                                                <option value="Suiza"> Suiza </option>
                                                <option value="Surinam"> Surinam </option>
                                                <option value="Tailandia"> Tailandia </option>
                                                <option value="Tanzania"> Tanzania </option>
                                                <option value="Tayikistán"> Tayikistán </option>
                                                <option value="Timor Oriental"> Timor Oriental </option>
                                                <option value="Togo"> Togo </option>
                                                <option value="Tonga"> Tonga </option>
                                                <option value="Trinidad y Tobago"> Trinidad y Tobago </option>
                                                <option value="Túnez"> Túnez </option>
                                                <option value="Turkmenistán"> Turkmenistán </option>
                                                <option value="Turquía"> Turquía </option>
                                                <option value="Tuvalu"> Tuvalu </option>
                                                <option value="Ucrania"> Ucrania </option>
                                                <option value="Uganda"> Uganda </option>
                                                <option value="Uruguay"> Uruguay </option>
                                                <option value="Uzbekistán"> Uzbekistán </option>
                                                <option value="Vanuatu"> Vanuatu </option>
                                                <option value="Venezuela"> Venezuela </option>
                                                <option value="Vietnam"> Vietnam </option>
                                                <option value="Yemen"> Yemen </option>
                                                <option value="Yibuti"> Yibuti </option>
                                                <option value="Zambia"> Zambia </option>
                                                <option value="Zimbabue"> Zimbabue </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="heard">Departamento *</label>
                                            <select name="dpto" id="dpto" class="form-control"
                                                onChange="cargarmunicipio()" required>
                                                <option value="">Seleccione</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Antioquia">Antioquia</option>
                                                <option value="Arauca">Arauca</option>
                                                <option value="Atlántico">Atlántico</option>
                                                <option value="Bogotá D.C.">Bogotá D.C.</option>
                                                <option value="Bolívar">Bolívar</option>
                                                <option value="Boyacá">Boyacá</option>
                                                <option value="Caldas">Caldas</option>
                                                <option value="Caquetá">Caquetá</option>
                                                <option value="Casanare">Cauca</option>
                                                <option value="Cauca">Cauca</option>
                                                <option value="Cesar">Cesar</option>
                                                <option value="Chocó">Chocó</option>
                                                <option value="Córdoba">Córdoba</option>
                                                <option value="Cundinamarca">Cundinamarca</option>
                                                <option value="Guaviare">Guaviare</option>
                                                <option value="Huila">Huila</option>
                                                <option value="La Guajira">La Guajira</option>
                                                <option value="Magdalena">Magdalena</option>
                                                <option value="Meta">Meta</option>
                                                <option value="Nariño">Nariño</option>
                                                <option value="Norte De Santander">Norte De Santander</option>
                                                <option value="Putumayo">Putumayo</option>
                                                <option value="Quindío">Quindío</option>
                                                <option value="Risaralda">Risaralda</option>
                                                <option value="San Andrés">San Andrés</option>
                                                <option value="Santander">Santander</option>
                                                <option value="Sucre">Sucre</option>
                                                <option value="Tolima">Tolima</option>
                                                <option value="Valle Del Cauca">Valle Del Cauca</option>
                                                <option value="Vaupés">Vaupés</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-2 m">
                                            <label for="munici">Municipio *</label>
                                            <select id="munici" name="munici" class="form-control" required>
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 col-sm-10 m">
                                            <label for="munici">Asunto *</label>
                                            <textarea rows="3" class="form-control" placeholder="Textarea"></textarea>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="prinombre">Descripción Anexos *</label>
                                            <input type="text" name="numeroident" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="prinombre">Número de Folios *</label>
                                            <input type="text" name="numeroident" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="heard">Medio Recepción *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Mensajería">Mensajería</option>
                                                <option value="Teléfono">Teléfono</option>
                                                <option value="E-mail">E-mail</option>
                                                <option value="personal">personal</option>
                                                <option value="Pagina Web">Pagina Web</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Días de Término *</label>
                                            <input type="text" name="cel" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-12  col-2 m">
                                            <label for="heard">Tipo Documental *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Acciones populares"> Acciones populares </option>
                                                <option value="Acta"> Acta </option>
                                                <option value="Acta de adjudicación o remate"> Acta de adjudicación o
                                                    remate </option>
                                                <option value="Acta de aprobación"> Acta de aprobación </option>
                                                <option value="Acta de audiencia"> Acta de audiencia </option>
                                                <option value="Acta de comité"> Acta de comité </option>
                                                <option value="Acta de Conciliación"> Acta de Conciliación </option>
                                                <option value="Acta de consejo"> Acta de consejo </option>
                                                <option value="Acta de entrega de inmueble entregado en arriendo"> Acta
                                                    de
                                                    entrega de inmueble entregado en arriendo </option>
                                                <option value="Acta de inicio"> Acta de inicio </option>
                                                <option value="Acta de liquidación"> Acta de liquidación </option>
                                                <option value="Acta de obra"> Acta de obra </option>
                                                <option value="Acta de posesión"> Acta de posesión </option>
                                                <option value="Acta de recibido"> Acta de recibido </option>
                                                <option value="Acta de reconocimiento voluntario de paternidad"> Acta de
                                                    reconocimiento voluntario de paternidad </option>
                                                <option value="Acta de reunión"> Acta de reunión </option>
                                                <option value="Acta de terminación"> Acta de terminación </option>
                                                <option value="Acta de visita"> Acta de visita </option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12  col-10 m">
                                            <label class="ckbox">
                                                <input type="checkbox" /><span>Marcar como confidencial el
                                                    radicado</span>
                                            </label>
                                        </div>
                                        <div class="col-md-12  col-2 m">
                                            <label class="ckbox">
                                                <input type="checkbox" /><span>Usted autoriza recibir respuesta por
                                                    medio de
                                                    correo electrónico</span>
                                            </label>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Dependencia responsable *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Secretaria Salud">Secretaria Salud</option>
                                                <option value="Secretaria Gobierno">Secretaria Gobierno</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Funcionario responsable *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Fernando Pérez Torres">Fernando Pérez Torres</option>
                                                <option value="Marta Rosalba Guerrero cotes">Marta Rosalba Guerrero
                                                    cotes
                                                </option>
                                            </select>
                                        </div>
                                        <div class="col-md-6  col-2 m" style="margin-top: 10px;">
                                            <label for="heard">Copia de radicado a:</label>
                                        </div>
                                        <div class="col-md-6  col-10 m" style="margin-top: 10px;">
                                            <label for="heard"></label>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Dependencia responsable *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Secretaria Salud">Secretaria Salud</option>
                                                <option value="Secretaria Gobierno">Secretaria Gobierno</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Funcionario responsable *</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Fernando Pérez Torres">Fernando Pérez Torres</option>
                                                <option value="Marta Rosalba Guerrero cotes">Marta Rosalba Guerrero
                                                    cotes
                                                </option>
                                            </select>
                                        </div>
                                        </p>
                                    </div>
                                    <br>
                                    <br>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                    value="Asignar radicado">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-ingresar-remitente" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Ingresar Remitente
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panelm">
                            <p>
                            <p><b class="moda" style="font-size: 24px;">Datos Remitente</b></p>

                            <div class="x_panelm2">
                                <div class="container">
                                    <div class="row">
                                        <p>
                                        <div class="col-md-12 col-2 m">
                                            <label for="prinombre">Nombres *</label>
                                            <input type="text" name="nombre" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>

                                        <div class="col-md-6  col-2 m">
                                            <label for="prinombre">Fecha de Ingreso *</label>
                                            <input type="date" name="fecha" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="prinombre">Cargo *</label>
                                            <input type="text" name="cargo" class="form-control"
                                                value="Coordinador de Puesto" aria-describedby="textHelp"
                                                placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="prinombre">Cedula*</label>
                                            <input type="text" name="numeroident" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Genero*</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                                <option value="LGBTI">LGBTI</option>
                                                <option value="Prefiero No decir">Prefiero No decir</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Nombres *</label>
                                            <input type="text" name="nombre" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Apellidos *</label>
                                            <input type="text" name="apellidos" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-12 col-sm-10 m">
                                            <label for="prinombre">Correo Electronico</label>
                                            <input type="text" name="correo" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Teléfono *</label>
                                            <input type="text" name="tel" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Celular *</label>
                                            <input type="text" name="cel" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">WhatsApp *</label>
                                            <input type="text" name="whats" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Dirección *</label>
                                            <input type="text" name="dir" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Barrio *</label>
                                            <input type="text" name="barrio" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Localidad *</label>
                                            <input type="text" name="locali" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Comuna *</label>
                                            <input type="text" name="comuna" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Corregimiento *</label>
                                            <input type="text" name="corregimien" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>

                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="heard">Departamento *</label>
                                            <select name="dpto" id="dpto" class="form-control"
                                                onChange="cargarmunicipio()" required>
                                                <option value="">Seleccione</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Antioquia">Antioquia</option>
                                                <option value="Arauca">Arauca</option>
                                                <option value="Atlántico">Atlántico</option>
                                                <option value="Bogotá D.C.">Bogotá D.C.</option>
                                                <option value="Bolívar">Bolívar</option>
                                                <option value="Boyacá">Boyacá</option>
                                                <option value="Caldas">Caldas</option>
                                                <option value="Caquetá">Caquetá</option>
                                                <option value="Casanare">Cauca</option>
                                                <option value="Cauca">Cauca</option>
                                                <option value="Cesar">Cesar</option>
                                                <option value="Chocó">Chocó</option>
                                                <option value="Córdoba">Córdoba</option>
                                                <option value="Cundinamarca">Cundinamarca</option>
                                                <option value="Guaviare">Guaviare</option>
                                                <option value="Huila">Huila</option>
                                                <option value="La Guajira">La Guajira</option>
                                                <option value="Magdalena">Magdalena</option>
                                                <option value="Meta">Meta</option>
                                                <option value="Nariño">Nariño</option>
                                                <option value="Norte De Santander">Norte De Santander</option>
                                                <option value="Putumayo">Putumayo</option>
                                                <option value="Quindío">Quindío</option>
                                                <option value="Risaralda">Risaralda</option>
                                                <option value="San Andrés">San Andrés</option>
                                                <option value="Santander">Santander</option>
                                                <option value="Sucre">Sucre</option>
                                                <option value="Tolima">Tolima</option>
                                                <option value="Valle Del Cauca">Valle Del Cauca</option>
                                                <option value="Vaupés">Vaupés</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="munici">Municipio *</label>
                                            <select id="munici" name="munici" class="form-control" required>
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                    value="Guardar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  modal ingresar radicacion -->
    <!--  modal Consultar usuarios -->
    <form action="guardar_coordinadores_puesto.php<?php echo '?galletaAUX=' . $galleta; ?>" method="POST"
        class="row gy-2 gx-3 align-items-center">
        <div class="modal fade bs-example-modal-consultar-usuario" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Consultar Usuario
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panel">
                            <p>
                            <div class="x_panel">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-12  col-2 m">
                                        <label for="heard">Seleccionar Dependencia *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Administrador del sistema">Administrador del sistema</option>
                                            <option value="Administrador Tablas de retención documental">Administrador
                                                Tablas de retención documental</option>
                                            <option value="Administrador del sistema">Administrador del sistema</option>
                                            <option value="Funcionario">Funcionario</option>
                                            <option value="Jefe">Jefe</option>
                                            <option value="Ventanilla de radicación">Ventanilla de radicación</option>
                                            <option value="Funcionario 2">Funcionario 2</option>
                                            <option value="Colaborador">Colaborador</option>
                                            <option value="Colaboradores">Colaboradores</option>
                                            <option value="Administrador De Actas">Administrador De Actas</option>
                                            <option value="Funcionario De Planta De Documentos">Funcionario De Planta De
                                                Documentos</option>
                                            <option value="Coordinador De Planta">Coordinador De Planta</option>
                                            <option value="Coordinador De Eventos Finales">Coordinador De Eventos
                                                Finales
                                            </option>
                                            <option value="Coordinador De Eventos">Coordinador De Eventos</option>
                                            <option value="Funcionario De Eventos">Funcionario De Eventos</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="heard">Perfil *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Jefe">Jefe</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Jefe">Jefe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="heard">Dependencia Principal *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Sistemas">Sistemas</option>
                                            <option value="Canal De Recepción">Canal De Recepción</option>
                                            <option value="Despacho Alcalde">Despacho Alcalde</option>
                                            <option value="Oficina Jurídica">Oficina Jurídica</option>
                                            <option value="Secretaria Desarrollo Económico Y Competitividad">
                                                SecretariaDesarrollo Económico Y Competitividad</option>
                                            <option value="Secretaria De Hacienda Y Finanzas Públicas">Secretaria
                                                DeHacienda
                                                Y Finanzas Públicas</option>
                                            <option value="Secretaria De Gobierno Y">Secretaria De Gobierno Y</option>
                                            <option value="Desarrollo Social">Desarrollo Social</option>
                                            <option value="Secretaria De Planeación">Secretaria De Planeación</option>
                                            <option value="Oficina De Ordenamiento">Oficina De Ordenamiento</option>
                                            <option value="Territorial Y Control Urbano">Territorial Y Control Urbano
                                            </option>
                                            <option value="Oficina De Seguridad Y Convivencia Ciudadana">Oficina
                                                DeSeguridad
                                                Y Convivencia Ciudadana</option>
                                            <option value="Secretaria De Salud Y Seguridad Social">Secretaria De Salud Y
                                                Seguridad Social</option>
                                            <option value="Secretaria De Educación">Secretaria De Educación</option>
                                            <option value="Secretaria De Turismo Y Cultura">Secretaria De Turismo
                                                YCultura
                                            </option>
                                            <option value="Sisben"> Sisben </option>
                                            <option value="Oficina De Transito Y Movilidad">Oficina De Transito Y
                                                Movilidad
                                            </option>
                                            <option value="Sistemas">Sistemas</option>
                                            <option value="Secretaria General">Secretaria General</option>
                                            <option value="Gestión Documental">Gestión Documental</option>
                                            <option value="Comisaria De Familia">Comisaria De Familia</option>
                                            <option value="Oficina De Talento Humano">Oficina De Talento Humano</option>
                                            <option value="Programas Sociales Y Especiales">Programas Sociales Y
                                                Especiales
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-2 m">
                                        <label for="prinombre">Número cédula *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="1042443778" required>
                                    </div>
                                    <div class="col-md-6 col-10 m">
                                        <label for="prinombre">Usuario *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="Carlos Perez" required>
                                    </div>
                                    <div class="col-md-12 col-sm-10 m">
                                        <label for="prinombre">E-mail</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" value="carlosAndresPerezCorcho@gmail.com" placeholder="">
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="prinombre">Fecha de Nacimiento *</label>
                                        <input name="fecha" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="12/6/1970" required>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Ubicación</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="Riohacha">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Piso</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="2">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Extención</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="236">
                                    </div>
                                    </p>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                            </p>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary boton" data-toggle="modal" data-target=".bs-example-modal-permisos">Consultar</button>

                                <input type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-consultar-usuario" value="Continuar">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-ingresar-remitente" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Ingresar Remitente
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panelm">
                            <p>
                            <p><b class="moda" style="font-size: 24px;">Datos Remitente</b></p>

                            <div class="x_panelm2">
                                <div class="container">
                                    <div class="row">
                                        <p>
                                        <div class="col-md-12 col-2 m">
                                            <label for="prinombre">Nombres *</label>
                                            <input type="text" name="nombre" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>

                                        <div class="col-md-6  col-2 m">
                                            <label for="prinombre">Fecha de Ingreso *</label>
                                            <input type="date" name="fecha" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="prinombre">Cargo *</label>
                                            <input type="text" name="cargo" class="form-control"
                                                value="Coordinador de Puesto" aria-describedby="textHelp"
                                                placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-2 m">
                                            <label for="prinombre">Cedula*</label>
                                            <input type="text" name="numeroident" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6  col-10 m">
                                            <label for="heard">Genero*</label>
                                            <select name="genero" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Femenino">Femenino</option>
                                                <option value="LGBTI">LGBTI</option>
                                                <option value="Prefiero No decir">Prefiero No decir</option>
                                                <option value="Otro">Otro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Nombres *</label>
                                            <input type="text" name="nombre" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Apellidos *</label>
                                            <input type="text" name="apellidos" class="form-control"
                                                aria-describedby="textHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-12 col-sm-10 m">
                                            <label for="prinombre">Correo Electronico</label>
                                            <input type="text" name="correo" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Teléfono *</label>
                                            <input type="text" name="tel" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Celular *</label>
                                            <input type="text" name="cel" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">WhatsApp *</label>
                                            <input type="text" name="whats" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Dirección *</label>
                                            <input type="text" name="dir" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="prinombre">Barrio *</label>
                                            <input type="text" name="barrio" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Localidad *</label>
                                            <input type="text" name="locali" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Comuna *</label>
                                            <input type="text" name="comuna" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>
                                        <div class="col-md-4 col-sm-10 m">
                                            <label for="prinombre">Corregimiento *</label>
                                            <input type="text" name="corregimien" class="form-control"
                                                aria-describedby="textHelp" placeholder="">
                                        </div>

                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="heard">Departamento *</label>
                                            <select name="dpto" id="dpto" class="form-control"
                                                onChange="cargarmunicipio()" required>
                                                <option value="">Seleccione</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Antioquia">Antioquia</option>
                                                <option value="Arauca">Arauca</option>
                                                <option value="Atlántico">Atlántico</option>
                                                <option value="Bogotá D.C.">Bogotá D.C.</option>
                                                <option value="Bolívar">Bolívar</option>
                                                <option value="Boyacá">Boyacá</option>
                                                <option value="Caldas">Caldas</option>
                                                <option value="Caquetá">Caquetá</option>
                                                <option value="Casanare">Cauca</option>
                                                <option value="Cauca">Cauca</option>
                                                <option value="Cesar">Cesar</option>
                                                <option value="Chocó">Chocó</option>
                                                <option value="Córdoba">Córdoba</option>
                                                <option value="Cundinamarca">Cundinamarca</option>
                                                <option value="Guaviare">Guaviare</option>
                                                <option value="Huila">Huila</option>
                                                <option value="La Guajira">La Guajira</option>
                                                <option value="Magdalena">Magdalena</option>
                                                <option value="Meta">Meta</option>
                                                <option value="Nariño">Nariño</option>
                                                <option value="Norte De Santander">Norte De Santander</option>
                                                <option value="Putumayo">Putumayo</option>
                                                <option value="Quindío">Quindío</option>
                                                <option value="Risaralda">Risaralda</option>
                                                <option value="San Andrés">San Andrés</option>
                                                <option value="Santander">Santander</option>
                                                <option value="Sucre">Sucre</option>
                                                <option value="Tolima">Tolima</option>
                                                <option value="Valle Del Cauca">Valle Del Cauca</option>
                                                <option value="Vaupés">Vaupés</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 col-sm-10 m">
                                            <label for="munici">Municipio *</label>
                                            <select id="munici" name="munici" class="form-control" required>
                                                <option value="">seleccione</option>
                                            </select>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                    value="Guardar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  modal ingresar radicacion -->
    <!--  modal Consultar usuarios -->
    <form action="guardar_coordinadores_puesto.php<?php echo '?galletaAUX=' . $galleta; ?>" method="POST"
        class="row gy-2 gx-3 align-items-center">
        <div class="modal fade bs-example-modal-consultar-usuario" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Consultar Usuario
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panel">
                            <p>
                            <div class="x_panel">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-12  col-2 m">
                                        <label for="heard">Seleccionar Dependencia *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Administrador del sistema">Administrador del sistema</option>
                                            <option value="Administrador Tablas de retención documental">Administrador
                                                Tablas de retención documental</option>
                                            <option value="Administrador del sistema">Administrador del sistema</option>
                                            <option value="Funcionario">Funcionario</option>
                                            <option value="Jefe">Jefe</option>
                                            <option value="Ventanilla de radicación">Ventanilla de radicación</option>
                                            <option value="Funcionario 2">Funcionario 2</option>
                                            <option value="Colaborador">Colaborador</option>
                                            <option value="Colaboradores">Colaboradores</option>
                                            <option value="Administrador De Actas">Administrador De Actas</option>
                                            <option value="Funcionario De Planta De Documentos">Funcionario De Planta De
                                                Documentos</option>
                                            <option value="Coordinador De Planta">Coordinador De Planta</option>
                                            <option value="Coordinador De Eventos Finales">Coordinador De Eventos
                                                Finales
                                            </option>
                                            <option value="Coordinador De Eventos">Coordinador De Eventos</option>
                                            <option value="Funcionario De Eventos">Funcionario De Eventos</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="heard">Perfil *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Jefe">Jefe</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Jefe">Jefe</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="heard">Dependencia Principal *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Sistemas">Sistemas</option>
                                            <option value="Canal De Recepción">Canal De Recepción</option>
                                            <option value="Despacho Alcalde">Despacho Alcalde</option>
                                            <option value="Oficina Jurídica">Oficina Jurídica</option>
                                            <option value="Secretaria Desarrollo Económico Y Competitividad">
                                                SecretariaDesarrollo Económico Y Competitividad</option>
                                            <option value="Secretaria De Hacienda Y Finanzas Públicas">Secretaria
                                                DeHacienda
                                                Y Finanzas Públicas</option>
                                            <option value="Secretaria De Gobierno Y">Secretaria De Gobierno Y</option>
                                            <option value="Desarrollo Social">Desarrollo Social</option>
                                            <option value="Secretaria De Planeación">Secretaria De Planeación</option>
                                            <option value="Oficina De Ordenamiento">Oficina De Ordenamiento</option>
                                            <option value="Territorial Y Control Urbano">Territorial Y Control Urbano
                                            </option>
                                            <option value="Oficina De Seguridad Y Convivencia Ciudadana">Oficina
                                                DeSeguridad
                                                Y Convivencia Ciudadana</option>
                                            <option value="Secretaria De Salud Y Seguridad Social">Secretaria De Salud Y
                                                Seguridad Social</option>
                                            <option value="Secretaria De Educación">Secretaria De Educación</option>
                                            <option value="Secretaria De Turismo Y Cultura">Secretaria De Turismo
                                                YCultura
                                            </option>
                                            <option value="Sisben"> Sisben </option>
                                            <option value="Oficina De Transito Y Movilidad">Oficina De Transito Y
                                                Movilidad
                                            </option>
                                            <option value="Sistemas">Sistemas</option>
                                            <option value="Secretaria General">Secretaria General</option>
                                            <option value="Gestión Documental">Gestión Documental</option>
                                            <option value="Comisaria De Familia">Comisaria De Familia</option>
                                            <option value="Oficina De Talento Humano">Oficina De Talento Humano</option>
                                            <option value="Programas Sociales Y Especiales">Programas Sociales Y
                                                Especiales
                                            </option>
                                        </select>
                                    </div>




                                    <div class="col-md-6 col-2 m">
                                        <label for="prinombre">Número cédula *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="1042443778" required>
                                    </div>
                                    <div class="col-md-6 col-10 m">
                                        <label for="prinombre">Usuario *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="Carlos Perez" required>
                                    </div>
                                    <div class="col-md-12 col-sm-10 m">
                                        <label for="prinombre">E-mail</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" value="carlosAndresPerezCorcho@gmail.com" placeholder="">
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="prinombre">Fecha de Nacimiento *</label>
                                        <input name="fecha" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="12/6/1970" required>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Ubicación</label>
                                        <input type="input" name="ubicacion" class="form-control" placeholder="" value="Riohacha">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Piso</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="2">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Extención</label>
                                        <input type="text" name="correo" class="form-control"
                                            aria-describedby="textHelp" placeholder="" value="236">
                                    </div>
                                    </p>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                            </p>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-primary boton" data-toggle="modal"
                            data-target=".bs-example-modal-permisos">Consultar</button>



                                <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                    value="Continuar">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade bs-example-modal-permisos" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Ingresar Remitente
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panelm">
                            <p>
                            <p><b class="moda" style="font-size: 24px;">Datos Remitente</b></p>

                            <div class="x_panelm2">
                                <div class="container">
                                    <div class="row">

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-primary" name="guardar_coordinadores_puesto"
                                    value="Guardar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  modal ingresar radicacion -->
    <!-- Fin Contenido -->
    <?php include('includes/footer.php'); ?>