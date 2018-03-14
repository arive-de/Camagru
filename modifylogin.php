<?php
include_once('header.php');

if (isset($_POST['login']))
{
	if ($_POST['login'] != '')
		{
			$oldlog = $_SESSION['login'];
			$login = $_POST['login'];
			$stmt = $db->prepare('SELECT * FROM `users` WHERE login = :login');
   			$stmt->bindParam(':login', $login, PDO::PARAM_STR);
   			$stmt->execute();
   			$res = $stmt->fetchColumn();
			if (!$res)
			{
				$_SESSION['login'] = $login;
				$stmt = $db->prepare('UPDATE users SET login = :newlog WHERE (login = :login)');
				$stmt->bindParam(':login', $oldlog, PDO::PARAM_STR);
				$stmt->bindParam(':newlog', filter_var($login, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
   				$stmt->execute();
			}
			else
			{
				?>
					<script language="javascript">
					window.alert("Login already exists");
					</script>
				<?php
			}
		}
		else
		{
			?>
				<script language="javascript">
				window.alert("Please, just choose a login already");
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
	<form class="" action="modifylogin.php" method="post">
	Old login : <?php echo $_SESSION['login']; ?><br><br>
	New login :
	<input type="text" name="login" /><input type="submit" value="Let's modify my login" /> <br><br>
	</form>