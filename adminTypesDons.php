<?php
Require("connexionBDD.php");
Require("auth.inc.php");

/* ---- Bouton Ajouter ---- */
if(isset($_POST['ajouter']))
{
	$newTypeDon=$_POST['ajoutTypeDon'];
	$sqlTypeDon="INSERT INTO `EDN_Type_Dons` (`Nom`, `Comment`) VALUES ('$newTypeDon', '');";
	$sqlTypeDonExe=mysql_query($sqlTypeDon);
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="administration.php" style="color:#3f3520; text-decoration:none;">Administration</a>&nbsp;&gt;&nbsp;<a href="adminTypesDons.php" style="color:#3f3520; text-decoration:none;">Administration types dons</a></span></td>
            <td width="160" align="right" style="padding-right:10px;"><a href="authentification.php?erreur=logout" style="color:#3f3520;">Se d&eacute;connecter</a></td>
          </tr>
        </table>
    </div>
    <br />

	<!-- Menu principal-->
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Administration des types de dons</h1>
    
    <br /><br />
    
    <!-- Contenu -->
    <table id="tableau_typesDons" border="0" width="400" cellspacing="0" cellpadding="5">
      <tr>
      	<td align="center">
        	<form method="post">
            	<input type="text" name="ajoutTypeDon"/>&nbsp;&nbsp;<input type="submit" name="ajouter" value="Ajouter" />
            </form><br /><br />
        </td>
      </tr>
      	<?php
		$queryListeTypesDons = "SELECT * FROM EDN_Type_Dons ORDER BY ID_Type_Don;";
		$queryListeTypesDonsResult = mysql_query($queryListeTypesDons);
		while($sqldata = mysql_fetch_array($queryListeTypesDonsResult))
		{
		?>
        <tr>
            <td>&bull;&nbsp;<?php echo $sqldata['Nom']?>&nbsp;&nbsp;-&nbsp;&nbsp;<a href="ficheTypeDon.php?id=<?php echo $sqldata['ID_Type_Don']?>" style="text-decoration:none">D&eacute;tails</a></td>
        </tr>
        
		<?php	
		}
		?>
      
      
    </table>

</div>

<?php
include("footer.html");
?>