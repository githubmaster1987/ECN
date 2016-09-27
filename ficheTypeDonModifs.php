<?php
Require("connexionBDD.php");
Require("auth.inc.php");

/*code pour le bouton Soumettre*/
if(isset($_POST['soumettre']))
{
$typeDon=$_POST['typeDon'];
$commentaires=$_POST['commentaires'];
$sqlUpdate="UPDATE `EDN_Type_Dons` SET `Nom` = '$typeDon', `Comment` = '$commentaires' WHERE `ID_Type_Don` = '".$_POST['id']."' ;";
$sqlUpdateExe=mysql_query($sqlUpdate);
header("Location:ficheTypeDon.php?id=".$_POST['id']);
}

if(isset($_GET['id']))
{
	$sql = "Select * From `EDN_Type_Dons`  Where `ID_Type_Don` = '". $_GET['id']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
}
else
{
	header("Location:adminTypesDons.php");
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- Fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="administration.php" style="color:#3f3520; text-decoration:none;">Administration</a>&nbsp;&gt;&nbsp;<a href="adminTypesDons.php" style="color:#3f3520; text-decoration:none;">Administration types dons</a>&nbsp;&gt;&nbsp;<a href="ficheTypeDon.php?id=<?php echo $sqldata['ID_Type_Don']?>" style="color:#3f3520; text-decoration:none;">Fiche type don</a>&nbsp;&gt;&nbsp;<a href="ficheTypeDonModifs.php?id=<?php echo $sqldata['ID_Type_Don']?>" style="color:#3f3520; text-decoration:none;">Modifications type don</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Modifications du type de don<br />&quot;<?php echo $sqldata['Nom']?>&quot;</h1>
    
    <br />
    <!-- Sous menu -->
    <p align="center" class="sous_menu">
    	<a href="adminTypesDons.php?" style="text-decoration:none; color:#93d737;">Retour &agrave; l'administration types dons</a>
    </p>
    
    <br />
    <!-- Contenu -->
    <p class="p_contenu" align="left">
    <form method="post">
    <table width="560" border="0" cellspacing="3" cellpadding="3">
      <tr valign="top">
        <td width="100">Type du don : </td>
        <td><input type="text" name="typeDon" value="<?php echo $sqldata['Nom']?>"></td>
      </tr>
      <tr valign="top">
        <td width="100">Commentaires : </td>
        <td><textarea name="commentaires" rows="10" cols="52"><?php echo $sqldata['Comment']?></textarea></td>
      </tr>
      <tr>
      	<td colspan="2" align="center"><input type="hidden" name="id" value="<?php echo $sqldata['ID_Type_Don']?>" /><input type="submit" value="Soumettre les modifications" name="soumettre" /></td>
      </tr>
    </table>
    </form>
    </p>


</div>

<?php
include("footer.html");
?>