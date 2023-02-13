<?php 
   session_start();
   include_once "con_dbb.php";
require_once("controleur/controleur.class.php");
 $unControleur = new Controleur(); 
   //supprimer les produits
   //si la variable del existe
   if(isset($_GET['del'])){

    $id_del = $_GET['del'] ;
    //suppression
    unset($_SESSION['panier'][$id_del]);
    $sesid=$_SESSION['id'];
    //$sql="DELETE FROM panier WHERE client_id=$sesid AND product_id=$id_del";
    //mysqli_query($con,$sql);
// dans le modele "deleteproduct"
    $unControleur->deleteproduct($id_del,$sesid);
   }

   if(isset($_GET['val'])){

    $sesid=$_SESSION['id'];

    $sql="SELECT MAX(order_id) as 'max' FROM orders WHERE client_id=$sesid";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $ordid=$row['max'];

    if(!$ordid)
        $ordid=0;

     $ordid++;
     foreach($_SESSION['panier'] as $key => $value) 
     { 
       // $sql="INSERT INTO orders (client_id,product_id,quantity,order_id) VALUES('$sesid','$key','$value','$ordid')";
        //mysqli_query($con,$sql);
      $unControleur->insertcommande($sesid,$key,$value,$ordid);

        //dans le modele insertcommandes
    }

  
    echo " <script> alert('Votre commande a été enregistrée ') </script>";
    $_SESSION['panier']=array();
   // $sql="DELETE FROM panier WHERE client_id=$sesid";
    //mysqli_query($con,$sql);


    //dans le modele deletePanier
    $unControleur->deletePanier($sesid);

   }
   require_once("Vue/vue_panier.php");
?>
