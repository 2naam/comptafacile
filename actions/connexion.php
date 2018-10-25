<p>Bienvenue dans la connexion !</p>


<div>Données envoyées :</div> 

<div>Pseudo : <?php echo $_POST['pseudo']; ?> </div>
<div>Mot de passe : <?php echo $_POST['password']; ?> </div>
<?php

// Test de l'attribution du pseudo 

if (isset($_POST['pseudo']) ) {
	
	echo "Pseudo non reconnu";
}

// On ouvre le fichier
$monfichier = fopen('data/utilisateurs.txt', 'r+');





// On ferme le fichier

fclose($monfichier);

echo "Vous êtes connecté !";
?>