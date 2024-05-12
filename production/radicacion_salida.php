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
    <div class="row">
        <div class="x_panel">
            <p>
            <p><b class="moda" style="font-size: 24px;">Destinatario</b></p>
            <!-- boton primer modal -->
            <div class="x_panel">
                <div class="container">
                    <div class="row">
                        <p>
                        <div class="col-md-6 col-2 m">
                            <label for="ingrenombre">Ingresar Nombre *</label>
                            <input list="options" id="ingrenombre" type="text" name="nombre" class="form-control" aria-describedby="name" placeholder="(mínimo 3 caracteres)" required>
                            <datalist id="options">
                                <option value="INVIMA SAS"></option>
                            </datalist>
                        </div>
                        <div class="col-md-6 d-flex align-items-start justify-content-end pb-4" style="align-self: flex-end;">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-toggle="modal" data-target=".bs-example-modal-ingresar-remitente">
                                Agregar Remitente
                            </button>
                        </div>
                        <div class="col-md-3 col-2 m">
                            <label for="identificacion">Número de identificación *</label>
                            <input type="text" name="identificacion" id="identificacion" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled>
                        </div>
                        <div class="col-md-3 col-10 m">
                            <label for="name-razon-s">Nombres/ Razón Social *</label>
                            <input type="text" name="name-razon-s" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled>
                        </div>
                        <div class="col-md-3 col-2 m">
                            <label for="lastaname-sigla">Apellido/ Sigla *</label>
                            <input type="text" name="lastaname-sigla" class="form-control" aria-describedby="emailHelp" placeholder="" required disabled>
                        </div>
                        <div class="col-md-3  col-10 m">
                            <label for="tipo-rem">Tipo remitente/ Destinatario *</label>
                            <select name="tipo-rem" class="form-control" required disabled>
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
                            <label for="depa">Departamento *</label>
                            <select name="depa" id="depa" class="form-control" onChange="getMunicipios()" required>
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
                            <label for="muni">Municipio *</label>
                            <select name="muni" id="muni" class="form-control" onChange="" required></select>
                        </div>

                        <div class="col-md-12 col-sm-10 m">
                            <label for="asunto">Asunto *</label>
                            <textarea class="form-control" id="asunto" name="asunto" rows="3" placeholder=""></textarea>
                        </div>

                        <div class="col-md-3  col-2 m">
                            <label for="anexos">Cantidad Anexos *</label>
                            <input type="text" name="anexos" class="form-control" aria-describedby="emailHelp" list="options-anexos" placeholder="" required>
                            <datalist id="options-anexos">
                                <option value="0"></option>
                                <option value="1"></option>
                                <option value="2"></option>
                                <option value="3"></option>
                                <option value="4"></option>
                                <option value="5"></option>
                                <option value="6"></option>
                                <option value="7"></option>
                                <option value="8"></option>
                                <option value="9"></option>
                                <option value="10"></option>
                            </datalist>
                        </div>
                        <div class="col-md-3  col-2 m">
                            <label for="medio-envio">Medio Envío *</label>
                            <select name="medio-envio" id="medio-envio" class="form-control" required>
                                <option value="Seleccione">Seleccione</option>
                                <option value="Mensajería">Mensajería</option>
                                <option value="Teléfono">Teléfono</option>
                                <option value="Personal">Personal</option>
                                <option value="Correo electrónico">Correo electrónico</option>
                                <option value="Página web">Página web</option>
                            </select>
                        </div>
                        <div class="col-md-3  col-2 m">
                            <label for="tipo-doc">Tipo Documental *</label>
                            <select name="tipo-doc" id="tipo-doc" class="form-control" required>
                                <option value="Seleccione">Seleccione</option>
                                <option value="	Acciones populares	"> Acciones populares </option>
                                <option value="	Acta"> Acta </option>
                                <option value="Acta de adjudicación o remate"> Acta de adjudicación o
                                    remate </option>
                                <option value="Acta de aprobación"> Acta de aprobación </option>
                                <option value="Acta de audiencia"> Acta de audiencia </option>
                                <option value="Acta de comité"> Acta de comité </option>
                                <option value="Acta de Conciliación"> Acta de Conciliación </option>
                                <option value="Acta de consejo"> Acta de consejo </option>
                                <option value="Acta de entrega de inmueble entregado en arriendo"> Acta de
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

                        <div class="col-md-3  col-2 m">
                            <label for="dias-ter">Días de Término *</label>
                            <input placeholder="30" type="text" id="dias-ter" name="dias-ter" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                        </div>

                        <div class="col-md-12  col-10 my-4">
                            <label class="ckbox">
                                <input id="confidencial" name="confidencial" type="checkbox" /><span>Marcar como confidencial el radicado</span>
                            </label>
                        </div>


                        <div class="col-md-6  col-2 m">
                            <label for="heard">Dependencia *</label>
                            <select name="genero" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="Secretaria Salud">Secretaria Salud</option>
                                <option value="Secretaria Gobierno">Secretaria Gobierno</option>
                            </select>
                        </div>

                        <div class="col-md-6  col-2 m">
                            <label for="resp-user">Usuario Responsable *</label>
                            <input disabled type="text" name="resp-user" class="form-control" aria-describedby="emailHelp" placeholder="Usuario de Soporte" required>
                        </div>

                        <div class="col-md-6  col-2 m" style="margin-top: 10px;">
                            <label for="heard">Copia de radicado a:</label>
                        </div>
                        <div class="col-md-6  col-10 m" style="margin-top: 10px;">
                            <label for="heard"></label>
                        </div>
                        <div class="col-md-6  col-10 m">
                            <label for="heard">Dependencias *</label>
                            <select name="genero" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="Secretaria Salud">Secretaria Salud</option>
                                <option value="Secretaria Gobierno">Secretaria Gobierno</option>
                            </select>
                        </div>
                        <div class="col-md-6  col-10 m">
                            <label for="heard">Usuarios *</label>
                            <select name="genero" class="form-control" required>
                                <option value="">Seleccione</option>
                                <option value="Fernando Pérez Torres">Fernando Pérez Torres</option>
                                <option value="Marta Rosalba Guerrero cotes">Marta Rosalba Guerrero cotes
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
                <button type="button" class="btn btn-primary" onclick="handleSubmit()">Asignar Radicado</button>

            </div>
        </div>

    </div>
</div>
<!--  modal ingresar radicacion -->
<form class="row gy-2 gx-3 align-items-center">
    <div class="modal fade bs-example-modal-ingresar-remitente" tabindex=" -1" role="dialog" aria-hidden="true">
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
    </div>
</form>
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
            title: 'Documento Radicado exitosamente',
            text: 'El documento se ha radicado correctamente.',
            icon: 'success',
            confirmButtonText: 'Aceptar'
        });
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