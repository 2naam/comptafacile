<?php
require_once('model/User.php');
require_once('tools/FileReader.php');
session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
		<title>Compta facile</title>
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"> <!-- importation de la feuille de style BootStrap -->
		<link rel="stylesheet" type="text/css" href="css/compta.css">
		<script src="js/jquery.min.js"></script> <!-- Importation du JavaScript BootStrap -->
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body class="fond">
		<?php
			$user;
			$erreurClass='';
			if(isset($_SESSION['erreurs'])){
				$erreurs = $_SESSION['erreurs'];
				if(count($erreurs)<=0)
				{
					$erreurClass='hide';
				}
			} else {
				$erreurs = array();
				$erreurClass = 'hide';
			}
			if(isset($_SESSION['success'])){
				$successes = $_SESSION['success'];
			} else {
				$successes = array();
				$successClass = 'hide';
			}
			if(isset($_SESSION['user'])){
				$user = $_SESSION['user'];
				require_once('dashboard.php');
			} else {
					$user = new User('guest','');
					require_once('guest.php');
			}
		?>
	</body>
</html>