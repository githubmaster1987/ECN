<?php
Require("connexionBDD.php");
Require("auth.inc.php");


include("header.html");

$sqllastdonateurs="SELECT ID_Donateur, Nom, Prenom FROM EDN_Donateurs ORDER BY ID_Donateur DESC LIMIT 10;";
$sqlrecup=mysql_query($sqllastdonateurs);
while($sqldata = mysql_fetch_array($sqlrecup))
{
	$last[]="<li><a style=\"color:#37342f;text-decoration:none;\" href = \"ficheDonateur.php?id=".$sqldata['ID_Donateur']."\">".strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom']))."</a></li>";
}
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">
	
    <!-- fil d'ariane -->
    <div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Accueil</h1>
	
    
    <br />
    
    <!-- Contenu -->
    <p class="p_contenu">
        <table width="500" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="260">
                <fieldset>
                    <legend><font style="color:#7f2616;"><b>Derniers donateurs enregistr&eacute;s :</b></font></legend>
                    <ul>
                        <?php for($i=0;$i<sizeof($last);$i++){echo $last[$i];}  ?>
                    </ul>
                </fieldset>
            </td>
            <td valign="top" style="padding-left:20px;">
			<!-- formulaire recherche -->
            	<form action="recherche.php" method="get"> 
                    <label for="recherche"><font style="color:#7f2616;"><b>Recherche :</b></font></label><br /><br />
                    <input type="text" name="recherche"/> <input type="submit" name="chercher" value="Chercher"/><br />
                    <input type="radio" name="RechercheType" value="0" checked /> Nom<br />
					<input type="radio" name="RechercheType" value="1"/> Tous <br />
                </form>
            </td>
          </tr>
        </table>
    </p>
    

</div>

<?php
include("footer.html");
?>