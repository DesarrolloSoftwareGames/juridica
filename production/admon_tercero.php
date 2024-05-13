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


<button type="button" class="btn btn-primary boton" data-toggle="modal" data-target=".bs-example-modal-ingresar-elector">Agregar un tercero</button>
<div class="container">
    <div class="row">

        <div class="table-responsive">
            <script>
                const handleDeletePress = (e) => {
                    Swal.fire({
                        title: '¿Estás seguro de eliminar este remitente?',
                        text: 'No podrás revertir esta acción.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            Swal.fire(
                                'Eliminado',
                                'El remitente ha sido eliminado.',
                                'success'
                            );
                        }
                    });
                };
            </script>
            <table id="example" class="table table-striped table-bordered" width="100%">
                <thead>
                    <tr>
                        <th>NUIR</th>
                        <th>NIT</th>
                        <th>Sigla</th>
                        <th>Nombre</th>
                        <th>Correo electrónico</th>
                        <th>Representación legal</th>
                        <th>Telefono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>23452354-8</td>
                        <td>PDN</td>
                        <td>Papeles del Norte</td>
                        <td>notificaciones@nortepapeles.com</td>
                        <td>Mauricio Gonzalez</td>
                        <td>3006781234</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-editar-elector"><i class="fa fa-edit"></i></button>
                            <button type="button" onclick="handleDeletePress()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>12341234-8</td>
                        <td>PDL</td>
                        <td>Plásticos Doña Lucy LTDA.</td>
                        <td>Lucía Pertuz Nuñez</td>
                        <td>lucypm.78@hotmail.com</td>
                        <td>3124567890</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-editar-elector"><i class="fa fa-edit"></i></button>
                            <button type="button" onclick="handleDeletePress()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>85679054</td>
                        <td>JORGE DIAZ</td>
                        <td>Jorge Luis Díaz Romero</td>
                        <td>Jorge Luis Díaz Romero</td>
                        <td>jorgeldiazr89@gmail.com</td>
                        <td>3175678934</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-editar-elector"><i class="fa fa-edit"></i></button>
                            <button type="button" onclick="handleDeletePress()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>123456789</td>
                        <td>INVIMA</td>
                        <td>Instituto Nacional de Vigilancia de Medicamentos y Alimentos</td>
                        <td>Fernando Pérez Torres</td>
                        <td>contact@invima.com</td>
                        <td>3004007000</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target=".bs-example-modal-editar-elector"><i class="fa fa-edit"></i></button>
                            <button type="button" onclick="handleDeletePress()" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
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
</div>
<!--  modal ingresar radicacion -->
<form action="guardar_coordinadores_puesto.php<?php echo '?galletaAUX=' . $galleta; ?>" method="POST" class="row gy-2 gx-3 align-items-center">
    <div class="modal fade bs-example-modal-ingresar-elector" tabindex=" -1" role="dialog" aria-hidden="true">
        <script>
            const handleSubmitModal = (e) => {
                Swal.fire({
                    title: 'Datos guardados exitosamente',
                    text: 'Los datos se han guardado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            };
        </script>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                        Ingresar Tercero
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="x_panelm">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Datos Terceros</b></p>
                        <!-- boton primer modal -->
                        <div class="x_panelm2">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-4  col-2 m">
                                        <label for="prinombre">NUIR *</label>
                                        <input type="text" name="nuir" class="form-control" aria-describedby="emailHelp" placeholder="NUIR" required>
                                    </div>
                                    <div class="col-md-4 col-10 m">
                                        <label for="prinombre">NIT *</label>
                                        <input type="text" name="identificacion" class="form-control" aria-describedby="emailHelp" placeholder="NIT" required>
                                    </div>

                                    <div class="col-md-4 col-10 m">
                                        <label for="prinombre">Código suscriptor *</label>
                                        <input type="text" name="numeroident" class="form-control" aria-describedby="emailHelp" placeholder="Código suscriptor" required>
                                    </div>

                                    <div class="col-md-4  col-2 m">
                                        <label for="prinombre">Apellidos/Sigla *</label>
                                        <input type="text" name="cargo" class="form-control" value="" aria-describedby="emailHelp" placeholder="Apellidos/Sigla" required>
                                    </div>

                                    <div class="col-md-8 col-2 m">
                                        <label for="prinombre">Correo electrónico *</label>
                                        <input type="text" name="cargo" class="form-control" value="" aria-describedby="emailHelp" placeholder="Correo electrónico" required>
                                    </div>

                                    <div class="col-md-4  col-2 m">
                                        <label for="prinombre">Nombre *</label>
                                        <input type="text" name="cargo" class="form-control" value="" aria-describedby="emailHelp" placeholder="Nombre" required>
                                    </div>

                                    <div class="col-md-8 col-2 m">
                                        <label for="prinombre">Representación legal *</label>
                                        <input type="text" name="cargo" class="form-control" value="" aria-describedby="emailHelp" placeholder="Representación legal" required>
                                    </div>

                                    <div class="col-md-12 col-2 m">
                                        <label for="prinombre">Dirección completa *</label>
                                        <input type="text" name="cargo" class="form-control" value="" aria-describedby="emailHelp" placeholder="Dirección completa" required>
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
                                            <option value="Colombia">Colombia</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="heard">Departamento *</label>
                                        <select name="depa" id="depa" class="form-control" onChange="getMunicipios()" required>
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
                                        <label for="muni">Municipio *</label>
                                        <select id="muni" name="muni" class="form-control" required>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-2 m">
                                        <label for="prinombre">Teléfono 1 *</label>
                                        <input type="text" name="numeroident" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                    </div>

                                    <div class="col-md-4 col-2 m">
                                        <label for="prinombre">Teléfono 2 *</label>
                                        <input type="text" name="numeroident" class="form-control" aria-describedby="emailHelp" placeholder="" required>
                                    </div>

                                    <div class="col-md-4 col-sm-2 m">
                                        <label for="muni">¿Está activo? *</label>
                                        <select id="muni" name="muni" class="form-control" required>
                                            <option value="">seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    </p>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" onclick="handleSubmitModal()" data-dismiss="modal" class="btn btn-primary" value="Agregar tercero">
                            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<form action="guardar_coordinadores_puesto.php<?php echo '?galletaAUX=' . $galleta; ?>" method="POST" class="row gy-2 gx-3 align-items-center">
    <div class="modal fade bs-example-modal-editar-elector" tabindex=" -1" role="dialog" aria-hidden="true">
        <script>
            const handleSubmitModalEdit = (e) => {
                Swal.fire({
                    title: 'Datos actualizados exitosamente',
                    text: 'Los datos se han actualizado correctamente',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                });
            };
        </script>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="font-size:24px;" class="modal-title fa fa-user" id="myModalLabel2">&nbsp;
                        Actualización de datos
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="x_panelm">
                        <p>
                        <p><b class="moda" style="font-size: 24px;">Datos Terceros</b></p>
                        <!-- boton primer modal -->
                        <div class="x_panelm2">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-4  col-2 m">
                                        <label for="prinombre">NUIR *</label>
                                        <input type="text" name="nuir" class="form-control" aria-describedby="emailHelp" placeholder="NUIR" required disabled value="1">
                                    </div>
                                    <div class="col-md-4 col-10 m">
                                        <label for="prinombre">NIT *</label>
                                        <input type="text" name="identificacion" class="form-control" aria-describedby="emailHelp" placeholder="NIT" required disabled value="23452354-8">
                                    </div>

                                    <div class="col-md-4 col-10 m">
                                        <label for="prinombre">Código suscriptor *</label>
                                        <input type="text" name="numeroident" class="form-control" aria-describedby="emailHelp" placeholder="Código suscriptor" required disabled value="PDN">
                                    </div>

                                    <div class="col-md-4  col-2 m">
                                        <label for="prinombre">Apellidos/Sigla *</label>
                                        <input type="text" name="cargo" class="form-control" aria-describedby="emailHelp" placeholder="Apellidos/Sigla" required value="Papeles del Norte">
                                    </div>

                                    <div class="col-md-8 col-2 m">
                                        <label for="prinombre">Correo electrónico *</label>
                                        <input type="text" name="cargo" class="form-control" aria-describedby="emailHelp" placeholder="Correo electrónico" required value="notificaciones@nortepapeles.com">
                                    </div>

                                    <div class="col-md-4  col-2 m">
                                        <label for="prinombre">Nombre *</label>
                                        <input type="text" name="cargo" class="form-control" aria-describedby="emailHelp" placeholder="Nombre" required value="Mauricio Gonzalez">
                                    </div>

                                    <div class="col-md-8 col-2 m">
                                        <label for="prinombre">Representación legal *</label>
                                        <input type="text" name="cargo" class="form-control" aria-describedby="emailHelp" placeholder="Representación legal" required value="Mauricio Gonzalez">
                                    </div>

                                    <div class="col-md-12 col-2 m">
                                        <label for="prinombre">Dirección completa *</label>
                                        <input type="text" name="cargo" class="form-control" aria-describedby="emailHelp" placeholder="Dirección completa" required value="Carrera 68D # 17-11">
                                    </div>

                                    <div class="col-md-6  col-10 m">
                                        <label for="heard">Continente *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="América del Sur">América del Sur</option>
                                            <option value="">Seleccione</option>
                                            <option value="Asia">Asia</option>
                                            <option value="Africa">Africa</option>
                                            <option value="América del Norte">América del Norte</option>
                                            <option value="Antártida">Antártida</option>
                                            <option value="Europa">Europa</option>
                                            <option value="Oceanía">Oceanía</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="heard">País *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="Colombia">Colombia</option>
                                            <option value="">Seleccione</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="heard">Departamento *</label>
                                        <select name="depa" id="depa" class="form-control" onChange="getMunicipios()" required>
                                            <option value="La Guajira">La Guajira</option>
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
                                        <label for="muni">Municipio *</label>
                                        <select id="muni" name="muni" class="form-control" required>
                                            <option value="Riohacha">Riohacha</option>
                                            <option value="">seleccione</option>
                                        </select>
                                    </div>

                                    <div class="col-md-4 col-2 m">
                                        <label for="prinombre">Teléfono 1 *</label>
                                        <input type="text" name="numeroident" class="form-control" aria-describedby="emailHelp" placeholder="" required value="3006781234">
                                    </div>

                                    <div class="col-md-4 col-2 m">
                                        <label for="prinombre">Teléfono 2 *</label>
                                        <input type="text" name="numeroident" class="form-control" aria-describedby="emailHelp" placeholder="" required value="3006781234">
                                    </div>

                                    <div class="col-md-4 col-sm-2 m">
                                        <label for="muni">¿Está activo? *</label>
                                        <select id="muni" name="muni" class="form-control" required>
                                            <option value="">seleccione</option>
                                            <option value="Si">Si</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>

                                    </p>
                                </div>
                                <br>
                                <br>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" onclick="handleSubmitModalEdit()" data-dismiss="modal" class="btn btn-primary" value="Guardar cambios">
                            <input type="button" class="btn btn-primary" data-dismiss="modal" value="Cancelar">
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