<p>Bienvenue dans l'inscription</p>


<div>Données envoyées :</div> 

<!-- Champ d'affichage du formulaire --> 

<div>Email : <?php echo $_POST['email']; ?> </div>		
<div>Pseudo : <?php echo $_POST['pseudo']; ?> </div>
<div>Mot de passe : <?php echo $_POST['password']; ?> </div>
<div>Confirmation : <?php echo $_POST['password2']; ?> </div>

<?php


$formulaire = (nl2br($_POST['email'] $_POST['pseudo'] $_POST['password']));

// Ouverture du fichier 
$monfichier = fopen('data/utilisateurs.txt', 'r+');

// Test de l'attribution de l'email 
/*
if (($_POST['email']) ) {
	
	echo "Email déjà attribuée";
}

// Test de l'attribution du pseudo 

if (($_POST['pseudo']) ) {
	
	echo "Pseudo déjà attribué";
}

// Test des contraintes du password 

if (($_POST['password']) ) {
	
	echo "Vous ne respectez pas les contraintes du mot de passe";
*/


// Ecriture du fichier  
if ( !fwrite($monfichier, $formulaire)) {
  echo "Impossible de vous inscrire ";
  exit;


// On scinde dans un tableau 

list($email, $pseudo, $password) =
    split(",", $monfichier_line, 3);
	
// Fermeture du fichier 
fclose($monfichier);

echo "Vous êtes enregistré !";
?>





