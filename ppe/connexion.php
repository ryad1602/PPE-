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

      // function userexist dans modele

      if($userexist == 1) {

         $userinfo = $requser->fetch();       
         $_SESSION['id'] = $userinfo['ID'];
         $_SESSION['pseudo'] = $userinfo['Pseudo'];
         $_SESSION['mail'] = $userinfo['mail'];
         $_SESSION['panier'] = array();
         $sesid=$userinfo['ID'];
         $sql="SELECT * FROM panier WHERE client_id=$sesid";
         $con = mysqli_connect("localhost","root","","espace_membre");

          $req= mysqli_query($con,$sql);
          while($row = mysqli_fetch_assoc($req))
          { 
               $_SESSION['panier'][$row['product_id']]=$row['quantity'];
          }
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

require_once("Vue/vue_connexion.php");
?>
