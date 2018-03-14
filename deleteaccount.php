<?php
include_once('auth.php');

	$stmt = $db->prepare('DELETE FROM users WHERE login = :login;');
	$stmt->bindParam(':login', $_SESSION['login'], PDO::PARAM_STR);
	$stmt->execute();
include_once('disconnect.php');
?>