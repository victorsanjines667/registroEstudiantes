<?php

ini_set ('error_reporting', E_ALL);
require('../librerias/fpdf/fpdf.php');

class PDF extends FPDF
{
    public $xheader;
    public $yheader;
    public $anchoheader = 205;

   //Page header
	function Header()
	{
    	//Logo
	    $this->Image('../recursos/imagenes/cabecera_fina2.jpg',30,8,165);
	    //Arial bold 11
	   // $this->SetFont('gothic','',11);
	    //Line break
	    //$this->Ln(28);
		//Fecha
	}

	//Page footer
	function Footer()
	{
		
    	//Position at 1.5 cm from bottom
	   // $this->SetY(-20);
	    $this->SetY(-16);
	    //Arial italic 8
		 //$this->Image('images/piepagina.jpg',30,257,163);
	    $this->SetFont('Times','',6);//5.5
		//pie de pagina
		//Linea dibujada
		$this->Line(31,267,193,267); 
		$this->Cell(0,10,utf8_decode('LA PAZ:                   Calle Hugo Estrada Nº 94 *Telf.: 02-2220081 *Fax: 02-2223089                                      ORURO:  Calle La Plata entre Ayacucho y Cbba. Nº 5782 *Telf.: 02-5253513'),0,0,'J');
		$this->Ln(3);
		$this->Cell(0,10,utf8_decode('                                  Cajón Postal 1401 *Web: www.senape.gob.bo *Email: info@senape.gob.bo                   TRINIDAD: Calle Santa Cruz Nº 458 *Telf.: 03-4621627 - 03-4621456'),0,0,'J');
		$this->Ln(3);
		$this->Cell(0,10,utf8_decode('SANTA CRUZ:        Calle Libertad Esq. Andrés Ibáñez Nº 112 *Telf.: 03-3349661 *Fax: 03-3348444            SUCRE:  Av. Aniceto Arce Nº 449 *Telf.: 04-6452917'),0,0,'J');
		$this->Ln(3);
		$this->Cell(0,10,utf8_decode('COCHABAMBA:    Plaza 14 de Septiembre acera oeste Nº 258 *Telf.: 04-4584052 *Fax: 04-4588963'),0,0,'J');
		
			//$this->Ln(3);
			//$this->Cell(0,10,utf8_decode('ptm'.$nro_folio),0,0,'R');
	    //Page number
	    //$this->Cell(0,10,utf8_decode('Página ').$this->PageNo().' de {nb}',0,0,'R');
		//Image Footer
		//$this->Image('images/membrete-3.jpg',10,263,195);
	}
    /********************* MULTICELL *************************/
// Margins
    var $left = 10;
    var $right = 10;
    var $top = 10;
    var $bottom = 10;

    // Create Table
    function WriteTable($tcolums)
    {
        // go through all colums
        for ($i = 0; $i < sizeof($tcolums); $i++)
        {
            //para centra un poco la tabla
            $this->Cell(2);//10
            $current_col = $tcolums[$i];
            $height = 0;

            // get max height of current col
            $nb=0;
            for($b = 0; $b < sizeof($current_col); $b++)
            {
                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);

                $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));
                $height = $current_col[$b]['height'];
            }
            $h=$height*$nb;


            // Issue a page break first if needed
            $this->CheckPageBreak($h);

            // Draw the cells of the row
            for($b = 0; $b < sizeof($current_col); $b++)
            {
                $w = $current_col[$b]['width'];
                $a = $current_col[$b]['align'];

                // Save the current position
                $x=$this->GetX();
                $y=$this->GetY();

                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);

                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);


                // Draw Cell Background
                $this->Rect($x, $y, $w, $h, 'FD');

                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);

                // Draw Cell Border
                if (substr_count($current_col[$b]['linearea'], "T") > 0)
                {
                    $this->Line($x, $y, $x+$w, $y);
                }

                if (substr_count($current_col[$b]['linearea'], "B") > 0)
                {
                    $this->Line($x, $y+$h, $x+$w, $y+$h);
                }

                if (substr_count($current_col[$b]['linearea'], "L") > 0)
                {
                    $this->Line($x, $y, $x, $y+$h);
                }

                if (substr_count($current_col[$b]['linearea'], "R") > 0)
                {
                    $this->Line($x+$w, $y, $x+$w, $y+$h);
                }


                // Print the text
                $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);

                // Put the position to the right of the cell
                $this->SetXY($x+$w, $y);
            }

            // Go to the next line
            $this->Ln($h);
        }
    }


    // If the height h would cause an overflow, add a new page immediately
    function CheckPageBreak($h)
    {
        if($this->GetY()+$h>$this->PageBreakTrigger){
            $this->AddPage($this->CurOrientation);
            $this->SetX(7); //12
        }
        
            
    }


    // Computes the number of lines a MultiCell of width w will take
    function NbLines($w, $txt)
    {
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r", '', $txt);
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
	function name_date($s){
	switch ($s){
		case '01': return "enero"; break;
		case '02': return "febrero"; break;
		case '03': return "marzo"; break;
		case '04': return "abril"; break;
		case '05': return "mayo"; break;
		case '06': return "junio"; break;
		case '07': return "julio"; break;
		case '08': return "agosto"; break;
		case '09': return "septiembre"; break;
		case '10': return "octubre"; break;
		case '11': return "noviembre"; break;
		case '12': return "diciembre"; break;
	}
}

    /********************END MULTICELL ************************/
}
?>
