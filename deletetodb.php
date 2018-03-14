<?php
include_once('auth.php');

if (isset($_POST['delimg']))
{
	$img = $_POST['delimg'];

	$stmt = $db->prepare('DELETE FROM gallery WHERE img = :img;');
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();

	$stmt = $db->prepare('DELETE FROM comments WHERE id_image = :img');
	$stmt->bindParam(':img', $img, PDO::PARAM_STR);
	$stmt->execute();
	header('Location: gallery.php?page='.$_SESSION['page']);
}
?>