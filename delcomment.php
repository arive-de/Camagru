<?php
include_once('auth.php');


if (isset($_POST['delcom']))
{
	$com = $_POST['delcom'];
	$stmt = $db->prepare('DELETE FROM comments WHERE comment = :com;');
	$stmt->bindParam(':com', $com, PDO::PARAM_STR);
	$stmt->execute();

	header('Location: gallery.php?page='.$_SESSION['page']);
}
?>