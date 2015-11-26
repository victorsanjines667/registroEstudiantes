<?php

if($_POST){
    if(isset($_POST['pantalla'])){
        switch ($_POST['pantalla']){
            case "editarCertContabilidad":
                include "../plantillas/frmContabilidad.tpl.php";
                break;
            case "principal":   
                break;
            case "nuevoCertContabilidad":
                include "../plantillas/frmContabilidad.tpl.php";
                break;
            case "nuevoCertCartera":
                include "../plantillas/vista.formulariocartera.tpl.php";
                break;
	    case "nuevoJuridica":
                include "../plantillas/vista.formulariojuridica.tpl.php";
                break;
            case "editarCertCartera":
                include "../plantillas/vista.formulariocartera.tpl.php";
                break;
		case "editarJuridica":
                include "../plantillas/vista.formulariojuridica.tpl.php";
                break;
            case "eliminarCertificado":
                include "../plantillas/vista.eliminar.tpl.php";
                break;
            default:
                break;
        }
    }
}


?>