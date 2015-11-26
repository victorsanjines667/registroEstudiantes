<?php
require_once '../modelos/Certificado.php';
require_once '../modelos/FondoComplementario.php';

if(isset($_GET["accion"])){
    $accion = $_GET["accion"];
}
if(isset($_POST["accion"])){
    $accion = $_POST["accion"];
}
switch($accion){
    case "guardarCertificadoJuridica":
      /* $certificado = new Certificado();
        $certificado->setNombreCompleto($_POST['txtNombreCompletoCartera']);
        $certificado->setCi($_POST['txtCiCartera']);
        $certificado->setMonto('');*/

        break;
    case "":


        break;
    default:

        break;
}

?>
