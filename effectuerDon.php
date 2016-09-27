<?php
Require("connexionBDD.php");
Require("auth.inc.php");

//variable pour recuperer ID_Donateur
if(isset($_GET['id']))
{
	$idDonateur = $_GET['id'];
}
else
{
	/* ---- Si l'id n'existe pas ou si il est vide, redirection vers la page d'accueil ---- */
	header("Location:index.php");
}

//REQUETE POUR LES INFOS DANS LA LISTE DEROULANTE TYPE DE DON
$sqlTypeDon = "SELECT ID_Type_don, Nom FROM `EDN_Type_Dons`;";
	$sqlTypeDonResult = mysql_query($sqlTypeDon);
	$options = "";
	while($sqldataTypeDon = mysql_fetch_array($sqlTypeDonResult))
	{
		$options .= "<option value='".$sqldataTypeDon['ID_Type_don']."'>";
		$options .= $sqldataTypeDon['Nom'];
		$options .= "</option>";
	}


//REQUETE POUR EFFECTUER UN DON
	if(isset($_POST['EffectuerDon']))
		{
			$sqlDon = "INSERT INTO `EDN_Dons` (`ID_Dons`, `ID_Donateur`, `ID_Type_Don`, `Montant`, `Montant_Lettre`, `Forme`, `Nature`, `Mode`, `Date`) VALUES (NULL, '$idDonateur', '".$_POST['typeDon']."', '".$_POST['montant']."', '".$_POST['montantLettre']."', '".$_POST['forme']."', '".$_POST['nature']."', '".$_POST['mode']."', '".$_POST['date']."')";
			$sqlupdateDon=mysql_query($sqlDon);
			header("Location:gestionDons.php?id=".$idDonateur);
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
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="ficheDonateur.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Fiche donateur</a>&nbsp;&gt;&nbsp;<a href="gestionDons.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Gestion des dons</a>&nbsp;&gt;&nbsp;<a href="effectuerDon.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Effectuer un don</a></span></td>
            <td width="160" align="right" style="padding-right:10px;"><a href="authentification.php?erreur=logout" style="color:#3f3520;">Se d&eacute;connecter</a></td>
          </tr>
        </table>
																													
    </div>
    <br />

	<!-- MENU -->
    <table id="menu" width="794" height="30" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="menu_align_right" background="images/bg_menu.png" height="30" style="background-repeat:repeat-x;" ><a href="administration.php" style="text-decoration:none">Administration</a></td>
        <td width="1" height="30"><img src="images/px.gif" width="1" height="30"/></td>
        <td class="menu_center" valign="middle" background="images/bg_menu.png" height="30" style="background-repeat:repeat-x;" ><a href="recherche.php" style="text-decoration:none">Recherche</a></td>
        <td width="1" height="30"><img src="images/px.gif" width="1" height="30"/></td>
        <td class="menu_align_left" valign="left" background="images/bg_menu.png" height="30" style="background-repeat:repeat-x;" ><a href="nouveauDonateur.php" style="text-decoration:none">Nouveau donateur</a></td>      </tr>
    </table>
    
    <br /><br />
    <!-- Titre -->
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Effectuer un don pour<br /><?php echo ucfirst(strtolower($sqldataDonateur['Nom'])) ." ". ucfirst(strtolower($sqldataDonateur['Prenom']))?></h1>
	
	
	<br />
    <!-- Contenu -->
	<!-- FORMULAIRE FAIRE UN DON -->
    <form method="post" >
        <p class="p_contenu" align="left"> 
        
            <input type="hidden" name="idDonateur" value="<?php echo $_GET['id'];?>"/> <!-- champ ID cach�-->
        
            <table width="560" border="0" cellspacing="3" cellpadding="3">
                <tr> <!--TYPE DE DON-->
                    <td width="180"><label for="typeDeDon">Type de don :</label></td>
                    <td>
                         <select name="typeDon" id="typeDon">
                            <?php echo $options; ?>
                        </select>
                	</td>
                </tr>
                <tr> <!--MONTANT-->
                    <td width="180"><label for="montant">Montant :</label></td>
                    <td><input type="text" name="montant" id="montant"/> </td>
                </tr>
                <tr> <!--MONTANT EN LETTRE-->
                    <td><label for="montantLettre">Montant en lettre :</label></td>
                    <td><input type="text" name="montantLettre" id="montantLettre"/></td>
                </tr>
                <tr> <!--FORME-->
                    <td width="180"><label for="forme">Forme du don :</label></td>
                    <td>
                        <select name="forme" id="forme">
                            <option value='auth'>Acte authentique</option>
                            <option value='seing'>Acte sous seing priv&eacute;</option>
                            <option value='don'>D&eacute;claration de don manuel</option>
                            <option value='autres'>Autres</option>
                        </select>
                    </td>
                </tr>
                <tr> <!--NATURE-->
                    <td width="180"><label for="nature">Nature du don :</label></td>
                    <td>
                        <select name="nature" id="nature">
                            <option value='num'>Num&eacute;raire</option>
                            <option value='cote'>Titres de soci&eacute;t&eacute;s cot&eacute;s</option>
                            <option value='autres'>Autres</option>
                
                        </select>
                    </td>
                </tr>
                <tr> <!--MODE-->
                    <td valign="top" width="180"><label for="mode">En cas de don en num&eacute;raire,<br />mode de versement du don :</label></td>
                    <td valign="middle">
                        <select name="mode" id="mode">
                            <option value=''></option>
                            <option value='especes'>Remise d'esp&eacute;ces</option>
                            <option value='cheque'>Ch&eacute;que</option>
                            <option value='vpcb'>Virement, pr&eacute;l&eacute;vement, carte bancaire</option>
                        </select>
                    </td>
                </tr>
                <tr> <!--DATE-->
                    <td width="180"><label for="date">Date du don :</label></td>
                    <td><input type="text" name="date" id="date"/></td>
                </tr>
                <tr><!--BOUTONS-->
                    <td colspan="2" align="center"><input type="submit" name="EffectuerDon" value="Effectuer un don"/> </td>
                </tr>
            </table>
        </p>
    </form>

    

</div>

<?php
include("footer.html");
?>