<?php

//inclure la page de connexion
 include_once "con_dbb.php";
 //verifier si une session existe
 if(!isset($_SESSION)){
    //si non demarer la session
    session_start();
 }
 
 //creer la session
 if(!isset($_SESSION['panier'])){
    //s'il nexiste pas une session on créer une et on mets un tableau a l'intérieur 
    $_SESSION['panier'] = array();
    $sesid=$_SESSION['id'];
    $sql="SELECT * FROM panier WHERE client_id=$sesid";

    $req= mysqli_query($con,$sql);
    while($row = mysqli_fetch_assoc($req))
    { 
         $_SESSION['panier'][$row['product_id']]=$row['quantity'];
    }
 
 }
 //récupération de l'id dans le lien

  if(isset($_GET['id'])){//si un id a été envoyé alors :
    $id = $_GET['id'] ;
    
    //verifier grace a l'id si le produit existe dans la base de  données
    $produit = mysqli_query($con ,"SELECT * FROM products WHERE id = $id") ;
    if(empty(mysqli_fetch_assoc($produit))){
        //si ce produit n'existe pas
        die("Ce produit n'existe pas");
    }
    //ajouter le produit dans le panier ( Le tableau)

    if(isset($_SESSION['panier'][$id])){// si le produit est déjà dans le panier
        $_SESSION['panier'][$id]++; //Représente la quantité 
        $sesid=$_SESSION['id'];
        $sql="UPDATE panier SET quantity=quantity+1 WHERE client_id=$sesid AND product_id=$id";
        mysqli_query($con,$sql);


    }else {
        //si non on ajoute le produit
        echo "Salut";
        $_SESSION['panier'][$id]= 1 ;
        $sesid=$_SESSION['id'];

        ///// Requete  INsert  table avec client_id = SESSISonID et product_id=$id ; quantite=1;
         mysqli_query($con, "INSERT INTO panier (client_id, product_id, quantity) VALUES ('$sesid','$id', '1')");

    }

   header("Location:index.php");

var_dump($_SESSION);
  }
?>