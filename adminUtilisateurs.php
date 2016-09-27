<?php
Require("connexionBDD.php");
Require("auth.inc.php");
// ------ AJOUT D'UN UTILISATEUR --------
if(isset($_POST['login'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	if(($_POST['login'] == "") || ($_POST['pass'] == "")){ // si login ou mot de passe non spécifiés >> message d'erreur
		header("Location:adminUtilisateurs.php?erreur=empty");
	}
	else if($_POST['pass'] == $_POST['pass2']){ // on vérifie si le mot de passe et le mot de passe confirmé ont la même valeur
		// on passe toutes les variables $POST en variables
		$login = $_POST['login'];
		$pass = md5($_POST['pass']); // ici, on crypte le mot de passe à l'aide de MD5 (c'est tout simple non ? :)
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$privilege = $_POST['privilege'];
		// on fait l'INSERT dans la base de données
		$add_user = sprintf("INSERT INTO EDN_Utilisateurs (login, pass, nom, prenom, privilege) VALUES ('$login', '$pass', '$nom', '$prenom', '$privilege')");
  		$result = mysql_query($add_user) or die(mysql_error());
		header("Location:adminUtilisateurs.php?add=ok"); // redirection si création réussie
	}
	else{
		header("Location:adminUtilisateurs.php?erreur=pass"); // redirection si le pass1 est différent du pass2
	}
}

// ------ SUPPRESSION D'UN UTILISATEUR --------
// on fait la requête sur tous les utilisateurs de la base pour alimenter notre sélecteur (on fait un tri par nom)

$query_users = "SELECT * FROM EDN_Utilisateurs ORDER BY nom ASC"; // ORDER BY renvoi les données triées (ici par nom croissant)
$users = mysql_query($query_users) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if(isset($_POST['suppr']) && ($_POST['suppr'] != "1")){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	$id = $_POST['suppr'];
    $delete_user = sprintf("DELETE FROM EDN_Utilisateurs WHERE ID_User='$id'");
  $result = mysql_query($delete_user) or die(mysql_error());
  header("Location:adminUtilisateurs.php?delete=ok"); // url qui servira pour afficher le message de réussite
}

include("header.html");

?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="administration.php" style="color:#3f3520; text-decoration:none;">Administration</a>&nbsp;&gt;&nbsp;<a href="adminUtilisateurs.php" style="color:#3f3520; text-decoration:none;">Administration utilisateurs</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Administration des utilisateurs</h1>
    
    <br />
    
    <form action="" method="post" name="add">
    <p align="center">
        <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "pass")) { // Affiche l'erreur  ?>
        <span class="erreur">Veuillez entrer deux fois votre mot de passe SVP</span>
        <?php } ?>
        <?php if(isset($_GET['add']) && ($_GET['add'] == "ok")) { // Affiche l'erreur ?>
        <span class="reussite">L'utilisateur a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s !</span>
        <?php } ?>
        <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "empty")) { // Affiche l'erreur  ?>
        <span class="erreur">Un petit oubli ? Veuillez renseigner au moins un login et un mot de passe SVP</span>
        <?php } ?>
    </p>
      <p align="center"><strong><u>Cr&eacute;ation d'utilisateurs :</u></strong></p>
      <table width="350" border="0" align="center" cellpadding="5" cellspacing="0" bgcolor="#efe9e4">
        <tr>
          <td width="40">Login</td>
          <td width="144"><input name="login" type="text" id="login"></td>
        </tr>
        <tr>
          <td>Mot de passe </td>
          <td><input name="pass" type="password" id="pass"></td>
        </tr>
        <tr>
          <td>R&eacute;p&eacute;ter mot de passe </td>
          <td><input name="pass2" type="password" id="pass2"></td>
        </tr>
        <tr>
          <td>NOM</td>
          <td><input name="nom" type="text" id="nom"></td>
        </tr>
        <tr>
          <td>Pr&eacute;nom</td>
          <td><input name="prenom" type="text" id="prenom"></td>
        </tr>
        <tr>
          <td>Privil&egrave;ge</td>
          <td><select name="privilege" id="privilege">
              <option value="user">Utilisateur</option>
              <option value="admin">Administrateur</option>
            </select></td>
        </tr>
        <tr>
          <td height="50" colspan="2"><div align="center">
              <input type="submit" name="Submit" value="Cr&eacute;er cet utilisateur">
            </div></td>
        </tr>
      </table>
    </form>
    
    <p align="center"><strong>
    	<?php 
    		if(isset($_GET['delete']) && ($_GET['delete'] == "ok")) { // Affiche l'erreur
		?>
        
      	<span class="reussite">L'utilisateur a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s</span>
    	
		<?php
        	}
		?>
      
		<?php 
			if(isset($_POST['verif']) && (!isset($_POST['suppr']))) { // Affiche l'erreur
		?>
        
		</strong><span class="erreur">Veuillez s&eacute;lectionner un utilisateur &agrave; supprimer </span><strong>
    
		<?php
        	}
		?>
    </p>
    
    <br />
    <img src="images/etoile.png" width="8" height="20"/><img src="images/etoile.png" width="8" height="20"/><img src="images/etoile.png" width="8" height="20"/>
    <br />
    
    <form action="" method="post" name="suppr">
      <p align="center"><strong><u>Suppression d'utilisateurs :</u></strong></p>
      <div align="center">
        <table width="350" border="0" cellpadding="5" cellspacing="0" bgcolor="#efe9e4">
          <tr>
            <td>
            	<div align="center">
                	<select name="suppr" size="5" id="select2">
                    	<?php
            				do {  
        				?>
                    <option value="<?php echo $row_users['ID_User']?>">
                    	<?php if($row_users['privilege']== "admin")
						{
                        	echo "Admin :  "; 
						}
						else
						{
							echo "User :  ";
						}
                      
                      	echo $row_users['nom']." ".$row_users['prenom']." (".$row_users['login'].")";
						?>
                     </option>
                    
					<?php
							}
					while ($row_users = mysql_fetch_assoc($users));
					$rows = mysql_num_rows($users);
					if($rows > 0)
					{
						mysql_data_seek($users, 0);
						$row_users = mysql_fetch_assoc($users);
					}
        			?>
                    </select>
                    <input name="verif" type="hidden" id="verif">
                </div>
            </td>
          </tr>
          <tr>
            <td align="center"><input type="submit" name="Submit2" value="Supprimer cet utilisateur"></td>
          </tr>
        </table>
        
      </div>
    </form>

</div>

<?php
include("footer.html");
?>