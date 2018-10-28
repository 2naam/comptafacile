<?php
require_once('../model/User.php');
require_once('../tools/FileReader.php');

$user = new User; 
$fileReader = new FileReader;
$Erreurs = array();
$password2 = null;
//Chemin du fichier utilisateurs
$filePath = '../data/utilisateurs.txt';


if(isset($_POST['email']) ){$user->setEmail(trim($_POST['email']));}
if(isset($_POST['pseudo']) ){$user->setPseudo(trim($_POST['pseudo']));}
if(isset($_POST['password']) ){$user->setPassword(trim($_POST['password']));}
if(isset($_POST['password2']) ){$password2=trim($_POST['password2']);}

//Test validité Adresse Email (sous la forme abcd1234@abcd123.abc)
if ($user->isEmailValid()) {
	echo "<div> Email valide </div>";
	//Test validité du Pseudo
	if($user->isPseudoValid()){
		echo "<div> Pseudo valide <div>";
		//Test de la Confirmation du mot de passe
		if ($user->hasPassword() && ($user->getPassword() == $password2)){
			echo "<div> Mot de passe confirmé <div>";
			$fileReader->setFilePath($filePath);
			
			// Test de l'attribution de l'email
			if ($user->hasEmail()) {
				$emailtrouve = $fileReader->find($user->getEmail(),0,",");
				if($emailtrouve){
					echo "<div>Email déjà attribuée</div>";
					$Erreurs['user'] = "Email déjà attribuée ! ";
				} else {		
					echo "<div>Email pas en base ! </div>";
					// Test de l'attribution du pseudo 
					if ($user->hasPseudo()) { 
						$pseudotrouve = $fileReader->find($user->getPseudo(),1,",");
						if($pseudotrouve){
							echo "<div>Pseudo déjà attribué </div>";
							$Erreurs['user'] = "Pseudo déjà attribué ! ";
						} else {
							echo "<div>Pseudo pas en base ! </div>";
							if ($user->isPasswordValid()) {
								$fileReader->write($user->getEmail().",".$user->getPseudo().",".$user->getPassword()."\r\n");
								echo "<div>Utilisateur enregistré en base! </div>";
							} else {
								echo "<div>Mot de passe non valide ! </div>";
								$Erreurs['password'] = "Mot de passe non valide ! "; 
							}
						}	
					} else {
							$Erreurs['user'] = "Pseudo non défini ! ";
					}		
				}	
			} else {
					$Erreurs['email'] = "Email non défini ! ";
			}
			
		} else {
				echo "Mot de passe incorrecte";
				$password2 = null;
				$Erreurs['password2'] = "Mot de passe erronée ! "; 
		}
		
	}else{
		echo "<div> Pseudo invalide </div>";
		$Erreurs['pseudo'] = "Pseudo non valide !";
	}
} else {
    echo "<div> Email invalide </div>";
	$Erreurs['email'] = "Email non valide !";
}
?>

<p>Bienvenue dans l'inscription</p>


<div>Données envoyées :</div> 

<!-- Champ d'affichage du formulaire --> 

<div>Email : <?php echo $_POST['email']; ?> </div>		
<div>Pseudo : <?php echo $_POST['pseudo']; ?> </div>
<div>Mot de passe : <?php echo $_POST['password']; ?> </div>
<div>Confirmation : <?php echo $_POST['password2']; ?> </div>