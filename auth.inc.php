<?php
session_start(); // On relaye la session
if (session_is_registered("auth" . date('Y-m-d') . "EDN")){ // vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
}
else {
header("Location:authentification.php"); // redirection en cas d'echec
}
?>