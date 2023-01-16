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
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmail']) AND !empty($_POST['newmail']) AND $_POST['newmail'] != $user['mail']) {
      $newmail = htmlspecialchars($_POST['newmail']);
      $insertmail = $bdd->prepare("UPDATE membre SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
      header('Location: profil.php?id='.$_SESSION['id']);
   }
   if(isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) {
      $mdp1 = sha1($_POST['newmdp1']);
      $mdp2 = sha1($_POST['newmdp2']);
      if($mdp1 == $mdp2) {
         $insertmdp = $bdd->prepare("UPDATE membre SET mdp = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
         header('Location: profil.php?id='.$_SESSION['id']);
      } else {
         $msg = "Vos deux mdp ne correspondent pas !";
      }
   }
?>
<html>
   <head>   
      <title>TUTO PHP</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="style.css">
   </head>
   <body>
        <header class="navbar">
      <div class="logo">
         <img src=".\images\allume.png" alt="allumelogo">
         </div>
         <nav>
            <ul>

               <li><a href="index.php">Accueil</a></li>
               
               <li><a href="">Produits</a></li>
               
               <li><a href="">A propos</a></li>
               
               <li><a href="">Contact</a></li>
               
               <li><a href="connexion.php">Compte</a></li>
               
            </ul>
           <a href="index2.php"><img src=".\images\panier.png" alt="image2" width="26px"></a>
         </nav>
         
      
   </header>
   
      <div align="center">
         <h2>Edition de mon profil</h2>
         <div align="left">
            <form method="POST" action="" enctype="multipart/form-data">
               <label>Pseudo :</label>
               <input type="text" name="newPseudo" placeholder="Pseudo" value="<?php echo $user['Pseudo']; ?>" /><br /><br />
               <label>Mail :</label>
               <input type="text" name="newmail" placeholder="Mail" value="<?php echo $user['mail']; ?>" /><br /><br />
               <label>Mot de passe :</label>
               <input type="password" name="newmdp1" placeholder="Mot de passe " required=5/><br /><br />
               <label>Confirmation - mot de passe :</label>
               <input type="password" name="newmdp2" placeholder="Confirmation du mot de passe" /><br /><br />
               <input type="submit" value="Mettre à jour mon profil !" />
            </form>
            <?php if(isset($msg)) { echo $msg; } ?>
         </div>
      </div>
   </body>
</html>
<?php   
}
else {
   header("Location: connexion.php");
}
?>