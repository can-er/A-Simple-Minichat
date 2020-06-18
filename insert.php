<?php
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect("localhost", "root", "", "test");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Escape user inputs for security
$pseudo = mysqli_real_escape_string($link, $_REQUEST['pseudo']);
$email = mysqli_real_escape_string($link, $_REQUEST['email']);
$password = mysqli_real_escape_string($link, $_REQUEST['password']);


$sql_select = "SELECT pseudo FROM users WHERE pseudo='$pseudo'";
$doublons_query = mysqli_query($link, $sql_select);
$doublons = mysqli_num_rows($doublons_query);
if ($doublons == 0)
{
  // Attempt insert query execution
  $sql_insert = "INSERT INTO users(pseudo, email, password) VALUES ('$pseudo', '$email', '$password')";
  if(mysqli_query($link, $sql_insert)){
      session_start();
      $_SESSION['user'] = $pseudo;
      $_SESSION['loggedIn'] = true;
      header('Location: /chat/index.php');
  }
  else{
      echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
  }
}

else{
   echo "Pseudo deja present";
}

// Close connection
mysqli_close($link);
?>
