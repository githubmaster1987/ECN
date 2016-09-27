<?php
Require("auth.inc.php");

include("header.html");
?>


<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">
	
    <!-- fil d'ariane -->
    <div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="administration.php" style="color:#3f3520; text-decoration:none;">Administration</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Administration</h1>
    
    <br />
    
    <div align="left" id="menu_administration">
        <a href="adminTypesDons.php" style="text-decoration:none; color:#37342f;">&gt;&nbsp;&nbsp;Administration des types de dons</a>
        <a href="adminUtilisateurs.php" style="text-decoration:none; color:#37342f;">&gt;&nbsp;&nbsp;Administration des utilisateurs</a>
        <a href="Excel/SortieXLS.php" style="text-decoration:none; color:#37342f;">&gt;&nbsp;&nbsp;Fichier de synth&egrave;se</a>
     </div>
    
    

</div>

<?php
include("footer.html");
?>