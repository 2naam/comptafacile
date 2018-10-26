<p>Bienvenue dans la connexion !</p>

<?php
//récupération des champs de formulaire
$pseudo = null;
$password = null;
if(isset($_POST['pseudo']) ){$pseudo=trim($_POST['pseudo']);}
if(isset($_POST['password']) ){$password=trim($_POST['password']);}

//Definition des messages d'erreur
$Erreurs = array();

//Chemin du fichier utilisateurs
$filePath = '../data/utilisateurs.txt';

// On ouvre le fichier ou on le crée s'il existe pas
$userFile = fopen("".$filePath, 'a+');

// Verification du pseudo 
if(($pseudo != null && $pseudo != "") && ($password != null && $password != "")) {
	$pseudotrouve = false;
	$passwordMatch = false;	
	// Test de l'attribution du pseudo 
	while(!feof($userFile)) {
        //Lecture d'une ligne
		$line = fgets($userFile);
        //Separation de la ligne sur le charactere ','
		$splittedLine = explode(",", $line);
		$PseudoBase = trim($splittedLine[1]);
		$PasswordBase = trim($splittedLine[2]);
		//Test de la présence du pseudo en deuxième position de la ligne
		if ($PseudoBase == $pseudo){
			$pseudotrouve = true;
			if($PasswordBase == $password){
				$passwordMatch = true;
			}
		}
    }
	if($pseudotrouve){
		echo "<div>Pseudo reconnu</div>";
		if($passwordMatch){
			echo "<div>Mot de passe ok</div>";
		} else {
			$Erreurs['password'] = "Mot de passe erroné ";
			echo "<div>Mot de passe faux !</div>";
			echo "<div>Cassez vous d'ici!</div>";
		}
	} else {
		echo "<div>Pseudo non reconnu</div>";
		echo "<div>Cassez vous d'ici!</div>";
		$Erreurs['user'] = "Pseudo inconnu ! ";
	}	
} else {
		$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
		echo "<div>Veuillez saisir tous vos identifiants !</div>";
}

// On ferme le fichier
fclose($userFile);
?>