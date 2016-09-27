<?php
Require("connexionBDD.php");
Require("auth.inc.php");

/* ---- Suppression du type de don ---- */
if(isset($_POST['idToDel']))
{
	/* ---- Verification que le type de don ne soit pas utilise par un donateur ---- */
	$query = mysql_query("SELECT * FROM `EDN_Dons` WHERE `ID_Type_Don` = '".$_POST['idToDel']."' LIMIT 1;");
	while($back = mysql_fetch_assoc($query))
	{
		$ERREURS = "Impossible de supprimer ce type de don. Il est utilisé par au moins un donateur.";	/* ---- Affichage message d'erreur ---- */
	}
	
	/* ---- Suppression du type de don validee ---- */
	if(!isset($ERREURS))
	{
		$query = mysql_query("DELETE FROM `EDN_Type_Dons` WHERE `ID_Type_Don` = '".$_POST['idToDel']."' LIMIT 1");
		header("Location:adminTypesDons.php"); /* ---- Retour a la page d'administration ---- */
	}
}

/* ---- Affichage de la page courante ---- */
if((isset($_GET['id'])) && $_GET['id']!='')
{
	$sql = "Select * From `EDN_Type_Dons`  Where `ID_Type_Don` = '". $_GET['id']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
}
else
{
	/* ---- Si l'id n'existe pas ou si il est vide, redirection vers la page d'administration des types de dons ---- */
	header("Location:adminTypesDons.php");
}


include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="administration.php" style="color:#3f3520; text-decoration:none;">Administration</a>&nbsp;&gt;&nbsp;<a href="adminTypesDons.php" style="color:#3f3520; text-decoration:none;">Administration types dons</a>&nbsp;&gt;&nbsp;<a href="ficheTypeDon.php?id=<?php echo $sqldata['ID_Type_Don']?>" style="color:#3f3520; text-decoration:none;">Fiche type don</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Fiche du type de don &quot;<?php echo $sqldata['Nom']?>&quot;</h1>
    
    <br />
    
    <!-- Sous-menu -->
    <span align="center" class="sous_menu">
        <a href="adminTypesDons.php?" style="text-decoration:none; color:#93d737;font-variant:small-caps;">Retour</a>
        <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
        <a href="ficheTypeDonModifs.php?id=<?php echo $sqldata['ID_Type_Don']?>" style="text-decoration:none; color:#93d737;font-variant:small-caps;">Modifier</a>
        <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
        <form method="post" id="suppr" style="display:inline">
            <input type="hidden" name="idToDel" value="<?php echo $sqldata['ID_Type_Don']?>" /><a href="#" style="text-decoration:none; color:#93d737;font-variant:small-caps;" onclick="confirmByForm('Etes-vous s&ucirc;r de vouloir supprimer ce type de don?','suppr')">Supprimer</a>
        </form>
    </span>
    <br />
 	
	<?php
	/* ---- Message d'erreur ---- */
    if(isset($ERREURS))
	{
		echo "<b style='color:red'>".$ERREURS."</b><br />";
	}
	?>
    
    <br />
    
    <!-- Contenu -->
    <p class="p_contenu" align="left">
		<table width="560" border="0" cellspacing="3" cellpadding="3">
		<tr valign="top">
			<td width="120"><b>Type du don : </b></td>
			<td><?php echo $sqldata['Nom']?></td>
		</tr>
		<tr valign="top">
			<td width="120"><b>Commentaires : </b></td>
			<td><?php echo nl2br($sqldata['Comment'])?></td>
		</tr>
		</table>

    </p>


</div>

<?php
include("footer.html");
?>