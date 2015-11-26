<?php
require_once '../modelos/Certificado.php';
require_once '../modelos/Contabilidad.php';

if(isset($_GET["accion"])){
   $accion = $_GET["accion"]; 
}
if(isset($_POST["accion"])){
   $accion = $_POST["accion"]; 
}
if(isset($accion)){
    switch($accion){
        case "getCertificadoContabilidad":
            $idcertificado = $_POST['id'];
            $certificadoCont = new Contabilidad();
            $certificado = $certificadoCont->getCertificadoContabilidad($idcertificado);
            echo '{"id":"'.$certificado->getId().'",
                    "tipocertificado":"'.$certificado->getTipoCertificado().'",
                    "nombrecompleto":"'.$certificado->getNombrePersona().'",
                    "ci":"'.$certificado->getCi().'",
                    "fondocomplementario":"'.$certificado->getFondoComplementario().'",
                    "fechainicio":"'.$certificado->getFechaInicio().'",                        
                    "monto":"'.$certificado->getMonto().'",
                    "cargo":"'.$certificado->getCargo().'",
                    "fechafinal":"'.$certificado->getFechaFinal().'",
                    "cuentacontable":"'.$certificado->getNroCuenta().'",                        
                    "hojaruta":"'.$certificado->getHojaRuta().'",
                    "genero":"'.$certificado->getArticulo().'",
                    "fechaemision":"'.$certificado->getFechaEmision().'",
                    "textonota":"'.$certificado->getTextoNota().'"}';
            break;
        case "actualizaRegistroContabilidad":
            //print_r($_POST);exit();
            $certContabilidad = new Contabilidad();
            $certContabilidad->setId($_POST["txtIdCertificadoContabilidad"]);
            $certContabilidad->setTipoCertificado($_POST['contSelTipoCertificado']);
            $certContabilidad->setNombrePersona($_POST['contTxtNombrePersona']);
            $certContabilidad->setCi($_POST['contTxtCI']);
            $certContabilidad->setFondoComplementario($_POST['contSelFondoComplementario']);
            $certContabilidad->setFechaInicio($_POST['contTxtFechaInicio']);
            $certContabilidad->setFechaEmision($_POST['contTxtFechaEmision']);
            if(isset($_POST['contTxtMonto'])){
                $certContabilidad->setMonto($_POST['contTxtMonto']);
            }else{
                $certContabilidad->setMonto('null');
            }
            if(isset($_POST['contTxtCargo'])){
                $certContabilidad->setCargo($_POST['contTxtCargo']); //*
            }else{
                $certContabilidad->setCargo('null'); 
            }
            if(isset($_POST['contTxtFechaFinal'])){
                $certContabilidad->setFechaFinal($_POST['contTxtFechaFinal']); //*
            }else{
                $certContabilidad->setFechaFinal('null');
            }
            if(isset($_POST['contSelCuentaContable'])){
                $certContabilidad->setNroCuenta($_POST['contSelCuentaContable']);
            }else{
                $certContabilidad->setNroCuenta('null');
            }
            $certContabilidad->setHojaRuta($_POST['contTxtHojaRuta']);
            $certContabilidad->setArticulo($_POST['contSelGenero']);
            $certContabilidad->setTextoNota($_POST['contTxtTextoNota']);
            echo $certContabilidad->updateCertificadoContabilidad($certContabilidad);
            break;
    case "guardarCertificadoCartera":
	//print_r($_POST); 
        $certificado = new Certificado();
        $certificado->setNombreCompleto($_POST['txtNombreCompletoCartera']);
        $certificado->setCi($_POST['txtCiCartera']);
        $certificado->setMonto(null);
        $certificado->setFechaInicio($_POST['txtFechaPrestamoCartera']);
        $certificado->setFechaFin('null');
        $certificado->setConProceso('false');
        $certificado->setNotaCargo(null);
        $certificado->setMonto($_POST['txtMontoLiteralCartera']);
        $certificado->setLugarRadicado(null);
        $certificado->setHojaRuta($_POST['txtHojaRutaCartera']);
        $certificado->setEliminado('false');
        $certificado->setIdCuentaContable($_POST['cbCuentaContableCartera']);
        $certificado->setIdTipoCertificado(2);
        $certificado->setTipoPrestamo($_POST['cbTipoPrestamoCartera']);
	$certificado->setArticulo($_POST['cbGeneroCartera']);
        $certificado->setNombreSolicitante($_POST['txtNombreSolicitanteCartera']);
        $certificado->setIdFondoComplementario($_POST['cbFondoComplementarioCartera']);
        $certificado->setIdCite('null');
        $certificado->setFechaCertificado($_POST['txtFechaEmisionCartera']);
        $certificado->setProcedenciaCi($_POST['cbProcedenciaCartera']);
        $certificado2  = new Certificado();
        echo $certificado2->insertarCertificado($certificado);
        
        break;
    case "editarCertificacionCartera":
	//print_r($_POST); 
        $certificado = new Certificado();
        $certificado->setId($_POST['idCertificacionCartera']);
        $certificado->setNombreCompleto($_POST['txtNombreCompletoCartera']);
        $certificado->setCi($_POST['txtCiCartera']);
        $certificado->setMonto(null);
        $certificado->setFechaInicio($_POST['txtFechaPrestamoCartera']);
        $certificado->setFechaFin('null');
        $certificado->setConProceso('false');
        $certificado->setNotaCargo(null);
        $certificado->setMonto($_POST['txtMontoLiteralCartera']);
        $certificado->setLugarRadicado(null);
        $certificado->setHojaRuta($_POST['txtHojaRutaCartera']);
        $certificado->setEliminado('false');
        $certificado->setIdCuentaContable($_POST['cbCuentaContableCartera']);
        $certificado->setIdTipoCertificado(2);
        $certificado->setTipoPrestamo($_POST['cbTipoPrestamoCartera']);
        $certificado->setArticulo($_POST['cbGeneroCartera']);
        $certificado->setNombreSolicitante($_POST['txtNombreSolicitanteCartera']);
        $certificado->setIdFondoComplementario($_POST['cbFondoComplementarioCartera']);
        $certificado->setIdCite('null');
        $certificado->setFechaCertificado($_POST['txtFechaEmisionCartera']);
        $certificado->setProcedenciaCi($_POST['cbProcedenciaCartera']);
        $certificado2  = new Certificado();
        echo $certificado2->editarCertificado($certificado);
        
        break;
     case "editaCertificadoJuridica":
	    $certificadoJuridica = new Certificado();
		$certificadoJuridica->setId($_POST['idCerti']);
        $certificadoJuridica->setNombreCompleto($_POST['txtNombreCompletoJuridica']);
        $certificadoJuridica->setCi($_POST['txtCiJuridica']);
		if(isset($_POST['txtNotaCargoJuridica'])){
			$certificadoJuridica->setNotaCargo($_POST['txtNotaCargoJuridica']);
		}
		else {
			$certificadoJuridica->setNotaCargo('');
		}
		if(isset($_POST['txtMontoJuridica'])){
			$certificadoJuridica->setMonto($_POST['txtMontoJuridica']);
		}
		else {
			$certificadoJuridica->setMonto('');
		}
		if(isset($_POST['txtRadicadoJuridica'])){
			$certificadoJuridica->setLugarRadicado($_POST['txtRadicadoJuridica']);
		}
		else {
			$certificadoJuridica->setLugarRadicado('');
		}
		
        $certificadoJuridica->setIdTipoCertificado(3);
		
		$certificadoJuridica->setHojaRuta($_POST['txtHojaRutaJuridica']);
		$certificadoJuridica->setIdFondoComplementario($_POST['cbEntidad']);
		//$certificadoJuridica->setArticulo($_POST['opcionesJuridica']);
		$certificadoJuridica->setArticulo($_POST['cbGeneroJuridica']);
		if($_POST['cbExistencia']==1)
			$certificadoJuridica->setConProceso('true');
		else if($_POST['cbExistencia']==2)
			$certificadoJuridica->setConProceso('false');
		$certificadoJuridica->setNombreSolicitante($_POST['txtSolicitanteJuridica']);
		$certificadoJuridica->setFechaCertificado($_POST['txtFechaEmisionJuridica']);	
		$certificadoJuridica->setIdCite('null');
		
		//echo "prueba ".$_POST['opcionesJuridica']." algo mas ".$_POST['cbEntidad'];
        $certificado2  = new Certificado();
        echo $certificado2->editarCertificadoJuridica($certificadoJuridica);
	 	break;
		
	 case "guardaCertificadoJuridica": 
        $certificadoJuridica = new Certificado();
        $certificadoJuridica->setNombreCompleto($_POST['txtNombreCompletoJuridica']);
        $certificadoJuridica->setCi($_POST['txtCiJuridica']);
		if(isset($_POST['txtNotaCargoJuridica'])){
			$certificadoJuridica->setNotaCargo($_POST['txtNotaCargoJuridica']);
		}
		else {
			$certificadoJuridica->setNotaCargo('');
		}
		if(isset($_POST['txtMontoJuridica'])){
			$certificadoJuridica->setMonto($_POST['txtMontoJuridica']);
		}
		else {
			$certificadoJuridica->setMonto('');
		}
		if(isset($_POST['txtRadicadoJuridica'])){
			$certificadoJuridica->setLugarRadicado($_POST['txtRadicadoJuridica']);
		}
		else {
			$certificadoJuridica->setLugarRadicado('');
		}
		
        $certificadoJuridica->setIdTipoCertificado(3);
		
		$certificadoJuridica->setHojaRuta($_POST['txtHojaRutaJuridica']);
		$certificadoJuridica->setIdFondoComplementario($_POST['cbEntidad']);
		//$certificadoJuridica->setArticulo($_POST['opcionesJuridica']);
		$certificadoJuridica->setArticulo($_POST['cbGeneroJuridica']);
		if($_POST['cbExistencia']==1)
			$certificadoJuridica->setConProceso('true');
		else if($_POST['cbExistencia']==2)
			$certificadoJuridica->setConProceso('false');
		$certificadoJuridica->setNombreSolicitante($_POST['txtSolicitanteJuridica']);
		$certificadoJuridica->setFechaCertificado($_POST['txtFechaEmisionJuridica']);
		$certificadoJuridica->setIdCite('null');
		
		//echo "prueba ".$_POST['opcionesJuridica']." algo mas ".$_POST['cbEntidad'];
        $certificado2  = new Certificado();
        echo $certificado2->insertarCertificadoJuridica($certificadoJuridica);
        
        break;
    case "guardaCertificadoContabilidad":
            //print_r($_POST);
            $certContabilidad = new Contabilidad();
            $certContabilidad->setTipoCertificado($_POST['contSelTipoCertificado']);
            $certContabilidad->setNombrePersona($_POST['contTxtNombrePersona']);
            $certContabilidad->setCi($_POST['contTxtCI']);
            $certContabilidad->setFondoComplementario($_POST['contSelFondoComplementario']);
            $certContabilidad->setFechaInicio($_POST['contTxtFechaInicio']);
            $certContabilidad->setFechaEmision($_POST['contTxtFechaEmision']);
            if(isset($_POST['contTxtMonto'])){
                $certContabilidad->setMonto($_POST['contTxtMonto']);
            }else{
                $certContabilidad->setMonto('null');
            }
            if(isset($_POST['contTxtCargo'])){
                $certContabilidad->setCargo($_POST['contTxtCargo']); //*
            }else{
                $certContabilidad->setCargo('null'); 
            }
            if(isset($_POST['contTxtFechaFinal'])){
                $certContabilidad->setFechaFinal($_POST['contTxtFechaFinal']); //*
            }else{
                $certContabilidad->setFechaFinal('null');
            }
            if(isset($_POST['contSelCuentaContable'])){
                $certContabilidad->setNroCuenta($_POST['contSelCuentaContable']);
            }else{
                $certContabilidad->setNroCuenta('null');
            }
            $certContabilidad->setHojaRuta($_POST['contTxtHojaRuta']);
            $certContabilidad->setArticulo($_POST['contSelGenero']);
            $certContabilidad->setTextoNota($_POST['contTxtTextoNota']);
            echo $certContabilidad->insertarCertificadoContabilidad($certContabilidad);
			break;
    case "poblarCertificados":
                $certificado = new Certificado();
                $aColumns = array('id','nombrecompleto', 'ci', 'cite', 'fechacertificado', 'hojaruta', 'nombresolicitante','fondo');
                //Paginando
                $sLimit = "";
                if (isset($_GET['iDisplayStart']) && $_GET['iDisplayLength'] != '-1') {
                    $sLimit = " LIMIT " . intval($_GET['iDisplayLength']) . " OFFSET " . intval($_GET['iDisplayStart']);
                }
                //Ordenando
                $sOrder = "";
                if (isset($_GET['iSortCol_0'])) {
                    $sOrder = " ORDER BY ";
                    for ($i = 0; $i < intval($_GET['iSortingCols']); $i++) {
                        if ($_GET['bSortable_' . intval($_GET['iSortCol_' . $i])] == "true") {
                            $sOrder .= $aColumns[intval($_GET['iSortCol_' . $i])] . " " .
                                ($_GET['sSortDir_' . $i] === 'asc' ? 'asc' : 'desc') . ", ";
                        }
                    }
                    $sOrder = substr_replace($sOrder, "", -2);
                    if ($sOrder == " ORDER BY ") {
                        $sOrder = "";
                    }
                }
                $sWhere = "";
                if (isset($_GET['sSearch']) && $_GET['sSearch'] != "") {
                    $sWhere = " and (";
                    for ($i = 0; $i < count($aColumns); $i++) {
                        $sWhere .= $aColumns[$i] . "::text ILIKE '%" . ($_GET['sSearch']) . "%' OR ";
                    }
                    $sWhere = substr_replace($sWhere, "", -3);
                    $sWhere .= ')';
                }
                
                $total = $certificado->getNumeroFilasCertificados2($sWhere);
                $sCondicion = $sWhere . $sOrder . $sLimit;
                //$paginado = $persona->getNumeroFilas($sCondicion, $_GET['condiciongarante']);
                $paginado = $certificado->getNumeroFilasCertificados2($sCondicion);

                //$id_entidad = $_GET['identidad'];
                $registrosCertificados = $certificado->listaCertificados($sCondicion);
                //print_r($registrosCertificados);
                if ($registrosCertificados == "[]") {
                    $json = $registrosCertificados;
                } else {
                    $json = json_encode($registrosCertificados);
                }
                //echo $json;exit();
                echo '{"sEcho":' . intval($_GET['sEcho']) . ', "iTotalRecords":' . $paginado . ', "iTotalDisplayRecords":' . $total . ',"aaData": ' . $json . ' }';
                break;
    case "getCertificado": 
        $idCertificado = $_POST['id'];
        $certificado = new Certificado();
        $resultado = $certificado->getCertificadoCartera($idCertificado);
        echo '{"id":"'.$resultado->getId().'",
               "nombrecompleto":"'.$resultado->getNombreCompleto().'",
               "ci":"'.$resultado->getCi().'",
               "idcuentacontable":"'.$resultado->getIdCuentaContable().'",
               "monto":"'.$resultado->getMonto().'",
               "fecha":"'.$resultado->getFechaInicio().'",
               "idtipoprestamo":"'.$resultado->getTipoPrestamo().'",
               "idfondocomplementario":"'.$resultado->getIdFondoComplementario().'",
               "hojaruta":"'.$resultado->getHojaRuta().'",
               "nombresolicitante":"'.$resultado->getNombreSolicitante().'",
               "articulo":"'.$resultado->getArticulo().'",
               "fechaemision":"'.$resultado->getFechaCertificado().'",
               "procedenciaci":"'.$resultado->getProcedenciaCi().'"}';
        break;
		case "getCertificadoJuridica": 
        $idCertificadoJuridica = $_POST['id'];
        $certificado = new Certificado();
        $resultado = $certificado->getCertificadoJuridica($idCertificadoJuridica);
        echo '{"id":"'.$resultado->getId().'",
               "nombrecompleto":"'.$resultado->getNombreCompleto().'",
               "ci":"'.$resultado->getCi().'",
			   "monto":"'.$resultado->getMonto().'",
			   "notacargo":"'.$resultado->getNotaCargo().'",
               "hojaruta":"'.$resultado->getHojaRuta().'",
			   "lugarradicado":"'.$resultado->getLugarRadicado().'",
			   "idtipocertificado":"'.$resultado->getIdTipoCertificado().'",
			   "conproceso":"'.$resultado->getConProceso().'",
			   "articulo":"'.$resultado->getArticulo().'",
			   "idfondocomplementario":"'.$resultado->getIdFondoComplementario().'",
			   "fechacertificado":"'.$resultado->getFechaCertificado().'",
               "nombresolicitante":"'.$resultado->getNombreSolicitante().'"}';
        /*"idcuentacontable":"'.$resultado->getIdCuentaContable().'",
               "monto":"'.$resultado->getMonto().'",
               "fecha":"'.$resultado->getFechaInicio().'",
               "idtipoprestamo":"'.$resultado->getTipoPrestamo().'",
               "idfondocomplementario":"'.$resultado->getIdFondoComplementario().'",*/
		break;
    case "eliminarCertificado": 
        $idCertificado = $_POST['id'];
        $certificado = new Certificado();
        $resultado = $certificado->eliminarCertificado($idCertificado);
        echo $resultado;
        break;
    case "imprimirCertificado":
        $idCertificado = $_POST['id'];
        $certificado = new Certificado();
        $tipoCertificado = $certificado->getTipoCertificado($idCertificado);
        switch ($tipoCertificado){
            case 1:
                //header("Location:/reportes/certiDeuda.php?idCertificado=$idCertificado");
                $idCertificado;
                //echo "reportes/certiDeuda.php?idCertificado=$idCertificado";
                include "../reportes/certiDeuda.php";
                break;
            case 2:
                $idCertificado;
                //header("Location:/reportes/certiTrabajo.php?idCertificado=$idCertificado");
                //echo "reportes/certiTrabajo.php?idCertificado=$idCertificado";
                include "../reportes/certiTrabajo.php";
                break;
            case 3:
                
                break;
            case 4:
                $idCertificado;
                //header("Location:/reportes/certificadoCartera.php?idCertificado=$idCertificado");
                //echo "reportes/certificadoCartera.php?idCertificado=$idCertificado";
                include "../reportes/certificadoCartera.php";
                break;
            default:
                break;
        }
        break;
    default:
        
        break;
    }
}

?>
