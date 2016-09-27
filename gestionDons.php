<?php
Require("connexionBDD.php");
Require("auth.inc.php");

if(isset($_GET['id']))
{
	$sqlDon = "SELECT * FROM EDN_Dons, EDN_Type_Dons WHERE EDN_Dons.ID_Type_Don = EDN_Type_Dons.ID_Type_Don AND ID_Donateur = ". $_GET['id']." ;";
	$sqlRecup=mysql_query($sqlDon);
	while($sqldata = mysql_fetch_array($sqlRecup))
	{
		$dons[]="<li><a style=\"color:#37342f;text-decoration:none;\" href = \"ficheDon.php?id=".$sqldata['ID_Dons']."\">".$sqldata['ID_Dons']. " - ". $sqldata['Nom'] ." - ". $sqldata['Date'] ." - ". $sqldata['Montant'] ." &euro; "."</a></li>";
	}
}
else
{
	header("Location:adminTypesDons.php");
}


$sqlDonateur = "SELECT * FROM EDN_Donateurs WHERE ID_Donateur = ". $_GET['id']." ;";
$sqlDonateurRecup=mysql_query($sqlDonateur);
$sqldataDonateur = mysql_fetch_array($sqlDonateurRecup);

	

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="ficheDonateur.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Fiche donateur</a>&nbsp;&gt;&nbsp;<a href="gestionDons.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Gestion des dons</a></span></td>
            <td width="160" align="right" style="padding-right:10px;"><a href="authentification.php?erreur=logout" style="color:#3f3520;">Se d&eacute;connecter</a></td>
          </tr>
        </table>
																													
    </div>
    <br />

	<!-- Menu principal -->
    <table id="menu" width="794" height="30" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="menu_align_right" background="images/bg_menu.png" height="30" style="background-repeat:repeat-x;" ><a href="administration.php" style="text-decoration:none">Administration</a></td>
        <td width="1" height="30"><img src="images/px.gif" width="1" height="30"/></td>
        <td class="menu_center" valign="middle" background="images/bg_menu.png" height="30" style="background-repeat:repeat-x;" ><a href="recherche.php" style="text-decoration:none">Recherche</a></td>
        <td width="1" height="30"><img src="images/px.gif" width="1" height="30"/></td>
        <td class="menu_align_left" valign="left" background="images/bg_menu.png" height="30" style="background-repeat:repeat-x;" ><a href="nouveauDonateur.php" style="text-decoration:none">Nouveau donateur</a></td>
      </tr>
    </table>
    
    <br /><br />
    
    <!-- Titre -->
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Gestion des dons de <?php echo ucfirst(strtolower($sqldataDonateur['Nom'])) ." ". ucfirst(strtolower($sqldataDonateur['Prenom']))?></h1>
    
    <br />
    
    <!-- Sous menu -->
    <p align="center" class="sous_menu">
        <a href="effectuerDon.php?id=<?php echo $sqldataDonateur['ID_Donateur']?>" style="text-decoration:none; color:#93d737;">Effectuer un don</a>        
	</p>
    
    <!-- Contenu -->
    <p class="p_contenu">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="240">
                <fieldset>
                    <legend><font style="color:#7f2616;"><b>Don(s) de <?php echo ucfirst(strtolower($sqldataDonateur['Prenom'])) ." ". ucfirst(strtolower($sqldataDonateur['Nom'])) ?> :</b></font></legend>
                    <ul>
                        <?php for($i=0;$i<sizeof($dons);$i++){echo $dons[$i];}  ?>
                    </ul>
                </fieldset>
            </td>
          </tr>
        </table>
    </p>
    

</div>

<?php
include("footer.html");
?>