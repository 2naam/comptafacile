<p>Bienvenue dans la connexion !</p>

<?php

require_once('../model/User.php');
require_once('../tools/FileReader.php');

//récupération des champs de formulaire

$user = null; 
$Erreurs = array();

if(isset($_POST['pseudo']) &&  isset($_POST['password'])){
	$user = new User(trim($_POST['pseudo']),trim($_POST['password']));
} else{
	$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
	echo "<div>Veuillez saisir tous vos identifiants !</div>";
}

// Verification du pseudo 
if ($user->hasPseudo() && ($user->hasPassword())){
	$fileReader = new FileReader('../data/utilisateurs.txt',",");
	$passwordMatch = $fileReader -> find($user->getPseudo(),1,$user->getPassword(),2);	
	
	if($passwordMatch){
		echo "<div>Vous êtes connectez !</div>";
	} else {
		echo "<div>Pseudo ou mot de passe incorrecte !</div>";
		echo "<div>Cassez vous d'ici!</div>";
		$Erreurs['user'] = "Pseudo ou mot de passe incorrecte !";
	}	
} else {
		$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
		echo "<div>Veuillez saisir tous vos identifiants !</div>";
}
?>