<?php
 
$dbhost="localhost";  // hostname
$dbuser="root"; // mysql username
$dbpass=""; // mysql password
$db="test"; // database you want to use
 
$conn=mysqli_connect( $dbhost, $dbuser, $dbpass, $db ) or die("Could not connect: " .mysqli_error($conn) );
 
//you can also directly write values in mysqli_connect():
 
// $conn=mysqli_connect("localhost", "root", "", "test");

if( isset($_POST['pseud']) and isset($_POST['pass']) ) {
	$user=$_POST['pseud'];
	$pass=$_POST['pass'];

	$ret=mysqli_query( $conn, "SELECT * FROM users WHERE pseudo='$user' AND password='$pass' ") or die("Could not execute query: " .mysqli_error($conn));
	$row = mysqli_fetch_assoc($ret);
	if(!$row) {
		header("Location: connexion.html");
		}
	else {
	        session_start();
	        $_SESSION['user'] = $user;
		$_SESSION['loggedIn'] = true;
		header('Location: /chat/index.php');
		}
}
?>
