<?php 
 session_start() ;
include_once "con_dbb.php";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique</title>
    <link rel="stylesheet" href="style2.css">
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
            <a href="panier.php"><img src=".\images\panier.png" alt="image2" width="26px"></a>
        </nav>
        
       
    </header>

    <!-- afficher le nombre de produit dans le panier -->
    <a href="panier.php" class="link">Panier<span><?=array_sum($_SESSION['panier'])?></span></a>
    <section class="products_list">
        <?php 
        //inclure la page de connexion
        include_once "con_dbb.php";
        //afficher la liste des produits
         $req = mysqli_query($con, "SELECT * FROM products");
         while($row = mysqli_fetch_assoc($req)){ 
        ?>
        <form action="" class="product">
            <div class="image_product">
                <img src="project_images/<?=$row['img']?>">
            </div>
            <div class="content">
                <h4 class="name"><?=$row['name']?></h4>
                <h2 class="price"><?=$row['price']?>€</h2>
                <a id='id' name='id' type= 'submit' href="ajouter_panier.php?id=<?=$row['id']?>" class="id_product">Ajouter au panier</a>
            </div>
        </form>

        <?php } ?>
       
    </section>
</body>
</html>