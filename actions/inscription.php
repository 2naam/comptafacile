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
if(isset($_POST['pseudo']) ){$pseudo= $_POST['pseudo'];}
if(isset($_POST['password']) ){$password= $_POST['password'];}
if(isset($_POST['email']) ){$email= $_POST['email'];}


//Chemin du fichier utilisateurs
$filePath = '../data/utilisateurs.txt';

// On ouvre le fichier ou on le crée s'il existe pas
$userFile = fopen("".$filePath, 'a+');
fseek($userFile, 0);


// Test de l'attribution de l'email         //////  A COMPLETER  //////
if ($email != null) {
	$emailtrouve = false;
	// Test de l'attribution du pseudo 
	while(!feof($userFile)) {
        //Lecture d'une ligne
		$line = fgets($userFile);
        //Separation de la ligne sur le charactere ','
		$splittedLine = explode(",", $line);
		//Test de la présence du pseudo en deuxième position de la ligne
		if ($splittedLine[1] == $email){
			$emailtrouve = true;
		}
    }
	if($emailtrouve){
		echo "<div>Email déjà attribuée </div>";
		$Erreurs['user'] = "Email déjà attribuée ! ";
	} else {
		echo "<div>Email définie ! </div>";
		rewind($userFile);
		fputs($userFile, "\r\n".$email );
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
		//Test de la présence du pseudo en deuxième position de la ligne
		if ($splittedLine[1] == $pseudo ){
			$pseudotrouve = true;
		}
    }
	if($pseudotrouve){
		echo "<div>Pseudo déjà attribué </div>";
		$Erreurs['user'] = "Pseudo déjà attribué ! ";
	} else {
		echo "<div>Pseudo définie ! </div>";
		rewind($userFile);
		fputs($userFile, $pseudo);
		fputs($userFile, ',');
	}	
} else {
		$Erreurs['user'] = "Utilisateur non défini ! ";
}
 
// Test des contraintes du password        //////  A COMPLETER  //////

if ($password != null) {
	echo "<div>Mot de passe défini ! </div>";
	rewind($userFile);
	fputs($userFile, $password);
	} else {
		echo "<div>Mot de passe non défini ! </div>";
		$Erreurs['password'] = "Mot de passe non défini ! "; }
		

	
// Fermeture du fichier 
fclose($userFile);

?>