<html>
   <head>
      <title>Connexion client</title>
      <meta charset="utf-8">
      <link rel="stylesheet" type="text/css" href="style_connexion.css">
   </head>

   <body>
     <header class="navbar">
       <div class="logo">
        <img src=".\images\allume.png" alt="allumelogo">
        </div>
       
       
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