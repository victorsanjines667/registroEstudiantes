<?php
ini_set ('error_reporting', E_ALL);
if(empty($_SESSION)){
    session_start();
}
require_once('../librerias/BDPG.class.php');
require_once('PDF.php');
require_once('../modelos/Certificado.php');
require_once('../modelos/Cite.php');
require_once('../modelos/FondoComplementario.php');
require_once('../modelos/CuentaContable.php');

$nombrecompleto = "";
if(isset($_SESSION['idfuncionario'])){
    switch($_SESSION['idfuncionario']){
        case "90":
            $nombrecompleto = "Zuzet Corrales Espejo";
            break;
        case "161":
            $nombrecompleto = "Helen Calderon Callejas";
            break;
        case "167":
            $nombrecompleto = "Carla Flores Bueno";
            break;
        default:
            $nombrecompleto = "";
            break;
    }
}

//if(isset($_GET['idCertificado'])){
if(isset($idCertificado)){
	//$idCertificado = $_GET['idCertificado'];
	$certificado = new Certificado();
	$cite = new Cite();
	$fondocomplementario = new FondoComplementario();
	$cuentacontable = new CuentaContable();
	//variables y resultados
	$resultado = $certificado->getCertificadoGeneral($idCertificado);
	$idCite = $resultado->getIdCite();
	$resultado2 = $cite->getDatosCite($idCite);
	$citeNota = $resultado2->getCite();
	$solicitante = $resultado->getNombreSolicitante();
	$fechaCertificado = $resultado->getFechaCertificado();
	$articulo = $resultado->getArticulo();
	$persona = $resultado->getNombreCompleto();
	$ci = $resultado->getCi();
	$cargo = $resultado->getCargo();
	$fechaInicio = $resultado->getFechaInicio();
	$hojaRuta = $resultado->getHojaRuta();
	$idFondoComplementario = $resultado->getIdFondoComplementario();
	$resultado3 = $fondocomplementario->getDatosFondoComplementario($idFondoComplementario);
	$nombreEntidad = $resultado3->getDescripcion();
	$idCuentaContable = $resultado->getIdCuentaContable();
	$resultado4 = $cuentacontable->getDatosCuentaContable($idCuentaContable);
	$nombreCuentaContable = $resultado4->getDescripcion();
	$monto = $resultado->getMonto();
	$idFuncionario = $resultado2->getIdFuncionario();
	
		$pdf=new PDF('P','mm','letter');
		$fecha_certificado_f = explode('/',$fechaCertificado);
		$fecha_certificado_str = "La Paz, ".$fecha_certificado_f[0] . " de " . $pdf->name_date($fecha_certificado_f[1]). " de " . $fecha_certificado_f[2].".";
		$fecha_inicio_f = explode('-',$fechaInicio);
		$fecha_inicio_str = $fecha_inicio_f[2] . " de " . $pdf->name_date($fecha_inicio_f[1]). " de " . $fecha_inicio_f[0];
 		//$pdf->xheader = 40;
        //$pdf->yheader = 8;
        $pdf->AddFont('gothic','','gothic.php');
        $pdf->AddFont('gothicb','B','gothicb.php');

        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('gothic','',13);
        //$pdf->SetMargins(30,30,25);
        $pdf->SetMargins(30,30,25);
		$pdf->SetAutoPageBreak(true,0); 
        $pdf->SetY(60);//37
        $pdf->Ln(5);
        $titulo1 = utf8_decode("CERTIFICACIÓN");
		$titulo2 = utf8_decode($citeNota);
      	$titulo3 = utf8_decode("LA DIRECCIÓN DE LIQUIDACIÓN DE LOS EX ENTES GESTORES DE LA SEGURIDAD SOCIAL, DEPENDIENTE DEL SERVICIO NACIONAL DE PATRIMONIO DEL ESTADO - SENAPE");
		$titulo4 = utf8_decode("CERTIFICA: ");
        $parrafo1 = utf8_decode("Que, revisados los antecedentes que cursan en el archivo de la Dirección de Liquidación de los ex Entes Gestores de la Seguridad Social - DLEGSS, dependiente del Servicio Nacional de Patrimonio del Estado - SENAPE, se pudo evidenciar que ".$articulo." ".$persona.", con Cédula de Identidad ".$ci.", canceló el saldo deudor expuesto en la cuenta ".$nombreCuentaContable.", por ".$monto.", correspondiente al ex ".$nombreEntidad.".");
		$parrafo2 = utf8_decode("Es cuanto se certifica en honor a la verdad, a petición escrita ".$solicitante);
		$parrafo3 = utf8_decode($fecha_certificado_str);
        
        
        $pdf->SetFont('gothicb','B',22);
        $pdf->Cell(0,0,$titulo1,0,0,'C');
        $pdf->Ln(15);   
		$pdf->SetFont('gothicb','B',13);
		$pdf->MultiCell(161,6,$titulo2,0,'J');//175
		$pdf->Ln(5);
		$pdf->SetFont('gothicb','B',13);
		$pdf->MultiCell(161,6,$titulo3,0,'J');
		$pdf->Ln(5);
		$pdf->SetFont('gothicb','B',13);
		$pdf->MultiCell(161,6,$titulo4,0,'J');
		$pdf->Ln(5);
		$pdf->SetFont('gothic','',13);
		$pdf->MultiCell(161,6,$parrafo1,0,'J');
		$pdf->Ln(5);
		$pdf->SetFont('gothic','',13);
		$pdf->MultiCell(161,6,$parrafo2,0,'J');
		$pdf->Ln(5);
		$pdf->SetFont('gothic','',13);
		$pdf->MultiCell(161,6,$parrafo3,0,'R');
		
		
		$pdf->SetY(-32);//25
		$pdf->SetFont('gothic','',7);
		$pdf->Cell(0,4,"H.R.: ".$hojaRuta,0,0,'L');
		$pdf->Ln(3);
		
		/*switch($usuario){
			case 66:
			$pdf->Cell(0,4,utf8_decode("JJDE/MZM/Perico De Los Palotes"),0,0,'L');
			$pdf->Ln(3);
			break;
			default:
			//$pdf->Cell(0,4,utf8_decode("JJDE/EG/".ucfirst($_SESSION['capt_login']->log_usuario)),0,0,'L'); 
			$pdf->Ln(3);	
		}*/
                $pdf->Cell(0,4,utf8_decode("JJDE/MZM/".$nombrecompleto),0,0,'L');
                $pdf->Ln(3);
		$pdf->Cell(0,4,"C.c.: D.L.E.G.S.S.",0,0,'L');
		$pdf->Ln(3);
		//$pdf->Cell(0,4,"C.c.: D.G.E.",0,0,'L');
		$pdf->Output();  
}

?>