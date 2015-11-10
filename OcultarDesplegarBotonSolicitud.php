<?php
/* 
 * Fija la variable permiso para ocultar o desplegar elementos sobre la página,
 * la variable de sesión debe ser inicializada previamente
 */
include_once("VerificarRolesPermisos.php");

if($_SESSION){
    if(isset($_SESSION['idfuncionario'])){
        $idfuncionario = $_SESSION['idfuncionario'];
        $rolesPermisos = new VerificarRolesPermisos();
        $permiso = $rolesPermisos->ocultarBotonesSolicitarCambio($idfuncionario);
    }
}


?>