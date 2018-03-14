<?php
include_once("auth.php");
if (isset($_SESSION['login']))
	header('Location: homepage.php');
	
	$message = "Welcome ".filter_var($login, FILTER_SANITIZE_STRING)." !\n\nClic on this link to validate your account ! Then you'll be able to connect<3.\n\n http://localhost:8080/Camagru/activation.php?hash=".$hashid."\n\n ------------- \n This is an automated email, please do not answer.";
	mail($mail, 'Validation de compte Camagru', $message);
?>