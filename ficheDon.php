<?php
Require("connexionBDD.php");
Require("auth.inc.php");

//variable pour recuperer ID_Dons
if(isset($_GET['id']))
{
	$sqlDon = "SELECT * FROM EDN_Dons, EDN_Type_Dons WHERE EDN_Dons.ID_Type_Don = EDN_Type_Dons.ID_Type_Don AND ID_Dons = ". $_GET['id']." ;";
	$sqlDonRecup=mysql_query($sqlDon);
	$sqldataDon = mysql_fetch_array($sqlDonRecup);
}
else
{
	/* ---- Si l'id n'existe pas ou si il est vide, redirection vers la page d'accueil ---- */
	header("Location:index.php");
}

/* ---- Suppression d'un don ---- */
if(isset($_POST['idToDel']))
{
	$query = mysql_query("DELETE FROM `EDN_Dons` WHERE `ID_Dons` = '".$_POST['idToDel']."' LIMIT 1");
	header("Location:gestionDons.php?id=".$sqldataDon['ID_Donateur']); /* ---- Retour a l'index ---- */
	
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="ficheDonateur.php?id=<?php echo $sqldataDon['ID_Donateur']?>" style="color:#3f3520; text-decoration:none;">Fiche donateur</a>&nbsp;&gt;&nbsp;<a href="gestionDons.php?id=<?php echo $sqldataDon['ID_Donateur']?>" style="color:#3f3520; text-decoration:none;">Gestion des dons</a>&nbsp;&gt;&nbsp;<a href="ficheDon.php?id=<?php echo $sqldataDon['ID_Dons']?>" style="color:#3f3520; text-decoration:none;">Fiche don</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Fiche du don &quot;<?php echo $sqldataDon['Nom']?>&quot;</h1>
	
    <br />
    <!-- Sous-menu -->
    <span align="center" class="sous_menu">
        <a href="gestionDons.php?id=<?php echo $sqldataDon['ID_Donateur']?>" style="text-decoration:none; color:#93d737;font-variant:small-caps;">Retour</a>
        <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
        <a href="ficheDonModifs.php?id=<?php echo $sqldataDon['ID_Dons']?>" style="text-decoration:none; color:#93d737;font-variant:small-caps;">Modifier</a>
        <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
        <form method="post" id="suppr" style="display:inline">
            <input type="hidden" name="idToDel" value="<?php echo $_GET['id']?>" /><a href="#" style="text-decoration:none; color:#93d737;font-variant:small-caps;" onclick="confirmByForm('Etes-vous s&ucirc;r de vouloir supprimer ce don ?','suppr')">Supprimer</a>
        </form>
    </span>
    <br />
    <span align="center" class="sous_menu">
        <a href="FPDI/Pdf_Merci.php?id=<?php echo $sqldataDon['ID_Donateur']?>" style="text-decoration:none; color:#93d737;font-variant:small-caps;">Imprimer remerciement</a>
        <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
        <a href="FPDI/Pdf_Recu.php?id=<?php echo $sqldataDon['ID_Dons']?>" style="text-decoration:none; color:#93d737;font-variant:small-caps;">Imprimer re&ccedil;u</a>
    </span>
	
	<br />
    <!-- Contenu -->
    <p class="p_contenu" align="left">
		<table width="560" border="0" cellspacing="3" cellpadding="3">
			<tr> <!--NOM DU DON-->
                <td width="200"><label for="typeDeDon"><b>Nom du don :</b></label></td>
                <td><?php echo $sqldataDon['Nom']?></td>
            </tr><tr> <!--MONTANT-->
                <td width="200"><label for="montant"><b>Montant :</b></label></td>
                <td><?php echo $sqldataDon['Montant']?>&nbsp;&euro;</td>
            </tr>
            <tr> <!--MONTANT EN LETTRE-->
                <td><label for="montantLettre"><b>Montant en lettre :</b></label></td>
                <td>
				<?php echo $sqldataDon['Montant_Lettre'];
                
				?>
                </td>
            </tr>
            <tr> <!--FORME-->
                <td width="200"><label for="forme"><b>Forme du don :</b></label></td>
                <td>
					<?php
						switch ($sqldataDon['Forme']) {
							case "auth":
								echo "Acte authentique";
								break;
							case "seing":
								echo "Acte sous seing priv&eacute;";
								break;
							case "don":
								echo "D&eacute;claration de don manuel";
								break;
							case "autres":
								echo "Autres";
								break;
						}
					?>
                </td>
            </tr>
            <tr> <!--NATURE-->
                <td width="200"><label for="nature"><b>Nature du don :</b></label></td>
                <td>
					<?php
                        switch ($sqldataDon['Nature']) {
							case "num":
                                echo "Num&eacute;raire";
                                break;
							case "cote":
                                echo "Titres de soci&eacute;t&eacute;s cot&eacute;s";
                                break;
							case "autres":
                                echo "Autres";
                                break;
                        }
                    ?>
                </td>
            </tr>
            <tr> <!--MODE-->
                <td width="200"><label for="mode"><b>Mode de versement du don :</b></label></td>
                <td>
                	<?php
                        switch ($sqldataDon['Mode']) {
                             case "especes":
                                echo "Remise d'esp&eacute;ces";
                                break;
							case "cheque":
                                echo "Ch&eacute;que";
                                break;
							case "vpcb":
                                echo "Virement, pr&eacute;l&eacute;vement, carte bancaire";
                                break;
                        }
                    ?>
                </td>
            </tr>
            <tr> <!--DATE-->
                <td width="200"><label for="date"><b>Date du don :</b></label></td>
                <td><?php echo $sqldataDon['Date']?></td>
            </tr>
        </table>
    </p>
    
</div>

<?php
include("footer.html");
?>