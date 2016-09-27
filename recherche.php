<?php
Require("connexionBDD.php");
Require("auth.inc.php");


//REQUETE RECHERCHE
if(isset($_GET['chercher']))
{
$Exist = " ";
//si on recherche un nom
if($_GET['RechercheType'] == 0)
{
$queryRecherche = "SELECT * FROM `EDN_Donateurs` WHERE `Nom` LIKE '%".$_GET['recherche']."%' ORDER BY Nom ;";
}
//si on fait une recherche à la fois sur le nom, prenom, adresse, code postal, ville, telephone, commentaire
if($_GET['RechercheType'] == 1)
{
	$queryRecherche = "SELECT * FROM `EDN_Donateurs` WHERE `Comment` LIKE '%".$_GET['recherche']."%' OR `Nom` LIKE '%".$_GET['recherche']."%' OR `Prenom` LIKE '%".$_GET['recherche']."%' OR `Adresse` LIKE '%".$_GET['recherche']."%' OR `CP` LIKE '%".$_GET['recherche']."%' OR `Ville` LIKE '%".$_GET['recherche']."%' OR `Tel` LIKE '%".$_GET['recherche']."%' ORDER BY Nom ;";
}

$queryRechercheResult = mysql_query($queryRecherche);
}




include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- Fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;" id="haut_page">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="recherche.php" style="color:#3f3520; text-decoration:none;">Recherches</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Recherche</h1>
	
    <!-- Contenu -->
	<p class="p_contenu" align="left"> 
	
	<!-- FORMULAIRE DE RECHERCHE-->
			<table>
				<tr> <!--RECHERCHE-->
					<td>
					<center>
						<form method="get" action="recherche.php">
						<label for="recherche">Nouvelle Recherche</label> :
						<input type="text" name="recherche" id="recherche"> 
						<!--BOUTONS-->
						<input type="submit" name="chercher" value="Rechercher"/> <br />
						<!-- radio button -->
						<input type="radio" name="RechercheType" value="0" checked /> Nom &nbsp;&nbsp;&nbsp;&nbsp;	<input type="radio" name="RechercheType" value="1"/> Tous
						</form>
					</center>
					</td>
				</tr>
				<tr height="100px">
				<td><center><h3>Recherche de : "<?php echo $_GET['recherche'];?>"</h3></center></td>
			</tr>
			</table>
	
        <!-- affichage resultat -->
        <table>
            <tr>
				<td>
					<fieldset>
                        <legend><font style="color:#7f2616;"><b>R&eacute;sultat de la recherche :</b></font></legend>
                        <table width="400" cellpadding="0" cellspacing="0">
                        <?php
                        //controle pour savoir si la recherche renvoi quelque chose ou non
                        if(isset($Exist))
                            {
                            $rows = mysql_num_rows($queryRechercheResult);
                            }
    
                        // Si la requete ne renvoie rien
                        if($rows == 0)
                        {
                        echo "<tr><td>Aucune entr&eacute;e ne correspond &agrave; votre recherche.</td></tr>";
                        }
                        else  //sinon
                        {
                        $count = 1;
                        while($sqldata = mysql_fetch_array($queryRechercheResult))
                        {	
                            if (is_int($count / 50)) 
                            {
                             echo "<td><td>&nbsp;</td></tr>";
                             echo "<tr><td align=\"right\"><a href=\"#haut_page\" style=\"color:#93d737;text-decoration:none\">Haut de page <img src=\"images/arrow_up.png\" width=\"10\" height=\"10\" border=\"0\"/></a></td></tr>";
                             echo "<td><td>&nbsp;</td></tr>";
                            }
                            echo "<tr><td width=\"400\"><a style=\"color:#37342f;text-decoration:none;\" href = \"ficheDonateur.php?id=".$sqldata['ID_Donateur']."\">&bull;&nbsp;".strtoupper($sqldata['Nom'])." ". ucfirst(strtolower($sqldata['Prenom']))."</a></td></tr>";
                            $count = $count + 1;
                            }
                        }?>
                        </table>
					</fieldset>
				</td>
            <tr>
            	<td align="right">
                	<a href="#haut_page" style="color:#93d737;text-decoration:none">Haut de page</a>
                </td>
            </tr>
			</tr>
		</table>
	</p>

    
    

</div>

<?php
mysql_close();
include("footer.html");
?>