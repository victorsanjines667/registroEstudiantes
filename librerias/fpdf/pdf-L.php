<?php
require('code128.php');

class PDF extends PDF_Code128
{
/*****************************   ENCABEZADO Y PIE ********************************/
//Cabecera de página
private $encabezado;
private $wi;
function setEncabezadoG($e){
	$this->encabezado = $e;
}
function setWidthsG($w){
	$this->wi = $w;
}
function Header()
{
	global $vGestion;
	global $Rubro;
	global $nRow;
	global $Form;
	
	//Put the watermark
	if (!isset($_SESSION['dcl_est']) && $_SESSION['dcl_est']==''){
    	$this->SetFont('Arial','B',40);
    	$this->SetTextColor(255,192,203);
    	$this->RotatedText(35,190,'IMPRESION EN BORRADOR',45);
	}
    //Logo
	$this->SetTextColor(0);
    $this->Image('images/logo_senape_60x70.jpg',10,8,10,13);
	//Arial bold 6
    $this->SetFont('Arial','',6);
	$this->Text(260,15,$Form);
    //Arial bold 8
    $this->SetFont('Arial','B',8);
    //Movernos a la derecha
    //$this->Cell(80);
    //Título
    $this->Cell(0,3,'SERVICIO NACIONAL DE PATRIMONIO DEL ESTADO',0,1,'C');
	$this->Cell(0,3,'DECLARACION JURADA DE BIENES DEL ESTADO',0,1,'C');
	$this->Cell(0,3,'GESTION : ' . $vGestion,0,1,'C');
	$this->Ln(3);
	$this->Cell(200,3,'RUBRO : ' . $Rubro,0);
	$this->Cell(200,3,'Total Bienes Declarados : ' . $nRow,0);
    //Salto de línea
    $this->Ln(5);
	//encabezado grilla
	$this->SetFillColor(100,100,150);
	$this->SetTextColor(255);
	//$pdf->SetDrawColor(128,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('Helvetica','',7);
	//Cabecera
	$this->SetWidths($this->wi);
	$this->Row($this->encabezado,false,'DF',8);
}

//Pie de página
function Footer()
{
	global $Entidad, $nMAE, $dMAE, $cMAE;
    //Posición: a 3,7 cm del final
    $this->SetY(-41);
	$this->SetFont('Helvetica','',6);
	//$this->MultiCell(200,3,'Yo, '.$nMAE.' con C.I. '.$dMAE.', en mi condición de '.$cMAE.'  de la Entidad: '.$Entidad.', doy fe que la documentación enviada al SENAPE esta acorde al indice impreso del sistema DEJURBE, el mismo se remite toda la documentación en Fotocopia Simple.',0);
	$this->Cell(30,3,'Fecha de Impresión: ' . date("d/m/Y h:i:s a") . '  Impresión: Declaración Jurada de Bienes del Estado obtenido mediante el Sistema DEJURBE v2011 - WEB',0,1);
	$this->ln(11);
	//Firmas
	$this->Cell(30);
	$this->SetFont('Helvetica','',8);
	$this->Cell(80,3,'Encargado de Activos Fijos');
	$this->Cell(80,3,'Principal Autoridad Administrativa');
	$this->Cell(80,3,'Maxima Autoridad Ejecutiva');
	$this->Ln(3); $this->Cell(38);
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

/*****************************   END ENCABEZADO Y PIE ********************************/

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


/********************* MULTICELL *************************/
var $widths;
var $aligns;
var $ah;
var $aw;
var $ax;
var $ay;
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Get_x(){
	return $this->ax;
}
function Get_y(){
	return $this->ay;
}
function Get_w(){
	return $this->aw;
}
function Get_h(){
	return $this->ah;
}

function Row($data,$code=false,$fills='',$fh='')
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
	if ($fh==""){
	    $h=3*$nb;
	}else{
		$h=3*$nb;
		if ($h < $fh)
		 	$h = $fh;
	}
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
		$ax=$x; $ay=$y; $aw=$w; $ah=$h;
        $this->Rect($x,$y,$w,$h,$fills);
        //Print the text
  		$this->MultiCell($w,3,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}

/********************END MULTICELL ************************/
}
