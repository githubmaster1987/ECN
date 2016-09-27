<?php
Require("connexionBDD.php");
Require("auth.inc.php");

//REQUETE RECUPERANT LES INFO DONATEUR
if(isset($_GET['id']))
{
	$sql = "SELECT * FROM `EDN_Donateurs`  Where `ID_Donateur` = '". $_GET['id']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
}

//REQUETE PERMETTANT D'ENREGISTRER LES MODIFICATIONS DONATEUR
if(isset($_POST['modifDonateur']))
{
	extract($_POST);
	$sqlmodif = "UPDATE `EDN_Donateurs` SET `Nom` = '$nom', `Prenom` = '$prenom', `Adresse` = '$adresse', `Adresse2` = '$adresse2', `CP` = '$cp', `Ville` = '$ville', `Tel` = '$telephone', `Comment` = '$comment' WHERE `ID_Donateur` = '".$_POST['idDonateur']."' LIMIT 1;";
	$sqlupdate=mysql_query($sqlmodif);
	header("Location:ficheDonateur.php?id=".$sqldata['ID_Donateur']);
}

//REQUETE PERMETTANT DE SUPPRIMER UN DONATEUR
if(isset($_POST['supprimerDonateur']))
{
	$queryDelete = "DELETE FROM `EDN_Donateurs` WHERE `ID_Donateur`= '".$_POST['idDonateur']."';";
	$result= mysql_query($queryDelete);
	header("Location:index.php");
}


include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">
	
	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="ficheDonateur.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Fiche Donateur</a>&nbsp;&gt;&nbsp;<a href="ficheDonateurModifs.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Fiche donateur modifications</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Modifications de <?php echo ucfirst(strtolower($sqldata['Nom']))?>&nbsp;<?php echo ucfirst(strtolower($sqldata['Prenom']))?></h1>
    
    <br />
    <!-- Contenu -->
    <p class="p_contenu" align="left"> 

	
        <!-- FORMULAIRE AJOUT DONATEUR -->
        <form method="post" name="ajoutDonateur">
        
            <input type="hidden" name="idDonateur" value="<?php echo $_GET['id'];?>"/> <!-- champ ID caché-->
        
            <table width="560" border="0" cellspacing="3" cellpadding="3">
                <tr> <!--NOM-->
                    <td><label for="nom">Nom</label> : </td>
                    <td><input type="text" name="nom" id="nom" value="<?php echo ucfirst(strtolower($sqldata['Nom']));?>"></td>
                </tr>
                <tr> <!--PRENOM-->
                    <td><label for="prenom">Prenom</label> : </td>
                    <td><input type="text" name="prenom" id="prenom" value="<?php echo ucfirst(strtolower($sqldata['Prenom']));?>"></td>
                </tr>
                <tr> <!--ADRESSE-->
                    <td><label for="adresse">Adresse</label> : </td>
                    <td><input type="text" name="adresse" id="adresse" value="<?php echo $sqldata['Adresse'];?>"></td>
                </tr>
                <tr> <!--ADRESSE2-->
                    <td><label for="adresse2">Adresse suite</label> : </td>
                    <td><input type="text" name="adresse2" id="adresse2" value="<?php echo $sqldata['Adresse2'];?>"></td>
                </tr>
                <tr> <!--CP-->
                    <td><label for="cp">Code Postal</label> : </td>
                    <td><input type="text" name="cp" id="cp" value="<?php echo $sqldata['CP'];?>"></td>
                </tr>
                <tr> <!--VILLE-->
                    <td><label for="ville">Ville</label> : </td>
                    <td><input type="text" name="ville" id="ville" value="<?php echo ucfirst(strtolower($sqldata['Ville']));?>"></td>
                </tr>
                <tr> <!--TELEPHONE-->
                    <td><label for="telephone">Telephone</label> : </td>
                    <td><input type="text" name="telephone" id="telephone" value="<?php echo $sqldata['Tel'];?>"></td>
                </tr>
                <tr> <!--COMMENT-->
                    <td valign="top"><label for="comment">Commentaires</label> : </td>
                    <td><textarea name="comment" id="comment" rows="10" cols="52"><?php echo $sqldata['Comment'];?></textarea></td>
                </tr>
                <tr><!--BOUTONS-->
                    <td colspan="2" align="center"><input type="submit" name="modifDonateur" value="Modifier"/>&nbsp;<input type="submit" value="Supprimer" name="supprimerDonateur" onclick="confirmByForm('Etes-vous s&ucirc;r de vouloir supprimer ce donateur ?','suppr')"/></td>
                </tr>
            </table>
        </form>
	</p>

</div>

<?php
mysql_close();
include("footer.html");
?>