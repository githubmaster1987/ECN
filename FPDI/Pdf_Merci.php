<?php 
if((!isset($_GET['id'])) || $_GET['id'] == "")
{
	header("Location:../index.php");
}


Require("../connexionBDD.php");
$querypdf = "SELECT * FROM `EDN_Donateurs` WHERE ID_Donateur = ".$_GET['id']." LIMIT 1;";

$querypdfResult = mysql_query($querypdf);
$sqldata = mysql_fetch_array($querypdfResult);
		
require_once('fpdf.php');
require_once('fpdi.php'); 

	
	//Recuperation de toute les informations : 
	$ID_Recu = $sqldata['ID_Dons'];
	$Nom_Prenom = strtoupper($sqldata['Nom']) ." " . ucfirst(strtolower($sqldata['Prenom']));
	$Adresse  = $sqldata['Adresse'];
	$Adresse2  = $sqldata['Adresse2'];
	$CPVILLE = utf8_decode($sqldata['CP'] . " " . $sqldata['Ville']);
	
	// initiate FPDI 
	$pdf =& new FPDI(); 
	// add a page 
	$pdf->AddPage(); 
	// set the sourcefile 
	$pdf->setSourceFile('Remerciements.pdf'); 
	// import page 1 
	
	$tplIdx = $pdf->importPage(1); 
	// use the imported page and place it at point 10,10 with a width of 100 mm 
	$pdf->useTemplate($tplIdx, 0, 0);
	$f = $pdf->getTemplatesize($tplIdx);
	
	
	
	
	// Nom Prenom
	$pdf->SetFont('Arial'); 
	$pdf->SetFontSize('12');
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(115, 53); 
	$pdf->Write(0, $Nom_Prenom); 
	
	// Adresse
	$pdf->SetFont('Arial'); 
	$pdf->SetFontSize('11');
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(115, 60); 
	$pdf->Write(0, $Adresse);

	// Adresse2
	$pdf->SetFont('Arial'); 
	$pdf->SetFontSize('11');
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(115, 65); 
	$pdf->Write(0, $Adresse2);

	// CP & Ville
	$pdf->SetFont('Arial'); 
	$pdf->SetFontSize('11');
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(115, 70); 
	$pdf->Write(0, $CPVILLE); 

	// Date AUJ
	$pdf->SetFont('Arial','I','11'); 
	$pdf->SetTextColor(0,0,0);
	$pdf->SetXY(143, 110.1); 
	$pdf->Write(0, date("d/m/y")); 




$pdf->Output(utf8_decode($Nom_Prenom.' - Merci.pdf'), 'D');
?>