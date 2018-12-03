<html>
<head>
<title> </title>
</head>
<body>

<?php

// Tester PDO

if (extension_loaded ('PDO')) {
	echo 'PDO OK'; 
	} else {
	echo 'PDO KO'; 
}


// Création du DSN

$dsn = 'mysql:host=localhost;dbname=compta_facile;port=3306;charset=utf8';

// Création et test de la connexion

$pdo = new PDO($dsn, 'localhost' , '');

// Requête pour tester la connexion

$query = $pdo->query("SELECT * FROM `utilisateur` WHERE `Email`");

$resultat = $query->fetchAll();

//Afficher le résultat dans un tableau

print("<table border=\"1\">");

foreach ($resultat as $key => $variable)
{
print("<tr>");
print("<td>".$resultat[$key]['Email']."</td>");
print("<td>".$resultat[$key]['Pseudo']."</td>");
print("<td>".$resultat[$key]['MDP']."</td>");
print("<tr>");
}

print("</table>");

?>

</body>
</html>