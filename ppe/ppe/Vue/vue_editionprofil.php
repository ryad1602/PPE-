<html>
   <head>   
      <title>TUTO PHP</title>
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
               
               <li><a href="index.php">Produits</a></li>
               
               <li><a href="">A propos</a></li>
               
              
               
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
