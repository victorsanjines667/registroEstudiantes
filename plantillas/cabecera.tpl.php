<?php 
/*
 * Variables de sesion que se pueden utilizar:
 *   $_SESSION['usuario'];
     $_SESSION['nombre'];
     $_SESSION['apellidopat'];
     $_SESSION['apellidomat'];
     $_SESSION['iddireccion'];
     $_SESSION['dirdescripcion'];
     $_SESSION['idfuncionario'];
     $_SESSION['idrol'];
 */

if(empty($_SESSION)){
    session_start();
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8" />
        <title>Sistema de Certificaciones D.L.E.G.S.S.</title>
        <meta name="description" content="Certificaciones - Fondos" />
        <meta name="keywords" content="SENAPE" />
        <link rel="stylesheet" type="text/css" href="recursos/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" href="recursos/css/estilos.css" />
        <link rel="stylesheet" type="text/css" href="recursos/css/datepicker.css" />
        <link rel="stylesheet" type="text/css" href="recursos/css/dataTables.bootstrap.css" />
        <script type="text/javascript" src="recursos/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="recursos/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="recursos/js/datepicker.min.js"></script>
        <script type="text/javascript" src="recursos/js/locales/datepicker.es.min.js"></script>
        <script type="text/javascript" src="recursos/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="recursos/js/dataTables.bootstrap.js"></script>
<!--        <script type="text/javascript" src="recursos/js/certificadoJuridico.js"></script> -->
        <script type="text/javascript" src="recursos/js/principal.js"></script>
        <script type="text/javascript" src="recursos/js/cartera.js"></script>
        <script type="text/javascript" src="recursos/js/contabilidad.js"></script>
        <script type="text/javascript" src="recursos/js/juridica.js"></script>
<!--        <script type="text/javascript" src="recursos/js/locales/bootstrap-datepicker.es.js"></script> -->
        <style type="text/css">
            .markrow { background-color:#86BCE8 !important; }
        </style>
    </head>
<body>
    <input type="hidden" id="idCertificado" name="idCertificado"/>
    <div id="contenedor">
    <div id="cabecera">
        <div class="row rowcabecera">
            <div class="col-lg-3">
                <p class="tituloNombre">Bienvenido(a): <span><?php echo $_SESSION['apellidopat']." ".$_SESSION['apellidomat']." ".$_SESSION['nombre'] ?></span></p>
            </div>
            <div class="col-lg-9">
                <div class="btn-group menu_superior">
                    <button type="button" class="btn btn-info" data-toggle="dropdown" aria-expanded="false">Inicio</button>
                    <?php if($_SESSION['idrol']==1 || $_SESSION['idrol']==4): //Contabilidad ?>
                    <button id="btnNuevoContabilidad" type="button" class="btn btn-info opcionMenuHorizontal" data-toggle="dropdown" cont='nuevoCertContabilidad'  titulo='Nuevo Certificado de Contabilidad' aria-expanded="false">Nuevo Certificado</button>
                    <button id="btnEditarContabilidad" type="button" class="btn btn-info opcionMenuHorizontal" data-toggle="dropdown" cont='editarCertContabilidad' titulo='Editar Certificado de Contabilidad'  aria-expanded="false">Editar Certificado</button>
                    <?php endif; ?>
                    <?php if($_SESSION['idrol']==2 || $_SESSION['idrol']==4): //Juridica  ?>
                    <button id="btnJuridica" type="button" class="btn btn-info opcionMenuHorizontal" data-toggle="dropdown" cont='nuevoJuridica' titulo='Nuevo Certificado de Juridica'  aria-expanded="false">Nuevo Certificado</button>
                    <button id="btnEditarJuridica" type="button" class="btn btn-info opcionMenuHorizontal" data-toggle="dropdown" cont='editarJuridica' titulo='Editar Certificado de Juridica'  aria-expanded="false">Editar Jurídica</button>
                    <?php endif; ?>
                    <?php if($_SESSION['idrol']==3 || $_SESSION['idrol']==4): //Cartera ?>
                    <button type="button" class="btn btn-info opcionMenuHorizontal" data-toggle="dropdown" cont='nuevoCertCartera' titulo='Nuevo Certificado de Cartera'  aria-expanded="false">Nuevo Certificado</button>
                    <button id="btnEditarCertCartera" type="button" class="btn btn-info" data-toggle="dropdown" cont='editarCertCartera' titulo='Editar Certificado de Cartera'  aria-expanded="false">Editar Certificado</button>
                    <?php endif; ?>
                    <button id="btnImprimirContabilidad" type="button" class="btn btn-info" data-toggle="dropdown"  aria-expanded="false">Imprimir</button>
                    <button type="button" class="btn btn-info opcionMenuHorizontal" data-toggle="dropdown" cont='eliminarCertificado' titulo='Eliminar Certificado'  aria-expanded="false">Eliminar Certificado</button>
                    <button id="btnCierraSesionCertificados" type="button" class="btn btn-info" data-toggle="dropdown" aria-expanded="false">Cerrar Sesión</button>
                </div>
            </div>
        </div>
        
    </div>

    <div id="contenido"> <!-- inicio contenido de trabajo -->
    
