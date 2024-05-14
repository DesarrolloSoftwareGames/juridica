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
            <p><b class="moda" style="font-size: 24px;">Asociar Anexo a Radicado</b></p>
            <!-- boton primer modal -->
            <div class="x_panel">
                <div class="container">
                    <div class="row px-5">
                        <p>
                        <div class="col-md-12 col-6 m">
                            <label for="rad-search">Número de Radicado *</label>
                            <input id="rad-search" type="text" name="rad-search" class="form-control" aria-describedby="rad-search" required />
                        </div>
                        </p>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" onclick="handleSubmit()">Buscar</button>
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
                        <th id="" rowspan="2">Anexo(s)</th>
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
                        <td>
                            <button id="add-file-button" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-ingresar-remitente">Asociar Anexo</button>
                            <a href="#" id="file-name" hidden data-toggle="modal" data-target=".bs-example-modal-ver-anexo">anexo1.pdf</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
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
                        Asociar Anexo a Radicado
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="x_panelm">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Asociar Anexo a Radicado</b></p>

                        <div class="x_panelm2 p-3">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-12 col-2 m">
                                        <label for="ingre-pdf">Seleccione un archivo *</label>
                                        <input id="ingre-pdf" type="file" name="ingre-pdf" class="form-control" aria-describedby="name" required>
                                    </div>
                                    <div class="col-md-12 col-2 m">
                                        <label for="ingre-pdf-desc">Descripción del archivo *</label>
                                        <textarea class="form-control" id="ingre-pdf-desc" name="ingre-pdf-desc" rows="6" placeholder="" required></textarea>
                                    </div>
                                    <div class="col-md-12 col-2 m">
                                        <label for="ingre-pdf-prev">Previsualización *</label>
                                        <embed id="anexo-prev" src="" type="application/pdf" width="100%" height="600px" />

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
<div class="modal fade bs-example-modal-ver-anexo" tabindex=" -1" role="dialog" aria-hidden="true">
    <form class="row gy-2 gx-3 align-items-center">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                        Inspeccionar Anexo de Radicado
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="x_panelm">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Inspeccionar Anexo de Radicado</b></p>

                        <div class="x_panelm2 p-3">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-12 col-2 m">
                                        <label for="ingre-img-prev">Previsualización *</label>
                                        <embed id="anexo-prev" src="../utils/anexo1.pdf" type="application/pdf" width="100%" height="600px" />
                                    </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cerrar">
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
        // Swal.fire({
        //     title: 'Planilla Generada exitosamente',
        //     text: 'La planilla se ha generado correctamente.',
        //     icon: 'success',
        //     confirmButtonText: 'Aceptar'
        // });
        document.getElementById('result-table').removeAttribute('hidden');
        document.getElementById('search-box').setAttribute('hidden', true);
    };
    const handleSumbitAdd = (e) => {
        Swal.fire({
            title: 'Anexo Asociado exitosamente',
            text: 'El anexo se ha asociado correctamente',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
        document.getElementById('file-name').removeAttribute('hidden');
        document.getElementById('add-file-button').setAttribute('hidden', true);
    };

    document.getElementById('ingre-pdf').addEventListener('change', (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = (e) => {
            document.getElementById('anexo-prev').src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>

<!--  modal ingresar radicacion -->
<!-- Fin Contenido -->
<?php include('includes/footer.php'); ?>