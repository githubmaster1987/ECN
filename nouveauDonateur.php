<?php
Require("connexionBDD.php");
Require("auth.inc.php");

if(isset($_POST['newDonateur']))
{
	
	extract($_POST);
	$sqlDonateur = "INSERT INTO `EDN_Donateurs` (`ID_Donateur`, `Nom`, `Prenom`, `Adresse`, `Adresse2`, `CP`, `Ville`, `Tel`, `Comment`) VALUES (NULL, '$nom', '$prenom', '$adresse','$adresse2', '$cp', '$ville', '$telephone', '$comment')";
	$sqlajout = mysql_query($sqlDonateur);
	header("Location:index.php");
}




//session_start(); // ouverture de la connexion
	

include("header.html");
?>

<html>
<body>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="nouveauDonateur.php" style="color:#3f3520; text-decoration:none;">Nouveau donateur</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Nouveau donateur</h1>
	
    <br />
    <!-- Contenu -->
	<p class="p_contenu" align="left"> 
		<!-- FORMULAIRE AJOUT DONATEUR -->
        <form method="post" name="ajoutDonateur" onSubmit="return verifNom()">
            <table width="560" border="0" cellspacing="3" cellpadding="3">
               <tr> <!--NOM-->
                   <td width="120"><label for="nom"><b>Nom :</b></label></td>
                   <td><input type="text" name="nom" id="nom"></td>
               </tr>
               <tr> <!--PRENOM-->
                   <td width="120"><label for="prenom"><b>Pr&eacute;nom :</b></label></td>
                   <td><input type="text" name="prenom" id="prenom"></td>
               </tr>
               <tr> <!--ADRESSE-->
                   <td width="120"><label for="adresse"><b>Adresse :</b></label></td>
                   <td><input type="text" name="adresse" id="adresse"></td>
               </tr>
               <tr> <!--ADRESSE2-->
                   <td width="120"><label for="adresse2"><b>Adresse suite :</b></label></td>
                   <td><input type="text" name="adresse2" id="adresse2"></td>
               </tr>
               <tr> <!--CP-->
                   <td width="120"><label for="cp"><b>Code postal :</b></label></td>
                   <td><input type="text" name="cp" id="cp"></td>
               </tr>
               <tr> <!--VILLE-->
                   <td width="120"><label for="ville"><b>Ville :</b></label></td>
                   <td><input type="text" name="ville" id="ville"></td>
               </tr>
               <tr> <!--TELEPHONE-->
                   <td width="120"><label for="telephone"><b>T&eacute;l&eacute;phone :</b></label></td>
                   <td><input type="text" name="telephone" id="telephone"></td>
               </tr>
               <tr> <!--COMMENT-->
                   <td width="120" valign="top"><label for="comment"><b>Commentaires :</b></label></td>
                   <td><textarea name="comment" id="comment" rows="10" cols="50"></textarea></td>
               </tr>
               <tr><!--BOUTONS-->
                 <td colspan="2" align="center"><input type="submit" name="newDonateur" value="Enregistrer"/>&nbsp;<input type="reset" value="Vider les champs" /></td>
           </tr>
        
            
            </table>
        </form>
	</p>
</div>
</body>
</html>

<?php
include("footer.html");
mysql_close();
?>