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
$userFile = fopen("".$filePath, 'a+');

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
		echo "<div>Vous êtes connecté !</div>";
	} else {
		echo "<div>Pseudo non reconnu</div>";
		echo "<div>Cassez vous d'ici!</div>";
		$Erreurs['user'] = "Pseudo inconnu ! ";
	}	
} else {
		$Erreurs['user'] = "Utilisateur non défini ! ";
}

// On ferme le fichier
fclose($userFile);
?>