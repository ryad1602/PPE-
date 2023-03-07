<?php 
	//extraction //injection des données dans la base
class Modele{
	private $unPDO; //instance de la classe PDO


public function __construct()
{
	$this->unPDO = null;
	try{
	$this->unPDO = new PDO("mysql:host=localhost;dbname=espace_membre", "root", ""); //PHP DATA Object
	}
		
		catch(PDOexception $exp){
			echo "Erreur de connexion à la BDD <br/>";
			echo $exp->getMessage();
		}
		
}

/********index acuueil********/
public function showproducts (){
	$req = $this->unPDO->prepare("SELECT * FROM `products`");
}

/*********** panier ********/
public function deleteproduct($id_del, $sesid){
	$sql="DELETE FROM panier WHERE client_id=$sesid AND product_id=$id_del";
    $this->unPDO->prepare($sql);
}

public function showpanier($ids){
	$sql ="SELECT * FROM products WHERE id IN (".implode(',', $ids).")";
		$this->unPDO->prepare($sql);
}



/**************Inscription********/
public function insertClient($pseudo, $mail,$mdp)
	{
		if($this->unPDO != null){

			 $insertmbr = $this->unPDO->prepare("INSERT INTO membre(pseudo, mail, mdp) VALUES(?, ?, ?)");
                     $insertmbr->execute(array($pseudo, $mail, $mdp));


			}
	}

public function verifmailexist($mail)
 {
	
	$reqmail = $this->unPDO->prepare("SELECT * FROM membre WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
}


/*****************Connexion ********/

public function userexist()
{
	 $mailconnect = htmlspecialchars($_POST['mailconnect']);
   $mdpconnect = sha1($_POST['mdpconnect']);

	  $requser = $this->unPDO->prepare("SELECT * FROM membre WHERE mail = ? AND mdp = ?");
      $requser->execute(array($mailconnect, $mdpconnect));
      $userexist = $requser->rowCount();
}

public function selectpanier($sesid){
	 $sql="SELECT * FROM panier WHERE client_id=$sesid";
	 $this->unPDO->prepare($sql);
} 

/********** Profil *******/
public function userinfo($getid)
{
	$requser = $this->unPDO->prepare('SELECT * FROM membre WHERE id = ?');
   $requser->execute(array($getid));
   $userinfo = $requser->fetch();
   return $userinfo;
}

/********Editionprofil******/

public function updateuser($newPseudo){
	$insertPseudo = $this->unPDO->prepare("UPDATE membre SET Pseudo = ? WHERE id = ?");
      $insertPseudo->execute(array($newPseudo, $_SESSION['id']));
      //dans le modele "updatepseudo"
}

public function updatemail($newmail){
	 $insertmail = $this->unPDO->prepare("UPDATE membre SET mail = ? WHERE id = ?");
      $insertmail->execute(array($newmail, $_SESSION['id']));
}

public function updatemdp($mdp1){
$insertmdp = $this->unPDO->prepare("UPDATE membre SET mdp = ? WHERE id = ?");
         $insertmdp->execute(array($mdp1, $_SESSION['id']));
}

/*********** Panier **********/

public function insertcommande ($sesid,$key,$value,$ordid){
	 $sql="INSERT INTO orders (client_id,product_id,quantity,order_id) VALUES('$sesid','$key','$value','$ordid')";
       $this->unPDO->prepare($sql);
}
public function deletePanier($sesid){
 $sql="DELETE FROM panier WHERE client_id=$sesid";
    $this->unPDO->prepare($sql);
}

public function selectcomm($sesid)
{
 $sql="SELECT MAX(order_id) as 'max' FROM orders WHERE client_id=$sesid";
 $result =  $this->unPDO->prepare($sql);
 return $result;
}

/************Commandes*********/

public function showorders()
{
	 $req = mysqli_query($con, "SELECT * FROM `orders` WHERE client_id=$sesid");
	 return mysqli_fetch_assoc($req);
}

public function allorders()
{
	    $req = mysqli_query($con, "SELECT * FROM `orders` WHERE client_id=$sesid");
                while($row = mysqli_fetch_assoc($req)){ 
                $nm=$row['client_id'];
                $sql="SELECT Pseudo FROM membre WHERE id=$nm";
                $result = $this->unPDO->prepare($sql);
                $result->execute();
                $row2 = mysqli_fetch_array($result);
                $name=$row2['Pseudo'];

                    $pr=$row['product_id'];
                    $sql2="SELECT name FROM products WHERE id=$pr";
                    $result2= $this->unPDO->prepare($sql2);
                    $row3 = mysqli_fetch_array($result2);
                    $produit=$row3['name'];

                    $im=$row['product_id'];
                    $sql3="SELECT img FROM products WHERE id=$im";
                    $result3= $this->unPDO->prepare($sql3);
                    $row4 = mysqli_fetch_array($result3);
                    $image=$row4['img'];

                    $price=$row['product_id'];
                    $sql4="SELECT price FROM products WHERE id=$price";
                    $result4= $this->unPDO->prepare($sql4);
                    $row5 = mysqli_fetch_array($result4);
                    $prix=$row5['price'];

        $tab = [$name, $produit, $image, $prix];

        return $tab;


		/*public function count()
        {
            if($this->unPDO != null){
                $requete="select count(*) as nb from ".$this->table.";";
                $select= $this->unPDO->prepare($requete);
                $select->execute();
                $unResultat = $select->fetch();
                return $unResultat;
            }else{
                return null;    
            }
        }
*/


}

}

}

?>