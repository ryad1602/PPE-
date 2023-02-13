<html>
   <head>
      <title>Profil client</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="style_connexion.css">
   </head>
   <body>
       <header class="navbar">
       <div class="logo">
        <img src=".\images\allume.png" alt="allumelogo">
        </div>
        <nav>
            <ul>

                <li><a href="index.php">Accueil</a></li>
                
                <li><a href="produits.php">Produits</a></li>
                
                <li><a href="">A propos</a></li>
                
                <li><a href="contact.php">Contact</a></li>
                
                <li><a href="connexion.php">Compte</a></li>
                
            </ul>
             <a href="panier.php"><img src=".\images\panier.png" alt="image2" width="26px"></a>
        </nav>
        
       
    </header>


   
     </header>
   
      <div class="profile-container">
         <h2>Profil de <?php echo $userinfo['Pseudo']; ?></h2>
         <div class="profile-info">
            <p>Pseudo = <?php echo $userinfo['Pseudo']; ?></p>
            <p>Mail = <?php echo $userinfo['mail']; ?></p>
         </div>
         <?php
         if(isset($_SESSION['id']) AND $userinfo['ID'] == $_SESSION['id']) {
         ?>
            <div class="profile-actions">
               <a href="editionprofil.php">Editer mon profil</a>
               <a href="deconnexion.php">Se déconnecter</a>
               <a href="commande.php">Mes commandes</a>

            </div>
         <?php
         }
         ?>
      </div>
</body>






</html>