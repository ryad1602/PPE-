<?php include_once "con_dbb.php"; 
 include_once "con_dbb.php";
 include_once"controleur/controleur.class.php";
 $unControleur = new Controleur(); 
 //verifier si une session existe
 if(!isset($_SESSION)){
    //si non demarer la session
    session_start();
 }
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commande</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body class="panier">
    <a href="index.php" class="link">Mes commandes</a>
    <section>
        <table>
            <tr>
                <th>Nom du client</th>
                <th>Nom d'article</th>
                <th> </th>
                <th>Prix d'Article</th>
                
                <th>Numéro Article</th>
                <th>Quantité</th>
                <th>Numéro de Commande</th>
            </tr>
             <?php 
             if(isset($_SESSION['id']))
             {
                //créer tableau vide (unedimension) ca = au return de la fonction d'en dessous
                //appeler la fonction via le controleur qui va return un tableau (une dimension)
                // ex : case tab[0]= $nm etc etc..

                $sesid=$_SESSION['id'];

                //lise des produit avec une boucle foreach
                    
                //inclure la page de connexion
                //afficher la liste des produits
                //$req = mysqli_query($con, "SELECT * FROM `orders` WHERE client_id=$sesid");

                $req = mysqli_query($con, "SELECT * FROM `orders` WHERE client_id=$sesid");
                while($row = mysqli_fetch_assoc($req)){ 
                $nm=$row['client_id'];
                $sql="SELECT Pseudo FROM membre WHERE id=$nm";
                $result = mysqli_query($con, $sql);
                $row2 = mysqli_fetch_array($result);
                $name=$row2['Pseudo'];

                    $pr=$row['product_id'];
                    $sql2="SELECT name FROM products WHERE id=$pr";
                    $result2= mysqli_query($con, $sql2);
                    $row3 = mysqli_fetch_array($result2);
                    $produit=$row3['name'];

                    $im=$row['product_id'];
                    $sql3="SELECT img FROM products WHERE id=$im";
                    $result3= mysqli_query($con, $sql3);
                    $row4 = mysqli_fetch_array($result3);
                    $image=$row4['img'];

                    $price=$row['product_id'];
                    $sql4="SELECT price FROM products WHERE id=$price";
                    $result4= mysqli_query($con, $sql4);
                    $row5 = mysqli_fetch_array($result4);
                    $prix=$row5['price'];

                 // $tab = [$unControleur->allorders()];

//num pro, photo prod , prix prod
                
                    ?>
                    <tr>
                        
                        <td><?=$name?></td>
                         <td><?=$produit?></td>
                         <td><img src="images/<?=$image?>"/></td>
                         <td><?=$prix?>€</td>


                        <td><?=$row['product_id']?></td>
                        <td><?=$row['quantity']?></td>
                        <td><?=$row['order_id']?></td>
                    </tr>

                <?php } }?>

               
        </table>
    </section>
     
</body>
</html>

<?php /* if(isset($_GET['val'])){

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
        $sql="INSERT INTO orders (client_id,product_id,quantity,order_id) VALUES('$sesid','$key','$value','$ordid')";
        mysqli_query($con,$sql);
    }

*/?>