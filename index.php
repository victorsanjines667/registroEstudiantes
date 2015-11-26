<?php
/*
include_once("plantillas/cabecera.tpl.php");
include_once("plantillas/principal.tpl.php");
include_once("plantillas/pie.tpl.php");
 */

include "modelos/Login.php";

if(isset($_POST['cerrarsesion'])){
    session_destroy();
    panelLogin();
}

/*if(isset($_SESSION['idfuncionario'])){
    panelPrincipal();
}*/

/*if(empty($_SESSION)){
    panelLogin();
}*/


if(isset($_POST['nombreusuario']) && isset($_POST['password'])){
    $login = new Login();
    //print_r($login->obtenerDatosUsuario($_GET));
    $datos = $login->obtenerDatosUsuario($_POST);
    if(empty($datos)){
        panelLogin();
    }else{
       panelPrincipal($_POST);
    }
}elseif(isset($_SESSION["idfuncionario"])){
    panelPrincipal();
}else{
    panelLogin();
}

function panelPrincipal($datos=array()){
    $identidad = "";
    if(isset($datos["identidad"])){
            $identidad = $datos["identidad"];
    }
    include "plantillas/cabecera.tpl.php";
    include_once("plantillas/principal.tpl.php");
    include "plantillas/pie.tpl.php";
}

function panelLogin(){
    include "plantillas/login.tpl.php";
}
?>
