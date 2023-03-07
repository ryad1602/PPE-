<?php
require_once ("Modele/modele.class.php");

class Controleur 
{
private $unModele;
 		public function __construct()
 		{
 			$this->unModele = new Modele();
 		}


 		

/********index accueil******/
public function showproducts (){
	$lesProduits = $this->unModele->showproducts();
	return $lesProduits;
}

/************ panier **********/
public function deleteproduct($id_del, $sesid){
	$leProduit = $this->unModele->deleteproduct($id_del, $sesid);
	return $leProduit;
}

public function selectcomm($sesid){
	$lesCommandes = $this->unModele->selectcomm($sesid);
	return $lesCommandes;
}
/*******Inscription*******/

public function insertClient()
{
	$lesClients = $this->unModele->insertClient();
}

public function verifmailexist($mail)
{
	$lesClients = $this->unModele->verifmailexist($mail);
	return $lesClients;
}


/**********Connexion******/

public function userexist()
{
	$lesClients = $this->unModele->userexist();
	return $lesClients;
}

public function selectpanier($sesid)
{
	$lePanier = $this->unModele->selectpanier($sesid);
	return $lePanier;
}
/********** Profil ******/
 public function userinfo($getid)
 {
 	$lesClients = $this->unModele->userinfo($getid);
 	return $lesClients;
 }

/********Edition Profil*****/
public function updateuser($newPseudo){ 

	$lesClients = $this->unModele->updateuser($newPseudo);
	return $lesClients;


	}


public function updatemail($newmail){ 

	$lesClients = $this->unModele->updatemail($newmail);
	return $lesClients;


	}

public function updatemdp($mdp1){ 

	$lesClients = $this->unModele->updatemdp($mdp1);
	return $lesClients;


	}


/***********Panier **********/

public function insertcommande ($sesid,$key,$value,$ordid){

	$lesProduits = $this->unModele->insertcommande($sesid,$key,$value,$ordid);
	return $lesProduits;

}

public function deletePanier($sesid){
	$lesProduits = $this->unModele->deletePanier($sesid);
	return $lesProduits;
}

public function showpanier($ids){
	$lesProduits = $this->unModele->showpanier($ids);
	return $lesProduits;
}


/**********Commandes******/
public function showorders()
{
	$lesCommandes= $this->unModele->showorders();
	return $lesCommandes;
}

public function allorders()
{

	$lesCommandes= $this->unModele->allorders();
	return $lesCommandes;


}
}

?>