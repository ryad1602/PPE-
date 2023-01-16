<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'root', '');
 
if(isset($_POST['formconnexion'])) {

   $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);

   if(!empty($mailconnect) AND !empty($mdpconnect)) {

      $requser = $bdd->prepare("SELECT * FROM membre WHERE mail = ? AND mdp = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();

      if($userexist == 1) {

         $userinfo = $requser->fetch();       
         $_SESSION['id'] = $userinfo['ID'];
         $_SESSION['pseudo'] = $userinfo['Pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         header("Location: profil.php?id=".$_SESSION['id']);
         
      } else {
         $erreur = "Mauvais mail ou mot de passe !";

      }
   } else {
      $erreur = "Tous les champs doivent être complétés !";
   }
}
if(isset($_POST['forminscription'])){
   header("Location: inscription.php?id=".$_SESSION['id']);

} 
?>
<html>
   <head>
      <title>Connexion client</title>
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
               
               <li><a href="contact.php">Contact</a></li>
               
               <li><a href="connexion.php">Compte</a></li>
               
            </ul>
            <a href="index2.php"><img src=".\images\panier.png" alt="image2" width="26px"></a>
         </nav>
         
      
   </header>
      <div align="center">
         <h2>Connexion</h2>
         <br /><br />
         <form method="POST" action="">
            <input type="email" name="mailconnect" placeholder="Mail" />
            <input type="password" name="mdpconnect" placeholder="Mot de passe" />
            <br /><br />
            <input type="submit" name="formconnexion" value="Se connecter !" />
            <input type="submit" name="forminscription" value="S'inscrire !"  />
            
         </form>
         <?php
         if(isset($erreur)) {
            echo '<font color="red">'.$erreur."</font>";
         }
         ?>
      </div>
   </body>
</html>