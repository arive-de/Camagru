<?php
include_once('auth.php');

	$stmt = $db->prepare('DELETE FROM gallery WHERE login = :login;');
	$stmt->bindParam(':login', $_SESSION['login'], PDO::PARAM_STR);
	$stmt->execute();
	header('Location: myaccount.php');
?>