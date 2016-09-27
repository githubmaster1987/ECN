<?php
Require("connexionBDD.php");
Require("auth.inc.php");

//REQUETE POUR EFFECTUER UN DON
if(isset($_POST['MAJDon']))
{
	$idDons = $_GET['id'];
	$sqlUpdateDon = "UPDATE `EDN_Dons` SET `ID_Donateur` = '$idDonateur', `ID_Type_Don` = '$typeDon', `Montant` = '$montant', `Montant_Lettre` = '$montantLettre', `Forme` = '$forme', `Nature` = '$nature', `Mode` = '$mode', `Date` = '$date' WHERE `ID_Dons` = '$idDon' ;";
	$sqlUpdateDonExe=mysql_query($sqlUpdateDon);
	header("Location:ficheDon.php?id=".$idDons);
}



//variable pour recuperer ID_Dons
if(isset($_GET['id']))
{
	$sqlDon = "SELECT * FROM EDN_Dons, EDN_Type_Dons WHERE EDN_Dons.ID_Type_Don = EDN_Type_Dons.ID_Type_Don AND ID_Dons = ". $_GET['id']." ;";
	$sqlDonRecup=mysql_query($sqlDon);
	$sqldataDon = mysql_fetch_array($sqlDonRecup);
}
else
{
	 //<!---- Si l'id n'existe pas ou si il est vide, redirection vers la page d'accueil ----> 
	header("Location:index.php");
}
	

//REQUETE POUR LES INFOS DANS LA LISTE DEROULANTE TYPE DE DON
	$sqlTypeDon = "SELECT ID_Type_don, Nom FROM `EDN_Type_Dons`;";
	$sqlTypeDonResult = mysql_query($sqlTypeDon);
	$options = "";
	while($sqldataTypeDon = mysql_fetch_array($sqlTypeDonResult))
	{
		if($sqldataDon[2] == $sqldataTypeDon['ID_Type_don'])
		{
			$options .= "<option value='".$sqldataTypeDon['ID_Type_don']."' selected>";
		}
		else
		{
			$options .= "<option value='".$sqldataTypeDon['ID_Type_don']."'>";	
		}
		$options .= $sqldataTypeDon['Nom'];
		$options .= "</option>";
	}


include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="ficheDonateur.php?id=<?php echo $sqldataDon['ID_Donateur']?>" style="color:#3f3520; text-decoration:none;">Fiche donateur</a>&nbsp;&gt;&nbsp;<a href="gestionDons.php?id=<?php echo $sqldataDon['ID_Donateur']?>" style="color:#3f3520; text-decoration:none;">Gestion des dons</a>&nbsp;&gt;&nbsp;<a href="ficheDon.php?id=<?php echo $sqldataDon['ID_Dons']?>" style="color:#3f3520; text-decoration:none;">Fiche don</a>&nbsp;&gt;&nbsp;<a href="ficheDonModifs.php?id=<?php echo $sqldataDon['ID_Dons']?>" style="color:#3f3520; text-decoration:none;">Modifications fiche don</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Modifications fiche du don<br />&quot;<?php echo $sqldataDon['Nom']?>&quot;</h1>
	
	
	<br />
    <!-- Contenu -->
    <p class="p_contenu" align="left">
		<form method="post" >
        	<input type="hidden" name="idDon" value="<?php echo $_GET['id'];?>"/>
            <input type="hidden" name="idDonateur" value="<?php echo $sqldataDon['ID_Donateur'];?>"/>
        
            <table width="560" border="0" cellspacing="3" cellpadding="3">
                <tr> <!--TYPE DE DON-->
                    <td width="200"><label for="typeDeDon"><b>Nom du don :</b></label></td>
                    <td>
                        <select name="typeDon" id="typeDon">
                        	<?php echo $options; ?>
                        </select>
                	</td>
                </tr>
                <tr> <!--MONTANT-->
                    <td width="200"><label for="montant"><b>Montant :</b></label></td>
                    <td><input type="text" name="montant" id="montant" value="<?php echo $sqldataDon['Montant']?>"/></td>
                </tr>
                <tr> <!--MONTANT EN LETTRE-->
                    <td><label for="montantLettre"><b>Montant en lettre :</b></label></td>
                    <td><input type="text" name="montantLettre" id="montantLettre" value="<?php echo $sqldataDon['Montant_Lettre']?>"/></td>
                </tr>
                <tr> <!--FORME-->
                    <td width="200"><label for="forme"><b>Forme du don :</b></label></td>
                    <td>
                        <select name="forme" id="forme">
                            	<?php
								
									switch ($sqldataDon['Forme']) {
										case "auth":
												echo "<option value='auth' selected>Acte authentique</option>";
					                            echo "<option value='seing'>Acte sous seing priv&eacute;</option>";
					                            echo "<option value='don'>D&eacute;claration de don manuel</option>";
					                            echo "<option value='autres'>Autres</option>";

											break;
										case "seing":
												echo "<option value='auth'>Acte authentique</option>";
					                            echo "<option value='seing' selected>Acte sous seing priv&eacute;</option>";
					                            echo "<option value='don'>D&eacute;claration de don manuel</option>";
					                            echo "<option value='autres'>Autres</option>";
											break;
										case "don":
												echo "<option value='auth'>Acte authentique</option>";
					                            echo "<option value='seing'>Acte sous seing priv&eacute;</option>";
					                            echo "<option value='don' selected>D&eacute;claration de don manuel</option>";
					                            echo "<option value='autres'>Autres</option>";
											break;
										case "autres":
												echo "<option value='auth'>Acte authentique</option>";
					                            echo "<option value='seing'>Acte sous seing priv&eacute;</option>";
					                            echo "<option value='don' >D&eacute;claration de don manuel</option>";
					                            echo "<option value='autres' selected>Autres</option>";
											break;
									}
								?>
                            </option>

                        </select>
                    </td>
                </tr>
                <tr> <!--NATURE-->
                    <td width="200"><label for="nature"><b>Nature du don :</b></label></td>
                    <td>
                        <select name="nature" id="nature">
							<?php
                            
                                switch ($sqldataDon['Nature']) {
                                    case "num":
                                            echo "<option value='num' selected>Num&eacute;raire</option>";
                                            echo "<option value='cote'>Titres de soci&eacute;t&eacute;s cot&eacute;s</option>";
                                            echo "<option value='autres'>Autres</option>";

                                        break;
                                    case "cote":
                                            echo "<option value='num'>Num&eacute;raire</option>";
                                            echo "<option value='cote' selected>Titres de soci&eacute;t&eacute;s cot&eacute;s</option>";
                                            echo "<option value='autres'>Autres</option>";
                                        break;
                                    case "autres":
                                            echo "<option value='num'>Num&eacute;raire</option>";
                                            echo "<option value='cote'>Titres de soci&eacute;t&eacute;s cot&eacute;s</option>";
                                            echo "<option value='autres' selected>Autres</option>";
                                        break;
                                }
                            ?>
                            </option>
                        </select>
                    </td>
                </tr>
                <tr> <!--MODE-->
                    <td valign="top" width="200"><label for="mode"><b>En cas de don en num&eacute;raire,<br />mode de versement du don :</b></label></td>
                    <td valign="middle">
                        <select name="mode" id="mode">
							<?php
                            
                                switch ($sqldataDon['Mode']) {
                                    case "":
											echo "<option value='' selected></option>";
                                            echo "<option value='especes'>Remise d'esp&eacute;ces</option>";
                                            echo "<option value='cheque'>Ch&eacute;que</option>";
                                            echo "<option value='vpcb'>Virement, pr&eacute;l&eacute;vement, carte bancaire</option>";
                                        break;
									case "especes":
                                            echo "<option value=''></option>";
                                            echo "<option value='especes' selected>Remise d'esp&eacute;ces</option>";
                                            echo "<option value='cheque'>Ch&eacute;que</option>";
                                            echo "<option value='vpcb'>Virement, pr&eacute;l&eacute;vement, carte bancaire</option>";
                                        break;
                                    case "cheque":
                                            echo "<option value='' selected></option>";
                                            echo "<option value='especes'>Remise d'esp&eacute;ces</option>";
                                            echo "<option value='cheque' selected>Ch&eacute;que</option>";
                                            echo "<option value='vpcb'>Virement, pr&eacute;l&eacute;vement, carte bancaire</option>";
                                        break;
                                    case "vpcb":
                                            echo "<option value=''></option>";
                                            echo "<option value='especes'>Remise d'esp&eacute;ces</option>";
                                            echo "<option value='cheque'>Ch&eacute;que</option>";
                                            echo "<option value='vpcb' selected>Virement, pr&eacute;l&eacute;vement, carte bancaire</option>";
                                        break;
                                }
                            ?>
                            </option>
                        </select>
                    </td>
                </tr>
                <tr> <!--DATE-->
                    <td width="200"><label for="date"><b>Date du don :</b></label></td>
                    <td><input type="text" name="date" id="date" value="<?php echo $sqldataDon['Date']?>"/></td>
                </tr>
                <tr><!--BOUTONS-->
                    <td colspan="2" align="center"><input type="submit" name="MAJDon" value="Soumettre les modifications"/> </td>
                </tr>
            </table>
    </form>
    </p>
    
</div>

<?php
include("footer.html");
?>