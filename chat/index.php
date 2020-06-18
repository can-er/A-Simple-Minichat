<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();
if($_SESSION['loggedIn']){
      //allow
}
else{
      //redirect to the login page
      header('Location: http://minichat.ddns.net/'); 
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>exercice</title>
  </head>
  <body>
	<p> Bienvenue <?php echo  $_SESSION['user']; ?> </p>
<form action="minichat_post.php" method="post">
    <header>
      <nav class="navbar">
        <ul>
          <li>
            <a href="#">MINIchat </a>
            <p class="version">V1.1</p>
          </li>
        </ul>
      </nav>
    </header>
    <div class="main">
       <div class="first">
        <!--div>
            <label for="Pseudo">Pseudo</label>
            <input type="text" id="Pseudo" name="pseudo" placeholder="Pseudo" required/>
        </div-->
        <div class="gender avatar">
            Avatar
            <div>
                <label for="male"><img class="avatar_img" src="img/male_avatar.png" alt="avatar_male"/></label>
                <input type="radio" name="gender" id="male" value="male">
        </div>
        <div>
            <label for="female"><img class="avatar_img" src="img/female_avatar.png" alt="avatar_female"/></label>
            <input type="radio" name="gender" id="female" value="female">
        </div>
    </div>
        </div>

    </div>
    <div class="chat_room">

    <?php
	// Connexion à la base de données
	try
	{
		$bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8', 'root', '');
	}
	catch(Exception $e)
	{
	        die('Erreur : '.$e->getMessage());
	}

	// Récupération des 10 derniers messages
	$reponse = $bdd->query('SELECT pseudo, message, sexe, la_date FROM minichat ORDER BY id ASC LIMIT 0, 6'); 
	$reponse_inverted = array_reverse($reponse);
	$opendirectory = opendir("img/");
	// Affichage de chaque message (toutes les données sont protégées par htmlspecialchars)
	while ($donnees = $reponse->fetch())
	{
		 echo "<img src='img/". htmlspecialchars($donnees['sexe']). "_avatar.png' width=50>" . '<p><strong>' . htmlspecialchars($donnees['pseudo']) . '</strong> : '
		. htmlspecialchars($donnees['la_date']) .": " .htmlspecialchars($donnees['message']) . '</p>';
	}
	$reponse->closeCursor();
	closedir($opendirectory);
    ?>
    </div>
    <div class="second">
        <div>
            <input id="Message" name="message" placeholder="VotreMessage" required></input>
        </div>
	     <input type="submit" value="Envoyer" />
        </div>
    </form>
  </body>
</html>
