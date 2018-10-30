<p>Bienvenue dans l'inscription</p>

<?php
require_once('../model/User.php');
require_once('../tools/FileReader.php');
session_start();

$user = null; 
$Erreurs = array();
$Success = array();

if(isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['password']) && isset($_POST['password2'])){
		$user = new user(trim($_POST['email']),trim($_POST['pseudo']),trim($_POST['password']));
		if ($user->isValidForRegister()){
			$password2=trim($_POST['password2']);
			//Test de la Confirmation du mot de passe
			if ($user->getPassword() == $password2){
				$fileReader = new FileReader('../data/utilisateurs.txt',",");
				// Test de l'attribution de l'email 
				if($fileReader->find($user->getEmail(),0, null, null)){
					$Erreurs['user'] = "Email déjà attribuée ! ";
				} else {		
					// Test de l'attribution du pseudo 
					if($fileReader->find($user->getPseudo(),1, null, null)){
						$Erreurs['user'] = "Pseudo déjà attribué ! ";
					} else {
						$fileReader->write($user->getEmail().",".$user->getPseudo().",".$user->getPassword()."\r\n");
						$Success['user'] = "Félicitation ".$user->getPseudo()." ! Votre compte a été créé.";
						$_SESSION['user'] = $user;
					}			
				}	
			} else {
				$password2 = null;
				$Erreurs['password2'] = "Le mot de passe ne correspond pas à la confirmation"; 
			}			
		}
		else{
			if(!$user->isValidEmail()){
				$Erreurs['email'] = "Email invalide !";
			}
			if(!$user->isValidPseudo()){
				$Erreurs['pseudo'] = "Pseudo invalide !";
			}
			if(!$user->isValidPassword()){
				$Erreurs['password'] = "Mot de passe invalide ! ";
			}
		}
}
else {
	$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
}
$_SESSION['email'] = $user -> getEmail(); 
$_SESSION['pseudo'] = $user -> getPseudo(); 
$_SESSION['erreurs'] = $Erreurs;
$_SESSION['success'] = $Success;
header("Location: http://localhost/comptafacile");
?>