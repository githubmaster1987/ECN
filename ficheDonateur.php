<?php
Require("connexionBDD.php");
Require("auth.inc.php");

//REQUETE RECUPPERANT LES INFOS DONATEUR
if(isset($_GET['id']))
{
	$sql = "SELECT * FROM `EDN_Donateurs`  Where `ID_Donateur` = '". $_GET['id']."' LIMIT 1;";	
	$sqlRecup=mysql_query($sql);
	$sqldata = mysql_fetch_array($sqlRecup);
}
else
{
	/* ---- Si l'id n'existe pas ou si il est vide, redirection vers la page d'accueil ---- */
	header("Location:index.php");
}


/* ---- Suppression d'un donateur ---- */
if(isset($_POST['idToDel']))
{
	$query = mysql_query("DELETE FROM `EDN_Donateurs` WHERE `ID_Donateur` = '".$_POST['idToDel']."' LIMIT 1");
	$query = mysql_query("DELETE FROM `EDN_Dons` WHERE `ID_Donateur` = '".$_POST['idToDel']."' LIMIT 1");
	header("Location:index.php"); /* ---- Retour a l'index ---- */
	
}

include("header.html");
?>

<div id="content" align="center" style="padding-bottom:20px;background-image:url('images/bg_repeat.png'); background-repeat:repeat-y; width:804;">

	<!-- fil d'ariane -->
	<div align="left" style="padding-left:20px;color:#3f3520;">
		<table width="780" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td><span>&gt;&nbsp;<a href="index.php" style="color:#3f3520; text-decoration:none;">Accueil</a>&nbsp;&gt;&nbsp;<a href="ficheDonateur.php?id=<?php echo $_GET['id']?>" style="color:#3f3520; text-decoration:none;">Fiche donateur</a></span></td>
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
    <h1><img src="images/etoile.png" width="8" height="20"/><img src="images/px.gif" width="10" height="1"/>Fiche de <?php echo ucfirst(strtolower($sqldata['Nom']))?>&nbsp;<?php echo ucfirst(strtolower($sqldata['Prenom']))?></h1>
    
    <br />
		
        
        <!-- Sous menu -->
        <span align="center" class="sous_menu">
            <a href="ficheDonateurModifs.php?id=<?php echo $_GET['id']?>" style="text-decoration:none; font-variant:small-caps; color:#93d737;">Modifier</a>
            <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
            <form method="post" id="suppr" style="display:inline">
                <input type="hidden" name="idToDel" value="<?php echo $_GET['id']?>" /><a href="#" style="text-decoration:none; color:#93d737;font-variant:small-caps;" onclick="confirmByForm('Etes-vous s&ucirc;r de vouloir supprimer ce donateur ?','suppr')">Supprimer</a>
            </form>
            <font style="color:#93d737;">&nbsp;&nbsp;-&nbsp;&nbsp;</font>
            <a href="gestionDons.php?id=<?php echo $_GET['id']?>" style="text-decoration:none;font-variant:small-caps; color:#93d737;">Gestion des dons</a>
                 
        </span>
        <br />
        
		
        <!-- Contenu -->
        <p class="p_contenu" align="left">
            <!-- FORMULAIRE CONSULTATION DONATEUR -->
            <form method="post" name="ajoutDonateur">
            
                <input type="hidden" name="idDonateur" value="<?php echo $_GET['id'];?>"/> <!-- champ ID cach�-->
            
                <table width="560" border="0" cellspacing="3" cellpadding="3">
                   <tr> <!--NOM-->
                       <td width="100"><label for="nom">Nom</label> : </td>
                       <td><strong><?php echo ucfirst(strtolower($sqldata['Nom'])); ?></strong></td>
                   </tr>
                   <tr> <!--PRENOM-->
                       <td width="100"><label for="prenom">Prenom</label> : </td>
                       <td><strong><?php echo ucfirst(strtolower($sqldata['Prenom'])); ?></strong></td>
                   </tr>
                   <tr> <!--ADRESSE-->
                       <td width="100"><label for="adresse">Adresse</label> : </td>
                       <td><strong><?php echo $sqldata['Adresse']; ?></strong></td>
                   </tr>
                   <tr> <!--ADRESSE2-->
                       <td width="100"><label for="adresse2">Adresse suite</label> : </td>
                       <td><strong><?php echo $sqldata['Adresse2']; ?></strong></td>
                   </tr>
                   <tr> <!--CP-->
                       <td width="100"><label for="cp">Code Postal</label> : </td>
                       <td><strong><?php echo $sqldata['CP']; ?></strong></td>
                   </tr>
                   <tr> <!--VILLE-->
                       <td width="100"><label for="ville">Ville</label> : </td>
                       <td><strong><?php echo ucfirst(strtolower($sqldata['Ville'])); ?></strong></td>
                   </tr>
                   <tr> <!--TELEPHONE-->
                       <td width="100"><label for="telephone">Telephone</label> : </td>
                       <td><strong><?php echo $sqldata['Tel']; ?></strong></td>
                   </tr>
                   <tr> <!--COMMENT-->
                       <td width="100"><label for="comment">Commentaires</label> : </td>
                       <td><strong><?php echo nl2br($sqldata['Comment']); ?></strong></td>
                   </tr>
            
            
                
                </table>
            </form>
		</p>
	
	

    
    <br /><br />
    
    
    
    

</div>

<?php
mysql_close();
include("footer.html");
?>