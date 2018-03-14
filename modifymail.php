<?php
include_once('header.php');

if (isset($_POST['mail']))
{
	if ($_POST['mail'] != '')
		{
			$oldmail = $_SESSION['mail'];
			$mail = $_POST['mail'];
			if (!preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $mail)) {
			?>
				<script language="javascript">
				window.alert("Merci de rentrer un mail valide");				
				</script>
			<?php
			}
			else
			{
				$stmt = $db->prepare('SELECT * FROM `users` WHERE email = :mail');
	   			$stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
	   			$stmt->execute();
	   			$res = $stmt->fetchColumn();
				if (!$res)
				{
					$_SESSION['mail'] = $mail;
					$stmt = $db->prepare('UPDATE users SET email = :newmail WHERE (email = :mail)');
					$stmt->bindParam(':mail', $oldmail, PDO::PARAM_STR);
					$stmt->bindParam(':newmail', filter_var($mail, FILTER_SANITIZE_STRING), PDO::PARAM_STR);
	   				$stmt->execute();
				}
				else
				{
					?>
						<script language="javascript">
						window.alert("Email already exists");
						</script>
					<?php
				}
			}
		}
		else
		{
			?>
				<script language="javascript">
				window.alert("Please, just choose a mail already");
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
	<form class="" action="modifymail.php" method="post">
	Old mail : <?php echo $_SESSION['mail']; ?><br><br>
	New mail :
	<input type="text" name="mail" /><input type="submit" value="Let's modify my mail" /> <br><br>
	</form>