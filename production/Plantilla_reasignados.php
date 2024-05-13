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
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

<!-- xxxxxxxxxxxxxxxxxx  para los botones de la tabla exportar, pdf, imprimir xxxxxxxxxxxxxxxxxxxxxxx -->
<!--
<button type="button" class="btn btn-primary boton" data-toggle="modal"
    data-target=".bs-example-modal-ingresar-elector">Ingresar Radicación</button>-->
<div class="container">
    <div class="row" id="search-box">
        <div class="x_panel">
            <p>
            <p><b class="moda" style="font-size: 24px;">Planilla Reasignados</b></p>
            <!-- boton primer modal -->
            <div class="x_panel">
                <div class="container">
                    <div class="row px-5">
                        <p>
                        <div class="col-md-6 col-2 m">
                            <label for="date-init">Fecha de inicio *</label>
                            <input id="date-init" type="date" name="date-init" class="form-control" aria-describedby="date-init" required value="<?php echo date('Y-m-d'); ?>" />
                        </div>

                        <div class="col-md-6 col-2 m">
                            <label for="date-end">Fecha de Finalización *</label>
                            <input id="date-end" type="date" name="date-end" class="form-control" aria-describedby="date-end" required value="<?php echo date('Y-m-d'); ?>" />
                        </div>

                        <div class="col-md-6 col-2 m">
                            <label for="time-init">Hora de inicio *</label>
                            <input id="time-init" type="time" name="time-init" class="form-control" aria-describedby="time-init" required value="<?php echo date('H:i'); ?>" />
                        </div>

                        <div class="col-md-6 col-2 m">
                            <label for="time-end">Hora de Finalización *</label>
                            <input id="time-end" type="time" name="time-end" class="form-control" aria-describedby="time-end" required value="<?php echo date('H:i'); ?>" />
                        </div>

                        <div class="col-md-6  col-2 m">
                            <label for="tipo-doc">Tipo de Radicación *</label>
                            <select name="tipo-doc" id="tipo-doc" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="Entrada">Entrada</option>
                                <option value="Salida">Salida</option>
                                <option value="PQRs">PQRs</option>
                            </select>
                        </div>

                        <div class="col-md-6  col-2 m">
                            <label for="heard">Dependencia *</label>
                            <select name="genero" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="Secretaria Salud">Secretaria Salud</option>
                                <option value="Secretaria Gobierno">Secretaria Gobierno</option>
                            </select>
                        </div>

                        </p>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="handleSubmit()">Genenar Planilla de Reasignados</button>
            </div>
        </div>
    </div>

    <div class="row" id="result-table" hidden>
        <div class="table-responsive">
            <table id="example" class="table table-striped table-bordered align-items-center" width="100%">
                <thead>
                    <tr>
                        <th id="" rowspan="2">Fecha de Radicado</th>
                        <th id="" rowspan="2">No. Radicado</th>
                        <th id="" colspan="2">Remitente</th>
                        <th id="" colspan="2">Destinatario</th>
                        <th id="" rowspan="2">Fecha/Hora entrega</th>
                        <th id="" rowspan="2">Firma Recibido</th>
                    </tr>
                    <tr>
                        <th id="persona1">Persona</th>
                        <th id="direccion1">Dirección</th>
                        <th id="persona2">Persona</th>
                        <th id="direccion2">Dirección</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>14/05/2024</td>
                        <td>2024-0001</td>
                        <td>INVIMA SAS</td>
                        <td>Calle 68D # 17-11</td>
                        <td>Secretaría General</td>
                        <td>Oficina 18 piso 2, Edf. Luz</td>
                        <td>--/--/---- --:--</td>
                        <td>
                            <textarea name="firma" id="firma"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>14/05/2024</td>
                        <td>2024-0002</td>
                        <td>Gobernación de Cundinamarca</td>
                        <td>
                            Carretera 7 # 32-20
                        </td>
                        <td>Secretaría General</td>
                        <td>Oficina 18 piso 2, Edf. Luz</td>
                        <td>--/--/---- --:--</td>
                        <td>
                            <textarea name="firma" id="firma"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>14/05/2024</td>
                        <td>2024-0003</td>
                        <td>Alcaldía de Bogotá</td>
                        <td>
                            Carrera 8 # 10-65
                        </td>
                        <td>Secretaría General</td>
                        <td>Oficina 18 piso 2, Edf. Luz</td>
                        <td>--/--/---- --:--</td>
                        <td>
                            <textarea name="firma" id="firma"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>14/05/2024</td>
                        <td>2024-0004</td>
                        <td>Ministerio de Salud</td>
                        <td>
                            Carrera 13 # 32-20
                        </td>
                        <td>Secretaría General</td>
                        <td>Oficina 18 piso 2, Edf. Luz</td>
                        <td>--/--/---- --:--</td>
                        <td>
                            <textarea name="firma" id="firma"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>14/05/2024</td>
                        <td>2024-0005</td>
                        <td>Ministerio de Agricultura</td>
                        <td>
                            Carrera 7 # 32-20
                        </td>
                        <td>Secretaría General</td>
                        <td>Oficina 18 piso 2, Edf. Luz</td>
                        <td>--/--/---- --:--</td>
                        <td>
                            <textarea name="firma" id="firma"></textarea>
                        </td>
                </tbody>
            </table>
        </div>
    </div>
    <!--  modal ver correo -->
    <form class="row gy-2 gx-3 align-items-center">
        <div class="modal fade bs-example-modal-ver-correo" tabindex=" -1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Vista previa correo remitente
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panelm">
                            <p>

                            <div class="x_panelm2">
                                <div class="container">
                                    <div class="row p-5">
                                        <p>
                                        <div class="col-md-6 col-2 m">
                                            <label for="identificacion">Remitente</label>
                                            <input type="text" name="identificacion" id="identificacion" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled value="contacto@invima.com">
                                        </div>
                                        <div class="col-md-6 col-2 m">
                                            <label for="ingrenombre">Asunto</label>
                                            <input id="ingrenombre" type="text" name="nombre" class="form-control" aria-describedby="name" required disabled value="REF: Solicitud de información">
                                        </div>
                                        <div class="col-md-4 col-2 m">
                                            <label for="name-razon-s">Fecha de ingreso</label>
                                            <input type="date" name="name-razon-s" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled value="14/05/2024">
                                        </div>
                                        <div class="col-md-4 col-2 m">
                                            <label for="name-razon-s">Días para Término</label>
                                            <input type="text" name="name-razon-s" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled value="30d">
                                        </div>
                                        <div class="col-md-4 col-2 m">
                                            <label for="lastaname-sigla">Dependencia</label>
                                            <input type="text" name="lastaname-sigla" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled value="Secretaria Salud">
                                        </div>
                                        <div class="col-md-12 col-2 m">
                                            <label for="tipo-rem">Contenido</label>
                                            <textarea class="form-control" id="asunto" name="asunto" rows="6" placeholder="" readonly>Se solicita información sobre los procesos de vigilancia y control de alimentos en el país.</textarea>
                                        </div>
                                        <div class="col-md-3 col-2 m">
                                            <label for="tipo-rem">Anexos</label>
                                            <input type="text" name="anexos" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled value="2">
                                        </div>
                                        <div class="col-md-3 col-2 m">
                                            <label for="tipo-rem">Folios</label>
                                            <input type="text" name="anexos" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled value="5">
                                        </div>
                                        <div class="col-md-12 col-2 m">
                                            <label for="tipo-rem">Documentos:</label>
                                            <div class="x-content">
                                                <ul>
                                                    <li>
                                                        <i>
                                                            <a href="#" class="text-primary" data-bs-dismiss="modal" data-toggle="modal" data-target=".bs-example-modal-ingresar-documento">
                                                                <i class="fas fa-paperclip"></i>
                                                                Carta solicitud de información.pdf</a>
                                                        </i>
                                                    </li>
                                                    <li>
                                                        <i>
                                                            <a href="#" class="text-primary" data-bs-dismiss="modal" data-toggle="modal" data-target=".bs-example-modal-ingresar-documento">
                                                                <i class="fas fa-paperclip"></i>
                                                                Poder autenticado.pdf</a>
                                                        </i>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        </p>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" class="btn btn-primary" data-dismiss="modal" value="Cerrar">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--  modal ingresar radicacion -->
    <div class="modal fade bs-example-modal-ingresar-remitente" tabindex=" -1" role="dialog" aria-hidden="true">
        <form class="row gy-2 gx-3 align-items-center">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                            Ingresar Remitente
                        </h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="x_panelm">
                            <p>
                            <p><b class="moda" style="font-size: 24px;">Datos Remitente</b></p>

                            <div class="x_panelm2 p-3">
                                <div class="container">
                                    <div class="row">
                                        <p>
                                        <div class="col-md-6 col-2 m">
                                            <label for="ingrenombre">Ingresar Nombre *</label>
                                            <input id="ingrenombre" type="text" name="nombre" class="form-control" aria-describedby="name" placeholder="(mínimo 3 caracteres)" required>

                                        </div>
                                        <div class="col-md-6"></div>

                                        <div class="col-md-3 col-2 m">
                                            <label for="identificacion">Número de identificación *</label>
                                            <input type="text" name="identificacion" id="identificacion" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-3 col-10 m">
                                            <label for="name-razon-s">Nombres/ Razón Social *</label>
                                            <input type="text" name="name-razon-s" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-3 col-2 m">
                                            <label for="lastaname-sigla">Apellido/ Sigla Razón Social *</label>
                                            <input type="text" name="lastaname-sigla" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-3  col-10 m">
                                            <label for="tipo-rem">Tipo remitente/ Destinatario *</label>
                                            <select name="tipo-rem" class="form-control" required>
                                                <option value="">Seleccione</option>
                                                <option value="Negocios">Negocios</option>
                                                <option value="Persona Natural">Persona Natural</option>
                                                <option value="Persona Jurídica">Persona Jurídica</option>
                                                <option value="Empresas">Empresas</option>
                                                <option value="Entidades">Entidades</option>
                                                <option value="Instituciones">Instituciones</option>
                                                <option value="Organizaciones">Organizaciones</option>
                                                <option value="Personas">Personas</option>
                                                <option value="Público">Público</option>
                                                <option value="Privado">Privado</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 col-10 m">
                                            <label for="address">Dirección *</label>
                                            <input type="text" name="address" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-4 col-2 m">
                                            <label for="phone">Teléfono *</label>
                                            <input type="text" name="phone" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-4 col-2 m">
                                            <label for="email">Correo electrónico *</label>
                                            <input type="text" name="email" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-12 col-2 m">
                                            <label for="dig-func">Dignatario/ Funcionario *</label>
                                            <input type="text" name="dig-func" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                        </div>
                                        <div class="col-md-3  col-2 m">
                                            <label for="continente">Continente *</label>
                                            <select name="continente" class="form-control" required>
                                                <option value="Seleccione">Seleccione</option>
                                                <option value="América del Sur">América del Sur</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3  col-2 m">
                                            <label for="pais">País *</label>
                                            <select name="pais" class="form-control" required>
                                                <option value="Seleccione">Seleccione</option>
                                                <option value="Colombia">Colombia</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-10 m">
                                            <label for="depa2">Departamento *</label>
                                            <select name="depa2" id="depa2" class="form-control" onChange="getMunicipios()" required>
                                                <option value="Seleccione">Seleccione</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Antioquia">Antioquia</option>
                                                <option value="Arauca">Arauca</option>
                                                <option value="Atlántico">Atlántico</option>
                                                <option value="Bogotá D.C.">Bogotá D.C.</option>
                                                <option value="Bolívar">Bolívar</option>
                                                <option value="Boyacá">Boyacá</option>
                                                <option value="Caldas">Caldas</option>
                                                <option value="Caquetá">Caquetá</option>
                                                <option value="Casanare">Casanare</option>
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
                                                <option value="Norte de Santander">Norte de Santander</option>
                                                <option value="Putumayo">Putumayo</option>
                                                <option value="Quindío">Quindío</option>
                                                <option value="Risaralda">Risaralda</option>
                                                <option value="San Andrés">San Andrés</option>
                                                <option value="Santander">Santander</option>
                                                <option value="Sucre">Sucre</option>
                                                <option value="Tolima">Tolima</option>
                                                <option value="Valle del Cauca">Valle del Cauca</option>
                                                <option value="Vaupés">Vaupés</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3 col-sm-10 m">
                                            <label for="muni2">Municipio *</label>
                                            <select name="muni2" id="muni2" class="form-control" onChange="" required>
                                                <option value="default">Municipio</option>
                                            </select>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                                <input type="submit" class="btn btn-primary" data-dismiss="modal" onclick="handleSumbitAdd()" value="Guardar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script>
        const getMunicipios = async () => {
            const departamento = document.getElementById('depa').value;
            fetch(
                `../utils/municipios.json`
            ).then((res) => res.json()).then((data) => {
                const municipios = data.filter((municipio) => municipio.departamento === departamento).map((municipio) => municipio.municipio);
                const selectMunicipio = document.getElementById('muni');
                selectMunicipio.innerHTML = '';
                municipios.forEach((municipio) => {
                    const option = document.createElement('option');
                    option.value = municipio;
                    option.text = municipio;
                    selectMunicipio.appendChild(option);
                });
            });
        };

        const loadMunicipios = (dept) => {
            fetch(
                `../utils/municipios.json`
            ).then((res) => res.json()).then((data) => {
                const municipios = data.filter((municipio) => municipio.departamento === dept).map((municipio) => municipio.municipio);
                const selectMunicipio = document.getElementById('muni');
                selectMunicipio.innerHTML = '';
                municipios.forEach((municipio) => {
                    const option = document.createElement('option');
                    option.value = municipio;
                    option.text = municipio;
                    selectMunicipio.appendChild(option);
                });
            });
        };

        const nameRef = document.getElementById('ingrenombre');
        nameRef.addEventListener('change', () => {
            document.getElementById('identificacion').value = '1234567890';
            document.getElementsByName('phone')[0].value = '1234567890';
            document.getElementsByName('email')[0].value = 'contacto@invima.com';
            document.getElementsByName('name-razon-s')[0].value = 'Instituto Nacional de Vigilancia de Medicamentos y Alimentos';
            document.getElementsByName('lastaname-sigla')[0].value = 'Invima';
            document.getElementsByName('tipo-rem')[0].value = 'Empresas';
            document.getElementsByName('address')[0].value = 'Carrera 68D # 17-11';
            document.getElementsByName('continente')[0].value = 'América del Sur';
            document.getElementsByName('pais')[0].value = 'Colombia';
            loadMunicipios('Bogotá D.C.');
            document.getElementsByName('depa')[0].value = 'Bogotá D.C.';
            document.getElementsByName('muni')[0].value = 'Bogotá D.C.';
        });

        const handleSubmit = (e) => {
            Swal.fire({
                title: 'Planilla Generada exitosamente',
                text: 'La planilla se ha generado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
            document.getElementById('result-table').removeAttribute('hidden');
            document.getElementById('search-box').setAttribute('hidden', true);
        };
        const handleSumbitAdd = (e) => {
            Swal.fire({
                title: 'Remitente Agregado exitosamente',
                text: 'El remitente se ha agregado correctamente.',
                icon: 'success',
                confirmButtonText: 'Aceptar'
            });
        };
    </script>

    <!--  modal ingresar radicacion -->
    <!-- Fin Contenido -->
    <?php include('includes/footer.php'); ?>