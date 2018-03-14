<?php
include('./config/database.php');

session_start();

try {
	$db = new PDO($DB_DSN, $DB_USER, $DB_PSSWD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$stmt = $db->prepare('SELECT admin FROM users WHERE login = :log');
	$stmt->bindParam(':log', $_SESSION['login'], PDO::PARAM_STR);
	$stmt->execute();
} catch (PDOException $msg) {
	echo 'Erreur: '.$msg->getMessage();
	exit;
}
$admin = $stmt->fetchColumn();

if (!in_array(explode('/', $_SERVER['PHP_SELF'])[2], ['index.php', 'activation.php']) && empty($_SESSION['login']))
{
	header('Location: index.php');
}
?>
