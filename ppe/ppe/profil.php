<?php
session_start();
require_once("controleur/controleur.class.php");

$unControleur = new Controleur(); 
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
   $requser->execute(array($getid));
  $userinfo = $requser->fetch();
   
   //$unControleur->userinfo($getid);
  
// dans le modele "userinfo"
  
require_once("Vue/vue_profil.php");
?>

<?php   
}
?>