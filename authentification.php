<?php
Require("connexionBDD.php");

/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
          DBProtect V1.2
-----------------------------------
*/

session_start(); // debut de session

if (isset($_POST['login'])){ // execution uniquement apres envoi du formulaire (test si la variable POST existe)
	$login = addslashes($_POST['login']); // mise en variable du nom d'utilisateur
	$pass = addslashes(md5($_POST['pass'])); // mise en variable du mot de passe chiffre a l'aide de md5 (I love md5)
	
// requete sur la table administrateurs (on recupere les infos de la personne)
$verif_query=sprintf("SELECT * FROM EDN_Utilisateurs WHERE login='$login' AND pass='$pass'"); // requete sur la base administrateurs
$verif = mysql_query($verif_query) or die(mysql_error());
$row_verif = mysql_fetch_assoc($verif);
$utilisateur = mysql_num_rows($verif);

	
	if ($utilisateur) {	// On test s'il y a un utilisateur correspondant
	
	    session_register("auth" . date('Y-m-d') . "EDN"); // enregistrement de la session
		
		// declaration des variables de session
		$_SESSION['privilege'] = $row_verif['privilege']; // le privilege de l'utilisateur (permet de definir des niveaux d'utilisateur)
		$_SESSION['nom'] = $row_verif['nom']; // Son nom
		$_SESSION['prenom'] = $row_verif['prenom']; // Son Prenom
		$_SESSION['login'] = $row_verif['login']; // Son Login
		//$_SESSION['pass'] = $row_verif['pass']; // Son mot de passe (a eviter)
		
		header("Location:index.php"); // redirection si OK
	}
	else {
		header("Location:authentification.php?erreur=login"); // redirection si utilisateur non reconnu
	}
}


// Gestion de la deconnexion
if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ // Test sur les parametres d'URL qui permettront d'identifier un contexte de deconnexion
	$prenom = $_SESSION['prenom']; // On garde le prenom en variable pour dire au revoir (soyons polis :-)
	session_unset("auth" . date('Y-m-d') . "EDN");
	header("Location:authentification.php?erreur=delog&prenom=$prenom");
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">
    
    <!-- Titre -->
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Authentification</h1>
    
    <br />
    <!-- Contenu -->
    <p class="p_contenu" align="left">
    	<form action="" method="post" name="connect">
          <p align="center" style="color:#7f2616;"><strong>&bull; ESPACE SECURISE &bull;</strong></p>
          <p align="center">
            <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { // Affiche l'erreur  ?>
            <strong class="erreur">Echec d'authentification !!! Login ou mot de passe incorrect</strong>
            <?php } ?>
            <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) { // Affiche l'erreur ?>
            <strong class="reussite">D&eacute;connexion r&eacute;ussie. A bient&ocirc;t! <?php echo $_GET['prenom'];?> !</strong>
            <?php } ?>
            <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) { // Affiche l'erreur ?>
            <strong class="erreur">Echec d'authentification !!! &gt; Aucune session n'est ouverte ou vous n'avez pas les droits pour afficher cette page.</strong>
            <?php } ?>
          </p>
        
          
          <table width="300"  border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#eeeeee" class="tableaux">
            <tr>
              <td width="50%"><div align="right">Login</div></td>
              <td width="50%"><input name="login" type="text" id="login"></td>
            </tr>
            <tr>
              <td width="50%"><div align="right">Mot de passe</div></td>
              <td width="50%"><input name="pass" type="password" id="pass"></td>
            </tr>
            <tr>
              <td height="34" colspan="2">
                  <div align="center">
                      <input type="submit" name="Submit" value="Se connecter">
                  </div>
              </td>
            </tr>
          </table>
        </form>
    </p> 
    
</div>

<?php
include("footer.html");
?>