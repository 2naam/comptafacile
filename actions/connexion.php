<p>Bienvenue dans la connexion !</p>

<?php
//récupération des champs de formulaire
$pseudo = null;
$password = null;
if(isset($_POST['pseudo']) ){$pseudo= $_POST['pseudo'];}
if(isset($_POST['password']) ){$password= $_POST['password'];}

//Definition des messages d'erreur
$Erreurs = array();

//Chemin du fichier utilisateurs
$filePath = '../data/utilisateurs.txt';

// On ouvre le fichier ou on le crée s'il existe pas
$userFile = fopen("".$filePath, 'r');

// Replace le pointeur au début du fichier 
fseek($userFile, 0);

// Verification du pseudo 

if ($pseudo != null) {
	$pseudotrouve = false;
	
	// Test de l'attribution du pseudo 
	while(!feof($userFile)) {
        //Lecture d'une ligne
		$line = fgets($userFile);
        //Separation de la ligne sur le charactere ','
		$splittedLine = explode(",", $line);
		//Test de la présence du pseudo en deuxième position de la ligne
		if ($splittedLine[1] == $pseudo){
			$pseudotrouve = true;
		}
    }
	if($pseudotrouve){
		echo "<div>Pseudo reconnu</div>";
	} else {
		echo "<div>Pseudo non reconnu</div>";
		echo "<div>Cassez vous d'ici!</div>";
		$Erreurs['user'] = "Pseudo inconnu ! ";
	}	
} else {
		$Erreurs['user'] = "Utilisateur non défini ! ";
}

fseek($userFile, 0);

// Verification du mot de passe

if ($password != null) {
	$passwordtrouve = false;
	
	// Replace le pointeur au début du fichier 
	fseek($userFile, 0);
	
	// Test de la validité du mot de passe
	while(!feof($userFile)) {
        //Lecture d'une ligne
		$line = fgets($userFile);
        //Separation de la ligne sur le charactere ','
		$splittedLine = explode(",", $line);
		//Test de la validité du mot de passe correspondant au pseudo 
		if ($splittedLine[1] == $pseudo && $splittedLine[2] == $password){
			$passwordtrouve = true;
		}
    }
	if($passwordtrouve){
		echo "<div>Mot de passe reconnu</div>";
		echo "<div>Vous êtes connecté !</div>";
	} else {
		echo "<div>Mot de passe non reconnu</div>";
		echo "<div>Cassez vous d'ici!</div>";
		$Erreurs['password'] = "Mot de passe inconnu ! ";
	}	
} else {
		$Erreurs['password'] = "Mot de passe incorrect ! ";
}

fseek($userFile, 0);

// On ferme le fichier
fclose($userFile);
?>