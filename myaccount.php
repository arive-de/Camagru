<?php
include('header.php');

?>

<html>
<head>
	<title>My account</title>
	<link rel="stylesheet" href="front.css">
	<meta charset="utf-8">
</head>
<body>
	<p class="prg">Personnal informations<p>
	<div class="formulaire1">
	<form class="" action="modifylogin.php" method="post">
	Login : <?php echo $_SESSION['login']; ?>
	<input type="submit" name="submit" value="Modify" /> <br><br>
	</form>
	<form class="" action="modifypass.php" method="post">
	Password : ********
	<input type="submit" name="submit" value="Modify" /> <br><br>
	</form>
	<form class="" action="modifymail.php" method="post">
	Email : <?php echo $_SESSION['mail']; ?>
	<input type="submit" name="submit" value="Modify" /> <br><br>
	</form>
	<form class="" action="des_com.php" method="post">
	Receiving email for comment : <?php 
	$login = $_SESSION['login'];
		$stmt = $db->prepare('SELECT mail_com FROM users WHERE login = :login;');
		$stmt->bindParam(':login', $login, PDO::PARAM_STR);
		$stmt->execute();
		$act = $stmt->fetchColumn();
	if ($act) {
		echo "Active";
	}
	else {
		echo "Inactive";
	} ?>
	<input type="submit" name="submit" value="Modify" /> <br><br>
	</form>
	<form class="" action="deleteallpics.php" method="post">
	Delete all my pictures : 
	<input type="submit" name="submit" value="Delete all pics" /> <br><br>
	</form>
	<form class="" action="deleteaccount.php" method="post">
	Delete my account : 
	<input type="submit" name="submit" value="Delete" /> <br><br>
	</form>
</div>
</body>

<?php 

include_once('footer.php');

?>