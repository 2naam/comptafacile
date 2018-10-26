<p>Bienvenue dans l'inscription</p>


<div>Données envoyées :</div> 

<!-- Champ d'affichage du formulaire --> 

<div>Email : <?php echo $_POST['email']; ?> </div>		
<div>Pseudo : <?php echo $_POST['pseudo']; ?> </div>
<div>Mot de passe : <?php echo $_POST['password']; ?> </div>
<div>Confirmation : <?php echo $_POST['password2']; ?> </div>

<?php

$Erreurs = array();

$pseudo = null;
$password = null;
$email = null;
if(isset($_POST['pseudo']) ){$pseudo=trim($_POST['pseudo']);}
if(isset($_POST['password']) ){$password=trim($_POST['password']);}
if(isset($_POST['email']) ){$email= trim($_POST['email']);}


//Chemin du fichier utilisateurs
$filePath = '../data/utilisateurs.txt';

// On ouvre le fichier ou on le crée s'il existe pas
$userFile = fopen("".$filePath, 'a+');

// Test de l'attribution de l'email         //////  A COMPLETER  //////
if ($email != null) {
	$emailtrouve = false;
	// Test de l'attribution du pseudo 
	while(!feof($userFile)) {
        //Lecture d'une ligne
		$line = fgets($userFile);
        //Separation de la ligne sur le charactere ','
		$splittedLine = explode(",", $line);
		$EmailBase = trim($splittedLine[0]);
		//Test de la présence de l'email en deuxième position de la ligne
		if ($EmailBase == $email){
			$emailtrouve = true;
		}
    }
	if($emailtrouve){
		echo "<div>Email déjà attribuée </div>";
		$Erreurs['user'] = "Email déjà attribuée ! ";
		fputs($userFile,$email);
		fputs($userFile, ',');
	} else {
		echo "<div>Email définie ! </div>";
		fputs($userFile,$email);
		fputs($userFile, ',');
	}	
} else {
		$Erreurs['email'] = "Utilisateur non défini ! ";
}

// Test de l'attribution du pseudo 

if ($pseudo != null) { 
	$pseudotrouve = false;
	// Test de l'attribution du pseudo 
	while(!feof($userFile)) {
        //Lecture d'une ligne
		$line = fgets($userFile);
        //Separation de la ligne sur le charactere ','
		$splittedLine = explode(",", $line);
		$PseudoBase = trim($splittedLine[1]);
		//Test de la présence du pseudo en deuxième position de la ligne
		if ($PseudoBase == $pseudo ){
			$pseudotrouve = true;
		}
    }
	if($pseudotrouve){
		echo "<div>Pseudo déjà attribué </div>";
		$Erreurs['user'] = "Pseudo déjà attribué ! ";
	} else {
		echo "<div>Pseudo définie ! </div>";
		fputs($userFile,$pseudo);
		fputs($userFile, ',');
	}	
} else {
		$Erreurs['user'] = "Utilisateur non défini ! ";
}
 
// Test des contraintes du password        //////  A COMPLETER  //////

if ($password != null) {
	echo "<div>Mot de passe défini ! </div>";
	fputs($userFile,$password."\r\n");
	} else {
		echo "<div>Mot de passe non défini ! </div>";
		$Erreurs['password'] = "Mot de passe non défini ! "; }
		

	
// Fermeture du fichier 
fclose($userFile);

?>