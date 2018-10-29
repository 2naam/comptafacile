<p>Bienvenue dans l'inscription</p>

<?php
require_once('../model/User.php');
require_once('../tools/FileReader.php');

$user = null; 
$Erreurs = array();

if(isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2'])){
		$user = new user(trim($_POST['email']),trim($_POST['pseudo']),trim($_POST['password']));
		if ($user->isValidForRegister()){
			$password2=trim($_POST['password2']);
			//Test de la Confirmation du mot de passe
			if ($user->getPassword() == $password2){
				$fileReader = new FileReader('../data/utilisateurs.txt',",");
				// Test de l'attribution de l'email 
				if($fileReader->find($user->getEmail(),0, null, null)){
					echo "<div>Email déjà attribuée</div>";
					$Erreurs['user'] = "Email déjà attribuée ! ";
				} else {		
					// Test de l'attribution du pseudo 
					if($fileReader->find($user->getPseudo(),1, null, null)){
						echo "<div>Pseudo déjà attribué </div>";
						$Erreurs['user'] = "Pseudo déjà attribué ! ";
					} else {
						$fileReader->write($user->getEmail().",".$user->getPseudo().",".$user->getPassword()."\r\n");
						echo "<div>Utilisateur enregistré en base! </div>";
					}			
				}	
			} else {
				echo "Le mot de passe ne correspond pas à la confirmation";
				$password2 = null;
				$Erreurs['password2'] = "Le mot de passe ne correspond pas à la confirmation"; 
			}			
		}
		else{
			if(!$user->isValidEmail()){
				echo "<div> Email invalide </div>";
				$Erreurs['email'] = "Email invalide !";
			}
			if(!$user->isValidPseudo()){
				echo "<div> Pseudo invalide </div>";
				$Erreurs['pseudo'] = "Pseudo invalide !";
			}
			if(!$user->isValidPassword()){
				echo "<div>Mot de passe invalide ! </div>";
				$Erreurs['password'] = "Mot de passe invalide ! ";
			}
		}
}
else {
	$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
	echo "<div>Veuillez saisir tous vos identifiants !</div>";
}
?>