<?php 
if((!isset($_GET['id'])) || $_GET['id'] == "")
{
	header("Location:../index.php");
}


Require("../connexionBDD.php");
$querypdf = "SELECT * FROM `EDN_Dons`, `EDN_Donateurs` WHERE EDN_Donateurs.ID_Donateur = EDN_Dons.ID_Donateur AND `ID_Dons` = ".$_GET['id']." LIMIT 1;";

$querypdfResult = mysql_query($querypdf);
$sqldata = mysql_fetch_array($querypdfResult);
		
require_once('fpdf.php');
require_once('fpdi.php'); 


//Recuperation de toute les informations : 
$ID_Recu = $sqldata['ID_Dons'];
$Nom_Prenom = utf8_decode(strtoupper($sqldata['Nom'] ." " . $sqldata['Prenom']));
$Adresse  = strtoupper($sqldata['Adresse'] . " " . $sqldata['Adresse2']);
$CP  = utf8_decode(strtoupper($sqldata['CP'] . " - " . $sqldata['Ville']));
$Montant = strtoupper($sqldata['Montant']);
$Montant_Lettre = strtoupper($sqldata['Montant_Lettre']);
$DateDons = strtoupper($sqldata['Date']);
$Forme = $sqldata['Forme'];
$Nature = $sqldata['Nature'];
$Mode = $sqldata['Mode'];

// initiate FPDI 
$pdf =& new FPDI(); 
// add a page 
$pdf->AddPage(); 
// set the sourcefile 
$pdf->setSourceFile('ModelesDONS.pdf'); 
// import page 1 

$tplIdx = $pdf->importPage(1); 
// use the imported page and place it at point 10,10 with a width of 100 mm 
$pdf->useTemplate($tplIdx, 0, 0);
$f = $pdf->getTemplatesize($tplIdx);


$pdf->SetFont('Arial'); 
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(168, 20); 
$pdf->Write(1, $ID_Recu); 


$tplIdx = $pdf->importPage(2); 
$s = $pdf->getTemplatesize($tplIdx); 
$pdf->AddPage('P', array($s['w'], $s['h'])); 
// use the imported page and place it at point 10,10 with a width of 100 mm 
$pdf->useTemplate($tplIdx, 0, 0 ); 




// Nom Prenom
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(30, 18); 
$pdf->Write(0, $Nom_Prenom); 

// Adresse
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(37, 26); 
$pdf->Write(0, $Adresse);

// CP
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(37, 34); 
$pdf->Write(0, $CP);

// Montant
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('14');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(100, 59); 
$pdf->Write(0, $Montant); 

// Montant en Lettre
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(56, 67); 
$pdf->Write(0, $Montant_Lettre); 

// DateDons
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('10');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(66, 75); 
$pdf->Write(0, $DateDons); 

// Date AUJ
$pdf->SetFont('Arial'); 
$pdf->SetFontSize('11');
$pdf->SetTextColor(0,0,0);
$pdf->SetXY(133, 226); 
$pdf->Write(0, date("d/m/y")); 

$sizeForme['auth']['w'] = 18.2;
$sizeForme['auth']['h'] = 103;
$sizeForme['seing']['w'] = 65.5;
$sizeForme['seing']['h'] = 103;
$sizeForme['don']['w'] = 114.8;
$sizeForme['don']['h'] = 103;
$sizeForme['autres']['w'] = 170.2;
$sizeForme['autres']['h'] = 103;

$sizeNature['num']['w'] = 18.2;
$sizeNature['num']['h'] = 123;
$sizeNature['cote']['w'] = 65.5;
$sizeNature['cote']['h'] = 123;
$sizeNature['autres']['w'] = 116.2;
$sizeNature['autres']['h'] = 123;

$sizeMode['especes']['w'] = 18.2;
$sizeMode['especes']['h'] = 143.6;
$sizeMode['cheque']['w'] = 66;
$sizeMode['cheque']['h'] = 143.6;
$sizeMode['vpcb']['w'] = 116;
$sizeMode['vpcb']['h'] = 143.6;


$pdf->SetFont('Arial'); 
$pdf->SetFontSize('51');
$pdf->SetTextColor(0,0,0);

if($Forme != "")
{
	$pdf->SetXY($sizeForme[$Forme]['w'], $sizeForme[$Forme]['h']); 
	$pdf->Write(0, "."); 
}

if($Nature != "")
{
	$pdf->SetXY($sizeNature[$Nature]['w'], $sizeNature[$Nature]['h']); 
	$pdf->Write(0, "."); 
}

if($Mode != "")
{
	$pdf->SetXY($sizeMode[$Mode]['w'], $sizeMode[$Mode]['h']); 
	$pdf->Write(0, "."); 
}



$pdf->Output($DateDons .' - '. $Nom_Prenom . utf8_decode(' - Reçu au titre des dons.pdf'), 'D');
?>