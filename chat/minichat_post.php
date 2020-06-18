<?php
session_start();

// Connexion à la base de données
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}

// Insertion du message à l'aide d'une requête préparée
$req = $bdd->prepare('INSERT INTO minichat(pseudo, message, sexe) VALUES(?,?,?)');

$req->execute(array($_SESSION['user'], $_POST['message'], $_POST['gender']));

// Redirection du visiteur vers la page du minichat
header('Location: index.php');
?>
