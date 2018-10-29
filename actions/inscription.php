<p>Bienvenue dans l'inscription</p>

<?php
require_once('../model/User.php');
require_once('../tools/FileReader.php');

$user = null; 
$Erreurs = array();
$password2 = null;

//Chemin du fichier utilisateurs
if(isset($_POST['email']) && isset($_POST['pseudo']) && isset($_POST['password'])){
		$user = new user($_POST['email'],$_POST['pseudo'],$_POST['password']);
		if(isset($_POST['password2']) ){$password2=trim($_POST['password2']);}
		
		//Test validité Adresse Email (sous la forme abcd1234@abcd123.abc)
		if ($user->isEmailValid()) {
			echo "<div> Email valide </div>";
			//Test validité du Pseudo
			if($user->isPseudoValid()){
				echo "<div> Pseudo valide <div>";
				//Test de la Confirmation du mot de passe
				if ($user->hasPassword() && ($user->getPassword() == $password2)){
					echo "<div> Mot de passe identiques <div>";
					
					
					// Test de l'attribution de l'email
					if ($user->hasEmail()) {
						$fileReader = new FileReader('../data/utilisateurs.txt',",");
						$emailtrouve = $fileReader->find($user->getEmail(),0, null, null);
						if($emailtrouve){
							echo "<div>Email déjà attribuée</div>";
							$Erreurs['user'] = "Email déjà attribuée ! ";
						} else {		
							echo "<div>Email pas en base ! </div>";
							// Test de l'attribution du pseudo 
							if ($user->hasPseudo()) { 
								$pseudotrouve = $fileReader->find($user->getPseudo(),1, null, null);
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
}
else {
	$Erreurs['user'] = "Veuillez saisir tous vos identifiants ! ";
	echo "<div>Veuillez saisir tous vos identifiants !</div>";
}


?>