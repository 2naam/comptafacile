<p>Bienvenue dans l'inscription</p>


<div>Données envoyées :</div> 

<!-- Champ d'affichage du formulaire --> 

<div>Email : <?php echo $_POST['email']; ?> </div>		
<div>Pseudo : <?php echo $_POST['pseudo']; ?> </div>
<div>Mot de passe : <?php echo $_POST['password']; ?> </div>
<div>Confirmation : <?php echo $_POST['password2']; ?> </div>

<?php

$Erreurs = array();

$email = null;
$pseudo = null;
$password = null;
$password2 = null;

if(isset($_POST['email']) ){$email= trim($_POST['email']);}
if(isset($_POST['pseudo']) ){$pseudo=trim($_POST['pseudo']);}
if(isset($_POST['password']) ){$password=trim($_POST['password']);}
if(isset($_POST['password2']) ){$password2=trim($_POST['password2']);}

/* Test de la Confirmation du mot de passe */
if ($password != $password2)
{
	echo "Confirmation de mot de passe incorrecte";
	$password2 = null;
	$Erreurs['password2'] = "Confirmation password erronée ! "; 
}
	else 
{
		$password2=trim($_POST['password2']);
}
	
/* Test validité Adresse Email (sous la forme abcd1234@abcd123.abc) */

if ( preg_match ( " /^[^\W][a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\@[a-zA-Z0-9_]+(\.[a-zA-Z0-9_]+)*\.[a-zA-Z]{2,4}$/ " , $email))
{
	echo "<div> Email valide </div>";
}
else
{
    echo "<div> Email invalide </div>";
	$Erreurs['email'] = "Email non valide !";
}

/* Test validité du Pseudo (Commençant par lettres majuscules 
ou miniscules ou chiffres entre   */

if ( preg_match ( " \^[a-zA-Z0-9_]{3,8}$\ " , $pseudo ) )
{
echo "<div> Pseudo valide <div>";
}
else
{
    echo "<div> Pseudo invalide </div>";
	$Erreurs['pseudo'] = "Pseudo non valide !";
}
	
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