<?php
require_once '../modelos/TipoPrestamo.php';
require_once '../modelos/FondoComplementario.php';
require_once '../modelos/CuentaContable.php';
if(isset($_GET["accion"])){
   $accion = $_GET["accion"]; 
}
if(isset($_POST["accion"])){
   $accion = $_POST["accion"]; 
}
switch($accion){
    case "getListaTipoPrestamo":
        $tipoPrestamo = new TipoPrestamo();
        $resultado = $tipoPrestamo->getListaTipoPrestamo();
        echo $resultado;
        break;
    case "getListaFondoComplementario": 
        $fondoComplementario = new FondoComplementario();
        $resultado =  $fondoComplementario->getListaFondoComplementario();
        echo $resultado;
        break;
    case "getListaCuentaContable": 
        $cuentaContable = new CuentaContable();
        $resultado =  $cuentaContable->getListaCuentaContable();
        echo $resultado;
        break;
    default:
        
        break;
}
?>
