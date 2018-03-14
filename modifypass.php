<?php
include_once('header.php');

if (isset($_POST['pass']))
{
	if ($_POST['pass'] != '')
	{
			$passwd = $_POST['pass'];
			if (!preg_match('#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])#', $passwd)) {
			?>
				<script language="javascript">
				window.alert("Caps, min, alpha, 8 characters");				
				</script>
				<?php
			}
			else
			{
				$hash = hash('whirlpool', $passwd);
				if (strlen($passwd) < 8)
				{
					?>
					<script language="javascript">
					window.alert("Caps, min, alpha, 8 characters !");				
					</script>
					<?php

				}
				else
				{
					$stmt = $db->prepare('SELECT * FROM `users` WHERE login = :login;');
	   				$stmt->bindParam(':login', $_SESSION['login'], PDO::PARAM_STR);
	   				$stmt->execute();
					$stmt = $db->prepare('UPDATE users SET passwd = :passwd WHERE (login = :login)');
					$stmt->bindParam(':login', $_SESSION['login'], PDO::PARAM_STR);
					$stmt->bindParam(':passwd', $hash, PDO::PARAM_STR);
	   				$stmt->execute();
	   				echo "You password has been modified";
				}
			}
	}
	else
	{
		?>
			<script language="javascript">
			window.alert("Please, just choose a pass already");
			</script>
		<?php
	}
}
?>


<html>
<head>
	<title>My account</title>
	<link rel="stylesheet" href="front.css">
	<meta charset="utf-8">
</head>
<body>
	<br><br><br>
	<div class="formulaire1">
	<form class="" action="modifypass.php" method="post">
	Old pass : ********<br><br>
	New pass :
	<input type="password" name="pass" />
	<input type="submit" value="Let's modify my password" /> <br><br>
	</form>