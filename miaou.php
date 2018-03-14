<?php

include_once('auth.php');

if (isset($_POST['miaouimg']))
{
	$img = $_POST['miaouimg'];
	$login = $_SESSION['login'];
	$stmt = $db->prepare('SELECT COUNT(*) FROM miaou WHERE login = :login AND id_image = :id_image;');
	$stmt->bindParam(':login', $login);
	$stmt->bindParam(':id_image', $img);
	$stmt->execute();
	$res = $stmt->fetchColumn();
	if (!$res)
	{
		$stmt = $db->prepare('INSERT INTO miaou (login, id_image) VALUES (:login, :id_image);');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':id_image', $img, PDO::PARAM_STR);
		$stmt->execute();
	}
	else
	{
		$stmt = $db->prepare('DELETE FROM miaou WHERE login = :login AND id_image = :id_image;');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->bindParam(':id_image', $img, PDO::PARAM_STR);
		$stmt->execute();
	}
	header('Location: gallery.php?page='.$_SESSION['page']);
}
?>