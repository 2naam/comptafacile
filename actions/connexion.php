<h2>Bienvenue dans la connexion !</h2>

<?php

require_once('../model/User.php');
require_once('../tools/FileReader.php');
session_start();

//récupération des champs de formulaire
$user = null; 
$Erreurs = array();
$Success = array();

if(isset($_POST['pseudo']) &&  isset($_POST['password'])){
	$user = new User(trim($_POST['pseudo']),trim($_POST['password']));
	// Verification du pseudo 
	if ($user->isValidForConnect()){
		$fileReader = new FileReader('../data/utilisateurs.txt',",");
		$passwordMatch = $fileReader -> find($user->getPseudo(),1,$user->getPassword(),2);	
		
		if($passwordMatch){
			echo "<div>Vous êtes connectez !</div>";
			$Success['user'] = "Utilisateur connecté";
			$_SESSION['user'] = $user;
		} else {
			$Erreurs['user'] = "Pseudo ou mot de passe incorrecte !";
		}	
	} else {
			$Erreurs['user'] = "Identifiant(s) manquant(s) ou incorrecte(s) ";
	}
} else{
	$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
}
$_SESSION['erreurs'] = $Erreurs;
$_SESSION['success'] = $Success;
$_SESSION['pseudo'] = $user -> getPseudo();
header("Location: http://localhost/comptafacile");
