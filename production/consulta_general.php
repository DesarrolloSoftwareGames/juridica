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

<!-- Inicio modulo de Consultas generales-->
<nav>
  <div class="nav nav-tabs" id="nav-tab" role="tablist">
    <a class="btn btn-primary m-1" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Búsqueda Clásica</a>
    <a class="btn btn-info m-1" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Buscar Expedientes</a>
  </div>
</nav>
<div class="tab-content mt-5" id="nav-tabContent">
  <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

  <h1>Búsqueda Clásica</h1>   
<div class="container mt-2">
        <form action="#">
            <div class="form-group row">
                <label for="radicado" class="col-sm-2 col-form-label">Radicado:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="radicado" name="radicado">
                </div>
            </div>

            <div class="form-group row">
                <label for="identificacion" class="col-sm-2 col-form-label">Identificación (T.I.C.C,Nit):</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="identificacion" name="identificacion">
                </div>
            </div>

            <div class="form-group row">
                <label for="expediente" class="col-sm-2 col-form-label">Expediente:</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="expediente" name="expediente">
                </div>
            </div>

            <div class="form-group row">
                <label for="filtrar_por" class="col-sm-2 col-form-label">Filtrar por:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="filtrar_por" name="filtrar_por">
                        <option value="">Todos</option>
                        <option value="radicado">Radicado</option>
                        <option value="identificacion">Identificación</option>
                        <option value="expediente">Expediente</option>
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="ver_en_listado" name="ver_en_listado">
                        <label class="form-check-label" for="ver_en_listado">Ver en Listado</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="buscar_ciudadanos" name="buscar_ciudadanos">
                        <label class="form-check-label" for="buscar_ciudadanos">Buscar Ciudadanos</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="buscar_en_terceros" name="buscar_en_terceros">
                        <label class="form-check-label" for="buscar_en_terceros">Buscar en Terceros</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="buscar_en_empresas" name="buscar_en_empresas">
                        <label class="form-check-label" for="buscar_en_empresas">Buscar en Empresas</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input type="checkbox" class="form-check-input" id="buscar_funcionarios" name="buscar_funcionarios">
                        <label class="form-check-label" for="buscar_funcionarios">Buscar Funcionarios</label>
                    </div>
                </div>
            </div>

            <div class="form-group row">
            <label for="buscar_por_radicados" class="col-sm-2 col-form-label">Buscar en Radicados:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="buscar_por_radicados" name="buscar_por_radicados">
                        <option value="">Todos los Tipos (-1,-2,-3,-5,...)</option>
                        <option value="tipo1">Entrada</option>
                        <option value="tipo2">Pqrsd</option>
                        <option value="tipo3">Salida</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group row">
                <label for="fecha_desde" class="col-sm-2 col-form-label">Fecha desde:</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="fecha_desde" name="fecha_desde">
                </div>
                <label for="fecha_hasta" class="col-sm-2 col-form-label">Fecha hasta:</label>
                <div class="col-sm-4">
                    <input type="date" class="form-control" id="fecha_hasta" name="fecha_hasta">
                </div>
            </div>

            <div class="form-group row">
                <label for="tipo_documento" class="col-sm-2 col-form-label">Tipo de documento:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="tipo_documento" name="tipo_documento">
                        <option value="">Seleccione un tipo de documento</option>
                        <option value="comunicacion_oficial">Comunicación oficial</option>
                        <option value="expediente">Expediente</option>
                        <option value="acta_anulacion_radicado">Acta de anulación de radicado</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="dependencia" class="col-sm-2 col-form-label">Dependencia:</label>
                <div class="col-sm-10">
                    <select class="form-control" id="dependencia" name="dependencia">
                        <option value="">Seleccione una dependencia</option>
                        <option value="CANAL DE RECEPCIÓN">CANAL DE RECEPCIÓN</option>
                        <option value="DESPACHO ALCALDE">DESPACHO ALCALDE</option>
                        <option value="OFICINA JURIDICA">OFICINA JURIDICA</option>
                        <option value="SECRETARIA DESARROLLO ECONOMICO Y COMPETITIVIDAD">SECRETARIA DESARROLLO ECONOMICO Y COMPETITIVIDAD</option>
                        <option value="SECRETARIA DE HACIENDA Y FINANZAS PUBLICAS">SECRETARIA DE HACIENDA Y FINANZAS PUBLICAS</option>
                        <option value="SECRETARIA DE GOBIERNO Y DESARROLLO SOCIAL">SECRETARIA DE GOBIERNO Y DESARROLLO SOCIAL</option>
                        <option value="SECCRETARIA DE PLANEACION">SECCRETARIA DE PLANEACION</option>
                        <option value="OFICINA DE ORDENAMIENTO TERRITORIAL Y CONTROL URBANO">OFICINA DE ORDENAMIENTO TERRITORIAL Y CONTROL URBANO</option>
                        <option value="OFICINA DE SEGURIDAD Y CONVIVENCIA CIUDADANA">OFICINA DE SEGURIDAD Y CONVIVENCIA CIUDADANA</option>
                        <option value="SECRETARIA DE SALUD Y SEGURIDAD SOCIAL">SECRETARIA DE SALUD Y SEGURIDAD SOCIAL</option>
                        <option value="SECRETARIA DE EDUCACION">SECRETARIA DE EDUCACION</option>
                        <option value="SECRETARIA DE TURISMO Y CULTURA">SECRETARIA DE TURISMO Y CULTURA</option>
                        <option value="SISBEN">SISBEN</option>
                        <option value="OFICINA DE TRANSITO Y MOVILIDAD">OFICINA DE TRANSITO Y MOVILIDAD</option>
                        <option value="SECRETARIA GENERAL">SECRETARIA GENERAL</option>
                        <option value="GESTION DOCUMENTAL">GESTION DOCUMENTAL</option>
                        <option value="COMISARIA DE FAMILIA">COMISARIA DE FAMILIA</option>
                        <option value="OFICINA DE TALENTO HUMANO">OFICINA DE TALENTO HUMANO</option>
                        <option value="PROGRAMAS SOCIALES Y ESPECIALES">PROGRAMAS SOCIALES Y ESPECIALES</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-10 offset-sm-2">
                <button type="button" class="btn btn-primary" onclick="mostrarResultados()">Búsqueda</button>
                <button type="button" class="btn btn-secondary"  onclick="limpiarTablaResultados()">Limpiar</button>
                </div>
            </div>
        </form>
    </div>
  </div>
    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
    <h1>Búsqueda de Expedientes</h1>
    <form action="#">
      <div class="form-group">
        <label for="numeroExpediente">Número del Expediente</label>
        <input type="text" class="form-control" id="numeroExpediente" placeholder="Ingrese el número del expediente">
      </div>

      <div class="form-group">
        <label for="nombreExpediente">Nombre del Expediente</label>
        <input type="text" class="form-control" id="nombreExpediente" placeholder="Ingrese el nombre del expediente">
      </div>

      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="fechaRadicacionInicial">Fecha radicación inicial</label>
          <input type="date" class="form-control" id="fechaRadicacionInicial">
        </div>

        <div class="form-group col-md-6">
          <label for="fechaRadicacionFinal">Fecha radicación final</label>
          <input type="date" class="form-control" id="fechaRadicacionFinal">
        </div>
      </div>

      <div class="form-group">
        <label for="serie">Serie</label>
        <select class="form-control" id="serie">
          <option value="">Seleccione</option>
          <option value="serie1">Serie 1</option>
          <option value="serie2">Serie 2</option>
          <option value="serie3">Serie 3</option>
        </select>
      </div>

      <div class="form-group">
        <label for="subserie">SubSerie</label>
        <select class="form-control" id="subserie">
          <option value="">Seleccione</option>
          <option value="subserie1">SubSerie 1</option>
          <option value="subserie2">SubSerie 2</option>
          <option value="subserie3">SubSerie 3</option>
        </select>
      </div>

      <div class="form-group">
        <label for="dependenciaDuenia">Dependencia dueña del expediente</label>
            <select class="form-control" id="dependenciaDuenia" name="dependencia">
                        <option value="">Seleccione una dependencia</option>
                        <option value="CANAL DE RECEPCIÓN">CANAL DE RECEPCIÓN</option>
                        <option value="DESPACHO ALCALDE">DESPACHO ALCALDE</option>
                        <option value="OFICINA JURIDICA">OFICINA JURIDICA</option>
                        <option value="SECRETARIA DESARROLLO ECONOMICO Y COMPETITIVIDAD">SECRETARIA DESARROLLO ECONOMICO Y COMPETITIVIDAD</option>
                        <option value="SECRETARIA DE HACIENDA Y FINANZAS PUBLICAS">SECRETARIA DE HACIENDA Y FINANZAS PUBLICAS</option>
                        <option value="SECRETARIA DE GOBIERNO Y DESARROLLO SOCIAL">SECRETARIA DE GOBIERNO Y DESARROLLO SOCIAL</option>
                        <option value="SECCRETARIA DE PLANEACION">SECCRETARIA DE PLANEACION</option>
                        <option value="OFICINA DE ORDENAMIENTO TERRITORIAL Y CONTROL URBANO">OFICINA DE ORDENAMIENTO TERRITORIAL Y CONTROL URBANO</option>
                        <option value="OFICINA DE SEGURIDAD Y CONVIVENCIA CIUDADANA">OFICINA DE SEGURIDAD Y CONVIVENCIA CIUDADANA</option>
                        <option value="SECRETARIA DE SALUD Y SEGURIDAD SOCIAL">SECRETARIA DE SALUD Y SEGURIDAD SOCIAL</option>
                        <option value="SECRETARIA DE EDUCACION">SECRETARIA DE EDUCACION</option>
                        <option value="SECRETARIA DE TURISMO Y CULTURA">SECRETARIA DE TURISMO Y CULTURA</option>
                        <option value="SISBEN">SISBEN</option>
                        <option value="OFICINA DE TRANSITO Y MOVILIDAD">OFICINA DE TRANSITO Y MOVILIDAD</option>
                        <option value="SECRETARIA GENERAL">SECRETARIA GENERAL</option>
                        <option value="GESTION DOCUMENTAL">GESTION DOCUMENTAL</option>
                        <option value="COMISARIA DE FAMILIA">COMISARIA DE FAMILIA</option>
                        <option value="OFICINA DE TALENTO HUMANO">OFICINA DE TALENTO HUMANO</option>
                        <option value="PROGRAMAS SOCIALES Y ESPECIALES">PROGRAMAS SOCIALES Y ESPECIALES</option>
                </select>
        </div>

      <button type="button" class="btn btn-primary" onclick="mostrarResultados()">Búsqueda</button>
      <button type="button" class="btn btn-secondary"  onclick="limpiarTablaResultados()">Limpiar</button>
    </form>
    </div>

    <div id="resultadosBusqueda" class="mt-3">
        <h2>Resultados de la búsqueda</h2>
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Número Radicado</th>
                <th>Fecha Radicación</th>
                <th>Número Expediente</th>
                <th>Responsable</th>
                <th>Nombre</th>
                <th>Asunto</th>
                <th>Serie</th>
                <th>Número Asociado</th>
                <th>Tipo</th>
                <th>Nombre Funcionario</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!-- codigo Js para los resultados de busqueda -->
<script>
function limpiarTablaResultados() {
  const tablaResultados = document.getElementById('resultadosBusqueda').getElementsByTagName('tbody')[0];
  tablaResultados.innerHTML = '';
}

function mostrarResultados() {
  // Obtener los datos de la búsqueda
  const numeroExpediente = document.getElementById('numeroExpediente').value;
  const nombreExpediente = document.getElementById('nombreExpediente').value;
  const fechaRadicacionInicial = document.getElementById('fechaRadicacionInicial').value;
  const fechaRadicacionFinal = document.getElementById('fechaRadicacionFinal').value;
  const serie = document.getElementById('serie').value;
  const subserie = document.getElementById('subserie').value;
  const dependenciaDuenia = document.getElementById('dependenciaDuenia').value;

  // Simular la consulta a la base de datos (reemplazar con la consulta real)
  const resultadosBusqueda = [
    {
      numeroRadicado: '2023-E-12345',
      fechaRadicacion: '2023-11-14',
      numeroExpediente: 'EXP-12345',
      responsable: 'Juan Pérez',
      nombre: 'Solicitud de licencia',
      asunto: 'Permisos',
      serie: 'Serie 1',
      numeroRadicadoAsociado: '2023-E-67890',
      tipo: 'Memorando',
      nombreFuncionario: 'María Gómez'
    },
    {
      numeroRadicado: '2024-E-56789',
      fechaRadicacion: '2024-05-11',
      numeroExpediente: 'EXP-56789',
      responsable: 'Ana López',
      nombre: 'Informe de actividades',
      asunto: 'Seguimiento proyecto X',
      serie: 'Serie 2',
      numeroRadicadoAsociado: '2024-E-23456',
      tipo: 'Carta',
      nombreFuncionario: 'Carlos Ramírez'
    },
    // Agregar más filas de resultados según sea necesario
  ];

  // Limpiar la tabla de resultados previos
  const tablaResultados = document.getElementById('resultadosBusqueda').getElementsByTagName('tbody')[0];
  tablaResultados.innerHTML = '';

  // Llenar la tabla con los nuevos resultados
  for (const resultado of resultadosBusqueda) {
    const fila = tablaResultados.insertRow();

    const celdaNumeroRadicado = fila.insertCell();
    celdaNumeroRadicado.textContent = resultado.numeroRadicado;

    const celdaFechaRadicacion = fila.insertCell();
    celdaFechaRadicacion.textContent = resultado.fechaRadicacion;

    const celdaNumeroExpediente = fila.insertCell();
    celdaNumeroExpediente.textContent = resultado.numeroExpediente;

    const celdaResponsable = fila.insertCell();
    celdaResponsable.textContent = resultado.responsable;

    const celdaNombre = fila.insertCell();
    celdaNombre.textContent = resultado.nombre;

    const celdaAsunto = fila.insertCell();
    celdaAsunto.textContent = resultado.asunto;

    const celdaSerie = fila.insertCell();
    celdaSerie.textContent = resultado.serie;

    const celdaNumeroRadicadoAsociado = fila.insertCell();
    celdaNumeroRadicadoAsociado.textContent = resultado.numeroRadicadoAsociado;

    const celdaTipo = fila.insertCell();
    celdaTipo.textContent = resultado.tipo;

    const celdaNombreFuncionario = fila.insertCell();
    celdaNombreFuncionario.textContent = resultado.nombreFuncionario;
  }
}
</script>
<!-- Fin de modulo de tablas de Consultas generales -->
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
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-toggle="modal"
                                data-target=".bs-example-modal-ingresar-remitente">
                                Ingresar Remitente</button>
                        </div>
                        <div class="x_panelm2">
                            <div class="container">
                                <div class="row">
                                    <p>
                                    <div class="col-md-12  col-2 m">
                                        <label for="prinombre">Fecha de Ingreso *</label>
                                        <input type="date" name="fecha" class="form-control"
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6 col-10 m">
                                        <label for="prinombre">Número Identificación *</label>
                                        <input type="text" name="identificacion" class="form-control"
                                            aria-describedby="emailHelp" placeholder="" required>
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
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="prinombre">Apellidos/Sigla *</label>
                                        <input type="text" name="cargo" class="form-control"
                                            value="Coordinador de Puesto" aria-describedby="emailHelp" placeholder=""
                                            required>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Dirección *</label>
                                        <input type="text" name="dir" class="form-control" aria-describedby="emailHelp"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-6 col-sm-2 m">
                                        <label for="prinombre">Teléfono *</label>
                                        <input type="text" name="tel" class="form-control" aria-describedby="emailHelp"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-12 col-sm-10 m">
                                        <label for="prinombre">E-mail</label>
                                        <input type="email" name="correo" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="col-md-12 col-sm-2 m">
                                        <label for="prinombre">Dignatario/ Funcionario</label>
                                        <input type="email" name="correo" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
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
                                            <option value="Afganistán	"> Afganistán </option>
                                            <option value="Albania	"> Albania </option>
                                            <option value="Alemania	"> Alemania </option>
                                            <option value="Andorra	"> Andorra </option>
                                            <option value="Angola	"> Angola </option>
                                            <option value="Antigua y Barbuda	"> Antigua y Barbuda </option>
                                            <option value="Arabia Saudita	"> Arabia Saudita </option>
                                            <option value="Argelia	"> Argelia </option>
                                            <option value="Argentina	"> Argentina </option>
                                            <option value="Armenia	"> Armenia </option>
                                            <option value="Australia	"> Australia </option>
                                            <option value="Austria	"> Austria </option>
                                            <option value="Azerbaiyán	"> Azerbaiyán </option>
                                            <option value="Bahamas	"> Bahamas </option>
                                            <option value="Bangladés	"> Bangladés </option>
                                            <option value="Barbados	"> Barbados </option>
                                            <option value="Baréin	"> Baréin </option>
                                            <option value="	Bélgica	"> Bélgica </option>
                                            <option value="	Belice	"> Belice </option>
                                            <option value="	Benín	"> Benín </option>
                                            <option value="	Bielorrusia	"> Bielorrusia </option>
                                            <option value="	Birmania	"> Birmania </option>
                                            <option value="	Bolivia	"> Bolivia </option>
                                            <option value="	Bosnia y Herzegovina	"> Bosnia y Herzegovina </option>
                                            <option value="	Botsuana	"> Botsuana </option>
                                            <option value="	Brasil	"> Brasil </option>
                                            <option value="	Brunéi	"> Brunéi </option>
                                            <option value="	Bulgaria	"> Bulgaria </option>
                                            <option value="	Burkina Faso	"> Burkina Faso </option>
                                            <option value="	Burundi	"> Burundi </option>
                                            <option value="	Bután	"> Bután </option>
                                            <option value="	Cabo Verde	"> Cabo Verde </option>
                                            <option value="	Camboya	"> Camboya </option>
                                            <option value="	Camerún	"> Camerún </option>
                                            <option value="	Canadá	"> Canadá </option>
                                            <option value="	Catar	"> Catar </option>
                                            <option value="	Chad	"> Chad </option>
                                            <option value="	Chile	"> Chile </option>
                                            <option value="	China	"> China </option>
                                            <option value="	Chipre	"> Chipre </option>
                                            <option value="	Ciudad del Vaticano	"> Ciudad del Vaticano </option>
                                            <option value="	Colombia	"> Colombia </option>
                                            <option value="	Comoras	"> Comoras </option>
                                            <option value="	Corea del Norte	"> Corea del Norte </option>
                                            <option value="	Corea del Sur	"> Corea del Sur </option>
                                            <option value="	Costa de Marfil	"> Costa de Marfil </option>
                                            <option value="	Costa Rica	"> Costa Rica </option>
                                            <option value="	Croacia	"> Croacia </option>
                                            <option value="	Cuba	"> Cuba </option>
                                            <option value="	Dinamarca	"> Dinamarca </option>
                                            <option value="	Dominica	"> Dominica </option>
                                            <option value="	Ecuador	"> Ecuador </option>
                                            <option value="	Egipto	"> Egipto </option>
                                            <option value="	El Salvador	"> El Salvador </option>
                                            <option value="	Emiratos Árabes Unidos	"> Emiratos Árabes Unidos </option>
                                            <option value="	Eritrea	"> Eritrea </option>
                                            <option value="	Eslovaquia	"> Eslovaquia </option>
                                            <option value="	Eslovenia	"> Eslovenia </option>
                                            <option value="	España	"> España </option>
                                            <option value="	Estados Unidos	"> Estados Unidos </option>
                                            <option value="	Estonia	"> Estonia </option>
                                            <option value="	Etiopía	"> Etiopía </option>
                                            <option value="	Filipinas	"> Filipinas </option>
                                            <option value="	Finlandia	"> Finlandia </option>
                                            <option value="	Fiyi	"> Fiyi </option>
                                            <option value="	Francia	"> Francia </option>
                                            <option value="	Gabón	"> Gabón </option>
                                            <option value="	Gambia	"> Gambia </option>
                                            <option value="	Georgia	"> Georgia </option>
                                            <option value="	Ghana	"> Ghana </option>
                                            <option value="	Granada	"> Granada </option>
                                            <option value="	Grecia	"> Grecia </option>
                                            <option value="	Guatemala	"> Guatemala </option>
                                            <option value="	Guyana	"> Guyana </option>
                                            <option value="	Guinea	"> Guinea </option>
                                            <option value="	Guinea ecuatorial	"> Guinea ecuatorial </option>
                                            <option value="	Guinea-Bisáu	"> Guinea-Bisáu </option>
                                            <option value="	Haití	"> Haití </option>
                                            <option value="	Honduras	"> Honduras </option>
                                            <option value="	Hungría	"> Hungría </option>
                                            <option value="	India	"> India </option>
                                            <option value="	Indonesia	"> Indonesia </option>
                                            <option value="	Irak	"> Irak </option>
                                            <option value="	Irán	"> Irán </option>
                                            <option value="	Irlanda	"> Irlanda </option>
                                            <option value="	Islandia	"> Islandia </option>
                                            <option value="	Islas Marshall	"> Islas Marshall </option>
                                            <option value="	Islas Salomón	"> Islas Salomón </option>
                                            <option value="	Israel	"> Israel </option>
                                            <option value="	Italia	"> Italia </option>
                                            <option value="	Jamaica	"> Jamaica </option>
                                            <option value="	Japón	"> Japón </option>
                                            <option value="	Jordania	"> Jordania </option>
                                            <option value="	Kazajistán	"> Kazajistán </option>
                                            <option value="	Kenia	"> Kenia </option>
                                            <option value="	Kirguistán	"> Kirguistán </option>
                                            <option value="	Kiribati	"> Kiribati </option>
                                            <option value="	Kuwait	"> Kuwait </option>
                                            <option value="	Laos	"> Laos </option>
                                            <option value="	Lesoto	"> Lesoto </option>
                                            <option value="	Letonia	"> Letonia </option>
                                            <option value="	Líbano	"> Líbano </option>
                                            <option value="	Liberia	"> Liberia </option>
                                            <option value="	Libia	"> Libia </option>
                                            <option value="	Liechtenstein	"> Liechtenstein </option>
                                            <option value="	Lituania	"> Lituania </option>
                                            <option value="	Luxemburgo	"> Luxemburgo </option>
                                            <option value="	Macedonia del Norte	"> Macedonia del Norte </option>
                                            <option value="	Madagascar	"> Madagascar </option>
                                            <option value="	Malasia	"> Malasia </option>
                                            <option value="	Malaui	"> Malaui </option>
                                            <option value="	Maldivas	"> Maldivas </option>
                                            <option value="	Maldivas	"> Maldivas </option>
                                            <option value="	Malta	"> Malta </option>
                                            <option value="	Marruecos	"> Marruecos </option>
                                            <option value="	Mauricio	"> Mauricio </option>
                                            <option value="	Mauritania	"> Mauritania </option>
                                            <option value="	México	"> México </option>
                                            <option value="	Micronesia	"> Micronesia </option>
                                            <option value="	Moldavia	"> Moldavia </option>
                                            <option value="	Mónaco	"> Mónaco </option>
                                            <option value="	Mongolia	"> Mongolia </option>
                                            <option value="	Montenegro	"> Montenegro </option>
                                            <option value="	Mozambique	"> Mozambique </option>
                                            <option value="	Namibia	"> Namibia </option>
                                            <option value="	Nauru	"> Nauru </option>
                                            <option value="	Nepal	"> Nepal </option>
                                            <option value="	Nicaragua	"> Nicaragua </option>
                                            <option value="	Níger	"> Níger </option>
                                            <option value="	Nigeria	"> Nigeria </option>
                                            <option value="	Noruega	"> Noruega </option>
                                            <option value="	Nueva Zelanda	"> Nueva Zelanda </option>
                                            <option value="	Omán	"> Omán </option>
                                            <option value="	Países Bajos	"> Países Bajos </option>
                                            <option value="	Pakistán	"> Pakistán </option>
                                            <option value="	Palaos	"> Palaos </option>
                                            <option value="	Panamá	"> Panamá </option>
                                            <option value="	Papúa Nueva Guinea	"> Papúa Nueva Guinea </option>
                                            <option value="	Paraguay	"> Paraguay </option>
                                            <option value="	Perú	"> Perú </option>
                                            <option value="	Polonia	"> Polonia </option>
                                            <option value="	Portugal	"> Portugal </option>
                                            <option value="	Reino Unido	"> Reino Unido </option>
                                            <option value="	República Centroafricana	"> República Centroafricana
                                            </option>
                                            <option value="	República Checa	"> República Checa </option>
                                            <option value="	República del Congo	"> República del Congo </option>
                                            <option value="	República Democrática del Congo	"> República Democrática del
                                                Congo </option>
                                            <option value="	República Dominicana	"> República Dominicana </option>
                                            <option value="	República Sudafricana	"> República Sudafricana </option>
                                            <option value="	Ruanda	"> Ruanda </option>
                                            <option value="	Rumanía	"> Rumanía </option>
                                            <option value="	Rusia	"> Rusia </option>
                                            <option value="	Samoa	"> Samoa </option>
                                            <option value="	San Cristóbal y Nieves	"> San Cristóbal y Nieves </option>
                                            <option value="	San Marino	"> San Marino </option>
                                            <option value="	San Vicente y las Granadinas	"> San Vicente y las Granadinas
                                            </option>
                                            <option value="	Santa Lucía	"> Santa Lucía </option>
                                            <option value="	Santo Tomé y Príncipe	"> Santo Tomé y Príncipe </option>
                                            <option value="	Senegal	"> Senegal </option>
                                            <option value="	Serbia	"> Serbia </option>
                                            <option value="	Seychelles	"> Seychelles </option>
                                            <option value="	Sierra Leona	"> Sierra Leona </option>
                                            <option value="	Singapur	"> Singapur </option>
                                            <option value="	Siria	"> Siria </option>
                                            <option value="	Somalia	"> Somalia </option>
                                            <option value="	Sri Lanka	"> Sri Lanka </option>
                                            <option value="	Suazilandia	"> Suazilandia </option>
                                            <option value="	Sudán	"> Sudán </option>
                                            <option value="	Sudán del Sur	"> Sudán del Sur </option>
                                            <option value="	Suecia	"> Suecia </option>
                                            <option value="	Suiza	"> Suiza </option>
                                            <option value="	Surinam	"> Surinam </option>
                                            <option value="	Tailandia	"> Tailandia </option>
                                            <option value="	Tanzania	"> Tanzania </option>
                                            <option value="	Tayikistán	"> Tayikistán </option>
                                            <option value="	Timor Oriental	"> Timor Oriental </option>
                                            <option value="	Togo	"> Togo </option>
                                            <option value="	Tonga	"> Tonga </option>
                                            <option value="	Trinidad y Tobago	"> Trinidad y Tobago </option>
                                            <option value="	Túnez	"> Túnez </option>
                                            <option value="	Turkmenistán	"> Turkmenistán </option>
                                            <option value="	Turquía	"> Turquía </option>
                                            <option value="	Tuvalu	"> Tuvalu </option>
                                            <option value="	Ucrania	"> Ucrania </option>
                                            <option value="	Uganda	"> Uganda </option>
                                            <option value="	Uruguay	"> Uruguay </option>
                                            <option value="	Uzbekistán	"> Uzbekistán </option>
                                            <option value="	Vanuatu	"> Vanuatu </option>
                                            <option value="	Venezuela	"> Venezuela </option>
                                            <option value="	Vietnam	"> Vietnam </option>
                                            <option value="	Yemen	"> Yemen </option>
                                            <option value="	Yibuti	"> Yibuti </option>
                                            <option value="	Zambia	"> Zambia </option>
                                            <option value="	Zimbabue	"> Zimbabue </option>
                                        </select>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="heard">Departamento *</label>
                                        <select name="dpto" id="dpto" class="form-control" onChange="cargarmunicipio()"
                                            required>
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
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6  col-10 m">
                                        <label for="prinombre">Número de Folios *</label>
                                        <input type="text" name="numeroident" class="form-control"
                                            aria-describedby="emailHelp" placeholder="" required>
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
                                        <input type="text" name="cel" class="form-control" aria-describedby="emailHelp"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-12  col-2 m">
                                        <label for="heard">Tipo Documental *</label>
                                        <select name="genero" class="form-control" required>
                                            <option value="">Seleccione</option>
                                            <option value="	Acciones populares	"> Acciones populares </option>
                                            <option value="	Acta	"> Acta </option>
                                            <option value="	Acta de adjudicación o remate	"> Acta de adjudicación o
                                                remate </option>
                                            <option value="	Acta de aprobación	"> Acta de aprobación </option>
                                            <option value="	Acta de audiencia	"> Acta de audiencia </option>
                                            <option value="	Acta de comité	"> Acta de comité </option>
                                            <option value="	Acta de Conciliación	"> Acta de Conciliación </option>
                                            <option value="	Acta de consejo	"> Acta de consejo </option>
                                            <option value="	Acta de entrega de inmueble entregado en arriendo	"> Acta de
                                                entrega de inmueble entregado en arriendo </option>
                                            <option value="	Acta de inicio	"> Acta de inicio </option>
                                            <option value="	Acta de liquidación	"> Acta de liquidación </option>
                                            <option value="	Acta de obra	"> Acta de obra </option>
                                            <option value="	Acta de posesión	"> Acta de posesión </option>
                                            <option value="	Acta de recibido	"> Acta de recibido </option>
                                            <option value="	Acta de reconocimiento voluntario de paternidad	"> Acta de
                                                reconocimiento voluntario de paternidad </option>
                                            <option value="	Acta de reunión	"> Acta de reunión </option>
                                            <option value="	Acta de terminación	"> Acta de terminación </option>
                                            <option value="	Acta de visita	"> Acta de visita </option>
                                            <option value="Otro">Otro</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12  col-10 m">
                                        <label class="ckbox">
                                            <input type="checkbox" /><span>Marcar como confidencial el radicado</span>
                                        </label>
                                    </div>
                                    <div class="col-md-12  col-2 m">
                                        <label class="ckbox">
                                            <input type="checkbox" /><span>Usted autoriza recibir respuesta por medio de
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
                                            <option value="Marta Rosalba Guerrero cotes">Marta Rosalba Guerrero cotes
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
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>

                                    <div class="col-md-6  col-2 m">
                                        <label for="prinombre">Fecha de Ingreso *</label>
                                        <input type="date" name="fecha" class="form-control"
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6  col-10 m">
                                        <label for="prinombre">Cargo *</label>
                                        <input type="text" name="cargo" class="form-control"
                                            value="Coordinador de Puesto" aria-describedby="emailHelp" placeholder=""
                                            required>
                                    </div>
                                    <div class="col-md-6  col-2 m">
                                        <label for="prinombre">Cedula*</label>
                                        <input type="text" name="numeroident" class="form-control"
                                            aria-describedby="emailHelp" placeholder="" required>
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
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Apellidos *</label>
                                        <input type="text" name="apellidos" class="form-control"
                                            aria-describedby="emailHelp" placeholder="" required>
                                    </div>
                                    <div class="col-md-12 col-sm-10 m">
                                        <label for="prinombre">Correo Electronico</label>
                                        <input type="email" name="correo" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-10 m">
                                        <label for="prinombre">Teléfono *</label>
                                        <input type="text" name="tel" class="form-control" aria-describedby="emailHelp"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-10 m">
                                        <label for="prinombre">Celular *</label>
                                        <input type="text" name="cel" class="form-control" aria-describedby="emailHelp"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-10 m">
                                        <label for="prinombre">WhatsApp *</label>
                                        <input type="text" name="whats" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Dirección *</label>
                                        <input type="text" name="dir" class="form-control" aria-describedby="emailHelp"
                                            placeholder="">
                                    </div>
                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="prinombre">Barrio *</label>
                                        <input type="text" name="barrio" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-10 m">
                                        <label for="prinombre">Localidad *</label>
                                        <input type="text" name="locali" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-10 m">
                                        <label for="prinombre">Comuna *</label>
                                        <input type="text" name="comuna" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>
                                    <div class="col-md-4 col-sm-10 m">
                                        <label for="prinombre">Corregimiento *</label>
                                        <input type="text" name="corregimien" class="form-control"
                                            aria-describedby="emailHelp" placeholder="">
                                    </div>

                                    <div class="col-md-6 col-sm-10 m">
                                        <label for="heard">Departamento *</label>
                                        <select name="dpto" id="dpto" class="form-control" onChange="cargarmunicipio()"
                                            required>
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
<!-- Fin Contenido -->
<?php include('includes/footer.php'); ?>