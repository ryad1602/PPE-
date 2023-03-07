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

    
    <div class="container">

    <header class="navbar">
       <div class="logo">
        <img src=".\images\allume.png" alt="allumelogo">
        </div>
        

                   
        <nav>
            <ul>

                <li><a href="index.php">Accueil</a></li>
                
                <li><a href="produits.php">Produits</a></li>
                
               
                
              

                <?php if(!isset($_SESSION['id']))
                {
                    header('Location: connexion.php');
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
            <a href="produits.php">Explorer Maintenant</a>
        </div>

        <div class="col1">
            <img src=".\images\acc.jpg "alt="image1">
        </div>

    </div>






    </div>
    </section>

    
</body>
</html>