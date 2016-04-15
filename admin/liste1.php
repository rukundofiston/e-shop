<?php
include ('config.php');
require_once('tcpdf/config/lang/eng.php');
require_once('tcpdf/tcpdf.php');
extract($_GET);
$cltM = new ClientManager($ikra);
$clients=$cltM->liste();
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'E-SHop2.png';
        $this->Image($image_file, 10, 10, 15, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', 'B', 20);
        // Title
        $this->Cell(0, 15, 'E-Shop', 0, false, 'C', 0, '', 0, false, 'M', 'M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}
// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('E-Shop');
$pdf->SetTitle('E-Shop');
$pdf->SetSubject('E-Shop');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

//set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

//set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

//set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

//set some language-dependent strings
$pdf->setLanguageArray($l);

// ---------------------------------------------------------

// set default font subsetting mode
$pdf->setFontSubsetting(true);

// Set font
// dejavusans is a UTF-8 Unicode font, if you only need to
// print standard ASCII chars, you can use core fonts like
// helvetica or times to reduce file size.
$pdf->SetFont('dejavusans', '', 11, '', true);

// Add a page
// This method has several options, check the source code documentation for more information.
$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print


//=================================================================================================================
//=================================================================================================================
// ============================ liste des stages ================================================================
//=================================================================================================================

	

$html="<h1>liste des clients </h1><table border='1' align='center'> <tr> <th style='background-color:#FFFF00;color:#0000FF;'>Nom</th>
<th style='background-color:#FFFF00;color:#0000FF;'>Prénom</th> <th style='background-color:#FFFF00;color:#0000FF;'>Date de naissance</th>
<th style='background-color:#FFFF00;color:#0000FF;'>Télephone</th><th style='background-color:#FFFF00;color:#0000FF;'>Ville</th>
<th style='background-color:#FFFF00;color:#0000FF;'>Adresse</th> 
<th style='background-color:#FFFF00;color:#0000FF;'>Email</th><th style='background-color:#FFFF00;color:#0000FF;>Sexe</th> </tr>";

		 foreach ($clients as $row) {	 		 
$html.=	"<tr> <td>{$row['nom']}</td><td>{$row['prenom']}</td><td>{$row['date_naissance']}</td><td>{$row['telephone']}</td>
<td>{$row['ville']}</td><td>{$row['adresse']}</td><td>{$row['email']}</td><td>{$row['sexe']}</td></tr>";
}

$html.='</table> ';





//=================================================================================================================

// Print text using writeHTMLCell()
$pdf->writeHTMLCell($w=0, $h=0, $x='', $y='', $html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);

// ---------------------------------------------------------

// Close and output PDF document
// This method has several options, check the source code documentation for more information.
$pdf->Output('example_001.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+