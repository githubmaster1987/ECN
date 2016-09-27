<?php

Require("../connexionBDD.php");
$queryListeTypesDons = "SELECT * FROM EDN_Type_Dons ORDER BY ID_Type_Don;";
$queryListeTypesDonsResult = mysql_query($queryListeTypesDons);
$count = 0;




$Ligne = 0;
$DebutDon = 8;

set_time_limit(300);

require_once "class.writeexcel_workbook.inc.php";
require_once "class.writeexcel_worksheet.inc.php";


$fname = tempnam("/tmp", "bigfile.xls");
$workbook = &new writeexcel_workbook($fname);
$worksheet = &$workbook->addworksheet();

$header =& $workbook->addformat();
$header->set_color('white');
$header->set_align('center');
$header->set_align('vcenter');
$header->set_pattern();
$header->set_fg_color('green');




// $worksheet->write($row, $col, "ROW:$row COL:$col");
$worksheet->write($Ligne, 0, "Recu", $header);
$worksheet->write($Ligne, 1, "Date", $header);
$worksheet->write($Ligne, 2, "Nom", $header);
$worksheet->write($Ligne, 3, "Prénom", $header);
$worksheet->write($Ligne, 4, "Adresse", $header);
$worksheet->write($Ligne, 5, "CP", $header);
$worksheet->write($Ligne, 6, "Ville", $header);
$worksheet->write($Ligne, 7, "Téléphone", $header);
$count = 0;
while($sqldata = mysql_fetch_array($queryListeTypesDonsResult))
	{
		$worksheet->write($Ligne, $DebutDon + $count, $sqldata['Nom'], $header);
		$TypeDons[$sqldata['ID_Type_Don']][0] = $sqldata['Nom'];
		$TypeDons[$sqldata['ID_Type_Don']][1] = $DebutDon + $count;
		$count = $count + 1;
		$comment =  $DebutDon + $count;
	}
$worksheet->write($Ligne,$comment, "Commentaire", $header);


$queryDonnateur = mysql_query("SELECT ID_Dons,Montant,Date,ID_Type_Don, EDN_Donateurs.* FROM EDN_Dons, EDN_Donateurs WHERE EDN_Dons.ID_Donateur = EDN_Donateurs.ID_Donateur");
$Ligne = $Ligne + 1;
while($sqldata = mysql_fetch_array($queryDonnateur))
	{
		$worksheet->write($Ligne, 0, $sqldata['ID_Dons']);
		$worksheet->write($Ligne, 1, $sqldata['Date']);
		$worksheet->write($Ligne, 2, $sqldata['Nom']);
		$worksheet->write($Ligne, 3, $sqldata['Prenom']);
		$worksheet->write($Ligne, 4, $sqldata['Adresse'] . " " . $sqldata['Adresse2']);
		$worksheet->write($Ligne, 5, $sqldata['CP']);
		$worksheet->write($Ligne, 6, $sqldata['Ville']);
		$worksheet->write($Ligne, 7, $sqldata['Tel']);
		$worksheet->write($Ligne, $TypeDons[$sqldata['ID_Type_Don']][1], $sqldata['Montant']);	
		$worksheet->write($Ligne, $comment, $sqldata['Comment']);
		$Ligne = $Ligne + 1;
	}

$workbook->close();

header("Content-Type: application/x-msexcel; name=\"FichierSynthese.xls\"");
header("Content-Disposition: inline; filename=\"FichierSynthese.xls\"");
$fh=fopen($fname, "rb");
fpassthru($fh);
unlink($fname);

?>
