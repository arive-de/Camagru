<?php
ob_start();
include_once('header.php');

$login = $_SESSION['login'];
		$stmt = $db->prepare('SELECT mail_com FROM users WHERE login = :login;');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		$act = $stmt->fetchColumn();
		if ($act)
		{
			$res = 0;
		}
		else
		{
			$res = 1;
		}
$stmt = $db->prepare('UPDATE users SET mail_com = :mail_com WHERE (login = :login)');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':mail_com', $res, PDO::PARAM_STR);
		$stmt->execute();
		header('Location: myaccount.php');
		ob_end_flush();
?>