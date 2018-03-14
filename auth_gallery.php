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


?>


<html>
	<head>
			<title>Camagru</title>
			<link rel="stylesheet" href="front.css">
			<meta charset="utf-8">
	</head>
	<body>
			<div>
				<br>
				<?php if (isset($_SESSION['login'])) { ?>
					<a href="disconnect.php"><span class= "deco">Disconnect</span></a>
			</div>
			<div class="index_header">
				<div><a class="index_tab" href="homepage.php">Home page</a></div>
				<div><a class="index_tab" href="gallery.php">Gallery</a></div>
				<div><a class="index_tab" href="myaccount.php">My account</a></div>
			</div>
			<?php } else { ?>
					<a href="index.php"><span class= "deco">Back to login</span></a>
					<div class="index_header">				
					<div><a class="index_tab" href="gallery.php">Gallery</a></div>
					</div> <?php
			}?>
