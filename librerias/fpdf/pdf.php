<?php
require('code128.php');

class PDF extends PDF_Code128
{
//Cabecera de página
function Header()
{
	global $vGestion;
	//Put the watermark
	if (!isset($_SESSION['dcl_est']) && $_SESSION['dcl_est']==''){
    	$this->SetFont('Arial','B',40);
    	$this->SetTextColor(255,192,203);
    	$this->RotatedText(35,190,'IMPRESION EN BORRADOR',45);
	}
    //Logo
	$this->SetTextColor(0);
    $this->Image('images/logo_senape_60x70.jpg',10,8,10,13);
    //Arial bold 15
    $this->SetFont('Arial','B',8);
    //Movernos a la derecha
    //$this->Cell(80);
    //Título
    $this->Cell(0,3,'SERVICIO NACIONAL DE PATRIMONIO DEL ESTADO',0,1,'C');
	$this->Cell(0,3,'DECLARACION JURADA DE BIENES DEL ESTADO',0,1,'C');
	$this->Cell(0,3,'GESTION : ' . $vGestion,0,1,'C');
    //Salto de línea
    $this->Ln(5);
}
/*************PARA WATERMARKER Y ROTAR****************************/
var $angle=0;
function RotatedText($x, $y, $txt, $angle)
{
    //Text rotated around its origin
    $this->Rotate($angle,$x,$y);
    $this->Text($x,$y,$txt);
    $this->Rotate(0);
}

function Rotate($angle,$x=-1,$y=-1)
{
    if($x==-1)
        $x=$this->x;
    if($y==-1)
        $y=$this->y;
    if($this->angle!=0)
        $this->_out('Q');
    $this->angle=$angle;
    if($angle!=0)
    {
        $angle*=M_PI/180;
        $c=cos($angle);
        $s=sin($angle);
        $cx=$x*$this->k;
        $cy=($this->h-$y)*$this->k;
        $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
    }
}

function _endpage()
{
    if($this->angle!=0)
    {
        $this->angle=0;
        $this->_out('Q');
    }
    parent::_endpage();
}

/**********************END WATERMARKER ROTATE ****************************/
//Pie de página
function Footer()
{
	global $Entidad, $nMAE, $dMAE, $cMAE;
    //Posición: a 3,7 cm del final
    $this->SetY(-41);
	$this->SetFont('Helvetica','',6);
	$this->MultiCell(200,3,'Yo, '.$nMAE.' con C.I. '.$dMAE.', en mi condición de '.$cMAE.'  de la Entidad: '.$Entidad.', doy fe que la documentación enviada al SENAPE esta acorde al indice impreso del sistema DEJURBE, el mismo se remite toda la documentación en Fotocopia Simple.',0);
	$this->Cell(30,3,'Fecha de Impresión: ' . date("d/m/Y h:i:s a") . '  Impresión: Declaración Jurada de Bienes del Estado obtenido mediante el Sistema DEJURBE 2010 - WEB',0,1);
	$this->ln(11);
	//Firmas
	$this->SetFont('Helvetica','',8);
	$this->Cell(80,3,'Encargado de Activos Fijos');
	$this->Cell(80,3,'Principal Autoridad Administrativa');
	$this->Cell(80,3,'Maxima Autoridad Ejecutiva');
	$this->Ln(3); $this->Cell(8);
	$this->Cell(85,3,'Firma y Sello');
	$this->Cell(75,3,'Firma y Sello');
	$this->Cell(80,3,'Firma y Sello');
	//Posición: a 1,5 cm del final
    $this->SetY(-15);
    //Arial italic 8
    $this->SetFont('Arial','I',6);
    //Número de página
    $this->Cell(0,3,'Pagina '.$this->PageNo().' de {nb}',0,0,'C');
}
}
