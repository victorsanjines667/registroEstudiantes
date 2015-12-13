<?php
if(empty($_SESSION)){
    session_start();
}
ini_set ('error_reporting', E_ALL);

require_once("../modelos/Consulta.reportes.php");
require_once("PDF.php");
if(isset($idCertificado)){
    $pdf=new PDF('P','mm','letter');
$pdf->AddFont('gothic','','gothic.php');
$pdf->AddFont('gothicb','B','gothicb.php');
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('gothic','',13);

$pdf->SetMargins(30,30,25);
$pdf->SetAutoPageBreak(true,0); 

$consulta = new Consulta();
//$id = $_GET["idCertificado"];
$id = $idCertificado;
$datos = $consulta->getDatosCertificadoCartera($id);
$fecha_certificado_f = explode('-',$datos[2]);
$fecha_certificado_f2 = explode('-',$datos[3]);
$nroCertificado = $datos[6];
$pdf->SetY(37);

$pdf->Ln(6);
$pdf->SetFont('gothicb','B',22);
$pdf->Ln(5);
$titulo="CERTIFICACIÓN";
$pdf->Cell(0,0,utf8_decode($titulo),0,0,'C');
$pdf->SetY(55);
$pdf->Ln(6);
$pdf->SetFont('gothicb','B',12);
$pdf->Cell(0,0,$nroCertificado,0,0,'L');
$pdf->Ln(6);
$pdf->SetY(70);
$primerParrafo = "LA DIRECCIÓN DE LIQUIDACIÓN DE LOS EX ENTES GESTORES DE LA SEGURIDAD SOCIAL, DEPENDIENTE DEL SERVICIO NACIONAL DE PATRIMONIO DEL ESTADO";

$pdf->SetFont('gothicb','B',12);

$pdf->MultiCell(161,6,utf8_decode($primerParrafo),0,'J');//175,7

$titulo_parrafo="CERTIFICA:";
$pdf->Ln(12);

$pdf->SetFont('gothicb','B',12);
$pdf->Cell(0,0,$titulo_parrafo,0,0,'J');
$pdf->Ln(6);
$segundo_parrafo="Que, revisados los antecedentes que cursan en el Archivo de la Dirección de Liquidación de los ex Entes Gestores de la Seguridad Social, dependiente del Servicio Nacional de Patrimonio del Estado, se pudo evidenciar que ".$datos[4]." ".$datos[0].", con Cédula de Identidad Nº ".$datos[1]." ".$datos[13].", canceló en su integridad el saldo deudor expuesto en la Cuenta ".$datos[7].", correspondiente al préstamo ".$datos[8]." de ".$datos[11].", que adquirió en fecha ".$fecha_certificado_f[2]." de ".$pdf->name_date($fecha_certificado_f[1])." de ".$fecha_certificado_f[0].", del ex ".$datos[9].".";

$pdf->Ln(6);
$pdf->SetFont('gothic','',11);
$pdf->MultiCell(161,6,utf8_decode($segundo_parrafo),0,'J');//175
//dibujar la tabla en su posicion

//fin table
//$pdf->SetY(161);
$pdf->Ln(10);
$pdf->SetFont('gothic','',11);

$tramite="Es cuanto se certifica en honor a la verdad, y a petición escrita ".$datos[5].".";

$pdf->MultiCell(161,6,utf8_decode($tramite),0,'J');//175
//$pdf->Ln(5);
$pdf->Ln(10);
$fecha_certificado_str = "La Paz, ".$fecha_certificado_f2[2] . " de " . $pdf->name_date($fecha_certificado_f2[1]). " de " . $fecha_certificado_f2[0].".";
$pdf->Cell(0,0,utf8_decode($fecha_certificado_str),0,0,'R');

$pdf->SetY(-32);//25
$pdf->SetFont('gothic','',7);
$pdf->Cell(0,4,"H.R.: ".$datos[12],0,0,'L');
$pdf->Ln(3);
$usuario=$_SESSION['idfuncionario'];
switch($usuario){
        case 85:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Rossio Peñaloza Rodriguez"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 112:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Julio Alberto Mejia"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 114:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTj/Ximena Zeballos Pareja"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 116:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Waldo Mamani Mamani"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 117:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Oscar Mamani Sepulveda"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 430:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Milton Montevilla Salas"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 515:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Yamilet Quipe Tiñini"),0,0,'L');
        $pdf->Ln(3);
        break;
        case 455:
        $pdf->Cell(0,4,utf8_decode("JJDE/GTJ/Rossio Peñaloza Rodriguez"),0,0,'L');
        $pdf->Ln(3);
        break;
    default:
        //$pdf->Cell(0,4,utf8_decode("JJDE/EG/".ucfirst($_SESSION['capt_login']->log_usuario)),0,0,'L'); 
        $pdf->Ln(3);	
}
$pdf->Cell(0,4,"C.c.: D.L.E.G.S.S.",0,0,'L');
$pdf->Ln(3);
//$pdf->Cell(0,4,"C.c.: D.G.E.",0,0,'L');

//$pdf->MultiCell(173,18.5,utf8_decode($nro_folio),0,'R');//161, 5
$pdf->Output();
//$dbp->close();
}


?>

