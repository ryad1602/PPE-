	<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
 
if(isset($_SESSION['id'])) {
   $requser = $bdd->prepare("SELECT * FROM membre WHERE id = ?");
   $requser->execute(array($_SESSION['id']));
   $user = $requser->fetch();
   if(isset($_POST['newPseudo']) AND !empty($_POST['newPseudo']) AND $_POST['newPseudo'] != $user['Pseudo']) {
      $newPseudo = htmlspecialchars($_POST['newPseudo']);
      $insertPseudo = $bdd->prepare("UPDATE membre SET Pseudo = ? WHERE id = ?");
      $insertPseudo->execute(array($newPseudo, $_SESSION['id']));

      //dans le modele "updatepseudo"
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membre SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      // dans le modele "update mail"
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membre SET mdp = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         // dans le modele "update mdp"
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>

<?php   
require_once("Vue/vue_editionprofil.php");
}
else {
   header("Location: connexion.php");
}
?>
