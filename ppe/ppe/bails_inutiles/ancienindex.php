<?php 
 session_start() ;
 require_once("controleur/controleur.class.php");
 $unControleur = new Controleur(); 
?>
<?php 
//connexion à la base de données
$con = mysqli_connect("localhost","root","","espace_membre");
//verifier la connexion

if(!$con) 
		die('Erreur : '.mysqli_connect_error());



?>

    <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ALLU-ME</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <section class="header-section">

         <?php if(!isset($_SESSION['id']))
                {
                    header("Vue/vue_connexion");

                }
                    ?>
    
    <div class="container">

    <header class="navbar">
       <div class="logo">
        <img src=".\images\allume.png" alt="allumelogo">
        </div>
        

                   
        <nav>
            <ul>

                <li><a href="index.php">Accueil</a></li>
                
                <li><a href="produits.php">Produits</a></li>
                
               
                
                <li><a href="contact.php">Contact</a></li>

                <?php if(!isset($_SESSION['id']))
                {
                	?>
                
                <li><a href="connexion.php">Compte</a></li>

                 <?php }
                 else
                 {

                	?>

                     <li><a href="commande.php">Commandes</a></li>
                    <li><a href="profil.php?id=<?=$_SESSION['id']?>">Profil</a></li>



                	<?php 
                 }

                	?>
                
            </ul>
             <a href="panier.php"><img src=".\images\panier.png" alt="image2" width="26px"></a>
        </nav>
        
       
    </header>

    <div class="row"> 

        <div class="col1">
            <h1>Imaginez vos fenêtres et menuiseries adaptées à votre intérieur !</h1>
            <p>Choisissez les caractéristiques de vos fenêtres et menuiseries <br>jusqu’à la couleur extérieure de l’aluminium et la finition intérieure du bois.</p>
            <a href="">Explorer Maintenant</a>
        </div>

        <div class="col1">
            <img src=".\images\acc.jpg "alt="image1">
        </div>

    </div>






    </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2>Top catégories</h2>
            <div class="row">
        <div class="col2">
            <img src=".\images\porte.jpg">
        </div>
        <div class="col2">
            <img src=".\images\vitre.jpg">
        </div>
        <div class="col2">
            <img src=".\images\he.jpg">
        </div>
        </div>
        </div>
    </section>

    <section class="meilleurs-produits">
        <div class="container">
        <h2>Meilleurs produits</h2>
        </div>

    <!-- afficher le nombre de produit dans le panier -->
      <section class="products_list">
        <?php 
        //inclure la page de connexion
        //afficher la liste des produits
         $req = mysqli_query($con, "SELECT * FROM `products`");

         //$unControleur->showproducts();
         //dans le modele 

         //$panier = $unControleur->
      
      //faut que le nombre de produit dans le panier soit inférieur à la quantité du produit

         //j'aurai mis un boolean isclient si il est egal a 0 c pas un client et si=1 c un client 
         while($row = mysqli_fetch_assoc($req)){ 
        ?>
        <form action="" class="product">

            <div class="image_product">
                <img src="images/<?=$row['img']?>">
            </div>
            <div class="content">
                <h4 class="name"><?=$row['name']?></h4>
                <h2 class="price"><?=$row['price']?>€</h2>
                <a href="ajouter_panier.php?id=<?=$row['id']?>" class="id_product">Ajouter au panier</a>
            </div>
        </form>

        <?php } ?>
       
    </section>
</body>
</html>