<?php
session_start();
 
$bdd = new PDO('mysql:host=127.0.0.1;dbname=espace_membre', 'ryad', 'ryad');
 
if(isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $bdd->prepare('SELECT * FROM membre WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
?>
<html>
   <head>
      <title>Profil client</title>
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
            <img src=".\images\panier.png" alt="image2" width="26px">
         </nav>
         
      
   </header>
   
      <div align="center">
         <h2>Profil de <?php echo $userinfo['Pseudo']; ?></h2>
         <br /><br />
         Pseudo = <?php echo $userinfo['Pseudo']; ?>
         <br />
         Mail = <?php echo $userinfo['mail']; ?>
         <br />
         
         <br />
         <?php
         if(isset($_SESSION['id']) AND $userinfo['ID'] == $_SESSION['id']) {
         ?>
         <br />
         <a href="editionprofil.php">Editer mon profil</a>
         <a href="deconnexion.php">Se déconnecter</a>
         <?php
         }
         ?>
      </div>
   </body>
</html>
<?php   
}
?>